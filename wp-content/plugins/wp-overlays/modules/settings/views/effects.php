<?php
/**
 * This class used to manage settings page in backend.
 * @author Flipper Code <hello@flippercode.com>
 * @version 2.0.0
 * @package Posts
 */


$dbdata = get_option( 'wp-ihep-settings' );
$form  = new WOP_FORM();
$form->set_header( __( 'Setup Image Hover Effects For Featured Images Of Post Types', WOP_TEXT_DOMAIN ), $response );

$single_preview = '';

$data = Image_Hover_Effects_Pro_Builder::get_post_data();

$effectClassName = array('Default_Image_Hover_Effects',
 'Class_Square_Image_Hover_Effects',
 'Ihover_Circular_Image_Hover_Effects',
 );

$defaultContent = $data['content'];

foreach($effectClassName as $key => $newMarkupClass) {
	
	if( class_exists($newMarkupClass) ) { 
		
		if($newMarkupClass == 'Default_Image_Hover_Effects'){
			
		   $data['content'] = '<a href='.$data['permalink'].'>'.$data['posttitle'].'</a><br><br><p>'.$data['content'].'</p>';	
		   $data['currenteffect'] = 'rollIn';
		   $data['in'] = 'rollIn';
		   $data['out'] = 'rollOut';
		   $data['hovereffecttype'] = 'default_imagehover_effects';
		   $data['color'] = "rgba(0,0,0,.5)"; 
		   $data['effect_type_label'] = 'Customizable Overlay Effect';
		   $data['is_backend'] = true;
		   $data['is_sample'] = true;
		   $data['is_gallery'] = true;
		   
	    }
		else if($newMarkupClass == 'Class_Scalable_Image_Hover_Effects'){
			
			$data['currenteffect'] = 'effect_marley';
			$data['hovereffecttype'] = 'scalable_imagehover_effects';
			$data['effect_type_label'] = 'Text Effect';
			$data['content'] = '<h2>'.$data['posttitle'].'</h2><p>'.$defaultContent.'</p>';
			$data['is_backend'] = true;
			$data['is_sample'] = true;
			$data['is_gallery'] = true;
			
		}
		else if($newMarkupClass == 'Class_Square_Image_Hover_Effects'){
			$data['currenteffect'] = 'colored effect1 left_and_right sc';
			$data['hovereffecttype'] = 'square-imagehover';
			$data['effect_type_label'] = 'Square Hover Effect';
			$data['content'] = $defaultContent;
			$data['is_backend'] = true;
			$data['is_sample'] = true;
			$data['is_gallery'] = true;
			
		}
		else if($newMarkupClass == 'Ihover_Circular_Image_Hover_Effects'){
			
		    $data['currenteffect'] = 'effect1';
		    $data['hovereffecttype'] = 'ihover-circular';
		    $data['effect_type_label'] = 'Circle Effect';
		    $data['content'] = '<h3>'.$data['posttitle'].'</h3><p>'.$defaultContent.'</p>';
		    $data['is_backend'] = true;
			$data['is_sample'] = true;
			$data['is_gallery'] = true;
		    
	    }
	    else if($newMarkupClass == 'Custom_Image_Magnifier'){
		    $data['currenteffect'] = 'basic_magnifier';
		    $data['hovereffecttype'] = 'image-magnifier';
		    $data['effect_type_label'] = 'Preview Effect';
		    $data['is_backend'] = true;
			$data['is_sample'] = true;
			$data['is_gallery'] = true;
	   }
	   
		$obj = new $newMarkupClass();
		
		if($key % 3 == 0 and $key != 0)
		$single_preview .='</div><div class="fc-divider wfip_effects_single_preview_listing">';
		$single_preview .= '<div class="fc-4 effect-container '.$data['hovereffecttype'].' effect-'.$data['currenteffect'].'">
		<div class="effect-preview">
		<div class="sample_number"> '.$data['effect_type_label'].'</div>';
		
		//echo '<pre>'; print_r($data);
		
		$single_preview .= $obj->get_hover_effect_markup($data);
		$single_preview .= '</div></div>';
		
		if($key == (count($effectClassName) - 1)){ //Create 1 Empty Columns 4 Right Markup. It runs for 1 time only.
			
		 $single_preview .= '<div class="fc-4 effect-container no-effect">
		 <div class="effect-preview"></div></div><div class="fc-4 effect-container no-effect">
		 <div class="effect-preview"></div></div>';		
		
		}
		
	}
		
}

$allEffects = '<div class="fc-divider wfip_effects_single_preview_listing">';
$allEffects .= $single_preview;
$allEffects .= '</div>';

$form->add_element( 'html', 'singleeffecthtml', array(
	'html' => $allEffects,
	'id' => 'singleeffecthtml',
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));

$allEffects = '';
$small_preview = '';
					 
foreach($effectClassName as $newMarkupClass) {
	
	if( class_exists($newMarkupClass) ) { 
		$obj = new $newMarkupClass();
		$small_preview .= $obj->get_all_preview();
		$small_preview .= '<div style="clear:both;" class="next-effect-range"></div>';
	}
		
}

$allEffects = '<div class="wfip_effects_listing">';
$allEffects .= '<div>'.$small_preview.'</div>';
$allEffects .= '</div>';

$form->add_element( 'html', 'effecthtml', array(
	'html' => $allEffects,
	'current' => (isset( $data['effecthtml'] ) and ! empty( $data['effecthtml'] )) ? $data['effecthtml'] : '',
	'desc' => __( 'Choose Hover Effect Type', WOP_TEXT_DOMAIN ),
	'options' => $hovereffecttype,
	'id' => 'effecthtml',
	'before' => '<div class="fc-12">',
	'after' => '</div>',
));


$form->render();
