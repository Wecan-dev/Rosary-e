<?php
$pag = get_post(get_the_ID())->post_title;
get_header( 'shop' );

global $wp_query;
if (get_queried_object_id()!=NULL) {
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
if ($category_name == NULL){ 
    $urlsinparametros = get_home_url().'/'.get_post(get_the_ID())->post_name;
}else{
  $urlsinparametros = get_home_url().'/product-category/'.$category_name;
}    

$args = arg($_GET["cat"],$_GET["tax"],$_GET["lower"],$_GET["upper"],$_GET['orderby'],$paged);         

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

                <form class="woocommerce-ordering" method="get">
                  <select name="orderby" class="orderby" aria-label="Shop order">
                      <option value="menu_order" <?php echo $selectm ?>>Default sorting</option>
                      <option value="popularity" <?php echo $selectp ?>>Sort by popularity</option>
                      <option value="rating" <?php echo $selectr ?>>Sort by average rating</option>
                      <option value="date" <?php echo $selectd ?>>Sort by latest</option>
                      <option value="price" <?php echo $selectpr ?>>Sort by price: low to high</option>
                      <option value="price-desc" <?php echo $selectpr_desc ?>>Sort by price: high to low</option>
                  </select>
                </form>
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
                  <button class="shop-btn trans" type="submit">Filtrar</button>
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
              <a href="<?php the_permalink(); ?>" class="main-featured__img">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
              </a>
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
          <div class="categorie-product__list">

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
					<?php endwhile; ?>        	
					</div>
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


