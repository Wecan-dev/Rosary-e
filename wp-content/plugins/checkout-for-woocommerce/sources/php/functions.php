<?php

use Objectiv\Plugins\Checkout\Main;

/**
 * Outputs a checkout/address form field.
 *
 * @subpackage  Forms
 * @param string $key
 * @param mixed $args
 * @param string $value (default: null)
 * @return $field
 */
function cfw_form_field( $key, $args, $value = null ) {
	$Main = cfw_get_main();

	$defaults = array(
		'type'              => 'text',
		'label'             => '',
		'description'       => '',
		'placeholder'       => '',
		'maxlength'         => false,
		'required'          => false,
		'autocomplete'      => false,
		'id'                => $key,
		'class'             => array(),
		'label_class'       => array(),
		'input_class'       => array(),
		'return'            => false,
		'options'           => array(),
		'custom_attributes' => array(),
		'validate'          => array(),
		'default'           => '',
		'autofocus'         => '',
		'priority'          => '',
		'wrap'              => '',
		'columns'           => 12,
	);

	$key_sans_type    = cfw_strip_key_type( $key );
	$ship_or_bill_key = explode( '_', $key )[0];

	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

	if ( in_array( $ship_or_bill_key, array( 'shipping', 'billing' ) ) && empty( $args['custom_attributes']['data-parsley-group'] ) ) {
		$args['custom_attributes']['data-parsley-group'] = $ship_or_bill_key;
	}

	$required = '';

	// If we don't have a placeholder, use label
	if ( empty( $args['placeholder'] ) ) {
		$args['placeholder'] = $args['label'];
	}

	// If we don't have a wrap, add one and set start and end to a presumed true
    if ( empty( $args['wrap'] ) ) {
	    $args = $Main->get_form()->calculate_wrap( $args, true );
    }

	if ( $args['required'] ) {
		$args['class'][] = 'validate-required';
	} else {
		$required = '&nbsp;<span class="optional">(' . cfw_esc_html__( 'optional', 'woocommerce' ) . ')</span>';

		// We don't need to do this for address_2 because
		// it is handled by address-i18n.js
		if ( $key_sans_type !== 'address_2' ) {
			$args['placeholder'] = $args['placeholder'] . ' (' . cfw_esc_html__( 'optional', 'woocommerce' ) . ')';
		}
	}

	if ( is_string( $args['label_class'] ) ) {
		$args['label_class'] = array( $args['label_class'] );
	}

	if ( is_null( $value ) ) {
		$value = $args['default'];
	}

	// Custom attribute handling
	$custom_attributes         = array();
	$args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

	if ( $args['maxlength'] ) {
		$args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
	}

	if ( ! empty( $args['autocomplete'] ) ) {
		if ( 0 === stripos( $key, 'billing_' ) ) {
			$args['autocomplete'] = "billing {$args['autocomplete']}";
		} elseif ( 0 === stripos( $key, 'shipping_' ) ) {
			$args['autocomplete'] = "shipping {$args['autocomplete']}";
		}

		$args['custom_attributes']['autocomplete'] = $args['autocomplete'];
	}

	if ( true === $args['autofocus'] ) {
		$args['custom_attributes']['autofocus'] = 'autofocus';
	}

	if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
		foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
			$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
		}
	}

	if ( ! empty( $args['validate'] ) ) {
		foreach ( $args['validate'] as $validate ) {
			$args['class'][] = 'validate-' . $validate;
		}
	}

	$field                 = '';
	$label_id              = $args['id'];
	$field_container_start = '';

	if ( isset( $args['wrap'] ) && ! empty( $args['wrap'] ) ) {
		$field_container_start = $args['wrap']->start . $args['wrap']->end;
	}

	$parsleyOut = '';

	if ( $args['required'] ) {
		$parsleyOut = 'data-parsley-required="true"';
	} else {
		$parsleyOut = 'data-parsley-required="false"';
    }

	if ( 'hidden' == $args['type'] ) {
		$args['start'] = false;
		$args['end']   = false;
	}

	switch ( $args['type'] ) {
		case 'country':
			$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

			$field = '<select field_key="' . $key_sans_type . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . $parsleyOut . '>' . '<option value="">' . esc_html__( 'Select a country', 'checkout-wc' ) . '&hellip;</option>';

			$highlighted_countries = array_flip( apply_filters( 'cfw_highlighted_countries', array() ) );
			$count                 = 1;

			if ( ! empty( $highlighted_countries ) ) {
				$countries = array_merge( $highlighted_countries, $countries );
			}

			foreach ( $countries as $ckey => $cvalue ) {
				$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';

				if ( ! empty( $highlighted_countries ) && $count == count( $highlighted_countries ) ) {
					$field .= '<option disabled="disabled" value="---">---</option>';
				}

				$count++;
			}

			$field .= '</select>';

			$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . cfw_esc_attr__( 'Update country', 'woocommerce' ) . '" /></noscript>';

			break;
		case 'state':
			/* Get Country */
			$country_key = 'billing_state' === $key ? 'billing_country' : 'shipping_country';
			$current_cc  = WC()->checkout()->get_value( $country_key );
			$states      = WC()->countries->get_states( $current_cc );

			if ( is_array( $states ) && empty( $states ) ) {

				$field_container_start = '<div class="col-lg-4 address-field" id="%1$s"><div class="cfw-input-wrap">%2$s</div></div>';

				$field .= '<input type="hidden" field_key="' . $key_sans_type . '" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

			} elseif ( ! is_null( $current_cc ) && is_array( $states ) ) {

				$field .= '<select field_key="' . $key_sans_type . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . $parsleyOut . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
                    <option disabled>' . cfw_esc_html__( 'Select a state&hellip;', 'woocommerce' ) . '</option>';

				foreach ( $states as $ckey => $cvalue ) {
					$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
				}

				$field .= '</select>';

			} else {

				$field .= '<input ' . $parsleyOut . ' field_key="' . $key_sans_type . '" type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

			}

			break;
		case 'textarea':
			$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . $parsleyOut . '>' . esc_textarea( $value ) . '</textarea>';

			break;
		case 'checkbox':
			$field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
                    <input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> '
					 . $args['label'] . $required . '</label>';

			break;
		case 'password':
		case 'text':
		case 'hidden':
		case 'email':
		case 'tel':
		case 'number':
			$field .= '<input type="' . esc_attr( $args['type'] ) . '" field_key="' . $key_sans_type . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . $parsleyOut . ' />';

			break;
		case 'select':
			$options = $field = '';

			if ( ! empty( $args['options'] ) ) {
				foreach ( $args['options'] as $option_key => $option_text ) {
					if ( '' === $option_key ) {
						// If we have a blank option, select2 needs a placeholder
						if ( empty( $args['placeholder'] ) ) {
							$args['placeholder'] = $option_text ? $option_text : cfw__( 'Choose an option', 'woocommerce' );
						}
						$custom_attributes[] = 'data-allow_clear="true"';
					}
					$options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
				}

				$field .= '<select field_key="' . $key_sans_type . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . $parsleyOut . '>' . $options . '</select>';
			}

			break;
		case 'radio':
			$label_id = current( array_keys( $args['options'] ) );

			if ( ! empty( $args['options'] ) ) {
				$count = 0;
				foreach ( $args['options'] as $option_key => $option_text ) {
					if ( $count == 0 ) {
						$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . $parsleyOut . ' />';
					} else {
						$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
					}
					$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';

					$count++;
				}
			}

			break;
		default:
			$field .= apply_filters( 'cfw_form_field_element_' . $args['type'], '<input type="' . esc_attr( $args['type'] ) . '" field_key="' . $key_sans_type . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . $parsleyOut . ' />', $key, $value, $args );
			break;
	}

	$row_wrap = '';

	if ( ! empty( $field ) ) {

		$field_html = '';

		if ( $args['label'] && 'checkbox' != $args['type'] && 'hidden' != $args['type'] ) {
			$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
		}

		$field_html .= $field;

		$container_class = esc_attr( implode( ' ', $args['class'] ) );
		$container_id    = esc_attr( $args['id'] ) . '_field';

		if ( isset( $args['start'] ) && $args['start'] ) {
			$row_wrap = '<div class="row cfw-input-wrap-row %1$s">';
		}

		$row_wrap = @sprintf( $row_wrap, $container_class );
		$row_wrap = apply_filters( 'cfw_input_row_wrap', $row_wrap, $key, $args, $value );

		if ( ! empty( $field_container_start ) ) {
			$field = $row_wrap . @sprintf( $field_container_start, $container_id, $field_html );
		}

		if ( isset( $args['end'] ) && $args['end'] ) {
			$field .= '</div>';
		}
	}

	$field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value, $row_wrap );

	if ( $args['return'] ) {
		return $field;
	} else {
		echo $field;
	}
}

