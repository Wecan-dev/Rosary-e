<?php get_header(); ?>
  <section class="error-404">
    <img src="<?php echo get_template_directory_uri();?>/assets/img/404/image.png">
    <div class="error-404__text">
      <h2 class="error-404__title">
        lo sentimos
      </h2>
      <p class="error-404__subtitle">
        NO PODEMOS ENCONTRAR LA PÁGINA QUE BUSCAS
      </p>
      <h2 class="error-44__number">
        404
      </h2>
      <h2 class="error-404__title--bold error-404__title">
        Te llevaremos de vuelta
      </h2>
      <a class="general-btn__rose" href="<?php echo get_home_url() ?>">
HOME
</a>
    </div>
  </section>
<?php get_footer(); ?>