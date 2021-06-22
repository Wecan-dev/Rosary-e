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


/*********** ITEMS Banner***********/
function custom_post_type_Items_banner() {

  $labels = array(
    'name'                  => _x( 'Items Banner', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( 'Items Banner', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( 'Items Banner', 'text_domain' ),
    'name_admin_bar'        => __( 'Items Banner', 'text_domain' ),
    'archives'              => __( 'Archives', 'text_domain' ),
    'attributes'            => __( 'Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Main Items Banner', 'text_domain' ),
    'all_items Banner'             => __( 'All Items Banner', 'text_domain' ),
    'add_new_item'          => __( 'Add New Items Banner', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New Items Banner', 'text_domain' ),
    'edit_item'             => __( 'Edit Items Banner', 'text_domain' ),
    'update_item'           => __( 'Update Items Banner', 'text_domain' ),
    'view_items Banner'            => __( 'See Items Banner', 'text_domain' ),
    'search_items Banner'          => __( 'Search Items Banner', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'It is not in the trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set Featured Image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove Featured Image', 'text_domain' ),
    'use_featured_image'    => __( 'Use Featured Image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert Into Item', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
    'items Banner_list'            => __( 'items Banner List', 'text_domain' ),
    'items Banner_list_navigation' => __( 'items Banner List Navigation', 'text_domain' ),
    'filter_items Banner_list'     => __( 'filter Items Banner List', 'text_domain' ),
  );
  $args = array(
    'label'                 => __( 'Items Banner', 'text_domain' ),
    'description'           => __( 'Items Banner image', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'custom-fields' ),
    'taxonomies'            => array( '' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-format-gallery',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page', 
  );
  register_post_type( 'Items Banner', $args );

}
add_action( 'init', 'custom_post_type_Items_banner', 0 );




// Register Custom Post Type
function postinicio() {

	$labels = array(
		'name'                  => _x( 'Post inicio', 'Post Type General Name', 'apk' ),
		'singular_name'         => _x( 'Post inicio', 'Post Type Singular Name', 'apk' ),
		'menu_name'             => __( 'Post inicio', 'apk' ),
		'name_admin_bar'        => __( 'Post inicio', 'apk' ),
		'archives'              => __( 'Item Archives', 'apk' ),
		'attributes'            => __( 'Item Attributes', 'apk' ),
		'parent_item_colon'     => __( 'Parent Item:', 'apk' ),
		'all_items'             => __( 'All Items', 'apk' ),
		'add_new_item'          => __( 'Add New Item', 'apk' ),
		'add_new'               => __( 'Add New', 'apk' ),
		'new_item'              => __( 'New Item', 'apk' ),
		'edit_item'             => __( 'Edit Item', 'apk' ),
		'update_item'           => __( 'Update Item', 'apk' ),
		'view_item'             => __( 'View Item', 'apk' ),
		'view_items'            => __( 'View Items', 'apk' ),
		'search_items'          => __( 'Search Item', 'apk' ),
		'not_found'             => __( 'Not found', 'apk' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'apk' ),
		'featured_image'        => __( 'Featured Image', 'apk' ),
		'set_featured_image'    => __( 'Set featured image', 'apk' ),
		'remove_featured_image' => __( 'Remove featured image', 'apk' ),
		'use_featured_image'    => __( 'Use as featured image', 'apk' ),
		'insert_into_item'      => __( 'Insert into item', 'apk' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'apk' ),
		'items_list'            => __( 'Items list', 'apk' ),
		'items_list_navigation' => __( 'Items list navigation', 'apk' ),
		'filter_items_list'     => __( 'Filter items list', 'apk' ),
	);
	$args = array(
		'label'                 => __( 'Post inicio', 'apk' ),
		'description'           => __( 'Post inicio', 'apk' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( '', '' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-generic',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'postinicio', $args );

}
add_action( 'init', 'postinicio', 0 );





// Establecer un importe minimo en la compra
function woocommerce_importe_minimo() {
  $minimum = 5000000;  // Debes cambiar el 20 por el importe mínimo que quieras establecer en tu pedido
  if ( WC()->cart->total > $minimum ) {
    if( is_cart() ) {
      wc_print_notice(
		  
      sprintf( '  Esta plataforma permite un monto máximo por transacción de %s, si tu compra supera éste valor ¡No te preocupes! Puedes llevar todos los productos realizando transacciones independientes' , // Pon aquí el texto que quieras que se muestre en el carrito de compra.
        wc_price( $minimum ),
        wc_price( WC()->cart->total )
      ), 'error'
      );
    } else {
      wc_add_notice(
		 
      sprintf( '  No puedes finalizar tu compra. El monto máximo por transacción es de %s, si tu compra supera éste valor ¡No te preocupes! Puedes realizar diferentes transacciones.' , // Pon aquí el texto que quieras que se muestre en la página de finalizar compra.
        wc_price( $minimum ), 
        wc_price( WC()->cart->total )
      ), 'error'
      );
    }
  }
}
add_action( 'woocommerce_checkout_process', 'woocommerce_importe_minimo' );
add_action( 'woocommerce_before_cart' , 'woocommerce_importe_minimo' );


// Minimum CSS to remove +/- default buttons on input field type number
add_action( 'wp_head' , 'custom_quantity_fields_css' );
function custom_quantity_fields_css(){
    ?>
    <style>
    .quantity input::-webkit-outer-spin-button,
    .quantity input::-webkit-inner-spin-button {
        display: none;
        margin: 0;
    }
    .quantity input.qty {
        appearance: textfield;
        -webkit-appearance: none;
        -moz-appearance: textfield;
    }
    </style>
    <?php
}


add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 1;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?php
}

// colocar en el title el nombre de la page 
function wpdocs_filter_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

    // Add the site name.
	$title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

    // Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wpdocs_filter_wp_title', 10, 2 );

/*********** Styles checkout ***********/
/*********** Styles checkout ***********/
function styles_checkout(){ 

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
         $item = $item +1;
        }

    do_action( 'woocommerce_review_order_before_cart_contents' );

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
        if ($item > 1) {}
        else{ ?>
      
        <style type="text/css">
          .wc-block-components-order-summary-item__description, .wc-block-components-order-summary-item__image {
              display: table-row-group;
              vertical-align: top;
          }
          .wc-block-components-order-summary-item__image>img {
              max-width: 300px;
              width: 300px;
          }
        </style>
     
        <?php
      }
    }
  }
}




function wpb_custom_new_menu()
{
	register_nav_menu('my-custom-menu', __('Main Menu'));
}
add_action('init', 'wpb_custom_new_menu');


?>