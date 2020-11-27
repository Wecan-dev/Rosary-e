<?php get_header(); 
 while ( have_posts() ) : the_post(); $id_page = get_the_ID();
 ?>

<?php if(get_field('template_rosary') == 'General Page'){ ?>  
  <section class="general-banner">
    <img src="<?php the_field('image_banner_page'); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php the_field('title_banner_page'); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php the_field('subtitle_banner_page'); ?>
      </p>
    </div>
  </section>
  <section class="general-legal">
    <div class="padding-top-bottom padding-right-left">
      <?php the_content(); ?>
    </div>
  </section>    
<?php } ?> 

<!-- ****************** NEW IN *********************-->
<?php if(get_field('template_rosary') == 'New In'){ ?>  
  <section class="general-banner">
    <img src="<?php the_field('image-banner-new-in'); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
         <?php the_field('title-banner-new-in'); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php the_field('subtitle-banner-new-in'); ?>
      </p>
    </div>
  </section>
  <section class="general-product">
    <div class="padding-right-left padding-top-bottom">
      <ul class="general-breadcrumbs">
        <li>
          <?php the_field('title-new-in'); ?>
        </li>
      </ul>
      <div class="container-grid">
      <?php          
      $args = array (
             'post_type' => 'product',
             //'posts_per_page' => get_theme_mod('best_seller_num_post'),
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
          </div>
        </div>
      <?php endwhile; ?> 
      </div>
    </div>
  </section>
  <section class="main-featured main-featured__other">
    <div class="padding-top-bottom">
      <h2 class="main-general__title main-general__title--other">
       <?php echo meta_value('title-others-new-in', $id_page); ?>
      </h2>
      <div class="main-featured__carousel">
      <?php          
      $args = array (
             'post_type' => 'product',
            // 'posts_per_page' => get_theme_mod('best_seller_num_post'),
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
          </div>
        </div>
      <?php endwhile; ?> 
      </div>
      </div>
    </div>
  </section>
  <section class="general-promo">
    <div class="container-grid">
      <div class="general-promo__text">
        <h2 class="general-promo__title">
          <?php echo meta_value('title-promo-new-in', $id_page); ?>
        </h2>
        <p class="general-promo__subtitle">
          <?php echo meta_value('subtitle-promo-new-in', $id_page); ?>
        </p>
        <form>
          <input placeholder="Tu email" type="email">
          <a class="general-btn__rose" href="">
Enviar
</a>
        </form>
      </div>
      <div class="general-promo__img">
        <img src="<?php echo meta_value_img('image-promo-new-in', $id_page); ?>">
      </div>
    </div>
  </section>
<?php } ?> 

<!-- ****************** Complementos Accesorios *********************-->
<?php if(get_field('template_rosary') == 'Accesorios'){ ?>  
  <section class="general-banner">
    <img src="<?php the_field('image-banner-accesorios'); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
       <?php the_field('title-banner-accesorios'); ?>
      </h2>
    </div>
  </section>
  <section class="general-product">
    <div class="padding-right-left padding-top-bottom">
      <ul class="general-breadcrumbs">
        <?php the_field('title-accesorios'); ?>
      </ul>
      <div class="container-grid">
      <?php          
      $args = array (
             'post_type' => 'product',
             //'posts_per_page' => get_theme_mod('best_seller_num_post'),
      );?>
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>          
        <div class="main-featured__product">
          <div class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
          </div>
          <div class="main-featured__text">
            <a class="main-featured__title" href="">
              <?php the_title();?>
            </a>
            <p class="main-featured__price">
              <?php echo $product->get_price_html(); ?>
            </p>
          </div>
        </div>
      <?php endwhile; ?>  
        
      </div>
    </div>
  </section>
  <section class="main-featured main-featured__other">
    <div class="padding-top-bottom">
      <h2 class="main-general__title main-general__title--other">
        <?php echo meta_value('title-others-accesorios', $id_page); ?>
      </h2>
      <div class="main-featured__carousel">
      <?php          
      $args = array (
             'post_type' => 'product',
            // 'posts_per_page' => get_theme_mod('best_seller_num_post'),
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
          </div>
        </div>
      <?php endwhile; ?>  
        
      </div>
    </div>
  </section>
  <section class="general-promo">
    <div class="container-grid">
      <div class="general-promo__text">
        <h2 class="general-promo__title">
          <?php echo meta_value('title-promo-accesorios', $id_page); ?>
        </h2>
        <p class="general-promo__subtitle">
          <?php echo meta_value('subtitle-promo-accesorios', $id_page); ?>
        </p>
        <form>
          <input placeholder="Tu email" type="email">
          <a class="general-btn__rose" href="">
Enviar
</a>
        </form>
      </div>
      <div class="general-promo__img">
        <img src="<?php echo meta_value_img('image-promo-accesorios', $id_page); ?>">
      </div>
    </div>
  </section>
<?php } ?>

<!-- ****************** Personalizados *********************-->
<?php if(get_field('template_rosary') == 'Personalizados'){ ?>  
  <section class="general-banner">
    <img src="<?php echo meta_value_img('image-banner-personalizados', $id_page); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php echo meta_value('title-banner-personalizados', $id_page); ?>
      </h2>
    </div>
  </section>
  <section class="custom-piece">
    <div class="padding-top-bottom">
      <ul class="general-breadcrumbs">
        <?php echo meta_value('title-personalizados', $id_page); ?>
      </ul>
      <div class="container-grid">
        <div class="custom-piece__img">
          <img src="<?php echo meta_value_img('image1-section1-personalizados', $id_page); ?>">
        </div>
        <div class="custom-piece__text">
          <img src="<?php echo meta_value_img('image2-section1-personalizados', $id_page); ?>">
          <div>
            <h2 class="custom-piece__title">
              <?php echo meta_value('title-section1-personalizados', $id_page); ?>
            </h2>
            <p class="custom-piece__description">
              <?php echo meta_value('description-section1-personalizados', $id_page); ?>
            </p>
          </div>
          <a class="custom-piece__btn" href="<?php echo meta_value('urlbuttom-section1-personalizados', $id_page); ?>">
<?php echo meta_value('buttom-section1-personalizados', $id_page); ?>
<i class="fa fa-angle-right"></i>
</a>
        </div>
      </div>
    </div>
  </section>
  <section class="custom-description">
    <div class="padding-right-left">
      <h2 class="main-general__title">
        <?php echo meta_value('title-section2-personalizados', $id_page); ?>
      </h2>
      <p class="main-general__subtitle">
        <?php echo meta_value('subtitle-section2-personalizados', $id_page); ?>
      </p>
      <p class="custom-description__text">
        <?php echo meta_value('description-section2-personalizados', $id_page); ?>
      </p>
    </div>
  </section>
<?php } ?>

<!-- ****************** Nosotros *********************-->
<?php if(get_field('template_rosary') == 'Nosotros'){ ?>
  <section class="general-banner">
    <img src="<?php echo meta_value_img('image-banner-nosotros', $id_page); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php echo meta_value('title-banner-nosotros', $id_page); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php echo meta_value('subtitle-banner-nosotros', $id_page); ?>
      </p>
    </div>
  </section>
  <div class="about-grid">
    <div class="about-grid__item">
      <div class="container-grid">
        <div class="about-grid__img">
          <img src="<?php echo meta_value_img('image-item1-nosotros', $id_page); ?>">
        </div>
        <div class="about-grid__text">
          <p class="about-grid__titlexs">
            <?php echo meta_value('title-item1-nosotros', $id_page); ?>
          </p>
          <h2 class="about-grid__title">
            <?php echo meta_value('subtitle-item1-nosotros', $id_page); ?>
          </h2>
          <p class="about-grid__description">
            <?php echo meta_value('description-item1-nosotros', $id_page); ?>
          </p>

        </div>
      </div>
    </div>
    <div class="about-grid__item">
      <div class="container-grid">
        <div class="about-grid__img">
          <img src="<?php echo meta_value_img('image-item2-nosotros', $id_page); ?>">
        </div>
        <div class="about-grid__text">
          <p class="about-grid__titlexs">
            <?php echo meta_value('title-item2-nosotros', $id_page); ?>
          </p>
          <h2 class="about-grid__title">
             <?php echo meta_value('subtitle-item2-nosotros', $id_page); ?>
          </h2>
          <p class="about-grid__description">
            <?php echo meta_value('description-item2-nosotros', $id_page); ?>
          </p>

        </div>
      </div>
    </div>
  </div>
  <section class="about-reason">
    <h2 class="main-general__title">
      <?php echo meta_value('title-reason-nosotros', $id_page); ?>
    </h2>
    <div class="container-grid">
      <div class="about-reason__item">
        <div class="about-reason__icon">
          <img src=" <?php echo meta_value_img('icon-reason-nosotros', $id_page); ?>">
        </div>
        <p class="about-reason__text">
           <?php echo meta_value('texto-reason-nosotros', $id_page); ?>
        </p>
      </div>
      <div class="about-reason__item">
        <div class="about-reason__icon">
          <img src="<?php echo meta_value_img('icon-reason2-nosotros', $id_page); ?>">
        </div>
        <p class="about-reason__text">
          <?php echo meta_value('texto-reason2-nosotros', $id_page); ?>
        </p>
      </div>
      <div class="about-reason__item">
        <div class="about-reason__icon">
          <img src="<?php echo meta_value_img('icon-reason3-nosotros', $id_page); ?>">
        </div>
        <p class="about-reason__text">
          <?php echo meta_value('texto-reason3-nosotros', $id_page); ?>
        </p>
      </div>
    </div>
  </section>
  <section class="about-card">
    <div class="padding-top-bottom padding-right-left">
      <h2 class="main-general__title">
        <?php echo meta_value('title-card-nosotros', $id_page); ?>
      </h2>
      <div class="container-grid">
        <div class="about-card__item">
          <div class="about-card__img">
            <img src="<?php echo meta_value_img('image-card1-nosotros', $id_page); ?>">
          </div>
          <div class="about-card__text">
            <h2 class="about-card__title">
              <?php echo meta_value('title-card1-nosotros', $id_page); ?>
            </h2>
            <p class="about-card__description">
              <?php echo meta_value('description-card1-nosotros', $id_page); ?>
            </p>
          </div>
        </div>
        <div class="about-card__item">
          <div class="about-card__img">
            <img src="<?php echo meta_value_img('image-card2-nosotros', $id_page); ?>">
          </div>
          <div class="about-card__text">
            <h2 class="about-card__title">
              <?php echo meta_value('title-card2-nosotros', $id_page); ?>
            </h2>
            <p class="about-card__description">
              <?php echo meta_value('description-card2-nosotros', $id_page); ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>

<!-- ****************** Políticas *********************-->
<?php if(get_field('template_rosary') == 'Políticas'){ ?>
  <section class="general-banner">
    <img src="<?php echo meta_value_img('image-banner-politicas', $id_page); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php echo meta_value('title-banner-politicas', $id_page); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php echo meta_value('subtitle-banner-politicas', $id_page); ?>
      </p>
    </div>
  </section>
  <section class="general-legal">
    <div class="padding-top-bottom padding-right-left">
      <?php the_content(); ?>
    </div>
  </section>
<?php } ?>

<!-- ****************** Categorías *********************-->
<?php if(get_field('template_rosary') == 'Categorías'){ ?>
  <section class="general-banner">
    <img src=" <?php echo meta_value_img('image-banner-categorias', $id_page); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
         <?php echo meta_value('title-banner-categorias', $id_page); ?>
      </h2>
      <p class="general-banner__subtitle">
         <?php echo meta_value('subtitle-banner-categorias', $id_page); ?>
      </p>
    </div>
  </section>
  <section class="categories-all">
    <div class="padding-top-bottom padding-right-left">
      <ul class="general-breadcrumbs">
        <li>
           <?php echo meta_value('title-general-categorias', $id_page); ?>
          </a>
        </li>
      </ul>
      <div class="container-grid">
      <?php $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'posts_per_page' => 2, 'orderby' => 'menu_order', 'order' => 'asc' )); $i = 0; ?>
      <?php foreach($product_categories as $category):  global $wpdb;?>
      <?php $result = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."term_taxonomy where taxonomy = 'product_cat'");?>    
             
        <div class="categories-all__card">
          <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ) );?>">
          <div class="categories-all__text" href="">
            <h2 class="categories-all__title">
             <?=$category->name ?>
            </h2>
            <p class="categories-all__subtitle">
              accesorios
            </p>
            <a class="general-btn__light" href="<?php echo get_category_link( $category->term_id ); ?>">Comprar</a>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
    </div>
  </section>
