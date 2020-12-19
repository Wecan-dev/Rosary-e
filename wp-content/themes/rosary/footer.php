  <footer class="main-footer">
    <div class="padding-right-left padding-top-bottom">
      <div class="container-grid">
        <div class="main-footer__item">
          <div class="main-footer__logo">
            <img src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
          </div>
          <p class="main-footer__description">
            <?php echo get_theme_mod('description_contact'); ?>
          </p>
          <div class="main-footer__rrss">
            <p>Síguenos</p>

                <?php if (get_theme_mod('pinterest')!=NULL) {?>                
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('pinterest'); ?>"><img src="<?php echo get_theme_mod('pinterest_image'); ?>"></a>               
                <?php } ?>
                <?php if (get_theme_mod('vimeo')!=NULL) {?> 
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('vimeo'); ?>"><img src="<?php echo get_theme_mod('vimeo_image'); ?>"></a>
                <?php } ?>                
                <?php if (get_theme_mod('youtube')!=NULL) {?>
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('youtube'); ?>"><img src="<?php echo get_theme_mod('youtube_image'); ?>"></a>
                <?php } ?>
                <?php if (get_theme_mod('facebook')!=NULL) {?>
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('facebook'); ?>"><img src="<?php echo get_theme_mod('facebook_image'); ?>"></a>
                <?php } ?>
                <?php if (get_theme_mod('instagram')!=NULL) {?>
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('instagram'); ?>"><img src="<?php echo get_theme_mod('instagram_image'); ?>"></a>
                <?php } ?>
                <?php if (get_theme_mod('twitter')!=NULL) {?>
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('twitter'); ?>"><img src="<?php echo get_theme_mod('twitter_image'); ?>"></a>
                <?php } ?>   
                <?php if (get_theme_mod('linkedin')!=NULL) {?>
                  <a class="rrss__item" target="_blank" href="<?php echo get_theme_mod('linkedin'); ?>"><img src="<?php echo get_theme_mod('linkedin_image'); ?>"></a>
                <?php } ?>        

          </div>
        </div>
        <div class="main-footer__item">
          <h2 class="main-footer__title">
            Quick Shop
          </h2>
          <ul class="site-map">
            <li>
              <a href="<?php echo get_home_url() ?>/new-in">
New in
</a>
            </li>
     
            <li>
              <a href="<?php echo get_home_url() ?>/tienda">
Productos
</a>
            </li>
            <!-- <li>
              <a href="<?php echo get_home_url() ?>/cats&dogs">
Cats & Dogs
</a>
            </li> -->
          <!--   <li>
              <a href="<?php //echo get_home_url() ?>/complementos-accesorios">
Accesorios
</a>
            </li> -->
            <li>
              <a href="<?php echo get_home_url() ?>/personalizados">
Personalizados
</a>
            </li>
          </ul>
        </div>
        <div class="main-footer__item">
          <h2 class="main-footer__title">
            Información
          </h2>
          <ul class="site-map">
            <li>
              <a href="<?php echo get_home_url() ?>/nosotros">
About Rosary
</a>
            </li>
            <li>
              <a href="<?php echo get_home_url() ?>/guia-de-tallas">
Guía de tallas
</a>
            </li>
            <li>
              <a href="<?php echo get_home_url() ?>/entregas-y-devoluciones">
Envíos y entregas
</a>
            </li>
            <li>
              <a href="<?php echo get_home_url() ?>/politicas-y-privacidad">
Políticas y privacidad
</a>
            </li>
            <li>
              <a href="<?php echo get_home_url() ?>/terminos-y-condiciones">
Términos y condiciones
</a>
            </li>
          </ul>
        </div>
        <div class="main-footer__item">
          <h2 class="main-footer__title">
            Contáctanos
          </h2>
          <ul class="main-footer__contact">
            <!--<li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/place.png">
              <a href="">
<?php echo get_theme_mod('address'); ?>
</a>
            </li>-->
            <li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/envelope.png">
              <a href="mailto:<?php echo get_theme_mod('email'); ?>">
Email: <?php echo get_theme_mod('email'); ?>
</a>
            </li>
            <li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/whatsapp.png">
              <a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo get_theme_mod('phone'); ?>">
Phone: <?php echo get_theme_mod('phone'); ?>
</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
  <div class="main-powered">
    <div class="container">
      <div class="d-flex justify-content-center main-powered__flex">
        <p>Copyright 2020</p>
        <a href="">Branch</a>
        <p>- Sitios Web</p>
      </div>
    </div>
  </div>
  <script src="<?php echo get_template_directory_uri();?>/assets/js/setting-slick.js"></script>
</body>
<?php wp_footer(); ?>
</html>