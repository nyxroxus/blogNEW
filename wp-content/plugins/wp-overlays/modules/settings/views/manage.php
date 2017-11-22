<?php
/**
 * This class used to manage settings page in backend.
 * @author Flipper Code <hello@flippercode.com>
 * @version 2.0.0
 * @package WP OVERLAYS
 */
?>

<?php 

$data = get_option( 'wp-ihep-settings' );
if(!$data)
$data = unserialize($data);
$form  = new WOP_FORM();
$form->set_header( __( 'WP Overlays Display Settings', WOP_TEXT_DOMAIN ), $response );
$form->form_id = 'hovereffect-settings-form';

$i = 0;

if(array_key_exists('product',$data['post_type_wise_effects']))
$product = $data['post_type_wise_effects']['product'];

if($product and is_array($product)) {
	$productCpt = array('product' => $product);
	$data['post_type_wise_effects'] = $productCpt + $data['post_type_wise_effects']; 
}

$form->set_col( 1 );

$form->add_element( 'checkbox', 'show_on_pageload', array(
	'lable' => __( 'Display On Page Load', WTH_TEXT_DOMAIN ),
	'value' => 'true',
	'id' => 'show_on_pageload',
	'current' => isset( $data['show_on_pageload'] ) ? $data['show_on_pageload'] : '',
	'desc' => __( 'Display image hover effect on page load automatically without waiting for an event', WTH_TEXT_DOMAIN ),
	'class' => 'chkbox_class',
	'default_value' => 'false',
));

$form->add_element( 'checkbox', 'show_always', array(
	'lable' => __( 'Display Effect Always', WTH_TEXT_DOMAIN ),
	'value' => 'true',
	'id' => 'show_always',
	'current' => isset( $data['show_always'] ) ? $data['show_always'] : '',
	'desc' => __( 'Do Not Display Image Hover Exit Effect When User Takes Away Mouse Focus From Image', WTH_TEXT_DOMAIN ),
	'class' => 'chkbox_class',
	'default_value' => 'false',
));

$args = array(
			'public'  => true,
			'_builtin'  => false,
			);

