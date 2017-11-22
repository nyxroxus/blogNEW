<?php

/***************************************************************
| Package           : Image Hover Effects Pro
| Class Description : Set One Hover Effect Class
| Author            : flippercode
****************************************************************/   

class Ihover_Circular_Image_Hover_Effects extends Image_Hover_Effects_Pro_Builder {
	
	 public  $effects = array('effect1',
							  'effect2 right_to_left',
	 						  'effect2 left_to_right',
							  'effect2 top_to_bottom',
							  'effect2 bottom_to_top',
							  'effect3 left_to_right',
							  'effect3 bottom_to_top',
							  'effect3 right_to_left',
							  'effect3 top_to_bottom',
							  'effect4 left_to_right',
							  'effect4 right_to_left',
							  'effect4 top_to_bottom',
							  'effect4 bottom_to_top',
							  'effect6 scale_down',
							  'effect6 scale_down_up',
							  'effect6 scale_up',
							  'effect7 right_to_left',
							  'effect7 left_to_right',
							  'effect7 top_to_bottom',
							  'effect7 bottom_to_top',
							  'effect8 top_to_bottom',
							  'effect8 left_to_right',
							  'effect8 right_to_left',
							  'effect8 bottom_to_top',
							  'effect9 left_to_right',
							  'effect9 right_to_left',
							  'effect9 top_to_bottom',
							  'effect9 bottom_to_top',
							  'effect10 top_to_bottom',
							  'effect10 bottom_to_top',
							  'effect11 left_to_right',
							  'effect11 right_to_left',
							  'effect11 top_to_bottom',
							  'effect12 right_to_left',
							  'effect12 left_to_right',
							  'effect12 top_to_bottom',
							  'effect13 from_left_and_right',
							  'effect12 bottom_to_top',
							  'effect13 top_to_bottom',
							  'effect13 bottom_to_top',
							  'effect14 left_to_right',
							  'effect14 right_to_left',
							  'effect14 top_to_bottom',
							  'effect14 bottom_to_top',
							  'effect15 left_to_right',
							  'effect16 right_to_left',
							  'effect16 left_to_right',
							  'effect17',
							  'effect18 bottom_to_top',
							  'effect18 left_to_right',
							  'effect18 right_to_left',
							  'effect18 top_to_bottom',
							  'effect19',
							  );
							  	
	 public function __construct($received) {  
		  
		  $this->imageHoverType = 'ihover-circular';  
		  $this->current_effect = 'effect16 right_to_left';
		  $this->current_effect_exit = '';
		  parent::__construct($received); 
		  if($this->includestyle)
		  wp_enqueue_style( 'ihover-circular',WOP_URL.'/assets/css/main.css');
		  
	 }
	 	 
