<?php

/**
 * Takes a callable and excutes it, then returns the content inside
 * a row / max width column
 *
 * @param callback $callable
 */
function cfw_auto_wrap( $callable ) {
	if ( is_callable( $callable ) ) {
		ob_start();

		call_user_func( $callable );

		$func_output = ob_get_clean();

		if ( ! empty( $func_output ) ) {
			$output  = '<div class="row">';
			$output .= '<div class="col-12">';

			$output .= $func_output;

			$output .= '</div>';
			$output .= '</div>';

			echo $output;
		}
	}
}

/**
 * Thank you page section wrap open
 *
 * @param $class
 */
function cfw_thank_you_section_start( $class ) {
    echo "<section class=\"{$class}\">";
}

/**
 * Thank you page section wrapper
 *
 * @param callable $callable
 * @param $class
 * @param array $parameters
 */
function cfw_thank_you_section_auto_wrap( $callable, $class, $parameters = array() ) {
    if ( is_callable( $callable ) ) {
		ob_start();

		call_user_func( $callable, ...$parameters );

		$func_output = ob_get_clean();

		if ( ! empty( $func_output ) ) {
			$output  = "<section class=\"{$class}\">";
			$output .= '<div class="inner">';

			$output .= $func_output;

			$output .= '</div>';
			$output .= '</section>';

			echo $output;
		}
	}
}

/**
 * The mobile cart summary header
 *
 * Includes cart total and button to expand the cart summary
 *
 * @param bool $total
 */
function cfw_cart_summary_mobile_header( $total = false ) {
	?>
	<div id="cfw-mobile-cart-header">
		<div>
			<a id="cfw-expand-cart">
				<span class="cfw-cart-icon">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
				</span>

                <span class="cfw-cart-summary-label-show cfw-small">
                	<span>
						<?php if ( ! empty( $cart_summary_mobile_label = cfw_get_main()->get_settings_manager()->get_setting( 'cart_summary_mobile_label' ) ) ) : ?>
							<?php echo $cart_summary_mobile_label; ?>
						<?php else : ?>
							<?php echo apply_filters( 'cfw_show_order_summary_link_text', esc_html__( 'Show order summary', 'checkout-wc' ) ); ?>
						<?php endif; ?>
                    </span>

                    <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="cfw-arrow" fill="#000"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path></svg>
                </span>

                <span class="cfw-cart-summary-label-hide cfw-small">
                    <span>
                    	<?php echo apply_filters( 'cfw_show_order_summary_hide_link_text', esc_html__( 'Hide order summary', 'checkout-wc' ) ); ?>
					</span>

                    <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="cfw-arrow" fill="#000"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path></svg>
                </span>

				<span id="cfw-mobile-total" class="total amount">
                	<?php echo empty( $total ) ? WC()->cart->get_total() : $total; ?>
            	</span>
			</a>
		</div>
	</div>
	<?php
}

/**
 * Helper function to output a close div tag
 */
function cfw_close_cart_summary_div() {
    do_action( 'cfw_after_cart_summary' );
	?>
	</div>
	<?php
}

/**
 * The opening div tag for the cart summary content
 */
function cfw_cart_summary_content_open_wrap() {
	?>
	<div id="cfw-cart-summary-content">
	<?php
}

/**
 * Handles WooCommerce before order review hooks
 *
 * This hook is in a different place on our checkout so
 * we have to wrap it with an ID and apply styles similar to native
 */
function cfw_cart_summary_before_order_review() {
	?>
	<div id="cfw-checkout-before-order-review">
        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
    </div>
	<?php
}

/**
 * Handles WooCommerce after order review hooks
 *
 * This hook is in a different place on our checkout so
 * we have to wrap it with an ID and apply styles similar to native
 */
function cfw_cart_summary_after_order_review() {
	?>
	<div id="cfw-checkout-after-order-review">
        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </div>
	<?php
}

/**
 * Print WooCommerce notices with placeholder div for JS behaviors
 */
function cfw_wc_print_notices() {
	$all_notices  = WC()->session->get( 'wc_notices', array() );
	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );
	$notices      = [];

	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			$notices[ $notice_type ] = $all_notices[ $notice_type ];
		}
	}

	$type_class_mapping = array(
		'error'   => 'cfw-alert-error',
		'notice'  => 'cfw-alert-info',
		'success' => 'cfw-alert-success',
	);

	$used_alert_ids = [];

	wc_clear_notices();

	// DO NOT REMOVE PLACEHOLDER BELOW
	// It is a template for new alerts
	?>
	<div id="cfw-alert-placeholder">
		<div class="cfw-alert">
			<div class="message"></div>
		</div>
	</div>

	<div id="cfw-alert-container">
		<?php if ( ! empty( $notices ) ) : ?>
			<?php foreach ( $notices as $type => $messages ) : ?>
				<?php
				foreach ( $messages as $message ) :
					$alert_id = md5( $message . $type_class_mapping[ $type ] . $type );
					?>
					<?php
					if ( in_array( $alert_id, $used_alert_ids ) || empty( $message ) ) {
						continue;
					}
					?>

					<?php $used_alert_ids[] = $alert_id; ?>
					<div class="cfw-alert <?php echo $type_class_mapping[ $type ]; ?> cfw-alert-<?php echo $alert_id; ?>">
						<div class="message">
                            <?php
                            // In WooCommerce 3.9+, messages can be an array with two properties:
                            // - notice
                            // - data
                            echo isset( $message['notice'] ) ? $message['notice'] : $message;
                            ?>
                        </div>
					</div>
				<?php endforeach; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<?php
}

