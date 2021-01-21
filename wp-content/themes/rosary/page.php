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
  <section class="general-banner general-banner__newin">
  <?php if (get_field('option-banner-new-in') == 'Imagen'){ ?>  
          <img src="<?php the_field('image-banner-new-in') ?>">
  <?php }else{ ?>  
        <video  muted loop autoplay="true" id="myVideo" src="<?php the_field('video-banner-new-in') ?>"> </video>
  <?php } ?>    
    <div class="general-banner__text">
      <h2 class="main-general__title">
         <?php the_field('title-banner-new-in'); ?>
      </h2>
      <p class="general-banner__subtitle">
        <?php the_field('subtitle-banner-new-in'); ?>
      </p>
    </div>
  </section>
  <section class="custom-description custom-description--rosa">
    <div class="padding-right-left">
      <h2 class="main-general__title">
        Golden Hour Treasures
      </h2>
      <p class="main-general__subtitle">
        Natural shine to illuminate space
      </p>
      <p class="custom-description__text">
       Una colección para espíritus con resplandor propio que como un cálido rayo de sol que atardece, llegan para pintar de oro, con su halo de luz dorada, los espacios; y nos cobija con ese poderoso brillo de naturaleza celestial que efímeramente recibimos y agradecemos antes de que el día pase y otra vez amanezca de nuevo.
