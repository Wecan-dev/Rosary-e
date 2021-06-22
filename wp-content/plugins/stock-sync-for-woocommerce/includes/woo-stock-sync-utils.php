<?php

/**
 * Prevent direct access to the script.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get site role
 */
function wss_get_role() {
	return get_option( 'woo_stock_sync_role', 'primary' );
}

/**
 * Get batch size
 */
function wss_get_batch_size( $operation = '' ) {
	$size = intval( get_option( 'woo_stock_sync_batch_size', 10 ) );

	return apply_filters( 'woo_stock_sync_batch_size', $size, $operation );
}

/**
 * URL to the Primary Inventory report
 */
function wss_primary_report_url( $action = '' ) {
	$sites = woo_stock_sync_sites();

	if ( ! empty( $sites ) ) {
		$site = reset( $sites );

		return add_query_arg( [
			'page' => 'woo-stock-sync-report',
			'action' => $action,
		], $site['url'] . '/wp-admin/admin.php' );
	}

	return '';
}

/**
 * Get product query
 */
function wss_product_query( $params = [] ) {
	$query = new WC_Product_Query();
	$query->set( 'status', array( 'publish', 'private' ) );
	$query->set( 'type', array( 'simple', 'variable' ) );
	$query->set( 'order', 'ASC' );
	$query->set( 'orderby', 'title' );

	foreach ( $params as $key => $value ) {
		$query->set( $key, $value );
	}

	return $query;
}

/**
 * Get products with children
 */
function wss_products_with_children( $products ) {
	$products_with_children = [];

	foreach ( $products as $key => $product ) {
		$products_with_children[] = $product;

		if ( $product->get_type() === 'variable' ) {
			foreach ( $product->get_children() as $children ) {
				$children = wc_get_product( $children );
				if ( ! $children || ! $children->exists() ) {
					continue;
				}

				$products_with_children[] = $children;
			}
		}
	}

	return $products_with_children;
}

/**
 * Format site URL
 */
function wss_format_site_url( $url, $link = false ) {
	$title = str_replace( ['https://', 'http://'], '', $url );

	if ( $link ) {
		return sprintf( '<a href="%s" target="_blank">%s</a>', $url, $title );
	}

	return $title;
}

/**
 * Format date and time
 */
function wss_format_datetime( $timestamp ) {
	return sprintf( '%s - %s', date_i18n( get_option( 'date_format' ), $timestamp ), date_i18n( get_option( 'time_format' ), $timestamp ) );
}

/**
 * Check if role is primary inventory
 */
function wss_is_primary() {
	return wss_get_role() === 'primary';
}

/**
 * Check if role is secondary inventory
 */
function wss_is_secondary() {
	return wss_get_role() === 'secondary';
}

/**
 * URL to admin edit product page
 */
function wss_product_url( $product_id ) {
	return add_query_arg( [
		'post' => $product_id,
		'action' => 'edit',
	], admin_url( 'post.php' ) );
}

/**
 * URL to admin order page
 */
function wss_order_url( $order_id ) {
	return add_query_arg( [
		'post' => $order_id,
		'action' => 'edit',
	], admin_url( 'post.php' ) );
}

/**
 * Get product title by ID
 */
function wss_product_title( $product_id ) {
	$product = wc_get_product( $product_id );

	if ( $product ) {
		return $product->get_name();
	}

	return null;
}

/**
 * General checks whether or not syncing should proceed
 */
function wss_should_sync( $product ) {
	// Unsupported WooCommerce in use, abort
	if ( ! woo_stock_sync_version_check() ) {
		return false;
	}

	// Stock sync not enabled
	if ( get_option( 'woo_stock_sync_enabled', 'yes' ) !== 'yes' ) {
		return false;
	}

	// Inventory change originated from Primary Inventory, do not create new job
	if ( wss_request_role() === 'primary' ) {
		return false;
	}

	// This is Secondary Inventory and change was triggered by Stock Sync request, do not create new job
	if ( wss_is_secondary() && wss_request() ) {
		return false;
	}

	// Product not managing inventory
	if ( ! $product->managing_stock() ) {
		return false;
	}

	// Product SKU missing, skip
	if ( strlen( (string) $product->get_sku( 'edit' ) ) === 0 ) {
		return false;
	}

	// Allow 3rd party plugins to determine whether or not sync the stock
	if ( ! apply_filters( 'woo_stock_sync_should_sync', true, $product, 'stock_qty' ) ) {
		return false;
	}

	return true;
}

