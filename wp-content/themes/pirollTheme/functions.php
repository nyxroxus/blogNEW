<?php
/* Enqueue scripts and styles section */
function pirollTheme_scripts() {
    wp_enqueue_style( 'main', get_template_directory_uri() . '/stylesheets/main.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main-js.js', array(), '1.0.0', true );
    wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
    wp_enqueue_style('Font_Awesome');
	}
add_action( 'wp_enqueue_scripts', 'pirollTheme_scripts' );

/* Theme support for menus */
function piroll_navigation_menus(){
  register_nav_menus(
    array(
      'primary'   =>  __( 'Main navigation header menu' ),
      'secondary' =>  __( 'Secondary navigation footer menu' ),
      'third'     =>  __( 'Third navigation footer menu' ),
    )
  );
  add_theme_support('menus');
}
add_action( 'after_setup_theme', 'piroll_navigation_menus' );

/* Theme support for custom logo */
function piroll_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'piroll_custom_logo_setup' );

/* Theme support for main header image */
function piroll_header_image_setup(){
  $args = array(
    'default-image'       =>  get_template_directory_uri() . 'assets/default-header.jpg',
    'width'               =>  1368,
    'height'              =>  300,
    'header-text'         =>  true,
    'flex-width'          =>  false,
    'flex-height'         =>  false,
  );
  add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'piroll_header_image_setup' );

/* Theme support for thumbnail images */
function piroll_post_thumbnail_setup_theme() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 );
    add_image_size( 'small', 250, 250 );
    add_image_size( 'wordpress-thumbnail', 350, 300, TRUE );
}
add_action( 'after_setup_theme', 'piroll_post_thumbnail_setup_theme' );
?>