$output = 'names';
$operator = 'and';
$custom_post_types = get_post_types( $args, $output, $operator );
$all_post_types = array( 'post');
foreach ( $all_post_types as $key => $post_type ) {
	
	$summary = '';
	
	if ( 'product' == $post_type ) {
		$placeholders = '{product_title}, {product_price}, {product_rating}, {product_sku}, {add_to_cart}, {product_categories}, {product_remaining}, {product_excerpt}, {variation_details}, {%custom_field_name%}';
	}else{ 
		$placeholders = '{post_title}, {post_link}, {post_excerpt}, {categories}, {tags}, {read_more} , {%custom_field_name%} ';
	}
	
	if($data['post_type_wise_effects'][$post_type]['enable_effect'] == 'yes') {
	 	
	  $effect = $data['post_type_wise_effects'][$post_type];
	  $samplepost = Image_Hover_Effects_Pro_Builder::get_post_data($post_type);
	  $post_id = $samplepost['postid'];
	  $overlay_content = $data['overlay_content'][ $post_type ];	
	  $overlay_content = WP_Overlays_Pro::overlay_render_content( $overlay_content, $post_id );
	  $postcontent = $samplepost['content'];	
	  
	  $design_wise_content = $data['overlay_content'][$post_type];
	  if($effect['hovereffecttype'] == 'default_imagehover_effects') {
		  
		  $default_effect_type = $effect['default_effect_type'];
		  $gradient_color_one = $effect['gradient_color_one'];
		  $gradient_color_one = $effect['gradient_color_one'];
		  $gradient_color_direction = $effect['gradient_color_direction'];
		  
		  $inEffect = $effect['slide_effect'];	  
		  $outEffect = $effect['slide_effect_exit'];
		  $overlay_color = $effect['overlay_color'];
		  $overlayWidth = $effect['overlay_width'];
		  $overlayHeight = 	$effect['overlay_height'];
		  $textPosition = $effect['slide_text_position'];
		  $opacity = $effect['opacity_value']/100;
		  $originalanimationspeed = $effect['animation_speed'];
		  $animationSpeed = (10 - $effect['animation_speed']);
		  
		  $overlayColor = get_post_meta($post_id,'featured-image-overlay-color',true);
		  $priorityOverlay = get_post_meta($post_id,'use_as_priority_overlay',true); 
		  $overlayColor = ($priorityOverlay == 'true') ?  $overlayColor : $overlay_color;
			 
		  if(!empty($overlayColor))
		  $overlay_color = $overlayColor;
		  $effect_for_current_post = $inEffect;	 
		  
		  $preview = do_shortcode( '[hovereffect hovereffecttype = '.$effect['hovereffecttype'].' src="'.$samplepost['image'].'" in='.$inEffect.'  out='.$outEffect.' speed='.$animationSpeed.' color='.$overlay_color.' opacity='.$opacity.' text_position='.$textPosition.' height='.$overlayHeight.' width='.$overlayWidth.'  post_id='.$post_id.' for_settings_page="yes"]'.stripslashes($overlay_content).'[/hovereffect]' );
		  
		  $default_effect_type = $effect['default_effect_type'];
		  $gradient_color_one = $effect['gradient_color_one'];
		  $gradient_color_two = $effect['gradient_color_two'];
		  $gradient_color_direction = $effect['gradient_color_direction'];
		  
		  $gradient_attr = '';
		  if($default_effect_type=='multi'){
			  
			  $gradient_attr = 'data-default-effect-type = "'.$default_effect_type.'" data-gradient-color-one="'.$gradient_color_one.'" data-gradient-color-two="'.$gradient_color_two.'" data-gradient-color-direction="'.$gradient_color_direction.'"';
			 
		  }
		  
		   
		  $preview .=  '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect from_setting_page fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" '.$gradient_attr.' data-overlay-type="'.$default_effect_type.'" data-for-post-type="'.$key.'" data-effect="'.$inEffect.'" data-slide_effect_exit="'.$outEffect.'" data-text-color = "'.$effect['text_color'].'" data-hovereffecttype="'.$effect['hovereffecttype'].'" data-slide_text_position="'.$textPosition.'" data-overlaywidth="'.$overlayWidth.'" data-overlayheight="'.$overlayHeight.'" data-opacity="'.$opacity.'" data-animationspeed="'.$originalanimationspeed.'" data-overlaycolor="'.$overlay_color.'" data-designwise-content="'.$design_wise_content.'">Customise This Effect<i></i></a></div>';
	 
	  }
	  else if($effect['hovereffecttype'] == 'ihover-circular'){
		  
		  $allinfo =  $effectinfo = unserialize($effect['effect']);
		  //echo '<pre>'; print_r($allinfo); exit;	
		  $effect_for_current_post = trim($effectinfo['effect']);
		  $effect['overlay_color'] = $effectinfo['overlay_color'];
		  $effect['border_color_one'] = $effectinfo['border_color_one'];
		  $effect['border_color_two'] = $effectinfo['border_color_two'];
		  $effect['text_color'] = $effectinfo['text_color'];
		  $effect['size'] = $effectinfo['size'];
		  $effect['opacity'] = $effectinfo['opacity'];
		  if($effect['opacity'] > 1)
		  $effect['opacity'] = ($effect['opacity']/100);
		  
		  $ptwc = $data['post_type_wise_effects'][$post_type];
		  $postobj = get_post($post_id);
		  $excerpt = get_the_excerpt($post_id);
		  if(empty($excerpt))
		  $excerpt = $postobj->post_content;
		  
		  if ($effect_for_current_post == 'effect1') { 
			$data_attr_border = 'data-overlay_color='.$effect['overlay_color'].' data-border_color_one = '.$effect['border_color_one'].' data-border_color_two = '.$effect['border_color_two'];
		  }else{
			$data_attr_border = ''; 	  
		  }
		  
		  $preview = do_shortcode( '[hovereffect hovereffecttype = '.$effect['hovereffecttype'].' color='.$effect['overlay_color'].' border_color_one="'.$effect['border_color_one'].'" border_color_two="'.$effect['border_color_two'].'" effect="'.$effect_for_current_post.'" src="'.$samplepost['image'].'"  post_id='.$post_id.' for_settings_page="yes" opacity='.$effect['opacity'].' text_color='.$effect['text_color'].']'.stripslashes($overlay_content).'[/hovereffect]' ); 
		  
		  $preview .=  '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect from_setting_page fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-for-post-type="'.$key.'" data-hovereffecttype="'.$effect['hovereffecttype'].'" '.$data_attr_border.' data-effect="'.$effect_for_current_post.'" data-designwise-content="'.$design_wise_content.'" data-opacity='.$effect['opacity'].' data-text-color='.$effect['text_color'].' data-size='.$effect['size'].'>Customise This Effect<i></i></a></div>';
		    
	  }
	  
	  else if($effect['hovereffecttype'] == 'square-imagehover'){
			  //'.stripslashes($overlay_content).'	
			  $allinfo =  $effectinfo = unserialize($effect['effect']);
			  $effect_for_current_post = $effectinfo['effect'];
			  $effect['overlay_color'] = $effectinfo['overlay_color'];
			  $effect['heading_color'] = $effectinfo['heading_color'];
			  $effect['heading_bg_color'] = $effectinfo['heading_bg_color'];
			  $effect['desc_color'] = $effectinfo['desc_color'];
			  $effect_for_current_post = $effectinfo['effect'];
			  $ptwc = $data['post_type_wise_effects'][$post_type];
			  $postobj = get_post($post_id);
			  $excerpt = get_the_excerpt($post_id);
			  if(empty($excerpt))
			  $excerpt = $postobj->post_content;
			  if (strpos($effectinfo['effect'], 'dc') !== false) {
				$innerContent = '<h3 style="color:'.$effect['heading_color'].';background-color:'.$effect['heading_bg_color'].';">'.$postobj->post_title.'</h3><p style="color:'.$effect['desc_color'].';">'.$excerpt.'</p>';
				$data_attr_headingbg = 'data-heading_bg_color='.$effect['heading_bg_color'];
		      }else{
				$innerContent = '<h3 style="color:'.$effect['heading_color'].';">'.$postobj->post_title.'</h3><p "color:'.$effect['desc_color'].'">'.$excerpt.'</p>';
				$data_attr_headingbg = ''; 	  
			  }
			  
			  $preview = do_shortcode( '[hovereffect hovereffecttype = '.$effect['hovereffecttype'].' color='.$effect['overlay_color'].' overlay_color='.$effect['overlay_color'].' heading_color='.$effect['heading_color'].' heading_bg_color='.$effect['heading_bg_color'].' desc_color='.$effect['desc_color'].' effect="'.$effect_for_current_post.'" src="'.$samplepost['image'].'"  post_id='.$post_id.' for_settings_page="yes"]'.$innerContent.'[/hovereffect]' ); 
			  
			  $preview .=  '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect from_setting_page fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-for-post-type="'.$key.'" data-hovereffecttype="'.$effect['hovereffecttype'].'" data-overlay_color = "'.$effect['overlay_color'].'" data-heading_color="'.$effect['heading_color'].'" '.$data_attr_headingbg.' data-desc_color="'.$effect['desc_color'].'" data-effect="'.$effect_for_current_post.'" data-designwise-content="'.$design_wise_content.'">Customise This Effect<i></i></a></div>';
		  
	  } 
	  else {
		
		  $allinfo =  $effectinfo = unserialize($effect['effect']);
		  $effect_for_current_post = $effectinfo['effect'];
		  $border_color_one = $effectinfo['border_color_one'];
		  $border_color_two = $effectinfo['border_color_two'];
		  if(!empty($effectinfo['overlay_color']))
		  $effect['overlay_color'] = $effectinfo['overlay_color'];
		    
		  $effect_for_current_post = $effect['effect'];	 
		  $preview = do_shortcode( '[hovereffect hovereffecttype = '.$effect['hovereffecttype'].' color='.$effect['overlay_color'].' border_color_one = "'.$border_color_one.'" border_color_two = '.$border_color_two.' effect="'.$effect_for_current_post.'" src="'.$samplepost['image'].'"  post_id='.$post_id.' for_settings_page="yes"]'.stripslashes($overlay_content).'[/hovereffect]' ); 
		  $preview .=  '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect from_setting_page fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-for-post-type="'.$key.'" data-hovereffecttype="'.$effect['hovereffecttype'].'" data-effect="'.$effect_for_current_post.'" data-designwise-content="'.$design_wise_content.'">Customise This Effect<i></i></a></div>';
		  
	  }

		$currentEffectFor = ($post_type == 'product') ?  __( 'Current Effect For Products', WOP_TEXT_DOMAIN ).' <img src="'.WOP_IMAGES.'woologo.png" class="logo_class">' : __('Current Hover Effect On ',WOP_TEXT_DOMAIN ).'<b>Blog Post Image</b>';
		$summary .= '<div class="fc-12 current-effect-container for-'.$post_type.' effect-'.$effect_for_current_post.'">
		<div class="effect-preview">
		<div class="effect_set_for" data-effect-set-for="'.$post_type.'">'.$currentEffectFor.'</div>';
		$summary .= $preview;
		$summary .= '<div class="links_holder"><a class="change_effect fc-btn fc-btn-medium fc-btn-blue" href="'.esc_url(admin_url('admin.php?page=ihep_effects_settings')).'" target="_blank">'.__('Change Effect',WOP_TEXT_DOMAIN).'</a></div>
		<div class="links_holder disable_effect_container"><a class="disable_effect fc-btn fc-btn-medium fc-btn-blue" data-remove-effect-for="'.$post_type.'" href="javascript:void(0);" >'.__('Remove Effect',WOP_TEXT_DOMAIN).'</a></div>
		<div class="ajax_loader"><img src="'.WOP_IMAGES.'loader.gif" width="50"></div></div></div>';
		
	}else{
		
		$summary .= '<div class="fc-12 current-effect-container for-'.$post_type.' no-effect"><div class="no-effect-set">'.__('No Effect Set For This Post Type',WOP_TEXT_DOMAIN).'</div>
		<div class="links_holder"><a class="change_effect fc-btn fc-btn-medium fc-btn-blue" href="'.esc_url(admin_url('admin.php?page=ihep_effects_settings')).'" target="_blank">'.__('Apply Effect',WOP_TEXT_DOMAIN).'</a>
		</div>';
		
	}
		
	
	$heading = __( 'WP Overlays Settings for Blog Post Featured Images',WOP_TEXT_DOMAIN );
	
	$form->add_element( 'group', sanitize_title( $post_type ).'_geotags_settings', array(
		'value' => $heading,
		'before' => '<div class="fc-12">',
		'after' => '</div>',
	));
	
	$show = ($effect['hovereffecttype'] != 'image-magnifier') ? 'true' : 'false';
	
	$apply_on = array(
	'post_listing' => __( 'Post Listing Page',WOP_TEXT_DOMAIN ),
	'single_post' => __( 'Single Post',WOP_TEXT_DOMAIN ),
	'archieves_page' => __( 'Archive Page',WOP_TEXT_DOMAIN ),
	);
	
	if($post_type == 'product')
	unset($apply_on['single_post']);

	$form->add_element( 'multiple_checkbox', 'apply_on['.$post_type.'][]', array(
		'lable' => __( 'Apply On', WOP_TEXT_DOMAIN ),
		'value' => $apply_on,
		'current' => $data['apply_on'][ $post_type ],
		'class' => 'chkbox_class ',
		'desc' => __( 'Please check to apply overlays on featured image in posts listing.', WOP_TEXT_DOMAIN ),
		'default_value' => '',
	));
	
	$form->add_element( 'html', 'current_hover_effects_summary_'.$post_type, array(
		'html' => $summary,
		'before' => '<div class="fc-4"><div class="post_type_wise_applied_effects">',
		'after' => '</div></div>',
		'lable' => __( 'Current Hover Effect', WOP_TEXT_DOMAIN )	
		
	));

}

