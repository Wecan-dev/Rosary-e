<?php

/**
 * Prevent direct access to the script.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Woo_Stock_Sync_Process extends WP_Async_Request {
	protected $action = 'wss_background_process';

	/**
	 * Dispatch the async request
	 *
	 * @return array|WP_Error
	 */
	public function dispatch() {
		$url  = add_query_arg( $this->get_query_args(), $this->get_query_url() );
		$args = $this->get_post_args();

		$args['body']['mac'] = md5( implode( '|', [
			$this->data['product_id'],
			$this->data['operation'],
			$this->data['value'],
			NONCE_SALT,
		] ) );

		return wp_remote_post( esc_url_raw( $url ), $args );
	}

	/**
	 * Handle
	 */
	public function handle( $retry = false ) {
		$product = wc_get_product( $_POST['product_id'] );

		if ( ! $product ) {
			return true;
		}

		$sites = woo_stock_sync_sites();

		// Cut off other sites (if this has been a primary inventory before and there are other sites defined)
		if ( wss_is_secondary() ) {
			$sites = [$sites[0]];
		}

		foreach ( $sites as $site ) {
			$this->push( $site, false );
		}
	}

	/**
	 * Push to site
	 */
	private function push( $site, $retry = false ) {
		$product = wc_get_product( $_POST['product_id'] );
		$operation = $_POST['operation'];
		$value = $_POST['value'];
		$source_desc = isset( $_POST['source_desc'] ) ? $_POST['source_desc'] : null;
		$source_url = isset( $_POST['source_url'] ) ? $_POST['source_url'] : null;
		$log_id = isset( $_POST['log_id'] ) ? $_POST['log_id'] : null;

		$api = new Woo_Stock_Sync_Api_Request();
		$result = $api->push( $product, $operation, $value, $site, $source_desc, $source_url );

		if ( wss_is_primary() && $log_id ) {
			$this->update_log_ref( $log_id, $site, ( $result !== false ), $api->errors );
		}

		if ( $result === false && ( count( $api->errors ) > 1 || ! isset( $api->errors['not_found'] ) ) ) {
			if ( ! $retry ) {
				$this->push( $site, true );
			} else {
				// Log complete failure
				Woo_Stock_Sync_Logger::log(
					sprintf( __( 'Failed to sync. Change: %s %d. Errors: %s.', 'woo-stock-sync' ), $product->get_formatted_name(), $value, implode( '<br>', $api->errors ) ),
					'error',
					$product->get_id(),
					[
						'source' => get_site_url(),
						'source_desc' => $source_desc,
						'source_url' => $source_url,
					]
				);
			}
		}
	}

	/**
	 * Update log record whether or not syncing succeeded
	 */
	private function update_log_ref( $log_id, $site, $result, $errors ) {
		Woo_Stock_Sync_Logger::log_update( $log_id, $site['key'], $result, $errors );
	}

	/**
	 * Maybe handle
	 *
	 * Check for correct nonce and pass to handler.
	 */
	public function maybe_handle() {
		// Don't lock up other requests while processing
		session_write_close();

		// Ensure the request originated from a internal background dispatch
		// instead of 3rd party source.
		// Nonce cannot be used here because of how REST API determines current
		// user.
		$this->verify();

		$this->handle();

		wp_die();
	}

	/**
	 * Verify request
	 */
	private function verify() {
		$mac = md5( implode( '|', [
			$_POST['product_id'],
			$_POST['operation'],
			$_POST['value'],
			NONCE_SALT,
		] ) );

		if ( $mac !== $_POST['mac'] ) {
			wp_die( -1, 403 );
		}

		return true;
	}
}
