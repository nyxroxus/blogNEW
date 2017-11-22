jQuery(document).ready(function($) {
	
	function update_current_shortcode() {
	
		hovereffecttype = $('#current_hover_effecttype').val();
		testeffect = $('#current_hover_effect').val();
		shortcode = '';
		var overlay_text = $('#ptw_default_content').val();
		if(overlay_text !== undefined)
	    overlay_text = overlay_text.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
			
		if(hovereffecttype == 'default_imagehover_effects'){
			
			effect_in = $('#modal_set_effect .wop_overlay').data('in');
			effect_out = $('#modal_set_effect .wop_overlay').data('out');
			preview_type =  $('input[name="choose_overlay_color_type"]:checked').val();
			text_color = $('#text_color').val();
			overlay_color = $('#overlay_color').val();
			overlay_content_position = $('#slide_text_position').val();
			overlay_width = $('#overlay_width').val();
			overlay_height = $('#overlay_height').val();
			animation_speed = ($('#animation_speed').val());
			overlay_opacity = $('#opacity_value').val();
			if(overlay_opacity > 1){
			overlay_opacity = (overlay_opacity/100);	
			}
			if(animation_speed > 1){
			animation_speed = (10 - $('#animation_speed').val());	
			}
			
			shortcode = "[hovereffect hovereffecttype = 'default_imagehover_effects' in='"+effect_in+"' out='"+effect_out+"' speed='"+animation_speed+"' color='"+overlay_color+"' width='"+overlay_width+"' height='"+overlay_height+"' text_color='"+text_color+"' opacity='"+overlay_opacity+"' text_position='"+overlay_content_position+"' src='{image_path}' default_effect_type='single']"+overlay_text+"[/hovereffect]";
			
			
		}else if(hovereffecttype == 'ihover-circular'){
			
			 circle_overlay_color = $('#circle_overlay_color').val();
			 circle_text_color = $('#circle_text_color').val();
			 size = $('#circle_size').val();
			 opacity = $('#circle_opacity').val();
			 opacity = (opacity/100);
			 effect = $('#current_hover_effect').val();
			 
			if($('.effect_instant_preview .circle').hasClass('effect1')){
				
			 circle_border_color_one = $('#circle_border_color_one').val();
			 circle_border_color_two = $('#circle_border_color_two').val();
			 shortcode = "[hovereffect hovereffecttype = 'ihover-circular' effect = '"+effect+"' color = '"+circle_overlay_color+"' border_color_one='"+circle_border_color_one+"' border_color_two='"+circle_border_color_two+"' size='"+size+"' opacity='"+opacity+"' text_color='"+circle_text_color+"' src='{image-url}']"+overlay_text+"[/hovereffect]";
			 	
			}else{
			  
			  shortcode = "[hovereffect hovereffecttype = 'ihover-circular' effect = '"+effect+"' color = '"+circle_overlay_color+"' size='"+size+"' opacity='"+opacity+"' text_color='"+circle_text_color+"' src='{image-url}']"+overlay_text+"[/hovereffect]";
			  		
			}
			
		}else if(hovereffecttype == 'square-imagehover'){
			
			overlay_color = $('.square_hover_bgcolor').val();
			heading_color = $('.square_hover_headingcolor').val();
			text_color = $('.square_hover_desccolor').val();
			effect = $('#current_hover_effect').val();
			if($('.effect_instant_preview .square').hasClass('dc')){
				
				heading_bg_color = $('.square_hover_headingbgcolor').val();
				shortcode = "[hovereffect hovereffecttype = 'square-imagehover' effect = '"+effect+"' overlay_color='"+overlay_color+"' src='{image_path}' heading_color='"+heading_color+"' heading_bg_color='"+heading_bg_color+"' desc_color='"+text_color+"']"+overlay_text+"[/hovereffect]";
			}else{
				shortcode = "[hovereffect hovereffecttype = 'square-imagehover' effect = '"+effect+"' overlay_color='"+overlay_color+"' src='{image_path}' heading_color='"+heading_color+"'  desc_color='"+text_color+"']"+overlay_text+"[/hovereffect]";
			}
			
			
		}else{
			
			effect = $('#current_hover_effect').val();
			shortcode = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' src='{image_url}']";
		}
		
		$('#current_effect_shortcode').html(shortcode);
	}
	
	$('#gradient_color_direction').change(function(){
		$('#modal_set_effect .wop_overlay').data('gradient-color-direction',$(this).val());
		update_current_shortcode();
	});
	
	$('#ptw_default_content').keyup(function(){
		update_current_shortcode();
	});
	
	$('input[name=choose_overlay_color_type]:radio').change(function(){
		 
		if($(this).val() == 'multi'){
			$('.gradient_color_container').show();
			$('.overlay_color_container').hide();
		}else{
			$('.gradient_color_container').hide();
			$('.overlay_color_container').show();
			$('.wop_overlay').css('background-image','none');
		}
		update_current_shortcode();
		
	});
	
	if($('.color-field').length > 0) {
	   $('.color-field').wpColorPicker();
    }
   	
	$('.show_similar_effects').click(function(){
		
		$('.wfip_effects_listing').find('.set_it_as_default').removeClass('sample_of_effect');
		$('.effects-container').hide();
		var classname = $(this).data('markuptype');
		$('.wfip_effects_listing .'+classname).show();	
		$('html, body').animate({
        scrollTop: $(".wfip_effects_listing").offset().top - 50
		}, 2000);
    	
	});
	
	$('.set_effect_as_final_effect').click(function(){
	
	 $('.for_post_type_error').remove();
	
	     var hovereffecttype = $('#modal_set_effect').data('hovereffecttype');
		 var for_post_type = 'post';
		 	 	
		 if(hovereffecttype == 'default_imagehover_effects') {
			
			default_effect_type_selected = $('input[name=choose_overlay_color_type]:checked').val();
			var data = {
				action: 'wop_ajax_call',
				operation: 'set_effect_as_final_effect',
				nonce:settings_obj.nonce,
				hovereffecttype : hovereffecttype,
				slide_effect : $('#modal_set_effect').data('effect'),
				slide_effect_exit : $('#modal_set_effect').data('slide_effect_exit'),
				for_post_type : for_post_type,
				overlay_color : $('#overlay_color').val(),
				text_color : $('#text_color').val(),
				slide_text_position : $('#slide_text_position').val(),
				animation_speed : $('#animation_speed').val(),
				overlay_width : $('#overlay_width').val(),
				overlay_height : $('#overlay_height').val(),
				opacity_value : $('#opacity_value').val(),
				overlay_color_changed : $('#overlay_color_changed').val(),
				selector : '.set_effect_as_final_effect',
				default_data : $('#ptw_default_content').val(),
				default_effect_type : 'single',
				
			}
			
		 }else if( hovereffecttype == 'square-imagehover'){
			 
			 var data = {
				action: 'wop_ajax_call',
				operation: 'set_effect_as_final_effect',
				nonce:settings_obj.nonce,
				hovereffecttype : hovereffecttype,
				slide_effect : $('#modal_set_effect').data('effect'),
				for_post_type : for_post_type,
				overlay_color : $('.square_hover_bgcolor').val(),
				heading_bg_color : $('.square_hover_headingbgcolor').val(),
				heading_color : $('.square_hover_headingcolor').val(),
				desc_color : $('.square_hover_desccolor').val(),
				selector : '.set_effect_as_final_effect',
				default_data : $('#ptw_default_content').val()
			}
			
		 }else if(hovereffecttype == 'ihover-circular') {
				
				var data = {
				action: 'wop_ajax_call',
				operation: 'set_effect_as_final_effect',
				nonce:settings_obj.nonce,
				hovereffecttype : hovereffecttype,
				slide_effect : $('#modal_set_effect').data('effect'),
				for_post_type : for_post_type,
				overlay_color : $('#circle_overlay_color').val(),
				overlay_color_changed : $('#overlay_color_changed').val(),
				selector : '.set_effect_as_final_effect',
				default_data : $('#ptw_default_content').val(),
				text_color : $('#circle_text_color').val(),
				circle_size : $('#circle_size').val(),
				circle_opacity : $('#circle_opacity').val()
				}
				if($('.effect_instant_preview .circle').hasClass('effect1')){
					var effect_one_extra_info = {border_color_one: $('#circle_border_color_one').val(), border_color_two: $('#circle_border_color_two').val() };
					var data = jQuery.extend(data,effect_one_extra_info);
				}
			 
		 }
		 
		 else{
			 
			 var data = {
				action: 'wop_ajax_call',
				operation: 'set_effect_as_final_effect',
				nonce:settings_obj.nonce,
				hovereffecttype : hovereffecttype,
				slide_effect : $('#modal_set_effect').data('effect'),
				for_post_type : for_post_type,
				overlay_color : $('#overlay_color').val(),
				overlay_color_changed : $('#overlay_color_changed').val(),
				selector : '.set_effect_as_final_effect',
				default_data : $('#ptw_default_content').val()
			}
		 }
		 
		 $(this).next('.ajax_loader').show();
		 
		 if(for_post_type == undefined){
			 var extra_data = {for_category: $('#effect_for_category').data('term-id'),for_category_name: $('#effect_for_category').data('term-name')};
			 data = $.extend(data,extra_data);
		 }
		 perform_ajax_event(data);
	 
	});
	
	
	$('.get_default_markup').click(function(){
		
		var proceed = confirm("This will remove the current content in textarea above with default html markup most suitable according to current hover effect.");
		
		if (proceed) {
			
			var data = {
				action: 'wop_ajax_call',
				operation: 'get_default_markup_for_hovereffect',
				nonce:settings_obj.nonce,
				hovereffect : $(this).data('hovereffecttype'),
				selector : '.get_default_markup'
				
			}
			$('.set_effect_as_final_effect').next('.ajax_loader').show();
			perform_ajax_event(data);
			
			
		} 
		
	});
	
	function perform_ajax_event(data) {
		
		jQuery.ajax({
			type: "POST",
			url: admin_ajax,
			dataType: "json",
			data: data,
			beforeSend: function() {},
			success: function(data) {
			  $('.ajax_loader').hide();
			  perform_ajax_success_handler(data);
			}

		}); 
		
	}
	
	function perform_ajax_success_handler(data){
		
		if(data.posted.selector == '.disable_effect'){
			
			selector = $('.current-effect-container.for-'+data.posted.for_post_type).find('.effect-preview');	
			real_image = selector.find('img:not(.logo_class)').attr('src');
			html = '<div class="effect_preview_notification">Effect Removed Successfully.</div>'+
					'<img src="'+real_image+'">';
			selector.html(html);
		
		} else if(data.posted.selector == '.set_effect_as_final_effect'){
			 
			  if(data.posted.for_post_type != undefined) {
				  updated_for_post_type = data.posted.for_post_type;
				  up = updated_for_post_type.toLowerCase().replace(/\b[a-z]/g, function(letter) {
						return letter.toUpperCase();
				  });
				  $('.update_success').html('Hover Effects For Blog Post\'s Featured Images Updated Successfully.').show();
				  
		      }
		      if(data.posted.for_category != undefined) {
				  cat = data.posted.for_category_name;
				  $('.update_success').html('Hover Effect Settings For Category "'+cat+'" Updated Successfully.').show();
			  }
		      $('.current_effect').remove();
			  $('#overlay_color_changed').val('no');
			  
		} else if(data.posted.selector == '.get_default_markup'){
			 
			  var defaultmarkup = data.markup;
			  var hovereffect = data.posted.hovereffect;
			  $('#ptw_default_content').html(defaultmarkup);
			  update_current_shortcode();	
		}
		
	}
	
	$('.disable_effect').click(function(){
		
		var proceed = confirm("Do you really want to disable hover effect for this post type ?");
		if ( proceed ) {
			
			var data = {
				action: 'wop_ajax_call',
				operation: 'disable_effect_for_post_type',
				nonce:settings_obj.nonce,
				for_post_type : $(this).data('remove-effect-for'),
				selector : '.disable_effect'
			}
			$(this).parent('.links_holder').next('.ajax_loader').show();
			perform_ajax_event(data);
		} 
		
	});
	
	var modalcondition = 'close';
	
	$('#modal_set_effect').on('hidden.bs.modal', function () {
		modalcondition = 'close';
	});
	
	
	
	 
	function generate_shortcode($invoker){
		
		var shortcode_content = '';
		var hovereffecttype = $invoker.data('hovereffecttype');
		var effect = $invoker.data('effect');
		var default_data = $invoker.data('designwise-content');
		if(default_data != undefined){
			var text_default_data = default_data.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
		}
		switch(hovereffecttype) {
			case 'default_imagehover_effects':
				  
				  var slide_effect_exit = $invoker.data('slide_effect_exit');
				  var overlaywidth  = $invoker.data('overlaywidth');
				  var overlayheight = $invoker.data('overlayheight');
				  var opacity =  $invoker.data('opacity');
				  if(parseFloat(opacity) > 1) 
				  opacity = ($invoker.data('opacity')/100);
				  var animationspeed = $invoker.data('animationspeed');
				  if(animationspeed != 1)
				  animationspeed = (10-animationspeed);
				  var overlaycolor = $invoker.data('overlaycolor');
				  var textcolor = $invoker.data('text-color');
				  var slide_text_position = $invoker.data('slide_text_position');
				  var overlaytype = $invoker.data('overlay-type');
				  var gradient_color_one = $invoker.data('gradient-color-one');
				  var gradient_color_two = $invoker.data('gradient-color-two');
				  var gradient_color_direction = $invoker.data('gradient-color-direction');
				  var overlay_type = $invoker.data('overlay-type');
				  
				  
				  shortcode_content = "[hovereffect hovereffecttype= '"+hovereffecttype+"' width='"+overlaywidth+"' height='"+overlayheight+"' in='"+effect+"' out='"+slide_effect_exit+"' speed='"+animationspeed+"' color='"+overlaycolor+"' text_color='"+textcolor+"' opacity='"+opacity+"' text_position='"+slide_text_position+"' src='{image_url}' default_effect_type='"+overlay_type+"']"+text_default_data+"[/hovereffect]";
			  
				  if(overlaytype == 'multi'){
					
					shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' width='"+overlaywidth+"' height='"+overlayheight+"' in = '"+effect+"' out = '"+slide_effect_exit+"' speed='"+animationspeed+"' gradient_color_one = '"+gradient_color_one+"' gradient_color_two='"+gradient_color_two+"' gradient_color_direction = '"+gradient_color_direction+"' default_effect_type='"+overlay_type+"' text_color='"+textcolor+"' opacity='"+opacity+"' text_position='"+slide_text_position+"' src='{image_url}']"+text_default_data+"[/hovereffect]";
					
				  }
				  
				  break;
			case 'square-imagehover':
				  
					heading_color = $invoker.data('heading_color');
					desc_color = $invoker.data('desc_color');
					overlay_color = $invoker.data('overlay_color');
					shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' overlay_color='"+overlay_color+"' heading_color='"+heading_color+"' desc_color='"+desc_color+"' src='{image_url}']"+text_default_data+"[/hovereffect]";

					if(effect.indexOf("dc") >= 0){

					heading_bg_color = $invoker.data('heading_bg_color');
					shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' overlay_color='"+overlay_color+"' heading_color='"+heading_color+"' heading_bg_color = '"+heading_bg_color+"' desc_color='"+desc_color+"' src='{image_url}']"+text_default_data+"[/hovereffect]";

					}
			  	
				  break;
			case 'scalable_imagehover_effects':
				
				  shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' src='{image_url}']"+text_default_data+"[/hovereffect]";	
				  break;
				  
			case 'ihover-circular':
				    
				    var size = $invoker.data('size');
					var opacity =  ($invoker.data('opacity')/100);
					var text_color =  $invoker.data('text-color');
					
					if(effect == 'effect1'){
					  border_color_one =  $invoker.data('border_color_one');
					  border_color_two =  $invoker.data('border_color_two');
					  shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' src='{image_url}' size='"+size+"' text_color='"+text_color+"' opacity='"+opacity+"' border_color_one = '"+border_color_one+"' border_color_two='"+border_color_two+"']"+text_default_data+"[/hovereffect]";
					}else{
					   
					  shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' src='{image_url}' size='"+size+"' text_color='"+text_color+"' opacity='"+opacity+"']"+text_default_data+"[/hovereffect]";
					}
			  	
				  break;
			case 'image-magnifier':
					
				 shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' src='{image_url}' magnifier_src='{full_size_image_url}']"+text_default_data+"[/hovereffect]";
					
				  break;
				
			default:
			shortcode_content = "[hovereffect hovereffecttype = '"+hovereffecttype+"' effect = '"+effect+"' src='{image_url}']"+text_default_data+"[/hovereffect]";
							
		}
        
        return shortcode_content;
		
	}
	
	$('#modal_set_effect').on('show.bs.modal', function(e){
	  
	  var $invoker = $(e.relatedTarget);
	  
	  modalcondition = 'open';
	  $('.for_post_type').removeAttr('checked');
	  $('.for_post_type_error').remove();
	  
	  $('.update_success').hide();
	  open_for_post_type = $invoker.data('for-post-type');
	  $(this).find('.modal-title').html('Quick Update Hover Effects For Blog Post Featured Images');
	  
	  
	  $('#current_hover_effecttype').val($invoker.data('hovereffecttype'));
	  $('#current_hover_effect').val($invoker.data('effect'));
	  
	  if($invoker.data('hovereffecttype') == 'default_imagehover_effects'){
		  $('#current_in_effect').val($invoker.data('effect'));
		  $('#current_out_effect').val($invoker.data('slide_effect_exit'));
		  
	  }
	  
	  if($invoker.hasClass('sample_of_effect')){
		  
		  //Customising DB Saved
		  var hovereffecttype = $invoker.data('hovereffecttype');
		  var effect = $invoker.data('effect');
		  var slide_effect_exit = $invoker.data('slide_effect_exit');
		  var default_data = $invoker.data('designwise-content');
		  if(hovereffecttype == 'default_imagehover_effects'){
			 overlay_div = $invoker.parent('.links_holder').parent('.effect-preview').find('.wop_effects').find('.wop_img .wop_overlay');
			 if(overlay_div.length == 0){
				overlay_div = $invoker.closest('.link_container').parent('.effect-preview').find('.wop_effects').find('.wop_img .wop_overlay');
			 }
			 overlay_div.removeClass('animated').attr('style','');
		  }
		  $('#ptw_default_content').html(default_data);
		  if(default_data != undefined){
			  shortcode_content = generate_shortcode($invoker);
			  $('#current_effect_shortcode').html(shortcode_content);
			  
	      }
		  $('#get_default_markup').data('hovereffecttype',hovereffecttype);
		  
	  }
	  else{
		  
		  
		  //Customising Samples From Gallery
		  effectcontainer = $invoker.closest('.effect-information');
		  var hovereffecttype = $(effectcontainer).data('hovereffecttype');
		  var effect = $(effectcontainer).data('effect');
		  var slide_effect_exit = $(effectcontainer).data('slide_effect_exit');
		  shortcode_content = generate_shortcode($invoker);
		  var default_data = $(effectcontainer).data('designwise-content');
    	  if(default_data == undefined){
			  var default_data = $invoker.data('designwise-content');
		  }
		  $('#ptw_default_content').html(default_data);
		  $('#current_effect_shortcode').html(shortcode_content);
		  if(hovereffecttype == 'square-imagehover'){
			  $('.square_hover_bgcolor').val('#1A4A72').trigger('change');
			  $('.square_hover_headingbgcolor').val('#11314C').trigger('change');
			  $('.square_hover_headingcolor').val('#fff').trigger('change');
			  $('.square_hover_desccolor').val('#fff').trigger('change');
    	  }
	      
	  }
	  
	  $('.tools-to-customise').show();
	  $('.toolsbyeffect').hide();
	  $('.effect_'+hovereffecttype+'_tools').show();
	  
	  if(!$('.dynamic-preview').hasClass('col-md-6')) {
		  $('.dynamic-preview').removeClass('col-md-12');
		  $('.dynamic-preview').addClass('col-md-6');
      }
      
	  if(hovereffecttype == 'image-magnifier' || hovereffecttype == 'scalable_imagehover_effects'){
		 
		  $('.tools-to-customise').hide();
		  $('.dynamic-preview').removeClass('col-md-6');
		  $('.dynamic-preview').addClass('col-md-12').addClass('fc-12').removeClass('fc-6');
	  }else{
		  if(!$('.dynamic-preview').hasClass('fc-6')){
			  $('.dynamic-preview').addClass('fc-6')
		  }
	  }
	  
	  $(this).data('hovereffecttype',hovereffecttype);
	  $(this).data('effect',effect);
	  $(this).data('slide_effect_exit',slide_effect_exit);
	  
	  $('.effect_default_custom_overlay_tools').hide();
	  $('.effect_default_custom_overlay_tools').css('display','none'); 
	  
	  if(hovereffecttype == 'image-magnifier'){
		 $('#ptw_default_content_msg').next('.help-block').hide();
		 $('#ptw_default_content_msg').hide();
		 $('#ptw_default_content').next('.help-block').hide(); 
		 $('#ptw_default_content').hide(); 
		 $('#get_default_markup').next('.help-block').hide(); 
		 $('#get_default_markup').hide();
		 
	  }else{
		 $('#ptw_default_content_msg').show();
		 $('#ptw_default_content_msg').next('.help-block').show();
		 $('#ptw_default_content').show(); 
		 $('#ptw_default_content').next('.help-block').show(); 
		 $('#get_default_markup').show();
		 $('#get_default_markup').next('.help-block').show();
		 
	  }
	  
	  if(hovereffecttype == 'default_imagehover_effects'){
		 $('.effect_default_custom_overlay_tools').css('display','block'); 
	     $('.effect_default_custom_overlay_tools').show();
	     
	  }
	 
	  if($invoker.hasClass('sample_of_effect') || $invoker.hasClass('set_it_as_default')){
		  
		  if($invoker.hasClass('sample_of_effect')){ 
			  
			effectcontainer = $invoker.closest('.effect-preview');
			var instant_preview = $(effectcontainer).clone( true );
						
	      }else{
			
			effectcontainer = $invoker.closest('.effect-information');
			var instant_preview = $(effectcontainer).clone( true );  
		  } 
		  
		  $('.effect_instant_preview').html('');
		  $('.effect_instant_preview').html(instant_preview);  
		  
		  if($invoker.hasClass('sample_of_effect')){
			  if(hovereffecttype == 'ihover-circular'){
			    if($('.circle_size_display').length == 0) {  
				   $('#ui_circle_size').after('<div class="circle_size_display">Circle Size : '+$invoker.data('size')+'px</div>');
				}else{
				   $('.circle_size_display').html('<div class="circle_size_display">Circle Size : '+$invoker.data('size')+'px</div>');	
				}
				
			  }
		  }
		  
		  if(hovereffecttype == 'square-imagehover'){
			  
		     if($('.effect_instant_preview').find('.ih-item').hasClass('dc')){
				 headinbgcontrol = $('.square_hover_headingbgcolor').closest('.wp-picker-container');
				 headinbgcontrol.next('.help-block').show();
				 headinbgcontrol.show();
			 }else{
				 headinbgcontrol = $('.square_hover_headingbgcolor').closest('.wp-picker-container');
				 headinbgcontrol.next('.help-block').hide();
				 headinbgcontrol.hide();
			 }
		  }
		  
		  if(hovereffecttype == 'ihover-circular'){
			  
		     if($('.effect_instant_preview').find('.ih-item').hasClass('effect1')){
				 headinbgcontrol = $(".circle_border_color_one,.circle_border_color_two").closest('.wp-picker-container');
				 headinbgcontrol.next('.help-block').show();
				 headinbgcontrol.show();
			 }else{
				 headinbgcontrol = $(".circle_border_color_one,.circle_border_color_two").closest('.wp-picker-container');
				 headinbgcontrol.next('.help-block').hide();
				 headinbgcontrol.hide();
			 }
		  }
		  
	  }
	  
	   if(hovereffecttype == 'default_imagehover_effects'){
		 overlay_div = $(this).find('.dynamic-preview .wop_img');
	     overlay_div.removeClass('animated').css('background-color','');
	   }
	  
	  
	   if($invoker.hasClass('from_setting_page') || $invoker.hasClass('sample_of_effect') ){
	     
	     $('.modal-body .effect_set_for').remove();
	     
	     if($invoker.hasClass('from_setting_page')){
			
			hovereffecttype = $invoker.data('hovereffecttype');
			if( hovereffecttype == 'default_imagehover_effects' ){
			
			    var for_post_type =  $invoker.parent().parent('.effect-preview').find('.effect_set_for').data('effect-set-for');
			    var textcolor = $invoker.data('text-color');
				var overlaycolor = $invoker.data('overlaycolor');
				var overlaywidth = $invoker.data('overlaywidth');
				var overlayheight = $invoker.data('overlayheight');
				var animationspeed = $invoker.data('animationspeed');
				var opacity = $invoker.data('opacity');
				var text_align = $invoker.data('slide_text_position');
				var saved_default_effect_type = $invoker.data('default-effect-type');
				
				$('input[name="choose_overlay_color_type"][value="' + saved_default_effect_type + '"]').prop('checked', true).trigger('change');
				
				if($invoker.data('default-effect-type') == 'multi') {
					
					$('#gradient_color_one').val($invoker.data('gradient-color-one')).trigger('change');
					$('#gradient_color_two').val($invoker.data('gradient-color-two')).trigger('change');
					$('#gradient_color_direction').val($invoker.data('gradient-color-direction')).trigger('change');
				    
				}
				
				$('#overlay_color').show();
				$('#overlay_width').val(overlaywidth);
				$('#overlay_height').val(overlayheight);
				$('#animation_speed').val(animationspeed);
				$('#opacity_value').val(100/opacity);
				
				$('#overlay_color').val(overlaycolor).trigger('change');
				$('#text_color').val(textcolor).trigger('change');
				$('#slide_text_position').val(text_align).trigger('change');
				$('.for_post_type[value="'+for_post_type+'"]').prop("checked",true);
				$('.for_post_type[value="'+for_post_type+'"]').attr("checked","checked");
				$('#ui_overlay_width').data('value',overlaywidth);
				$('#ui_overlay_width').slider("value", overlaywidth);
				$('#ui_overlay_height').data('value',overlayheight);
				$('#ui_overlay_height').slider("value", overlayheight);
				$('#ui_animation_speed').data('value',animationspeed);
				$('#ui_animation_speed').slider("value", animationspeed);
				$('#ui_opacity_value').data('value',(opacity*100));
				$('#ui_opacity_value').slider("value", (opacity*100));
				
		    }else if(hovereffecttype == 'square-imagehover'){
				
				var for_post_type =  $invoker.parent().parent('.effect-preview').find('.effect_set_for').data('effect-set-for');
				var overlaycolor = $invoker.data('overlay_color');
				var headingcolor = $invoker.data('heading_color');
				var heading_bg_color = $invoker.data('heading_bg_color');
				var desc_color = $invoker.data('desc_color');
				$('.square_hover_bgcolor').val(overlaycolor).trigger('change');
				$('.square_hover_headingbgcolor').val(heading_bg_color).trigger('change');
				$('.square_hover_headingcolor').val(headingcolor).trigger('change');
				$('.square_hover_desccolor').val(desc_color).trigger('change');
				$('.for_post_type[value="'+for_post_type+'"]').prop("checked",true);
				$('.for_post_type[value="'+for_post_type+'"]').attr("checked","checked");
				
			}
			else if(hovereffecttype == 'ihover-circular'){
				
				var for_post_type =  $invoker.parent().parent('.effect-preview').find('.effect_set_for').data('effect-set-for');
				var border_color_one = $invoker.data('border_color_one');
				var border_color_two = $invoker.data('border_color_two');
				var overlay_color = $invoker.data('overlay_color');
				var opacity = $invoker.data('opacity');
				var text_color = $invoker.data('text-color');
				var size = $invoker.data('size');
				
				$('.circle_border_color_one').val(border_color_one).trigger('change');
				$('.circle_border_color_two').val(border_color_two).trigger('change');
				$('.circle_overlay_color').val(overlay_color).trigger('change');
				$('#circle_text_color').val(text_color).trigger('change');
				
				$('#circle_size').val(size).trigger('change');
				$('#ui_circle_size').data('value',size);
				$('#ui_circle_size').slider("value", size);
				
				$('#circle_opacity').val(opacity).trigger('change');
				$('#ui_circle_opacity').data('value',opacity);
				$('#ui_circle_opacity').slider("value", opacity);
				$('.for_post_type[value="'+for_post_type+'"]').prop("checked",true);
				$('.for_post_type[value="'+for_post_type+'"]').attr("checked","checked");
				
			}
			else{
				
			}
			
		 }
		 
       }
       
       if(hovereffecttype == 'default_imagehover_effects'){
		  if($('.effect_instant_preview .wop_overlay').length > 0){
			  $('.effect_instant_preview .wop_overlay').removeClass('animated').attr('style','');
		  }
	   }
       
	});
	
	function hexToRgbA(hex){
		var c;
		if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
			c= hex.substring(1).split('');
			if(c.length== 3){
				c= [c[0], c[0], c[1], c[1], c[2], c[2]];
			}
			c= '0x'+c.join('');
			rgb = [(c>>16)&255, (c>>8)&255, c&255].join(',');
			return rgb; 
     	}
		
	}

	function rgb2hex(rgb){
		
	 rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
	 return (rgb && rgb.length === 4) ? "#" +
	  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
	  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
	  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
	}

    function wop_u(e) {
        return ["0x" + e[1] + e[2] | 0, "0x" + e[3] + e[4] | 0, "0x" + e[5] + e[6] | 0];
    }
    
    
    var all_sliders = $('.ui-slider');
    $.each(all_sliders, function(index, obj) {
        
        var default_value = parseInt($(obj).data('value'));
        var min = parseInt($(obj).data('min'));
        var max = parseInt($(obj).data('max'));
        
        $(obj).slider({
            range: "min",
            value: default_value,
            min: min,
            max: max,
            change: function() {
								
                $(this).find('input[type="hidden"]').val($(this).slider('option', 'value'));
                var obj_type = $(this).find('input[type="hidden"]').attr('id');
                
                if (obj_type == 'overlay_width') {
					
                    $('.wop_overlay').data('width', $(this).slider('option', 'value'));
                }
                if (obj_type == 'overlay_height') {
                    $('.wop_overlay').data('height', $(this).slider('option', 'value'));
                }
                if (obj_type == 'animation_speed') {
					
					if(modalcondition == 'open') {
					  $speed = 10 - $(this).slider('option', 'value');
				    }
					else {
					   $speed = $(this).slider('option', 'value');
				    }
					  
				    $('#modal_set_effect .wop_overlay').data('speed', $speed);
                    $('#animation_speed_changed').val('yes');
                }
                if (obj_type == 'circle_size') {
					
					$('.wop_overlay').data('size', $(this).slider('option', 'value'));
					$('.circle_size_display').text('Circle Size : '+$(this).slider('option', 'value')+'px');
					
				}
				if (obj_type == 'circle_opacity') {
					
					opacity = $('#circle_opacity').val();
					hex = $('#circle_overlay_color').val();
					rgb = hexToRgbA(hex);
					opacity = (opacity/100);
					rgba = 'rgba('+rgb+','+opacity+')';
					$('.effect_instant_preview .circle .overlay_bg').css('background-color',rgba);
				}
                
                if (obj_type == 'opacity_value') {
                    var selected_value = $(this).slider('option', 'value');
                    var op;
                    if (selected_value == 100) op = "1.0";
                    else op = "0." + selected_value;
                    
                    preview_type =  $('input[name="choose_overlay_color_type"]:checked').val(); 
				    if(preview_type == 'multi'){
						
						var gradient_color_one = $('#gradient_color_one').val();
						var gradient_color_two = $('#gradient_color_two').val();
						gradient_color_one = "rgb(" + wop_u(gradient_color_one) + ")";
						var i = /rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)/;
						var s = i.exec(gradient_color_one);
						if (s !== null) {
							$('.wop_overlay').data('gradient-color-one', "rgba(" + s[1] + "," + s[2] + "," + s[3] + "," + op + ")");
						}
						gradient_color_two = "rgb(" + wop_u(gradient_color_two) + ")";
						var i = /rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)/;
						var s = i.exec(gradient_color_two);
						if (s !== null) {
							$('.wop_overlay').data('gradient-color-two', "rgba(" + s[1] + "," + s[2] + "," + s[3] + "," + op + ")");
						}
						
					}else{
						
						var r = $("input[name='overlay_color']").val();
						r = "rgb(" + wop_u(r) + ")";
						var i = /rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)/;
						var s = i.exec(r);
						if (s !== null) {
							$('.wop_overlay').data('color', "rgba(" + s[1] + "," + s[2] + "," + s[3] + "," + op + ")");
						}
                    	
					}
                    
                }
				update_current_shortcode();
            }
        });
    });
    
    function hexToRgb(hex) {
		
		var bigint = parseInt(hex, 16);
		var r = (bigint >> 16) & 255;
		var g = (bigint >> 8) & 255;
		var b = bigint & 255;
		return r + "," + g + "," + b;
	}

	  if($(".square-hover-tool").length > 0) {
		$(".square-hover-tool").wpColorPicker({
			hide: true,
			change: function(t, n) {
				
				if($(".effect_instant_preview .ih-item.square").length > 0 ){
					target_obj = $(".effect_instant_preview .ih-item.square");
					if($(this).hasClass('square_hover_bgcolor')){
						target_obj.find('.info').css('background',$(this).val());
						
						if(target_obj.find('.info').find('.info-back').length > 0){
							target_obj.find('.info').find('.info-back').css('background',$(this).val());
						}
					}else if($(this).hasClass('square_hover_headingcolor')){
						target_obj.find('.info h3').css('color',$(this).val());
						if(target_obj.find('.info').find('.info-back').length > 0){
							target_obj.find('.info').find('.info-back h3').css('color',$(this).val());
						}
						
					}
					else if($(this).hasClass('square_hover_desccolor')){
						target_obj.find('.info p').css('color',$(this).val());
					}
					else if($(this).hasClass('square_hover_headingbgcolor')){
						hexcolor = $(this).val();
						hexcolor = hexcolor.replace('#','');
						rgbcolor = hexToRgb(hexcolor);
						target_obj.find('.info h3').css('background','rgba('+rgbcolor+', 1)');
						if(target_obj.find('.info').find('.info-back').length > 0){
							target_obj.find('.info').find('.info-back h3').css('background','rgba('+rgbcolor+', 1)');
						}
					} 	
				}			
				update_current_shortcode();
			}
		});
	}
	
	  
	  if($(".circle_color_controls").length > 0) { 
		$(".circle_color_controls").wpColorPicker({
				
			hide: true,
			change: function(t, n) {
					
					hexcolor = $(this).val();
					hexcolor = hexcolor.replace('#','');
					rgbcolor = hexToRgb(hexcolor);
						
					if($(this).hasClass('circle_border_color_one')) {
					   $('.effect_instant_preview .spinner').css('border','10px solid '+$(this).val());
				    }else if($(this).hasClass('circle_border_color_two')) {
					  $('.effect_instant_preview .spinner').css('border-right-color',$(this).val());
					  $('.effect_instant_preview .spinner').css('border-bottom-color',$(this).val()); 	
					}else if($(this).hasClass('circle_overlay_bg_color')) {
						rgb = hexToRgbA($(this).val());
						opacity = (parseFloat($('#circle_opacity').val()) / 100);
						rgba = 'rgb('+rgb+',opacity)';
					  $('.effect_instant_preview .overlay_bg').css('background-color',rgba);
				    }else if($(this).hasClass('circle_text_color')) {
					  // $('.effect_instant_preview .overlay_bg *').removeAttr('style').css('color',$(this).val());
					  $('.effect_instant_preview .overlay_bg *').css('color',$(this).val());
					  $('.effect_instant_preview .overlay_bg p').css('border-top','1px solid '+$(this).val()+';');
					  
					}else{
					  $('#overlay_color_changed').val('yes');	
					  $('.effect_instant_preview .overlay_bg').css('background-color',"rgba(" + rgbcolor +  ",0.50)");	
					}
			update_current_shortcode();	
			}
			
		});
	 }
		
	  if($(".gradient_color").length > 0) {	
		  
		  $(".gradient_color").wpColorPicker({
				
			hide: true,
			change: function(t, n) {
				
				var selected_value = $('input[name="opacity_value"]').val();
				var op;
				if (selected_value == 100) op = "1.0";
				else op = "0." + selected_value;
				gra_one = $('#gradient_color_one').val();
				gra_two = $('#gradient_color_two').val();
				directon = $('#gradient_color_direction').val();
				
				$('.modal-body .wop_overlay').data('gradient-color-one',gra_one);
				$('.modal-body .wop_overlay').data('gradient-color-two',gra_two);
				$('.modal-body .wop_overlay').data('gradient-color-direction',directon);
				
				update_current_shortcode();
			}
		});
		
	  }
	  	
	  
	 if($(".text_color").length > 0) {
		$(".text_color").wpColorPicker({
			hide: true,
			change: function(t, n) {
				$('.modal-body .wop_overlay').data('text-color',$(this).val() );
				update_current_shortcode();
			}
		});
	  }
	 	
	  if($(".overlay_color").length > 0) {
		  
		$(".overlay_color").wpColorPicker({
				
				
			hide: true,
			change: function(t, n) {
				var selected_value = $('input[name="opacity_value"]').val();
				
				var op;
				if (selected_value == 100) op = "1.0";
				else op = "0." + selected_value;
				
				if($("a.wp-picker-open").length > 0 ){
					
				    var r = $("a.wp-picker-open").css("background-color");	
					r = r.replace(' ', '');
					r = r.replace(' ', '');
					var i = /rgb\((\d{1,3}),(\d{1,3}),(\d{1,3})\)/;
					var s = i.exec(r);
					$('#overlay_color_changed').val('yes');
					if (s !== null) { 
						
						$('.modal-body .wop_overlay').data('color', "rgba(" + s[1] + "," + s[2] + "," + s[3] + "," + op + ")");
						
					}
				
				}		
				
				update_current_shortcode();	
			}
		});
	}
	
    $('select[name="slide_effect"]').change(function() {
        $('.wop_overlay').data('in', $(this).val());
    });

    $('select[name="slide_effect_exit"]').change(function() {
        $('.wop_overlay').data('out', $(this).val());
    });
    
    $('#scalableimagehovereffects_listing').change(function() {
        $('.grid figure').removeClass().addClass($(this).val());
        $('.grid figure img').trigger('mouseover');
    });
    
    $('#hovereffecttype').change(function() {
		$('.dependable').closest('.form-group').addClass('hiderow');
		var selector = '.'+$(this).val()+'-child';
		var parent = $(selector).closest('.form-group').removeClass('hiderow');
        
    });
    
    $('select[name="slide_text_position"]').change(function() {
        $('.wop_overlay').find('div[rel="overlay-content-placeholder"]').removeClass().addClass($(this).val());
        update_current_shortcode();
    });

		
});

