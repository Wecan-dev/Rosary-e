<?php
  /////Best Seller
  
  $wp_customize->add_section('best_seller', array (
    'title' => 'Main Best Selller',
    'panel' => 'panel1'
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

  $wp_customize->add_setting('best_seller_num_post', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'best_seller_num_post_control', array (
    'description' => 'Números de Entradas',
    'section' => 'best_seller',
    'settings' => 'best_seller_num_post',
    'type' => 'number',
    'input_attrs' => array(
    'min'   => 1,
    'max'   => 100,)
  ))); 
  
?>