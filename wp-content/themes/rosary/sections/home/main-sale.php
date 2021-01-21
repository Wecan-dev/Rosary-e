<?php if (get_theme_mod('sale_image') != NULL) { ?>

<div class="main-sale">
    <div class="container-grid">
      <div class="main-sale__text">
        <p class="main-sale__description">
          <?php echo get_theme_mod('sale_description'); ?>
        </p>
        <h2 class="main-sale__title">
          <?php echo get_theme_mod('sale_title'); ?>
        </h2>
        <a target="_blank" class="general-btn__simple" href="<?php echo get_theme_mod('sale_url_buttom'); ?>">
          <?php echo get_theme_mod('sale_buttom'); ?>
        </a>
      </div>
      <div class="main-sale__img">
        <img src="<?php echo get_theme_mod('sale_image'); ?>">
      </div>
    </div>
  </div>

<?php } ?>  