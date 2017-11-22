
function hexToRgbA(hex){
    var c;
    console.log(hex);
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

function inEffect(t) {
	
    target_object = t.parent().find(".wop_overlay"), target_object.css({
        "-webkit-animation-duration": target_object.data("speed") + "s",
        "-moz-animation-duration": target_object.data("speed") + "s",
        "-o-animation-duration": target_object.data("speed") + "s",
        "-animation-duration:": target_object.data("speed") + "s",
    });
    
    if(target_object.data('default-effect-type') == 'multi') {
		opacity = target_object.data("opacity");
		gradient_color_one_rgb = hexToRgbA(target_object.data("gradient-color-one"));
		gradient_color_two_rgb = hexToRgbA(target_object.data("gradient-color-two"));
		gradient_color_direction = target_object.data("gradient-color-direction");
		
		gradient_color_one = 'rgba('+gradient_color_one_rgb+','+opacity+')';
		gradient_color_two = 'rgba('+gradient_color_two_rgb+','+opacity+')';
		
		target_object = t.parent().find(".wop_overlay"), target_object.css({
         "background": 'linear-gradient('+gradient_color_direction+','+gradient_color_one+', '+gradient_color_two+')'
		});
	}else{
		
		target_object = t.parent().find(".wop_overlay"), target_object.css({
           "background-color": target_object.data("color")
		});
    
	}
    
    var e = new String(target_object.data("height"));
    h_index = e.indexOf("px"), -1 != h_index ? height = e : height = e + "%";
    var a = new String(target_object.data("width"));
    w_index = a.indexOf("px"), -1 != w_index ? width = a : width = a + "%", target_object.css({
        height: height,
        width: width
    }), in_effect = target_object.data("in"), target_object.removeClass().addClass("wop_overlay").addClass(in_effect + " animated ")
}

function outEffect(t) {
    out_effect = t.parent().find(".wop_overlay").data("out"), t.parent().find(".wop_overlay").removeClass().addClass("wop_overlay").addClass(out_effect + " animated")
}
jQuery(document).ready(function(t) {
    "true" == settings_obj.show_on_pageload && t(".overlay-effect[rel='custom_overlay'] .wop_img").each(function(e, a) {
        inEffect(t(a))
    }), "true" == settings_obj.show_always ? t(".overlay-effect[rel='custom_overlay'] .wop_img").each(function(e, a) {
        inEffect(t(a))
    }) : t(".overlay-effect[rel='custom_overlay'] .wop_img").mouseenter(function() {
        inEffect(t(this))
    }).mouseleave(function() {
        outEffect(t(this))
    })
});
