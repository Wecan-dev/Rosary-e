<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
//do_action( 'woocommerce_before_main_content' );

?>
<!--<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>-->
<?php
//if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	//do_action( 'woocommerce_before_shop_loop' );

	//woocommerce_product_loop_start();

	//if ( wc_get_loop_prop( 'total' ) ) {
		//while ( have_posts() ) {
			//the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			//do_action( 'woocommerce_shop_loop' );

			//wc_get_template_part( 'content', 'product' );
		//}
	//}

	//woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	//do_action( 'woocommerce_after_shop_loop' );
//} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	//do_action( 'woocommerce_no_products_found' );
//}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
//do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );
?>
  <section class="general-banner">
    <img src="<?php echo get_template_directory_uri();?>/assets/img/productos/image_1.png">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        Productos
      </h2>
      <p class="general-banner__subtitle">
        Rosary
      </p>
    </div>
  </section>
  <section class="shop">
    <div class="padding-right-left padding-top-bottom">
      <div class="container-grid">
        <div class="shop-sidebar">
          <div class="shop-sidebar__content">
            <select>
<option>
Filtros
</option>
<option>
1
</option>
<option>
1
</option>
</select>
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Categorías
              <span></span>
            </h2>
            <ul class="shop-sidebar__categories">
              <li>
                <a href="">
Pulseras
</a>
              </li>
              <li>
                <a href="">
Aretes
</a>
              </li>
              <li>
                <a href="">
Candongas
</a>
              </li>
              <li>
                <a href="">
Collares
</a>
              </li>
              <li>
                <a href="">
Anillos
</a>
              </li>
              <li>
                <a href="">
Gargantillas
</a>
              </li>
            </ul>
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              precio
              <span></span>
            </h2>
            <div class="wrapper">
              <fieldset class="filter-price">
                <div class="price-field">
                  <input id="lower" max="100" min="10" type="range" value="10">
                  <input id="upper" max="100" min="10" type="range" value="100">
                </div>
                <div class="price-wrap">
                  <a class="shop-btn" href="">Filtro</a>
                  <div class="d-flex">
                    <span class="price-title">Precio:</span>
                    <div class="price-wrap-1">
                      <label for="one">$</label>
                      <input id="one">
                    </div>
                    <div class="price-wrap_line">-</div>
                    <div class="price-wrap-2">
                      <label for="two">$</label>
                      <input id="two">
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Colores
              <span></span>
            </h2>
            <ul class="shop-sidebar__colors">
              <li>
                <a href="">
Oro rosa
</a>
              </li>
              <li>
                <a href="">
Plata
</a>
              </li>
              <li>
                <a href="">
Oro
</a>
              </li>
              <li>
                <a href="">
Bronce
</a>
              </li>
            </ul>
          </div>
          <div class="shop-sidebar__newsletter">
            <input placeholder="Email for Newsletter" type="Email">
            <a href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/productos/envelope.png">
</a>
          </div>
        </div>
        <div class="shop-products">
          <div class="shop-products__header">
            <h2>Showing 1-12 of 16 results</h2>
            <div class="shop-products__menu">
              <img src="<?php echo get_template_directory_uri();?>/assets/img/productos/list.png">
              <img src="<?php echo get_template_directory_uri();?>/assets/img/productos/menu.png">
            </div>
          </div>
          <div class="container-grid">
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image-1_2.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image-1.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image_2.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image_3.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image-1_2.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image-1.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image_2.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image_3.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image-1_2.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image-1.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image_2.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/new-in/image_3.png">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="">
Aretes de estrellas - Dorado
</a>
                <p class="main-featured__price">
                  $200.000
                </p>
              </div>
            </div>
          </div>
          <div class="blog-general__paginator blog-general__paginator--center">
            <a class="blog-general__page-all" href="">Mostrar todo</a>
            <a href="">1</a>
            <a href="">2</a>
            <a href="">...</a>
            <a href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/blog/next.png">
</a>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php
get_footer( 'shop' );