/**
 * Check if request is Woo Stock Sync request
 */
function wss_request() {
	return isset( $GLOBALS['woo_stock_sync_request'] ) && $GLOBALS['woo_stock_sync_request'];
}

/**
 * Get request source role (Primary / Inventory)
 */
function wss_request_role() {
	return isset( $GLOBALS['woo_stock_sync_request_role'] ) ? $GLOBALS['woo_stock_sync_request_role'] : false;
}

/**
 * Mark request as Woo Stock Sync request
 */
add_filter( "woocommerce_rest_pre_insert_product_object", 'wss_mark_request', 10, 3 );
add_filter( "woocommerce_rest_pre_insert_product_variation_object", 'wss_mark_request', 10, 3 );
function wss_mark_request( $product, $request, $creating ) {
	if ( $request->get_param( 'woo_stock_sync' ) == '1' ) {
		$GLOBALS['woo_stock_sync_request'] = true;
	}

	if ( $request->get_param( 'woo_stock_sync_source_role' ) ) {
		$GLOBALS['woo_stock_sync_request_role'] = $request->get_param( 'woo_stock_sync_source_role' );
	}

	return $product;
}

/**
 * Store information about which order triggered stock change
 */
add_filter( 'woocommerce_can_restock_refunded_items', 'wss_store_source_order', 10, 2 );
add_filter( 'woocommerce_can_restore_order_stock', 'wss_store_source_order', 10, 2 );
add_filter( 'woocommerce_can_reduce_order_stock', 'wss_store_source_order', 10, 2 );
function wss_store_source_order( $return, $order ) {
	$GLOBALS['wcs_source_order_id'] = $order->get_id();

	return $return;
}

/**
 * Get current stock directly from the DB
 */
function wss_current_stock( $product_id_with_stock ) {
	global $wpdb;

	return wc_stock_amount(
		$wpdb->get_var(
			$wpdb->prepare(
				"SELECT meta_value FROM {$wpdb->postmeta} WHERE post_id = %d AND meta_key='_stock';",
				$product_id_with_stock
			)
		)
	);
}

/**
 * Get site data by key
 */
function wss_site_by_key( $key ) {
	$sites = woo_stock_sync_sites();

	foreach ( $sites as $site ) {
		if ( $site['key'] === $key ) {
			return $site;
		}
	}

	return false;
}

/**
 * Reset stock sync status for a product
 */
function wss_reset_sync_status( $product_id, $site_key, $not_found = false ) {
	$data = (array) get_post_meta( $product_id, '_woo_stock_sync_data', true );

	$data[$site_key] = [
		'not_found' => $not_found,
	];

	update_post_meta( $product_id, '_woo_stock_sync_data', $data );

	return true;
}

/**
 * Update product meta data with stock quantity of external site
 */
function wss_update_ext_qty( $product, $site_key, $ext_qty, $ext_id, $ext_name, $ext_parent_id = null ) {
	if ( is_int( $product ) ) {
		$product_id = $product;
	} else {
		$product_id = $product->get_id();
	}

	$data = (array) get_post_meta( $product_id, '_woo_stock_sync_data', true );

	$data[$site_key] = [
		'id' => $ext_id,
		'name' => $ext_name,
		'qty' => $ext_qty,
		'parent_id' => $ext_parent_id,
	];

	update_post_meta( $product_id, '_woo_stock_sync_data', $data );
}

/**
 * Get other sites which are to be sync
 */
