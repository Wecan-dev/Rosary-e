<?php get_header(); ?>
   <section class="blog-general">
    <div class="container-grid">
      <div class="blog-general__all">
        <div class="blog-general__post blog-genera__post--single">
          <img class="blog-general__poster" src="<?php the_post_thumbnail_url('full'); ?>">
          <ul class="blog-general__meta">
            <li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/blog/calendar.png">
              <a><?php the_time(get_option('date_format')); ?></a>
            </li>
            <li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/blog/tag.png">
              <?php if ( verify_tags(get_the_ID()) > 0 ){ foreach((get_the_terms(get_the_ID(), 'post_tag' )) as $tag) {$category_id = $tag->term_id; $tag_link = get_category_link( $category_id ); echo '<a href="'.$tag_link.'">'.$tag->name.'</a>'; }} ?>
              
            </li>
          </ul>
          <div class="blog-general__title" href="">
            <?php the_title(); ?>
          </div>
						  <?php the_field('texto_inicio_blog'); ?>
<br><br>
          <?php the_content(); ?>
          <div class="blog-post__metas">
            <div class="blog-general__tag">
              <?php if ( verify_tags(get_the_ID()) > 0 ){ foreach((get_the_terms(get_the_ID(), 'post_tag' )) as $tag) {$category_id = $tag->term_id; $tag_link = get_category_link( $category_id ); echo '<a href="'.$tag_link.'">'.$tag->name.'</a>'; }} ?>
            </div>
            <div class="blog-general__categories">
              <p>categorías:</p>
              <?php if ( verify_tags(get_the_ID()) > 0 ){ foreach((get_the_terms(get_the_ID(), 'category' )) as $tag) {$category_id = $tag->term_id; $tag_link = get_category_link( $category_id ); echo '<a href="'.$tag_link.'">'.$tag->name.'</a>'; }} ?>
            </div>
          </div>
          <ul class="blog-sidebar__follow blog-sidebar__box">
                <?php if (get_theme_mod('pinterest')!=NULL) {?> 
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('pinterest'); ?>"><img src="<?php echo get_theme_mod('pinterest_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('vimeo')!=NULL) {?> 
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('vimeo'); ?>"><img src="<?php echo get_theme_mod('vimeo_image'); ?>"></a>
                </li>
                <?php } ?>                
                <?php if (get_theme_mod('youtube')!=NULL) {?>
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('youtube'); ?>"><img src="<?php echo get_theme_mod('youtube_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('facebook')!=NULL) {?>
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('facebook'); ?>"><img src="<?php echo get_theme_mod('facebook_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('instagram')!=NULL) {?>
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('instagram'); ?>"><img src="<?php echo get_theme_mod('instagram_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('twitter')!=NULL) {?>
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('twitter'); ?>"><img src="<?php echo get_theme_mod('twitter_image'); ?>"></a>
                </li>
                <?php } ?>   
                <?php if (get_theme_mod('linkedin')!=NULL) {?>
                <li>
                  <a target="_blank" href="<?php echo get_theme_mod('linkedin'); ?>"><img src="<?php echo get_theme_mod('linkedin_image'); ?>"></a>
                </li>
			    <?php } ?>  
			          <li>
                  <a target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo get_theme_mod('phone'); ?>&text=%C2%A1Hola!%20%C2%BFC%C3%B3mo%20est%C3%A1s?%20%E2%9C%A8%20Vi%20la%20p%C3%A1gina%20web%20y%20tengo%20algunas%20preguntas%20%C2%BFpodr%C3%ADas%20asesorarme%20por%20favor?%20%E2%98%BA%EF%B8%8F"><img src="<?php echo get_template_directory_uri();?>/assets/img/whatsapp-2.png"></a>
                </li>
                      	
 
          </ul>

            <div class="blog-comment">
              <h2>Comentarios (<?php echo get_comments_number() ?>)</h2>              
                <?php if ( comments_open() || get_comments_number() ) :
                         comments_template();
                      endif;  
                 ?>                        
            </div>
         
          
        </div>
      </div>
      <div class="blog-sidebar">
          <?php if (get_theme_mod('blog_sidebar_categorie') != NULL) {?>
             <?php  get_template_part('sections/blog/blog-sidebar-categorie'); ?>
          <?php } ?>
          <?php if (get_theme_mod('blog_sidebar_follow') != NULL) {?>
             <?php  get_template_part('sections/blog/blog-sidebar-follow'); ?>
          <?php } ?> 
          <?php if (get_theme_mod('blog_sidebar_posts_recent') != NULL) {?>
             <?php  get_template_part('sections/blog/blog-sidebar-recent'); ?>
          <?php } ?>  
          <?php if (get_theme_mod('blog_sidebar_poster') != NULL) {?>
             <?php  get_template_part('sections/blog/blog-sidebar-poster'); ?>
          <?php } ?>     
      </div>
    </div>
  </section>

<?php  get_footer(); ?>