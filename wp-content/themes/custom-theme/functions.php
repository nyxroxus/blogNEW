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
    if (! function_exists('slug_scripts_masonry') ) :
    if ( ! is_admin() ) :
    function slug_scripts_masonry() {
        wp_enqueue_script('masonry');
        wp_enqueue_style('masonry', get_template_directory_uri().'/css/');
    }
    add_action( 'wp_enqueue_scripts', 'slug_scripts_masonry' );
    endif; //! is_admin()
    endif; //! slug_scripts_masonry exists

    if ( ! function_exists( 'slug_masonry_init' )) :
function slug_masonry_init() { ?>
<script>
    //set the container that Masonry will be inside of in a var
    var container = document.querySelector('#masonry-loop');
    //create empty var msnry
    var msnry;
    // initialize Masonry after all images have loaded
    imagesLoaded( container, function() {
        msnry = new Masonry( container, {
            itemSelector: '.masonry-entry'
        });
    });
</script>
<?php }
//add to wp_footer
add_action( 'wp_footer', 'slug_masonry_init' );
endif; // ! slug_masonry_init exists

/*
function theme_options_page()
    {
      ?>
      <div class="wrap">
        <h1>Theme panel</h1>
        <form method="post" action="options.php">
            <?php
              settings_fields("section");
              do_settings_sections("theme-options");
              submit_button();
            ?>
        </form>
      </div>
      <?php
      function display_facebook_url()
      {
        ?>
        <input type="text" name="fb_url" id="facebook_url" value="<?php echo get_option("facebook_url")?>"/>
        <?php
      }
      function display_theme_panel_fields() {
        add_settings_section("section", "All settings", null, "theme-options");
        add_settings_field("facebook_url", "Facebook url" , "display_facebook_url" , "theme-options", "section");
        register_setting("section", "facebook_url");
      }
    }

add_action("admin_init", "display_theme_panel_fields");
*/
add_action( 'admin_menu', 'add_theme_menu_item' );
add_action( 'after_setup_theme', 'custom_theme_custom_header_setup' );
add_action( 'after_setup_theme', 'custom_theme_setup' );
add_action( 'after_setup_theme', 'customtheme_custom_logo_setup' );
add_action( 'wp_enqueue_scripts', 'custom_theme_enqueue_scripts' );

?>
