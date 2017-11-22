<?php
/**
 *
 * @author Flipper Code <hello@flippercode.com>
 * @version 1.0.2
 * @package Wp Overlays Pro
 */
$form  = new WOP_FORM();
echo $form->show_header();
?>
<div class="flippercode-ui">
 <div class="fc-main fc-docs">
  <div class="fc-container">
     <div class="fc-divider ">
		 <div class="fc-back fc-how">
		<div class="fc-12">
			<div class="usage stick_left">
				<div class="fc-title-blue wpihep-heading" style="margin-top:15px;">
					<h4 class="small_heading">
						<?php  _e('How It Works', WFIP_TEXT_DOMAIN ); ?>
					</h4>
			</div>	
			<div class="wpihep-overview wpihep">

<p><b><a class="backend-link" href="<?php echo admin_url('admin.php?page=ihep_manage_settings'); ?>" target="_blank">General settings</a></b><?php _e(' This page is plugin\'s general settings page. From here you can see hover effects that are currently applied on featured images of blog post. You can customize / change effect / remove hover effect.<br><br>',WOP_TEXT_DOMAIN); ?>
<b><a class="backend-link" href="<?php echo admin_url('admin.php?page=ihep_effects_settings'); ?>" target="_blank">Effects Gallery</a></b> <?php _e('This page lists all available image hover effects that can be applied to featured images.',WOP_TEXT_DOMAIN); ?></p>

<p><b><?php _e('Displaying Hover Effect On Custom Image :',WOP_TEXT_DOMAIN) ?> </b>
<?php _e('You need to use shortcode for hovereffect only when hover effect needs to be displayed on custom image with custom content.',WOP_TEXT_DOMAIN); ?>
</p>

<p><b><?php _e(' Hover Effects Types This Plugins Provides: '); ?></b> <?php _e('There are three types of effect types you can apply on featured images of blog post. Effect type is only a type and it has many associated "effects" that can be applied with it.',WOP_TEXT_DOMAIN); ?></p>

<h4 class="alert alert-info fc-title-blue"> 1) <?php _e('Default ImageHover Effect :',WOP_TEXT_DOMAIN); ?></h4>
<div class="wpihep-overview">

<?php _e('This is type of effect in which a custom overlay comes over the image. This overlay is fully customisable with almost every property like overlaycolor,animation speed,width,height,overlay content location,opacity etc. This effect has a "in" effect and a "out" effect. In effect works when we hover mouse over the image and out effect works when the cursor is taken away from image. Below is an example how to use this effect.',WOP_TEXT_DOMAIN);  ?>
<pre style="color: #000000;font-size: 15px;">
[hovereffect hovereffecttype = 'default_imagehover_effects' in='rollIn' out='rollOut' speed='2' color='#8fc91c' text_color="#000000" opacity='0.37' text_position="overlay_center" src="{image_path}" default_effect_type="single"]<?php echo htmlentities('<h2>Heading Goes Here</h2><p>Description Goes Here</p>') ?>[/hovereffect]
</pre>

</div>

<h4 class="alert alert-info fc-title-blue"> 2) <?php _e('Square Imagehover Effects :',WOP_TEXT_DOMAIN); ?></h4>
<div class="wpihep-overview">
 <?php _e('These are the fancy image hover effects which applies very nice square type image hover effects to image when mouse cursor is hovered on image. Below is an example how to use this effect.',WOP_TEXT_DOMAIN); ?>
<pre style="color: #000000;font-size: 16px;">
[hovereffect hovereffecttype = 'square-imagehover' effect = 'colored effect1 left_and_right' overlay_color="#8638f4" src="{image_path}" heading_color="#6b147f" heading_bg_color="#ffffff" desc_color="#e82055"]<?php echo htmlentities('<h3>Heading Goes Here</h3><p>Description Goes Here</p>'); ?>[/hovereffect]
</pre>
</div>
<h4 class="alert alert-info fc-title-blue"> 3) <?php _e('Circular Image Effects :',WOP_TEXT_DOMAIN); ?></h4>
<div class="wpihep-overview">
 <?php _e('These are the fancy circular image effects in which images are displayed in a circular view. Below is a sample shortcode how to use this type of effect.',WOP_TEXT_DOMAIN); ?> 
