<section class="main-about">
    <div class="padding-top-bottom padding-right-left">
      <h2 class="main-general__title">
        <?php echo get_theme_mod('about_title');?>
      </h2>
      <p class="main-general__subtitle">
        <?php echo get_theme_mod('about_subtitle');?>
      </p>
      <div class="container-grid">
        <div class="main-about__img">
			<img class="main-about__img--xs" src="<?php echo get_theme_mod('about_image2');?>">
          <img class="main-about__img--xl" src="<?php echo get_theme_mod('about_image');?>">
        </div>
        <div class="main-about__text">
          <p class="main-general__description"><?php echo str_replace ( "\n", "<br><br>", get_theme_mod('about_description'));?></p>
          <a class="main-about__btn" href="<?php echo get_theme_mod('about_url_buttom');?>">
<?php echo get_theme_mod('about_buttom');?>
<i class="fa fa-angle-right"></i>
</a>
        </div>
      </div>
    </div>
  </section>