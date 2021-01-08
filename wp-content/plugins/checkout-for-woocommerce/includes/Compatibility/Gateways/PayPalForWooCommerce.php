<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Gateways;

use Closure;
use Objectiv\Plugins\Checkout\Compatibility\Base;
use Objectiv\Plugins\Checkout\Main;

class PayPalForWooCommerce extends Base {

	private $_CompatibilityManager;

	public function __construct( $CompatibilityManager ) {
		parent::__construct();

		$this->_CompatibilityManager = $CompatibilityManager;
	}

	public function is_available() {
		return class_exists( '\\Angelleye_PayPal_Express_Checkout_Helper' );
	}

	function typescript_class_and_params( $compatibility ) {
		$compatibility[] = [
			'class'  => 'PayPalForWooCommerce',
			'params' => [],
		];

		return $compatibility;
	}

	public function run() {
		if ( version_compare( VERSION_PFW, '1.5.7', '>=' ) ) {
			$Angelleye_PayPal_Express_Checkout_Helper = \Angelleye_PayPal_Express_Checkout_Helper::instance();

			if ( $Angelleye_PayPal_Express_Checkout_Helper->enabled == 'no' ) {
				return;
			}

			add_filter( 'angelleye_ec_checkout_page_buy_now_nutton', array( $this, 'modify_payment_button_output' ), 10, 1 );

			if ( ! empty( $Angelleye_PayPal_Express_Checkout_Helper ) && ! empty($Angelleye_PayPal_Express_Checkout_Helper->show_on_checkout) && ( $Angelleye_PayPal_Express_Checkout_Helper->show_on_checkout == 'top' || $Angelleye_PayPal_Express_Checkout_Helper->show_on_checkout == 'both' ) ) {
				add_action( 'cfw_payment_request_buttons', array( $this, 'add_paypal_express_to_checkout' ) );
			}

			// Remove top of checkout message
			remove_action( 'woocommerce_before_checkout_form', array( $Angelleye_PayPal_Express_Checkout_Helper, 'checkout_message' ), 5 );

			if ( $Angelleye_PayPal_Express_Checkout_Helper->function_helper->ec_is_express_checkout() ) {
				wc_maybe_define_constant( 'CFW_PAYMENT_BUTTON_SEPARATOR', true );
				
				// Hide customer info tab
				add_filter( 'cfw_show_customer_information_tab', '__return_false' );

				// Hide shipping method tab
				add_filter( 'cfw_show_shipping_tab', '__return_false' );

				// Remove Breadcrumbs
				remove_action( 'cfw_checkout_before_order_review', 'cfw_breadcrumb_navigation', 10 );

				// Unhook Customer Information Tab Pieces
				remove_action( 'cfw_checkout_customer_info_tab', 'cfw_payment_request_buttons', 10 );
				remove_action( 'cfw_checkout_customer_info_tab', 'cfw_customer_info_tab_heading', 20 );
				remove_action( 'cfw_checkout_customer_info_tab', 'cfw_customer_info_tab_login', 30 );
				remove_action( 'cfw_checkout_customer_info_tab', 'cfw_customer_info_address', 40 );
				remove_action( 'cfw_checkout_customer_info_tab', 'cfw_customer_info_tab_nav', 50 );

				// Unhook Shipping Method Tab pieces
				remove_action( 'cfw_checkout_shipping_method_tab', 'cfw_shipping_method_address_review', 10 );
				remove_action( 'cfw_checkout_shipping_method_tab', 'cfw_shipping_methods', 20 );
				remove_action( 'cfw_checkout_shipping_method_tab', 'cfw_shipping_method_tab_nav', 30 );

				// Remove Billing Address from payment tab
				remove_action('woocommerce_before_checkout_billing_form', array( $Angelleye_PayPal_Express_Checkout_Helper, 'ec_formatted_billing_address' ), 9);

				/**
				 * Now set back up the payment tab the way we want it.
				 */
				// Add hidden field for billing email
				add_action( 'cfw_checkout_payment_method_tab', array( $this, 'hidden_email_field' ) );

				// Add heading
				add_action( 'cfw_checkout_payment_method_tab', function() use( $Angelleye_PayPal_Express_Checkout_Helper ) {
					echo '<h1>' . $Angelleye_PayPal_Express_Checkout_Helper->review_title_page . '</h1>';
				}, 5 );

				if ( WC()->cart->needs_shipping() ) {
					// Remove extra heading
					remove_all_actions( 'cfw_checkout_before_shipping_address' );

					// Add shipping address
					add_action( 'cfw_checkout_payment_method_tab', 'cfw_customer_info_address', 6 );

					// Shipping methods
					add_action( 'cfw_checkout_payment_method_tab', function() {
						cfw_shipping_methods( true );
					}, 7 );
				}

				// Add style overrides
				add_action( 'cfw_checkout_payment_method_tab', function() {
					?>
                    <style type="text/css">
						#cfw-payment-action {
							display: block;
						}
						
                        #cfw-payment-method {
                            display: block !important;
							opacity: 1 !important;
                        }

                        #cfw-place-order {
                            display: flex;
                            align-items: center;
                            justify-content: space-between;
                        }
                        .angelleye_cancel {
                            float: none !important;
                        }
                        .angelleye_smart_button_checkout_bottom {
                            display: none !important;
                        }

                        #place_order {
                            display: block !important;
                        }

						.cfw-billing-address-heading, #cfw-shipping-same-billing {
							display: none !important;
						}

