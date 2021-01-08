<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Plugins;

use Objectiv\Plugins\Checkout\Compatibility\Base;

class YITHProductBundles extends Base {
	public function is_available() {
		return defined( 'YITH_WCPB_VERSION' );
	}

	public function run_immediately() {
		add_filter( 'cfw_cart_item_quantity', array( $this, 'maybe_suppress_edit_controls' ), 10, 2 );
	}

	function maybe_suppress_edit_controls( $quantity, $cart_item ) {

		if ( isset( $cart_item[ 'bundled_by' ] ) ) {
			$bundle_cart_key = $cart_item[ 'bundled_by' ];
			if ( isset( WC()->cart->cart_contents[ $bundle_cart_key ] ) ) {
				return '';
			}
		}

		return $quantity;
	}
}