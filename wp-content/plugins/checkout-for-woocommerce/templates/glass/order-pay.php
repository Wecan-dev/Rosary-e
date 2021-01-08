<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'cfw_order_pay_before_main_container', $order ); ?>
<main id="cfw" class="<?php echo cfw_main_container_classes( 'order-pay' ); ?> cfw-payment-method-active">
	<?php do_action( 'cfw_order_pay_main_container_start', $order ); ?>

    <div class="row">
        <!-- Order Review -->
        <div id="cfw-order-review" class="col-lg-7 cfw-rp" role="main">
            <?php do_action( 'cfw_order_pay_before_order_review' ); ?>

            <?php if ( ! empty( $order ) ) : ?>
	            <?php do_action( 'cfw_order_pay_content', $order, $call_receipt_hook, $available_gateways, $order_button_text ); ?>
            <?php endif; ?>

            <?php do_action( 'cfw_order_pay_after_order_review' ); ?>
        </div>

        <!-- Cart / Sidebar Column -->
        <div id="cfw-cart-summary" class="col-lg-5" role="complementary">
            <?php if ( ! empty( $order ) ) : ?>
	            <?php do_action( 'cfw_order_pay_cart_summary', $order ); ?>
            <?php endif; ?>
        </div>
    </div>

	<?php do_action( 'cfw_order_pay_main_container_end', $order ); ?>
</main>
<?php do_action( 'cfw_order_pay_after_main_container', $order );