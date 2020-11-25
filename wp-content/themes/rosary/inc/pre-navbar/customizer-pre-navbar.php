<?php
  /////Navbar
  /***************** Pre-navbar ******************/
  $wp_customize->add_section('pre-navbar', array (
    'title' => 'Pre-navbar',
    'panel' => 'panel1',
  ));

  $wp_customize->add_setting('pre-navbar_title', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'pre-navbar_title_control', array (
    'description' => 'Contenido',
    'section' => 'pre-navbar',
    'settings' => 'pre-navbar_title',
  )));
  
?>