function cfw_strip_key_type( $key ) {
	$key_exp       = explode( '_', $key );
	$key_sans_type = implode( '_', array_slice( $key_exp, 1, count( $key_exp ) - 1, true ) );

	return $key_sans_type;
}

/**
 * @param \WC_Checkout $checkout
 */
function cfw_get_shipping_checkout_fields( $checkout ) {
	$shipping_checkout_fields = apply_filters( 'cfw_get_shipping_checkout_fields', $checkout->get_checkout_fields( 'shipping' ) );

	foreach ( $shipping_checkout_fields as $key => $field ) {
		cfw_form_field( $key, $field, $checkout->get_value( $key ) );
	}
}

function cfw_get_billing_checkout_fields( $checkout ) {
	$billing_checkout_fields = apply_filters( 'cfw_get_billing_checkout_fields', $checkout->get_checkout_fields( 'billing' ) );

	foreach ( $billing_checkout_fields as $key => $field ) {
		// Don't output billing email or native billing phone
		// This logic is ugly, but basically we're saying:
		//   - If the field is billing phone and our wrap isn't present, skip the field
		//   - If the field is billing email, skip it
		//   - Otherwise, output it
		if ( 'billing_phone' === $key && ! isset( $field['wrap'] ) ) {
			continue;
		}

		if ( 'billing_email' === $key ) {
			continue;
		}

		cfw_form_field( $key, $field, $checkout->get_value( $key ) );
	}
}

function cfw_get_shipping_details( $checkout ) {
	return WC()->countries->get_formatted_address(
		apply_filters(
			'cfw_get_shipping_details_address', array(
				'company'    => $checkout->get_value( 'shipping_company' ),
				'address_1'  => $checkout->get_value( 'shipping_address_1' ),
				'address_2'  => $checkout->get_value( 'shipping_address_2' ),
				'city'       => $checkout->get_value( 'shipping_city' ),
				'state'      => $checkout->get_value( 'shipping_state' ),
				'postcode'   => $checkout->get_value( 'shipping_postcode' ),
				'country'    => $checkout->get_value( 'shipping_country' ),
			), $checkout
		), ', '
	);
}


function cfw_get_shipping_methods_html() {
	ob_start();

	cfw_shipping_methods_html();

	return ob_get_clean();
}

