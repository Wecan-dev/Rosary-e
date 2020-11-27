        <div class="blog-sidebar__content">
          <p class="blog-sidebar__title">
            Blogs recientes
          </p>
          <div class="blog-sidebar__post">
            <?php
            $args = 
            array(
              'post_type' => get_post(get_the_ID())->post_type,
              'posts_per_page' => 3,
              'order' => 'DESC',        
              ); ?>
            <?php $loop = new WP_Query( $args ); ?>
            <?php while ( $loop->have_posts() ) : $loop->the_post();?>            
            <div class="blog-post__item">
              <img src="<?php the_post_thumbnail_url('full'); ?>">
              <div class="blog-post__text">
                <p> <?php the_time(get_option('date_format')); ?></p>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </div>
            </div>
            <?php endwhile; ?> 
          </div>
        </div>