<pre style="color: #000000;font-size: 16px;">
[hovereffect hovereffecttype = 'ihover-circular' effect = 'effect16 right_to_left' text_color="#ffffff" opacity="0.50" color = '#F4D03F' src="{image_path}" size="250"]<?php echo htmlentities('<h3>Heading Goes Here</h3><p>Description Goes Here</p>'); ?>[/hovereffect]
</pre>
</div>

<p class="supported_placeholders">
<?php _e('Image Hover Effects Pro plugin provides useful placeholders that can be used to show dynamic information on the overlay. Each hovereffects takes some HTML content to display over image which is manageable from backend. You can use below placeholders to display dynamic information within overlay content.',WOP_TEXT_DOMAIN); ?>
</p>

<h3 class="ptheading"><?php _e('Recommended Overlay Markup According To HoverEffect Type'); ?></h3>
<table class="fc-tbl-style">
	<thead><tr><th>Hovereffect Name</th><th>Recommended HTML Markup For Data On Overlay</th></tr></thead>
	<tbody>
		<tr><td>Customizable Overlay Effect</td><td><?php echo htmlentities('<p>{post_title}<br>{categories}</p>'); ?></td></tr>
		<tr><td>Text Effects</td><td><?php echo htmlentities('<h2>{post_title}</h2><p>{post_excerpt}</p>'); ?></td></tr>
		<tr><td>Circular Effects</td><td><?php echo htmlentities('<h3>{post_title}</h3><p>{post_excerpt}</p>'); ?></td></tr>
		<tr><td>Square Effects</td><td><?php echo htmlentities('<h3>{post_title}</h3><p>{post_excerpt}</p>'); ?></td></tr>
		
</tbody>
</table>



<h3 class="ptheading"><?php _e('Useful & Dynamic Placeholders'); ?></h3>
<table class="fc-tbl-style">
	<thead><tr><th>Placeholder Name</th><th>Placeholder Value</th></tr></thead>
	<tbody>
		<tr><td>{title}</td><td>Post Title</td></tr>
		<tr><td>{post_link}</td><td>Post Link</td></tr>
		<tr><td>{post_excerpt}</td><td>Post Excerpt</td></tr>
		<tr><td>{read_more}</td><td>Read More Link</td></tr>
		<tr><td>{%custom_field_name%}</td><td>Custom Field Value</td></tr>
		<tr><td>{category}</td><td>Category</td></tr>
		<tr><td>{post_tag}</td><td>Post Tag</td></tr>
		<tr><td>{post_format}</td><td>Post Format</td></tr>
		</tr>
		
	</tbody>
</table>

