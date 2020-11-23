<?php get_header(); ?>
  <section class="main-banner">
    <div class="main-banner__content">
      <div class="main-banner__item">
        <div class="main-banner__text wow animated fadeIn" style="visibility: visible; animation-delay: .3s  ;">
          <div class="main-banner__title">
            <h2>
              LA ESENCIA DEL AMOR
            </h2>
            <p>
              COLECCIÓN INSPIRADA
            </p>
            <h3>
              en cristales y piedras
            </h3>
          </div>
        </div>
        <div class="main-banner__img">
          <img alt="Imagen Banner" src="<?php echo get_template_directory_uri();?>/assets/img/banner-1.png">
        </div>
      </div>
      <div class="main-banner__item">
        <div class="main-banner__text wow animated fadeIn" style="visibility: visible; animation-delay: .3s  ;">
          <div class="main-banner__title">
            <h2>
              LA ESENCIA DEL AMOR
            </h2>
            <p>
              COLECCIÓN INSPIRADA
            </p>
            <h3>
              en cristales y piedras
            </h3>
          </div>
        </div>
        <div class="main-banner__img">
          <img alt="Imagen Banner" src="<?php echo get_template_directory_uri();?>/assets/img/banner-1.png">
        </div>
      </div>
      <div class="main-banner__item">
        <div class="main-banner__text wow animated fadeIn" style="visibility: visible; animation-delay: .3s  ;">
          <div class="main-banner__title">
            <h2>
              LA ESENCIA DEL AMOR
            </h2>
            <p>
              COLECCIÓN INSPIRADA
            </p>
            <h3>
              en cristales y piedras
            </h3>
          </div>
        </div>
        <div class="main-banner__img">
          <img alt="Imagen Banner" src="<?php echo get_template_directory_uri();?>/assets/img/banner-1.png">
        </div>
      </div>
    </div>
  </section>
  <section class="main-featured">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        LO MÁS POPULAR
      </h2>
      <p class="main-general__subtitle">
        Best sellers
      </p>
      <div class="main-featured__carousel">
      <?php          
      $args = array (
             'post_type' => 'product',
             'posts_per_page' => 10,
      );?>
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>      
        <div class="main-featured__product">
          <div class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
          </div>
          <div class="main-featured__text">
            <a class="main-featured__title" href="<?php the_permalink(); ?>">
               <?php the_title();?>
            </a>
            <p class="main-featured__price">
              <?php echo $product->get_price_html(); ?>
            </p>
            <a class="general-btn__simple" href="<?php the_permalink(); ?>">
               Comprar
            </a>
          </div>
        </div>
      <?php endwhile; ?>    
        
      </div>
    </div>
  </section>
  <section class="main-about">
    <div class="padding-top-bottom padding-right-left">
      <h2 class="main-general__title">
        NUESTRA FILOSOFÍA
      </h2>
      <p class="main-general__subtitle">
        Acerca de Rosary
      </p>
      <div class="container-grid">
        <div class="main-about__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_16.png">
        </div>
        <div class="main-about__text">
          <p class="main-general__description">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          </p>
          <p class="main-general__description">
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
            publishing software like Aldus PageMaker including versions of Lorem Ipsum.
          </p>
          <p class="main-general__description">
            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
            publishing software like Aldus PageMaker including versions of Lorem Ipsum.
          </p>
          <a class="main-about__btn" href="">
Leer más
<i class="fa fa-angle-right"></i>
</a>
        </div>
      </div>
    </div>
  </section>
  <section class="main-blog">
    <div class="main-blog__item">
      <div class="container-grid">
        <div class="main-blog__text">
          <div class="main-blog__counter">
            01
          </div>
          <a class="main-blog__title" href="single-blog.html">
METALES PRECIOSOS
</a>
          <p class="main-general__description">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
          </p>
        </div>
        <div class="main-blog__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_13.png">
        </div>
      </div>
    </div>
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
  <section class="main-text">
    <ul>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
    </ul>
    <ul>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
    </ul>
    <ul>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
      <li>simplicity</li>
      <li>elegance</li>
      <li>natural</li>
    </ul>
  </section>
  <section class="main-categories">
    <div class="main-categories__item">
      <div class="container-grid">
        <div class="main-categories__details">
          <img class="main-categories__icon" src="<?php echo get_template_directory_uri();?>/assets/img/logo_2.png">
          <p class="main-categories__text">
            Encuentra tu estilo
          </p>
          <img class="main-categories__poster" src="<?php echo get_template_directory_uri();?>/assets/img/image_10.png">
          <a class="general-btn__simple" href="">
Comprar
</a>
        </div>
        <div class="main-categories__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_11.png">
          <div class="main-categories__mask">
            <h2 class="main-categories__title">
              Aretes
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="main-categories__item">
      <div class="container-grid">
        <div class="main-categories__details">
          <img class="main-categories__icon" src="<?php echo get_template_directory_uri();?>/assets/img/logo_2.png">
          <p class="main-categories__text">
            Encuentra tu estilo
          </p>
          <img class="main-categories__poster" src="<?php echo get_template_directory_uri();?>/assets/img/image_15.png">
          <a class="general-btn__simple" href="">
Comprar
</a>
        </div>
        <div class="main-categories__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_3.png">
          <div class="main-categories__mask">
            <h2 class="main-categories__title">
              Anillos
            </h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="main-break">
    <div class="main-break__img">
      <img src="<?php echo get_template_directory_uri();?>/assets/img/image_7.png">
      <div class="main-break__mask">
        <img src="<?php echo get_template_directory_uri();?>/assets/img/logo-w.png">
      </div>
    </div>
  </section>
  <section class="main-categories">
    <div class="main-categories__item">
      <div class="container-grid">
        <div class="main-categories__details">
          <img class="main-categories__icon" src="<?php echo get_template_directory_uri();?>/assets/img/logo_2.png">
          <p class="main-categories__text">
            Encuentra tu estilo
          </p>
          <img class="main-categories__poster" src="<?php echo get_template_directory_uri();?>/assets/img/image_4.png">
          <a class="general-btn__simple" href="">
Comprar
</a>
        </div>
        <div class="main-categories__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_5.png">
          <div class="main-categories__mask">
            <h2 class="main-categories__title">
              Collares
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="main-categories__item">
      <div class="container-grid">
        <div class="main-categories__details">
          <img class="main-categories__icon" src="<?php echo get_template_directory_uri();?>/assets/img/logo_2.png">
          <p class="main-categories__text">
            Encuentra tu estilo
          </p>
          <img class="main-categories__poster" src="<?php echo get_template_directory_uri();?>/assets/img/image_8.png">
          <a class="general-btn__simple" href="">
Comprar
</a>
        </div>
        <div class="main-categories__img">
          <img src="<?php echo get_template_directory_uri();?>/assets/img/image_9.png">
          <div class="main-categories__mask">
            <h2 class="main-categories__title">
              Pulseras
            </h2>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="main-sale">
    <div class="container-grid">
      <div class="main-sale__text">
        <p class="main-sale__description">
          Lorem Ipsum is simply dummy text of the printing.
        </p>
        <h2 class="main-sale__title">
          Descuentos 50% OFF
        </h2>
        <a class="general-btn__simple" href="">
Comprar
</a>
      </div>
      <div class="main-sale__img">
        <img src="<?php echo get_template_directory_uri();?>/assets/img/image.png">
      </div>
    </div>
  </div>
<?php get_footer(); ?>