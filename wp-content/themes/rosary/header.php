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
    <p>AHORA | ENVÍO GRATIS - CUPÓN: GRATIS</p>
  </section>
  <?php $urlsinparametros= explode('/', $_SERVER['REQUEST_URI'], 3); $home = get_post()->post_name.'/';?>
  <header class="header"  <?php if ($urlsinparametros[2] == $home OR $urlsinparametros[2] == 'tienda/') { echo 'class="header-solid"'; }  ?> >
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
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="">Recomendados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/tienda">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="">
Cats & Dogs
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="complementos-accesorios.html">
Accesorios
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="personalizados.html">
Personalizados
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="nosotros.html">
Nosotros
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="blog.html">
Blog
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="">
Diseñalo tú mismo
</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="">
outlet
</a>
            </li>
            <ul class="nav-icon">
              <li>
                <a class="nav-link" data="offcanvas" href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/profile@2x.png">
</a>
              </li>
              <li>
                <a class="nav-link" data="offcanvas" href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
</a>
              </li>
              <li>
                <a class="nav-link" data="offcanvas" href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/bag@2x.png">
</a>
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </nav>
  </header>