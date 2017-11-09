<?php

/* Enqueue styles and scripts */
function custom_theme_enqueue_scripts(){
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( 'customstyle', get_template_directory_uri() . '/custom_style.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . 'js/custom.js', array(), '1.0.0', true );
  wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
  wp_enqueue_style('Font_Awesome');
}

/* Functions */
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

function add_theme_menu_item()
    {
        add_menu_page(
            "Theme Panel",/*title*/
            "Theme Panel",/*meta title*/
            "manage_options",/**/
            "theme-panel",/*slug*/
            "theme_options_page",
            null,
            99
        );
}
function new_excerpt_more($more) {
  return '';
}
/* Here you can stylize how read more link would appear */
function the_excerpt_more_link( $excerpt ){
  $post = get_post();
  $excerpt .= '<div class="bg-lightred pa3 w-20 tc center"><a href="'. get_permalink($post->ID) . '" class="link white" >Read more</a></div>';
  return $excerpt;
}
/* Add filters */
add_filter( 'excerpt_more', 'new_excerpt_more', 21 );
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

/* Add action */
add_action( 'admin_menu', 'add_theme_menu_item' );
add_action( 'after_setup_theme', 'custom_theme_custom_header_setup' );
add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action( 'after_setup_theme', 'customtheme_custom_logo_setup' );
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_scripts' );

?>
