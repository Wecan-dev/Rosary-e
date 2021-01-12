<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<ul class="order_details">
	<li class="order">
		<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
		<strong><?php echo esc_html( $order->get_order_number() ); ?></strong>
	</li>
	<li class="date">
		<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
		<strong><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></strong>
	</li>
	<li class="total">
		<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
		<strong><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
	</li>
	<?php if ( $order->get_payment_method_title() ) : ?>
	<li class="method">
		<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
		<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
	</li>
	<?php endif; ?>
</ul>

<?php do_action( 'woocommerce_receipt_' . $order->get_payment_method(), $order->get_id() ); ?>

<div class="clear"></div>
<style>
	.order_details {
		background: #fff;
		display: flex!important;
		justify-content: center;
		flex-wrap: wrap;
	}
	.checkout-custom {
	background-image: none!important;	
		    padding-top: 40px;
    padding-bottom: 60px;
	}
	#epayco_form > button {
	font-size: 13px!important;
    color: #000000!important;
    border-radius: 2px!important;
    background-color: #d0bd9b!important;
    border: none;
    width: 215px!important;
    height: 50px!important;
    display: flex;
    text-transform: uppercase;
    border-color: transparent;
    border-width: 0!important;
    font-family: Brandon Text Bold!important;
}
	#epayco_form > button img {
		display: none!important;
	}

</style>

<script>
$('#epayco_form > button').text('Pagar con ePayco')
</script>