<?php
  /////Text
  
  $wp_customize->add_section('text', array (
    'title' => 'Textos',
    'panel' => 'panel1'
  ));
  

  $wp_customize->add_setting('text_linea1', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'text_linea1_control', array (
    'description' => 'Línea 1',
    'section' => 'text',
    'settings' => 'text_linea1',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('text_linea2', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'text_linea2_control', array (
    'description' => 'Línea 2',
    'section' => 'text',
    'settings' => 'text_linea2',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('text_linea3', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'text_linea3_control', array (
    'description' => 'Línea 3',
    'section' => 'text',
    'settings' => 'text_linea3',
    'type' => 'textarea'
  )));  


?>