function cfw_shipping_methods_html() {
	$packages = WC()->shipping->get_packages();

	foreach ( $packages as $i => $package ) {
		$chosen_method = WC()->session->chosen_shipping_methods[ $i ] ?? '';
		$product_names = array();

		if ( sizeof( $packages ) > 1 ) {
			foreach ( $package['contents'] as $item_id => $values ) {
				$product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
			}
			$product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
		}

		$available_methods    = $package['rates'];
		$show_package_details = sizeof( $packages ) > 1;
		$package_details      = implode( ', ', $product_names );
		$package_name         = apply_filters( 'woocommerce_shipping_package_name', sprintf( cfw_nx( 'Shipping', 'Shipping %d', ( $i + 1 ), 'shipping packages', 'woocommerce' ), ( $i + 1 ) ), $i, $package );
		$index                = $i;

		// Next section ripped straight from cart-shipping and edited for now
		?>

		<?php if ( count( $available_methods ) > 0 ) : ?>
			<?php if ( 1 < count( $packages ) ) : ?>
				<h4 class="cfw-shipping-package-title"><?php echo $package_name; ?></h4>
			<?php endif; ?>

			<?php cfw_before_shipping(); ?>

			<ul class="cfw-shipping-methods-list">
				<?php
				foreach ( $available_methods as $method ) :
					ob_start();
					do_action( 'woocommerce_after_shipping_rate', $method, $index );
					$after_shipping_method = ob_get_clean();
					?>
					<li>
						<div class="cfw-shipping-method-inner">
							<div class="shipping-method-radio">
								<?php printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok. ?>
							</div>
							<?php printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok. ?>
						</div>
						<?php
						if ( ! empty( $after_shipping_method ) && preg_match( '/<thead|<tbody|<tfoot|<th|<tr/', $after_shipping_method ) ) :
							?>
							<table>
								<?php echo $after_shipping_method; ?>
							</table>
                        <?php else: ?>
							<?php echo $after_shipping_method; ?>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>

			<?php cfw_after_shipping(); ?>
		<?php else : ?>
			<div class="shipping-message">
				<?php echo apply_filters( 'woocommerce_no_shipping_available_html', '<div class="cfw-alert cfw-alert-error"><div class="message">' . wpautop( cfw__( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) ) . '</div></div>' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>
		<?php
	}
}

function cfw_before_shipping() {
	if ( has_action( 'woocommerce_review_order_before_shipping' ) ) :
		?>
		<table id="cfw-before-shipping">
			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
		</table>
		<?php
	endif;
}

function cfw_after_shipping() {
	if ( has_action( 'woocommerce_review_order_after_shipping' ) ) :
		?>
		<table id="cfw-after-shipping">
			<?php do_action( 'cfw_after_shipping_methods' ); ?>
			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
		</table>
		<?php
	endif;
}

function cfw_get_payment_methods_html( $available_gateways = false ) {
	do_action( 'cfw_get_payment_methods_html' );

	$available_gateways = empty( $available_gateways ) ? WC()->payment_gateways->get_available_payment_gateways() : (array) $available_gateways;
	WC()->payment_gateways()->set_current_gateway( $available_gateways );

	ob_start();
	?>
	<ul class="wc_payment_methods payment_methods methods cfw-radio-reveal-group">
	<?php
	if ( ! empty( $available_gateways ) ) {
		$count = 0;
		foreach ( $available_gateways as $gateway ) {
			if ( apply_filters( "cfw_show_gateway_{$gateway->id}", true ) ) : ?>
				<li class="wc_payment_method payment_method_<?php echo $gateway->id; ?> cfw-radio-reveal-li <?php echo $gateway->chosen ? "cfw-active" : ''; ?>">
					<div class="payment_method_title_wrap cfw-radio-reveal-title-wrap">
						<label class="payment_method_label cfw-radio-reveal-label" for="payment_method_<?php echo $gateway->id; ?>">
							<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( apply_filters( 'cfw_gateway_order_button_text', $gateway->order_button_text, $gateway ) ); ?>"/>
							<span class="payment_method_title cfw-radio-reveal-title"><?php echo $gateway->get_title(); ?></span>
						</label>

						<span class="payment_method_icons">
						<?php echo $gateway->get_icon(); ?>
						</span>
					</div>
				<?php if ( apply_filters( "cfw_payment_gateway_{$gateway->id}_content", $gateway->has_fields() || $gateway->get_description() ) ) : ?>
						<div class="payment_box payment_method_<?php echo $gateway->id; ?> cfw-radio-reveal-content" <?php if ( ! $gateway->chosen ) :?>style="display:none;"<?php endif; ?>>
							<?php
							ob_start();

							remove_filter( 'woocommerce_form_field', array( Main::instance()->get_form(), 'cfw_form_field' ), 10 );

							$gateway->payment_fields();

							add_filter( 'woocommerce_form_field', array( Main::instance()->get_form(), 'cfw_form_field' ), 10, 4 );

							$field_html = ob_get_clean();

							/**
							 * Gateway Compatibility Patches
							 */
							// Expiration field fix
							$field_html = str_ireplace( 'js-sv-wc-payment-gateway-credit-card-form-expiry', 'js-sv-wc-payment-gateway-credit-card-form-expiry  wc-credit-card-form-card-expiry', $field_html );
							$field_html = str_ireplace( 'js-sv-wc-payment-gateway-credit-card-form-account-number', 'js-sv-wc-payment-gateway-credit-card-form-account-number  wc-credit-card-form-card-number', $field_html );

							// Credit Card Field Placeholders
							$field_html = str_ireplace( '•••• •••• •••• ••••', 'Card Number', $field_html );
							$field_html = str_ireplace( '&bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull; &bull;&bull;&bull;&bull;', 'Card Number', $field_html );

							echo apply_filters( "cfw_payment_gateway_field_html_{$gateway->id}", $field_html );
							?>
						</div>
					<?php endif; ?>
				</li>

				<?php else :
					do_action_ref_array( "cfw_payment_gateway_list_{$gateway->id}_alternate", array( $count ) );
				endif;

				$count++;
		}
	} else {
		echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', cfw__( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</li>';
	}
	?>
	</ul>
	<?php

	return ob_get_clean();
}

function cfw_get_cart_html() {
	$cart = WC()->cart;

	ob_start();
	?>
	<table id="cfw-cart" class="cfw-module">
        <?php
        do_action( 'cfw_cart_html_table_start' );

        foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $item_thumb    = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'cfw_cart_thumb' ), $cart_item, $cart_item_key );
                $item_quantity = apply_filters( 'cfw_cart_item_quantity', cfw_get_cart_edit_item_quantity_control( $cart_item, $_product, $cart_item_key ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                $item_title    = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                $item_url      = get_permalink( $cart_item['product_id'] );
                $item_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', $cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

                if ( apply_filters( 'cfw_show_cart_item_discount', false ) ) {
                    $item_title = $item_title . ' (' . $_product->get_price_html() . ') ';
                }
                ?>
                <tr class="cart-item-row cart-item-<?php echo $cart_item_key; ?> <?php echo apply_filters( 'cfw_cart_item_row_class', '', $cart_item ) ; ?>">
	                <?php if ( $item_thumb ) : ?>
                    <td class="cfw-cart-item-image">
	                    <div class="cfw-cart-item-image-wrap">
                            <?php echo $item_thumb; ?>
                            <span class="cfw-cart-item-quantity-bubble"><?php echo $cart_item['quantity']; ?></span>
                        </div>
                    </td>
                    <?php endif; ?>

                    <th class="cfw-cart-item-description" <?php if( empty($item_thumb) ) echo 'colspan="2" style="padding-left: 0; ?>"'; ?>>
                        <div class="cfw-cart-item-title">
		                    <?php if ( apply_filters( 'cfw_link_cart_items', cfw_get_main()->get_settings_manager()->get_setting( 'cart_item_link' ) == 'enabled' ) ) : ?>
                                <a target="_blank" href="<?php echo $item_url; ?>">
				                    <?php echo $item_title; ?>
                                </a>
		                    <?php else : ?>
			                    <?php echo $item_title; ?>
		                    <?php endif; ?>
                        </div>

                        <?php echo cfw_get_formatted_cart_item_data( $cart_item ); ?>

                        <?php do_action( 'cfw_cart_item_after_data', $cart_item ); ?>

                        <?php echo $item_quantity; ?>
                    </th>

                    <td class="cfw-cart-item-quantity visually-hidden">
	                    <?php echo $cart_item['quantity']; ?>
                    </td>

                    <td class="cfw-cart-item-subtotal">
	                    <?php echo $item_subtotal; ?>
                    </td>
                </tr>
                <?php
            }
        }

        do_action( 'cfw_cart_html_table_end' );
        ?>
	</table>
	<?php
	return apply_filters( 'cfw_cart_html', ob_get_clean() );
}

