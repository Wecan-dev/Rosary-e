<?php

namespace Objectiv\Plugins\Checkout\Action;

class UpdateCheckoutAction extends CFWAction {

	public function __construct( $id, $no_privilege, $action_prefix ) {
		parent::__construct( $id, $no_privilege, $action_prefix );
	}

	public function action() {
		check_ajax_referer( 'update-order-review', 'security' );
		
		\WC_Checkout::instance();
		wc_maybe_define_constant( 'WOOCOMMERCE_CHECKOUT', true );

		do_action( 'woocommerce_checkout_update_order_review', $_POST['post_data'] );
		do_action( 'cfw_checkout_update_order_review' );

		$chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' );

		if ( isset( $_POST['shipping_method'] ) && is_array( $_POST['shipping_method'] ) ) {
			foreach ( $_POST['shipping_method'] as $i => $value ) {
				$chosen_shipping_methods[ $i ] = wc_clean( $value );
			}
		}

		$redirect = apply_filters( 'cfw_update_checkout_redirect', false );

		WC()->session->set( 'chosen_shipping_methods', $chosen_shipping_methods );
		WC()->session->set( 'chosen_payment_method', empty( $_POST['payment_method'] ) ? '' : $_POST['payment_method'] );
		WC()->customer->set_props(
			array(
				'billing_country'   => isset( $_POST['billing_country'] ) ? wc_clean( wp_unslash( $_POST['billing_country'] ) ) : null,
				'billing_state'     => isset( $_POST['billing_state'] ) ? wc_clean( wp_unslash( $_POST['billing_state'] ) ) : null,
				'billing_postcode'  => isset( $_POST['billing_postcode'] ) ? trim( wc_clean( wp_unslash( $_POST['billing_postcode'] ) ) ) : null,
				'billing_city'      => isset( $_POST['billing_city'] ) ? wc_clean( wp_unslash( $_POST['billing_city'] ) ) : null,
				'billing_address_1' => isset( $_POST['billing_address_1'] ) ? wc_clean( wp_unslash( $_POST['billing_address_1'] ) ) : null,
				'billing_address_2' => isset( $_POST['billing_address_2'] ) ? wc_clean( wp_unslash( $_POST['billing_address_2'] ) ) : null,
			)
		);

		if ( wc_ship_to_billing_address_only() || ! WC()->cart->needs_shipping() ) {
			WC()->customer->set_props(
				array(
					'shipping_country'   => isset( $_POST['billing_country'] ) ? wc_clean( wp_unslash( $_POST['billing_country'] ) ) : null,
					'shipping_state'     => isset( $_POST['billing_state'] ) ? wc_clean( wp_unslash( $_POST['billing_state'] ) ) : null,
					'shipping_postcode'  => isset( $_POST['billing_postcode'] ) ? trim( wc_clean( wp_unslash( $_POST['billing_postcode'] ) ) ) : null,
					'shipping_city'      => isset( $_POST['billing_city'] ) ? wc_clean( wp_unslash( $_POST['billing_city'] ) ) : null,
					'shipping_address_1' => isset( $_POST['billing_address_1'] ) ? wc_clean( wp_unslash( $_POST['billing_address_1'] ) ) : null,
					'shipping_address_2' => isset( $_POST['billing_address_2'] ) ? wc_clean( wp_unslash( $_POST['billing_address_2'] ) ) : null,
				)
			);
		} else {
			WC()->customer->set_props(
				array(
					'shipping_country'   => isset( $_POST['shipping_country'] ) ? wc_clean( wp_unslash( $_POST['shipping_country'] ) ) : null,
					'shipping_state'     => isset( $_POST['shipping_state'] ) ? wc_clean( wp_unslash( $_POST['shipping_state'] ) ) : null,
					'shipping_postcode'  => isset( $_POST['shipping_postcode'] ) ? trim( wc_clean( wp_unslash( $_POST['shipping_postcode'] ) ) ) : null,
					'shipping_city'      => isset( $_POST['shipping_city'] ) ? wc_clean( wp_unslash( $_POST['shipping_city'] ) ) : null,
					'shipping_address_1' => isset( $_POST['shipping_address_1'] ) ? wc_clean( wp_unslash( $_POST['shipping_address_1'] ) ) : null,
					'shipping_address_2' => isset( $_POST['shipping_address_2'] ) ? wc_clean( wp_unslash( $_POST['shipping_address_2'] ) ) : null,
				)
			);
		}

		if ( isset( $_POST['has_full_address'] ) && wc_string_to_bool( wc_clean( wp_unslash( $_POST['has_full_address'] ) ) ) ) {
			WC()->customer->set_calculated_shipping( true );
		} else {
			WC()->customer->set_calculated_shipping( false );
		}

		WC()->customer->save();

		// Calculate shipping before totals. This will ensure any shipping methods that affect things like taxes are chosen prior to final totals being calculated. Ref: #22708.
		WC()->cart->calculate_shipping();
		WC()->cart->calculate_totals();

		unset( WC()->session->refresh_totals, WC()->session->reload_checkout );

		$updated_payment_methods = apply_filters( 'cfw_update_payment_methods', cfw_get_payment_methods( false, false, true, false ) );

		do_action( 'woocommerce_check_cart_items' );

		/**
		 * Validate Postcode
		 */
		$checkout_fieldsets = WC()->checkout()->get_checkout_fields();
		$checkout_fields = array_merge( $checkout_fieldsets['billing'], $checkout_fieldsets['shipping'] );
		$postcode_fields = array(
			'shipping_postcode' => 'shipping_country',
		);

		if ( ! empty($_POST['bill_to_different_address']) && $_POST['bill_to_different_address'] !== 'same_as_shipping' ) {
			$postcode_fields['billing_postcode'] = 'billing_country';
		}

		foreach( $postcode_fields as $postcode_field => $country_field ) {
			if ( ! empty( $_POST[ $postcode_field ] ) && ! empty( $_POST[ $country_field ] ) ) {
				if ( ! \WC_Validation::is_postcode( trim( $_POST[ $postcode_field ] ), $_POST[ $country_field ] ) ) {
					$field_label = $checkout_fields[ $postcode_field ]['label'];

					if ( stripos( $postcode_field, 'shipping_' ) !== false ) {
						$field_label = sprintf( cfw_x( 'Shipping %s', 'checkout-validation', 'woocommerce' ), $field_label );
					} else {
						$field_label = sprintf( cfw_x( 'Billing %s', 'checkout-validation', 'woocommerce' ), $field_label );
					}

					switch ( $_POST[ $country_field ] ) {
						case 'IE':
							/* translators: %1$s: field name, %2$s finder.eircode.ie URL */
							$postcode_validation_notice = sprintf( cfw__( '%1$s is not valid. You can look up the correct Eircode <a target="_blank" href="%2$s">here</a>.', 'woocommerce' ), '<strong>' . esc_html( $field_label ) . '</strong>', 'https://finder.eircode.ie' );
							break;
						default:
							/* translators: %s: field name */
							$postcode_validation_notice = sprintf( cfw__( '%s is not a valid postcode / ZIP.', 'woocommerce' ), '<strong>' . esc_html( $field_label ) . '</strong>' );
					}

					wc_add_notice( $postcode_validation_notice, 'error' );
				}
			}
		}

		/**
		 * Set notices
		 */
		$all_notices  = WC()->session->get( 'wc_notices', array() );

		// Filter out empty messages
		foreach( $all_notices as $key => $notice ) {
			if ( empty( array_filter( $notice ) ) ) {
				unset( $all_notices[ $key ] );
			}
		}

		$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );
		$notices      = [];

