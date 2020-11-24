        <div class="blog-sidebar__content">
          <p class="blog-sidebar__title">
            Síguenos
          </p>
          <ul class="blog-sidebar__follow blog-sidebar__box">
                <?php if (get_theme_mod('pinterest')!=NULL) {?> 
                <li>
                  <a href="<?php echo get_theme_mod('pinterest'); ?>"><img src="<?php echo get_theme_mod('pinterest_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('vimeo')!=NULL) {?> 
                <li>
                  <a href="<?php echo get_theme_mod('vimeo'); ?>"><img src="<?php echo get_theme_mod('vimeo_image'); ?>"></a>
                </li>
                <?php } ?>                
                <?php if (get_theme_mod('youtube')!=NULL) {?>
                <li>
                  <a href="<?php echo get_theme_mod('youtube'); ?>"><img src="<?php echo get_theme_mod('youtube_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('facebook')!=NULL) {?>
                <li>
                  <a href="<?php echo get_theme_mod('facebook'); ?>"><img src="<?php echo get_theme_mod('facebook_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('instagram')!=NULL) {?>
                <li>
                  <a href="<?php echo get_theme_mod('instagram'); ?>"><img src="<?php echo get_theme_mod('instagram_image'); ?>"></a>
                </li>
                <?php } ?>
                <?php if (get_theme_mod('twitter')!=NULL) {?>
                <li>
                  <a href="<?php echo get_theme_mod('twitter'); ?>"><img src="<?php echo get_theme_mod('twitter_image'); ?>"></a>
                </li>
                <?php } ?>   
                <?php if (get_theme_mod('linkedin')!=NULL) {?>
                <li>
                  <a href="<?php echo get_theme_mod('linkedin'); ?>"><img src="<?php echo get_theme_mod('linkedin_image'); ?>"></a>
                </li>
                <?php } ?>            

          </ul>
        </div>