/**
 * @param WC_Order $order
 */
function cfw_order_cart_html( $order ) {
	echo cfw_get_order_cart_html( $order );
}

/**
 * @param WC_Order $order
 *
 * @return mixed|void
 */
function cfw_get_order_cart_html( $order ) {
	ob_start();
	?>
	<table id="cfw-cart" class="cfw-module">
		<?php
        /**
         * @var  $item_id
         * @var  WC_Order_Item $item
         */
		foreach ( $order->get_items() as $item_id => $item ) {
			if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
			    $item_product   = $item->get_product();
				$item_thumb     = $item_product ? $item_product->get_image( 'cfw_cart_thumb' ) : false;
				$item_quantity  = $item->get_quantity();
				$item_title     = $item->get_name();
				$item_url       = $item_product ? get_permalink( $item->get_product_id() ) : false;
				$item_subtotal  = $order->get_formatted_line_subtotal( $item );
				$item_subtotal  = ! empty( $item_subtotal ) ? $item_subtotal : wc_price( $item->get_subtotal() );

				if ( apply_filters( 'cfw_show_cart_item_discount', false ) && $item_product ) {
					$item_title = $item_title . ' (' . $item->get_product()->get_price_html() . ') ';
				}
				?>
                <tr class="cart-item-row order-item-<?php echo $item_id; ?>">
					<?php if ( $item_thumb ) : ?>
                        <td class="cfw-cart-item-image">
							<?php echo $item_thumb; ?>
                        </td>
					<?php endif; ?>

                    <td class="cfw-cart-item-description" <?php if ( ! $item_thumb ) echo 'colspan="2" style="padding-left:0"'; ?> >
                        <div class="cfw-cart-item-title">
							<?php if ( apply_filters( 'cfw_link_cart_items', __return_false() ) && $item_url !== false ) : ?>
                                <a target="_blank" href="<?php echo $item_url; ?>">
									<?php echo $item_title; ?>
                                </a>
							<?php else : ?>
								<?php echo $item_title; ?>
							<?php endif; ?>
                        </div>
                        <div class="cfw-cart-item-data">
	                        <?php cfw_wc_display_item_meta( $item ); ?>
                        </div>
                    </td>

                    <td class="cfw-cart-item-quantity">
                        &times;&nbsp;<?php echo $item_quantity; ?>
                    </td>

                    <td class="cfw-cart-item-subtotal">
						<?php echo $item_subtotal; ?>
                    </td>
                </tr>
				<?php
			}
		}
		?>
	</table>
	<?php
	return apply_filters( 'cfw_cart_html', ob_get_clean() );
}

