<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
<?php if (get_field('stock_product') == 'No hay Stock'){ ?>
<p class="advise product-notif" data-toggle="tooltip" data-placement="top" title="Actualmente no hay unidades disponibles de este producto, puedes llevarlo bajo Pre orden con un tiempo de entrega aproximado de 15 días hábiles"> 
	<img src="<?php echo get_template_directory_uri();?>/assets/img/star.png">
  ¡Producto disponible bajo pedido!
	</p>
<?php } ?>
