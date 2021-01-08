<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'cfw_thank_you_before_main_container', $order ); ?>
<main id="cfw" class="<?php echo cfw_main_container_classes( 'thank-you' ); ?>">
    <?php do_action( 'cfw_thank_you_main_container_start', $order ); ?>

    <?php if ( ! empty( $order ) ) : ?>
        <div class="row">
            <!-- Order Review -->
            <div id="order_review" class="col-lg-7 cfw-rp" role="main">
	            <?php do_action( 'cfw_thank_you_before_order_review' ); ?>
                <?php do_action( 'cfw_thank_you_content', $order, $order_statuses, $show_downloads, $downloads ); ?>

	            <?php
	            /**
	             * Prevent thank you hooks from running when viewing order
	             *
	             * If we don't do this, tracking scripts will be distorted.
	             */
	            if ( empty( $_GET['view'] ) ): ?>
		            <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>
	            <?php endif; ?>

	            <?php do_action( 'cfw_thank_you_after_order_review' ); ?>
            </div>

            <!-- Cart / Sidebar Column -->
            <div id="cfw-cart-summary" class="col-lg-5" role="complementary">
                <?php do_action( 'cfw_thank_you_cart_summary', $order ); ?>
            </div>
        </div>
    <?php endif; ?>

    <?php do_action( 'cfw_thank_you_main_container_end', $order ); ?>
</main>
<?php do_action( 'cfw_thank_you_after_main_container', $order );