<?php

class WC_Settings_Woo_Stock_Sync extends WC_Settings_Page {
	public function __construct() {
		$this->id    = 'woo_stock_sync';
		$this->label = __( 'Stock Sync', 'woo-stock-sync' );

		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );

		add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
		add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );

		// Custom handler for outputting API credential table
		add_action( 'woocommerce_admin_field_wss_credentials_table', array( $this, 'credentials_table' ), 10, 1 );
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {
		global $current_section;

		$settings = $this->get_general_settings();

		$settings = apply_filters( 'woocommerce_' . $this->id . '_settings', $settings );

		return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings );
	}

	/**
	 * Get general settings
	 */
	private function get_general_settings() {
		$settings = array(
			array(
				'title' => __( 'Stock Sync', 'woo-stock-sync' ),
				'type' => 'title',
				'id' => $this->id . '_page_options'
			),
    );

		$settings[$this->id . '_enabled'] = array(
			'title' => __( 'Enable', 'woo-stock-sync' ),
			'type' => 'checkbox',
			'id' => $this->id . '_enabled',
			'default' => 'yes',
		);

		$settings[$this->id . '_role'] = array(
			'title' => __( 'Role of This Site', 'woo-stock-sync' ),
			'type' => 'select',
			'id' => $this->id . '_role',
			'default' => 'primary',
			'options' => array(
				'primary' => __( 'Primary Inventory', 'woo-stock-sync' ),
				'secondary' => __( 'Secondary Inventory', 'woo-stock-sync' ),
			),
			'desc' => __( '<strong>Primary Inventory</strong> is the main inventory that is used to manage stock quantities on Secondary Inventories. You can have only one Primary Inventory.<br><strong>Secondary Inventories</strong> send stock changes (admin edit, purchases and refunds) to Primary Inventory but they don\'t have logging and tool capabilities.', 'woo-stock-sync' ),
		);

		$settings[$this->id . '_batch_size'] = array(
			'title' => __( 'Batch size', 'woo-stock-sync' ),
			'type' => 'number',
			'id' => $this->id . '_batch_size',
			'default' => '10',
			'desc' => __( 'How many products are processed in Push All and Update All tools at a time. Increase number to process more products in batch or decrease if you are having issues with timeout or memory limits. Default: 10', 'woo-stock-sync-pro' ),
			'desc_tip' => true,
			'custom_attributes' => [
				'step' => '1',
				'min' => '1',
				'max' => '100',
			],
		);

		$settings[$this->id . '_page_options_end'] = array(
      'type' => 'sectionend',
      'id' => $this->id . '_page_options'
    );

		if ( wss_is_primary() ) {
			$title = __ ( 'API Credentials - Secondary Inventories', 'woo-stock-sync' );
			$supported_api_credentials = apply_filters( 'woo_stock_sync_supported_api_credentials', 1 );
		} else {
			$title = __ ( 'API Credentials of Primary Inventory', 'woo-stock-sync' );
			$supported_api_credentials = 1;
		}
		
		$settings[$this->id . '_api_settings_start'] = array(
			'title' => $title,
			'type' => 'title',
			'id' => $this->id . '_api_settings'
		);

		// Add hidden fields for API credentials so they get processed in WC_Admin_Settings
		// Hidden fields dont contain real data, instead fields are outputted in wss_credentials_table
		// which wouldn't get saved without this
		for ( $i = 0; $i < $supported_api_credentials; $i++ ) {
			$fields = array( 'woo_stock_sync_url', 'woo_stock_sync_api_key', 'woo_stock_sync_api_secret' );
			foreach ( $fields as $field ) {
				$settings[$this->id . '_api_credentials_hidden_' . $field . '_' . $i] = array(
					'type' => 'hidden',
					'id' => woo_stock_sync_api_credentials_field_name( $field, $i ),
				);
			}
		}

		$settings[$this->id . '_api_credentials'] = array(
			'title' => $title,
			'type' => 'wss_credentials_table',
			'id' => $this->id . '_api_credentials',
			'default' => '',
			'sites' => $supported_api_credentials,
		);

		$settings[$this->id . '_api_settings_end'] = array(
			'type' => 'sectionend',
			'id' => $this->id . '_api_settings'
		);

		return $settings;
	}

	/**
	 * Output credentials table
	 */
	public function credentials_table( $value ) {
		include 'views/credentials-table.html.php';
	}

	/**
	 * Save settings.
	 */
	public function save() {
		parent::save();

		// Reload page
		$url = add_query_arg( array(
			'page' => 'wc-settings',
			'tab' => 'woo_stock_sync',
		), admin_url( 'admin.php' ) );

		wp_safe_redirect( $url );
		die;
	}
}

return new WC_Settings_Woo_Stock_Sync();