<h3 class="ptheading"><?php _e('Shortcode Documentation'); ?></h3>
<div style="clear:both"></div>
<?php

	$table = array();
	$table['heading'] = __('Shortcode and available parameters description :',WOP_TEXT_DOMAIN);
	
	$parameters = array();
	
	
	
	$parameters[] =   array('hovereffecttype',
					  __('Type of hover effect we want to apply.',WOP_TEXT_DOMAIN),
					  __('eg. "default_imagehover_effects"',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('effect',
					  __('Name of effect that we want to use. This parameter is only required when hovereffecttype is not equal to  "default_imagehover_effects". "default_imagehover_effects" take the effects from in and out attribute, rest of hovereffecttype takes effect from this attribute.',WOP_TEXT_DOMAIN),
					  __('eg. "effect_marley"',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('src',
					  __('Url of source image we want to see as overlay background image.',WOP_TEXT_DOMAIN),
					  __('eg. A valid image path.',WOP_TEXT_DOMAIN));
	
	$parameters[] =      array('in',
					  __('Animation class name which must be applied as Starting / In effect. Only required when hovereffecttype = "default_imagehover_effects". ',WOP_TEXT_DOMAIN),
					  __('bounce, flash, pulse, rubberBand, shake, swing, tada, wobble, bounceIn, bounceInDown, bounceInLeft, bounceInRight, bounceInUp, fadeIn, fadeInDown, fadeInDownBig, fadeInLeft, fadeInLeftBig, fadeInRight, fadeInRightBig, fadeInUp, fadeInUpBig, flip, flipInX, flipInY, 
lightSpeedIn, rotateIn, rotateInDownLeft, rotateInDownRight, rotateInUpLeft, rotateInUpRight, rollIn, zoomIn, zoomInDown, zoomInLeft, zoomInRight, zoomInUp',WOP_TEXT_DOMAIN));
		
	$parameters[] =      array('out',
					  __('Animation class name which must be applied as Finishing / Out effect. Only required when hovereffecttype = "default_imagehover_effects".',WOP_TEXT_DOMAIN),
					  __('bounceout, bounceOutDown, bounceOutLeft, bounceOutRight, bounceOutUp, fadeOut, fadeOutDown, fadeOutDownBig, fadeOutLeft, fadeOutLeftBig, fadeOutRight, fadeOutRightBig, fadeOutUp, fadeOutUpBig, flipOutX, flipOutY, lightSpeedOut, rotateOut, rotateOutDownLeft, rotateOutDownRight, rotateOutUpLeft, rotateOutUpRight, rollOut, zoomOut, zoomOutDown, zoomOutLeft, zoomOutRight, zoomOutUp',WOP_TEXT_DOMAIN)); 
	

	$parameters[] =   array('text_position',
					  __('Class name for position of content in overlay. Only required when hovereffecttype = "default_imagehover_effects". ',WOP_TEXT_DOMAIN),
					  __('overlay_center,overlay_top_left,overlay_top_right , overlay_bottom_left , overlay_bottom_right',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('color',
					  __('Color for Overlay in Hexformat. Only required when hovereffecttype = "default_imagehover_effects". ',WOP_TEXT_DOMAIN),
					  __('Any Hexaformat Color value Eg. #ffffff',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('width',
					  __('Width of overlay. Only required when hovereffecttype = "default_imagehover_effects". ',WOP_TEXT_DOMAIN),
					  __('For Width in percentage - 1 to 100 (Without unit) <br> For Width in px - Eg. 250px ( With px unit )',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('height',
					  __('Height of overlay. Only required when hovereffecttype = "default_imagehover_effects".',WOP_TEXT_DOMAIN),
					  __('For Height in percentage - 1 to 100 (Without unit) <br> For Height in px - Eg. 250px ( With px unit )',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('speed',
					  __('Animation Speed. Only required when hovereffecttype = "default_imagehover_effects".',WOP_TEXT_DOMAIN),
					  __('Speed in seconds from .10 to 5.0',WOP_TEXT_DOMAIN));
	
	$parameters[] =   array('opacity',
					  __('Opacity value for Overlay. Only required when hovereffecttype = "default_imagehover_effects". ',WOP_TEXT_DOMAIN),
					  __('Opacity value in decimal value from .1 (minimum) to 1 (maximum)',WOP_TEXT_DOMAIN));
	
	
	$parameters[] =   array('class_on_image',
					  __('Extra css class on image. Only required when hovereffecttype = "default_imagehover_effects".',WOP_TEXT_DOMAIN),
					  __('Any class name we want to apply on image tag',WOP_TEXT_DOMAIN));
					  
	$parameters[] =   array('overlay_color',
					  __('The color of overlay over image. Only required when hovereffecttype = "square-imagehover"',WOP_TEXT_DOMAIN),
					  __('The color of overlay over image.',WOP_TEXT_DOMAIN));				  				  
	$parameters[] =   array('heading_bg_color',
					  __('The color of heading\'s background area. Only required when hovereffecttype = "square-imagehover"',WOP_TEXT_DOMAIN),
					  __('The color of heading\'s background area.',WOP_TEXT_DOMAIN));				  				  
	$parameters[] =   array('heading_color',
					  __('The color of overlay heading. Only required when hovereffecttype = "square-imagehover"',WOP_TEXT_DOMAIN),
					  __('The color of overlay heading.',WOP_TEXT_DOMAIN));				  				  
	
	$parameters[] =   array('desc_color',
					  __('The color of overlay description paragraph. Only required when hovereffecttype = "square-imagehover"',WOP_TEXT_DOMAIN),
					  __('The color of overlay description paragraph.',WOP_TEXT_DOMAIN));				  				  
	$tablemarkup = FlipperCode_HTML_Markup::field_table( 'wihe_shortcode_parameters_listing', array(
	'heading' => array(__('Shortcode Parameter',WOP_TEXT_DOMAIN),
					   __('Description',WOP_TEXT_DOMAIN),
					   __('Available Values',WOP_TEXT_DOMAIN)),
	'heading_width_ratio' => array('30%','30%','38%'),
	'data' => $parameters,
	'class' => 'fc-core-table table-striped wihe_shortcode_parameters_listing',
	'id' => 'wihe_shortcode_parameters_listing',
	'width' => '100%'
	));
	echo $tablemarkup;
	
?>

</div>

<h3 class="ptheading"><?php _e('Hooks Available For Developers'); ?></h3>
<div style="clear:both"></div>
<div class="wpdocspro-hooks-listing">
	
<?php 
	
	// Availalable Hooks Documentation.
	$table = array();
	$table['heading'] = __('Hooks Available For Developers :',WOP_TEXT_DOMAIN);
	
	$hooks = array();
	$hooks[] = array('hovereffect_image','Filter',__('This hook can be used to replace the whole image tag (" featured image img tag ") that is used by default by wordpress. Useful for showing custom image.',WOP_TEXT_DOMAIN),'Complete Image Tag');
	$hooks[] = array('hovereffect_content','Filter',__('This hook can be used to change the default "Image Hover Content" that is displayed when image is hovered.',WOP_TEXT_DOMAIN),'Image Hover Effect Content');
	$hooks[] = array('hovereffect_html','Filter',__('This hook can be used to change the complete markup of image hover effect that also includes featured image or custom image. Most useful hook for providing image hover effect of your choice.',WOP_TEXT_DOMAIN),'Hover Effect Complete Html');
	$hooks[] = array('hovereffect_post_title','Filter',__('This hook can be used to change the default post title.',WOP_TEXT_DOMAIN),'Post Title');
	$hooks[] = array('hovereffect_post_link','Filter',__('This hook can be used to change the default post permalink.',WOP_TEXT_DOMAIN),'Post Permalink');
	$hooks[] = array('hovereffect_post_excerpt','Filter',__('This hook can be used to change the default post excerpt.',WOP_TEXT_DOMAIN),'Post Excerpt');
	$hooks[] = array('hovereffect_post_readmore','Filter',__('This hook can be used to change the default post readmore link.',WOP_TEXT_DOMAIN),'Read More Link');
	
	$tablemarkup = FlipperCode_HTML_Markup::field_table( 'wihe_available_hooks_listing', array(
	'heading' => array('Hook Name','Hook Type','Hook Description','Mandatory Return Value'),
	'heading_width_ratio' => array('20%','10%','50%','20%'),
	'data' => $hooks,
	'class' => 'fc-core-table table-striped wop_available_hooks_listing',
	'id' => 'wop_available_hooks_listing',
	'width' => '100%'
	));
	
	echo $tablemarkup;
	


?>	
</div>	


<h3 class="ptheading"><?php _e('Did This Plugin Worked For You ?'); ?></h3>
<div class="wpihep-overview">
<p><?php _e('If you like this plugin and it worked for you, please leave a review and star rating ',WOP_TEXT_DOMAIN); ?><b><a href="https://wordpress.org/plugins/wp-overlays/#reviews" target="_blank">Here</a></b></p>
</div>

<h3 class="ptheading"><?php _e('Want More From It ?'); ?></h3>
<div class="wpihep-overview">
<p><?php _e('There is an even more better version of this plugin bundled with lots of new functionalities and much required features suggested by our esteemed customers. Click ',WOP_TEXT_DOMAIN); ?><b><a style="font-weight:bold;" href="https://codecanyon.net/item/wp-image-hover-effects-pro/19228283" target="_blank">Here</a></b> To Explore More or view <a style="font-weight:bold;" target="_blank" href="https://www.flippercode.com/image-hover-effects-pro/">Working Demo</a></p>
<?php _e('You can create custom image overlays with multi colors, more flexibility and can have more control over the display of overlay. Click Below Example',WOP_TEXT_DOMAIN); ?>
<a style="font-weight:bold;" href="https://codecanyon.net/item/wp-image-hover-effects-pro/19228283" target="_blank">
	<img src="https://s3.envato.com/files/231429476/screenshots/gradient-final.jpg" alt="CSS3 Image Hover Effects">
</a>
<br>
<?php _e('Pro version of this plugin has numerous unique, advance features. Click on above image to view all features.',WOP_TEXT_DOMAIN); ?>	
</div>

<h3 class="ptheading"><?php _e('Get Support'); ?></h3>
<div class="wpihep-overview">
<p><?php _e('If you are facing any issue using any of our free or premium version plugin or need some assitance in setting up this plugin, create your ',WOP_TEXT_DOMAIN); ?><b><a href="http://www.flippercode.com/forums" target="_blank">support ticket</a></b><?php _e(' and we\'d be happy to help you as soon as possible.',WOP_TEXT_DOMAIN); ?></p>
</div>
</div> 
</div>
	
	</div>
	</div>
</div>
</div>
</div>