function cfw_wc_display_item_meta( $item, $args = array() ) {
	$strings = array();
	$html    = '';
	$args    = wp_parse_args(
		$args,
		array(
			'before'       => '<div class="variation">',
			'after'        => '</div>',
			'separator'    => '</span><br />',
			'echo'         => true,
			'autop'        => false,
			'label_before' => '<span>',
			'label_after'  => ': ',
		)
	);

	foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
		if ( apply_filters( 'cfw_include_order_item_meta', true, $meta ) ) {
			$value     = strip_tags( $meta->display_value );
			$strings[] = apply_filters( 'cfw_order_item_meta_output', $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'] . $value, $meta );
		}
	}

	if ( $strings ) {
		$html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
	}

	$html = apply_filters( 'woocommerce_display_item_meta', $html, $item, $args );

	if ( $args['echo'] ) {
		echo $html; // WPCS: XSS ok.
	} else {
		return $html;
	}
}

function cfw_get_totals_html() {
	ob_start();
	?>
	<div id="<?php echo apply_filters( 'cfw_template_cart_el', 'cfw-totals-list' ); ?>" class="cfw-module">
		<table class="cfw-module">
			<?php do_action( 'cfw_before_cart_summary_totals' ); ?>

			<tr class="cart-subtotal">
				<th><?php cfw_e( 'Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( cfw_show_shipping_total() ) : ?>

				<tr class="woocommerce-shipping-totals">
					<th>
						<?php echo apply_filters( 'cfw_cart_totals_shipping_label', cfw_esc_html__( 'Shipping', 'woocommerce' ) ); ?>
					</th>
					<td>
						<?php echo cfw_get_shipping_total(); ?>
					</td>
				</tr>

			<?php endif; ?>

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><?php echo esc_html( $fee->name ); ?></th>
					<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
				<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><?php echo esc_html( $tax->label ); ?></th>
							<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php wc_cart_totals_taxes_total_html(); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="order-total">
				<th><?php cfw_e( 'Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

			<?php do_action( 'cfw_after_cart_summary_totals' ); ?>
		</table>
	</div>
	<?php

	return apply_filters( 'cfw_totals_html', ob_get_clean() );
}

/**
 * @param WC_Order $order
 */
function cfw_order_totals_html( $order ) {
	echo cfw_get_order_totals_html( $order );
}

/**
 * @param WC_Order $order
 *
 * @return mixed|void
 */
function cfw_get_order_totals_html( $order ) {
	$totals = $order->get_order_item_totals();

	ob_start();
	?>
	<div id="<?php echo apply_filters( 'cfw_template_cart_el', 'cfw-totals-list' ); ?>" class="cfw-module">
		<table class="cfw-module">
			<?php do_action( 'cfw_before_cart_summary_totals' ); ?>

			<?php
			foreach ( $totals as $key => $total ) :
				if ( $key == 'payment_method' ) {
					continue;}
				?>
				<tr class="cart-subtotal 
				<?php
				if ( 'order_total' == $key ) {
					echo 'order-total';}
				?>
				">
					<th><?php echo $total['label']; ?></th>
					<td><?php echo $total['value']; ?></td>
				</tr>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

			<?php do_action( 'cfw_after_cart_summary_totals' ); ?>
		</table>
	</div>
	<?php

	return apply_filters( 'cfw_totals_html', ob_get_clean() );
}

/**
 * @param array $cart_item
 * @param WC_Product $product
 * @param string $cart_item_key
 *
 * @return false|string
 */
function cfw_get_cart_edit_item_quantity_control( $cart_item, $product, $cart_item_key ) {
	if ( Main::instance()->get_settings_manager()->get_setting( 'enable_cart_editing' ) == 'yes' && Main::is_checkout() ) {
		$max_quantity = $product->get_max_purchase_quantity() > 0 ? $product->get_max_purchase_quantity() : PHP_INT_MAX;
		$maxed = $cart_item['quantity'] >= $max_quantity || $product->is_sold_individually();
		ob_start();
		?>
        <div class="cfw-edit-item-quantity-control-wrap">
            <div class="cfw-quantity-stepper">
                <input type="hidden" data-max-quantity="<?php echo $max_quantity; ?>" class="cfw-edit-item-quantity-value" name="cart[<?php echo $cart_item_key; ?>][qty]" value="<?php echo $cart_item['quantity']; ?>" />
                <div class="cfw-quantity-stepper-btn-minus"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M376 232H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h368c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"/></svg></div>
                <div class="cfw-quantity-stepper-btn-plus <?php if ( $maxed ) echo 'maxed'; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M376 232H216V72c0-4.42-3.58-8-8-8h-32c-4.42 0-8 3.58-8 8v160H8c-4.42 0-8 3.58-8 8v32c0 4.42 3.58 8 8 8h160v160c0 4.42 3.58 8 8 8h32c4.42 0 8-3.58 8-8V280h160c4.42 0 8-3.58 8-8v-32c0-4.42-3.58-8-8-8z"/></svg></div>
            </div>
			<a href="javascript:" data-quantity="<?php echo esc_attr( $cart_item['quantity'] ); ?>" class="cfw-quantity-bulk-edit cfw-xtra-small"><?php cfw_e('Edit', 'woocommerce' ); ?></a>
        </div>

		<?php
		return ob_get_clean();
	}

	return '';
}

function cfw_address_class_wrap( $shipping = true ) {
    // If __field-wrapper class isn't there, Amazon Pay nukes our address fields :-(
	$result = 'woocommerce-billing-fields woocommerce-billing-fields__field-wrapper';

	if ( $shipping === true ) {
		$result = 'woocommerce-shipping-fields woocommerce-shipping-fields__field-wrapper';
	}

	echo $result;
}

function cfw_get_all_package_shipping_methods() {
	$packages    = WC()->shipping->get_packages();
	$all_methods = [];

	foreach ( $packages as $i => $package ) {
		$available_methods = $package['rates'];

		if ( count( $available_methods ) > 0 ) {
			foreach ( $available_methods as $available_method ) {
				$all_methods[ $available_method->id ] = $available_method;
			}
		}
	}

	return $all_methods;
}

function cfw_get_shipping_total() {
	$chosen_shipping_methods = WC()->session->get( 'chosen_shipping_methods' );

	if ( !  WC()->cart->needs_shipping() ) {
		return '';
	}

	$small_format = '<span class="cfw-small">%s</span>';

	if ( ! WC()->cart->show_shipping() ) {
		$new_shipping_total = sprintf( $small_format,  apply_filters( 'cfw_shipping_total_address_required_text', __( 'Address Required', 'checkout-wc' ) ) );
	} elseif ( WC()->cart->show_shipping() && is_array( $chosen_shipping_methods ) && $chosen_shipping_methods[0] === false ) {
		$new_shipping_total = sprintf( $small_format, apply_filters( 'cfw_shipping_total_not_available_text', __( 'No shipping methods available', 'checkout-wc' ) ) );
	} else {
		$new_shipping_total = WC()->cart->get_cart_shipping_total();
	}

	return $new_shipping_total;
}

function cfw_get_place_order( $order_button_text = false ) {
	ob_start();

	$order_button_text = ! $order_button_text ? apply_filters( 'woocommerce_order_button_text', __( 'Complete Order', 'checkout-wc' ) ) : $order_button_text;
	?>
	<div class="<?php echo join( ' ', apply_filters( 'cfw_place_order_button_container_classes', array( 'place-order' ) ) ); ?>" id="cfw-place-order">
        <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="cfw-primary-btn cfw-next-tab validate" name="woocommerce_checkout_place_order" id="place_order" formnovalidate="formnovalidate" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
	<?php
	return ob_get_clean();
}

function cfw_place_order( $order_button_text = false ) {
	echo cfw_get_place_order( $order_button_text );
}

function cfw_get_payment_methods( $available_gateways = false, $object = false, $show_title = true, $payment_methods_html = false ) {
	if ( false === $payment_methods_html ) {
		$payment_methods_html = cfw_get_payment_methods_html( $available_gateways );
	}

	$object = ! $object ? WC()->cart : $object;

	ob_start();
	?>
	<div id="cfw-billing-methods" class="cfw-module cfw-accordion">
		<?php if ( $show_title ) : ?>
			<h3>
				<?php echo apply_filters( 'cfw_payment_method_heading', esc_html__( 'Payment', 'checkout-wc' ) ); ?>
			</h3>
		<?php endif; ?>

		<?php do_action( 'cfw_checkout_before_payment_methods' ); ?>

		<?php if ( $object->needs_payment() ) : ?>
			<div class="cfw-payment-method-information-wrap">
				<h4 class="cfw-small secure-notice">
					<?php echo apply_filters( 'cfw_transactions_encrypted_statement', esc_html__( 'All transactions are secure and encrypted.', 'checkout-wc' ) ); ?>
				</h4>

				<div class="cfw-payment-methods-wrap">
					<div id="payment" class="woocommerce-checkout-payment">
						<?php echo $payment_methods_html; ?>
					</div>
				</div>
			</div>
		<?php else : ?>
			<div class="cfw-no-payment-method-wrap">
				<span class="cfw-small"><?php echo apply_filters( 'cfw_no_payment_required_text', esc_html__( 'Your order is free. No payment is required.', 'checkout-wc' ) ); ?></span>
			</div>
		<?php endif; ?>

		<?php do_action( 'cfw_checkout_after_payment_methods' ); ?>
	</div>
	<?php

	return ob_get_clean();
}

function cfw_billing_address_radio_group() {
	do_action( 'cfw_checkout_before_billing_address' );

	if ( ! apply_filters( 'cfw_force_display_billing_address', false ) ) :
		?>
		<div id="cfw-shipping-same-billing" class="cfw-module cfw-accordion">
			<ul class="cfw-radio-reveal-group">
				<li class="cfw-radio-reveal-li cfw-no-reveal">
					<div class="cfw-radio-reveal-title-wrap">
						<label class="cfw-radio-reveal-label">
							<input type="radio" name="bill_to_different_address" id="billing_same_as_shipping_radio" value="same_as_shipping" class="garlic-auto-save" checked="checked" />
							<span class="cfw-radio-reveal-title"><?php esc_html_e( 'Same as shipping address', 'checkout-wc' ); ?></span>
						</label>

						<?php do_action( 'cfw_after_same_as_shipping_address_label' ); ?>
					</div>
				</li>
				<li class="cfw-radio-reveal-li">
					<div class="cfw-radio-reveal-title-wrap">
						<label class="cfw-radio-reveal-label">
							<input type="radio" name="bill_to_different_address" id="shipping_dif_from_billing_radio" value="different_from_shipping" class="garlic-auto-save" />
							<span class="cfw-radio-reveal-title"><?php esc_html_e( 'Use a different billing address', 'checkout-wc' ); ?></span>
						</label>
					</div>
					<div id="cfw-billing-fields-container" class="cfw-radio-reveal-content <?php cfw_address_class_wrap( false ); ?>" style="display: none">
						<?php cfw_get_billing_checkout_fields( WC()->checkout() ); ?>
					</div>
				</li>
			</ul>
		</div>
	<?php else : ?>
		<input type="hidden" name="bill_to_different_address" id="billing_same_as_shipping_radio" value="different_from_shipping" />
		<?php cfw_get_billing_checkout_fields( WC()->checkout() ); ?>
	<?php endif; ?>

	<!-- wrapper required for compatibility with Pont shipping for Woocommerce -->
	<div class="cfw-force-hidden">
		<div id="ship-to-different-address">
			<input id="ship-to-different-address-checkbox" type="checkbox" name="ship_to_different_address" value="<?php echo WC()->cart->needs_shipping_address() ? 1 : 0; ?>" checked="checked" />
		</div>
	</div>

	<?php
	do_action( 'cfw_checkout_after_billing_address' );
}

/**
 * Gets and formats a list of cart item data + variations for display on the frontend.
 *
 * @since 3.3.0
 * @param array $cart_item Cart item object.
 * @param bool  $flat Should the data be returned flat or in a list.
 * @return string
 */
function cfw_get_formatted_cart_item_data( $cart_item ) {
    if ( apply_filters( 'cfw_cart_item_data_expanded', cfw_get_main()->get_settings_manager()->get_setting( 'cart_item_data_display' ) === 'woocommerce' ) ) {
	    $output = wc_get_formatted_cart_item_data( $cart_item );

	    $output = str_replace( ' :', ':', $output );
    } else {
	    $item_data = cfw_get_formatted_cart_item_data_array( $cart_item );
        $output = '';
        $first = true;

	    foreach ( $item_data as $item_datum ) {
	    	// Extra Fees for WooCommerce
	    	if ( isset( $item_datum['name'] ) && isset( $item_datum['display'] ) ) {
	    		$value =  "{$item_datum['name']} ({$item_datum['display']})";
			} else {
	    		$value = $item_datum['value'];
			}

	    	$value = trim( strip_tags( $value ) );

	        if ( $first ) {
		        $output .= $value;
		        $first = false;
            } else {
				$output .= ' / ' . $value;
			}
        }
    }

    if ( $output ) {
        echo '<div class="cfw-cart-item-data">' . $output . '</div>';
    }

    return '';
}

/**
 * @param $cart_item
 *
 * @return array
 */
function cfw_get_formatted_cart_item_data_array( $cart_item ) {
	$item_data = array();

	// Variation values are shown only if they are not found in the title as of 3.0.
	// This is because variation titles display the attributes.
	if ( $cart_item['data']->is_type( 'variation' ) && is_array( $cart_item['variation'] ) ) {
		foreach ( $cart_item['variation'] as $name => $value ) {
			$taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

			if ( taxonomy_exists( $taxonomy ) ) {
				// If this is a term slug, get the term's nice name.
				$term = get_term_by( 'slug', $value, $taxonomy );
				if ( ! is_wp_error( $term ) && $term && $term->name ) {
					$value = $term->name;
				}
				$label = wc_attribute_label( $taxonomy );
			} else {
				// If this is a custom option slug, get the options name.
				$value = apply_filters( 'woocommerce_variation_option_name', $value, null, $taxonomy, $cart_item['data'] );
				$label = wc_attribute_label( str_replace( 'attribute_', '', $name ), $cart_item['data'] );
			}

			// Check the nicename against the title.
			if ( '' === $value || wc_is_attribute_in_product_name( $value, $cart_item['data']->get_name() ) ) {
				continue;
			}

			$item_data[] = array(
				'key'   => $label,
				'value' => $value,
			);
		}
	}

	// Filter item data to allow 3rd parties to add more to the array.
	$item_data = apply_filters( 'woocommerce_get_item_data', $item_data, $cart_item );

	return $item_data;
}

/**
 * Get all approved WooCommerce order notes.
 *
 * @param int|string $order_id The order ID.
 * @param string $status_search
 *
 * @return bool|string
 */
function cfw_order_status_date( $order_id, $status_search ) {
	remove_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ) );

	$notes = get_comments(
		array(
			'post_id' => $order_id,
			'orderby' => 'comment_ID',
			'order'   => 'DESC',
			'approve' => 'approve',
			'type'    => 'order_note',
		)
	);

	add_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ) );

	$pattern = sprintf( cfw__( 'Order status changed from %1$s to %2$s.', 'woocommerce' ), 'X', $status_search );

	$pieces         = explode( ' ', $pattern );
	$last_two_words = implode( ' ', array_splice( $pieces, -2 ) );

	foreach ( $notes as $note ) {
		if ( false !== stripos( $note->comment_content, $last_two_words ) ) {
			return $note->comment_date_gmt;
		}
	}

	return false;
}

