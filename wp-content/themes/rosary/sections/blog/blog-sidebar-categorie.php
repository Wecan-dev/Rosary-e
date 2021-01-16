          <div class="blog-sidebar__content">
            <p class="blog-sidebar__title">
              Categorías
            </p>
		
			  
			  
        <ul class="blog-sidebar__categorie">
         <?php
          global $wpdb;
          $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'orderby' => 'menu_order', 'order' => 'asc', 'parent' =>0  ));  
          ?>                                                        
          <?php foreach($product_categories as $category): ?>
            <?php $checked =NULL;  if ($category->slug == $_GET['cat']) { $checked = "checked='checked'"; } $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?>    
              <li>
                <a href="<?php echo get_category_link( $category->term_id ); ?>">
                   <?= $categoria ?>
                </a>
              </li>
              <?php endforeach; ?>  
            </ul>
          </div>


          <div class="blog-sidebar__content">
            <p class="blog-sidebar__title">
              Colecciones
            </p>
		
			  
			  
        <ul class="blog-sidebar__categorie">
                  <?php
          global $wpdb;
          $product_categories = get_categories( array( 'taxonomy' => 'product_cat', 'orderby' => 'menu_order', 'order' => 'asc'  ));  
          ?>                                                        
          <?php foreach($product_categories as $category): ?>
            <?php $checked =NULL;  if ($category->slug == $_GET['cat']) { $checked = "checked='checked'"; } $categoria = $category->name; $category_id = $category->term_id; $category_link = get_category_link( $category_id ); ?> 
            <?php if($category->parent >1){ ?>  
              <li>
                <a href="<?php echo get_category_link( $category->term_id ); ?>">
                   <?= $categoria ?>
                </a>
              </li>
            <?php } ?>  
              <?php endforeach; ?>  
            </ul>
          </div>









