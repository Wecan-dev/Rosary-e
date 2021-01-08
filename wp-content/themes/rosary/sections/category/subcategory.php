  <section class="general-banner general-banner__subcategorie">
    <div class="banner1">  
      <?php if (termmeta_value('option1_categories', get_queried_object()->term_id) == 'Imagen'){ ?> 
        <img src="<?php echo termmeta_value_img( 'banner_categories', get_queried_object()->term_id ); ?>">
      <?php } ?>  
     <?php if (termmeta_value('option1_categories', get_queried_object()->term_id) == 'Iframe'){ ?>   
         <?php echo termmeta_value('iframe_banner_categories', get_queried_object()->term_id ); ?>
      <?php } ?> 
     <?php if (termmeta_value('option1_categories', get_queried_object()->term_id) == 'Vídeo'){ ?>   
         <video muted loop autoplay id="myVideo" src="<?php echo termmeta_value_img('video_banner_categories', get_queried_object()->term_id );  ?>"> </video>
      <?php } ?>      
    </div> 
    <div class="banner2">  
      <?php if (termmeta_value('option2_categories', get_queried_object()->term_id) == 'Imagen'){ ?> 
        <img src="<?php echo termmeta_value_img( 'banner2_categories', get_queried_object()->term_id ); ?>">
      <?php } ?>  
     <?php if (termmeta_value('option2_categories', get_queried_object()->term_id) == 'Iframe'){ ?>   
         <?php echo termmeta_value('iframe_banner2_categories', get_queried_object()->term_id ); ?>
      <?php } ?> 
     <?php if (termmeta_value('option2_categories', get_queried_object()->term_id) == 'Vídeo'){ ?>   
         <video muted loop autoplay id="myVideo" src="<?php echo termmeta_value_img('video_banner2_categories', get_queried_object()->term_id );  ?>"> </video>
      <?php } ?> 
    </div>                
    <div class="general-banner__text">
      <h2 class="main-general__title">
        <?php echo get_queried_object()->name; ?>
      </h2>
    </div>
  </section>
  <section class="custom-description custom-description--rosa">
    <div class="padding-right-left">
      <h2 class="main-general__title">
         <?php echo str_replace("\n", "<br>", termmeta_value( 'titulo_interna', get_queried_object()->term_id )); ?>
      </h2>
      <p class="main-general__subtitle">
            <?php echo str_replace("\n", "<br>", termmeta_value( 'subtitulo_interna', get_queried_object()->term_id )); ?>
      </p>
      <p class="custom-description__text">
         <?php echo str_replace("\n", "<br>", termmeta_value( 'descripcion_completa', get_queried_object()->term_id )); ?>
      </p>

    </div>
  </section>
  <section class="main-featured main-featured--white product categories-single">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        <?php echo str_replace("\n", "<br>", termmeta_value( 'title_otros_interna', get_queried_object()->term_id )); ?>
      </h2>
      <p class="main-general__subtitle">
        <?php echo str_replace("\n", "<br>", termmeta_value( 'subtitle_otros_interna', get_queried_object()->term_id )); ?>
      </p>
      <div class="container-grid">
     <?php foreach((get_the_terms(get_the_ID(), 'product_cat' )) as $category) { $cate =$category->slug;}
          $loop   = new WP_QUERY(array(
              'post_type'         => 'product',
              'posts_per_page'    => 100,
              'orderby'           =>'rand',
              'tax_query' => array(
                 array(
                     'taxonomy'  => 'product_cat',
                     'field'     => 'slug',
                     'terms'     => get_queried_object()->slug,
                 )),              

          ));
          if ( $loop->have_posts() ){ while ( $loop->have_posts() ){ $loop->the_post(); global $product;


       ?>             
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
        
        <?php   }}  wp_reset_query();?>  
      </div>
    </div>
  </section>
