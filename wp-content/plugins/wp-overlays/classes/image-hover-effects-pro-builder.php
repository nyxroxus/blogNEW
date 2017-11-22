<?php

class Image_Hover_Effects_Pro_Builder {
	 
	 protected $imageHoverType;
	 protected $current_effect;
     protected $current_effect_exit;
	 protected $effectType = '';
	 protected $dbsettings = array();
	 protected $data;
	 protected $content;
	 protected $placeholders;
	 protected $includestyle;
	 
	 public function __construct($data = array()) {  
		 
		 $this->dbsettings = get_option( 'wp-ihep-settings' );
		 $this->includestyle = false;
		 
		  if(is_admin()) {
			
			 if( ($_GET['page'] == 'ihep_effects_settings' or $_GET['page'] == 'ihep_manage_settings') 
			     or (isset($data['includestyle']) and $data['includestyle']==true ) ) {
				 	 
			     $this->includestyle = true;	
		    }
			 
		 }else{
			
			$this->includestyle = true;
		 }
		 
	}
	 
	 public function get_content_area($data) {
		 
		 if(!empty($data['postid'])) {
			
			 if(!empty($data['content_via_category'])){
				 $this->content = $data['content'];
			 }else{
				 $this->content = $this->dbsettings['overlay_content'][$data['posttype']];
			 } 
		     if($data['is_backend']) {
			   $hovereffecttype = $data['hovereffecttype'];
			   $this->content = $this->dbsettings['design_wise_default_content'][$hovereffecttype]; 
			 }
			 $this->content = WP_Overlays_Pro::overlay_render_content($this->content,$data['postid']);
			 
	     }else {
				
			 $this->content = WP_Overlays_Pro::overlay_render_content($data['content'],'');
			 
		 }
		 
	 }
	 
	 public function get_similar_effects() {
		 
		 $similarEffects = '';
		 if( isset($this->effect_array) and ( count($this->effect_array) > 1 ) ) {
			 
			 $similarEffects .= '<div class="links_holder show_similar_effects_holder"><a class="show_similar_effects fc-btn fc-btn-medium fc-btn-orange" href="#" data-markuptype="'.$this->imageHoverType.'">'.__('Show More Similar Effects',WOP_TEXT_DOMAIN).'<i></i></a></div>';
			 
			 
		 }else if( isset($this->effects) and ( count($this->effects) > 1 )  ){
			 $similarEffects .= '<div class="links_holder show_similar_effects_holder"><a class="show_similar_effects fc-btn fc-btn-medium fc-btn-orange" href="#" data-markuptype="'.$this->imageHoverType.'">'.__('Show More Similar Effects',WOP_TEXT_DOMAIN).'<i></i></a></div>';
			 
		 }
		 return $similarEffects;
		 
	 }
	 
	 public static function get_post_data($postType = '') {
		 
		$dbdata = get_option('wp-ihep-settings'); 
		if(empty($postType))
		$postType = 'post';
		 
		$data = array(); 
		
		$args = array(
		'meta_key' => '_thumbnail_id',
		'post_count' => 1,
		'post_type' => $postType );
		$myposts = new WP_Query($args);
		$mypost = $myposts->posts[0];
		wp_reset_postdata();
		
		if ( has_post_thumbnail() ) {
			$img = get_the_post_thumbnail_url($mypost->ID,'full');
		}else{
			$img = WOP_IMAGES.'preview.jpg';
		}
		
		if($mypost) {
			
			$data['postid'] = $mypost->ID;
			$data['posttitle'] = $mypost->post_title;
			$data['content'] = get_the_excerpt($mypost->ID);//$mypost->post_content;
			if(empty($data['content']))
			$data['content'] = $mypost->post_content;
			$data['content'] = WP_Overlays_Pro::custom_excerpt($data['content'],5);
			$data['color'] = 'rgba(234,237,73,0.52)';
			$data['permalink'] = get_the_permalink($mypost->ID);
			$data['image'] = $img;
			$overlayColor = get_post_meta($mypost->ID,'featured-image-overlay-color',true);
			$data['color'] = 'rgba(234,237,73,0.52)';
			
		}else{
			
			$data['posttitle'] = 'Hello World!';
			$data['content'] = 'Welcome to WordPress. This is your first post.';
			$data['permalink'] = '#';
			$data['image'] = $img;
			$data['color'] = 'rgba(234,237,73,0.52)';	
		}
		
		return $data;
		
	 }
	 
