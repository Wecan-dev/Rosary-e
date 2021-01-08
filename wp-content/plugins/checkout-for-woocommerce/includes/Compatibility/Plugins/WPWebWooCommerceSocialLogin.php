<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Plugins;

use Objectiv\Plugins\Checkout\Compatibility\Base;

class WPWebWooCommerceSocialLogin extends Base {
	public function is_available() {
		return defined( 'WOO_SLG_VERSION' );
	}

	public function run() {
		global $woo_slg_render;

		if ( ! empty( $woo_slg_render ) ) {
			add_action( 'cfw_checkout_customer_info_tab', array( $woo_slg_render, 'woo_slg_social_login'), 29 );
		}
	}
}