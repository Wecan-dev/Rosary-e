<?php

namespace Objectiv\Plugins\Checkout\Compatibility\Plugins;

use Objectiv\Plugins\Checkout\Compatibility\Base;

class PWGiftCardsPro extends Base {
	public function is_available() {
		return defined( 'PWGC_GIFT_CARD_NOTIFICATIONS_META_KEY' );
	}

	public function run_on_checkout() {
		add_action( 'cfw_coupon_module_end', array( $this, 'render_gift_card_form' ), 51 );
	}

	public function run_on_wp_loaded() {
		global $pw_gift_cards_redeeming;

		remove_action( 'woocommerce_before_checkout_form', array( $pw_gift_cards_redeeming, 'woocommerce_before_checkout_form' ), 40 );
		remove_action( 'woocommerce_review_order_before_submit', array( $pw_gift_cards_redeeming, 'woocommerce_review_order_before_submit' ) );
	}

	public static function render_gift_card_form() {
		wp_enqueue_script( 'pw-gift-cards' );

		$location = get_option( 'pwgc_redeem_checkout_location', 'review_order_before_submit' );

		if ( 'review_order_before_submit' === $location || 'before_checkout_form' === $location ) {
			?>
			<style>
				#pwgc-redeem-error:empty {
					display: none;
				}
			</style>

            <div id="pwgc-redeem-gift-card-form" style="margin: 1em 0;">
				<div class="row">
					<div class="col-lg-12" id="pwgc-redeem-error" style="color:#721c24; background-color: #f8d7da; border-color:#f5c6cb; padding: 15px; margin-bottom: 1rem; border-radius: 4px; line-height:1.625;"></div>
				</div>
				<div class="row cfw-input-wrap-row">
					<div class="col-lg-8 no-gutters">
						<div class="col-lg-12">
							<div class="cfw-input-wrap cfw-text-input">
								<label class="form-row" id="pwgc-redeem-gift-card-number-label" for="pwgc-redeem-gift-card-number"><?php cfw_e( 'Gift card number', 'pw-woocommerce-gift-cards' ); ?></label>
								<input type="text" id="pwgc-redeem-gift-card-number" name="card_number" autocomplete="off" placeholder="<?php cfw_esc_html_e( 'Gift card number', 'pw-woocommerce-gift-cards' ); ?>">
							</div>
						</div>
					</div>

					<div class="col-lg-4">
						<input class="cfw-secondary-btn" type="submit" id="pwgc-redeem-button" data-wait-text="..." value="<?php esc_html_e( 'Apply', 'checkout-wc' ); ?>">
					</div>
				</div>
			</div>
			<?php
		}

		?>
		<script>
            jQuery(function() {
                jQuery('.pwgc-remove-card').on('click', function(e) {
                    var cardNumber = jQuery(this).attr('data-card-number');

                    jQuery.post(pwgc.ajaxurl, {'action': 'pw-gift-cards-remove', 'card_number': cardNumber, 'security': pwgc.nonces.remove_card}, function( result ) {
                        location.reload();
                    }).fail(function(xhr, textStatus, errorThrown) {
                        if (errorThrown) {
                            alert(errorThrown);
                        } else {
                            alert('Unknown Error');
                        }
                        location.reload();
                    });

                    e.preventDefault();
                    return false;
                });
            });
		</script>
		<?php
	}
}