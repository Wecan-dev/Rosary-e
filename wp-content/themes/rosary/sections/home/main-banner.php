  <section class="main-banner">    
    <div class="main-banner__content">
    <?php for ($i=1; $i <=3 ; $i++) { ?>  
      <div class="main-banner__item">
        <div class="main-banner__text wow animated fadeIn" style="visibility: visible; animation-delay: .3s  ;">
          <div class="main-banner__title">
            <h2>
                <?php echo get_theme_mod('banner_title_'.$i.'');?>
            </h2>
          </div>
        </div>
        <div class="main-banner__img">
          <img alt="Imagen Banner" src="<?php echo get_theme_mod('banner_image_'.$i.''); ?>">
        </div>
      </div>
    <?php } ?> 
    </div>
  </section>