<?php } ?>

<!-- ****************** Contacto *********************-->
<?php if(get_field('template_rosary') == 'Contacto'){ ?>
  <section class="general-banner">
    <img src="<?php echo meta_value_img('image-banner-contacto', $id_page); ?>">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php echo meta_value('title-banner-contacto', $id_page); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php echo meta_value('subtitle-banner-contacto', $id_page); ?>
      </p>
    </div>
  </section>
  <section class="contact">
    <div class="container-grid">
      <div class="contact-form">
        <h2 class="contact-form__title">
          <?php echo meta_value('title-form-contacto', $id_page); ?>
        </h2>
        <p class="contact-form__description">
          <?php echo meta_value('description-form-contacto', $id_page); ?>
        </p>
        <?php echo do_shortcode('[formidable id=1]'); ?>
      </div>
      <div class="contact-sidebar">
        <h2 class="contact-form__title">
          <?php echo meta_value('title-sidebar-contacto', $id_page); ?>
        </h2>
        <p class="contact-form__description">
         
        </p>
        <ul class="contact-list">
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/phone-call.png">
            <a href="tel:<?php echo meta_value('phone-sidebar-contacto', $id_page); ?>">
              <p>Teléfono</p>
              <?php echo get_theme_mod('phone'); ?>
            </a>
          </li>
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/envelope.png">
            <a href="mailto:<?php echo meta_value('email-sidebar-contacto', $id_page); ?>">
              <p>Correo Electrónico</p>
              <?php echo get_theme_mod('email'); ?>
            </a>
          </li>
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/place.png">
            <a href="">
              <p>Ubicación</p>
              <?php echo get_theme_mod('address'); ?>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
<?php } ?>  

<?php  endwhile; ?> 
<?php get_footer(); ?>