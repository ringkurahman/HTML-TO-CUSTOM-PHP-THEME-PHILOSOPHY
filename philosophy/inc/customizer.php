<?php

function philosophy_customizer( $wp_customizer ) {

  // Copyright
  $wp_customizer-> add_section( 'sec_copyright', array(
      'title'       => 'Copyright',
      'description' => 'Please type here the copyright',
  ));

  $wp_customizer-> add_setting( 'set_copyright', array(
      'type'              => 'theme_mod',
      'default'           => 'Copyright X- all Rights Reserved',
      'sanitize_callback' => 'esc_attr'
  ));

  $wp_customizer-> add_control( 'ctrl_copyright', array(
      'label'        => 'Copyright Information',
      'description'  => 'Please type your copyright here',
      'section'      => 'sec_copyright',
      'settings'     => 'set_copyright',
      'type'         => 'text',
  ));

  //Map
  $wp_customizer-> add_section( 'sec_map', array(
      'title'       => 'Map',
      'description' => 'The Map Section',
  ));
  $wp_customizer-> add_setting( 'set_map_apikey', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'esc_attr'
  ));

  $wp_customizer-> add_control( 'ctrl_map_apikey', array(
      'label'        => 'Google Maps API Key',
      'description'  => 'Get your key <a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend">here</a>',
      'section'      => 'sec_map',
      'settings'     => 'set_map_apikey',
      'type'         => 'text',
  ));

  //Map Address
  $wp_customizer-> add_setting( 'set_map_address', array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'esc_textarea'
  ));

  $wp_customizer-> add_control( 'ctrl_map_address', array(
      'label'        => 'Type Your Address Here',
      'description'  => 'No special characters allowed',
      'section'      => 'sec_map',
      'settings'     => 'set_map_address',
      'type'         => 'textarea',
  ));

}

add_action( 'customize_register', 'philosophy_customizer');
