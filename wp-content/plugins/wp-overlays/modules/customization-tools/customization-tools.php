<?php

$circleoverlayColor = array(
	'lable' => __( 'Image Hover Effect Overlay Color', WOP_TEXT_DOMAIN ),
	'id' => 'circle_overlay_color',
	'value' => '#999999',
	'desc' => __( 'Set color overlay color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'circle_overlay_color  circle_color_controls form-control',
);

$circle_border_color_one = array(
	'lable' => __( 'Circle Border Color First', WOP_TEXT_DOMAIN ),
	'id' => 'circle_border_color_one',
	'value' => '#ecab18',
	'desc' => __( 'Set circle first border color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'circle_border_color_one  circle_color_controls form-control'
);

$circle_border_color_two = array(
	'lable' => __( 'Circle Border Color Second', WOP_TEXT_DOMAIN ),
	'id' => 'circle_border_color_two',
	'value' => '#1ad280',
	'desc' => __( 'Set circle second border color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'circle_border_color_two  circle_color_controls form-control'
);

$circle_text_color = array(
	'lable' => __( 'Circle Text Color', WOP_TEXT_DOMAIN ),
	'id' => 'circle_text_color',
	'value' => '#ffffff',
	'desc' => __( 'Set circle text color.', WOP_TEXT_DOMAIN ),
	'class' => 'circle_text_color  circle_color_controls form-control'
);

$circle_size = array(
	'lable' => __( 'Circle Size', WOP_TEXT_DOMAIN ),
	'value' => $dbdata['circle_size'],
	'class' => 'circle_size circle_color_controls circle_slide_control',
	'id' => 'circle_size',
	'min' => '1',
	'max' => '1000',
	'default_value' => '220',
	'before' => '<div class="fc-8">',
	'after' => '</div>',
);

$circle_opacity = array(
	'lable' => __( 'Circle Opacity', WOP_TEXT_DOMAIN ),
	'value' => $dbdata['circle_opacity'],
	'class' => 'circle_opacity circle_color_controls circle_slide_control',
	'id' => 'circle_opacity',
	'min' => '1',
	'max' => '100',
	'default_value' => '50',
	'before' => '<div class="fc-8">',
	'after' => '</div>',
);

$circle_tools =  '';
$circle_tools .= FlipperCode_HTML_Markup::field_text('circle_border_color_one_control',$circle_border_color_one);
$circle_tools .= FlipperCode_HTML_Markup::field_text('circle_border_color_two_control',$circle_border_color_two);
$circle_tools .= FlipperCode_HTML_Markup::field_text('circle_overlay_bg_color',$circleoverlayColor);
$circle_tools .= FlipperCode_HTML_Markup::field_text('circle_text_color',$circle_text_color);
$circle_tools  .=   '<div class="fc-field-label">'.__('Set Size Of Circle From Here',WOP_TEXT_DOMAIN).'</div>';
$circle_tools .=  FlipperCode_HTML_Markup::field_radio_slider('circle_size',$circle_size);
$circle_tools  .=   '<div class="fc-field-label">'.__('Set Opacity Of Circle Background',WOP_TEXT_DOMAIN).'</div>';
$circle_tools .=  FlipperCode_HTML_Markup::field_radio_slider('circle_opacity',$circle_opacity);

$overlayColor = array(
	'lable' => __( 'Image Hover Effect Overlay Color', WOP_TEXT_DOMAIN ),
	'id' => 'overlay_color',
	'value' => '#999999',
	'class' => 'overlay_color',
);

$overlayTextColor = array(
	'lable' => __( 'Overlay Text Color', WOP_TEXT_DOMAIN ),
	'id' => 'text_color',
	'value' => '#ffffff',
	'class' => 'text_color',
);
		
$text_position = array(
'overlay_top_left' => __( 'Top Left',WOP_TEXT_DOMAIN ),
'overlay_top_right' => __( 'Top Right',WOP_TEXT_DOMAIN ),
'overlay_bottom_left' => __( 'Bottom Left',WOP_TEXT_DOMAIN ),
'overlay_bottom_right' => __( 'Bottom Right',WOP_TEXT_DOMAIN ),
'overlay_center' => __( 'Center',WOP_TEXT_DOMAIN ),
);

$slide_text_position = array(
	'current' => (isset( $dbdata['slide_text_position'] ) and ! empty( $dbdata['slide_text_position'] )) ? $dbdata['slide_text_position'] : '',
	'id' => 'slide_text_position',
	'lable' => __( 'Text position in the overlays.', WOP_TEXT_DOMAIN ),
	'desc' => __( 'Text position in the overlays.', WOP_TEXT_DOMAIN ),
	'options' => $text_position,
	'before' => '<div class="fc-8">',
	'after' => '</div>',
	'class' => 'default_imagehover_effects-child dependable',
	'default_value' => 'overlay_top_left',
	'select2' => 'false'
);

$radio_slider = array(
	'lable' => __( 'Animation Speed', WOP_TEXT_DOMAIN ),
	'value' => $dbdata['animation_speed'],
	'class' => 'chkbox_class default_imagehover_effects-child dependable',
	'id' => 'animation_speed',
	'min' => '1',
	'max' => '10',
	'default_value' => '8',
	'before' => '<div class="fc-8">',
	'after' => '</div>',
);

$overlay_width = array(
	'lable' => __( 'Hover Effect Width', WOP_TEXT_DOMAIN ),
	'value' => $dbdata['overlay_width'],
	'class' => 'chkbox_class default_imagehover_effects-child dependable',
	'id' => 'overlay_width',
	'min' => '1',
	'max' => '100',
	'default_value' => '100',
	'before' => '<div class="fc-8">',
	'after' => '</div>',
);

$overlay_height = array(
	'lable' => __( 'Hover Effect Height', WOP_TEXT_DOMAIN ),
	'value' => $dbdata['overlay_height'],
	'class' => 'chkbox_class default_imagehover_effects-child dependable',
	'id' => 'overlay_height',
	'min' => '1',
	'max' => '100',
	'default_value' => '100',
	'before' => '<div class="fc-8">',
	'after' => '</div>',
);

$opacity_value= array(
	'lable' => __( 'Opacity', WOP_TEXT_DOMAIN ),
	'value' => $dbdata['opacity_value'],
	'class' => 'chkbox_class default_imagehover_effects-child dependable',
	'id' => 'opacity_value',
	'min' => '1',
	'max' => '100',
	'default_value' => '50',
	'before' => '<div class="fc-8">',
	'after' => '</div>',
);

$tools_for_default_effect  =   '<div class="overlay_color_container"><div class="fc-field-label">'.__('Set Overlay Color From Here',WOP_TEXT_DOMAIN).'</div>';

$tools_for_default_effect .=   FlipperCode_HTML_Markup::field_text('overlay_color',$overlayColor).'</div>';

$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Overlay Text Color From Here',WOP_TEXT_DOMAIN).'</div>';

$tools_for_default_effect .=   FlipperCode_HTML_Markup::field_text('text_color',$overlayTextColor);

$gradient_color_one = array(
	'lable' => __( 'Set First Gradient Color', WOP_TEXT_DOMAIN ),
	'id' => 'gradient_color_one',
	'value' => '#999999',
	'class' => 'gradient_color   color form-control',
);

$gradient_color_two = array(
	'lable' => __( 'Set Second Gradient Color', WOP_TEXT_DOMAIN ),
	'id' => 'gradient_color_two',
	'value' => '#999999',
	'class' => 'gradient_color  color form-control',
);

$gradeint_directions = array('to bottom' => 'Top To Bottom','to top' => 'Bottom To Top','to left' => 'Right To Left','to right' => 'Left To Right');
$gradient_color_direction = array(
	'current' => (isset( $dbdata['gradient_color_direction'] ) and ! empty( $dbdata['gradient_color_direction'] )) ? $dbdata['gradient_color_direction'] : '',
	'id' => 'gradient_color_direction',
	'lable' => __( 'Gradient Direction', WOP_TEXT_DOMAIN ),
	'desc' => __( 'Gradient Direction', WOP_TEXT_DOMAIN ),
	'options' => $gradeint_directions,
	'before' => '<div class="fc-8">',
	'after' => '</div>',
	'class' => 'gradient_color_direction form-control',
	'default_value' => 'to bottom',
	'select2' => 'false'
);

$tools_for_default_effect  .=   '<div class="gradient_color_container" style="display:none;"><div class="fc-field-label">'.__('Set Gradient First Color',WOP_TEXT_DOMAIN).'</div>';

$tools_for_default_effect .=   FlipperCode_HTML_Markup::field_text('gradient_color_one',$gradient_color_one);
$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Gradient Second Color',WOP_TEXT_DOMAIN).'</div>';

$tools_for_default_effect .=   FlipperCode_HTML_Markup::field_text('gradient_color_two',$gradient_color_two);

$tools_for_default_effect  .=   '<div class="fc-field-label gradient-dir-lbl">'.__('Set Gradient Fading Direction',WOP_TEXT_DOMAIN).'</div>';

$tools_for_default_effect .=   FlipperCode_HTML_Markup::field_select('gradient_color_direction',$gradient_color_direction).'</div>';


$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Overlay Text Position From Here',WOP_TEXT_DOMAIN).'</div>';

$tools_for_default_effect .=  FlipperCode_HTML_Markup::field_select('slide_text_position',$slide_text_position);
$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Overlay Animation Speed From Here',WOP_TEXT_DOMAIN).'</div>';
$tools_for_default_effect .=  FlipperCode_HTML_Markup::field_radio_slider('animation_speed',$radio_slider);
$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Overlay Width From Here',WOP_TEXT_DOMAIN).'</div>';
$tools_for_default_effect .=  FlipperCode_HTML_Markup::field_radio_slider('overlay_width',$overlay_width);
$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Overlay Height From Here',WOP_TEXT_DOMAIN).'</div>';
$tools_for_default_effect .=  FlipperCode_HTML_Markup::field_radio_slider('overlay_height',$overlay_height);
$tools_for_default_effect  .=   '<div class="fc-field-label">'.__('Set Overlay Opacity From Here',WOP_TEXT_DOMAIN).'</div>';
$tools_for_default_effect .=  FlipperCode_HTML_Markup::field_radio_slider('opacity_value',$opacity_value);
				
//Square Image Hover Fields
$square_imagehover_tools = '';

$defaultcolor = '#1a4a72';
$bgColor = array(
	'lable' => __( 'Background Color', WOP_TEXT_DOMAIN ),
	'value' => $defaultcolor,
	'desc' => __( 'Set background color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'square_hover_bgcolor  color square-hover-tool form-control',
);

$square_imagehover_tools .=   FlipperCode_HTML_Markup::field_text('square_hover_bgcolor',$bgColor);

$heading_bg_default = '#0c2234';
$square_hover_headingbgcolor = array(
	'lable' => __( 'Heading Background Color', WOP_TEXT_DOMAIN ),
	'value' => $heading_bg_default,
	'id' => 'square_hover_headingbgcolor',
	'desc' => __( 'Set heading background color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'square_hover_headingbgcolor square-hover-tool color form-control',
);

$square_imagehover_tools .=   FlipperCode_HTML_Markup::field_text('square_hover_headingbgcolor',$square_hover_headingbgcolor);

$headingcolor = array(
	'lable' => __( 'Heading Color', WOP_TEXT_DOMAIN ),
	'value' => (false) ? $defaultcolor : '#fff',
	'desc' => __( 'Set heading color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'square_hover_headingcolor color square-hover-tool form-control',
);
$square_imagehover_tools .=   FlipperCode_HTML_Markup::field_text('square_hover_headingcolor',$headingcolor);
$descColor = array(
	'lable' => __( 'Description Color', WOP_TEXT_DOMAIN ),
	'value' => (false) ? $defaultcolor : '#fff',
	'desc' => __( 'Set description color from here.', WOP_TEXT_DOMAIN ),
	'class' => 'square_hover_desccolor  color square-hover-tool form-control',
);
$square_imagehover_tools .=   FlipperCode_HTML_Markup::field_text('square_hover_desccolor',$descColor);
?>
