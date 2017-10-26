<?php
function custom_theme_enqueue_scripts(){
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( 'customstyle', get_template_directory_uri() . '/custom_style.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . 'js/custom.js', array(), '1.0.0', true );
}
function customtheme_custom_logo_setup(){
  $defaults = array(
  'height' => 100,
  'width' =>  400,
  'flex-height' => true,
  'flex-width' => true,
  );
  add_theme_support( 'custom-logo', $defaults );
}
function custom_theme_setup(){
  register_nav_menus(
    array(
      'primary'   =>  __( 'Main navigation header menu' ),
      'secondary' =>  __( 'Secondary navigation footer menu' ),
    )
  );
  add_theme_support('menus');
}

add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action( 'after_setup_theme', customtheme_custom_logo_setup );
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_scripts' );

?>
