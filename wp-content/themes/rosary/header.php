<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>  
  <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
</head>
<body>
  <section class="pre-navbar">
    <p><?php echo get_theme_mod('pre-navbar_title');?></p>
  </section>
  <?php if ( is_home() ) : ?>
  <header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="container-nav">
        <div class="main-brand__top">
          <div class="main-brand">
            <a class="navbar-brand" href="<?php echo get_home_url() ?>">
<img id="iso" src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
</a>
          </div>
        </div>
        <div class="main-brand__fixed">
          <div class="main-brand">
            <a class="navbar-brand" href="<?php echo get_home_url() ?>">
<img id="iso" src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
</a>
          </div>
        </div>
        <div class="main-brand brand-responsive">
          <a class="navbar-brand" href="<?php echo get_home_url() ?>">
<img id="iso" src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
</a>
          <button class="navbar-toggler p-2 border-0 hamburger hamburger--elastic ml-autos" data-toggle="offcanvas" type="button">
<span class="hamburger-box"></span>
<span class="hamburger-inner"></span>
</button>
        </div>
        <div class="navbar-collapse offcanvas-collapse">
          <ul class="navbar-nav mr-autos">
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/new-in">New in</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/recomendados">Recomendados</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/tienda">Productos</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/Cats&Dogs">
Cats & Dogs
</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/complementos-accesorios">
Accesorios
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/personalizados">
Personalizados
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/nosotros">
Nosotros
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/blog">
Blog
</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/disenalo-tu-mismo">
Diseñalo tú mismo
</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/outlet">
outlet
</a>
            </li> -->
            <ul class="nav-icon">
              <li>
                 
                <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/mi-cuenta">
                  <img src="<?php echo get_template_directory_uri();?>/assets/img/profile@2x.png">
                </a>

              </li>
              <li>
                <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/wishlist">
                 <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                 <?php $wishlist_count = YITH_WCWL()->count_products(); echo esc_html( $wishlist_count ); ?>
                </a>
              </li>
              <li>
                <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/carrito">
                  <img src="<?php echo get_template_directory_uri();?>/assets/img/bag@2x.png"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?>
                </a>
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </nav>
  </header>  
  <?php else: ?> 
    <header class="header header-solid">
    <nav class="navbar navbar-expand-lg">
      <div class="container-nav">
        <div class="main-brand__top">
          <div class="main-brand">
            <a class="navbar-brand" href="<?php echo get_home_url() ?>">
<img id="iso" src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
</a>
          </div>
        </div>
        <div class="main-brand__fixed">
          <div class="main-brand">
            <a class="navbar-brand" href="<?php echo get_home_url() ?>">
<img id="iso" src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
</a>
          </div>
        </div>
        <div class="main-brand brand-responsive">
          <a class="navbar-brand" href="<?php echo get_home_url() ?>">
<img id="iso" src="<?php echo get_template_directory_uri();?>/assets/img/logo.png">
</a>
          <button class="navbar-toggler p-2 border-0 hamburger hamburger--elastic ml-autos" data-toggle="offcanvas" type="button">
<span class="hamburger-box"></span>
<span class="hamburger-inner"></span>
</button>
        </div>
        <div class="navbar-collapse offcanvas-collapse">
          <ul class="navbar-nav mr-autos">
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/new-in">New in</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/recomendados">Recomendados</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/tienda">Productos</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/cats&dogs">
Cats & Dogs
</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/complementos-accesorios">
Accesorios
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/personalizados">
Personalizados
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/nosotros">
Nosotros
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/blog">
Blog
</a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/disenalo-tu-mismo">
Diseñalo tú mismo
</a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/outlet">
outlet
</a>
            </li> -->
            <ul class="nav-icon">
              <li>
                 
                <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/mi-cuenta">
                  <img src="<?php echo get_template_directory_uri();?>/assets/img/profile@2x.png">
                </a>

              </li>
              <li>
                <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/wishlist">
                 <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                 <?php $wishlist_count = YITH_WCWL()->count_products(); echo esc_html( $wishlist_count ); ?>
                </a>
              </li>
              <li>
                <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/carrito">
                  <img src="<?php echo get_template_directory_uri();?>/assets/img/bag@2x.png"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?>
                </a>
              </li>


            </ul>
          </ul>
        </div>
      </div>
    </nav>
  </header>  
    <?php endif; ?>