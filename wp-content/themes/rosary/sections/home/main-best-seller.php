  <section class="main-featured">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        <?php echo get_theme_mod('best_seller_title');?>
      </h2>
      <p class="main-general__subtitle">
        <?php echo get_theme_mod('best_seller_subtitle');?>
      </p>
      <div class="main-featured__carousel">
      <?php          
      $args = array (
             'post_type' => 'product',
             'posts_per_page' => get_theme_mod('best_seller_num_post'),
      );?>
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>      
        <div class="main-featured__product">
          <a href="<?php the_permalink(); ?>" class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
          </a>
          <div class="main-featured__text">
            <a class="main-featured__title" href="<?php the_permalink(); ?>">
               <?php the_title();?>
            </a>
            <p class="main-featured__price">
              <?php echo $product->get_price_html(); ?>
            </p>
            <a class="general-btn__simple" href="<?php the_permalink(); ?>">
               Comprar
            </a>
          </div>
        </div>
      <?php endwhile; ?>    
        
      </div>
    </div>
  </section>