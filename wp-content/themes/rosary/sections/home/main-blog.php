  <section class="main-blog">
  <?php
  $args = 
  array(
    'post_type' => get_post(get_the_ID())->post_type,
    'posts_per_page' => 1,
    'order' => 'DESC',             

    ); ?>
  <?php $loop = new WP_Query( $args ); ?>
  <?php while ( $loop->have_posts() ) : $loop->the_post();?>     
    <div class="main-blog__item">
      <div class="container-grid">
        <div class="main-blog__text">
          <div class="main-blog__counter">
            01
          </div>
          <a class="main-blog__title" href="single-blog.html">
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
    <div class="main-blog__item">
      <div class="container-grid">
        <div class="main-blog__text">
          <div class="main-blog__counter">
            02
          </div>
          <a class="main-blog__title" href="single-blog.html">
ALTA
<br>
CALIDAD
</a>
          <p class="main-general__description">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          </p>
        </div>
        <div class="main-blog__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_12.png">
        </div>
      </div>
    </div>
  </section>