/**
 * Notices with wrap
 */
function cfw_wc_print_notices_with_wrap() {
	cfw_auto_wrap( 'cfw_wc_print_notices' );
}

/**
 * Payment Request buttons (aka Express Checkout)
 */
function cfw_payment_request_buttons() {
    if ( ! has_action( 'cfw_payment_request_buttons' ) ) {
    	return;
    }
	?>
	<div id="cfw-payment-request-buttons">
        <h2><?php _e('Express checkout', 'checkout-wc' ); ?></h2>
		<?php do_action( 'cfw_payment_request_buttons' ); ?>
	</div>
	<?php
}

/**
 * Customer information tab heading
 */
function cfw_customer_info_tab_heading() {
	?>
	<h3>
		<?php echo apply_filters( 'cfw_customer_information_heading', __( 'Information', 'checkout-wc' ) ); ?>
	</h3>
	<?php
}

/**
 * Customer information tab login area
 *
 * Includes billing_email, optional password field, and create account checkbox
 */
function cfw_customer_info_tab_login() {
	$billing_fields        = WC()->checkout()->get_checkout_fields( 'billing' );
	$email_field           = $billing_fields['billing_email'];
	$enable_enhanced_login = 'yes' === get_option( 'woocommerce_enable_checkout_login_reminder' ) && apply_filters( 'cfw_suppress_default_login_form', cfw_get_main()->get_settings_manager()->get_setting( 'login_style' ) !== 'woocommerce' );
	?>
	<div id="cfw-login-details" class="cfw-module">
		<?php do_action( 'cfw_before_customer_info_tab_login' ); ?>

		<?php if ( ! is_user_logged_in() ) : ?>
			<?php if ( $enable_enhanced_login ) : ?>
				<div class="cfw-have-acc-text cfw-small">
					<?php do_action( 'cfw_before_enhanced_login_prompt' ); ?>

					<span>
						<?php echo apply_filters( 'cfw_already_have_account_text', esc_html__( 'Already have an account with us?', 'checkout-wc' ) ); ?>
					</span>

					<a id="cfw-ci-login" href="javascript:;">
						<?php echo apply_filters( 'cfw_login_faster_text', esc_html__( 'Log in for a faster checkout experience.', 'checkout-wc' ) ); ?>
					</a>

					<?php do_action( 'cfw_after_enhanced_login_prompt' ); ?>
				</div>
			<?php endif; ?>

			<div class="cfw-input-container">
                <div class="cfw-input-wrap-row">
				    <?php cfw_form_field( 'billing_email', $email_field, WC()->checkout()->get_value( 'billing_email' ) ); ?>
                </div>

				<?php do_action( 'cfw_checkout_after_email' ); ?>

                <?php if ( $enable_enhanced_login ): ?>
                    <div id="cfw-login-slide">
                        <div class="cfw-input-wrap-row">
                            <div id="cfw-password-wrap" class="cfw-input-wrap cfw-password-input">
                                <label for="cfw-password"><?php esc_html_e( 'Password', 'checkout-wc' ); ?></label>
                                <input type="password" name="cfw-password" id="cfw-password" autocomplete="off" title="<?php esc_attr_e( 'Password', 'checkout-wc' ); ?>" placeholder="<?php esc_attr_e( 'Password', 'checkout-wc' ); ?>">
                            </div>
                        </div>

                        <div class="cfw-input-wrap-row">
                            <div class="cfw-input-wrap cfw-button-input">
                                <input type="button" name="cfw-login-btn" id="cfw-login-btn" value="<?php esc_attr_e( 'Login', 'checkout-wc' ); ?>" />
                                <?php if ( ! WC()->checkout()->is_registration_required() ) : ?>
                                    <span class="login-optional cfw-small">
                                        <?php echo apply_filters( 'cfw_login_optional_text', esc_html__( 'Login is optional. You may continue with your order below.', 'checkout-wc' ) ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div id="cfw-account-password-slide" class="cfw-input-wrap-row">
					<?php
					if ( ! apply_filters( 'cfw_registration_generate_password', cfw_get_main()->get_settings_manager()->get_setting( 'registration_style' ) !== 'woocommerce' ) ) :
						cfw_form_field(
							'account_password', array(
								'type'              => 'password',
								'label'             => cfw__( 'Create account password', 'woocommerce' ),
								'required'          => true,
								'placeholder'       => cfw__( 'Create account password', 'woocommerce' ),
								'custom_attributes' => array(
									'data-parsley-trigger' => 'keyup change focusout',
									'data-parsley-group'   => 'account',
								),
							)
						);
					endif;
					?>
                </div>

				<div class="cfw-input-wrap cfw-check-input">
					<?php if ( ! WC()->checkout()->is_registration_required() && WC()->checkout()->is_registration_enabled() ) : ?>
						<input type="checkbox" id="createaccount" class="garlic-auto-save" name="createaccount" />
						<label class="cfw-small" for="createaccount"><?php printf( apply_filters( 'cfw_create_account_checkbox_label', esc_html__( 'Create %s shopping account.', 'checkout-wc' ) ), apply_filters( 'cfw_create_account_site_name', get_bloginfo( 'name' ) ) ); ?></label>
					<?php elseif ( WC()->checkout()->is_registration_required() ) : ?>
						<span class="cfw-small"><?php echo apply_filters( 'cfw_account_creation_statement', esc_html__( 'If you do not have an account, we will create one for you.', 'checkout-wc' ) ); ?></span>
					<?php endif; ?>
				</div>
			</div>

			<?php do_action( 'cfw_checkout_after_login' ); ?>
		<?php else : ?>
			<input type="hidden" name="billing_email" id="billing_email" value="<?php echo WC()->checkout()->get_value( 'billing_email' ); ?>">

			<div class="cfw-have-acc-text cfw-small">
				<?php printf( esc_html__( 'Welcome back, %1$s (%2$s).', 'checkout-wc' ), '<strong>' . apply_filters( 'cfw_welcome_back_name', wp_get_current_user()->display_name ) . '</strong>', apply_filters( 'cfw_welcome_back_email', wp_get_current_user()->user_email ) ); ?>

				<?php if ( apply_filters( 'cfw_show_logout_link', false ) ) : ?>
					<a href="<?php echo wp_logout_url( wc_get_checkout_url() ); ?>"><?php _e( 'Log out.', 'checkout-wc' ); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php do_action( 'cfw_after_customer_info_tab_login' ); ?>
	</div>
	<?php
}

/**
 * The address displayed on the Customer Info tab
 */
function cfw_customer_info_address() {
	do_action( 'cfw_checkout_before_customer_info_address' );
	?>

	<div id="cfw-shipping-info" class="cfw-module">
		<?php do_action( sprintf( 'cfw_checkout_before_%s_address', WC()->cart->needs_shipping() ? 'shipping' : 'billing' ) ); ?>

		<h3>
			<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
				<?php echo apply_filters( 'cfw_billing_shipping_address_heading', esc_html__( 'Billing and Shipping address', 'checkout-wc' ) ); ?>
			<?php elseif ( ! WC()->cart->needs_shipping() ) : ?>
				<?php echo apply_filters( 'cfw_billing_address_heading', esc_html__( 'Billing address', 'checkout-wc' ) ); ?>
			<?php else : ?>
				<?php echo apply_filters( 'cfw_shipping_address_heading', esc_html__( 'Shipping address', 'checkout-wc' ) ); ?>
			<?php endif; ?>
		</h3>

		<?php do_action( 'cfw_after_customer_info_address_heading' ); ?>

		<div class="cfw-shipping-info-container cfw-parsley-shipping-details <?php cfw_address_class_wrap( WC()->cart->needs_shipping() ); ?>">
			<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>
				<?php cfw_get_billing_checkout_fields( WC()->checkout() ); ?>
			<?php else : ?>
				<?php cfw_get_shipping_checkout_fields( WC()->checkout() ); ?>
			<?php endif; ?>
		</div>

		<?php do_action( sprintf( 'cfw_checkout_after_%s_address', WC()->cart->needs_shipping() ? 'shipping' : 'billing' ) ); ?>
	</div>

	<?php
	do_action( 'cfw_checkout_after_customer_info_address' );
}

/**
 * @return bool
 */
function cfw_show_shipping_tab() {
    return apply_filters( 'cfw_show_shipping_tab', WC()->cart->needs_shipping() && cfw_get_main()->get_settings_manager()->get_setting( 'skip_shipping_step' ) !== 'yes' ) === true;
}

/**
 * @return bool
 */
function cfw_show_shipping_total() {
    return apply_filters( 'cfw_show_shipping_total', WC()->cart->needs_shipping() && WC()->cart->show_shipping() && count( WC()->shipping()->get_packages() ) > 0 ) === true;
}

/**
 * Customer information tab nav
 *
 * Includes return to cart and next tab buttons
 */
function cfw_customer_info_tab_nav() {
	do_action( 'cfw_checkout_before_customer_info_tab_nav' );
	?>

	<div id="cfw-shipping-info-action" class="cfw-bottom-controls">
		<div class="previous-button">
			<?php cfw_return_to_cart_link(); ?>
		</div>

		<?php cfw_continue_to_shipping_button(); ?>
		<?php cfw_continue_to_payment_button(); ?>
	</div>

	<?php
	do_action( 'cfw_checkout_after_customer_info_tab_nav' );
}

/**
 * Shipping method tab address review section
 */
function cfw_shipping_method_address_review() {
	if ( ! wc_ship_to_billing_address_only() ) {
		$ship_to_label = apply_filters( 'cfw_ship_to_label', __( 'Ship to', 'checkout-wc' ) );
	} else {
		$ship_to_label = cfw__( 'Address', 'woocommerce' );
	}

	$long_class = '';

	if ( strlen( $ship_to_label ) > 9 ) {
	    $long_class = ' shipping-details-label-long';
    }
	?>
	<ul id="cfw-shipping-method-address-review" class="cfw-module">
        <li>
            <div class="col-10 inner">
                <div role="rowheader" class="shipping-details-label<?php echo $long_class; ?>">
		            <?php _e( 'Contact', 'checkout-wc' ); ?>
                </div>

                <div role="cell" class="shipping-details-content" id="cfw-shipping-method-address-review-contact"></div>
            </div>

            <div role="cell" class="col-2 shipping-details-link">
				<?php if ( ! is_user_logged_in() ): ?>
                	<a href="javascript:;" data-tab="#cfw-customer-info" class="cfw-tab-link cfw-small"><?php esc_html_e( 'Change', 'checkout-wc' ); ?></a>
				<?php endif; ?>
            </div>
        </li>

        <?php if ( WC()->cart->needs_shipping() ): ?>
            <li>
                <div class="col-10 inner">
                    <div role="rowheader" class="shipping-details-label<?php echo $long_class; ?>">
                        <?php echo $ship_to_label; ?>
                    </div>

                    <div role="cell" class="shipping-details-content" id="cfw-shipping-method-address-review-address"></div>
                </div>

                <div role="cell" class="col-2 shipping-details-link">
                    <a href="javascript:;" data-tab="#cfw-customer-info" class="cfw-tab-link cfw-small"><?php esc_html_e( 'Change', 'checkout-wc' ); ?></a>
                </div>
            </li>
        <?php endif; ?>
	</ul>
	<?php
}

/**
 * Payment method tab address review section
 */
function cfw_payment_method_address_review() {
	if ( ! wc_ship_to_billing_address_only() ) {
		$ship_to_label = apply_filters( 'cfw_ship_to_label', __( 'Ship to', 'checkout-wc' ) );
	} else {
		$ship_to_label = cfw__( 'Address', 'woocommerce' );
	}

	$long_class = '';

	if ( strlen( $ship_to_label ) > 9 ) {
		$long_class = ' shipping-details-label-long';
	}
	?>
    <ul id="cfw-payment-method-address-review" class="cfw-module">
        <li>
            <div class="inner col-10">
                <div role="rowheader" class="shipping-details-label<?php echo $long_class; ?>">
					<?php _e( 'Contact', 'checkout-wc' ); ?>
                </div>

                <div role="cell" class="shipping-details-content" id="cfw-payment-method-address-review-contact"></div>
            </div>

            <div role="cell" class="col-2 shipping-details-link">
				<?php if ( ! is_user_logged_in() ): ?>
                	<a href="javascript:;" data-tab="#cfw-customer-info" class="cfw-tab-link cfw-small"><?php esc_html_e( 'Change', 'checkout-wc' ); ?></a>
				<?php endif; ?>
            </div>
        </li>

	    <?php if ( WC()->cart->needs_shipping() ): ?>
            <li>
                <div class="inner col-10">
                    <div role="rowheader" class="shipping-details-label<?php echo $long_class; ?>">
                        <?php echo $ship_to_label; ?>
                    </div>

                    <div role="cell" class="shipping-details-content" id="cfw-payment-method-address-review-address"></div>
                </div>

                <div role="cell" class="col-2 shipping-details-link">
					<a href="javascript:;" data-tab="#cfw-customer-info" class="cfw-tab-link cfw-small"><?php esc_html_e( 'Change', 'checkout-wc' ); ?></a>
                </div>
            </li>
		<?php endif; ?>

		<li class="shipping-method">
			<div class="inner col-10">
				<div role="rowheader" class="shipping-details-label<?php echo $long_class; ?>">
					<?php _e( 'Method', 'checkout-wc' ); ?>
				</div>

				<div role="cell" class="shipping-details-content" id="cfw-payment-method-address-review-shipping-method"></div>
			</div>

			<div role="cell" class="col-2 shipping-details-link">
				<a href="javascript:;" data-tab="#cfw-shipping-method" class="cfw-tab-link cfw-small"><?php esc_html_e( 'Change', 'checkout-wc' ); ?></a>
			</div>
		</li>
    </ul>
	<?php
}

/**
 * Shipping method tab list of shipping methods
 *
 */
function cfw_shipping_methods() {
	do_action( 'cfw_checkout_before_shipping_methods' );
	?>
	<div id="cfw-shipping-method-list" class="cfw-module">
		<h3>
			<?php echo apply_filters( 'cfw_shipping_method_heading', esc_html__( 'Shipping method', 'checkout-wc' ) ); ?>
		</h3>

		<?php do_action( 'cfw_after_shipping_method_heading' ); ?>

		<div id="shipping_method">
			<?php cfw_shipping_methods_html(); ?>
		</div>
	</div>

	<?php
	do_action( 'cfw_checkout_after_shipping_methods' );
}

/**
 * Shipping method tab navigation
 *
 * Includes previous and next tab buttons
 */
function cfw_shipping_method_tab_nav() {
	do_action( 'cfw_checkout_before_shipping_method_tab_nav' );
	?>

	<div id="cfw-shipping-action" class="cfw-bottom-controls">
		<div class="previous-button">
			<?php cfw_return_to_customer_information_link(); ?>
		</div>

		<?php cfw_continue_to_payment_button(); ?>
	</div>

	<?php
	do_action( 'cfw_checkout_after_shipping_method_tab_nav' );
}

/**
 * Payment method tab payments list
 *
 * Includes payment method tab heading
 *
 * @param bool $available_gateways
 * @param bool $object
 * @param bool $show_title
 */
function cfw_payment_methods( $available_gateways = false, $object = false, $show_title = true ) {
	echo cfw_get_payment_methods( $available_gateways, $object, $show_title );
}

/**
 * Payment method tab billing address radio group
 */
function cfw_payment_tab_content_billing_address() {
	if ( WC()->cart->needs_shipping_address() ) :
		?>
		<h3 class="cfw-billing-address-heading">
			<?php echo apply_filters( 'cfw_billing_address_heading', esc_html__( 'Billing address', 'checkout-wc' ) ); ?>
		</h3>

		<h4 class="cfw-small">
			<?php echo apply_filters( 'cfw_billing_address_description', esc_html__( 'Select the address that matches your card or payment method.', 'checkout-wc' ) ); ?>
		</h4>

		<?php cfw_billing_address_radio_group(); ?>
	<?php endif; ?>

	<?php
	do_action( 'cfw_checkout_after_payment_tab_billing_address' );
}

/**
 * Payment method tab order notes
 *
 * This also handles any custom fields attached to order notes area
 */
function cfw_payment_tab_content_order_notes() {
	?>
	<div id="cfw_additional_fields_container" class="cfw-additional-fields-container">
		<?php do_action( 'woocommerce_before_order_notes', WC()->checkout() ); ?>

		<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', false ) ) : ?>

			<div class="cfw-additional-information">
				<?php foreach ( WC()->checkout()->get_checkout_fields( 'order' ) as $key => $field ) : ?>
					<?php cfw_form_field( $key, $field, WC()->checkout()->get_value( $key ) ); ?>
				<?php endforeach; ?>
			</div>

		<?php endif; ?>

		<div class="clear"></div>

		<?php do_action( 'woocommerce_after_order_notes', WC()->checkout() ); ?>
	</div>
	<?php
}

/**
 * Payment method tab terms and conditions
 */
function cfw_payment_tab_content_terms_and_conditions() {
	do_action( 'cfw_checkout_before_payment_method_terms_checkbox' );

	wc_get_template( 'checkout/terms.php' );
}

/**
 * Payment method tab nav
 *
 * Includes previous tab and place order buttons
 *
 * @param bool $show_cart_return_link
 */
function cfw_payment_tab_nav( $show_cart_return_link = false ) {
	do_action( 'cfw_checkout_before_payment_method_tab_nav' );
	do_action( 'woocommerce_review_order_before_submit' );
	?>

	<div id="cfw-payment-action" class="cfw-bottom-controls">
		<div class="previous-button">
			<?php if ( $show_cart_return_link ): ?>
				<?php cfw_return_to_cart_link(); ?>
			<?php elseif ( apply_filters( 'cfw_show_customer_information_tab', true ) ) : ?>
				<?php cfw_return_to_customer_information_link(); ?>
			<?php endif; ?>

			<?php cfw_return_to_shipping_method_link(); ?>
		</div>

		<?php do_action( 'cfw_payment_nav_place_order_button' ); ?>
	</div>

	<?php
	do_action( 'cfw_checkout_after_payment_method_tab_nav' );
}

/**
 * Payment method tab nav for one page checkout
 *
 * Includes place order button
 */
function cfw_payment_tab_nav_one_page_checkout() {
	cfw_payment_tab_nav( true );
}

/**
 * Cart list
 */
function cfw_cart_html() {
	echo cfw_get_cart_html();
}

/**
 * Coupon module
 *
 * @param bool $mobile
 */
function cfw_coupon_module( $mobile = false ) {
    do_action( 'cfw_before_coupon_module' );

    $field_id  = $mobile ? 'cfw-promo-code-mobile' : 'cfw-promo-code';
    $button_id = $mobile ? 'cfw-promo-code-btn-mobile' : 'cfw-promo-code-btn';
    ?>
    <div id="<?php echo $mobile ? 'cfw-coupons-mobile' : 'cfw-coupons'; ?>" class="cfw-module">
		<?php if ( wc_coupons_enabled() ) : ?>
			<?php if ( $mobile && apply_filters( 'cfw_hide_promo_code_by_default', cfw_get_main()->get_settings_manager()->get_setting( 'enable_coupon_code_link' ) !== 'yes' ) ): ?>
				<h3><?php echo apply_filters( 'cfw_promo_code_mobile_heading', __( 'Promo code', 'checkout-wc' ) ); ?></h3>
			<?php endif; ?>

			<?php if ( apply_filters( 'cfw_hide_promo_code_by_default', cfw_get_main()->get_settings_manager()->get_setting( 'enable_coupon_code_link' ) == 'yes' ) ): ?>
				<div class="row">
					<div class="col-lg-12 no-gutters cfw-small">
						<a class="cfw-show-coupons-module" href="javascript:"><?php _e( 'Have a promo code? Click here.', 'checkout-wc' ); ?></a>
					</div>
				</div>
			<?php endif; ?>
			<div class="cfw-promo-wrap <?php if ( apply_filters( 'cfw_hide_promo_code_by_default', cfw_get_main()->get_settings_manager()->get_setting( 'enable_coupon_code_link' ) == 'yes' ) ) echo "cfw-hidden"; ?>">
				<div class="row cfw-promo-row cfw-input-wrap-row">
					<div class="col-lg-8 no-gutters">
						<?php
						$output = cfw_form_field(
							$field_id, array(
								'type'        => 'text',
								'required'    => false,
								'label'       => apply_filters( 'cfw_promo_code_label', __( 'Promo Code', 'checkout-wc' ) ),
								'placeholder' => apply_filters( 'cfw_promo_code_placeholder', __( 'Enter Promo Code', 'checkout-wc' ) ),
								'label_class' => 'cfw-input-label',
								'start'       => false,
								'end'         => false,
								'wrap'        => cfw_get_main()->get_form()->input_wrap( 'text', 12, 10 ),
								'return'      => true,
							)
						);

						$output = str_replace( '(' . cfw_esc_html__( 'optional', 'woocommerce' ) . ')', '', $output );

						echo $output;
						?>
					</div>
					<div class="col-lg-4">
						<div class="cfw-input-wrap cfw-button-input">
							<input type="button" name="cfw-promo-code-btn" id="<?php echo $button_id; ?>" class="cfw-secondary-btn" value="<?php echo apply_filters( 'cfw_promo_code_apply_button_label', esc_attr__( 'Apply', 'checkout-wc' ) ); ?>" />
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

        <?php do_action( 'cfw_coupon_module_end', $mobile ); ?>
    </div>
    <?php

	do_action( 'cfw_after_coupon_module' );
}

function cfw_maybe_show_coupon_module() {
	if ( cfw_get_main()->get_settings_manager()->get_setting( 'show_mobile_coupon_field' ) == 'yes' ) {
		cfw_mobile_coupon_module();
	}
}

function cfw_mobile_coupon_module() {
	cfw_coupon_module( true );
}

/**
 * Cart summary totals
 */
function cfw_totals_html() {
	echo cfw_get_totals_html();
}

/**
 * The form attributes
 *
 * @param bool $id
 * @param bool $row
 * @param bool $action
 */
function cfw_form_attributes( $id = false, $row = true, $action = true ) {
    ?>
    id="<?php echo $id ? $id : 'checkout'; ?>" name="<?php echo $id ? $id : 'checkout'; ?>" class="cfw-customer-info-active <?php if( $id !== 'order_review' ) echo 'woocommerce-checkout checkout'; ?><?php echo $row ? ' row' : ''; ?>" method="POST" formnovalidate="" data-parsley-focus="first" enctype="multipart/form-data" <?php if( $action ): ?>action="<?php echo esc_url( wc_get_checkout_url() ); ?>"<?php endif; ?>
    <?php
}

/**
 * Shipping method tab container style attribute
 */
function cfw_shipping_method_tab_style_attribute() {
    ?>
    style=""
    <?php
}

function cfw_customer_info_tab_style_attribute() {
    ?>
    style="<?php echo ( ! apply_filters( 'cfw_show_customer_information_tab', true ) ) ? 'display: none' : ''; ?>"
    <?php
}

/**
 * Render title with order number, checkbox graphic, and thank you statement.
 *
 * @param WC_Order $order
 */
function cfw_thank_you_title( $order ) {
    ?>
    <div class="title">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" fill="none" stroke-width="2" class="cfw-checkmark"><path class="checkmark__circle" d="M25 49c13.255 0 24-10.745 24-24S38.255 1 25 1 1 11.745 1 25s10.745 24 24 24z"></path><path class="checkmark__check" d="M15 24.51l7.307 7.308L35.125 19"></path></svg>
        <h5><?php echo sprintf( apply_filters( 'cfw_thank_you_title', __( 'Order %s', 'checkout-wc' ) ), $order->get_order_number() ); ?></h5>
        <h4><?php echo sprintf( apply_filters( 'cfw_thank_you_subtitle', __( 'Thank you %s!', 'checkout-wc' ) ), $order->get_billing_first_name() ); ?></h4>
    </div>
    <?php
}

/**
 * Thank you page section open
 *
 * @param $class
 */
function cfw_thank_you_section_wrap( $callable, $class ) {
    ?>
    <section class="<?php echo $class; ?>>">
    <?php
}

/**
 * Thank you page section close
 */
function cfw_thank_you_section_end() {
    ?>
    </section>
    <?php
}

/**
 * Thank you page order status row
 *
 * Shows progression of order through statuses.
 *
 * @param WC_Order $order
 * @param array $order_statuses
 */
function cfw_thank_you_order_status_row( $order, $order_statuses ) {
    ?>
    <div class="inner status-row">
        <?php if ( $order->needs_shipping_address() && function_exists( 'wc_order_status_manager' ) ) : ?>
            <ul class="status-steps">
                <?php $count = 0; ?>
                <?php
                foreach ( $order_statuses as $order_status ) :
                    $order_status = new \WC_Order_Status_Manager_Order_Status( $order_status );
                    ?>
                    <li class="status-step
                    <?php
                    if ( $order->get_status() == $order_status->get_slug() ) {
                        echo 'status-step-selected';}
                    ?>
                    ">
                        <i class="<?php echo $order_status->get_icon(); ?>"></i>

                        <span class="title">
                            <?php echo wc_get_order_status_name( $order_status->get_slug() ); ?>
                        </span>

                        <span class="date">
                            <?php
                            $date = cfw_order_status_date( $order->get_id(), wc_get_order_status_name( $order_status->get_slug() ) );

                            if ( $date ) {
                                echo date_i18n( get_option( 'date_format' ), strtotime( $date ) );
                            } elseif ( $count === 0 ) {
                                echo date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_created() ) );
                            }
                            ?>
                        </span>
                    </li>
                    <?php $count++; ?>
                <?php endforeach; ?>
            </ul>
        <?php elseif ( $order->needs_shipping_address() ) : ?>
            <ul class="status-steps">
                <?php $count = 0; ?>
                <?php
                foreach ( $order_statuses as $order_status ) :
                    ?>
                    <li class="status-step <?php if ( $order->get_status() == $order_status ) { echo 'status-step-selected status-step-current';} ?>">
                        <i class="<?php echo apply_filters( 'cfw_thank_you_status_icon_' . $order_status, 'fa fa-chevron-circle-right' ); ?>"></i>

                        <span class="title">
                            <?php echo wc_get_order_status_name( $order_status ); ?>
                        </span>

                        <span class="date">
                            <?php
                            $date = cfw_order_status_date( $order->get_id(), wc_get_order_status_name( $order_status ) );

                            if ( $date ) {
                                echo date_i18n( get_option( 'date_format' ), strtotime( $date ) );
                            } elseif ( $count === 0 ) {
                                echo date_i18n( get_option( 'date_format' ), strtotime( $order->get_date_created() ) );
                            }
                            ?>
                        </span>
                    </li>
                    <?php $count++; ?>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <h3><?php _e( 'Order status', 'checkout-wc' ); ?></h3>
            <p><?php echo wc_get_order_status_name( $order->get_status() ); ?></p>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Thank you page map element
 *
 * @param WC_Order $order
 */
