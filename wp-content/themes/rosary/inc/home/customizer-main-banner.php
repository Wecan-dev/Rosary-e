<?php
  /////Banner
  
  $wp_customize->add_section('banner', array (
    'title' => 'Main Banner',
    'panel' => 'panel1'
  ));
  
for ($i=1; $i <= 3; $i++) { 

  $wp_customize->add_setting('banner_title_'.$i.'', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'banner_title_'.$i.'_control', array (
    'description' => 'Título '.$i.'',
    'section' => 'banner',
    'settings' => 'banner_title_'.$i.'',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('banner_image_'.$i.'', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'banner_image_'.$i.'_control', array (
    'description' => 'Imagen '.$i.'',
    'section' => 'banner',
    'settings' => 'banner_image_'.$i.'',
  )));  
}
  
  
?>