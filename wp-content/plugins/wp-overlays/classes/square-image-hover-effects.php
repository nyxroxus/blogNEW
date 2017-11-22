<?php

/****************************************************************\
| Package           : Image Hover Effects Pro                    | 
| Class Description : Class_Square_Image_Hover_Effects Class     |
| Author            : flippercode                                |
****************************************************************/   

class Class_Square_Image_Hover_Effects extends Image_Hover_Effects_Pro_Builder {
	 
	 public  $effects = array('colored effect1 left_and_right sc',
							  'colored effect1 top_to_bottom sc',	
							  'colored effect2 dc',
							  'colored effect3 bottom_to_top sc',
							  'colored effect3 top_to_bottom sc',
							  'colored effect5 left_to_right dc',
							  'colored effect5 right_to_left dc',
							  'colored effect7 dc',
							  'colored effect8 scale_up dc',
							  'colored effect8 scale_down dc',
							  'colored effect9 bottom_to_top dc',
							  'colored effect9 left_to_right dc',
							  'colored effect9 right_to_left dc',
							  'colored effect9 top_to_bottom dc',
							  'colored effect10 left_to_right dc',
							  'colored effect10 right_to_left dc',
							  'colored effect10 top_to_bottom dc',
							  'colored effect10 bottom_to_top dc',
							  'colored effect11 left_to_right dc',
							  'colored effect11 right_to_left dc',
							  'colored effect11 top_to_bottom dc',
							  'colored effect11 bottom_to_top dc',
							  'colored effect12 left_to_right dc',
							  'colored effect12 right_to_left dc',
							  'colored effect12 top_to_bottom dc',
							  'colored effect12 bottom_to_top dc',
							  'colored effect13 left_to_right dc',
							  'colored effect13 right_to_left dc',
							  'colored effect13 top_to_bottom dc',
							  'colored effect13 bottom_to_top dc',
							  'colored effect14 left_to_right dc',
							  'colored effect14 right_to_left dc',
							  'colored effect14 top_to_bottom dc',
							  'colored effect14 bottom_to_top dc');
							  
	 private $overlay_type_effects = array('colored effect2 dc',
								   'colored effect4 sc',
								   'colored effect6 from_top_and_bottom dc',
								   'colored effect6 from_left_and_right dc',
								   'colored effect6 top_to_bottom dc',
								   'colored effect6 bottom_to_top dc',
								   'colored effect7 dc',
								   'colored effect12 right_to_left dc',
								   'colored effect12 top_to_bottom dc',
								   'colored effect12 bottom_to_top dc',
								   'colored effect13 left_to_right dc',
								   'colored effect13 right_to_left dc',
								   'colored effect13 top_to_bottom dc',
								   'colored effect13 bottom_to_top dc');
	
	private $heading_bg_effects = array('colored effect9 left_to_right dc');
	 						  	
	public function __construct($received) {  
		  
		  $this->imageHoverType = 'square-imagehover';  
		  $this->current_effect = 'effect16 right_to_left';
		  $this->current_effect_exit = '';
		  parent::__construct($received); 
		  if($this->includestyle)
		  wp_enqueue_style( 'square-imagehover',WOP_URL.'/assets/css/main.css');		 
	 }
	 
	 public function get_all_preview() {
	
		 $data = $this->get_post_data();
		 $small_preview = '<div class="effects-container square-imagehover"><div class="fc-divider">';
		 $count = 0;
		  
		 foreach($this->effects as $effect) {
			
			if($this->dbsettings['hovereffecttype'] == 'square-imagehover')
			$currentEffect = ($this->dbsettings['slide_effect'] == $effect) ? '<div class="current_effect">Current E</div>' : '';
			$data['currenteffect'] = $effect;
			$data['is_backend'] = true;
			$preview = $this->get_hover_effect_markup($data);
			$effectInfo ='<div class="effectinfo"><div class="effectname">'.ucfirst($effect).'</div></div>';
			
			if($count != 0 and $count % 3 == 0)
			$small_preview .= '</div><div class="fc-divider">';
			
			$small_preview .= '<div class="fc-4">'.$currentEffect.'<div class="effect-information" data-hovereffecttype="square-imagehover" data-effect="'.$effect.'">'.$preview.'</div></div>';
			$count++;
		}
		
		$small_preview .= '</div></div>';
		
		return $small_preview;
	 }
	 
