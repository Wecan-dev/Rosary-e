  <section class="main-featured">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        <?php echo get_theme_mod('best_seller_title');?>
      </h2>
      <p class="main-general__subtitle">
        <?php echo get_theme_mod('best_seller_subtitle');?>
      </p>
      <div class="main-featured__carousel">
      <?php for ($i=1; $i <= 12; $i++) { ?>
         <?php if(get_theme_mod('productos_best'.$i.'')!=NULL) { ?>        
      <?php          
      $args = array (
             'post_type' => 'product',
             'post__in'  =>  array(get_theme_mod('productos_best'.$i.'')),
                     
      );?>
      <?php $loop = new WP_Query( $args ); ?>
      <?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;?>      
        <div class="main-featured__product">
          <div href="<?php the_permalink(); ?>" class="main-featured__img">
            <img src="<?php the_post_thumbnail_url('full');?>">
			<div class="main-featured__mask" style="background-image: url('<?php the_field('imagen_hover_del_producto'); ?>')" >
				<a class="link-product" href="<?php the_permalink(); ?>"></a>
				<div class="main-featured__icon" >
					   <a class="" data-toggle="tooltip" data-placement="top" title="Producto bajo pre order">
                      <img src="<?php echo get_template_directory_uri();?>/assets/img/star.png">
                    </a>  
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
            <a class="general-btn__simple" href="<?php the_permalink(); ?>">
               Comprar
            </a>
          </div>
        </div>
      <?php endwhile; ?>    
      <?php } ?> 
      <?php } ?>   
      </div>
    </div>
  </section>
<style>
.main-featured .padding-top-bottom {
    padding-bottom: 0;
}
	.main-featured .main-featured__carousel{
		margin-bottom: 0;
	}
</style>