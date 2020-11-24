<?php
  /////Blog
  /***************** banner blog ******************/
  $wp_customize->add_section('blog_banner', array (
    'title' => 'Blog Banner',
    'panel' => 'panel3',
  ));

  $wp_customize->add_setting('blog_banner_title', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_banner_title_control', array (
    'label' => 'Banner',
    'description' => 'Title',
    'section' => 'blog_banner',
    'settings' => 'blog_banner_title',
  )));

  $wp_customize->add_setting('blog_banner_subtitle', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_banner_subtitle_control', array (
    'description' => 'Subtitle',
    'section' => 'blog_banner',
    'settings' => 'blog_banner_subtitle',
  )));

 
  $wp_customize->add_setting('blog_banner_image');
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blog_banner_image_control', array (
    'description' => 'Image Desktop',
    'section' => 'blog_banner',
    'settings' => 'blog_banner_image'
  )));   

  $wp_customize->add_setting('blog_banner_image_responsive');
  
  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blog_banner_image_responsive_control', array (
    'description' => 'Image Responsive',
    'section' => 'blog_banner',
    'settings' => 'blog_banner_image_responsive'
  )));  
  
?>