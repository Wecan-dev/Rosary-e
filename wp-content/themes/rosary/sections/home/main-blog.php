  <section class="main-blog">
  <?php
  $args = 
  array(
    'post_type' => 'post',
    'posts_per_page' => 2,
    'order' => 'DESC',             

    ); ?>
  <?php $loop = new WP_Query( $args ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post(); $i = $i +1;?>     
    <div class="main-blog__item">
      <div class="container-grid">
        <div class="main-blog__text">
          <div class="main-blog__counter">
            0<?php echo $i; ?>
          </div>
          <a class="main-blog__title" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
          <p class="main-general__description">
           <?php echo excerpt(30); ?>
          </p>
        </div>
        <div class="main-blog__img">
          <img src="<?php the_post_thumbnail_url('full'); ?>">
        </div>
      </div>
    </div>
  <?php endwhile; ?>    
  </section>