function cfw_thank_you_map( $order ) {
    if ( $order->needs_shipping_address() ) : ?>
		<?php if ( 'yes' == cfw_get_main()->get_settings_manager()->get_setting( 'enable_map_embed' ) ) : ?>
        <div id="map"></div>
		<?php endif; ?>

		<?php cfw_maybe_output_tracking_numbers( $order ); ?>
	<?php endif;
}

/**
 * Thank you page order updates section
 *
 * @param WC_Order $order
 */
function cfw_thank_you_order_updates( $order ) {
    ?>
    <h3><?php _e( 'Order updates', 'checkout-wc' ); ?></h3>
    <?php
    echo wpautop( apply_filters( 'cfw_order_updates_text', __( 'You’ll get shipping and delivery updates by email.', 'checkout-wc' ), $order ) );
}

/**
 * @param WC_Order $order
 * @param array $order_statues
 * @param boolean $show_downloads
 * @param array $downloads
 */
function cfw_thank_you_downloads( $order, $order_statues, $show_downloads, $downloads ) {
	?>
    <h3 class="woocommerce-order-downloads__title"><?php cfw_esc_html_e( 'Downloads', 'woocommerce' ); ?></h3>

    <table class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details">
        <thead>
        <tr>
            <?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
                <th class="<?php echo esc_attr( $column_id ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
            <?php endforeach; ?>
        </tr>
        </thead>

        <?php foreach ( $downloads as $download ) : ?>
            <tr>
                <?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
                    <td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>">
                        <?php
                        if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
                            do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
                        } else {
                            switch ( $column_id ) {
                                case 'download-product':
                                    if ( $download['product_url'] ) {
                                        echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
                                    } else {
                                        echo esc_html( $download['product_name'] );
                                    }
                                    break;
                                case 'download-file':
                                    echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file alt">' . esc_html( $download['download_name'] ) . '</a>';
                                    break;
                                case 'download-remaining':
                                    echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : cfw_esc_html__( '&infin;', 'woocommerce' );
                                    break;
                                case 'download-expires':
                                    if ( ! empty( $download['access_expires'] ) ) {
                                        echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ) ) . '</time>';
                                    } else {
                                        cfw_esc_html_e( 'Never', 'woocommerce' );
                                    }
                                    break;
                            }
                        }
                        ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
	<?php
}