/**
 * @param \WC_Order $order
 */
function cfw_maybe_output_tracking_numbers( $order ) {
	$output = '';

	if ( defined( 'WC_SHIPMENT_TRACKING_VERSION' ) ) {
		$tracking_items = \WC_Shipment_Tracking_Actions::get_instance()->get_tracking_items( $order->get_id(), true );
		$label_suffix   = strtolower( cfw__( 'Tracking number:', 'woocommerce-shipment-tracking' ) );

		foreach ( $tracking_items as $tracking_item ) {
			$output .= "<h4>{$tracking_item['formatted_tracking_provider']} {$label_suffix}</h4>";
			$output .= "<p><a class=\"tracking-number\" target=\"_blank\" href=\"{$tracking_item['formatted_tracking_link']}\">{$tracking_item['tracking_number']}</a></p>";
		}
	} elseif( function_exists( 'wc_advanced_shipment_tracking' ) ) {
	    ob_start();
	    $WC_Advanced_Shipment_Tracking_Actions = \WC_Advanced_Shipment_Tracking_Actions::get_instance();
		$WC_Advanced_Shipment_Tracking_Actions->show_tracking_info_order( $order->get_id() );

		$output = ob_get_clean();
    } elseif ( has_filter( 'cfw_thank_you_tracking_numbers' ) ) {
		$output = apply_filters( 'cfw_thank_you_tracking_numbers', '', $order );
	}

	if ( ! empty( $output ) ) {
		echo '<div class="inner">';

		echo apply_filters( 'cfw_maybe_output_tracking_numbers', $output, $order );

		echo '</div>';
	}
}

