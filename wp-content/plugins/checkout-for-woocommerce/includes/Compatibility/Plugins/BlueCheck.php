<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Plugins;

use Objectiv\Plugins\Checkout\Compatibility\Base;

class BlueCheck extends Base {
	public function is_available() {
		return class_exists( '\\WC_Integration_BlueCheck_Integration' );
	}

	function typescript_class_and_params( $compatibility ) {
		$compatibility[] = [
			'class'  => 'BlueCheck',
			'params' => [],
		];

		return $compatibility;
	}
}
