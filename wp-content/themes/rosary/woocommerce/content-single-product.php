<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
rosary_custom_product_woocommmerce();

function products(){
  return get_the_ID();
}


/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<section class="product-details" > 
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	</div>
	</section>
	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php //do_action( 'woocommerce_after_single_product' ); ?>


  <section class="custom-description custom-description--rose">
    <div class="padding-right-left">
      <h2 class="main-general__title">
        Descripción
      </h2>
      <p class="main-general__subtitle">
        del producto
      </p>
      <p class="custom-description__text">
        <?php foreach((get_the_terms(get_the_ID(), 'product_cat' )) as $category) { $cate =$category->slug;} 
        echo str_replace("\n", '<br>', termmeta_value( 'descripcion_completa', $category->term_id )); ?>
      </p>
    </div>
  </section>

  <section class="main-featured main-featured--white">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        Otros tesoros
      </h2>
      <p class="main-general__subtitle">
        de la colección
      </p>
      <div class="main-featured__carousel">
      <?php foreach((get_the_terms(get_the_ID(), 'product_cat' )) as $category) { $cate =$category->slug;}
          $loop   = new WP_QUERY(array(
              'post_type'         => 'product',
              'posts_per_page'    => 100,
              'post__not_in'      =>array(get_the_ID()),
              'orderby'           =>'rand',
              'tax_query' => array(
                 array(
                     'taxonomy'  => 'product_cat',
                     'field'     => 'slug',
                     'terms'     =>  $cate,
                 )),              

          ));

          if ( $loop->have_posts() ){ while ( $loop->have_posts() ){ $loop->the_post(); global $product;


       ?>     
        <div class="main-featured__product">
          <div class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
          </div>
          <div class="main-featured__text">
            <a class="main-featured__title" href="<?php the_permalink(); ?>">
               <?php the_title();?>
            </a>
            <p class="main-featured__price">
              <?php echo $product->get_price_html(); ?>
            </p>
          </div>
        </div>
      <?php   }}  wp_reset_query();?>  
        
      </div>
    </div>
  </section>  

<style type="text/css">
	nav.woocommerce-breadcrumb {
    display: none;
}
</style>