<?php

/***************************************************************
| Package           : Image Hover Effects Pro
| Class Description : Set One Hover Effect Class
| Author            : flippercode
****************************************************************/   

class Default_Image_Hover_Effects extends Image_Hover_Effects_Pro_Builder{
	 
	 public $effect_array = array();
     public $effect_array_exit = array();
     
	 public function __construct($received) {  
		  
		$this->imageHoverType = 'default_imagehover_effects';  
		$this->current_effect = 'rollIn';
		$this->current_effect_exit = 'rollOut';
		parent::__construct($received); 
		if($this->includestyle){
		   wp_enqueue_style( 'custom-overlay',WOP_CSS.'overlaypro.css');
	    }
		
		$this->effect_array = array( __( 'Attention Seekers','op_lang' ) => array( 'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble' ),
		__( 'Bouncing','op_lang' ) => array( 'bounceIn', 'bounceInDown', 'bounceInLeft', 'bounceInRight', 'bounceInUp' ),
		__( 'Fading','op_lang' ) => array( 'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig' ),
		__( 'Flippers','op_lang' ) => array( 'flip', 'flipInX', 'flipInY' ),
		__( 'Lightspeed','op_lang' ) => array( 'lightSpeedIn' ),
		__( 'Rotating','op_lang' ) => array( 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight' ),
		__( 'Specials','op_lang' ) => array( 'rollIn' ),
		__( 'Zoom','op_lang' ) => array( 'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp' ),
		);

		$this->effect_array_exit = array(__( 'Attention Seekers','op_lang' ) => array( 'fadeOut', 'fadeOut', 'fadeOut', 'fadeOut', 'fadeOut', 'fadeOut', 'fadeOut', 'fadeOut' ),
		__( 'Bouncing','op_lang' ) => array( 'bounceOut', 'bounceOutDown','bounceOutLeft', 'bounceOutRight', 'bounceOutUp' ),
		__( 'Fading','op_lang' ) => array( 'fadeOut', 'fadeOutDown', 'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig', 'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig' ),
		__( 'Flippers','op_lang' ) => array( 'fadeOut','flipOutX', 'flipOutY' ),
		__( 'Lightspeed','op_lang' ) => array( 'lightSpeedOut' ),
		__( 'Rotating','op_lang' ) => array( 'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight', 'rotateOutUpLeft', 'rotateOutUpRight' ),
		__( 'Specials','op_lang' ) => array( 'rollOut' ),
		__( 'Zoom','op_lang' ) => array( 'zoomOut', 'zoomOutDown', 'zoomOutLeft', 'zoomOutRight', 'zoomOutUp' ),
		);
	
	 }
	 
	 public function get_all_preview($config) {
		
		$data = $this->get_post_data();
		
		//if(isset($config['via-media-uploader'])) {
		  $data['via-media-uploader'] = 'yes';
		  $data['color'] = 'rgba(0,0,0,0.8)';
		  $data['speed'] = '1';
		  $data['opacity'] = '0.80';
	    //}
		
		$small_preview = '<div class="effects-container default_imagehover_effects"><div class="fc-divider">';
		
		$final_effect_array = array();
		
		foreach ( $this->effect_array as $opt_label => $values ) {
			
			foreach ( $values as  $key => $value ) {
				 $final_effect_array[] = $value;
			 }
		}
		
		foreach ( $this->effect_array_exit as $opt_label => $values ) {
			
			foreach ( $values as  $key => $value ) {
				 $final_effect_array_exit[] = $value;
			 }
		}
		
		$count = 0;
		
		foreach($final_effect_array as $key => $effect) {
			
			if($this->dbsettings['hovereffecttype'] == 'default_imagehover_effects')
			$currentEffect = ($this->dbsettings['slide_effect'] == $effect) ? '<div class="current_effect">Current E</div>' : '';
		
			$data['in'] = $effect;
			$data['out'] = $final_effect_array_exit[$key];
			$preview = $this->get_hover_effect_markup($data);
			$effectInfo ='<div class="effectinfo"><div class="effectname">'.ucfirst($effect).'</div></div>'; 
			
			if($count != 0 and $count % 4 == 0)
			$small_preview .= '</div><div class="fc-divider">';
			
			$small_preview .= '<div class="fc-3">'.$currentEffect.'<div class="effect-information" data-hovereffecttype="default_imagehover_effects" data-effect="'.$data['in'].'" data-slide_effect_exit = "'.$data['out'].'">'.$preview.'</div></div>';	
			
			$count++;
			
		}
		
		$small_preview .= '</div></div>';
		
		return $small_preview;
	 }
	 
	 public function get_hover_effect_markup_backend($data) {
		 
		 $image = '<img src="'.$data['image'].'" class="'.$data['class'].'" />';
		 $gradient_effect_data_attr = '';
		 if($data['default_effect_type'] == 'multi') {
				$gradient_effect_data_attr = 'data-gradient-color-one="'.$data['gradient_color_one'].'"  data-gradient-color-two="'.$data['gradient_color_two'].'" data-gradient-color-direction = "'.$data['gradient_color_direction'].'"';
		 }
		 if(empty($data['default_effect_type']))
		 $data['default_effect_type'] = 'single';
		 $textstyle = (!empty($data['text_color'])) ? 'color:'.$data['text_color'].'!important' : '';
		
		 $overlay_placeholder = '<div rel="custom_overlay"  class="overlay-effect wop_effects clearfix">
					<div class="wop_img">
					'.$image.'
					<div class="wop_overlay animated" data-opacity = "'.$data['opacity'].'" data-default-effect-type="'.$data['default_effect_type'].'" '.$gradient_effect_data_attr.' data-text-color="'.$data['text_color'].'" data-in="'.$data['in'].'"  data-out="'.$data['out'].'"  data-width="100" data-height="100" data-speed="1" data-color="'.$data['color'].'" data-text-position="left" data-class="'.$extra_classes.'">
					<style>.wop_overlay *{'.$textstyle.'}.product_add_to_cart_markup_container a,.product_add_to_cart_markup_container a:hover{color:#515151!important;text-transform:initial!important;}</style>
					<div rel="overlay-content-placeholder" class="center backend" style="padding:10px;">
					'.stripcslashes( $data['content'] ).'
					</div>
					</div>
					</div>
					</div>';
					
		return 	$overlay_placeholder;		
	 }
	 
	 public function get_hover_effect_markup_frontend($data) {
		
		$img_attr_str = $container_attr_str = '';
		$styleData = $this->get_styles_for_elements($data);
		$img_attr_str = $styleData['img_tag_style'];
		$container_attr_str = $styleData['img_container_style'];

		$image = '<img style="display: block;margin: 0 auto;" src="'.$data['image'].'" class="'.$data['class'].'" '.$img_attr_str.' />';
		
		$gradient_effect_data_attr = '';
		if($data['default_effect_type'] == 'multi') {
			$gradient_effect_data_attr = 'data-gradient-color-one="'.$data['gradient_color_one'].'"  data-gradient-color-two="'.$data['gradient_color_two'].'" data-gradient-color-direction = "'.$data['gradient_color_direction'].'"';
		}
		if(empty($data['default_effect_type']))
		$data['default_effect_type'] = 'single';
		 
		$textstyle = (!empty($data['text_color'])) ? 'color:'.$data['text_color'].'!important' : '';
		
		$use_post_specific_effect = get_post_meta($data['postid'],'use-post-specific-effect',true);
	    $extra_class = ($use_post_specific_effect == 'yes') ? 'post_specific_effect' : '';
		
	$data['content'] = str_replace('<h1>','<h1 style="color:'.$data['text_color'].'">',$data['content']);	
	$data['content'] = str_replace('<h2>','<h2 style="color:'.$data['text_color'].'">',$data['content']);
	$data['content'] = str_replace('<h3>','<h3 style="color:'.$data['text_color'].'">',$data['content']);
	$data['content'] = str_replace('<p>','<p style="color:'.$data['text_color'].'">',$data['content']);
	$data['content'] = str_replace('#dynamic_color#',$data['text_color'],$data['content']); 	
		
		if(is_admin()){
			if(empty($data['width']))
			$data['width'] = '100';
			if(empty($data['height']))
			$data['height'] = '100';
		}
		$overlay_placeholder = '<div rel="custom_overlay" class="overlay-effect wop_effects clearfix" style='.$container_attr_str.'height:auto;margin:0 auto;'.'>
					<div class="wop_img">
					'.$image.'
					<div class="wop_overlay animated"  data-opacity = "'.$data['opacity'].'" data-default-effect-type="'.$data['default_effect_type'].'" '.$gradient_effect_data_attr.' data-text-color="'.$data['text_color'].'" data-in="'.$data['in'].'"  data-out="'.$data['out'].'" data-width="'.$data['width'].'" data-height="'.$data['height'].'" data-speed="'.$data['speed'].'" data-color="'.$data['color'].'" data-text-position="'.$data['text_position'].'" data-class="'.$data['class'].'">
					<div rel="overlay-content-placeholder '.$extra_class.'" class="'.$data['text_position'].'" style="'.$textstyle.';padding:10px;">
					'.stripcslashes( $data['content'] ).'
					</div>
					</div>
					</div>
					</div>';			
					
		return $overlay_placeholder;			 
	 }
	
	 public function get_hover_effect_markup($data) {
		
		global $page,$screen;
			
		$this->data = $data;
		$currenteffect = $data['currenteffect'];
		if(isset($data['postid']) and empty($data['content'])) {
			$data['content'] = $this->custom_excerpt(5);
			$this->data['content'] = $this->custom_excerpt(5);
		}
		$data['content'] = $data['content'];
		$image = '<img src="'.$data['image'].'" class="'.$class_on_image.'" />';
		if(is_admin()) { 
			
			$screen = get_current_screen();	
			$this->imageHoverType = 'default_imagehover_effects';
			$this->current_effect = $data['in'];
			$this->current_effect_exit = $data['out'];
			if($screen->base == 'wp-image-hover-effects-pro_page_ihep_effects_settings' or isset($data['via-media-uploader']))
			$overlay_placeholder = $this->get_hover_effect_markup_backend($data); // For Static Config // Sample E
			else
			$overlay_placeholder = $this->get_hover_effect_markup_frontend($data); // For Dynamic Data Configuration
			
			$overlay_placeholder .= '<div class="link_container">';
			if($_GET['page'] == 'ihep_effects_settings')
			$overlay_placeholder .= $this->get_customising_link() . $this->get_similar_effects();  
			$overlay_placeholder .= '</div>';
			
		} else{
			$overlay_placeholder = $this->get_hover_effect_markup_frontend($data);
		}
		
		return $overlay_placeholder;
		
	 }
	
}