function woo_stock_sync_sites() {
	$sites = array();

	for ( $i = 0; $i < apply_filters( 'woo_stock_sync_supported_api_credentials', 1 ); $i++ ) {
		$url = woo_stock_sync_api_credentials_field_value( 'woo_stock_sync_url', $i );
		$formatted_url = wss_format_site_url( $url );
		$api_key = woo_stock_sync_api_credentials_field_value( 'woo_stock_sync_api_key', $i );
		$api_secret = woo_stock_sync_api_credentials_field_value( 'woo_stock_sync_api_secret', $i );

		if ( ! empty( $url ) && ! empty( $api_key ) && ! empty( $api_secret ) ) {
			$sites[$i] = array(
				'i' => $i,
				'key' => sanitize_key( $url ),
				'url' => $url,
				'formatted_url' => $formatted_url,
				'api_key' => $api_key,
				'api_secret' => $api_secret,
			);
		}
	}

	return $sites;
}

/**
 * Check if WooCommerce 4.0 or higher is running
 */
function woo_stock_sync_version_check() {
	if ( class_exists( 'WooCommerce' ) ) {
		global $woocommerce;

		if ( version_compare( $woocommerce->version, '4.0', '>=' ) ) {
			return TRUE;
		}
	}

	return FALSE;
}

/**
 * Format API credentials field name
 */
function woo_stock_sync_api_credentials_field_name( $name, $i ) {
  if ( $i == 0 ) {
    return $name;
  }

  return sprintf( '%s_%d', $name, $i );
}

/**
 * Get API credentials field value
 */
function woo_stock_sync_api_credentials_field_value( $name, $i, $default = '' ) {
  if ( $i == 0 ) {
    $value_key = $name;
  } else {
    $value_key = sprintf( '%s_%d', $name, $i );
  }


  return get_option( $value_key, $default );
}

/**
 * Converts products into JSON suitable for Vue.js
 */
function wss_product_to_json( $product ) {
	$sku = $product->get_sku( 'edit' );

	if ( $product->get_type() === 'variation' ) {
		$title = str_repeat( '&nbsp;', 5 ) . wc_get_formatted_variation( $product, $flat = true, $include_names = false, $skip_attributes_in_name = false );
		
		if ( strlen( $sku ) > 0 ) {
			$title = sprintf( '%s (%s)', $title, $sku );
		}
	} else {
		$name = $product->get_name();
		if ( strlen( $sku ) > 0 ) {
			$name = sprintf( '%s (%s)', $name, $sku );
		}

		$title = sprintf(
			'<a href="%s" target="_blank">%s</a>',
			wss_product_url( $product->get_id() ),
			$name
		);
	}

	$sites_qty = [];
	foreach ( woo_stock_sync_sites() as $site ) {
		$data = (array) get_post_meta( $product->get_id(), '_woo_stock_sync_data', true );

		$site_data = [
			'url' => null,
			'qty' => null,
			'processing' => false,
			'not_found' => false,
		];

		if ( isset( $data[$site['key']] ) && $data[$site['key']] ) {
			$data = $data[$site['key']];

			if ( isset( $data['id'] ) ) {
				$url_id = $data['id'];
				if ( $data['parent_id'] ) {
					$url_id = $data['parent_id'];
				}

				$ext_url = add_query_arg( [
					'post' => $url_id,
					'action' => 'edit',
				], $site['url'] . '/wp-admin/post.php' );
	
				$site_data = [
					'id' => $data['id'],
					'url' => $ext_url,
					'qty' => $data['qty'],
					'processing' => false,
					'not_found' => false,
				];
			} else if ( isset( $data['not_found'] ) && $data['not_found'] ) {
				$site_data['not_found'] = true;
			}
		}

		$sites_qty[$site['key']] = $site_data;
	}

	return [
		'title' => $title,
		'id' => $product->get_id(),
		'sku' => $product->get_sku( 'edit' ),
		'qty' => $product->get_stock_quantity( 'edit' ),
		'managing_stock' => $product->managing_stock(),
		'editing_qty' => false,
		'site_qtys' => $sites_qty,
		'status' => 'default',
		'status_qty' => 'default',
	];
}