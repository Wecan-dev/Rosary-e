<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Mar de rosas
 */

get_header();

?>
  <?php
    while ( have_posts() ) :
       the_post();
       $queried_post = get_post(get_the_ID());
       $post_type = $queried_post->post_type;

    endwhile; // End of the loop.
    
    if ($post_type == 'post') {
      get_template_part( 'template-parts/content-single-blog', get_post_format() ); 
    }   
             

             
?>
