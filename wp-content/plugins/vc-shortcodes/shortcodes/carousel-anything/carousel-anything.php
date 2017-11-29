<?php 
if ( ! function_exists( 'asvc_content_carousel_shortcode_map' ) ) {
    function asvc_content_carousel_shortcode_map() {
        
        vc_map( 
            array(
                "name"					=> __( "Carousel Anything", "asvc" ),
                "description"			=> __( "Show your contents in carousel slider.", 'asvc' ),
                "base"					=> "asvc_vc_content_carousel",
                "as_parent" 			=> array( 'only' => 'vc_row' ),
                "js_view" 				=> 'VcColumnView',
                "category"				=> __( "VC Addons", "asvc" ),
                "icon"					=> "asvc_carousel_anything_icon",
                "params"				=> array(
                    array(
                        'type'			=> 'textfield',
                        'heading'		=> __( 'Extra Class', "asvc" ),
                        'param_name'	=> 'classes',
                        'value' 		=> '',
                    ),

                    // Slider
                    array(
                        "type"			=> "textfield",
                        "heading"		=> __( "Items to Display", "asvc" ),
                        "param_name"	=> "items",
                        'admin_label'	=> true,
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> "textfield",
                        "heading"		=> __( "Items to Scrollby", "asvc" ),
                        "param_name"	=> "items_scroll",
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        'type'			=> 'dropdown',
                        'heading'		=> __( "Auto Play", 'asvc' ),
                        'param_name'	=> "auto_play",
                        'admin_label'	=> true,
                        'value'			=> array(
                            __( 'True', 'asvc' )	=> 'true',
                            __( 'False', 'asvc' )	=> 'false',
                        ),
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        'type'			=> 'textfield',
                        'heading'		=> __( 'Timeout Duration (in milliseconds)', 'asvc' ),
                        'param_name'	=> "timeout_duration",
                        'value'			=> "5000",
                        'dependency'	=> array(
                            'element'	=> "auto_play",
                            'value'		=> 'true'
                        ),
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        'type'			=> 'dropdown',
                        'heading'		=> __( "Infinite Loop", 'asvc' ),
                        'param_name'	=> "infinite_loop",
                        'value'			=> array(
                            __( 'False', 'asvc' )	=> 'false',
                            __( 'True', 'asvc' )	=> 'true',
                        ),
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> "textfield",
                        "heading"		=> __( "Margin ( Items Spacing )", "asvc" ),
                        "param_name"	=> "margin",
                        'admin_label'	=> true,
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> "textfield",
                        "heading"		=> __( "Items To Display in Tablet", "asvc" ),
                        "param_name"	=> "items_tablet",
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> "textfield",
                        "heading"		=> __( "Items To Display In Mobile Landscape", "asvc" ),
                        "param_name"	=> "items_mobile_landscape",
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> "textfield",
                        "heading"		=> __( "Items To Display In Mobile Portrait", "asvc" ),
                        "param_name"	=> "items_mobile_portrait",
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> 'dropdown',
                        "heading"		=> __( "Navigation", "asvc" ),
                        "param_name"	=> "navigation",
                        "value"			=> array(
                            __( "Yes", "asvc" )	=> "true",
                            __( "No", "asvc" )	=> "false" ),
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                    array(
                        "type"			=> 'dropdown',
                        "heading"		=> __( "Pagination", "asvc" ),
                        "param_name"	=> "pagination",
                        "value"			=> array(
                            __( "Yes", "asvc" )	=> "true",
                            __( "No", "asvc" )	=> "false" ),
                        "group"			=> __( "Slider", "asvc" ),
                    ),
                ),
                'default_content' => '[vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/1"][/vc_column_inner][/vc_row_inner]',
            ) 
        );
    }
}
add_action( 'vc_before_init', 'asvc_content_carousel_shortcode_map' );

/**
 * We need to define this so that VC will show our nesting container correctly
 */
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Asvc_Vc_Content_Carousel extends WPBakeryShortCodesContainer {
    }
}

