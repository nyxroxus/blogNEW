<?php
/*
Plugin Name: Essential Visual Composer Addons
Plugin URI: https://themebon.com/items/visual-composer-shortcodes-pro/
Description: Bundled with super useful Visual Composer elements with bunch of options to achieve any design with all the power of Visual Composer page builder for free.
Author: themebon
Author URI: https://themebon.com/
License: GPLv2 or later
Text Domain: asvc
Version: 1.4.2
*/

// Don't load directly
if (!defined('ABSPATH')){die('-1');}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'js_composer/js_composer.php' ) ){
    
/* Constants */
define( 'ASVC_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'ASVC_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
if ( ! function_exists( 'prime_WordPressCheckup' ) ) {
    function prime_WordPressCheckup( $version = '3.8' ) {
        global $wp_version;
        if ( version_compare( $wp_version, $version, '>=' ) ) {
            return "true";
        } else {
            return "false";
        }
    }
}

// Admin Style CSS
function asvc_admin_enqeue() {
    
    wp_enqueue_style( 'asvc_admin_css', plugins_url( 'admin/admin.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'asvc_admin_enqeue' );


//params
require_once 'admin/params/index.php';



require_once( 'shortcodes/info-box/info-box.php' );
require_once( 'shortcodes/flip-box/flip-box.php' );
require_once( 'shortcodes/flip-box-two/flip-box-two.php' );
require_once( 'shortcodes/before-after/before-after.php' );
require_once( 'shortcodes/service-box/service-box.php' );
require_once( 'shortcodes/promo-box/promo-box.php' );
require_once( 'shortcodes/hover-effects/hover-effects.php' );
require_once( 'shortcodes/video-cover/video-cover.php' );
require_once( 'shortcodes/call-to-action/call-to-action.php' );
require_once( 'shortcodes/tooltip/tooltip.php' );
require_once( 'shortcodes/dropcaps/dropcaps.php' );
require_once( 'shortcodes/divider/divider.php' );
require_once( 'shortcodes/image-caption/image-caption.php' );
require_once( 'shortcodes/team/team.php' );
require_once( 'shortcodes/profile-card/profile-card.php' );
require_once( 'shortcodes/contact-info/contact-info.php' );
require_once( 'shortcodes/moving-image/moving-image.php' );
require_once( 'shortcodes/soundcloud/soundcloud.php' );
require_once( 'shortcodes/twitter_slider/twitter_slider.php' );
require_once( 'shortcodes/woo-slider/woo-slider.php' );
require_once( 'shortcodes/video-popup/video-popup.php' );
require_once( 'shortcodes/latest-posts-slider/latest-posts-slider.php' );
require_once( 'shortcodes/table/table.php' );
require_once( 'shortcodes/button-set/button-set.php' );
require_once( 'shortcodes/edd/edd.php' );
require_once( 'shortcodes/list-item/list-item.php' );
require_once( 'shortcodes/carousel-anything/carousel-anything.php' );
require_once( 'shortcodes/timeline/timeline.php' );
require_once( 'shortcodes/progressbar/progressbar.php' );
require_once( 'shortcodes/menu-card/menu-card.php' );
require_once( 'shortcodes/hotspot/hotspot.php' );



if (!class_exists('Amazing_Shortcodes_VC')) {
    class Amazing_Shortcodes_VC {
        public function __construct() {

            if(!function_exists('asvc_infobox_shortcode_function')) $asvc_infobox = new ASVC_InfoBox();
            if(!function_exists('asvc_flipbox_shortcode_function')) $asvc_flipbox = new ASVC_FlipBox();
            if(!function_exists('asvc_flipbox_two_shortcode_function')) $asvc_flipbox_two = new ASVC_FlipBox_Two();
            if(!function_exists('asvc_before_after_shortcode_function')) $asvc_before_after = new ASVC_BEFORE_AFTER();
            if(!function_exists('asvc_servicebox_shortcode_function')) $service_box = new ASVC_ServiceBox();
            if(!function_exists('asvc_promobox_shortcode_function')) $promo_box = new ASVC_PrmoBox();
            if(!function_exists('asvc_hover_effects')) $hover_effects = new ASVC_HoverEffects();
            if(!function_exists('asvc_video_cover')) $video_cover = new ASVC_Video_Cover();
            if(!function_exists('asvc_call_to_action')) $call_to_action = new ASVC_CallToAction();
            if(!function_exists('asvc_tooltip')) $tooltip = new ASVC_Tooltip();
            if(!function_exists('asvc_dropcaps')) $dropcaps = new ASVC_DropCaps();
            if(!function_exists('asvc_divider')) $divider = new ASVC_Divider();
            if(!function_exists('asvc_image_caption')) $image_caption = new ASVC_Image_Caption();
            if(!function_exists('asvc_team')) $team = new ASVC_Team();
            if(!function_exists('asvc_profile-card')) $profile_card = new ASVC_ProfileCard();
            if(!function_exists('asvc_contact_info')) $contact_info = new ASVC_ContactInfo();
            if(!function_exists('asvc_moving_image')) $moving_image = new ASVC_MovingImage();
            if(!function_exists('asvc_soundcloud')) $soundcloud = new ASVC_SoundCloud();
            if(!function_exists('asvc_twitter_slider')) $twitter_slider = new ASVC_TwitterSlider();
            if(!function_exists('asvc_woo_slider')) $woo_slider = new ASVC_WooSlider();
            if(!function_exists('asvc_video_popup')) $asvc_video_popup = new ASVC_VideoPopup();
            if(!function_exists('asvc_latest_posts_slider')) $asvc_latest_posts_slider = new ASVC_LatestPostsSlider();
            if(!function_exists('asvc_table')) $asvc_table = new ASVC_Table();
            if(!function_exists('asvc_button_set')) $asvc_button_set = new ASVC_ButtonSet();
            if(!function_exists('asvc_progressbar')) $asvc_progressbar = new ASVC_ProgressBar();                       
        }
    }
    function Amazing_Shortcodes_VC_init(){
        if(class_exists('Amazing_Shortcodes_VC')) $Amazing_Shortcodes_VC = new Amazing_Shortcodes_VC();
    }
    add_action('init', 'Amazing_Shortcodes_VC_init');
    }


    }
// Check If VC is activate
else {
    function asvc_required_plugin() {
        if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'js_composer/js_composer.php' ) ) {
            add_action( 'admin_notices', 'asvc_required_plugin_notice' );

            deactivate_plugins( plugin_basename( __FILE__ ) ); 

            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }

    }
add_action( 'admin_init', 'asvc_required_plugin' );

    function asvc_required_plugin_notice(){
        ?><div class="error"><p>Error! you need to install or activate the <a target="_blank" href="https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=themebonwp">Visual Composer</a> plugin to run "<span style="font-weight: bold;">Essential Visual Composer Addons</span>" plugin.</p></div><?php
    }
}
?>