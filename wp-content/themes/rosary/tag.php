<?php
/**
* A Simple Tag Template
*/
get_header(); 


$tag_id = get_query_var('tag_id');
$tag_lug = get_query_var('tag');
$tag_link = get_tag_link( $tad_id );
?>
  <section class="main-featured main-featured--white">
    <div class="padding-top-bottom">
      <h2 class="main-general__title">
        Tag <?php echo get_query_var('tag'); ?>
      </h2>
    </div>
  </section>

  <section class="blog-general">
    <div class="container-grid">
      <div class="blog-general__all">
        <?php
        $args = 
        array(
          'type' => 'post',
          'paged' => $paged,
          'posts_per_page' => 3,
          'tax_query' => array(
             'relation'=>'AND', // 'AND' 'OR' ...
              array(
                'taxonomy'        => 'post_tag',
                'field'           => 'slug',
                'terms'           => array($tag_lug),
                'operator'        => 'IN',
               )),
          ); ?>
        <?php $loop = new WP_Query( $args ); ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>        
        <div class="blog-general__post">
          <img class="blog-general__poster" src="<?php the_post_thumbnail_url('full'); ?>">
          <ul class="blog-general__meta">
            <li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/blog/calendar.png">
              <a href="">
                 <?php the_time(get_option('date_format')); ?>
              </a>
            </li>
            <li>
              <img src="<?php echo get_template_directory_uri();?>/assets/img/blog/tag.png">
              <?php if ( verify_tags(get_the_ID()) > 0 ){ foreach((get_the_terms(get_the_ID(), 'post_tag' )) as $tag) {$category_id = $tag->term_id; $tag_link = get_category_link( $category_id ); echo '<a href="'.$tag_link.'">'.$tag->name.'</a>'; }} ?>
            </li>
          </ul>
          <a class="blog-general__title" href="">
             <?php the_title(); ?>
          </a>
          <p class="blog-general__description">
            <?php echo excerpt(50); ?>
          </p>
          <p class="blog-general__autor">
            <span>
               By:
            </span> <?php $queried_post = get_post($post_id); echo author_name($queried_post->post_author); ?>
          </p>
          <div class="general-blog__flex">
            <a class="general-blog__btn" href="<?php the_permalink(); ?>">
               Continuar Leyendo
            </a>
            <div class="general-blog__icon">
              <a href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/blog/share.png">
</a>
              <a href="">
<img src="<?php echo get_template_directory_uri();?>/assets/img/blog/comment.png">
<?php echo get_comments_number() ?> comentarios
</a>
            </div>
          </div>
        </div>
        <?php endwhile; ?> 

        <?php
            //$published_posts = wp_count_posts()->publish;
        $published_posts = counts_post_tag($tag_lug);
        //$published_posts = 3;
           // $posts_per_page = get_option('posts_per_page');
        $posts_per_page = 3;
        $page_number_max = ceil($published_posts / $posts_per_page);
        $max_page = $page_number_max;
        if (!$paged && $max_page >= 1) {
          $current_page = 1;
        }
        else {
          $current_page = $paged;
        } ?>           
           
             <div class="blog-general__paginator">
                <?php echo paginate_links(array(
                  "base" => add_query_arg("paged", "%#%"),
                  "format" => '',
                  "type" => "plain",
                  "total" => $max_page,
                  "current" => $current_page,
                  "show_all" => false,
                  "end_size" => 2,
                  "mid_size" => 2,
                  "prev_next" => true,
                  "next_text" => __('<img src="'.get_template_directory_uri().'/assets/img/blog/next.png">'),
                  "prev_text" => __('<img src="'.get_template_directory_uri().'/assets/img/blog/prev.png">'),
                  )); ?>
              </div>

      </div>
      <div class="blog-sidebar">
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
    </div>
  </section>
<?php get_footer(); ?>