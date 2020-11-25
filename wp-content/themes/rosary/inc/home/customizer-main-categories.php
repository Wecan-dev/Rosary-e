<?php
  /////Categories
  
  $wp_customize->add_section('categories', array (
    'title' => 'Imagen Categoría Break',
    'panel' => 'panel1'
  ));
    

  $wp_customize->add_setting('categories_image', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'categories_image_control', array (
    'description' => 'Imagen',
    'section' => 'categories',
    'settings' => 'categories_image',
  )));


?>