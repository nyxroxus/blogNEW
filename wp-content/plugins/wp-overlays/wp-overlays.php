<?php
/**
 * WP_Overlays_Pro class file.
 * @package Posts
 * @author Flipper Code <hello@flippercode.com>
 * @package 1.0.0
 */

/*
Plugin Name: WP Overlays
Plugin URI: http://www.flippercode.com/
Description:  Apply Stunning & Beautiful CSS3 Hover Effects On Your Wordpress Site. Customizable & Ready To Use Hover Effects. 
Author: flippercode
Author URI: http://www.flippercode.com/
Version: 1.0.2
Text Domain: wp-overlays
Domain Path: /lang/
*/
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	die('Access Denied');
}

if ( ! class_exists( 'WP_Overlays_Pro' ) ) { 

	/**
	 * Main plugin class
	 * @author Flipper Code <hello@flippercode.com>
	 * @package WP_Overlays_Pro
	 */
	class WP_Overlays_Pro
	{
		/**
		 * List of Modules.
		 * @var array
		 */
		private $modules = array();
		private $dbsettings;
		static public $all_post_types = array();
		static private $currentDesign;
		/**
		 * Intialize variables, files and call actions.
		 * @var array
		 */
		public function __construct() {
			
			error_reporting( E_ERROR | E_PARSE );
			$this->_define_constants();
			$this->_load_files();
			$this->_setup_class();
			$this->register_plugin_hooks();
		}
		
		function _setup_class() {
			
			$this->dbsettings = get_option('wp-ihep-settings');
			if(!is_array( $this->dbsettings ))
			$this->dbsettings = unserialize( $this->dbsettings );
		}
		
		function register_plugin_hooks(){
			
			register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivation' ) );
		    add_action( 'plugins_loaded', array( $this, 'load_plugin_languages' ) );
			add_action( 'init', array( $this, '_init' ) );
			add_action( 'wp_ajax_wop_ajax_call',array( $this, 'wop_ajax_call' ) );
			add_action( 'wp_ajax_nopriv_wop_ajax_call', array( $this, 'wop_ajax_call' ) );
			add_action( 'admin_footer',array($this,'hook_in_foot'),100);
			add_action( 'admin_head',array($this,'hook_admin_head'));
			add_action( 'wp_head',array($this,'hook_in_head'));
			add_filter( 'post_thumbnail_html', array( $this, 'hovereffect_mask_html' ), 10, 3 );
			add_filter( 'wp_ihep_final_settings', array( $this, 'custom_changes_on_save_operation' ) ); 
			add_shortcode( 'hovereffect', array( $this, 'hovereffect_custom_display' ),10, 1 );
			add_filter( 'the_content', array($this,'shortcode_empty_paragraph_fix') );
			add_action( 'admin_enqueue_scripts', array($this,'resources_for_backend'),100 );
			
		}
		
		function resources_for_backend(){
			
			wp_enqueue_style( 'wp-color-picker' ); 
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-backend-common-style',WOP_CSS.'wp-backend.css' ); 
		}
		
		 function replace_placeholders($template, $data) {

			  $placeholders = array_keys($data);
			  foreach ($placeholders as &$placeholder) {
					$placeholder = "{$placeholder}";
			  }
			  return str_replace($placeholders, array_values($data), $template);
		  
		 }
 		
		function set_effect_as_final_effect() {
		
			$data = $this->dbsettings;
			$for_post_type = $_POST['for_post_type'];
			
			if(!empty($for_post_type)){
				$data['post_type_wise_effects'][$for_post_type]['hovereffecttype'] = $_POST['hovereffecttype'];
			if($_POST['hovereffecttype'] == 'default_imagehover_effects') {
				
				$data['post_type_wise_effects'][$for_post_type]['slide_effect'] = $_POST['slide_effect'];
				$data['post_type_wise_effects'][$for_post_type]['slide_effect_exit'] = $_POST['slide_effect_exit'];
				$data['post_type_wise_effects'][$for_post_type]['slide_text_position'] = $_POST['slide_text_position'];
				$data['post_type_wise_effects'][$for_post_type]['animation_speed'] = $_POST['animation_speed'];
				$data['post_type_wise_effects'][$for_post_type]['overlay_width'] = $_POST['overlay_width'];
				$data['post_type_wise_effects'][$for_post_type]['overlay_height'] = $_POST['overlay_height'];
				$data['post_type_wise_effects'][$for_post_type]['opacity_value'] = $_POST['opacity_value'];
				$data['post_type_wise_effects'][$for_post_type]['default_effect_type'] = $_POST['default_effect_type'];
				$data['post_type_wise_effects'][$for_post_type]['text_color'] = $_POST['text_color'];
				if($_POST['default_effect_type'] == 'multi'){
					$data['post_type_wise_effects'][$for_post_type]['gradient_color_one'] = $_POST['gradient_color_one'];
					$data['post_type_wise_effects'][$for_post_type]['gradient_color_two'] = $_POST['gradient_color_two'];
					$data['post_type_wise_effects'][$for_post_type]['gradient_color_direction'] = $_POST['gradient_color_direction'];
					
				}
				
			}else if($_POST['hovereffecttype'] == 'square-imagehover'){
				
				$effectdata = array('effect' => $_POST['slide_effect'],
									'overlay_color' => $_POST['overlay_color'],
									'heading_bg_color' => $_POST['heading_bg_color'],
									'heading_color' => $_POST['heading_color'],
									'desc_color' => $_POST['desc_color']);
				$data['post_type_wise_effects'][$for_post_type]['effect'] = serialize($effectdata);
				if($_POST['overlay_color_changed'] == 'yes')
				$data['post_type_wise_effects'][$for_post_type]['overlay_color'] = $_POST['overlay_color'];
				
			}
			else if($_POST['hovereffecttype'] == 'ihover-circular'){
				
				$effectdata = array('effect' => $_POST['slide_effect'],
									'overlay_color' => $_POST['overlay_color'],
									'border_color_one' => $_POST['border_color_one'],
									'border_color_two' => $_POST['border_color_two'],
									'text_color' => $_POST['text_color'],
									'size' =>$_POST['circle_size'],
									'opacity' =>  $_POST['circle_opacity']);
				$data['post_type_wise_effects'][$for_post_type]['effect'] = serialize($effectdata);
				
			}
			else{
			   $data['post_type_wise_effects'][$for_post_type]['effect'] = $_POST['slide_effect'];
			}
			$default_content = $_POST['default_data'];
			
			$data['overlay_content'][$for_post_type] = html_entity_decode($default_content);
			
			if($_POST['overlay_color_changed'] == 'yes')
			$data['post_type_wise_effects'][$for_post_type]['overlay_color'] = $_POST['overlay_color'];
			$data['post_type_wise_effects'][$for_post_type]['enable_effect'] = 'yes';
			update_option( 'wp-ihep-settings',$data );
			echo json_encode(array('status'=> 1,'posted' => $_POST,'data' => $data));
				
			}
			exit;
			
		}
		
		function get_default_markup_for_hovereffect() {
			
			$hoverEffect = $_POST['hovereffect'];
			$markup = $this->dbsettings['design_wise_default_content'][$hoverEffect];
			echo json_encode(array('status'=> 1,'markup' => $markup,'posted' => $_POST));
			exit;
			
		}
		
		function hook_admin_head() {
			
			wp_enqueue_script( 'wp-color-picker' );
		    ?> 
		     <style>
			 .effect_instant_preview a{text-decoration:none!important;}	 
			 .tools-to-customise .fc-field-label{margin-bottom:10px;}.overlay-choices{margin-top:15px;margin-bottom:15px;}
		     .gradient_color_container,.overlay_color_container{margin-bottom:8px;}
		     .gradient_color_container .fc-field-label{margin-top:10px;}		     .gradient-dir-lbl{margin-top:15px;}.vc_img_uploader{font-weight:normal!important;},.dynamic-tab-content .ih-item.circle{ margin-bottom:20px!important;}.final-selected-caption-effect .scalable_grid_markup h2 a{text-decoration:none!important;}</style>
		     <script>	var admin_ajax = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
			   jQuery(document).ready(function($) {
					if($('.color-field').length > 0) {
					   $('.color-field').wpColorPicker();
					}
				});
			 </script><?php
		}
		
		function shortcode_empty_paragraph_fix( $content ) {
 
			$array = array(
				'<p>['    => '[',
				']</p>'   => ']',
				']<br />' => ']'
			);
			return strtr( $content, $array );
		 
		}
		
		
		function hook_in_head(){ 
		
			global $post;
			$post_type = get_post_type();
			$current_he = $this->dbsettings['post_type_wise_effects'][$post_type]['hovereffecttype'];
			if( $current_he == 'square-imagehover'){
				$square_css = unserialize($this->dbsettings['post_type_wise_effects'][$post_type]['effect']);
				$square_style =  '<style>';
				$square_style .= '.fc-ihep-custom-markup .square .info h3,.fc-ihep-custom-markup .square .info-back h3{color:'.$square_css['heading_color'].'!important;}';
				$square_style .= '.fc-ihep-custom-markup .square .info-back h3{background-color:'.$square_css['heading_bg_color'].'!important;}';
				$square_style .= '.fc-ihep-custom-markup .square .info p,.fc-ihep-custom-markup .square .info-back p{color:'.$square_css['desc_color'].'!important;}';
				$square_style .= '.fc-ihep-custom-markup .square .header_bg h3{background-color:'.$square_css['heading_bg_color'].'!important;}';
				$square_style .= '.fc-ihep-custom-markup .square .info,.fc-ihep-custom-markup .square .info-back{background-color:'.$square_css['overlay_color'].'!important;}';
				$square_style .= '</style>';
				echo $square_style;
			} else if($current_he == 'default_imagehover_effects') {
				 $overlay = get_post_meta($post->ID,'featured-image-overlay-color',true);
				 $priorityOverlay = get_post_meta($post->ID,'use_as_priority_overlay',true); 
				 $overlayColor = $this->dbsettings['post_type_wise_effects'][$post_type]['overlay_color'];
				 $textcolor = $this->dbsettings['post_type_wise_effects'][$post_type]['text_color'];	
				 $opacity = $this->dbsettings['opacity_value'];
				 $overlayColor = ($priorityOverlay == 'true') ?  $overlay : $overlayColor;
				 
				 echo '<style>.wop_overlay p{margin:2px!important;}.wop_overlay .price{color:'.$textcolor.'!important;} .wop_overlay .added_to_cart,.wop_overlay .woocommerce-main-image,.wop_overlay .added_to_cart:hover,.wop_expand,.wop_expand:hover,.read-more,.read-more:hover{color:'.$textcolor.';}.wop_overlay{background : '.$overlayColor.'}.wop_overlay a,.wop_overlay a:hover,.wop_overlay p{color:'.$textcolor.';}</style>';
			
			} 
			echo '<style>.product_price_markup_container a{color:#515151;}.fc-hovereffect-caption img{float:left}.fc-ihep-custom-markup{margin-bottom:20px;}'.$this->dbsettings['custom_ihep_css'].'</style>';
		 
		 }
		 	
		function show_information($settings, $value) {
			
			return '<div class="image_hover_effect_image_src_desc">
			<div class="fc-logo-wrapper"><img class="fc-small-logo" src="'.FC_CORE_URL.'core-assets/images/wp-poet.png'.'" style="float:left;"></div><p>
			1) '.__('Upload Custom Image - This option is for using custom image.',WOP_TEXT_DOMAIN).'<br>
			2) '.__('Post Id- Specifying a post id will automatically return the image url of featured image of that post.',WOP_TEXT_DOMAIN).'<br>
			3) '.__('Attachment Id - If you want to show any image by its attachment id, pass id.',WOP_TEXT_DOMAIN).'</p></div>';
			
		 }
		 
		function hook_in_foot() { 
			
			$dbdata = $this->dbsettings;
			include(WOP_MODEL.'customization-tools/customization-tools.php');
			global $screen;
			$screen = get_current_screen();
			
			$backendPages = array('wp-overlays_page_ihep_effects_settings',
						          'wp-overlays_page_ihep_manage_settings');
		
			$ihover = new Ihover_Circular_Image_Hover_Effects();
			$square = new Class_Square_Image_Hover_Effects();
			?>
			<script type="text/javascript">
				var ihover_effects_array = <?php echo json_encode($ihover->effects) ?>;
				var square_imagehover_array = <?php echo json_encode($square->effects) ?>;
			</script>	
			<?php	
			
			if( in_array($screen->base, $backendPages) ) {
			?>
			<style>
			.image_hover_effect_image_src_desc {margin-bottom:20px;}
			.fc-small-logo{float:left;width:65px;height:65px;margin-right:10px;float:left;}
			</style>
			
			<?php
				
				include(WOP_MODEL.'customization-tools/content-customization-fields.php');		
				$modal = '<div class="modal_set_effect_container">
				<div id="modal_set_effect" class="modal fade" role="dialog">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Set Effect As Default Effect</h4>
					  </div>
					  <div class="modal-body">
					  <div class="fc-divider">
						<div class="fc-12">
					  <div class="update_success">Here</div>	
					  </div>
					  </div>
						<div class="fc-divider">
							<div class="fc-6 tools-to-customise">
								<div class="effect_default_custom_overlay_tools toolsbyeffect">'.$tools_for_default_effect.'</div>
								<div class="one_color_control effect_ihover-circular_tools toolsbyeffect">'.$circle_tools.'</div>
								<div class="effect_square-imagehover_tools toolsbyeffect" style="display:none;"><div class="square-imagehover-tools">'.$square_imagehover_tools.'</div></div>
							</div>
							<div class="fc-6 dynamic-preview">
								<div class="effect_instant_preview"></div>
								<input type="hidden" id="overlay_color_changed" name="overlay_color_changed" value="no">
							</div>
						</div>
						<div class="fc-divider default-data-area">
						<div class="fc-12">
						'.$default_data.'
						<div class="perform_action">
						   <a class="set_effect_as_final_effect fc-btn-orange fc-btn-big">Save Settings</a>
						   <div class="ajax_loader"><img src="'.WOP_IMAGES.'loader.gif" width="50"></div>
						   </div>
						</div>
						</div>
						<div class="fc-divider">
						<div class="fc-12">
						   
					  </div>
					  </div>
					  </div>
					  </div>
				  </div>
				</div>
				</div><input type="hidden" id="animation_speed_changed" name="animation_speed_changed" value="no">
				<input type="hidden" id="current_hover_effecttype" name="current_hover_effecttype" value="">
				<input type="hidden" id="current_hover_effect" name="current_hover_effect" value="">
				<input type="hidden" id="current_in_effect" name="current_in_effect" value="">
				<input type="hidden" id="current_out_effect" name="current_out_effect" value="">
				<input type="hidden" id="animation_speed_changed" name="animation_speed_changed" value="no">';
				echo $modal;	
			}			  
			?>
			<link rel="stylesheet" href="<?php echo WOP_CSS.'bootstrap-modal.css'; ?>">
			
			<?php
		 }
		 
		 function custom_changes_on_save_operation($pre_save_data) {
			
			$fields_to_modify = array('overlay_color','slide_text_position',
									  'animation_speed','overlay_width',
									  'overlay_height','opacity_value','overlay_content');
			foreach($fields_to_modify as $field) {
				
				if($field == 'overlay_content') {
					$encoded = $pre_save_data['hidden_'.$field];
					$pre_save_data['hidden_'.$field] = unserialize(base64_decode($encoded));
				}
				$pre_save_data[$field] = $pre_save_data['hidden_'.$field];
				unset( $pre_save_data['hidden_'.$field] );
			}						  
			$final_data = $pre_save_data;
			$design_wise_default_content = array('default_imagehover_effects' => '{post_title}<br>{categories}',
												   'scalable_imagehover_effects' => '<h2>{post_title}</h2><p>{post_excerpt}</p>',
												   'ihover-circular' => '<h3>{post_title}</h3><p>{post_excerpt}</p>',
												   'square-imagehover' => '<h3>{post_title}</h3><p>{post_excerpt}</p>',
												   'image-magnifier' => '' );
												   
			$final_data['design_wise_default_content'] = $design_wise_default_content; 
										 
			$final_data['post_type_wise_effects'] = $this->dbsettings['post_type_wise_effects'];
			return $final_data;
			
		}
		
		function hovereffect_mask_html( $html, $post_id, $post_image_id ) {
			
			error_reporting( E_ERROR | E_PARSE );
			if(is_admin() or empty($post_image_id))
			return $html;
			
			$post_type = get_post_type();
			$post_type_wise = $this->dbsettings['post_type_wise_effects'][$post_type];
			$category_effect_assigned = false;
			$taxonomies = get_taxonomies('','names');
			$allterms = wp_get_post_terms($post_id, $taxonomies);
			if(count($allterms) > 0){
				foreach($allterms as $term) {
					$enable_effect = get_term_meta( $term->term_id, 'enable_hover_effect', true );
					$enable_hover = get_term_meta( $term->term_id, 'image-hover-effect', true );
					if($enable_effect == 'yes' and !empty($enable_hover)){
						$category_effect_assigned = true;
						break;	
					}
			    }
			}
			
			$use_post_specific_effect = get_post_meta($post_id,'use-post-specific-effect',true);
			if( (empty($post_type_wise['hovereffecttype']) or $post_type_wise['enable_effect'] == 'no') and $category_effect_assigned == false and $use_post_specific_effect != 'yes')
			return $html;
			
			$disable_hover_effect = get_post_meta($post_id,'disable-hover-effect',true);
			if($disable_hover_effect == 'yes')
			return $html;
			
			$img_attr_str = '';
			$storeAttributes = array();
			preg_match_all('/(width|height)=("[^"]*")/i',$html, $storeAttributes[$html]);
			if(!empty($storeAttributes[$html][0])) {
				  $img_attr_str = base64_encode( json_encode($storeAttributes[$html][0]) );
			}
			
			$data = $this->dbsettings;
			$overlay_content = $data['overlay_content'][ $post_type ];
			if ( ! $data ) {
			 $overlay_content = '<a  class="wop_expand" style="color:#dynamic_color#" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">'.get_the_title( $post_id ).'</a>';
			}
			
			if ( is_front_page() )
			$current_status = 'post_listing'; 

			if ( is_single( $post_id ) or is_page( $post_id ) )
			$current_status = 'single_post';

			if ( is_archive() )
			$current_status = 'archieves_page';
				
			if ( ! empty( $data['apply_on'][ $post_type ] ) ) {
					
				if ( in_array( trim($current_status), $data['apply_on'][ $post_type ] ) )
				{
					
						$for_current_post = $this->dbsettings['post_type_wise_effects'][$post_type];
						$hovereffecttype_for_current_post = $for_current_post['hovereffecttype']; 
						$effect_for_current_post = $for_current_post['effect'];
						$slide_effect_for_current_post = $for_current_post['slide_effect'];
						$slide_effect_exit_for_current_post = $for_current_post['slide_effect_exit']; 
						$overlay_color = $this->dbsettings['post_type_wise_effects'][$post_type]['overlay_color'];
						$priorityOverlay = get_post_meta($post_id,'use_as_priority_overlay',true); 
						if(!empty($priorityOverlay))
						$overlay_color = get_post_meta($post_id,'featured-image-overlay-color',true);

						$overlayWidth = $for_current_post['overlay_width'];
						$overlayHeight = $for_current_post['overlay_height']; 
						$animationSpeed = $for_current_post['animation_speed'];
						$opacity = ($for_current_post['opacity_value'] / 100);
						$textPosition = $for_current_post['slide_text_position'];

						if($hovereffecttype_for_current_post == 'default_imagehover_effects'){
						
						$content = do_shortcode( '[hovereffect post_thumbnail = "yes" hovereffecttype = '.$hovereffecttype_for_current_post.' in='.$slide_effect_for_current_post.' out='.$slide_effect_exit_for_current_post.' speed='.(10 -$animationSpeed).' color='.$overlay_color.' opacity='.$opacity.' text_position='.$textPosition.' height='.$overlayHeight.' width='.$overlayWidth.'  post_id='.$post_id.' img_attr_str = '.$img_attr_str.' ]'.stripcslashes( $overlay_content ).'[/hovereffect]' );

						}
						else{

							if(!empty($overlay_content)){
								$finalcontent = $overlay_content;
							}else{
								$postObj = get_post($post_id);
								$finalcontent = $postObj->post_content;	
							}

							$effect_for_current_post = maybe_unserialize($effect_for_current_post);
							if(!empty($effect_for_current_post['text_color']))
							$text_color = $effect_for_current_post['text_color'];
							else
							$text_color = '#ffffff';
							if(!empty($effect_for_current_post['opacity']))
							$opacity = $effect_for_current_post['opacity'];
							else
							$opacity = '0.50';
							
							if($opacity > 1)
							$opacity = ($opacity/100);
							
							if(!empty($effect_for_current_post['size']))
							$size = $effect_for_current_post['size'];
							else
							$size = '220';
							
							if(is_array($effect_for_current_post)){
							$effect_for_current_post = $effect_for_current_post['effect'];
							}
							
							$content = do_shortcode( '[hovereffect post_thumbnail = "yes" hovereffecttype = '.$hovereffecttype_for_current_post.' effect = '.$effect_for_current_post.' post_id='.$post_id.' img_attr_str='.$img_attr_str.' size = '.$size.' opacity='.$opacity.' text_color='.$text_color.']'.stripcslashes( $finalcontent ).'[/hovereffect]' );
						}
					
				
				} else { 
					
					return $html;
				}
					
			} 
			else {
				return $html;
			}
			
			$container_style = 'margin:0 auto;';
			if(!empty($storeAttributes[$html][0])){
				foreach($storeAttributes[$html][0] as $styleattr) {
					$styleattr = str_replace('"','',$styleattr);
					$res = explode('=',$styleattr);
					$container_style .= $res[0].':'.$res[1].'px;';
					
				}
			}
			//'.$container_style.'
			$content = '<div class="fc-ihep-custom-markup" style="max-width:100%;">'.$content.'</div>';
			
			if ( is_front_page() )
			return '</a>'.$content;

			if ( is_single( $post_id ) or is_page( $post_id ) )
			return $content;
			
			if ( is_archive() )
			return '</a>'.$content;
			
			return $content;

		}
		
		function hovereffect_custom_display($atts, $content = '') {
				
			error_reporting( E_ERROR | E_PARSE );
			global $post;
			$change_according_to_post;
			$posttype = $post->post_type;
			
			if(isset($atts['category_wise']) and $atts['category_wise']=='yes')
			$category_wise_content = $content;
			
			if(isset($atts['post_id']) and $atts['post_id']!= $post->ID) {
				$postdata = get_post($atts['post_id']);
				if($postdata) {
				    $posttype = $postdata->post_type;
				    $for_current_post = $this->dbsettings['post_type_wise_effects'][$posttype];
				    if(!isset($atts['speed'])) { 
				      $atts['speed'] = 10 - $for_current_post['animation_speed']; 
				    }
				    if(empty($content) ){
						
						if( $for_current_post['hovereffecttype'] == 'default_imagehover_effects') {
				     		$content = $this->dbsettings['overlay_content'][ $posttype ];
					    }else{
							$content = stripslashes($postdata->post_content);
						}
					}
					if(!isset($atts['hovereffecttype']))	
					$atts['hovereffecttype'] = $for_current_post['hovereffecttype'];
					if(!isset($atts['effect']))	
					$atts['effect'] = $for_current_post['effect'];
			    }
				
			}
			
			$for_current_post = $this->dbsettings['post_type_wise_effects'][$posttype];
			$hovereffecttype_for_current_post = $for_current_post['hovereffecttype']; 
			$effect_for_current_post = $for_current_post['effect'];
			$slide_effect_for_current_post = $for_current_post['slide_effect'];
			$slide_effect_exit_for_current_post = $for_current_post['slide_effect_exit']; 
			$overlay_color = $for_current_post['overlay_color'];
			$priorityOverlay = get_post_meta($post->ID,'use_as_priority_overlay',true); 
			if($priorityOverlay == 'true')
			$overlay_color = get_post_meta($post->ID,'featured-image-overlay-color',true);
			
			if($atts['hovereffecttype'] == 'ihover-circular' and isset($atts[0]))
			$atts['effect'] = $atts['effect'].' '.$atts[0];
			
			
			if($atts['hovereffecttype'] == 'square-imagehover'){ //Sp Case
				
			   if(isset($atts[1]))	
			   $atts['effect'] = $atts['effect'].' '.$atts[0].' '.$atts[1];
			   if(isset($atts['src']) and $atts['src']=='{image_path}'){
			   $effectinfo = $atts;
			   }
			   else{  
			   $effectinfo = unserialize($atts);
		       }
			   $effect_for_current_post = $effectinfo['effect'];
			   $overlay_color = $effectinfo['overlay_color'];
			   $heading_color = $effectinfo['heading_color'];
			   $heading_bg_color = $effectinfo['heading_bg_color'];
			   $desc_color = $effectinfo['desc_color'];
			   
			}else if($atts['hovereffecttype'] == 'ihover-circular'){
				
				if ( is_front_page() or is_single() or is_page() or is_archive() ){
					$for_current_post = $this->dbsettings['post_type_wise_effects'][$posttype]['effect'];
					$effectinfo = unserialize($for_current_post);
					$effect_for_current_post = $effectinfo['effect'];
					$overlay_color = $effectinfo['overlay_color'];
					$border_color_one = $effectinfo['border_color_one'];
					$border_color_two = $effectinfo['border_color_two'];
				}else{
					
					$overlay_color = $atts['color'];
					$border_color_one = $atts['border_color_one'];
					$border_color_two = $atts['border_color_two'];
					
				}
				
			}
			
			$overlayWidth = $for_current_post['overlay_width'];
			$overlayHeight = $for_current_post['overlay_height']; 
			$animationSpeed = $for_current_post['animation_speed'];
			$default_effect_type = $for_current_post['default_effect_type'];
			$gradient_color_one = $for_current_post['gradient_color_one'];
			$gradient_color_two = $for_current_post['gradient_color_two'];
			$gradient_color_direction = $for_current_post['gradient_color_direction'];
			$textColor = $atts['text_color'];
			if(empty($textColor))
			$textColor = (!empty($for_current_post['text_color'])) ? $for_current_post['text_color'] : '#ffffff'; 
			
			if($hovereffecttype_for_current_post == 'default_imagehover_effects')
			$opacity = ($for_current_post['opacity_value'] / 100);
			else
			$opacity = 0.5;
			$text_position = $for_current_post['slide_text_position'];
			
			if(!empty($atts['opacity']))
			$opacity = $atts['opacity'];
						
			$res = extract( shortcode_atts( array(
				'hovereffecttype' => $hovereffecttype_for_current_post,
				'effect' => $effect_for_current_post,
				'square_effect'=> '',
				'circle_effect'=> '',
				'width' => $overlayWidth,
				'height' => $overlayHeight,
				'color' => $overlay_color,
				'text_color' => $textColor,
				'speed' => $animationSpeed,
				'in' => $slide_effect_for_current_post,
				'out' => $slide_effect_exit_for_current_post,
				'opacity' => $opacity,
				'text_position' => $text_position,
				'src' => '',
				'class_on_image' => '',
				'post_id' => '',
				'attachment_id' => '',
				'magnifier_src' => '',
				'img_attr_str' => '',
				'overlay_color' => $overlay_color,
				'heading_color' => $heading_color,
				'heading_bg_color' => $heading_bg_color,
				'desc_color' => $desc_color,
				'border_color_one' => $border_color_one,
				'border_color_two' => $border_color_two,
				'post_thumbnail' => 'no',
				'for_settings_page' => 'no',
				'size' => '220'
			),$atts));
			
			$via_static_shortcode = 'no';
			
			if($is_shortocode_vc == 'no' and $via_caption_image == 'no' and $post_thumbnail == 'no')
			$via_static_shortcode = 'yes';
			
			if((int)$opacity > 1)
			$opacity = ($opacity / 10);
			
			if(!isset($atts['hovereffecttype']))
			$hovereffecttype = 'default_imagehover_effects';
			
			self::$currentDesign = $hovereffecttype;
			
			if ( ! empty( $color ) ) {
      			list($r, $g, $b) = sscanf( $color, '#%02x%02x%02x' );
				$bg = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
			}
			
			if($hovereffecttype == 'default_imagehover_effects'){
				list($r, $g, $b) = sscanf( $color, '#%02x%02x%02x' );
				$color = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
			}
			
			if( $hovereffecttype == 'ihover-circular'){
				
				$with_overlay = array('effect2 left_to_right','effect2 right_to_left','effect2 top_to_bottom','effect2 bottom_to_top','effect19','effect17','effect13 bottom_to_top','effect13 top_to_bottom','effect13 from_left_and_right');
				list($r, $g, $b) = sscanf( $color, '#%02x%02x%02x' );
				if(!empty($atts['opacity']))
				$bg = 'rgba('.$r.','.$g.','.$b.','.$atts['opacity'].')';
				else
				$bg = 'rgba('.$r.','.$g.','.$b.',0.50)';
			}
				
			if ( ( $post_id and '' == $src ) or $src=='{image_path}') {
				$thumb_id = get_post_thumbnail_id( $post_id );
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, '', true );
				$src = $thumb_url_array[0];
			}
			
			if ( $attachment_id ) { 
				$thumb_id = get_post_thumbnail_id( $attachment_id );
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, '', true );
				$src = $thumb_url_array[0];
     		} 
			
			if(isset($atts['category_wise']) and $atts['category_wise']=='yes') {
			    $content = $category_wise_content;
		    }
			
			if ( $post_id > 0 and '' != $content ) {
			     $content = self::overlay_render_content( $content,$post_id );
			} elseif ( '' == $content and $post_id > 0 ) { 
				if(isset($atts['post_id']))
				$content = self::overlay_render_content( $content,$post_id );
				
			} else {
				$content = self::overlay_render_content( $content,'' );
			}
						
			if ( $atts['post_feature_image'] ) {
				$image = $atts['post_feature_image'];
			} 
			else {
				$image = '<img src="'.$src.'" class="'.$class_on_image.'" />';
				$image = apply_filters( 'hovereffect_image',$image,$src,$class_on_image,$post_id );
			}

			$content = apply_filters( 'hovereffect_content',$content,$post_id );
			$mark_up_class = '';
				
					switch ($hovereffecttype) {
						case 'default_imagehover_effects':
							  $mark_up_class = 'Default_Image_Hover_Effects';
							  break;
						case 'square-imagehover':
							  $mark_up_class = 'Class_Square_Image_Hover_Effects'; 	
							  break;	  
						case 'ihover-circular':
							  $mark_up_class = 'Ihover_Circular_Image_Hover_Effects'; 	
							  break;
							  
						default:
							$mark_up_class = 'Default_Image_Hover_Effects';
					}
					
				if( class_exists( $mark_up_class ) ) {
						
				   $obj = new $mark_up_class;
		
				   if($hovereffecttype == 'default_imagehover_effects') {
						
					 if($speed == 0)
					 $speed = '0.50'; //Fallback
					
					 if($default_effect_type == 'multi') {
						 
						 $data = array('in' => $in,'out' => $out,'width'=>$width,'height'=>$height,
								 'color'=>$color,'text_color' => $textColor,
								 'speed' => $speed,'text_position' => $text_position,
								 'image'=>$src,'class' => $class_on_image,'opacity' => $opacity,
								 'default_effect_type' => $default_effect_type,
								 'gradient_color_one' => $gradient_color_one,
								 'gradient_color_two' => $gradient_color_two,
								 'gradient_color_direction' => $gradient_color_direction,
								 'content' => stripcslashes( $content ),'postid' => $post_id,
								 'posttype' => $posttype,
								 'posttitle' => get_the_title( $post_id),
								 'permalink' => get_permalink( $post_id ),
								 'img_attr_str' => $img_attr_str,
								 'is_shortocode_vc' => $is_shortocode_vc,
								 'via_caption_image' => $via_caption_image,
								 'post_thumbnail' => $post_thumbnail,
								 'via_static_shortcode' => $via_static_shortcode );
								 
					 }else{
						 
							     $data = array('in' => $in,'out' => $out,'width'=>$width,'height'=>$height,
								 'color'=>$color,'text_color' => $textColor,
								 'speed' => $speed,'text_position' => $text_position,
								 'image'=>$src,'class' => $class_on_image,'opacity' => $opacity,
								 'content' => stripcslashes( $content ),'postid' => $post_id,
								 'posttype' => $posttype,
								 'posttitle' => get_the_title( $post_id),
								 'permalink' => get_permalink( $post_id ),
								 'img_attr_str' => $img_attr_str,
								 'is_shortocode_vc' => $is_shortocode_vc,
								 'via_caption_image' => $via_caption_image,
								 'post_thumbnail' => $post_thumbnail,
								 'via_static_shortcode' => $via_static_shortcode,
								 'via_post_specific' => $via_post_specific );
					
					 }
			    		
					} else {
					   
						if(empty($effect) or $effect == '0')
						$effect = $effect_for_current_post;
		    
					   $data = array('width'=>$width,'height'=>$height,'color'=>$bg,
								 'image'=>$src,'class_on_image' => $class_on_image,
								 'content' => stripcslashes( $content ),'postid' => $post_id,
								 'opacity' => $opacity,'text_color' => $textColor,
								 'posttype' => $posttype,
								 'posttitle' => get_the_title( $post_id),
								 'permalink' => get_permalink( $post_id ),
								 'currenteffect' => $effect,
								 'magnifier_src' => $magnifier_src,
								 'img_attr_str' => $img_attr_str,
								 'overlay_color' => $overlay_color,
								 'text_color' => $textColor,
								 'heading_color' => $heading_color,
								'heading_bg_color' => $heading_bg_color,
								'desc_color' => $desc_color,
								'border_color_one' => $border_color_one,
								'border_color_two' => $border_color_two,
								'is_shortocode_vc' => $is_shortocode_vc,
								'via_caption_image' => $via_caption_image,
								'post_thumbnail' => $post_thumbnail,
								'via_static_shortcode' => $via_static_shortcode,
								'via_post_specific' => $via_post_specific,
								'size' => $size);
							
					}					
					 					
					if(isset($atts['category_wise']) and $atts['category_wise']=='yes'){
					 $data['content'] = stripcslashes($content);
					 $data['content_via_category'] = 'yes';
				    }
												 
					$overlay_placeholder = $obj->get_hover_effect_markup($data);			 
					if( $hovereffecttype != 'ihover-circular')
						$overlay_placeholder .= '<div style="clear:both;"></div>';	
					}

				    $overlay_placeholder = apply_filters( 'ihep_hovereffect_html',$overlay_placeholder,$data,$post_id );

				    return $overlay_placeholder;

		}
		
		function custom_excerpt($content,$limit) {
		 
		  $excerpt = explode(' ', $content, $limit+1);
		  if (count($excerpt)>=$limit) {
			array_pop($excerpt);
			$excerpt = implode(" ",$excerpt).'...';
		  } else {
			$excerpt = implode(" ",$excerpt);
		  } 
		  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
		  return $excerpt;
		  
		}
    
		/**
		 * Replace Placholders with Post Data.
		 * @param  string $overlay_content Placeholder Content.
		 * @param  int    $post_id         Post ID.
		 * @return string               Replaced Placeholder Content.
		 */
		static function overlay_render_content($overlay_content, $post_id) {

			$designWiseExcerptLength =   array('default_imagehover_effects' => '20',
											   'scalable_imagehover_effects' => '15',
											   'ihover-circular' => '4',
											   'square-imagehover' => '4'  );
			if(is_admin())
			$excerptLimit = 5; //For Backend
			else
			$excerptLimit = $designWiseExcerptLength[self::$currentDesign];	//For Front							   
												  
			$designWiseExcerptLength = apply_filters( 'design_wise_excerpt_length', $designWiseExcerptLength );
				
			$categories = get_the_category($post_id);
			$separator = ' ';
			$output = '';
			
			if ( ! empty( $categories ) and get_post_type($post_id) != 'product' ) {
				foreach( $categories as $category ) {
					$output .= '<a style="color:#dynamic_color#" class="category_link" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', WOP_TEXT_DOMAIN ), $category->name ) ) . '">' . esc_html( '#'.$category->name ) . '</a>'. ' ';
				}
				$cat = trim( $output, $separator );
			}
			
			$tag_output = '';
			$posttags = get_the_tags($post_id);
			
			if ( !empty($posttags) ) {
			  foreach($posttags as $tag) {
				$tag_output .= '<a style="color:#dynamic_color#" class="tag_links" href="' . esc_url( get_tag_link($tag->term_id) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', WOP_TEXT_DOMAIN ), $tag->name ) ) . '">' . esc_html( '#'.ucwords($tag->name) ) . '</a>'. ' '; 
			  }
			}
			
			$overlay_content = str_replace( '{categories}',$cat,$overlay_content );
			
			$overlay_content = str_replace( '{tags}',$tag_output,$overlay_content );

			if(self::$currentDesign == 'ihover-circular' or self::$currentDesign =='square-imagehover'){
				$title = get_the_title( $post_id );
			}else{
				$title = '<a class="wop_expand" style="color:#dynamic_color#" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">'.get_the_title( $post_id ).'</a>';
					
			}
			
			$title = apply_filters( 'hovereffect_post_title',$title,$post_id );
			
			$overlay_content = str_replace( '{post_title}',$title,$overlay_content );

			$title_link = apply_filters( 'hovereffect_post_link',get_permalink( $post_id ),$post_id );
			
			$overlay_content = str_replace( '{post_link}',$title_link,$overlay_content );
			
			$excerpt = get_the_excerpt( $post_id );								  
			if(empty($excerpt)) {
				
				$post_object = get_post( $post_id );
				$excerpt = $post_object->post_content;
					
			}
			
			$excerpt = self::custom_excerpt( $excerpt,$excerptLimit );
			$excerpt = apply_filters( 'hovereffect_post_excerpt',$excerpt,$post_id );
			$overlay_content = str_replace( '{post_excerpt}', $excerpt,$overlay_content );
			$read_more = '<a  style="color:#dynamic_color#" class="read-more" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">Read more</a>';
			$read_more = apply_filters( 'hovereffect_post_readmore', $read_more,$post_id );
			$overlay_content = str_replace( '{read_more}',$read_more,$overlay_content );
			$link = get_permalink( $post_id );
			$title = esc_attr( get_the_title( $post_id ) );
			$overlay_content = do_shortcode( $overlay_content );
			$overlay_content = self::wp_apply_custom_fields( $overlay_content,$post_id );
			$overlay_content = self::wp_apply_taxonomies( $overlay_content,$post_id );
			return $overlay_content;

		}
		/**
		 * Display taxonomies on Hover Effect.
		 * @param  string $content Placeholder Content.
		 * @param  int    $post_id Post ID.
		 * @return string          Replaced Placeholder Content.
		 */
		function wp_apply_taxonomies($content, $post_id) {

			global $wp_query;
			preg_match_all( '/{\s*(.*?)\s*}/', $content, $matches );
			$separator = apply_filters( 'wop_taxonomies_seperator',',' );
			if ( isset( $matches[0] ) ) {
				foreach ( $matches[0] as $k => $m ) {
					$post_meta_key = $matches[1][ $k ];
					$cat = '';
					$output = '';
					$categories = get_the_terms( $post_id,$post_meta_key );
					if ( $categories and  !is_wp_error( $categories ) ) {
						
						foreach ( $categories as $category ) {
							$output .= '<a style="color:#dynamic_color#" class="category_link" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( 'View all posts in %s',WOP_TEXT_DOMAIN ), $category->name ) ) . '">'.$category->name.'</a>'.$separator;
						}
						$cat = trim( $output, $separator );
					}
					$content = str_replace( "$m", $cat, $content );
				}
			}
			
			return $content;

		}
		/**
		 * Display custom fields on Hover Effect.
		 * @param  string $content Placeholder Content.
		 * @param  int    $post_id Post ID.
		 * @return string          Replaced Placeholder Content.
		 */
		function wp_apply_custom_fields($content, $post_id) {

			global $wp_query;

			preg_match_all( '/\{\%\s*(.*?)\s*\%\}/', $content, $matches );

			if ( isset( $matches[0] ) ) {
				foreach ( $matches[0] as $k => $m ) {
					$post_meta_key = $matches[1][ $k ];
					$meta_value = get_post_meta( $post_id, $post_meta_key, true )? get_post_meta( $post_id, $post_meta_key, true ) : '';
					$content = str_replace( "$m", $meta_value, $content );
				}
			}

			return $content;

		}


		/**
		 * Ajax Call
		 */
		function wop_ajax_call() {

			check_ajax_referer( 'wop-call-nonce', 'nonce' );
			$operation = sanitize_text_field( wp_unslash( $_POST['operation'] ) );
			$value = wp_unslash( $_POST );
			if ( isset( $operation ) ) {
				$this->$operation($value);
			}
			exit;
		}
		
		function custom_hidden_fields($settings, $value){
		    	
		  return '<input type="hidden" name="' . esc_attr( $settings['param_name'] ) . '" value="'.$value.'" class="'.$settings['param_name'].'">';	
		}
		 
		function disable_effect_for_post_type(){
			
			$disable_for_post_type = $_POST['for_post_type'];
			$response = array('status' => 1,'msg' => __('Hover Effect Removed For Post Type '.ucfirst($disable_for_post_type), WOP_TEXT_DOMAIN ),'posted' => $_POST );
			$data_replica = $this->dbsettings;
			$data_replica['post_type_wise_effects'][$disable_for_post_type]['enable_effect'] = 'no';
			update_option('wp-ihep-settings',$data_replica);
			echo json_encode($response);
			exit;
		} 
		
		function post_type_wise_effects() {
			
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);

			$output = 'names'; 
			$operator = 'and';
			$post_types = get_post_types( $args, $output, $operator ); 
			$commonInitials = array('enable_effect' => 'no',
									'hovereffecttype' => '',
									'effect' => '',
									'slide_effect' => '',
									'slide_effect_exit' => '',
									'overlay_color'   => '#000000',
									'opacity_value' => 50,
									'overlay_width' => 100,
									'overlay_height' => 100,
									'slide_text_position' => 'overlay_center',
									'animation_speed' => '9');
									
			$postInitials = array('enable_effect' => 'no',
									'hovereffecttype' => '',
									'effect' => '',
									'slide_effect' => '',
									'slide_effect_exit' => '',
									'overlay_color'   => '#000000',
									'opacity_value' => 50,
									'overlay_width' => 100,
									'overlay_height' => 100,
									'slide_text_position' => 'overlay_center',
									'animation_speed' => '9');
									
			$productInitials = 	array('enable_effect' => 'no',
									'hovereffecttype' => '',
									'effect' => '',
									'slide_effect' => '',
									'slide_effect_exit' => '',
									'overlay_color'   => '#000000',
									'opacity_value' => 50,
									'overlay_width' => 100,
									'overlay_height' => 100,
									'slide_text_position' => 'overlay_center',
									'animation_speed' => '9',
									'overlay_content' => array('{post_title}
																{add_to_cart}'));											
									 
			$all_post_types = array('post' => $postInitials ,'page' => $commonInitials,'product' => $productInitials);
			foreach($post_types as $key => $posttype){
				
				if($key != 'product')
				$all_post_types[$key] = $commonInitials;
			}
			
			return $all_post_types;
		} 
		
		function _init() {
			
			$args = array(
			   'public'   => true,
			   '_builtin' => false
			);
			$output = 'names'; 
			$operator = 'and';
			$post_types = get_post_types( $args, $output, $operator ); 
			$all_post_types = array('post','page');
			foreach( $post_types as $postype) {
				$all_post_types[] = $postype;
			}
			
			self::$all_post_types = $all_post_types;
			
			global $wpdb;
			add_action( 'admin_menu', array( $this, 'create_menu' ) );
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'wop_frontend_scripts' ) );
			}
			
		}
		
		/**
		 * Eneque scripts at frontend.
		 */
		function wop_frontend_scripts() {

			$scripts = array();
			wp_enqueue_script( 'jquery' );

			$scripts[] = array(
			'handle'  => 'wop-frontend',
			'src'   => WOP_JS.'frontend.js',
			'deps'    => array(),
			);

			$where = apply_filters( 'wop_script_position', true );
			if ( $scripts ) {
				foreach ( $scripts as $script ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], '', $where );
				}
			}

			$get_data = $this->dbsettings;
			$wop_js_lang = array();
			$wop_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wop_js_lang['nonce'] = wp_create_nonce( 'wop-call-nonce' );
			$wop_js_lang['confirm'] = __( 'Are you sure to delete item?',WOP_TEXT_DOMAIN );
			$wop_js_lang['opacity_value'] = $get_data['opacity_value'];
			$wop_js_lang['overlay_width_value'] = $get_data['overlay_width'];
			$wop_js_lang['overlay_height_value'] = $get_data['overlay_height'];
			$wop_js_lang['slide_effect'] = '';
			$wop_js_lang['slide_effect_exit'] = '';
			$wop_js_lang['animation_speed'] = $get_data['animation_speed'];
			$wop_js_lang['show_on_pageload'] = (isset($get_data['show_on_pageload'])) ? $get_data['show_on_pageload']: '';
			$wop_js_lang['show_always'] = (isset($get_data['show_always'])) ? $get_data['show_always'] : '';
			wp_localize_script( 'wop-frontend', 'settings_obj', $wop_js_lang );
			$frontend_styles = array();

			if ( $frontend_styles ) {
				foreach ( $frontend_styles as $frontend_style_key => $frontend_style_value ) {
					wp_enqueue_style( $frontend_style_key, $frontend_style_value );
				}
			}
		}

		function processor() {
			error_reporting( E_ERROR | E_PARSE );

			$return = '';
			if ( isset( $_GET['page'] ) ) {
				$page = sanitize_text_field( wp_unslash( $_GET['page'] ) );
			} else {
				$page = 'ihep_view_overview';
			}

			$pageData = explode( '_', $page );

			if ( 'ihep' != strtolower( $pageData[0] ) ) {
				return;
			}
			$obj_type = $pageData[2];
			$obj_operation = $pageData[1];

			if ( count( $pageData ) < 3 ) {
				die( 'Cheating!' );
			}

			try {
				if ( count( $pageData ) > 3 ) {
					$obj_type = $pageData[2].'_'.$pageData[3];
				}

				$factoryObject = new WOP_Controller();
				$viewObject = $factoryObject->create_object( $obj_type );
				$viewObject->display( $obj_operation );

			} catch (Exception $e) {
				echo FlipperCode_HTML_Markup::show_message( array( 'error' => $e->getMessage() ) );

			}

		}

		function create_menu() {

			global $navigations;

			$pagehook1 = add_menu_page(
				__( 'WP Overlays', WOP_TEXT_DOMAIN ),
				__( 'WP Overlays', WOP_TEXT_DOMAIN ),
				'wop_admin_overview',
				WOP_SLUG,
				array( $this,'processor' ),
				WOP_URL.'assets/images/fc-small-logo.png'
				
			);

			if ( current_user_can( 'manage_options' )  ) {
				$role = get_role( 'administrator' );
				$role->add_cap( 'wop_admin_overview' );
			}
			$this->load_modules_menu();
			add_action( 'load-'.$pagehook1, array( $this, 'wop_backend_scripts' ) );

		}

		/**
		 * Read models and create backend navigation.
		 */
		function load_modules_menu() {

			$modules = $this->modules;
			$pagehooks = array();
			if ( is_array( $modules ) ) {
				foreach ( $modules as $module ) {

						$object = new $module;
					if ( method_exists( $object,'navigation' ) ) {

						if ( ! is_array( $object->navigation() ) ) {
							continue;
						}

						foreach ( $object->navigation() as $nav => $title ) {

							if ( current_user_can( 'manage_options' ) && is_admin() ) {
								$role = get_role( 'administrator' );
								$role->add_cap( $nav );

							}

							$pagehooks[] = add_submenu_page(
								WOP_SLUG,
								$title,
								$title,
								$nav,
								$nav,
								array( $this,'processor' )
							);

						}
					}
				}
			}

			if ( is_array( $pagehooks ) ) {

				foreach ( $pagehooks as $key => $pagehook ) {
					add_action( 'load-'.$pagehooks[ $key ], array( $this, 'wop_backend_scripts' ) );
				}
			}

		}

		/**
		 * Eneque scripts in the backend.
		 */
		function wop_backend_scripts() {

			wp_enqueue_style( 'wp-color-picker' );
			$wp_scripts = array( 'jQuery', 'wp-color-picker', 'jquery-ui-datepicker','jquery-ui-slider' );

			if ( $wp_scripts ) {
				foreach ( $wp_scripts as $wp_script ) {
					wp_enqueue_script( $wp_script );
				}
			}

			$scripts = array();

			$scripts[] = array(
			'handle'  => 'wop-backend-bootstrap',
			'src'   => WOP_JS.'bootstrap.min.js',
			'deps'    => array(),
			);
			$scripts[] = array(
			'handle'  => 'wop-backend',
			'src'   => WOP_JS.'backend.js',
			'deps'    => array(),
			);
			$scripts[] = array(
			'handle'  => 'select2-script',
			'src'   => WOP_JS.'select2.js',
			'deps'    => array(),
			);
			if ( $scripts ) {
				foreach ( $scripts as $script ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'] );
				}
			}
			$get_data = $this->dbsettings;
			$wop_js_lang = array();
			$wop_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wop_js_lang['nonce'] = wp_create_nonce( 'wop-call-nonce' );
			$wop_js_lang['confirm'] = __( 'Are you sure to delete item?',WOP_TEXT_DOMAIN );
			$wop_js_lang['opacity_value'] = $get_data['opacity_value'];
			$wop_js_lang['overlay_width_value'] = $get_data['overlay_width'];
			$wop_js_lang['overlay_height_value'] = $get_data['overlay_height'];
			$wop_js_lang['slide_effect'] = '';
			$wop_js_lang['slide_effect_exit'] = '';
			$wop_js_lang['animation_speed'] = $get_data['animation_speed'];
			wp_localize_script( 'wop-backend', 'settings_obj', $wop_js_lang );
			wp_register_script( 'flippercode-ui.js', WOP_JS . 'flippercode-ui.js' );
			$core_script_args = apply_filters ('fc_ui_script_args', array(
				'ajax_url' => esc_url(admin_url('admin-ajax.php')),
				'language' => 'en',
				'urlforajax' => esc_url(admin_url('admin-ajax.php')),
				'hide' => __( 'Hide',WOP_TEXT_DOMAIN ),
				'nonce' => wp_create_nonce('fc_communication')
			) );
			wp_localize_script( 'flippercode-ui.js', 'fc_ui_obj', $core_script_args );
			wp_enqueue_script( 'flippercode-ui.js' );
			
			$admin_styles = array(
			'flippercode-bootstrap' => WOP_CSS.'bootstrap-modal.css',
			'flippercode-flippercode-ui-style' => WOP_CSS.'flippercode-ui.css',
			'wop-backend-style' => WOP_CSS.'backend.css',
			'fontawesome-style' => WOP_CSS.'font-awesome.min.css'
			);

			if ( $admin_styles ) {
				foreach ( $admin_styles as $admin_style_key => $admin_style_value ) {
					wp_enqueue_style( $admin_style_key, $admin_style_value );
				}
			}

		}

		/**
		 * Load plugin language file.
		 */
		function load_plugin_languages() {

			load_plugin_textdomain( WOP_TEXT_DOMAIN, false, WOP_FOLDER.'/lang/' );
		}
		/**
		 * Call hook on plugin activation for both multi-site and single-site.
		 * @param  boolean $network_wide IS network activated?.
		 */
		function plugin_activation($network_wide = null) {

			if ( is_multisite() && $network_wide ) {
				global $wpdb;
				$currentblog = $wpdb->blogid;
				$activated = array();
				$sql = "SELECT blog_id FROM {$wpdb->blogs}";
				$blog_ids = $wpdb->get_col( $wpdb->prepare( $sql, null ) );

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->wop_activation();
					$activated[] = $blog_id;
				}

				switch_to_blog( $currentblog );
				update_site_option( 'op_activated', $activated );

			} else {
				$this->wop_activation();
			}
		}
		/**
		 * Call hook on plugin deactivation for both multi-site and single-site.
		 * @param  boolean $network_wide IS network activated?.
		 */
		function plugin_deactivation($network_wide) {

			if ( is_multisite() && $network_wide ) {
				global $wpdb;
				$currentblog = $wpdb->blogid;
				$activated = array();
				$sql = "SELECT blog_id FROM {$wpdb->blogs}";
				$blog_ids = $wpdb->get_col( $wpdb->prepare( $sql, null ) );

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->wop_deactivation();
					$activated[] = $blog_id;
				}

				switch_to_blog( $currentblog );
				update_site_option( 'op_activated', $activated );

			} else {
				$this->wop_deactivation();
			}
		}

		/**
		 * Perform tasks on plugin deactivation.
		 */
		function wop_deactivation() {}

		/**
		 * Perform tasks on plugin deactivation.
		 */
		function wop_activation() {

			global $wpdb;

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$modules = $this->modules;
			$pagehooks = array();

			if ( is_array( $modules ) ) {
				foreach ( $modules as $module ) {
					$object = new $module;
					if ( method_exists( $object,'install' ) ) {
								$tables[] = $object->install();
					}
				}
			}

			if ( is_array( $tables ) ) {
				foreach ( $tables as $i => $sql ) {
					dbDelta( $sql );
				}
			}
			  
			  $common_pages_for_applying = array();
			  $applyOn = array('post' => $common_pages_for_applying,
							   'page' => $common_pages_for_applying,
							   'product' => array() );	
			    	
              $post_type_wise_effects = $this->post_type_wise_effects();
              $design_wise_default_content = array('default_imagehover_effects' => '{post_title}<br>{categories}',
												   'scalable_imagehover_effects' => '<h2>{post_title}</h2><p>{post_excerpt}</p>',
												   'square-imagehover' => '<h3>{post_title}</h3><p>{post_excerpt}</p>',
												   'ihover-circular' => '<h3>{post_title}</h3><p>{post_excerpt}</p>',
												   'image-magnifier' => '' );
              $overlay_data = array(
				 'overlay_color'   => '#000000',
				 'overlay_content' => array('post'=>'<h2>{post_title}</h2><p>{post_excerpt}</p>','page' => '{post_title}<br>{post_excerpt}'),
				 'opacity_value' => 50,
				 'overlay_width' => 100,
				 'overlay_height' => 100,
				 'show_effect_on' => 'pageload',
				 'apply_on' => $applyOn,
				 'slide_text_position' => 'overlay_center',
				 'animation_speed' => '9',
				 'post_type_wise_effects' => $post_type_wise_effects,
				 'design_wise_default_content' => $design_wise_default_content,
				 'custom_ihep_css' => ''
				);
			
			
			if ( get_option( 'wp-ihep-settings' ) === false )
			add_option( 'wp-ihep-settings',  $overlay_data );
			
		}

		/**
		 * Define all constants.
		 */
		private function _define_constants() {

			global $wpdb;

			if ( ! defined( 'WOP_SLUG' ) ) {
				define( 'WOP_SLUG', 'ihep_view_overview' );
			}
			
			if ( ! defined( 'WOP_LITE' ) ) {
				define( 'WOP_LITE', true );
			}

			if ( ! defined( 'WOP_VERSION' ) ) {
				define( 'WOP_VERSION', '1.0.2' );
			}

			if ( ! defined( 'WOP_TEXT_DOMAIN' ) ) {
				define( 'WOP_TEXT_DOMAIN', 'wp-overlays' );
			}

			if ( ! defined( 'WOP_FOLDER' ) ) {
				define( 'WOP_FOLDER', basename( dirname( __FILE__ ) ) );
			}

			if ( ! defined( 'WOP_DIR' ) ) {
				define( 'WOP_DIR', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'WOP_CORE_CLASSES' ) ) {
				define( 'WOP_CORE_CLASSES', WOP_DIR.'core/' );
			}

			if ( ! defined( 'WOP_PLUGIN_CLASSES' ) ) {
				define( 'WOP_PLUGIN_CLASSES', WOP_DIR.'classes/' );
			}

			if ( ! defined( 'WOP_CONTROLLER' ) ) {
				define( 'WOP_CONTROLLER', WOP_CORE_CLASSES );
			}

			if ( ! defined( 'WOP_CORE_CONTROLLER_CLASS' ) ) {
				define( 'WOP_CORE_CONTROLLER_CLASS', WOP_CORE_CLASSES.'class.controller.php' );
			}

			if ( ! defined( 'WOP_MODEL' ) ) {
				define( 'WOP_MODEL', WOP_DIR.'modules/' );
			}

			if ( ! defined( 'WOP_URL' ) ) {
				define( 'WOP_URL', plugin_dir_url( WOP_FOLDER ).WOP_FOLDER.'/' );
			}

			if ( ! defined( 'FC_CORE_URL' ) ) {
				define( 'FC_CORE_URL', plugin_dir_url( WOP_FOLDER ).WOP_FOLDER.'/core/' );
			}
			
			if ( ! defined( 'WOP_INC_URL' ) ) {
				define( 'WOP_INC_URL', WOP_URL.'includes/' );
			}

			if ( ! defined( 'WOP_VIEWS_PATH' ) ) {
				define( 'WOP_VIEWS_PATH', WOP_URL.'view' );
			}

			if ( ! defined( 'WOP_CSS' ) ) {
				define( 'WOP_CSS', WOP_URL.'assets/css/' );
			}

			if ( ! defined( 'WOP_JS' ) ) {
				define( 'WOP_JS', WOP_URL.'assets/js/' );
			}

			if ( ! defined( 'WOP_IMAGES' ) ) {
				define( 'WOP_IMAGES', WOP_URL.'assets/images/' );
			}

			if ( ! defined( 'WOP_FONTS' ) ) {
				define( 'WOP_FONTS', WOP_URL.'fonts/' );
			}

		}

		/**
		 * Load all required core classes.
		 */
		private function _load_files() {

			$coreInitialisationFile = plugin_dir_path( __FILE__ ).'core/class.initiate-core-lite.php';
			if ( file_exists( $coreInitialisationFile ) ) {
			   require_once( $coreInitialisationFile );
			   $plugin_files_to_include = array('wop-form.php',
											 'wop-controller.php',
											 'wop-model.php',
											 'image-hover-effects-pro-builder.php',
											 'default-image-hover-effects.php',
											 'ihover-circular-image-hover-effects.php',
											 'square-image-hover-effects.php');
				foreach ( $plugin_files_to_include as $file ) {
					if(file_exists(WOP_PLUGIN_CLASSES . $file))
					require_once( WOP_PLUGIN_CLASSES . $file ); 
				}
				$core_modules = array( 'overview','settings' );
				if ( is_array( $core_modules ) ) {
					foreach ( $core_modules as $module ) {

						$file = WOP_MODEL.$module.'/model.'.$module.'.php';
						if ( file_exists( $file ) ) {
							include_once( $file );
							$class_name = 'wop_Model_'.ucwords( $module );
							array_push( $this->modules, $class_name );
						}
					}
				} 	
			}else{
				die("Problem Loading Framework");
			}
			
		}
	}
	new WP_Overlays_Pro();	
}
