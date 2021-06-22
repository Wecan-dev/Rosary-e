<?php

/**
 * Prevent direct access to the script.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woo_Stock_Sync_Api_Request {
	public $errors = [];

	/**
	 * Constructor
	 */
	public function __construct() {
	}

	/**
	 * Push stock quantity of a single product
	 */
	public function push( $product, $operator, $value, $site, $source_desc = null, $source_url = null ) {
		if ( strlen( (string) $product->get_sku( 'edit' ) ) === 0 ) {
			$this->errors['sku_missing'] = __( "SKU is required for product.", 'woo-stock-sync' );

			return false;
		}

		$client = $this->get_api_client( $site );

		switch ( $operator ) {
			case 'set':
				$params = ['stock_quantity' => $value];
				break;
			case 'increase':
				$params = ['inventory_delta' => absint( $value )];
				break;
			case 'decrease':
				$params = ['inventory_delta' => -1 * absint( $value )];
				break;
			case 'set_status':
				$params = ['in_stock' => ( $value === 'instock' )];
				break;
		}

		$params['source_desc'] = $source_desc;
		$params['source_url'] = $source_url;
		$params['woo_stock_sync'] = '1';
		$params['woo_stock_sync_source'] = get_site_url();
		$params['woo_stock_sync_source_role'] = wss_get_role();
		$params['context'] = 'edit';

		$url = "stock-sync/" . urlencode( $product->get_sku( 'edit' ) );

		try {
			$client->post( $url, $params );
		} catch( \Automattic\WooCommerce\HttpClient\HttpClientException $e ) {
			if ( $e->getResponse()->getCode() === 404 ) {
				wss_reset_sync_status( $product->get_id(), $site['key'], true );

				$this->errors['not_found'] = __( "External product not found by SKU.", 'woo-stock-sync' );
				return false;
			}

			$this->errors['exception_update'] = sprintf( __( "Exception while trying to update product. Message: %s", 'woo-stock-sync' ), $e->getMessage() );

			return false;
		} catch ( \Exception $e ) {
			$this->errors['exception_update'] = sprintf( __( "Exception while trying to update product. Message: %s", 'woo-stock-sync' ), $e->getMessage() );

			return false;
		}

		$response = $client->http->getResponse();
		if ( $response->getCode() === 200 ) {
			$ext_product = json_decode( $response->getBody() );

			wss_update_ext_qty(
				$product,
				$site['key'],
				$ext_product->stock_quantity,
				$ext_product->id,
				$ext_product->name,
				$ext_product->parent_id
			);

			return $ext_product;
		}

		return false;
	}

	/**
	 * Batch push stock quantites
	 */
	public function push_batch( $products, $site ) {
		$client = $this->get_api_client( $site );

		$params = ['update' => []];
		$skus = [];
		foreach ( $products as $product ) {
			$sku = (string) $product->get_sku( 'edit' );

			if ( strlen( $sku ) > 0 ) {
				$params['update'][] = [
					'stock_quantity' => $product->get_stock_quantity( 'edit' ),
					'sku' => $sku,
				];
				$skus[$sku] = $product->get_id();
			}
		}

		// No products with SKUs, skip
		if ( empty( $params['update'] ) ) {
			return true;
		}

		$params['woo_stock_sync'] = '1';
		$params['woo_stock_sync_source'] = get_site_url();
		$params['woo_stock_sync_source_role'] = wss_get_role();
		$params['context'] = 'edit';

		try {
			$client->post( "stock-sync-batch", $params );
		} catch ( \Exception $e ) {
			$this->errors['exception_update'] = sprintf( __( "Exception while trying to batch push. Message: %s", 'woo-stock-sync' ), $e->getMessage() );

			return false;
		}

		$response = $client->http->getResponse();
		if ( $response->getCode() === 200 ) {
			$body = json_decode( $response->getBody() );

			foreach ( $body->update as $ext_product ) {
				if ( ! isset( $ext_product->error ) && isset( $ext_product->id, $skus[$ext_product->sku] ) ) {
					wss_update_ext_qty(
						$skus[$ext_product->sku],
						$site['key'],
						$ext_product->stock_quantity,
						$ext_product->id,
						$ext_product->name,
						$ext_product->parent_id
					);
				} else if ( isset( $ext_product->error, $ext_product->error->code, $skus[$ext_product->sku] ) && $ext_product->error->code === 'woocommerce_rest_product_invalid_sku' ) {
					wss_reset_sync_status( $skus[$ext_product->sku], $site['key'], true );
				}
			}

			return true;
		}

		$this->errors['invalid_response'] = sprintf( __( "Invalid response code %s", 'woo-stock-sync' ), $response->getCode() );

		return false;
	}

	/**
	 * Update sync status for products
	 */
	public function update( $site, $products ) {
		$client = $this->get_api_client( $site );

		// Create an array of SKUs
		$skus = [];
		foreach ( $products as $product ) {
			$sku = (string) $product->get_sku( 'edit' );

			if ( strlen( $sku ) > 0 ) {
				$skus[] = $sku;
			}
		}

		$ext_products = [];

		// Fetch external products by SKU
		try {
			$client->get( 'products', array(
				'sku' => implode( ',', $skus ),
				'per_page' => 100,
				'context' => 'edit',
			) );
		} catch ( \Exception $e ) {
			$this->errors['exception_update'] = sprintf( __( "Exception while trying to update sync status. Message: %s", 'woo-stock-sync' ), $e->getMessage() );

			return false;
		}

		$response = $client->http->getResponse();
		if ( $response->getCode() === 200 ) {
			$results = json_decode( $response->getBody() );

			foreach ( $results as $result ) {
				$ext_products[$result->sku] = $result;
			}
		} else {
			$this->errors['invalid_response'] = sprintf( __( "Invalid response by API. HTTP status code: %s", 'woo-stock-sync' ), $response->getCode() );

			return false;
		}

		// Check which products have corresponding external product
		foreach ( $products as $product ) {
			$sku = (string) $product->get_sku( 'edit' );

			if ( strlen( $sku ) > 0 && isset( $ext_products[$sku] ) ) {
				$ext_product = $ext_products[$sku];

				wss_update_ext_qty(
					$product,
					$site['key'],
					$ext_product->stock_quantity,
					$ext_product->id,
					$ext_product->name,
					$ext_product->parent_id
				);
			} else {
				// Reset current data
				wss_reset_sync_status( $product->get_id(), $site['key'] );
			}
		}

		return true;
	}

	/**
	 * Get API client
	 */
	private function get_api_client( $site ) {
		return Woo_Stock_Sync_Api_Client::create( $site['url'], $site['api_key'], $site['api_secret'] );
	}
}
