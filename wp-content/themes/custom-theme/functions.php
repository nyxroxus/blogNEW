<?php
include('theme_settings_page.php');
/* Enqueue styles and scripts */
function custom_theme_enqueue_scripts(){
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( get_option("color_scheme"), get_template_directory_uri() . '/theme-color-scheme/'.get_option("color_scheme").'.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . 'js/custom.js', array(), '1.0.0', true );
  wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
  wp_enqueue_style('Font_Awesome');
}

/* Functions */
function custom_theme_custom_header_setup(){
  $args = array(
    'default-image'       =>  get_template_directory_uri() . 'images/default-header-image.jpg',
    'width'               =>  1000,
    'height'              =>  249,
    'header-text'         =>  true,
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

/* Add a new function for displaying different color when a different user
creates a post+ */
do_action('user_colors');
function define_user_colors(){
  if (the_author()  == 'gibanica'){ ?>
    <div class="fl dib mt3 pv1 w-20 tc br4 white bg-green">

    </div>
  <?php  }
  else if(the_author() == 'alisa'){ ?>
    <div class="fl dib mt3 pv1 w-20 tc br4 white bg-yellow">

    </div>
  <?php  }
  else if(the_author() == 'sexmashine'){ ?>
    <div class="fl dib mt3 pv1 w-20 tc br4 white bg-orange">

    </div>
  <?php  }
  else{
  }
}
add_action('user_colors', 'define_user_colors');
function new_excerpt_more($more) {
  return $more;
}
/* Here you can stylize how read more link would appear */
function the_excerpt_more_link( $excerpt ){
  $post = get_post();
  $excerpt .= '<div class="custom-excerpt-color custom-color br4 pa2 w-60 tc grow center pointer mt4 mb3"><a href="'. get_permalink($post->ID) . '" class="custom-excerpt-color" >Read more</a></div>';
  return $excerpt;

}



/* Add filters */
add_filter( 'excerpt_more', 'new_excerpt_more', 21 );
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

/* Add action */

add_action( 'after_setup_theme', 'custom_theme_custom_header_setup' );
add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action( 'after_setup_theme', 'customtheme_custom_logo_setup' );
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_scripts' );

?>