						.cfw-return-to-shipping-btn {
							display: none;
						}
                    </style>
					<?php
				}, 100 );
			}
		}
	}

	function modify_payment_button_output( $button_output ) {
		$content_strings_to_remove = [
			'<div style="clear:both; margin-bottom:10px;"></div>',
			'<div class="clear"></div>',
		];

		// Remove unwanted strings
		foreach ( $content_strings_to_remove as $content_str ) {
			$button_output = str_replace( $content_str, '', $button_output );
		}

		return $button_output;
	}

	function add_paypal_express_to_checkout() {
		// This is required because it's used down below in anonymous functions
		global $Angelleye_PayPal_Express_Checkout_Helper;

		if ( Main::is_checkout() ) {
			$Angelleye_PayPal_Express_Checkout_Helper = \Angelleye_PayPal_Express_Checkout_Helper::instance();

			add_action(
				'cfw_checkout_after_payment_methods', function () {
				global $Angelleye_PayPal_Express_Checkout_Helper;

				echo '<p class="paypal-cancel-wrapper">' . $Angelleye_PayPal_Express_Checkout_Helper->angelleye_woocommerce_order_button_html( '' ) . '</p>';
			}
			);

			$Angelleye_PayPal_Express_Checkout_Helper->checkout_message();

			if ( empty( $Angelleye_PayPal_Express_Checkout_Helper ) ) {
				return;
			}

			if ( ! $Angelleye_PayPal_Express_Checkout_Helper->function_helper->ec_is_express_checkout() ) {
				add_action( 'cfw_checkout_customer_info_tab', array( $this, 'add_separator' ), 11 );
			} else {
				add_action( 'cfw_checkout_before_customer_info_tab', array( $this, 'add_notice' ), 10 );
			}
		}
	}

	function add_notice() {
		?>
        <div class="woocommerce-info">
			<?php _e( 'Logged in with PayPal. Please continue your order below.', 'checkout-wc' ); ?>
        </div>
		<?php
	}

	function hidden_email_field() {
	    ob_start();

	    do_action( 'woocommerce_checkout_billing' );

	    ob_get_clean();

	    $billing_fields        = WC()->checkout()->get_checkout_fields( 'billing' );
		$email_field           = $billing_fields['billing_email'];

		$Angelleye_PayPal_Express_Checkout_Helper = \Angelleye_PayPal_Express_Checkout_Helper::instance();
		$shipping_details                         = $Angelleye_PayPal_Express_Checkout_Helper->ec_get_session_data('shipping_details');
		$email                                    = WC()->checkout->get_value('billing_email');

		if ( empty( $email ) ) {
			$email = ! empty($shipping_details['email']) ? $shipping_details['email'] : '';
		}

		echo '<div style="display: none;">';
		cfw_form_field( 'billing_email', $email_field, $email );
		echo '</div>';
	}
}
