<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $current_user;
if(is_user_logged_in() != NULL)
{ 
 // $user_logged = meta_user_value( 'user_registration_cedula_identidad', $current_user->ID );
  $user_logged =  $current_user->display_name; 
  
}

meta_user_value( $meta_key, $post_id );
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>
<section class="checkout-grid">
<div class="d-flex justify-content-center" >
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
<div class="container-grid" >
	
	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			
			<div class="col-12">
				<h2 class="checkout-title" >
				checkout information
			</h2>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>

			<div class="col-12">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	<div class="checkout-cart" >
		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<!--<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>-->
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</div>
	
	</div>

</form>
	</div>

<?php //do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<div class="checkout-cart">
	
</div>
</section>
<style type="text/css">

</style>
<script type="text/javascript">
    
    var user_logged = "<?= $user_logged ?>"; 
    $("input#additional_wooccm0").val(user_logged);
	$('#order_review').appendTo('.contact-sidebar');
	$('#payment').appendTo('#customer_details');
</script>