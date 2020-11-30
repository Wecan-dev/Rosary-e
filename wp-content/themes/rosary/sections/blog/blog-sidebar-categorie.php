          <div class="blog-sidebar__content">
            <p class="blog-sidebar__title">
              Categorías
            </p>
            <ul class="blog-sidebar__categorie">
            <?php $product_categories = get_categories( array( 'taxonomy' => 'category', 'orderby' => 'menu_order', 'order' => 'asc' ));  ?>
            <?php foreach($product_categories as $category):  global $wpdb;?>
            <?php $result = $wpdb->get_results ("SELECT * FROM ".$wpdb->prefix."term_taxonomy where taxonomy = 'product_cat'");?>
                <li>              
                  <a href="<?php echo get_category_link( $category->term_id ); ?>"><?=$category->name ?></a>
                </li>                
                <?php $i=$i+1;?>
                <?php endforeach; ?> 
            </ul>
          </div>