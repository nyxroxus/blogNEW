<?php
function custom_theme_enqueue_scripts(){
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( 'customstyle', get_template_directory_uri() . '/custom_style.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . 'js/custom.js', array(), '1.0.0', true );
  wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
  wp_enqueue_style('Font_Awesome');
}
function custom_theme_custom_header_setup(){
  $args = array(
    'default-image'       =>  get_template_directory_uri() . 'images/default-header-image.jpg',
    'width'               =>  1000,
    'height'              =>  250,
    'header-text'         =>  true,
    'default-text-color'  => '#fcfcfc',
    'flex-width'          =>  true,
    'flex-height'         =>  true,
  );
  add_theme_support( 'custom-header', $args );
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
function setup_theme_admin_menus(){
  add_submenu_page( 'themes.php', 'Front Page Elements', 'Front Page', 'manage_options', 'front-page-elements', 'theme_front_page_settings' );
}

function theme_front_page_settings(){
  include 'theme_settings_page.php';
  }

add_action( 'admin_menu', 'setup_theme_admin_menus' );
add_action( 'after_setup_theme', 'custom_theme_custom_header_setup' );
add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action( 'after_setup_theme', customtheme_custom_logo_setup );
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_scripts' );

?>
