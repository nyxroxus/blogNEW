<?php

function add_global_custom_options(){
add_options_page('Global Custom Options', 'Global Custom Options', 'manage_options', 'functions','global_custom_options');
}
function global_custom_options()
{
?>
<div class="wrap">
<h2>Global Custom Options</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options') ?>
<p><strong>Twitter ID:</strong><br />
    <input type="text" name="twitterid" size="45" value="<?php echo get_option('twitterid'); ?>" />
</p>
<!-- Changing background color -->
<p><strong>Change website background color</strong>
  <input type="text" name="" value="" class="color-field"/>
</p>
<p><strong>Change link color</strong></p>
<p><strong>Update header image</strong>
  
</p>
<p><strong>Select the color scheme</strong><br />
	<select class="select_color_scheme" name="color_scheme" id="color_scheme">
		<option value="default_color_scheme" <?php selected(get_option('color_scheme'), "default_color_scheme"); ?>>Default color scheme(Lightred/Darkpurple)</option>

		<option value="fun_and_profesional_color_scheme" <?php selected(get_option('color_scheme'), "fun_and_profesional_color_scheme"); ?>>Fun and profesional color scheme(Fresh/Vermilion/Sunshine/Clean)</option>

		<option value="clear_and_highlighted_color_scheme" <?php selected(get_option('color_scheme'), "clear_and_highlighted_color_scheme"); ?>>Clear and highlighted color scheme(Sky/Carbon/Watermelon/Neutral)</option>

		<option value="warm_tones_color_scheme" <?php selected(get_option('color_scheme'), "warm_tones_color_scheme"); ?>>Warm tones color scheme(Grain/Blackboard/Oxblood/Tan)</option>

		<option value="bold_and_punchy_color_scheme" <?php selected(get_option('color_scheme'), "bold_and_punchy_color_scheme"); ?>>Bold and punchy color scheme(Papaya/Mustard/Blush/Aqua)</option>
	</select>
</p>
<p><strong>Select the blog font</strong><br />
	<select class="select_font" name="select_font" id="select_font">
		<option value="font-one" <?php selected(get_option('select_font'), "font-one"); ?>>Monseratt</option>

		<option value="font-two" <?php selected(get_option('select_font'), "font-two"); ?>>Roboto</option>

		<option value="font-three" <?php selected(get_option('select_font'), "font-three"); ?>>Raleway</option>

		<option value="font-four" <?php selected(get_option('select_font'), "font-four"); ?>>Titilium Web</option>
	</select>
</p>
<p><strong>Change website title</strong><br />
	<input type="text" name="blogname" value="<?php echo get_option('blogname') ?>" />

</p>
<p><input type="submit" name="Submit" value="Store Options" /></p>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="twitterid, color_scheme, blogname, select_font" />
</form>
</div>

<?php
}
add_action('admin_enqueue_scripts', function(){
    /*
    if possible try not to queue this all over the admin by adding your settings GET page val into next
    if( empty( $_GET['page'] ) || "my-settings-page" !== $_GET['page'] ) { return; }
    */
    wp_enqueue_media();
});

add_action('admin_footer', function() {

    /*
    if possible try not to queue this all over the admin by adding your settings GET page val into next
    if( empty( $_GET['page'] ) || "my-settings-page" !== $_GET['page'] ) { return; }
    */

    ?>

    <script>
        jQuery(document).ready(function($){

            var custom_uploader
              , click_elem = jQuery('.wpse-228085-upload')
              , target = jQuery('.wrap input[name="logo"]')

            click_elem.click(function(e) {
                e.preventDefault();
                //If the uploader object has already been created, reopen the dialog
                if (custom_uploader) {
                    custom_uploader.open();
                    return;
                }
                //Extend the wp.media object
                custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });
                //When a file is selected, grab the URL and set it as the text field's value
                custom_uploader.on('select', function() {
                    attachment = custom_uploader.state().get('selection').first().toJSON();
                    target.val(attachment.url);
                });
                //Open the uploader dialog
                custom_uploader.open();
            });
        });
    </script>

    <?php
    });

add_action('admin_menu', 'add_global_custom_options');
?>
