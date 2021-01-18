<?php
  /////Best Seller
  
  $wp_customize->add_section('best_seller', array (
    'title' => 'Best Selller',
    'panel' => 'panel2'
  ));
  

  $wp_customize->add_setting('best_seller_title', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'best_seller_title_control', array (
    'description' => 'Título',
    'section' => 'best_seller',
    'settings' => 'best_seller_title',
  )));

  $wp_customize->add_setting('best_seller_subtitle', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'best_seller_subtitle_control', array (
    'description' => 'Subtítulo',
    'section' => 'best_seller',
    'settings' => 'best_seller_subtitle',
  )));

 /*** Tesoros****/
  $wp_customize->add_setting('tareas_hidden', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'tareas_hidden_control', array (
    'description' => '<hr>Tesoros de la Colección',
    'section' => 'best_seller',
    'settings' => 'tareas_hidden',
    'type' => 'hidden'
  )));

    $a=array("0"=>"Seleccionar");
      $args = array (
             'post_type' => 'product',
             'post_status' => 'publish',
		     'posts_per_page' => 300,  
                     
      );
    $loop = new WP_Query( $args );   
    while ( $loop->have_posts() ) : $loop->the_post(); global $product; 
      $id_pro = get_the_ID();
      $name_pro = 'algo';
      $b = $a[$id_pro]= get_the_title().' #'.$id_pro;
      //array_push($a, $b);
    endwhile;
    array_pop($a);

    for ($i=1; $i <=12; $i++) { 
      $wp_customize->add_setting('productos_best'.$i.'', array(
        'default' => ''
        ));

      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'productos_best'.$i.'_control', array (
        'description' => 'Productos # '.$i.'',
        'section' => 'best_seller',
        'settings' => 'productos_best'.$i.'',
        'type'     => 'select',
        'choices'  => $a,
      //$array_cat_id => $array_cat_name,
     // 'color' => 'Color',

        ))); 
     }  
  
?>