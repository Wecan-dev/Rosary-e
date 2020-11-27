  <section class="main-categories">
  <?php $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'posts_per_page' => 2, 'orderby' => 'menu_order', 'order' => 'asc' )); $i = 0; ?>
  <?php foreach($product_categories as $category):  global $wpdb;?>
  <?php $result = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."term_taxonomy where taxonomy = 'product_cat'");?>    
  <?php if ($i <= 1) { ?>
    <div class="main-categories__item">
      <div class="container-grid">
        <div class="main-categories__details">
          <img class="main-categories__icon" src="<?php echo get_template_directory_uri();?>/assets/img/logo_2.png">
          <p class="main-categories__text">
            <?=$category->description ?>
          </p>
          <img class="main-categories__poster" src="<?php echo termmeta_value_img( 'poster_categories', $category->term_id ); ?>">
          <a class="general-btn__simple" href="<?php echo get_category_link( $category->term_id ); ?>">
            Comprar ahora
          </a>
        </div>
        <div class="main-categories__img">
          <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ) );?>">
          <div class="main-categories__mask">
            <h2 class="main-categories__title">
              <?=$category->name ?>
            </h2>
          </div>
        </div>
      </div>
    </div>
  <?php } $i = $i + 1; endforeach; ?>   
  </section>
  <section class="main-break">
    <div class="main-break__img">
      <img src="<?php echo get_theme_mod('categories_image'); ?>">
      <div class="main-break__mask">
		  <p class="main-categories__title" >
			  <?php echo get_theme_mod('categories_title'); ?>
		  </p>
      </div>
    </div>
  </section>
  <section class="main-categories">
  <?php $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'posts_per_page' => 2, 'orderby' => 'menu_order', 'order' => 'asc' )); $i = 0; ?>
  <?php foreach($product_categories as $category):  global $wpdb;?>
  <?php $result = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."term_taxonomy where taxonomy = 'product_cat'");?>    
  <?php if ($i > 1) { ?>    
    <div class="main-categories__item">
      <div class="container-grid">
        <div class="main-categories__details">
          <img class="main-categories__icon" src="<?php echo get_template_directory_uri();?>/assets/img/logo_2.png">
          <p class="main-categories__text">
            <?=$category->description ?>
          </p>
          <img class="main-categories__poster" src="<?php echo get_template_directory_uri();?>/assets/img/image_4.png">
          <a class="general-btn__simple" href="<?php echo get_category_link( $category->term_id ); ?>">
            Comprar ahora
          </a>
        </div>
        <div class="main-categories__img">
          <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ) );?>">
          <div class="main-categories__mask">
            <h2 class="main-categories__title">
              <?=$category->name ?>
            </h2>
          </div>
        </div>
      </div>
    </div>
   <?php } $i = $i + 1; endforeach; ?>      
  </section>