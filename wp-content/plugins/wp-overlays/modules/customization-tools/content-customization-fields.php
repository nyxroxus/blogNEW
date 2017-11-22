<?php
$pt = '';

$all_post_types = array( 'post');
foreach($all_post_types as $post_type) {
	
	$pt .= '<input type="radio" class="for_post_type" name="for_post_type" value="'.$post_type.'" />&nbspFor '.ucwords($post_type);
	$ptcontent = __('Select from the below post types for which you want to apply this effect',WOP_TEXT_DOMAIN);
}

if($_GET['page']=='ihep_effects_settings' and isset($_GET['term']) and !empty($_GET['term'])){
	
$pt = '<input type="hidden" name="effect_for_category" id="effect_for_category" data-term-id="'.$_GET['term'].'" data-term-name="'.$_GET['name'].'"/>';
	$ptcontent = __('Setup Hover Effect For The Category "'.$_GET['name'].'"',WOP_TEXT_DOMAIN);
}

$default_data =  FlipperCode_HTML_Markup::field_message('ptw_default_content_msg',array('id' => 'ptw_default_content_msg',
'value' => __( 'Recommended HTML Markup & Content According To Current Effect', WOP_TEXT_DOMAIN ),
));

$default_data .=  FlipperCode_HTML_Markup::field_textarea('ptw_default_content',array('id' => 'ptw_default_content',
'lable' => __( 'Recommended Markup & Content', WOP_TEXT_DOMAIN ),
'value' => '',
'desc' => __( 'Please update placeholders only or customize content, do not change tags. For help click <a href="'.admin_url('admin.php?page=ihep_how_overview').'" target="_blank" >Here</a> to see recommended html section and to know what html markup will display best with this effect.', WOP_TEXT_DOMAIN ),
'style' => array('width'=>'100%','margin-top'=>'10px','margin-bottom'=>'10px'),
'textarea_name' => 'ptw_default_content_textarea',
'rows' => 3
));

$default_data .=  FlipperCode_HTML_Markup::field_message('current_effect_shortcode_desc',array('id' => 'current_effect_shortcode_desc',
'value' => __('You can also achieve above effect on custom image by using below shortcode :',WOP_TEXT_DOMAIN),
'style' => array('width'=>'100%','margin-top'=>'10px','margin-bottom'=>'10px'),
));
$default_data .=  FlipperCode_HTML_Markup::field_message('current_effect_shortcode',array('id' => 'current_effect_shortcode',
'value' => '',
'style' => array('width'=>'100%','margin-top'=>'10px','margin-bottom'=>'10px'),
));

$default_data .=  FlipperCode_HTML_Markup::field_button('get_default_markup',array('id' => 'get_default_markup',
'value' => __('Reset Content',WOP_TEXT_DOMAIN),
'class' => 'get_default_markup fc-btn-orange',
'data' => array('hovereffect' => '')
));


