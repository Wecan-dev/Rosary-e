<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Plugins;

use Objectiv\Plugins\Checkout\Compatibility\Base;

class WooCommerceProductBundles extends Base {
	public function is_available() {
		return function_exists( 'WC_PB' );
	}

	public function run_immediately() {
		add_filter( 'cfw_cart_item_quantity', array( $this, 'maybe_suppress_edit_controls' ), 10, 2 );
	}

	function maybe_suppress_edit_controls( $quantity, $cart_item ) {
		if ( $bundle_container_item_key = wc_pb_get_bundled_cart_item_container( $cart_item, false, true ) ) {
			$bundle_container_item = WC()->cart->cart_contents[ $bundle_container_item_key ];

			$bundle = $bundle_container_item[ 'data' ];

			if ( false === \WC_Product_Bundle::group_mode_has( $bundle->get_group_mode(), 'parent_item' ) ) {
				// Do nothing
			} else {
				return '';
			}
		}

		return $quantity;
	}
}