if ( ! function_exists( 'asvc_content_carousel_shortcode' ) ) {
    function asvc_content_carousel_shortcode( $atts, $content = NULL ) {
        
        extract( 
            shortcode_atts( 
                array(
                    'classes'					=> '',
                    'css_animation'				=> '',
                    'items'						=> '1',
                    'items_scroll' 				=> '1',
                    'auto_play'					=> 'true',
                    'timeout_duration'			=> '5000',
                    'infinite_loop' 			=> 'false',
                    'margin' 					=> '0',
                    'items_tablet'				=> '1',
                    'items_mobile_landscape'	=> '1',
                    'items_mobile_portrait'		=> '1',
                    'navigation' 				=> 'true',
                    'pagination' 				=> 'true',
                ), $atts 
            ) 
        );


        wp_register_style( 'asvc-font-awesome', plugins_url( '../info-box/css/font-awesome.min.css',  __FILE__) );
        wp_enqueue_style( 'asvc-font-awesome' );

        wp_register_style( 'asvc-owl-carousel-css', plugins_url( '/css/owl.carousel.css',  __FILE__) );
        wp_enqueue_style( 'asvc-owl-carousel-css' );
        
        wp_register_style( 'asvc-carousel-anything-css', plugins_url( '/css/carousel-anything.css',  __FILE__) );
        wp_enqueue_style( 'asvc-carousel-anything-css' );        
                
        
        wp_register_script('asvc-owl-carousel-js', plugins_url('../woo-slider/js/jquery.carousel.min.js', __FILE__), array('jquery'), '', false);
        wp_register_script('asvc-owl-carousel-custom-js', plugins_url('../woo-slider/js/jquery.carousel-custom.js', __FILE__), array('jquery'), '', false );

        wp_enqueue_script('asvc-owl-carousel-js');
        wp_enqueue_script('asvc-owl-carousel-custom-js');
        
        
        $output = '';
        static $carousel_id = 1;
        
        // Slider Configuration
        $data_attr = '';
        
        if( isset( $items ) && $items != '' ) {
            $data_attr .= ' data-items="' . $items . '" ';
        }
        
        if( isset( $items_scroll ) && $items_scroll != '' ) {
            $data_attr .= ' data-slideby="' . $items_scroll . '" ';
        }
        
        if( isset( $items_tablet ) && $items_tablet != '' ) {
            $data_attr .= ' data-items-tablet="' . $items_tablet . '" ';
        }
        
        if( isset( $items_mobile_landscape ) && $items_mobile_landscape != '' ) {
            $data_attr .= ' data-items-mobile-landscape="' . $items_mobile_landscape . '" ';
        }
        
        if( isset( $items_mobile_portrait ) && $items_mobile_portrait != '' ) {
            $data_attr .= ' data-items-mobile-portrait="' . $items_mobile_portrait . '" ';
        }
        
        if( isset( $margin ) && $margin != '' ) {
            $data_attr .= ' data-margin="' . $margin . '" ';
        }
        
        if( isset( $auto_play ) && $auto_play != '' ) {
            $data_attr .= ' data-autoplay="' . $auto_play . '" ';
        }
        if( isset( $timeout_duration ) && $timeout_duration != '' ) {
            $data_attr .= ' data-autoplay-timeout="' . $timeout_duration . '" ';
        }
        
        if( isset( $infinite_loop ) && $infinite_loop != '' ) {
            $data_attr .= ' data-loop="' . $infinite_loop . '" ';
        }
        
        if( isset( $pagination ) && $pagination != '' ) {
            $data_attr .= ' data-pagination="' . $pagination . '" ';
        }
        if( isset( $navigation ) && $navigation != '' ) {
            $data_attr .= ' data-navigation="' . $navigation . '" ';
        }
        
        // Classes
        $main_classes = '';	
        
        $output = '<div class="asvc-content-carousel-wrapper'.$main_classes.'">';
        $output .= '<div id="asvc-content-carousel'.$carousel_id.'" class="asvc-owl-carousel owl-carousel content-carousel-slider"'.$data_attr.'>';
            $output .= do_shortcode( wpb_js_remove_wpautop( $content, true ) );
        $output .= '</div>';
        $output .= '</div>';
        
        $carousel_id++;
        
        return $output;
    }
}
add_shortcode( 'asvc_vc_content_carousel', 'asvc_content_carousel_shortcode' );