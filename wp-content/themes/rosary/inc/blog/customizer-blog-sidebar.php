<?php

  /***************** Blog  ******************/
/***************** blog-sidebar ******************/
  $wp_customize->add_section('blog_sidebar', array (
    'title' => 'Sidebar Blog',
    'description' => 'Opciones Sidebar',    
    'panel' => 'panel3'    
  ));

  $wp_customize->add_setting('blog_sidebar_categorie', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_categorie_control', array (
    'label' => 'Sidebar Categorías',
    'section' => 'blog_sidebar',
    'settings' => 'blog_sidebar_categorie',
    'type' => 'checkbox'
  )));

  $wp_customize->add_setting('blog_sidebar_follow', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_follow_control', array (
    'label' => 'Sidebar Síguenos',
    'section' => 'blog_sidebar',
    'settings' => 'blog_sidebar_follow',
    'type' => 'checkbox'
  )));  

  $wp_customize->add_setting('blog_sidebar_posts_recent', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_posts_recent_control', array (
    'label' => 'Sidebar Posts Recientes',
    'section' => 'blog_sidebar',
    'settings' => 'blog_sidebar_posts_recent',
    'type' => 'checkbox'
  )));   

  $wp_customize->add_setting('blog_sidebar_poster', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'blog_sidebar_poster_control', array (
    'label' => 'Sidebar Poster',
    'section' => 'blog_sidebar',
    'settings' => 'blog_sidebar_poster',
    'type' => 'checkbox'
  )));  

?>