/**
 * Thank you page customer information
 *
 * @param WC_Order $order
 */
function cfw_thank_you_customer_information( $order ) {
    ?>
    <h3><?php _e( 'Information', 'checkout-wc' ); ?></h3>

    <?php do_action( 'cfw_before_thank_you_customer_information', $order ); ?>

    <div class="row">
        <div class="col-lg-6">
            <h6><?php _e( 'Contact information', 'checkout-wc' ); ?></h6>
            <p><?php echo $order->get_billing_email(); ?></p>
        </div>
        <div class="col-lg-6">
            <h6><?php _e( 'Payment', 'checkout-wc' ); ?></h6>
            <p><?php echo $order->get_payment_method_title(); ?></p>
        </div>
    </div>

    <div class="row">
        <?php if ( $order->needs_shipping_address() ) : ?>
            <div class="col-lg-6">
                <?php if ( wc_ship_to_billing_address_only() ) : ?>
                    <h6>
                        <?php echo apply_filters( 'cfw_billing_shipping_address_heading', __( 'Billing and Shipping address', 'checkout-wc' ) ); ?>
                    </h6>
                <?php else : ?>
                    <h6>
                        <?php echo apply_filters( 'cfw_shipping_address_heading', esc_html__( 'Shipping address', 'checkout-wc' ) ); ?>
                    </h6>
                <?php endif; ?>

                <address>
                    <?php echo wp_kses_post( $order->get_formatted_shipping_address( cfw_esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
                </address>
            </div>
        <?php endif; ?>

        <?php if ( ! wc_ship_to_billing_address_only() ) : ?>
            <div class="col-lg-6">
                <h6>
                    <?php echo apply_filters( 'cfw_billing_address_heading', esc_html__( 'Billing address', 'checkout-wc' ) ); ?>
                </h6>
                <address>
                    <?php echo wp_kses_post( $order->get_formatted_billing_address( cfw_esc_html__( 'N/A', 'woocommerce' ) ) ); ?>
                </address>
            </div>
        <?php endif; ?>
    </div>

    <?php if ( $order->needs_shipping_address() ) : ?>
        <div class="row">
            <div class="col-lg-6">
                <h6><?php _e( 'Shipping', 'checkout-wc' ); ?></h6>
                <p>
                    <?php echo $order->get_shipping_method(); ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <div class="clear"></div>

    <?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
    <?php
}

/**
 * Renders the buttons beneath the order details on the
 * thank you page
 */
function cfw_thank_you_bottom_controls() {
    ?>
    <div id="cfw-shipping-info-action" class="cfw-bottom-controls">
        <?php
        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_page_permalink( 'shop' ) );
        $message   = sprintf( '<a href="%s" tabindex="1" class="cfw-primary-btn cfw-next-tab">%s</a>', esc_url( $return_to ), apply_filters( 'cfw_thank_you_continue_shopping_text', cfw_esc_html__( 'Continue shopping', 'woocommerce' ) ) );
        ?>
        <!--- Placeholder -->
        <div></div>
        <?php echo $message; ?>
    </div>
    <?php
}

/**
 * Thank you page cart summary content
 *
 * @param WC_Order $order
 */
function cfw_thank_you_cart_summary_content( $order ) {
    if ( count( $order->get_items() ) > 0 ) : ?>
        <?php cfw_order_cart_html( $order ); ?>
    <?php endif;
}

/**
 * Order pay heading
 */
function cfw_order_pay_heading() {
    ?>
    <h3><?php echo cfw__( 'Pay for order', 'woocommerce' ); ?></h3>
    <?php
}

/**
 * Order pay login form
 * @param WC_Order $order
 */
function cfw_order_pay_login_form( $order ) {
    ?>
    <form <?php cfw_form_attributes( 'login_form', false, false ); ?>>
        <?php do_action( 'woocommerce_login_form_start' ); ?>

        <?php
        cfw_form_field(
            'username', array(
                'label'        => 'Email',
                'type'         => 'text',
                'required'     => true,
                'autocomplete' => 'username',
            )
        );

        cfw_form_field(
            'password', array(
                'label'        => 'Password',
                'type'         => 'password',
                'required'     => true,
                'autocomplete' => 'current-password',
            )
        );
        ?>

        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <p class="form-row">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <input type="hidden" name="redirect" value="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" />

            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php cfw_esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>

            <span class="login-optional cfw-small"><a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php cfw_esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a></span>
        </p>

        <div class="clear"></div>

        <?php do_action( 'woocommerce_login_form_end' ); ?>
    </form>
    <?php
}

/**
 * Order Pay payment form
 *
 * @param WC_Order $order
 * @param array $available_gateways
 * @param $order_button_text
 * @param $call_receipt_hook
 */
function cfw_order_pay_payment_form( $order, $available_gateways, $order_button_text, $call_receipt_hook ) {
    ?>
    <form <?php cfw_form_attributes( 'order_review', false, false ); ?>>
        <?php
        // Some gateways need this when they use order-pay
        // to take payment right after checkout
        if ( ! empty( $call_receipt_hook ) ) : ?>
            <?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>
        <?php else : ?>
            <?php cfw_payment_methods( $available_gateways, $order, false ); ?>

            <?php wc_get_template( 'checkout/terms.php' ); ?>

            <div id="cfw-payment-action" class="cfw-bottom-controls">
                <div class="previous-button"></div>

                <input type="hidden" name="woocommerce_pay" value="1" />

                <div class="place-order" id="cfw-place-order">
                    <?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

                    <?php echo apply_filters( 'woocommerce_pay_order_button_html', '<button type="submit" class="cfw-primary-btn cfw-next-tab validate" id="place_order" formnovalidate="formnovalidate" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

                    <?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

                    <?php wp_nonce_field( 'woocommerce-pay', 'woocommerce-pay-nonce' ); ?>
                </div>
            </div>
        <?php endif; ?>
    </form>
    <?php
}

/**
 * @param WC_Order $order
 * @param $call_receipt_hook
 * @param $available_gateways
 * @param $order_button_text
 */
function cfw_order_pay_form( $order, $call_receipt_hook, $available_gateways, $order_button_text ) {
    if ( ! current_user_can( 'pay_for_order', $order->get_id() ) && ! is_user_logged_in() ) {
        cfw_order_pay_login_form( $order );
    } else {
        cfw_order_pay_payment_form( $order, $available_gateways, $order_button_text, $call_receipt_hook );
    }
}

/**
 * Thank you page cart summary content
 *
 * @param WC_Order $order
 */
function cfw_order_pay_cart_summary_content( $order ) {
	if ( count( $order->get_items() ) > 0 ) : ?>
		<?php cfw_order_cart_html( $order ); ?>
	<?php endif;
}

function cfw_thank_you_section_start_order_status() {
	cfw_thank_you_section_start( 'cfw-order-status' );
}

function cfw_thank_you_order_updates_wrapped( WC_Order $order ) {
	if ( $order->needs_shipping_address() ) {
		cfw_thank_you_section_auto_wrap( 'cfw_thank_you_order_updates', 'cfw-order-updates', array( $order ) );
	}
}

function cfw_thank_you_downloads_wrapped( $order, $order_statues, $show_downloads, $downloads ) {
	if ( $show_downloads ) {
		cfw_thank_you_section_auto_wrap( 'cfw_thank_you_downloads', 'woocommerce-order-downloads', array( $order, $order_statues, $show_downloads, $downloads ) );
	}
}

function cfw_thank_you_customer_information_wrapped( $order ) {
	cfw_thank_you_section_auto_wrap( 'cfw_thank_you_customer_information', 'cfw-customer-information', array( $order ) );
}

function cfw_cart_summary_mobile_header_display( WC_Order $order ) {
	cfw_cart_summary_mobile_header( $order->get_formatted_order_total() );
}

function cfw_customer_info_tab() {
	?>
	<!-- Customer Info Tab -->
	<div id="cfw-customer-info" class="cfw-panel" <?php cfw_customer_info_tab_style_attribute(); ?>>
		<?php do_action( 'cfw_checkout_customer_info_tab' ); ?>
	</div>
	<?php
}

function cfw_shipping_methods_tab() {
	?>
	<!-- Shipping Methods Tab -->
	<div id="cfw-shipping-method" class="cfw-panel" <?php cfw_shipping_method_tab_style_attribute(); ?>>
		<?php do_action( 'cfw_checkout_shipping_method_tab' ); ?>
	</div>
	<?php
}

function cfw_payment_methods_tab() {
	?>
	<!-- Payment Methods Tab -->
	<div id="cfw-payment-method" class="cfw-panel">
		<?php do_action( 'cfw_checkout_payment_method_tab' ); ?>
	</div>
	<?php
}