jQuery(document).ready(function(e) {
	
	 function hexToRgbA(hex){
		var c;
		if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
			c= hex.substring(1).split('');
			if(c.length== 3){
				c= [c[0], c[0], c[1], c[1], c[2], c[2]];
			}
			c= '0x'+c.join('');
			rgb = [(c>>16)&255, (c>>8)&255, c&255].join(',');
			return rgb; 
    	}
		
	}
	
     e(".overlay-effect[rel='custom_overlay'] .wop_img").mouseenter(function() {
        target_object = e(this).parent().find(".wop_overlay");
                
        target_object.css({
            "-webkit-animation-duration": target_object.data("speed") + "s",
            "-moz-animation-duration": target_object.data("speed") + "s",
            "-o-animation-duration": target_object.data("speed") + "s",
            "-animation-duration:": target_object.data("speed") + "s",
        });
        
        e(".overlay-effect[rel='custom_overlay'] .wop_img *").css('color',target_object.data('text-color'));
        
        if(e('#modal_set_effect').css('display') == 'block'){
			
			preview_type =  e('input[name="choose_overlay_color_type"]:checked').val(); 
			
		}
        
        target_object.css({
				   "background-color": target_object.data("color")
		});
				
        var t = new String(target_object.data("height"));
        h_index = t.indexOf("px");
        if (h_index != -1) height = t;
        else height = t + "%";
        var n = new String(target_object.data("width"));
        w_index = n.indexOf("px");
        if (w_index != -1) width = n;
        else width = n + "%";
        
        target_object.css({
            height: height,
            width: width
        });
        
        if(width == '')
        width = '100';
        if(height == '')
        height = '100';
        
        in_effect = target_object.data("in");
        target_object.removeClass().addClass("wop_overlay").addClass(in_effect + " animated ")
    }).mouseleave(function() {
		out_effect = e(this).parent().find(".wop_overlay").data("out");
        e(this).parent().find(".wop_overlay").removeClass().addClass("wop_overlay").addClass(out_effect + " animated")
    })
})
