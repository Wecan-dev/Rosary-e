<?php
  /////Sale
  
  $wp_customize->add_section('sale', array (
    'title' => 'Sale',
    'panel' => 'panel2'
  ));

    $wp_customize->add_setting('sale_description', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'sale_description_control', array (
    'description' => 'Título',
    'section' => 'sale',
    'settings' => 'sale_description',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('sale_title', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'sale_title_control', array (
    'description' => 'Subtítulo',
    'section' => 'sale',
    'settings' => 'sale_title',
  )));  



  $wp_customize->add_setting('sale_buttom', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'sale_buttom_control', array (
    'description' => 'Botón',
    'section' => 'sale',
    'settings' => 'sale_buttom',
  )));

  $wp_customize->add_setting('sale_url_buttom', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'sale_url_buttom_control', array (
    'description' => 'Url Botón',
    'section' => 'sale',
    'settings' => 'sale_url_buttom',
  )));

  $wp_customize->add_setting('sale_image', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'sale_image_control', array (
    'description' => 'Imagen',
    'section' => 'sale',
    'settings' => 'sale_image',
  )));


?>