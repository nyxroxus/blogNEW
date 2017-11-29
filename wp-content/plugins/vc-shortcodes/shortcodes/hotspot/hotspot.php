<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once ('hotspot_param.php');


class WPBakeryShortCode_asvc_Hotspot extends WPBakeryShortCode {}

vc_map(
    array(
       'name' => esc_html__('Image Hotspot','asvc'),
       'base' => 'asvc_hotspot',
       'class' => '',
       'icon'    => 'asvc_hotspot_icon',
       'admin_enqueue_js' => array( plugins_url( '/admin/jquery.hotspot.js', __FILE__ )),
       'admin_enqueue_css' => array( plugins_url( '/admin/hotspot.css', __FILE__ )),
       "category" =>array( esc_attr__('VC Addons', 'asvc'),esc_attr__('Content', 'asvc')),
       'description' => esc_html__('Display single image with markers and tooltips','asvc'),
       'params' => array(
            array(
                'type'                => 'attach_image',
                'param_name'        => 'image',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Select image from media library', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Image', 'asvc'),
                'edit_field_class'    => 'vc_column vc_col-sm-12',
            ),
            array(
                'type'                => 'asvc_hotspot_param',
                'heading'            => '',
                'param_name'        => 'hotspot_data',
                'edit_field_class'    => 'vc_column vc_col-sm-12',
            ),
            array(
                'type'                => 'dropdown',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Define the action at which the hotspot tooltip will be displayed on.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Tooltips display', 'asvc'),
                'param_name'        => 'hotspot_action',
                'edit_field_class'    => 'vc_column vc_col-sm-12',
                'default'                => 'hover',
                'value'            => array(
                    
                    esc_html__('On Hover','asvc')    => 'hover',
                    esc_html__('Allways','asvc')     => 'allways',
                    esc_html__('On Click','asvc')    => 'click',
                ),
            ),
            array(
                'type'                => 'textfield',
                'heading'            => esc_html__('Custom CSS Class', 'asvc'),
                'param_name'        => 'el_class',
            ),
            array(
                'type'                => 'dropdown',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Select marker style. You can leave default style or upload your own image.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Marker style', 'asvc'),
                'param_name'        => 'marker_style',
                'default'                => 'default',
                'value'            => array(
                    esc_html__('Default', 'asvc')            => 'default',
                    esc_html__('Image', 'asvc')            => 'image',
                ),
                'group'                => esc_html__('Markers settings', 'asvc'),
            ),
            array(
                'type'                => 'colorpicker',
                'param_name'        => 'marker_bg',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Change the background of hotspot markers.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Marker background', 'asvc'),
                'edit_field_class'    => 'vc_column vc_col-sm-6',
                'value'                => '#ff3368',
                'dependency'        => array('element' => 'marker_style', 'value_not_equal_to' => 'image'),
                'group'                => esc_html__('Markers settings', 'asvc'),
            ),
            array(
                'type'                => 'colorpicker',
                'param_name'        => 'marker_inner_bg',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Change the background of the hotspot marker inner dot', 'asvc').'" data-balloon-pos="left"><span></span></span>'.esc_html__('Marker inner background', 'asvc'),
                'edit_field_class'    => 'vc_column vc_col-sm-6',
                'value'                => '#ffffff',
                'dependency'        => array('element' => 'marker_style', 'value_not_equal_to' => 'image'),
                'group'                => esc_html__('Markers settings', 'asvc'),
            ),
            array(
                'type'                => 'attach_image',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Choose the image to use as marker.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Image', 'asvc'),
                'param_name'        => 'marker_image',
                'dependency'        => array('element' => 'marker_style', 'value' => 'image'),
                'edit_field_class'    => 'vc_column vc_col-sm-12',
                'group'                => esc_html__('Markers settings', 'asvc'),
            ),
            array(
                'type'                => 'dropdown',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Select the tooltip position relative to the marker.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Tooltip position', 'asvc'),
                'param_name'        => 'tooltip_position',
                'default'                => 'top',
                'value'            => array(
                    esc_html__('Top', 'asvc')            => 'top',
                    esc_html__('Bottom', 'asvc')            => 'bottom',
                    esc_html__('Left', 'asvc')            => 'left',
                    esc_html__('Right', 'asvc')            => 'right',
                    esc_html__('Top Left', 'asvc')        => 'top-left',
                    esc_html__('Top Right', 'asvc')        => 'top-right',
                    esc_html__('Bottom Left', 'asvc')    => 'bottom-left',
                    esc_html__('Bottom Right', 'asvc')    => 'bottom-right',
                ),
                'group'                => esc_html__('Tooltips settings', 'asvc'),
                'edit_field_class'    => 'vc_column vc_col-sm-12',
            ),
            array(
                'type'                => 'dropdown',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Set the tooltip text alignment.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Tooltip content alignment', 'asvc'),
                'param_name'        => 'tooltip_content_align',
                'default'                => 'left',
                'value'            => array(
                    esc_html__('Left', 'asvc')            => 'left',
                    esc_html__('Right', 'asvc')            => 'right',
                    esc_html__('Center', 'asvc')            => 'center',
                ),
                'group'                => esc_html__('Tooltips settings', 'asvc'),
                'edit_field_class'    => 'vc_column vc_col-sm-6',
            ),
            array(
                'type'                => 'prime_slider',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Set the minimal width of item tooltip.', 'asvc').'" data-balloon-pos="left"><span></span></span>'.esc_html__('Tooltip min width', 'asvc'),
                'param_name'        => 'tooltip_width',
                "value" => 300,
                "min" => 100,
                "max" => 500,
                "step" => 1,
                "unit" => "px",
                'edit_field_class'    => 'vc_column vc_col-sm-6',
                'group'                => esc_html__('Tooltips settings', 'asvc'),
            ),
            array(
                'type'                => 'colorpicker',
                'param_name'        => 'tooltip_bg_color',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Choose the color for the tooltip\'s background. The default value is #fff.', 'asvc').'" data-balloon-pos="right"><span></span></span>'.esc_html__('Tooltip Background Color', 'asvc'),
                'default'            => '#fff',
                'edit_field_class'    => 'vc_column vc_col-sm-6',
                'group'                => esc_html__('Tooltips settings', 'asvc'),
            ),
            array(
                'type'                => 'colorpicker',
                'param_name'        => 'tooltip_text_color',
                'heading'            => '<span class="asvc-vc-tip" data-balloon-length="medium" data-balloon="'.esc_html__('Choose the color for the tooltip\'s text. The default value is #555.', 'asvc').'" data-balloon-pos="left"><span></span></span>'.esc_html__('Tooltip Text Color', 'asvc'),
                'default'            => '#555',
                'edit_field_class'    => 'vc_column vc_col-sm-6',
                'group'                => esc_html__('Tooltips settings', 'asvc'),
            )
        ),
    )
);


