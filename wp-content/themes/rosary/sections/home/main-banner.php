  <section class="main-banner">    
    <div class="main-banner__content">
      <?php $args = array('post_type' => 'itemsbanner', 'order'=> 'ASC','post_status' => 'publish', 'posts_per_page' => 100); ?>        
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>     
     <?php if (get_field('banner_option') == "Imagen") { ?>
      <div class="main-banner__item">
        <div class="main-banner__text wow animated fadeIn" style="visibility: visible; animation-delay: .3s  ;">
          <div class="main-banner__title">
            <h2>
               <?php the_field('banner_title'); ?>
            </h2>
          </div>
        </div>
        <div class="main-banner__img">
          <img alt="Imagen Banner" src="<?php the_field('banner_image'); ?>">
        </div>
      </div>
    <?php }else{ ?> 
      <div class="main-banner__item main-banner__video">
        <div class="main-banner__text">
          <div class="main-banner__title">
            <h2>
               <?php the_field('banner_title'); ?>
            </h2>
          </div>
        </div>
        <div class="main-banner__img">
          <video autoplay loop muted id="myVideo" src="<?php the_field('banner_video'); ?>"> </video>
        </div>
      </div>
    <?php } ?> 
    <?php endwhile; ?>     
    </div>
  </section>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".main-banner__video .main-banner__text").fadeOut(5000);
    },3000);
 
 
});
</script>