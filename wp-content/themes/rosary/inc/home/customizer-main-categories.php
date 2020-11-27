<?php
  /////Categories
  
  $wp_customize->add_section('categories', array (
    'title' => 'Imagen Categoría Break',
    'panel' => 'panel2'
  ));
    

  $wp_customize->add_setting('categories_image', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'categories_image_control', array (
    'description' => 'Imagen',
    'section' => 'categories',
    'settings' => 'categories_image',
  )));


  $wp_customize->add_setting('categories_title', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'categories_title_control', array (
    'description' => 'Titulo',
    'section' => 'categories',
    'settings' => 'categories_title',
  )));  


?>