function cfw_return_to_cart_link() {
	echo apply_filters( 'cfw_return_to_cart_link', sprintf( '<a href="%s" class="cfw-prev-tab">« %s</a>', apply_filters( 'cfw_return_to_cart_link_url', wc_get_cart_url() ), apply_filters( 'cfw_return_to_cart_link_text', esc_html__( 'Return to cart', 'checkout-wc' ) ) ) );
}

function cfw_continue_to_shipping_button() {
	echo apply_filters( 'cfw_continue_to_shipping_button', sprintf( '<a href="javascript:;" data-tab="#cfw-shipping-method" class="cfw-primary-btn cfw-next-tab cfw-continue-to-shipping-btn">%s</a>', apply_filters( 'cfw_continue_to_shipping_method_label', esc_html__( 'Continue to shipping', 'checkout-wc' ) ) ) );
}

function cfw_continue_to_payment_button() {
	echo apply_filters( 'cfw_continue_to_payment_button', sprintf( '<a href="javascript:;" data-tab="#cfw-payment-method" class="cfw-primary-btn cfw-next-tab cfw-continue-to-payment-btn">%s</a>', apply_filters( 'cfw_continue_to_payment_method_label', esc_html__( 'Continue to payment', 'checkout-wc' ) ) ) );
}

function cfw_return_to_customer_information_link() {
	echo apply_filters( 'cfw_return_to_customer_information_link', sprintf( '<a href="javascript:;" data-tab="#cfw-customer-info" class="cfw-prev-tab cfw-return-to-information-btn">« %s</a>', apply_filters( 'cfw_return_to_customer_info_label', esc_html__( 'Return to information', 'checkout-wc' ) ) ) );
}

