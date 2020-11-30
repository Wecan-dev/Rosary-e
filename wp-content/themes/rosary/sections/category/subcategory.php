  <section class="general-banner">
    <img src="<?php echo termmeta_value_img( 'banner_categories', get_queried_object()->term_id ); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php echo get_queried_object()->name; ?>
      </h2>
    </div>
  </section>
  <section class="custom-description custom-description--rosa">
    <div class="padding-right-left">
      <h2 class="main-general__title">
        Descripción
      </h2>
      <p class="main-general__subtitle">
        Categoría
      </p>
      <p class="custom-description__text">
         <?php echo str_replace("\n", "<br>", termmeta_value( 'descripcion_completa', get_queried_object()->term_id )); ?>
      </p>

    </div>
  </section>
  <section class="main-featured main-featured--white">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        productos relacionados
      </h2>
      <p class="main-general__subtitle">
        del producto
      </p>
      <div class="main-featured__carousel">
     <?php foreach((get_the_terms(get_the_ID(), 'product_cat' )) as $category) { $cate =$category->slug;}
          $loop   = new WP_QUERY(array(
              'post_type'         => 'product',
              'posts_per_page'    => 100,
              'orderby'           =>'rand',
              'tax_query' => array(
                 array(
                     'taxonomy'  => 'product_cat',
                     'field'     => 'slug',
                     'terms'     => get_queried_object()->slug,
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