add_shortcode('asvc_hotspot', 'asvc_hotspot_shortcode');

function asvc_hotspot_shortcode( $atts, $content = null ) {
    
    $atts = vc_map_get_attributes( 'asvc_hotspot', $atts );
        extract( $atts );
        
$output = $id = $el_class = $custom_el_css = $data_atts = '';        
        
if(isset($image) && !empty($image)) {
    
    $id = uniqid('asvc-hotspoted-image');
    
    
        wp_enqueue_style('asvc-hotspot', plugins_url( '/css/hotspot.css',  __FILE__));


        wp_register_script('asvc-hotspot-js', plugins_url('/js/jquery.hotspot.js', __FILE__), array('jquery'), '', true );

        wp_enqueue_script('asvc-hotspot-js');    
        
        wp_register_script('asvc-hotspot-active', plugins_url('/js/active.js', __FILE__), array('jquery'), '', true );

        wp_enqueue_script('asvc-hotspot-active');            


    /*Data attributes*/
    if(!empty($module_animation)) {
        $data_atts .= ' data-animate="1"  data-animate-type="'.esc_attr($module_animation).'" ';
    }
    
    if(!empty($hotspot_data)) {
        $data_atts .= ' data-hotspot-content="'.esc_attr($hotspot_data).'" ';
    }
    
    if(!empty($hotspot_action)) {
        $el_class .= ' asvc-action-'.$hotspot_action;
        $data_atts .= ' data-action="'.esc_attr($hotspot_action).'" ';
    }
    $custom_el_css = '<div class="bruno-custom-inline-css">';
    
    /*Marker CSS*/
    
    if(isset($marker_style) && $marker_style == 'image' && isset($marker_image) && !empty($marker_image)) {
        $data_atts .= ' data-hotspot-class="HotspotPlugin_Hotspot asvcHotspotImageMarker" ';
        $marker_img_src = wp_get_attachment_image_src($marker_image, 'full');
        $custom_el_css .= '<style>#'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot.asvcHotspotImageMarker {'
                            . 'width: '.esc_js($marker_img_src[1]).'px;'
                            . 'height: '.esc_js($marker_img_src[2]).'px;'
                            . 'margin-left: -'.esc_js($marker_img_src[1] / 2).'px;'
                            . 'margin-top: -'.esc_js($marker_img_src[2] / 2).'px;'
                            . 'background-image: url('.esc_url($marker_img_src[0]).');'
                    . '}</style>';
    }
    
    /*Tooltip class*/
    if(isset($tooltip_position) && !empty($tooltip_position)) {
        $el_class .= ' asvc-tooltip-position-'.$tooltip_position;
    }
    
    if(isset($tooltip_content_align) && !empty($tooltip_content_align)) {
        $el_class .= ' asvc-tooltip-text-align-'.$tooltip_content_align;
    }
    
    /*Dynamic css*/
    if(isset($tooltip_width) && $tooltip_width != '') {
        $custom_el_css .= '<style>#'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot > div { min-width: '.esc_js($tooltip_width).'px;}</style>';
    }
    
    if(isset($tooltip_bg_color) && $tooltip_bg_color != '') {
        $custom_el_css .= '<style>#'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot > div { background: '.esc_js($tooltip_bg_color).';}</style>';
    }
    if(isset($tooltip_text_color) && $tooltip_text_color != '') {
        $custom_el_css .= '<style>#'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot > div, #'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot > div > .Hotspot_Title, #'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot > div > .Hotspot_Message { color: '.esc_js($tooltip_text_color).';}</style>';
    }
    if(isset($marker_bg) && $marker_bg != '') {
        $custom_el_css .= '<style>#'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot:not(.asvcHotspotImageMarker):before { background: '.esc_js($marker_bg).';}</style>';
    }
    
    if(isset($marker_inner_bg) && $marker_inner_bg != '') {
        $custom_el_css .= '<style>#'.esc_js($id).' .asvc-hotspot-wrapper .HotspotPlugin_Hotspot:not(.asvcHotspotImageMarker):after { background: '.esc_js($marker_inner_bg).';}</style>';
    }
    $custom_el_css .= '</div>';
    
    
    
    $img_src = wp_get_attachment_image_src($image, 'full');
    
    

    $img_html = '<img src="'.esc_attr($img_src[0]).'" width="'.esc_attr($img_src[1]).'" height="'.esc_attr($img_src[2]).'"/>';
    
    $output .='<h3>This addon for pro version. Please buy <a href="https://themebon.com/items/visual-composer-shortcodes-pro/">pro version from here</a></h3>';
    
}

return $output;

}