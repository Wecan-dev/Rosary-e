 <?php
   //////////////CONTACT  
  $wp_customize->add_section('contact', array (
    'title' => 'Info Contacto',
    'panel' => 'panel5'
  ));

  $wp_customize->add_setting('description_contact', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'description_contact_control', array (
    'label' => 'Descripción',
    'section' => 'contact',
    'settings' => 'description_contact',
    'type' => 'textarea'
  )));

  $wp_customize->add_setting('email', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'email_control', array (
    'label' => 'Email',
    'section' => 'contact',
    'settings' => 'email'
  )));

  $wp_customize->add_setting('phone', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'phone_control', array (
    'label' => 'Teléfono',
    'section' => 'contact',
    'settings' => 'phone'
  )));  

  $wp_customize->add_setting('address', array(
    'default' => ''
  ));
  
  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_control', array (
    'label' => 'Dirección',
    'section' => 'contact',
    'settings' => 'address',
    'type' => 'textarea'
  )));


  $wp_customize->add_setting('address_map', array(
    'default' => ''
  ));

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'address_map_control', array (
    'description' => 'Mapa Dirección',
    'section' => 'contact',
    'settings' => 'address_map',
    'type' => 'textarea'
  ))); 


?>