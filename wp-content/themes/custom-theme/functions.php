<?php
include('theme_settings_page.php');
/* Enqueue styles and scripts */
function custom_theme_enqueue_scripts(){
  wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( get_option("color_scheme"), get_template_directory_uri() . '/theme-color-scheme/'.get_option("color_scheme").'.css', array(), '1.0.0', 'all' );
  wp_enqueue_style( get_option("select_font"), get_template_directory_uri() . '/fonts/'.get_option("select_font").'.css', array(), '1.0.0', 'all' );
  wp_enqueue_script( 'customjs', get_template_directory_uri() . 'js/custom.js', array(), '1.0.0', true );
  wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
  wp_enqueue_style('Font_Awesome');
}

function SearchFilter($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','SearchFilter');

/* Functions */
function custom_theme_custom_header_setup(){
  $args = array(
    'default-image'       =>  get_template_directory_uri() . 'images/default-header-image.jpg',
    'width'               =>  1920,
    'height'              =>  350,
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

function new_excerpt_more($more) {
  return $more;
}
/* Here you can stylize how read more link would appear */
function the_excerpt_more_link( $excerpt ){
  $post = get_post();
  $excerpt .= '<div class="default fap bap cah wt br4 pa2 w-60 tc grow center pointer mt4 mb3"><a href="'. get_permalink($post->ID) . '" class="" >Read more</a></div>';
  return $excerpt;

}
function load_jquery_ui() {
    wp_enqueue_script('jquery-ui-core');
}
function wpbeginner_remove_comment_url($arg) {
    $arg['url'] = '';
    return $arg;
}
function wpb_move_comment_field_to_bottom( $fields ) {
  $comment_field = $fields['comment'];
  unset( $fields['comment'] );
  $fields['comment'] = $comment_field;
  return $fields;
  }
function my_color_picker() {
  wp_enqueue_script( 'iris',get_template_directory_uri().'/js/iris.min.js' );
  wp_enqueue_script( 'iris-init',get_template_directory_uri().'/js/iris-init.js' );
  }
  function wpsites_modify_comment_form_text_area($arg) {
      $arg['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Your Feedback Is Appreciated', 'noun' ) . '</label><br><br /><textarea id="comment" style="max-width:400px; min-height:200px; min-width:400px; max-height:200px; height:200px;" name="comment" cols="45" rows="1" aria-required="true"></textarea></p>';
      return $arg;
  }
  if ( function_exists( 'add_theme_support' ) ) {
      add_theme_support( 'post-thumbnails' );

      set_post_thumbnail_size(  ); // default Featured Image dimensions (cropped)
      // Add featured image sizes
      add_image_size( 'featured-large', 1040, 500, true ); // width, height, crop
      add_image_size( 'featured-small', 340, 190, true );
      add_image_size( 'category-header', 1040, 500 );
      // Add other useful image sizes for use through Add Media modal
      add_image_size( 'medium-width', 480 );
      add_image_size( 'medium-height', 9999, 480 );
      add_image_size( 'medium-something', 480, 480 );

      // Register the three useful image sizes for use in Add Media modal
      add_filter( 'image_size_names_choose', 'wpshout_custom_sizes' );

   }

   function wpshout_custom_sizes( $sizes ) {
       return array_merge( $sizes, array(
           'medium-width' => __( 'Medium Width' ),
           'medium-height' => __( 'Medium Height' ),
           'medium-something' => __( 'Medium Something' ),
       ) );
   }
add_theme_support( 'post-thumbnails' );

add_filter('comment_form_defaults', 'wpsites_modify_comment_form_text_area');
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );
add_filter('comment_form_default_fields', 'wpbeginner_remove_comment_url');


add_action( 'admin_enqueue_scripts', 'my_color_picker' );
add_action('wp_enqueue_scripts', 'load_jquery_ui');
/* Add filters */
add_filter( 'excerpt_more', 'new_excerpt_more', 21 );
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

/* Add action */

add_action( 'after_setup_theme', 'custom_theme_custom_header_setup' );
add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action( 'after_setup_theme', 'customtheme_custom_logo_setup' );
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_scripts' );

?>