$form->add_element( 'html', 'gap', array(
		'html' => '<br>',
));
	
$form->add_element( 'textarea', 'custom_ihep_css', array(
		'lable' => __( 'Custom CSS for frontend', WOP_TEXT_DOMAIN ),
		'value' => $data['custom_ihep_css'],
		'desc' => __('Custom CSS For Frontend',WOP_TEXT_DOMAIN),
		'textarea_rows' => 10,
		'textarea_name' => 'custom_ihep_css',
		'class' => 'form-control'
	));

$form->add_element( 'hidden', 'hidden_overlay_color', array(
	'value' => $data['overlay_color'],
));

$form->add_element( 'hidden', 'hidden_slide_text_position', array(
	'value' => $data['slide_text_position']
));

$form->add_element( 'hidden', 'hidden_animation_speed', array(
	'lable' => __( 'Animation Speed', WOP_TEXT_DOMAIN ),
	'value' => $data['animation_speed'],
));

$form->add_element( 'hidden', 'hidden_overlay_width', array(
	'lable' => __( 'Hover Effect Width', WOP_TEXT_DOMAIN ),
	'value' => $data['overlay_width'],
));

$form->add_element('submit','wop_save_settings',array(
	'value' => __( 'Save Settings',WOP_TEXT_DOMAIN ),
));

$form->add_element( 'hidden', 'hidden_overlay_height', array(
	'lable' => __( 'Hover Effect Height', WOP_TEXT_DOMAIN ),
	'value' => $data['overlay_height'],
));

$form->add_element( 'hidden', 'hidden_opacity_value', array(
	'lable' => __( 'Opacity', WOP_TEXT_DOMAIN ),
	'value' => $data['opacity_value']
));
$safe_string_to_store = base64_encode(serialize($data['overlay_content']));
$form->add_element( 'hidden', 'hidden_overlay_content', array(
	'lable' => __( 'Overlay Content', WOP_TEXT_DOMAIN ),
	'value' => $safe_string_to_store
));


$form->add_element('hidden','operation',array(
	'value' => 'save',
));


$form->add_element('hidden','operation',array(
	'value' => 'save',
));
$form->add_element('hidden','page_options',array(
	'value' => 'wop_api_key,wop_scripts_place',
));
$form->render();
