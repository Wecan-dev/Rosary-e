<?php

/**
 * Prevent direct access to the script.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woo_Stock_Sync_Admin {
  /**
   * Constructor
   */
  public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 15, 0 );

		// Version check
		add_action( 'init', array( $this, 'version_check' ), 10, 0 );

		// Settings
		add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_settings_page' ), 10, 1 );

		// Add links to the plugins page
		if ( defined ( 'WOO_STOCK_SYNC_BASENAME' ) ) {
			add_filter( 'plugin_action_links_' . WOO_STOCK_SYNC_BASENAME, array( $this, 'add_plugin_links' ), 10, 1 );
		}

		// AJAX page for checking API access
		// /wp-admin/admin-ajax.php?action=woo_stock_sync_check_api_access
		add_action( 'wp_ajax_woo_stock_sync_check_api_access', array( $this, 'check_api_access' ) );

		// AJAX page for running sync update
		add_action( 'wp_ajax_woo_stock_sync_update', array( $this, 'update' ) );

		// AJAX page for pushing stock quantities to all sites 
		add_action( 'wp_ajax_woo_stock_sync_push_all', array( $this, 'push_all' ) );

		// Push stock quantity to external sites
		add_action( 'wp_ajax_woo_stock_sync_push', array( $this, 'push' ) );

		// Get product data
		add_action( 'wp_ajax_woo_stock_sync_get_product', array( $this, 'get_product' ) );
		
		// Create database table for logs
		add_action( 'wp_ajax_wss_create_log_table', array( $this, 'create_log_table' ) );
  }

	/**
	 * Version check
	 */
	public function version_check() {
		if ( ! woo_stock_sync_version_check() ) {
			queue_flash_message( __( 'Stock Sync for WooCommerce requires WooCommerce 4.0 or higher. Please update WooCommerce.', 'woo-stock-sync' ), 'error' );
		}
	}

	/**
	 * Plugin links
	 */
	public function add_plugin_links( $links ) {
		$url = admin_url( 'admin.php?page=wc-settings&tab=woo_stock_sync' );
		$link = '<a href="' . $url . '">' . __( 'Settings' ) . '</a>';
		$links = array_merge( array( $link ), $links );

		if ( ! class_exists( 'Woo_Stock_Sync_Pro' ) ) {
			$link = '<span style="font-weight:bold;"><a href="https://wooelements.com/products/stock-sync-pro" style="color:#46b450;" target="_blank">' . __( 'Go Pro' ) . '</a></span>';

			$links = array_merge( array( $link ), $links );
		}

	  return $links;
	}

	/**
	 * Check API access
	 */
	public function check_api_access() {
		$api_url = isset( $_POST['url'] ) ? trim( $_POST['url'] ) : '';
		$api_key = isset( $_POST['key'] ) ? trim( $_POST['key'] ) : '';
		$api_secret = isset( $_POST['secret'] ) ? trim( $_POST['secret'] ) : '';

		$client = Woo_Stock_Sync_Api_Client::create( $api_url, $api_key, $api_secret );

		// Ensure Stock Sync is installed on the other site also
		try {
			$client->get( 'stock-sync-exists', [] );
		} catch ( \Exception $e ) {
			$this->check_api_access_return( $e );
			return;
		}

		// Check write access
		try {
			// In order to test write access, we need to create test product
			// which will be deleted after testing
			$client->post( 'products', array(
				'name' => 'Test product created by Stock Sync for WooCommerce',
				'type' => 'simple',
				'price' => 1,
				'status' => 'private',
			) );
		} catch ( \Exception $e ) {
			$this->check_api_access_return( $e );
			return;
		}

		$response = $client->http->getResponse();
		if ( $response->getCode() == 201 ) {
			$product = json_decode( $response->getBody() );

			// Delete the product we just created
			// Double-check name just in case
			if ( $product->name === 'Test product created by Stock Sync for WooCommerce' ) {
				try {
					$client->delete( "products/{$product->id}", array(
						'force' => true, // Delete permanently (no trash)
					) );
				} catch ( \Exception $e ) {
					$this->check_api_access_return( $e );
					return;
				}
			}
		}

		$this->check_api_access_return();
	}

	/**
	 * Create log table
	 */
	public function create_log_table() {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			http_response_code( 403 );
			die( 'Permission denied' );
		}

		require WOO_STOCK_SYNC_DIR_PATH . '/includes/woo-stock-sync-db-table.php';
		wss_create_db_table();

		queue_flash_message( __( 'Database table for logs created successfully!', 'woo-stock-sync' ), 'updated' );
		
		$url = add_query_arg( [
			'page' => 'woo-stock-sync-report',
			'action' => 'log',
		], admin_url( 'admin.php' ) );

		wp_safe_redirect( $url );
		die;
	}

	/**
	 * Return JSON info for API access check
	 */
	private function check_api_access_return( $e = false ) {
		$error = false;

		if ( is_object( $e ) && method_exists( $e, 'getMessage' ) ) {
			// Store details for further debugging
			if ( get_class( $e ) === 'Automattic\WooCommerce\HttpClient\HttpClientException' ) {
				$response = $e->getResponse();
				$request = $e->getRequest();

				if ( strpos( $request->getUrl(), 'stock-sync-exists' ) !== false && $response->getCode() === 404 ) {
					$error = __( 'Credentials are correct but Stock Sync plugin is not installed on the other site.', 'woo-stock-sync' );
				}

				$logger = wc_get_logger();
				$context = ['source' => 'woo-stock-sync-exception'];
				$logger->error( sprintf( __( "HTTP exception when verifying credentials.\nURL: %s\nResponse code: %s\nResponse body:\n%s", 'woo-stock-sync' ), $request->getUrl(), $response->getCode(), $response->getBody() ), $context );
			}

			if ( ! $error ) {
				$error = $e->getMessage();

				if ( $error === 'Syntax error' ) {
					$error = sprintf( __( 'Syntax error. Please see <a href="%s" target="_blank">the documentation</a> for more information', 'woo-stock-sync' ), 'https://wooelements.com/guide/guide-stock-sync-pro/' );
				}
			}
		}

		echo json_encode( array(
			'success' => ! $error,
			'error' => $error,
		) );
		die;
	}

	/**
	 * Add settings page
	 */
	public function add_settings_page( $settings ) {
		$settings[] = include_once( WOO_STOCK_SYNC_DIR_PATH . 'includes/admin/class-wc-settings-woo-stock-sync.php' );

		return $settings;
	}

	/**
	 * Enqueue admin scripts and styles
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'woo-stock-sync-admin-css', WOO_STOCK_SYNC_DIR_URL . 'public/admin/css/woo-stock-sync-admin.css', array( 'woocommerce_admin_styles' ), WOO_STOCK_SYNC_VERSION );

		wp_enqueue_script( 'woo-stock-sync-admin-js', WOO_STOCK_SYNC_DIR_URL . 'public/admin/js/woo-stock-sync-admin.js', array( 'jquery', 'wc-enhanced-select', 'jquery-tiptip' ), WOO_STOCK_SYNC_VERSION );

		if ( isset( $_GET['page'] ) && $_GET['page'] === 'woo-stock-sync-report' ) {
			// Enqueue Vue.js only here to avoid clashing with other plugins using Vue.js
			wp_enqueue_script( 'vue-js', WOO_STOCK_SYNC_DIR_URL . 'public/admin/js/vue.js', array( 'underscore' ), WOO_STOCK_SYNC_VERSION );
		}

		wp_localize_script( 'woo-stock-sync-admin-js', 'woo_stock_sync', array(
			'check_credentials' => __( 'Check API credentials', 'woo-stock-sync' ),
			'check_credentials_success' => __( 'Valid credentials', 'woo-stock-sync' ),
			'ajax_urls' => $this->ajax_urls(),
		) );
	}

	/**
	 * Get AJAX action URLs
	 */
	private function ajax_urls() {
		$urls = [];

		$urls['update'] = add_query_arg( [
			'action' => 'woo_stock_sync_update',
		], admin_url( 'admin-ajax.php' ) );

		$urls['update_qty'] = add_query_arg( [
			'action' => 'woo_stock_sync_update_qty',
		], admin_url( 'admin-ajax.php' ) );

		$urls['push'] = add_query_arg( [
			'action' => 'woo_stock_sync_push',
		], admin_url( 'admin-ajax.php' ) );

		$urls['push_all'] = add_query_arg( [
			'action' => 'woo_stock_sync_push_all',
		], admin_url( 'admin-ajax.php' ) );

		$urls['get_product'] = add_query_arg( [
			'action' => 'woo_stock_sync_get_product',
		], admin_url( 'admin-ajax.php' ) );

		return $urls;
	}

	/**
	 * AJAX action for running sync
	 */
	public function update() {
    if ( ! current_user_can( 'manage_woocommerce' ) ) {
      http_response_code( 403 );
      die( 'Permission denied' );
    }

		// If we are completing whole update (all sites has been processed),
		// just update timestamp
		if ( isset( $_POST['complete'] ) && $_POST['complete'] ) {
			update_option( 'woo_stock_sync_last_updated', time() );
			die;
		}

		$page = intval( $_POST['page'] );
		$limit = intval( $_POST['limit'] );
		$site = wss_site_by_key( $_POST['site_key'] );

		if ( ! $site ) {
			http_response_code( 422 );
			die( 'Site not found' );
		}

		$query = wss_product_query( [
			'limit' => $limit,
			'page' => $page,
			'paginate' => true,
			'type' => ['simple', 'variable', 'variation'],
		] );

		$results = $query->get_products();

		$request = new Woo_Stock_Sync_Api_Request();

		if ( $request->update( $site, $results->products ) ) {
			echo json_encode( [
				'status' => 'processed',
				'total' => $results->total,
				'pages' => $results->max_num_pages,
				'page' => $page,
				'last_page' => $results->max_num_pages == $page,
				'count' => count( $results->products ),
			] );

			die;
		} else if ( ! empty( $request->errors ) ) {
			echo json_encode( [
				'status' => 'error',
				'errors' => array_values( $request->errors )
			] );

			die;
		}

		http_response_code( 422 );

		echo json_encode( [
			'status' => 'error',
		] );
		die;
	}

	/**
	 * Push stock quantity of a single product to external site
	 */
	public function push() {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
      http_response_code( 403 );
      die( 'Permission denied' );
		}
		
		$product = wc_get_product( $_POST['product_id'] );
		$site = wss_site_by_key( $_POST['site_key'] );
		$qty = $product->get_stock_quantity( 'edit' );

		if ( ! $site || ! $product ) {
			http_response_code( 422 );
      die( 'Site or product not found' );
		}

		$request = new Woo_Stock_Sync_Api_Request( $product, 'set', $qty, $site );

		if ( ( $ext_product = $request->push( $product, 'set', $qty, $site ) ) !== false ) {
			echo json_encode( [
				'status' => true,
				'qty' => $ext_product->stock_quantity,
			] );
			die;
		}

		// External product not found, just skip
		if ( count( $request->errors ) === 1 && isset( $request->errors['not_found'] ) ) {
			echo json_encode( [
				'status' => true,
				'qty' => null,
			] );
			die;			
		}

		echo json_encode( [
			'status' => false,
			'errors' => array_values( $request->errors ),
		] );

		die;
	}

	/**
	 * Push all stock quantities to external site
	 */
	public function push_all() {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
      http_response_code( 403 );
      die( 'Permission denied' );
		}
		
		$site = wss_site_by_key( $_POST['site_key'] );
		$page = intval( $_POST['page'] );
		$limit = intval( $_POST['limit'] );

		if ( ! $site ) {
			http_response_code( 422 );
      die( 'Site not found' );
		}

		$request = new Woo_Stock_Sync_Api_Request();

		$query = wss_product_query( [
			'limit' => $limit,
			'page' => $page,
			'paginate' => true,
			'type' => ['simple', 'variable', 'variation'],
		] );

		$results = $query->get_products();

		if ( $request->push_batch( $results->products, $site ) ) {
			echo json_encode( [
				'status' => 'processed',
				'total' => $results->total,
				'pages' => $results->max_num_pages,
				'page' => $page,
				'last_page' => $results->max_num_pages == $page,
				'count' => count( $results->products ),
			] );

			die;
		} else if ( ! empty( $request->errors ) ) {
			echo json_encode( [
				'status' => 'error',
				'errors' => array_values( $request->errors )
			] );

			die;
		}

		http_response_code( 422 );

		echo json_encode( [
			'status' => 'error',
		] );
		die;
	}

	/**
	 * Get product
	 */
	public function get_product() {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			http_response_code( 403 );
			die( 'Permission denied' );
		}
		
		$product = wc_get_product( $_GET['product_id'] );

		if ( ! $product ) {
			http_response_code( 404 );
			die( 'Product not found' );
		}

		echo json_encode( wss_product_to_json( $product ) );

		die;
	}
}
