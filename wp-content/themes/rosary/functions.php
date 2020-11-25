<?php 

/****************** Styles *****************/
function rosary_styles(){
  wp_enqueue_style('bootstrap', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" );
  wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/css/font-awesome.css' );
  wp_enqueue_style('slick-theme', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css' );
  wp_enqueue_style('slick', get_stylesheet_directory_uri() . '/assets/css/slick.css' );
  wp_enqueue_style('main', get_stylesheet_directory_uri() . '/assets/css/main.css' );
  wp_enqueue_style('animate', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" );
  wp_enqueue_style('favicon', get_stylesheet_directory_uri() . '/assets/img/favicon.png' );
  wp_enqueue_style('googleapis', "https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900|Open+Sans:300,400,600,700,800|Poppins:100,200,300,400,500,600,700,800,900&amp;display=swap" );


  wp_enqueue_script( 'jquerymin',get_bloginfo('stylesheet_directory') . '/assets/js/jquery.min.js', array( 'jquery' ) ); 
  wp_enqueue_script( 'popper','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js');
  wp_enqueue_script( 'bootstrap-min','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js');
  wp_enqueue_script( 'slick-min',get_bloginfo('stylesheet_directory') . '/assets/js/slick.min.js', array( 'jquery' ) );  
  wp_enqueue_script( 'wow','https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js');
  wp_enqueue_script( 'main-js',get_bloginfo('stylesheet_directory') . '/assets/js/main.js', array( 'jquery' ) ); 

}

add_action('wp_enqueue_scripts', 'rosary_styles');

/***************Functions theme ********************/

function theme_customize_register($wp_customize){

  $wp_customize->add_panel('panel1',
        array(
            'title' => 'Pre-navbar',
            'priority' => 1,
            )
        );
  require_once trailingslashit( get_template_directory() ) . 'inc/pre-navbar/customizer-pre-navbar.php';  

  $wp_customize->add_panel('panel2',
        array(
            'title' => 'Home',
            'priority' => 2,
            )
        );
  require_once trailingslashit( get_template_directory() ) . 'inc/home/customizer-main-banner.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/home/customizer-main-best-seller.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/home/customizer-main-about.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/home/customizer-main-text.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/home/customizer-main-categories.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/home/customizer-main-sale.php';

  $wp_customize->add_panel('panel3',
        array(
            'title' => 'Blog',
            'priority' => 3,
            )
        );
 
  require_once trailingslashit( get_template_directory() ) . 'inc/blog/customizer-blog.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/blog/customizer-blog-sidebar.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/blog/customizer-blog-sidebar-cover.php'; 


  $wp_customize->add_panel('panel5',
        array(
            'title' => 'Información de Contacto',
            'priority' => 5,
            )
        );
 
  require_once trailingslashit( get_template_directory() ) . 'inc/contact/customizer-contact.php';
  require_once trailingslashit( get_template_directory() ) . 'inc/contact/customizer-social-networks.php'; 
 // require_once trailingslashit( get_template_directory() ) . 'inc/customizer-contact-stores.php';         

  
} 
add_action('customize_register','theme_customize_register');

/***************** FNT General ************/

require_once trailingslashit( get_template_directory() ) . 'inc/fnc/fnc.php';

/***************** Local field group ************/

//require_once trailingslashit( get_template_directory() ) . 'inc/fnc/local-field-group.php';

