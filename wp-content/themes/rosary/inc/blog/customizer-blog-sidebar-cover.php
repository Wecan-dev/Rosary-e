<?php

  /***************** Blog  ******************/
/***************** blog-sidebar-cover ******************/

  $wp_customize->add_section('blog_sidebar_cover', array (
    'title' => 'Sidebar Blog Cover',
    'panel' => 'panel3'    
  ));

  $wp_customize->add_setting('blog_sidebar_text', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_text_control', array (
    'label' => 'Sidebar Cover',
    'description' => 'Text',
    'section' => 'blog_sidebar_cover',
    'settings' => 'blog_sidebar_text',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('blog_sidebar_button', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_button_control', array (
    'description' => 'Button',
    'section' => 'blog_sidebar_cover',
    'settings' => 'blog_sidebar_button',
  )));  

  $wp_customize->add_setting('blog_sidebar_urlbutton', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_urlbutton_control', array (
    'description' => 'Url Button',
    'section' => 'blog_sidebar_cover',
    'settings' => 'blog_sidebar_urlbutton',
  )));  


  $wp_customize->add_setting('blog_sidebar_image');
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blog_sidebar_image_control', array (
    'description' => 'Image Desktop',
    'section' => 'blog_sidebar_cover',
    'settings' => 'blog_sidebar_image'
  )));

  $wp_customize->add_setting('blog_sidebar_image_responsive');
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blog_sidebar_image_responsive_control', array (
    'description' => 'Image Responsive',
    'section' => 'blog_sidebar_cover',
    'settings' => 'blog_sidebar_image_responsive'
  )));  
  
?>