<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name="description" content="Creamos joyería para realzar tu brillo natural. Joyas en Oro Amarillo, Blanco y Rosa de 18k. Envíos a Bogotá, Medellín, Cali, Barranquilla y toda Colombia."/>
  <title><?php wp_title('|', true, 'right'); ?></title>
  <?php wp_head(); ?>  
	  <meta name="keywords" content="joyería, joyerías Bogotá, joyerías Medellín, joyería Barranquilla, joyerías en Cali, joyerías Bucaramanga, joyería Colombia, Anillos compromiso">
  <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />
</head>
<script src="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.js" data-cfasync="false"></script>

<body>



  <?php if ( is_home() ) : ?>
  <header class="header fixed-top navbar-fixed-js">
	    <section class="pre-navbar">
			  <p><?php echo get_theme_mod('pre-navbar_title');?></p>	
			<p  id="countdown"></p>

  
  </section>
    <nav class="navbar navbar-expand-lg">
      <div class="container-nav">
        <div class="main-brand__top">
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
			<div class="icon-mobile" >
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
				 <button class="navbar-toggler p-2 border-0 hamburger hamburger--elastic ml-autos" data-toggle="offcanvas" type="button">
<span class="hamburger-box"></span>
<span class="hamburger-inner"></span>
</button>
			</div>
         
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
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/categorias">
            Categorías
            </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/contacto">
Contacto
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
    <header class="header header-solid fixed-top navbar-fixed-js">
			    <section class="pre-navbar">
    <p id="countdown"></p>
					<p><?php echo get_theme_mod('pre-navbar_title');?></p>
						

  </section>
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
<li class="nav-item">
  <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/categorias">
    Categorías
  </a>
</li>
<li class="nav-item">
  <a class="nav-link" data="offcanvas" href="<?php echo get_home_url() ?>/contacto">
    Contacto
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
	<script>
var end = new Date('12/17/2100 9:30 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = days + ' dias, ';
        document.getElementById('countdown').innerHTML += hours + ' horas, ';
        document.getElementById('countdown').innerHTML += minutes + ' min y ';
        document.getElementById('countdown').innerHTML += seconds + ' seg';
    }

    timer = setInterval(showRemaining, 1000);
</script>