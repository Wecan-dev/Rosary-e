          <div class="blog-sidebar__content">
            <p class="blog-sidebar__title">
               Post recientes
            </p>
            <div class="blog-sidebar__recent">
            <?php
            $args = 
            array(
              'post_type' => get_post(get_the_ID())->post_type,
              'posts_per_page' => 3,

              'order' => 'DESC',             
             // 'tax_query' => array(
                // 'relation'=>'AND', // 'AND' 'OR' ...
                 // array(
                   // 'taxonomy'        => 'category',
                   // 'field'           => 'slug',
                   // 'terms'           => array('blog'),
                   // 'operator'        => 'IN',
                   //)),
              ); ?>
            <?php $loop = new WP_Query( $args ); ?>
            <?php while ( $loop->have_posts() ) : $loop->the_post();?>            
              <div class="blog-recent__item">
                <img src="<?php the_post_thumbnail_url('full'); ?>">
                <div class="blog-recent__text">
                  <p class="blog-recent__date">
                    <?php the_time(get_option('date_format')); ?>
                  </p>
                  <p class="blog-recent__title">
                    <?php the_title(); ?>
                  </p>
                </div>
              </div>
            <?php endwhile; ?>  
            </div>
          </div>