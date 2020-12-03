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

require_once trailingslashit( get_template_directory() ) . 'inc/fnc/local-field-group.php';

/***************** Personalization page of product WooCommerce ************/

function rosary_custom_product_woocommmerce() {
  remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
  remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
} 

// Register Custom Personalizados Home
function Personalizado() {

  $labels = array(
    'name'                  => _x( 'Personalizados ', 'Post Type General Name', 'rosary' ),
    'singular_name'         => _x( 'Personalizados', 'Post Type Singular Name', 'rosary' ),
    'menu_name'             => __( 'Personalizados', 'rosary' ),
    'name_admin_bar'        => __( 'Post Type', 'rosary' ),
    'archives'              => __( 'Archivo', 'rosary' ),
    'attributes'            => __( 'Atributos', 'rosary' ),
    'parent_item_colon'     => __( 'Artículo principal', 'rosary' ),
    'all_items'             => __( 'Todos los artículos', 'rosary' ),
    'add_new_item'          => __( 'Agregar ítem nuevo', 'rosary' ),
    'add_new'               => __( 'Añadir nuevo', 'rosary' ),
    'new_item'              => __( 'Nuevo artículo', 'rosary' ),
    'edit_item'             => __( 'Editar elemento', 'rosary' ),
    'update_item'           => __( 'Actualizar artículo', 'rosary' ),
    'view_item'             => __( 'Ver ítem', 'rosary' ),
    'view_items'            => __( 'Ver artículos', 'rosary' ),
    'search_items'          => __( 'Buscar artículo', 'rosary' ),
    'not_found'             => __( 'Extraviado', 'rosary' ),
    'not_found_in_trash'    => __( 'No se encuentra en la basura', 'rosary' ),
    'featured_image'        => __( 'Foto principal', 'rosary' ),
    'set_featured_image'    => __( 'Establecer imagen destacada', 'rosary' ),
    'remove_featured_image' => __( 'Remove featured image', 'rosary' ),
    'use_featured_image'    => __( 'Usar como imagen destacada', 'rosary' ),
    'insert_into_item'      => __( 'Insertar en el elemento', 'rosary' ),
    'uploaded_to_this_item' => __( 'Subido a este artículo', 'rosary' ),
    'items_list'            => __( 'Lista de artículos', 'rosary' ),
    'items_list_navigation' => __( 'Lista de elementos de navegación', 'rosary' ),
    'filter_items_list'     => __( 'Lista de elementos de filtro', 'rosary' ),
  );
  $args = array(
    'label'                 => __( 'Personalizados Home', 'rosary' ),
    'description'           => __( 'Post Type Description', 'rosary' ),
    'labels'                => $labels,
    'supports'              => array( 'title'),
    'taxonomies'            => array(  ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-images-alt2',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'Personalizado', $args );

}
add_action( 'init', 'Personalizado', 0 );