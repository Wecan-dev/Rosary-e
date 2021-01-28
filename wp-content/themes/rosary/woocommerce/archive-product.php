<?php
$pag = get_post(get_the_ID())->post_title;
get_header( 'shop' );

global $wp_query;
if ($_GET['cat']=='yes') {
   get_template_part('sections/category/subcategory');
}
else{ 

if ($_GET['orderby'] == 'menu_order' OR $_GET['orderby'] == NULL ){ $selectm = 'selected="selected"';}
if ($_GET['orderby'] == 'popularity' ){ $selectp = 'selected="selected"';}
if ($_GET['orderby'] == 'rating' ){ $selectr = 'selected="selected"';}
if ($_GET['orderby'] == 'date' ){ $selectd = 'selected="selected"';}
if ($_GET['orderby'] == 'price' ){ $selectpr = 'selected="selected"';}
if ($_GET['orderby'] == 'price-desc' ){ $selectpr_desc = 'selected="selected"';}    

$urlsinparametros= explode('?', $_SERVER['REQUEST_URI'], 2);
   
if($_GET["ct"] != NULL OR $_GET["filter_material"] != NULL OR $_GET["max_price"] != NULL) {
 $show = "show";
}
$args = arg($_GET["cat"],$_GET["tax"],$_GET["lower"],$_GET["upper"],$_GET['orderby'],$paged);         

?>
  <section class="general-banner">
    <img src="<?php echo get_template_directory_uri();?>/assets/img/productos/image_1.jpg">
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
      <div class="container-gridd">

        <div class="shop-products">
          <div class="shop-products__header">
          <div class="shop-products__flex">
                    <a class="shop-products__collpase" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    FILTROS <img src="<?php echo get_template_directory_uri();?>/assets/img/productos/arrow.png" >
  </a>
                  <div class="collapse collapse-filter <?php echo $show ?>" id="collapseExample">
        <div class="shop-sidebar"> 


          <div class="shop-sidebar__content">

             
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Categorías
              <span></span>
            </h2>
            <ul class="shop-sidebar__categories">
          <?php
          global $wpdb;
          $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'orderby' => 'menu_order', 'order' => 'asc', 'parent' =>0  ));  
          ?>                                                        
          <?php foreach($product_categories as $category): ?>
            <?php $checked =NULL;  if ($category->slug == $_GET['cat']) { $checked = "checked='checked'"; } $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?>         
              <li>
                <a href="<?php echo get_home_url().'/product-category/'.$category->slug.'/?'.$urlsinparametros[1].'&ct=1'?>">
                   <?php if (get_queried_object()->slug == $category->slug){ ?> <span class="hover_cat"> <?php echo  $categoria ?></span> <?php }else{ ?> <?php echo  $categoria ?> <?php }  ?>
                </a>
              </li>
              <?php endforeach; ?>  
            </ul>
          </div>
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Colección 
              <span></span>
            </h2>
            <ul class="shop-sidebar__categories">
          <?php
          global $wpdb;
          $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'orderby' => 'menu_order', 'order' => 'asc'  ));  
          ?>                                                        
          <?php foreach($product_categories as $category): ?>
            <?php $checked =NULL;  if ($category->slug == $_GET['cat']) { $checked = "checked='checked'"; } $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?> 
            <?php if($category->parent >1){ ?>         
              <li>
                <a href="<?php echo get_home_url().'/product-category/'.$category->slug.'/?'.$urlsinparametros[1].'&col=1'?>">
                   <?php if (get_queried_object()->slug == $category->slug){ ?> <span class="hover_cat"> <?php echo  $categoria ?></span> <?php }else{ ?> <?php echo  $categoria ?> <?php }  ?>
                </a>
              </li>
            <?php } ?>  
              <?php endforeach; ?>  
            </ul>
          </div>          
          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              precio
              <span></span>
            </h2>
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
          </div>
         <!-- <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Colores 
              <span></span>
            </h2>
            <ul class="shop-sidebar__colors">
              <?php //
                 global $wpdb;
                 $product_categories = get_categories( array( 'taxonomy' => 'pa_color-pedreria', 'orderby' => 'menu_order', 'order' => 'asc' ));  
              ?>                                                        
              <?php //foreach($product_categories as $category): ?>
              <?php// $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?>               
              <li>
                <a href="<?php //echo get_home_url() ?>/tienda/?cat=<?php// echo $category->slug;?>&tax=pa_color-pedreria">
                  <?php// if ($_GET["cat"] != NULL && $_GET["cat"] == $category->slug){ ?> <span class="hover_cat"> <?php //echo  $categoria ?></span> <?php// }else{ ?> <?php// echo  $categoria ?> <?//php }  ?>
                </a>
              </li>
              <?php// endforeach; ?>
            </ul>
          </div>-->

          <div class="shop-sidebar__content">
            <h2 class="shop-sidebar__title">
              Mix de Materiales 
              <span></span>
            </h2>
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
          </div>

          <div class="shop-sidebar__newsletter">
            <input placeholder="Email for Newsletter" type="Email">
            <a href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/productos/envelope.png">