		foreach ( $notice_types as $notice_type ) {
			if ( wc_notice_count( $notice_type ) > 0 && isset( $all_notices[ $notice_type ] ) ) {
				$notices[ $notice_type ] = [];

				// In WooCommerce 3.9+, messages can be an array with two properties:
				// - notice
				// - data
				foreach ( $all_notices[ $notice_type ] as $notice ) {
					$notices[ $notice_type ][] = $notice['notice'] ?? $notice;
				}
			}
		}

		wc_clear_notices();

		// Chosen shipping methods
		$chosen_shipping_methods_labels = array();

		$packages = WC()->shipping->get_packages();

		foreach ( $packages as $i => $package ) {
			$chosen_method = WC()->session->get( 'chosen_shipping_methods' )[ $i ] ?? false;

			if ( $chosen_method ) {
				$available_methods    = $package['rates'];

				$chosen_shipping_methods_labels[] = $available_methods[ $chosen_method ]->get_label();
			}
		}

		$chosen_shipping_methods_labels = apply_filters( 'cfw_payment_method_address_review_shipping_method', $chosen_shipping_methods_labels );

		$this->out(
			array(
				'needs_payment'           => WC()->cart->needs_payment(),
				'fragments'               => apply_filters(
					'woocommerce_update_order_review_fragments', array(
						'#cfw-shipping-method-address-review-address'        => '<div class="shipping-details-content" id="cfw-shipping-method-address-review-address">' . cfw_get_shipping_details( WC()->checkout() ) . '</div>',
						'#cfw-shipping-method-address-review-contact'        => '<div class="shipping-details-content" id="cfw-shipping-method-address-review-contact">' . WC()->checkout()->get_value( 'billing_email' ) . '</div>',
						'#cfw-payment-method-address-review-address'         => '<div class="shipping-details-content" id="cfw-payment-method-address-review-address">' . cfw_get_shipping_details( WC()->checkout() ) . '</div>',
						'#cfw-payment-method-address-review-contact'         => '<div class="shipping-details-content" id="cfw-payment-method-address-review-contact">' . WC()->checkout()->get_value( 'billing_email' ) . '</div>',
						'#cfw-payment-method-address-review-shipping-method' => '<div class="shipping-details-content" id="cfw-payment-method-address-review-shipping-method">' . join( ', ', $chosen_shipping_methods_labels ) . '</div>',
						'#shipping_method'                                   => '<div class="shipping-details-content" id="shipping_method">' . cfw_get_shipping_methods_html() . '</div>',
						'#cfw-checkout-before-order-review'                  => $this->get_action_output( 'woocommerce_checkout_before_order_review', 'cfw-checkout-before-order-review' ),
						'#cfw-checkout-after-order-review'                   => $this->get_action_output( 'woocommerce_checkout_after_order_review', 'cfw-checkout-after-order-review' ),
						'#cfw-place-order'                                   => cfw_get_place_order(),
						'#cfw-totals-list'                                   => cfw_get_totals_html(),
						'#cfw-cart'                                          => cfw_get_cart_html(),
						'#cfw-mobile-total'                                  => '<span id="cfw-mobile-total" class="total amount">' . WC()->cart->get_total() . '</span>',
						'#cfw-billing-methods'                              => $updated_payment_methods,
					)
				),
				'redirect'                => $redirect,
				'notices'                 => $notices,
				'show_shipping_tab'       => cfw_show_shipping_tab(),
			)
		);
	}

	function get_action_output( $action, $container = '' ) {
		ob_start();

		echo '<div id="' . $container . '">';
		do_action( $action );
		echo '</div>';

		return ob_get_clean();
	}
}
