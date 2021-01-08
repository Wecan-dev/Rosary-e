<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Gateways;

use Objectiv\Plugins\Checkout\Compatibility\Base;

class SkyVergeGateways extends Base {
	public function is_available() {
		return class_exists( '\\SkyVerge\\WooCommerce\\PluginFramework\\v5_7_1\\SV_WC_Payment_Gateway_Direct' ) || class_exists( '\\SkyVerge\\WooCommerce\\PluginFramework\\v5_8_1\\SV_WC_Payment_Gateway_Direct' );
	}

	/**
	 * @param array $compatibility
	 *
	 * @return array
	 */
	function typescript_class_and_params( $compatibility ) {
		$compatibility[] = [
			'class'  => 'SkyVergeGateways',
			'params' => [],
		];

		return $compatibility;
	}
}