	 public function get_all_preview() {
		
		$data = $this->get_post_data();
		
		$small_preview = '<div class="effects-container ihover-circular"><div class="fc-divider">';
		 
		$count = 0;
		  
		 foreach($this->effects as $effect) {
			
			if($this->dbsettings['hovereffecttype'] == 'ihover-circular')
			$currentEffect = ($this->dbsettings['slide_effect'] == $effect) ? '<div class="current_effect">Current E</div>' : '';
			
			$data['currenteffect'] = $effect;
			$data['is_backend'] = true;
			$data['is_all_listing'] = true;
			
			$preview = $this->get_hover_effect_markup($data);
			$effectInfo ='<div class="effectinfo"><div class="effectname">'.ucfirst($effect).'</div></div>';
			
			if($count != 0 and $count % 3 == 0)
			$small_preview .= '</div><div class="fc-divider">';
			
			$small_preview .= '<div class="fc-4">'.$currentEffect.'<div class="effect-information" data-hovereffecttype="ihover-circular" data-effect="'.$effect.'">'.$preview.'</div></div>';
			$count++;
		}
		
		$small_preview .= '</div></div>';
		
		return $small_preview;
	 }
	 
	 
	 public function get_hover_effect_markup($data) {
			
		$data['main_content'] = get_the_content($data['postid']);
		$this->data = $data;
		$this->get_content_area($data);
		$currenteffect = $data['currenteffect'];
		if(!empty($this->content)) {
		   $this->data['content'] = $this->content;
		   $this->data['content'] = $this->custom_excerpt(5);
	    }
		else {
		   $this->data['content'] = $this->custom_excerpt(5);
	    }
	
	    if($data['is_backend'] == '1' and empty($this->content)) {
			
			$content = $this->dbsettings['design_wise_default_content']['ihover-circular'];
			$content = WP_Overlays_Pro::overlay_render_content( $content,$data['postid']);
			$this->content = '<h3>'.$data['posttitle'].'</h3><p>'.$data['content'].'</p>';
		}
		
		if(isset($data['is_gallery']) and  $data['is_gallery'] == true){
			$postobj = get_post($data['postid']);
			$excerpt = WP_Overlays_Pro::custom_excerpt($postobj->post_content,5);
			$this->content = '<h3>'.$data['posttitle'].'</h3><p>'.$excerpt.'</p>';
		}
		if(is_admin() and (isset($data['is_all_listing']) or isset($data['is_gallery']) or isset($data['is_sample']))) {
			$data['color'] = 'rgba(0,0,0,0.50)';	
		}
		
		if(empty($data['postid']) and is_admin()){
			$this->content = '<h3>Hello World</h3><p>Welcome to WordPress. This is your first post.</p>';
		}
		
		if($data['via_post_specific'] == 'yes' and !empty($data['content']))
		$this->content = $data['content'];
		
		
		if(!empty($data['text_color']))
		$textColor = $data['text_color'];
		
		$this->content = str_replace('<h1>','<h1 style="color:'.$textColor.'!important">',$this->content);
		$this->content = str_replace('<h2>','<h2 style="color:'.$textColor.'!important">',$this->content);
		$this->content = str_replace('<h3>','<h3 style="color:'.$textColor.'!important">',$this->content);
		$this->content = str_replace('<p>','<p style="color:'.$textColor.';border-top:1px solid '.$textColor.'!important;">',$this->content);
		$this->content = str_replace('#dynamic_color#',$textColor.';',$this->content);
		
		if (strpos($currenteffect, 'effect8') !== false) {
			
			$markup = '<div class="ih-item circle colored '.$data['currenteffect'].'" style="width:'.$data['size'].'px!important;height:'.$data['size'].'px!important;"><a href="'.$data['permalink'].'">
                      <div class="img-container">
                        <div class="img" style="width:'.$data['size'].'px!important;height:'.$data['size'].'px!important;"><img src="'.$data['image'].'" alt="img"></div>
                      </div>
                      <div class="info-container">
                        <div class="info overlay_bg" style="position:relative;background-color:'.$data['color'].'!important;">
                        <div style="position: absolute;top: 50%;transform: translate(-50%,-50%);left: 50%;">'.$this->content.'</div> 
                        </div>
                      </div></a></div>';
			
			
		}
		else if($currenteffect == 'effect1'){
			  
			  $border_color_one = $data['border_color_one'];
			  $border_color_two = $data['border_color_two'];
			  if(is_admin() and isset($data['is_gallery'])){
				  $style = $style2 = '';
			  }else{
				
				if(!empty($border_color_one) and !empty($border_color_two)){  
				  $style = 'border: 10px solid '.$border_color_one.';border-right-color:'.$border_color_two.';border-bottom-color:'.$border_color_two.';';
				}else{
				  $style = '';	
				}
				if(!empty($data['color'])){
				  $style2 = (is_admin() and isset($data['is_gallery'])) ? '' : 'background-color:'.$data['color'].'';
				  
				  if(isset($data['content_via_category']))
				  $style2 = 'background-color:'.$data['color'];
			    }
			    
			    if(!empty($data['size'])){
					$style .= 'width:'.($data['size']+10).'px!important;height:'.($data['size']+10).'px!important;';
				}
			   
			  }	
			  
			  $markup = '<div class="ih-item circle '.$currenteffect.'" style="width:'.$data['size'].'px!important;height:'.$data['size'].'px!important;"><a href="'.$data['permalink'].'">
        <div class="spinner" style="'.$style.'"></div>
        <div class="img"><img src="'.$data['image'].'" alt="img"></div>
        <div class="info overlay_bg" style ="'.$style2.'">
          <div class="info-back">
            '.$this->content.'
          </div>
        </div></a></div>';
        	        	
		}
		else{
			
			$double_info_box_effects = array('effect18 bottom_to_top',
											  'effect18 left_to_right',
											  'effect18 right_to_left',
											  'effect18 top_to_bottom');
			$same_background = '';
			if (in_array($data['currenteffect'], $double_info_box_effects ) !== false) {
				$same_background = 'background-color:'.$data['color'];
			}else{
				$same_background = '';
			}
			
			if(is_admin() and isset($data['is_all_listing'])){
				
				if(!empty($same_background)) {
					$markup = '<div class="ih-item circle '.$data['currenteffect'].'"><a href="'.$data['permalink'].'"><div class="img">
                      <img src="'.$data['image'].'" alt="img" class="'.$data['class_on_image'].'">
                      </div>
                      <div class="info overlay_bg">
                        <div class="info-back pos_rel" style="'.$same_background.'">
                          <div class="pos_abs">'.$this->content.'</div> 
						</div>
                      </div></a></div>';
				
				}else {
				$markup = '<div class="ih-item circle '.$data['currenteffect'].'"><a href="'.$data['permalink'].'"><div class="img">
                      <img src="'.$data['image'].'" alt="img" class="'.$data['class_on_image'].'">
                      </div>
                      <div class="info overlay_bg">
                        <div class="info-back">
                          '.$this->content.' 
						</div>
                      </div></a></div>';
				 }
                      
			}
			else{
			$markup = '<div class="ih-item circle colored '.$data['currenteffect'].'" style="width:'.$data['size'].'px!important;height:'.$data['size'].'px!important;"><a href="'.$data['permalink'].'"><div class="img" style="width:'.$data['size'].'px!important;height:'.$data['size'].'px!important;">
                      <img src="'.$data['image'].'" alt="img" class="'.$data['class_on_image'].'">
                      </div>
                      <div class="info overlay_bg" style="background-color:'.$data['color'].';">
                        <div class="info-back" style="position:relative;'.$same_background.'" data-class="">
                          <div style="position: absolute;top: 50%;transform: translate(-50%,-50%);left: 50%;">'.$this->content.'</div> 
						</div>
                      </div></a></div>';
		   }
		}
		
		if(is_admin()) {
			
			$this->imageHoverType = 'ihover-circular';
			$this->current_effect = $data['currenteffect'];
			$this->current_effect_exit = $data['out'];
			$markup .= '<div class="link_container">';
			if($_GET['page'] == 'ihep_effects_settings')
			$markup .= $this->get_customising_link() . $this->get_similar_effects();  
			$markup .= '</div>';
		}
		
		return $markup;
	}
	 
}