	 public function get_customising_link() {
		 
		 $design_wise_content = $this->dbsettings['design_wise_default_content'][$this->imageHoverType];
		 	
         if($this->imageHoverType == 'default_imagehover_effects') {  
		   $design_wise_content = '<p>'.$design_wise_content.'</p>';
		   
		  //$overlaytype = $this->default_effect_type;
		  $opacity = '0.50';
		  $speed = '1';
		  
		  $shortcode = 'data-effect = "'.$this->current_effect.'" data-slide_effect_exit = "'.$this->current_effect_exit.'" data-hovereffecttype="'.$this->imageHoverType.'" data-designwise-content="'.$design_wise_content.'" data-text-color="#ffffff" data-slide_text_position="overlay_top_left" data-overlaywidth="100" data-overlayheight="100" data-opacity="'.$opacity.'" data-animationspeed="'.$speed.'" data-overlaycolor="#000000"';
		  
		  //if($overlaytype == 'multi') {
			  
			  $shortcode .= ' data-default-effect-type="'.$overlaytype.'" data-gradient-color-one="#999999" data-gradient-color-two="#999999" data-gradient-color-direction="to bottom" data-overlay-type="'.$overlaytype.'"';
		  //}
		  
		  $click_here = '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" '.$shortcode.'>'.__('Choose Effect',WOP_TEXT_DOMAIN).'<i></i></a></div>';
		  
	     }else if($this->imageHoverType == 'square-imagehover'){
			 
			 $click_here = '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-effect = "'.$this->current_effect.'" data-hovereffecttype="'.$this->imageHoverType.'" data-overlay_color="#1a4a72" data-heading_color="#ffffff" data-desc_color="#ffffff" data-designwise-content="'.$design_wise_content.'">'.__('Choose Effect',WOP_TEXT_DOMAIN).'<i></i></a></div>'; 
			 
		 }else if($this->imageHoverType == 'ihover-circular'){
			 
			 $click_here = '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-effect = "'.$this->current_effect.'" data-hovereffecttype="'.$this->imageHoverType.'" data-size = "220" data-overlay_color="#999999" data-border_color_one="#ecab18" data-border_color_two="#1ad280" data-text-color = "#ffffff" data-opacity="50" data-designwise-content="'.$design_wise_content.'">'.__('Choose Effect',WOP_TEXT_DOMAIN).'<i></i></a></div>'; 
			 
		 }else if($this->imageHoverType == 'image-magnifier'){
			 
			 $click_here = '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-effect = "'.$this->current_effect.'" data-hovereffecttype="'.$this->imageHoverType.'" data-src = {image-url} data-magnifier-src = {image_url} data-designwise-content="'.$design_wise_content.'">'.__('Choose Effect',WOP_TEXT_DOMAIN).'<i></i></a></div>'; 
		 }
	     else {
			 
		  $click_here = '<div class="links_holder set_it_as_default_holder"><a class="set_it_as_default sample_of_effect fc-btn fc-btn-medium fc-btn-blue" data-toggle="modal" data-target="#modal_set_effect" href="#" data-effect = "'.$this->current_effect.'" data-hovereffecttype="'.$this->imageHoverType.'" data-designwise-content="'.$design_wise_content.'">'.__('Choose Effect',WOP_TEXT_DOMAIN).'<i></i></a></div>'; 
			 
		 } 
		
		 return $click_here;  
		 
	 }
	 
	 function custom_excerpt($limit) {
		  
		  $excerpt = explode(' ',$this->data['main_content'], $limit + 1);
	
		  if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			
			$excerpt = implode(" ",$excerpt).'...';
		  } else {
			$excerpt = implode(" ",$excerpt);
		  } 
		  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		  
		  return $excerpt;
    }
    
    function get_styles_for_elements($data) {
		
		if(!empty($data['img_attr_str'])) {
			
			// First Priority By If width and height are specified in inline tags. //Theme Dependency Here.
			$storeAttributes =  json_decode( base64_decode($data['img_attr_str']) );
			$searchword = 'width';
			$matches = array();
			foreach($storeAttributes as $k=>$v) {
				if(preg_match("/\b$searchword\b/i", $v)) {
					$matches[$k] = $v;
				}
			}
			
			if(count($matches == 1) ){ //Inline width attr @ img tag.
				
				$styledata = array();
				foreach($storeAttributes as $img_attribute){
				  
				  $img_attr_str .= " $img_attribute";
				  $getdetails = explode('=',$img_attribute);
				  
				  if(count($getdetails) > 0) {
					  trim($getdetails[1],'"');
					  $getdetails[1] = str_replace('"', '', $getdetails[1]);
				  }
				  $container_attr_str .= $getdetails[0].':'.$getdetails[1].'px;';
				  
				}
				
			}else{ //No inline width attr @ img tag.
				
				$img_attr_str .= 'width:100%;';
				$container_attr_str .= 'width:100%;';
				
			}
			
			
		}else{
			
			$img_attr_str .= 'width:100%;';
			$container_attr_str .= 'width:100%;';
		}
		
		return array('img_tag_style' => $img_attr_str,'img_container_style' => $container_attr_str );
		
	}
	
    
}
