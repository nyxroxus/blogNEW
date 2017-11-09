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
<p><strong>Change website background color</strong></p>
<p><strong>Change link color</strong></p>
<p><strong>Change heading color</strong></p>
<p><strong>Select the select</strong><br />
	<select class="select_color_scheme" name="color_scheme" id="color_scheme">
		<option value="default_color_scheme" <?php selected(get_option('color_scheme'), "default_color_scheme"); ?>>Default color scheme(Lightred/Darkpurple)</option>

		<option value="fun_and_profesional_color_scheme" <?php selected(get_option('color_scheme'), "fun_and_profesional_color_scheme"); ?>>Fun and profesional color scheme(Fresh/Vermilion/Sunshine/Clean)</option>

		<option value="clear_and_highlighted_color_scheme" <?php selected(get_option('color_scheme'), "clear_and_highlighted_color_scheme"); ?>>Clear and highlighted color scheme(Sky/Carbon/Watermelon/Neutral)</option>

		<option value="warm_tones_color_scheme" <?php selected(get_option('color_scheme'), "warm_tones_color_scheme"); ?>>Warm tones color scheme(Grain/Blackboard/Oxblood/Tan)</option>

		<option value="bold_and_punchy_color_scheme" <?php selected(get_option('color_scheme'), "bold_and_punchy_color_scheme"); ?>>Bold and punchy color scheme(Papaya/Mustard/Blush/Aqua)</option>
	</select>
</p>
<p><strong>Change website title</strong><br />
	<input type="text" name="blogname" value="<?php echo get_option('blogname') ?>" />
</p>
<p><strong>Select logo image</strong><br />

</p>
<p><input type="submit" name="Submit" value="Store Options" /></p>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="twitterid, color_scheme, blogname" />
</form>
</div>
<?php
}

add_action('admin_menu', 'add_global_custom_options');
?>
