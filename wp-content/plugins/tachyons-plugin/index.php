<?php
/*
Plugin Name: Tachyons-CSS-Tiny
Description: Enqueues Tachyons CSS Framework
Plugin URI: https://github.com/DakotaLMartinez/wp-tachyons
Author: Dakota Lee Martinez
Author URI: http://github.com/DakotaLMartinez
Version: 1.0
License: GPL2
Text Domain: dlm
Domain Path: Domain Path
*/
function load_tachyons_styles() {
	wp_register_style( 'tachyons-css', plugin_dir_url(__FILE__) . 'css/tachyons.min.css');
	wp_enqueue_style('tachyons-css');
}
add_action( 'wp_enqueue_scripts', 'load_tachyons_styles');
 ?>