</a>
          </div>
        </div>
</div>
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
            <h2><?php echo woocommerce_result_count();  ?></h2> 
          
      
          
        </div>
        <div class="shop-products__menu">
       

              <!-- Nav tabs -->
          <!-- Nav tabs -->
          <?php echo woocommerce_catalog_ordering();  ?> 
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
          <?php
          if ( woocommerce_product_loop() ) {
            if ( wc_get_loop_prop( 'total' ) ) {
              while ( have_posts() ) {
                the_post();

                /** * Hook: woocommerce_shop_loop.  */
          ?>              
            <div class="main-featured__product">
              <div href="<?php the_permalink(); ?>" class="main-featured__img">
                <img src="<?php the_post_thumbnail_url('full');?>">
                <div class="main-featured__mask" style="background-image: url('<?php the_field('imagen_hover_del_producto'); ?>')" >
                  <a class="link-product" href="<?php the_permalink(); ?>"></a>
                  <div class="main-featured__icon" >                   
                    <a>
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/star.png">
                    </a>  
					  <a href="?add_to_wishlist=<?php echo get_the_ID(); ?>">
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                    </a>                   
                    <a href="<?php the_permalink(); ?>">
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/search.png">
                    </a>
                  </div>
                </div>
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
            <?php
               }
               }
            ?>
            <?php
              woocommerce_product_loop_end();

              /**
               * Hook: woocommerce_after_shop_loop.
               *
               * @hooked woocommerce_pagination - 10
               */
            ?> 
       
          </div> 
			      <div class="blog-general__paginator">
              <?php do_action( 'woocommerce_after_shop_loop' ); ?>
            </div>
            <?php              
            } else {
              /**
               * Hook: woocommerce_no_products_found.
               *
               * @hooked wc_no_products_found - 10
               */
              do_action( 'woocommerce_no_products_found' );
            } ?>   
        </div>


        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="categorie-product__list">
          <?php
          if ( woocommerce_product_loop() ) {
            if ( wc_get_loop_prop( 'total' ) ) {
              while ( have_posts() ) {
                the_post();

                /** * Hook: woocommerce_shop_loop.  */
          ?>            
            <div class="main-featured__product">
              <div class="main-featured__img">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
              </div>
              <div class="main-featured__text">
                <a class="main-featured__title" href="<?php the_permalink(); ?>">
                   <?php the_title(); ?>
                </a>
          <p class="main-featured__description">
                    <?php if(lang() == 'es'){echo "Categoría: ";}if(lang() == 'en'){echo "category: ";}  
                    $product_categories = wp_get_post_terms( get_the_ID(), 'product_cat' ); $i = 0;
                    foreach($product_categories as $category):
                      if ($i > 0 ) {echo " / "; } echo $category->name; $i=$i+1;
                    endforeach;?>

                  </p>
           <div class="main-featured__description">
                   <?php the_content(); ?>
                </div>
                <p class="main-featured__price">
                  <?php echo $product->get_price_html(); ?>
                </p>
              </div>
            </div>
            <?php
               }
               }
            ?>
            <?php
              woocommerce_product_loop_end();

              /**
               * Hook: woocommerce_after_shop_loop.
               *
               * @hooked woocommerce_pagination - 10
               */
            ?> 
            <div class="blog-general__paginator">
              <?php do_action( 'woocommerce_after_shop_loop' ); ?>
            </div>
            <?php              
            } else {
              /**
               * Hook: woocommerce_no_products_found.
               *
               * @hooked wc_no_products_found - 10
               */
              do_action( 'woocommerce_no_products_found' );
            } ?>           
          </div>
        </div>



     

          </div>



        
           




        </div>
      </div>
    </div>
  </section>
<style type="text/css">
span.count {
    display: none;
}
</style>
  <script>

var lowerSlider = document.querySelector('#lower');
var upperSlider = document.querySelector('#upper');

document.querySelector('#two').value = upperSlider.value;
document.querySelector('#one').value = lowerSlider.value;

var lowerVal = parseInt(lowerSlider.value);
var upperVal = parseInt(upperSlider.value);

upperSlider.oninput = function () {
  lowerVal = parseInt(lowerSlider.value);
  upperVal = parseInt(upperSlider.value);

  if (upperVal < lowerVal + 4) {
    lowerSlider.value = upperVal - 4;
    if (lowerVal == lowerSlider.min) {
      upperSlider.value = 4;
    }
  }
  document.querySelector('#two').value = this.value
};

lowerSlider.oninput = function () {
  lowerVal = parseInt(lowerSlider.value);
  upperVal = parseInt(upperSlider.value);
  if (lowerVal > upperVal - 4) {
    upperSlider.value = lowerVal + 4;
    if (upperVal == upperSlider.max) {
      lowerSlider.value = parseInt(upperSlider.max) - 4;
    }
  }
  document.querySelector('#one').value = this.value
};

</script>

<?php

}//else
get_footer( 'shop' );