	 public function get_hover_effect_markup($data) {
		
		$data['main_content'] = get_the_content($data['postid']);
		$this->data = $data;
		$this->get_content_area($data);
		
		if(!isset($data['effect']) or empty($data['effect']))
		$data['effect'] = $data['currenteffect'];
		
		$effectinfo = $data;
		
		if(!is_admin()){
			 if(isset($data['image']) and $data['image']=='{image_path}'){
			      $effectinfo['effect'] = $effectinfo['currenteffect'];
		     }
		     if( $data['post_thumbnail'] == 'yes'){
			   $effectinfo = maybe_unserialize($this->dbsettings['post_type_wise_effects'][$data['posttype']]['effect']);	
		     }
	    }
		
		 if(is_array($effectinfo)){
				 
			 $currenteffect = $effectinfo['effect'];
			 $overlay_color = $effectinfo['overlay_color'];
			 list($r, $g, $b) = sscanf($overlay_color, "#%02x%02x%02x");
			 $overlay_color = "rgba($r, $g, $b, 1);";
			 $heading_color = $effectinfo['heading_color'];
			 $heading_bgcolor = $effectinfo['heading_bg_color'];
			 $desc_color = $effectinfo['desc_color'];
			 $data['currenteffect'] = $currenteffect; 
			
		 }else{
			 $currenteffect = $data['currenteffect'];
		 }
		 
		 if(isset($data['overlay_color'])) {
			 $overlay_color = $data['overlay_color'];
			 list($r, $g, $b) = sscanf($overlay_color, "#%02x%02x%02x");
			 $overlay_color = "rgba($r, $g, $b, 1);";
		 }else{
			 $overlay_color = '';
		 }
		 
		 if(isset($data['heading_color'])) {
			 $heading_color = $data['heading_color'];
		 }
		 if(isset($data['heading_bg_color'])) {
			 $heading_bgcolor = $data['heading_bg_color'];
		 }
		 if(isset($data['desc_color'])) {
			 $desc_color = $data['desc_color'];
		 }
		 
		if(!empty($this->content)) {
		   $this->data['content'] = $this->content;
		   $this->data['content'] = $this->custom_excerpt(5);
	    }
		else {
		   $this->data['content'] = $this->custom_excerpt(5);
	    }
	    
		if($data['is_backend'] == '1' and empty($this->content)) {
			$content = $this->dbsettings['design_wise_default_content']['square-imagehover'];
			$content = WP_Overlays_Pro::overlay_render_content( $content,$data['postid']);
			$this->content = '<h3>'.$data['posttitle'].'</h3><p>'.$data['content'].'</p>';
		}else{
			$this->content = $data['content'];	
		}
		
		$with_bg_heading = ((int)strpos($currenteffect, 'dc') > 0) ? true : false;
		
		$heading_color = (!empty($heading_color)) ? $heading_color : '#fff';
		$desc_color = (!empty($desc_color)) ? $desc_color : '#fff';
		
		$head_css = 'color:'.$heading_color.';';
		if(!empty($heading_bgcolor) and $with_bg_heading)
		$head_css .= 'background-color:'.$heading_bgcolor.';';
		
		if($data['via_post_specific'] == 'yes' and !empty($data['content']))
		$this->content = $data['content'];
		
		if(isset($data['is_sample'])) {
			if($with_bg_heading > 0){ 
			  $this->content = '<h3 style="'.$head_css.'">'.$data['posttitle'].'</h3><p>'.$data['content'].'</p>';   
			}else{
			  $this->content = '<h3>'.$data['posttitle'].'</h3><p>'.$data['content'].'</p>';
			}
		}
		
		$this->content = str_replace('<h1>','<h1 style="'.$head_css.'">',$this->content);
		$this->content = str_replace('<h2>','<h2 style="'.$head_css.'">',$this->content);
		$this->content = str_replace('<h3>','<h3 style="'.$head_css.'">',$this->content);
		$this->content = str_replace('<p>','<p style="color:'.$desc_color.'">',$this->content);
		$this->content = str_replace('#dynamic_color#',$head_css.'!important;',$this->content);
		
		if(!empty($heading_bgcolor))
		$bgheadingcss = 'background-color:'.$heading_bgcolor.';';
		else
		$bgheadingcss = '';
		
		$styleData = $this->get_styles_for_elements($data);
		$this->img_tag_style = $styleData['img_tag_style'];
		$container_attr_str = $styleData['img_container_style'];
		
		$fold = ((int)strpos($currenteffect, 'effect9') > 0) ? true : false;
		$with_bg_heading = ((int)strpos($currenteffect, 'dc') > 0) ? true : false;
		
		if( ( !$fold and (in_array(trim($currenteffect),$this->overlay_type_effects) or $with_bg_heading) ) ){
			$data['currenteffect'] .= ' overlay_type_effect';
			$headingclass = 'header_bg';
         }else{
			$headingclass = '';
		}
		
		if($with_bg_heading)
		$headingclass = 'header_bg';
		
		$overlay_style = (!empty($overlay_color)) ? 'background:'.$overlay_color.'!important;' : '';
				
		if (strpos($currenteffect, 'effect9') !== false) {
			
			$markup = '<div class="m ih-item square colored '.$data['currenteffect'].'"><a href="'.$data['permalink'].'">
        <div class="img"><img src="'.$data['image'].'" alt="img"></div>
        <div class="info '.$headingclass.'" style="background:'.$overlay_color.'!important;" >
          <div class="info-back" style="'.$overlay_style.'">'.$this->content.'</div>
        </div></a></div>';
        	
		}else{
			
			$markup = '<div class="m ih-item square '.$data['currenteffect'].'"><a href="'.$data['permalink'].'">
                      <div class="img"><img src="'.$data['image'].'" alt="img"></div>
                      <div class="info '.$headingclass.'" style="'.$overlay_style.'">'.$this->content.'</div></a></div>';
        	
		}
		              
		if(is_admin()) {
			
			$this->imageHoverType = 'square-imagehover';
			$this->current_effect = $data['currenteffect'];
			$this->current_effect_exit = $data['out'];
			$markup .= '<div class="link_container">';
			if($_GET['page'] == 'ihep_effects_settings')
			$markup .= $this->get_customising_link() . $this->get_similar_effects();  
			$markup .= '</div>';
		}
		else
		{
			
			if(!empty($headingclass))
			$headbgstyle ='background:'.$data['heading_bg_color'].'!important;';
			else
			$headbgstyle ='';
			
			if(!empty($data['image']) and $data['image']=='{image_path}') {
				
				$style='<style>.fc-hovereffect-caption .info,.fc-hovereffect-caption .info-back{background-color:'.$data['overlay_color'].'!important;}.fc-hovereffect-caption .info h3,.fc-hovereffect-caption .header_bg h3{color:'.$data['heading_color'].'!important;'.$headbgstyle.'}.fc-hovereffect-caption .info p,.fc-hovereffect-caption .info-back p{color:'.$data['desc_color'].'!important;}</style>';
				return $markup;
		    }
		    else if(!empty($data['is_shortocode_vc']) and $data['is_shortocode_vc']=='yes'){
				
				$style='<style>.ih-item.square .info,.ih-item.square .info-back{background-color:'.$data['overlay_color'].'!important;}.ih-item.square .info h3,.ih-item.square .header_bg h3{color:'.$data['heading_color'].'!important;'.$headbgstyle.'}.ih-item.square .info p,.ih-item.square .info-back p{color:'.$data['desc_color'].'!important;}</style>';
				return $markup;
			}
			else if($data['via_static_shortcode'] == 'yes'){
				
				$style='<style>.ih-item.square .info,.ih-item.square .info-back{background-color:'.$data['overlay_color'].'!important;}.ih-item.square .info h3,.ih-item.square .header_bg h3{color:'.$data['heading_color'].'!important;'.$headbgstyle.'}.ih-item.square .info p,.ih-item.square .info-back p{color:'.$data['desc_color'].'!important;}</style>';
				return $markup;
			}
			else{
				return $markup;
			}
			
		}
		
		return $markup;
		
	 }
	 
}
 