function cfw_return_to_shipping_method_link() {
	echo apply_filters( 'cfw_return_to_shipping_method_link', sprintf( '<a href="javascript:;" data-tab="#cfw-shipping-method" class="cfw-prev-tab cfw-return-to-shipping-btn">« %s</a>', apply_filters( 'cfw_return_to_shipping_method_label', esc_html__( 'Return to shipping', 'checkout-wc' ) ) ) );
}

function cfw_breadcrumb_navigation() {
	$show_customer_info_tab   = apply_filters( 'cfw_show_customer_information_tab', true );

	$default_breadcrumbs = array(
		'cart'            => array(
			'href'     => apply_filters( 'cfw_breadcrumb_cart_url', wc_get_cart_url() ),
			'label'    => apply_filters( 'cfw_breadcrumb_cart_label', cfw_esc_html__( 'Cart', 'woocommerce' ) ),
			'priority' => 10,
		),
		'information-tab' => array(
			'href'     => '#cfw-customer-info',
			'label'    => apply_filters( 'cfw_breadcrumb_customer_info_label', esc_html__( 'Information', 'checkout-wc' ) ),
			'priority' => 20,
		),
		'shipping-tab'    => array(
			'href'     => '#cfw-shipping-method',
			'label'    => apply_filters( 'cfw_breadcrumb_shipping_label', esc_html__( 'Shipping', 'checkout-wc' ) ),
			'priority' => 30,
		),
		'payment-tab'     => array(
			'href'     => '#cfw-payment-method',
			'label'    => apply_filters( 'cfw_breadcrumb_payment_label', esc_html__( 'Payment', 'checkout-wc' ) ),
			'priority' => 40,
		),
	);

	if ( ! $show_customer_info_tab ) {
		unset( $default_breadcrumbs['customer_info'] );
	}

	$breadcrumbs = apply_filters( 'cfw_breadcrumbs', $default_breadcrumbs );

	// Order by priority
	uasort( $breadcrumbs, 'cfw_breadcrumb_uasort_comparison' );

	do_action( 'cfw_before_breadcrumb_navigation' );
	?>
    <ul id="cfw-breadcrumb" class="etabs">
		<?php foreach( $breadcrumbs as $id => $breadcrumb ): ?>
		<li class="<?php if ( $id !== 'cart' ) echo "tab"; ?> <?php echo $id; ?>">
			<a href="<?php echo esc_attr( $breadcrumb['href'] ); ?>" class="cfw-small"><?php echo esc_html( $breadcrumb['label'] ); ?></a>
		</li>
		<?php endforeach; ?>
    </ul>
	<?php

	do_action( 'cfw_after_breadcrumb_navigation' );
}

/**
 * User to sort breadcrumbs based on priority with uasort.
 *
 * @since 3.5.1
 * @param array $a First breadcrumb to compare.
 * @param array $b Second breadcrumb to compare.
 * @return int
 */
function cfw_breadcrumb_uasort_comparison( $a, $b ) {
	/*
	 * We are not guaranteed to get a priority
	 * setting. So don't compare if they don't
	 * exist.
	 */
	if ( ! isset( $a['priority'], $b['priority'] ) ) {
		return 0;
	}

	return wc_uasort_comparison( $a['priority'], $b['priority'] );
}

/**
 * @param $name
 *
 * @return mixed|null
 */
function cfw_constant( $name ) {
    if ( ! defined( $name ) ) {
        return null;
    }

    return constant( $name );
}

function cfw_main_container_classes( $context = 'checkout' ) {
	$classes = array();

    $classes[] = 'container';
    $classes[] = 'context-' . $context;
    $classes[] = 'checkoutwc';

    if ( is_admin_bar_showing() ) {
		$classes[] = 'admin-bar';
	}

	if ( cfw_get_main()->get_settings_manager()->get_setting( 'label_style' ) == 'normal' ) {
		$classes[] = 'cfw-label-style-normal';
	}

	if ( cfw_get_main()->get_settings_manager()->get_setting( 'enable_one_page_checkout' ) == 'yes' ) {
		$classes[] = 'cfw-one-page-checkout';
	}

    return apply_filters( "cfw_{$context}_main_container_classes", join( ' ', $classes ) );
}