<br>
Esencias que hemos mirado hacia atrás en el tiempo para encontrarnos con una iridiscencia natural que no se agota. 
      </p>
    </div>
  </section>




  <section class="general-product">
    <div class="padding-right-left padding-top-bottom">
      <div class="container-grid">
      <?php          
      $args = array (
             'post_type' => 'product',
             //'posts_per_page' => get_theme_mod('best_seller_num_post'),
      );?>
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>         
        <div class="main-featured__product">
                  <div href="<?php the_permalink(); ?>" class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
  	<div class="main-featured__mask" style="background-image: url('<?php the_field('imagen_hover_del_producto'); ?>')" >
				<a class="link-product" href="<?php the_permalink(); ?>"></a>
				<div class="main-featured__icon" >
					 <?php// if (is_user_logged_in()){ ?>    
                      <a href="?add_to_wishlist=<?php echo get_the_ID(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                      </a>
                    <?php// }else { ?>  
                    <!--<div data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(lang() == 'es'){echo "Debes estar iniciar sesión";}else{echo "You must be logged";} ?>" class="collection-item__icon" >
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/heart.png">
                    </div> -->             
                    <?php// } ?>
					 <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/search.png">
                      </a>
				</div>
			  </div>
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
                    <div href="<?php the_permalink(); ?>" class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
 	<div class="main-featured__mask" style="background-image: url('<?php the_field('imagen_hover_del_producto'); ?>')" >
				<a class="link-product" href="<?php the_permalink(); ?>"></a>
				<div class="main-featured__icon" >
					 <?php// if (is_user_logged_in()){ ?>    
                      <a href="?add_to_wishlist=<?php echo get_the_ID(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                      </a>
                    <?php// }else { ?>  
                    <!--<div data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(lang() == 'es'){echo "Debes estar iniciar sesión";}else{echo "You must be logged";} ?>" class="collection-item__icon" >
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/heart.png">
                    </div> -->             
                    <?php// } ?>
					 <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/search.png">
                      </a>
				</div>
			  </div>
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
          <?php echo meta_value('title-promo-new-in', $id_page); ?>
        </h2>
        <p class="general-promo__subtitle">
          <?php echo meta_value('subtitle-promo-new-in', $id_page); ?>
        </p>
		  <?php echo FrmFormsController::get_form_shortcode( array( 'id' => 2, 'title' => false, 'description' => false ) ); ?>

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
                  <div href="<?php the_permalink(); ?>" class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
	<div class="main-featured__mask" style="background-image: url('<?php the_field('imagen_hover_del_producto'); ?>')" >
				<a class="link-product" href="<?php the_permalink(); ?>"></a>
				<div class="main-featured__icon" >
					 <?php// if (is_user_logged_in()){ ?>    
                      <a href="?add_to_wishlist=<?php echo get_the_ID(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                      </a>
                    <?php// }else { ?>  
                    <!--<div data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(lang() == 'es'){echo "Debes estar iniciar sesión";}else{echo "You must be logged";} ?>" class="collection-item__icon" >
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/heart.png">
                    </div> -->             
                    <?php// } ?>
					 <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/search.png">
                      </a>
				</div>
			  </div>
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
                  <div href="<?php the_permalink(); ?>" class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
	<div class="main-featured__mask" style="background-image: url('<?php the_field('imagen_hover_del_producto'); ?>')" >
				<a class="link-product" href="<?php the_permalink(); ?>"></a>
				<div class="main-featured__icon" >
					 <?php// if (is_user_logged_in()){ ?>    
                      <a href="?add_to_wishlist=<?php echo get_the_ID(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/heart@2x.png">
                      </a>
                    <?php// }else { ?>  
                    <!--<div data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php if(lang() == 'es'){echo "Debes estar iniciar sesión";}else{echo "You must be logged";} ?>" class="collection-item__icon" >
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/heart.png">
                    </div> -->             
                    <?php// } ?>
					 <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_template_directory_uri();?>/assets/img/search.png">
                      </a>
				</div>
			  </div>
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
    
    <div class="custom-piece__carousel" >
      
      <?php          
      $args = array (
             'post_type' => 'personalizado',
             'posts_status' => 'publish',
      'order' => 'ASC',
      );?>
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>   
      <div class="custom-piece__item" >
        
      
      <div class="container-grid">
        <div class="custom-piece__img">
          <img src="<?php echo meta_value_img('image1-item-personalizados', get_the_ID()); ?>">
       <img class="custom-piece__text--img" src="<?php echo meta_value_img('image2-item-personalizados', get_the_ID()); ?>">
        </div>
        <div class="custom-piece__text">
          <img src="<?php echo meta_value_img('image2-item-personalizados', get_the_ID()); ?>">
          <div>
            <h2 class="custom-piece__title">
              <?php echo meta_value('title-item-personalizados', get_the_ID()); ?>
            </h2>
            <p class="custom-piece__description">
              <?php echo meta_value('description-item-personalizados',get_the_ID()); ?>
            </p>
          </div>
          <a class="custom-piece__btn" href="<?php echo meta_value('urlbuttom-item-personalizados', get_the_ID()); ?>">
              <?php echo meta_value('buttom-item-personalizados', get_the_ID()); ?>
              <i class="fa fa-angle-right"></i>
          </a>
        </div>
      </div>
        </div>
      <?php endwhile; ?> 
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
				<a href="https://api.whatsapp.com/send?phone=<?php echo get_theme_mod('phone'); ?>&text=%C2%A1Hola!%20%C2%BFC%C3%B3mo%20est%C3%A1s?%20%E2%9C%A8%20Vi%20la%20p%C3%A1gina%20web%20y%20tengo%20algunas%20preguntas%20%C2%BFpodr%C3%ADas%20asesorarme%20por%20favor?%20%E2%98%BA%EF%B8%8F" >
          <img src="<?php echo meta_value_img('icon-reason3-nosotros', $id_page); ?>">
			</a>
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
      <div class="about-card__carousel">
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
    <!--<img src=" <?php // echo meta_value_img('image-banner-categorias', $id_page); ?>"> -->
	  <img src="<?php echo get_template_directory_uri();?>/assets/img/productos/image_1.jpg ">
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
      <a>
           <?php echo meta_value('title-general-categorias', $id_page); ?>
          </a>
        </li>
      </ul>
      <div class="container-grid">
      <?php $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'posts_per_page' => 2, 'orderby' => 'menu_order', 'order' => 'asc', 'parent' =>0 )); $i = 0; ?>
      <?php foreach($product_categories as $category):  global $wpdb;?>
      <?php $result = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."term_taxonomy where taxonomy = 'product_cat'");?>    
             
        <div class="categories-all__card">
      <span class="categories-all__border" ></span>
          <img src="<?php echo wp_get_attachment_url( get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ) );?>">
          <div class="categories-all__text" href="">
            <h2 class="categories-all__title">
             <?=$category->name ?>
            </h2>
            <p class="categories-all__subtitle">
              <?php echo termmeta_value('title_entrada_categories', $category->term_id);?>
            </p>
            <a class="general-btn__light" href="<?php echo get_category_link( $category->term_id ); ?>?cat=yes">Comprar</a>
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
            <img src="<?php echo get_template_directory_uri();?>/assets/img/envelope.png">
            <a href="mailto:<?php echo meta_value('email-sidebar-contacto', $id_page); ?>">
              <p>Correo Electrónico</p>
              <?php echo get_theme_mod('email'); ?>
            </a>
          </li>
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/whatsapp.png">
            <a href="https://api.whatsapp.com/send?phone=<?php echo get_theme_mod('phone'); ?>&text=%C2%A1Hola!%20%C2%BFC%C3%B3mo%20est%C3%A1s?%20%E2%9C%A8%20Vi%20la%20p%C3%A1gina%20web%20y%20tengo%20algunas%20preguntas%20%C2%BFpodr%C3%ADas%20asesorarme%20por%20favor?%20%E2%98%BA%EF%B8%8F">
              <p>WhatsApp</p>
              <?php echo get_theme_mod('phone'); ?>
            </a>
          </li>
       
         <!-- <li>
            <img src="<?php //echo get_template_directory_uri();?>/assets/img/place.png">
            <a href="<?php //echo get_theme_mod('address_map'); ?>">
              <p>Ubicación</p>
              <?php// echo get_theme_mod('address'); ?>
            </a>
          </li>-->
        </ul>
      </div>
    </div>
  </section>
<?php } ?>  

<?php  endwhile; ?> 
<?php get_footer(); ?>