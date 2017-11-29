<?php
include('theme-options.php');
include('partials/customizer.php');
/* Enqueue scripts and styles section */
function pirollTheme_scripts() {
    wp_enqueue_style( 'main', get_template_directory_uri() . '/stylesheets/main.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main-js.js', array(), '1.0.0', true );
    wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
    wp_enqueue_style('Font_Awesome');
    wp_enqueue_style( 'custom-styles', get_template_directory_uri() . '/custom-styles.css' );
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
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => true,
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'piroll_custom_logo_setup' );

/* Theme support for main header image */
function piroll_header_image_setup(){
  $args = array(
    'default-image'       =>  get_template_directory_uri() . 'assets/default-header.jpg',
    'width'               =>  1920,
    'height'              =>  300,
    'header-text'         =>  true,
    'default-header-color'  => '',
    'flex-width'          =>  false,
    'flex-height'         =>  false,
  );
  add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'piroll_header_image_setup' );

/* Theme customizer register */
function piroll_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
}
add_action( 'customize_register', 'piroll_customize_register' );

/* Apply color change from customizer */
function piroll_customize_css(){
  ?>
   <style type="text/css">
       h1 { color: <?php echo get_theme_mod('header_textcolor'); ?>; }
   </style>
  <?php
}
add_action( 'wp_head', 'piroll_customize_css');

/* Theme support for thumbnail images */
function piroll_post_thumbnail_setup_theme() {
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 );
    add_image_size( 'small', 250, 250 );
    add_image_size( 'wordpress-thumbnail', 350, 300, TRUE );
    add_image_size( 'wordpress-post-large', 900, 500, TRUE );
}
add_action( 'after_setup_theme', 'piroll_post_thumbnail_setup_theme' );

/* Registering widget areas */
function piroll_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Company name and copyright text widget', 'piroll' ),
    'id' => 'first-footer-widget-area',
    'description' => __( 'The first footer widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title heading">',
    'after_title' => '</h3>',
  ) );
  register_sidebar( array(
    'name' => __( 'Contact phone and email widget', 'piroll' ),
    'id' => 'second-footer-widget-area',
    'description' => __( 'The second footer widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title heading" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Positive feedback image widget(recommended image size 64x64)', 'piroll' ),
    'id' => 'feedback-widget-image-area',
    'description' => __( 'Feedback widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Positive feedback text widget', 'piroll' ),
    'id' => 'feedback-widget-text-area',
    'description' => __( 'Feedback widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Client number count image widget(recommended image size 64x64) ', 'piroll' ),
    'id' => 'client-widget-image-area',
    'description' => __( 'Client count number widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Client number count text widget ', 'piroll' ),
    'id' => 'client-widget-text-area',
    'description' => __( 'Client count number widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Working hours widget image(recommended image size 64x64)', 'piroll' ),
    'id' => 'working-hours-widget-image-area',
    'description' => __( 'Working hours widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Working hours widget text', 'piroll' ),
    'id' => 'working-hours-widget-text-area',
    'description' => __( 'Working hours widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Projects completed widget image(recommended image size 64x64)', 'piroll' ),
    'id' => 'projects-widget-image-area',
    'description' => __( 'Projects widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
  register_sidebar( array(
    'name' => __( 'Projects widget Text', 'piroll' ),
    'id' => 'projects-widget-text-area',
    'description' => __( 'Projects widget area', 'piroll' ),
    'before_widget' => '<div id="%1$s" class="widget-container %2$s" class="" >',
    'after_widget' => '</div>',
    'before_title' => '<a class="widget-title neonblue" href="#">',
    'after_title' => '</a>',
  ) );
}
add_action( 'widgets_init', 'piroll_widgets_init' );

function generate_options_css() {
    $ss_dir = get_stylesheet_directory();
    ob_start(); // Capture all output into buffer
    require($ss_dir . '/custom-styles.php'); // Grab the custom-style.php file
    $css = ob_get_clean(); // Store output in a variable, then flush the buffer
    file_put_contents($ss_dir . '/custom-styles.css', $css, LOCK_EX); // Save it as a css file
}
add_action( 'acf/save_post', 'generate_options_css', 20 ); //Parse the output and write the CSS file on post save (thanks Esmail Ebrahimi)




?>
