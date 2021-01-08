<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'cfw_checkout_before_main_container', WC()->checkout() ); ?>
<main id="cfw" class="<?php echo cfw_main_container_classes(); ?>">
    <div class="row">
        <div class="col-lg-7 cfw-rp">
			<?php do_action( 'cfw_checkout_main_container_start' ); ?>
        </div>
    </div>

	<?php if ( ! apply_filters( 'cfw_replace_form', false ) ) : ?>
		<form <?php cfw_form_attributes(); ?>>
			<!-- Order Review -->
            <?php do_action( 'cfw_checkout_before_order_review_container' ); ?>

            <div id="order_review" class="col-lg-7 cfw-rp" role="main">
                <?php do_action('cfw_checkout_before_order_review' ); ?>

				<?php do_action( 'cfw_checkout_tabs' ); ?>

                <?php do_action( 'cfw_checkout_after_order_review' ); ?>
            </div>

            <?php do_action( 'cfw_checkout_after_order_review_container' ); ?>

            <!-- Cart Summary -->
            <div id="cfw-cart-summary" class="col-lg-5" role="complementary">
                <?php do_action( 'cfw_checkout_cart_summary' ); ?>
            </div>

			<?php do_action( 'cfw_checkout_after_cart_summary_container' ); ?>
		</form>
	<?php else : ?>
		<?php do_action( 'cfw_checkout_form' ); ?>
	<?php endif; ?>

    <div class="row">
        <div class="col-lg-7">
			<?php do_action( 'cfw_checkout_main_container_end', WC()->checkout() ); ?>
        </div>
    </div>
</main>
<?php do_action( 'cfw_checkout_after_main_container', WC()->checkout() );