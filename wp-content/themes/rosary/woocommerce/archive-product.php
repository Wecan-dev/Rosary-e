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
global $wp_query;
if (get_queried_object_id()!=NULL) {
   get_template_part('sections/category/subcategory');
}
else{ 



$urlsinparametros= explode('?', $_SERVER['REQUEST_URI'], 2);
if ($category_name == NULL){ 
    $urlsinparametros = get_home_url().'/'.get_post(get_the_ID())->post_name;
}else{
  $urlsinparametros = get_home_url().'/product-category/'.$category_name;
}    
$args = arg($_GET["cat"],$_GET["tax"],$_GET["lower"],$_GET["upper"],$_GET['orderby'],$paged,$category_name,$page_name);         
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
    <img src="<?php the_field('image_banner_productos'); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php the_field('title_banner_productos'); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php the_field('subtitle_banner_productos'); ?>
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
          <?php
          global $wpdb;
          $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'orderby' => 'menu_order', 'order' => 'asc' ));  
          ?>                                                        
          <?php foreach($product_categories as $category): ?>
            <?php $checked =NULL;  if ($category->slug == $_GET['cat']) { $checked = "checked='checked'"; } $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?>         
              <li>
                <a href="<?php echo get_home_url().'/tienda?cat='.$category->slug.'&tax=product_cat'?>">
                   <?= $categoria ?>
                </a>
              </li>
              <?php endforeach; ?>  
            </ul>
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              precio
              <span></span>
            </h2>
            <div class="wrapper">
              <fieldset class="filter-price">
               <form method="get">
                <div class="price-field">
                  <input name="lower" id="lower" max="200000" min="10" type="range" value="10">
                  <input name="upper" id="upper" max="200000" min="10" type="range" value="200000">
                </div>
                <div class="price-wrap">
                  <button class="shop-btn trans" type="submit">Filter</button>
                  <div class="d-flex">
                    <span class="price-title">Price:</span>
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
                </form> 
              </fieldset>
            </div>
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Colores
              <span></span>
            </h2>
            <ul class="shop-sidebar__colors">
              <?php
                 global $wpdb;
                 $product_categories = get_categories( array( 'taxonomy' => 'pa_color', 'orderby' => 'menu_order', 'order' => 'asc' ));  
              ?>                                                        
              <?php foreach($product_categories as $category): ?>
              <?php $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?>               
              <li>
                <a href="<?php echo get_home_url() ?>/tienda/?cat=<?php echo $category->slug;?>&tax=pa_color">
                  <?= $categoria ?>
                </a>
              </li>
              <?php endforeach; ?>
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
           <?php 
            //$published_posts = wp_count_posts()->publish;
             $published_posts = count_post_product($_GET["cat"],$_GET["tax"],$_GET["lower"],$_GET["upper"]);
           // $posts_per_page = get_option('posts_per_page');
            $posts_per_page = 12;
            $page_number_max = ceil($published_posts / $posts_per_page);
            $max_page = $page_number_max;
            if (!$paged && $max_page >= 1) {
               $current_page = 1;
            }
            else {
              $current_page = $paged;
            } ?>          
            <h2>Showing <?php echo ''.$current_page.'-'.$max_page.' of '.$published_posts.''; ?> results</h2>            <div class="shop-products__menu">
              <!-- Nav tabs -->
          <!-- Nav tabs -->
          <ul class="nav " id="myTab" role="tablist">
            <li class="nav-item">
              <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><img src="<?php echo get_template_directory_uri();?>/assets/img/productos/menu.png"></a>
            </li>
            <li class="nav-item">
              <a class="" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><img src="<?php echo get_template_directory_uri();?>/assets/img/productos/list.png"></a>
            </li>
          </ul>

             
              
            </div>
          </div>

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">        
          <div class="container-grid">
          <?php $loop = new WP_Query( $args ); ?>
          <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>            
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="<?php the_permalink(); ?>">
                   <?php the_title(); ?>
                </a>
                <p class="main-featured__price">
                  <?php echo $product->get_price_html(); ?>
                </p>
              </div>
            </div>
          <?php endwhile; ?>    
          </div>          
        </div>


        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <?php $loop = new WP_Query( $args ); ?>
          <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>             
            <div class="list_div" id="view" style="display:">
              <table class="shop_table cart wishlist_table wishlist_view traditional responsive  list_table " data-pagination="no" data-per-page="5" data-page="1" data-id="5" data-token="6OL1RPFP5C1P">  
                <tbody class="wishlist-items-wrapper list">
                  <tr id="yith-wcwl-row-20 " class="list-product" data-row-id="20">        
                    <td class="product-thumbnail list">
                      <a href="<?php the_permalink(); ?>">
                        <img class="list" src="<?php the_post_thumbnail_url('full'); ?>">          
                      </a> 
                      <table class="list_table">
                        <tr>
                          <td class="listt"> <a href="<?php the_permalink(); ?>" class="collection-item__title list"><?php the_title(); ?></a></td>
                        </tr>
                        <tr>
                          <td class="listd"><p class="main-products__categorie"><?php if(lang() == 'es'){echo "Categoría: ";}if(lang() == 'en'){echo "Category: ";}  
                            $product_categories = wp_get_post_terms( get_the_ID(), 'product_cat' ); $i = 0;
                            foreach($product_categories as $category):
                              if ($i > 0 ) {echo " / "; } echo $category->name; $i=$i+1;
                            endforeach;?></p></td>
                        </tr>          
                      </table>                         
                    </td>  
                    <td class="product-price list">              
                      <span class="woocommerce-Price-amount amount list"><?php echo $product->get_price_html(); ?>
                    </td>
                                          
                    </tr>    
                  </tbody>
                </table>
              </div>
            <?php endwhile; ?>          
        </div>



     

          </div>

             <div class="blog-general__paginator">
                <?php echo paginate_links(array(
                  "base" => add_query_arg("paged", "%#%"),
                  "format" => '',
                  "type" => "plain",
                  "total" => $max_page,
                  "current" => $current_page,
                  "show_all" => false,
                  "end_size" => 2,
                  "mid_size" => 2,
                  "prev_next" => true,
                  "next_text" => __('<img src="'.get_template_directory_uri().'/assets/img/blog/next.png">'),
                  "prev_text" => __('<img src="'.get_template_directory_uri().'/assets/img/blog/prev.png">'),
                  )); ?>
              </div>

        
           




        </div>
      </div>
    </div>
  </section>
  <script src="<?php echo get_template_directory_uri();?>/assets/js/jquery.min.js"></script>
  <script crossorigin="anonymous" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script crossorigin="anonymous" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri();?>/assets/js/slick.min.js"></script>
  <script src="<?php echo get_template_directory_uri();?>/assets/js/setting-slick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script src="<?php echo get_template_directory_uri();?>/assets/js/main.js"></script>
<?php

}//else
get_footer( 'shop' );


