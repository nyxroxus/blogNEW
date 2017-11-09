<?php
class ThemeOptions {
private $theme_options_options;

public function __construct() {
	add_action( 'admin_menu', array( $this, 'theme_options_add_plugin_page' ) );
	add_action( 'admin_init', array( $this, 'theme_options_page_init' ) );
}
public function theme_options_add_plugin_page() {
	add_menu_page(
		'Theme options', // page_title
		'Theme options', // menu_title
		'manage_options', // capability
		'theme-options', // menu_slug
		array( $this, 'theme_options_create_admin_page' ), // function
		'dashicons-businessman', // icon_url
		3 // position
	);
}
public function theme_options_create_admin_page() {
  $this->theme_options_options = get_option( 'theme_options_option_name' ); ?>

  <div class="wrap">
  	<h2>Theme options</h2>
  	<p>Here you can further customize this theme</p>
  	<?php settings_errors(); ?>

  	<form method="post" action="options.php">
  		<?php
  			settings_fields( 'theme_options_option_group' );
  			do_settings_sections( 'theme-options-admin' );
  			submit_button();
  		?>
  	</form>
  </div>
<?php }

public function theme_options_page_init() {
	register_setting(
		'theme_options_option_group', // option_group
		'theme_options_option_name', // option_name
		array( $this, 'theme_options_sanitize' ) // sanitize_callback
	);

	add_settings_section(
		'theme_options_setting_section', // id
		'Settings', // title
		array( $this, 'theme_options_section_info' ), // callback
		'theme-options-admin' // page
	);

	add_settings_field(
		'choose_your_color_scheme_0', // id
		'Choose your color scheme', // title
		array( $this, 'choose_your_color_scheme_0_callback' ), // callback
		'theme-options-admin', // page
		'theme_options_setting_section' // section
	);

	add_settings_field(
		'choose_content_layouts_on_pages_1', // id
		'Choose content layouts on pages', // title
		array( $this, 'choose_content_layouts_on_pages_1_callback' ), // callback
		'theme-options-admin', // page
		'theme_options_setting_section' // section
	);

	add_settings_field(
		'change_current_user_display_color_except_rgb_only_2', // id
		'Change current user display color (except RGB only)', // title
		array( $this, 'change_current_user_display_color_except_rgb_only_2_callback' ), // callback
		'theme-options-admin', // page
		'theme_options_setting_section' // section
	);
}

public function theme_options_sanitize($input) {
	$sanitary_values = array();
	if ( isset( $input['choose_your_color_scheme_0'] ) ) {
		$sanitary_values['choose_your_color_scheme_0'] = $input['choose_your_color_scheme_0'];
	}

	if ( isset( $input['choose_content_layouts_on_pages_1'] ) ) {
		$sanitary_values['choose_content_layouts_on_pages_1'] = $input['choose_content_layouts_on_pages_1'];
	}

	if ( isset( $input['change_current_user_display_color_except_rgb_only_2'] ) ) {
		$sanitary_values['change_current_user_display_color_except_rgb_only_2'] = sanitize_text_field( $input['change_current_user_display_color_except_rgb_only_2'] );
	}

	return $sanitary_values;
}

public function theme_options_section_info() {

}

public function choose_your_color_scheme_0_callback() {
  ?>
  <select name="theme_options_option_name[choose_your_color_scheme_0]" id="choose_your_color_scheme_0">
	<?php $selected = (isset( $this->theme_options_options['choose_your_color_scheme_0'] ) && $this->theme_options_options['choose_your_color_scheme_0'] === 'darkpurple-lightred') ? 'selected' : '' ; ?>
	<option value="darkpurple-lightred" <?php echo $selected; ?>>Dark purple/Light red</option>
	<?php $selected = (isset( $this->theme_options_options['choose_your_color_scheme_0'] ) && $this->theme_options_options['choose_your_color_scheme_0'] === 'yellow-darkblue') ? 'selected' : '' ; ?>
	<option value="yellow-darkblue" <?php echo $selected; ?>>Yellow/Dark blue</option>
	<?php $selected = (isset( $this->theme_options_options['choose_your_color_scheme_0'] ) && $this->theme_options_options['choose_your_color_scheme_0'] === 'sand-darkblue') ? 'selected' : '' ; ?>
	<option value="sand-darkblue" <?php echo $selected; ?>> Sand/Dark blue</option>
</select> <?php
	}

public function choose_content_layouts_on_pages_1_callback() {
	?> <fieldset><?php $checked = ( isset( $this->theme_options_options['choose_content_layouts_on_pages_1'] ) && $this->theme_options_options['choose_content_layouts_on_pages_1'] === 'masonry' ) ? 'checked' : '' ; ?>
	<label for="choose_content_layouts_on_pages_1-0"><input type="radio" name="theme_options_option_name[choose_content_layouts_on_pages_1]" id="choose_content_layouts_on_pages_1-0" value="masonry" <?php echo $checked; ?>> Masonry layout</label><br>
	<?php $checked = ( isset( $this->theme_options_options['choose_content_layouts_on_pages_1'] ) && $this->theme_options_options['choose_content_layouts_on_pages_1'] === 'list' ) ? 'checked' : '' ; ?>
	<label for="choose_content_layouts_on_pages_1-1"><input type="radio" name="theme_options_option_name[choose_content_layouts_on_pages_1]" id="choose_content_layouts_on_pages_1-1" value="list" <?php echo $checked; ?>>  List layout</label></fieldset> <?php
}

public function change_current_user_display_color_except_rgb_only_2_callback() {
	printf(
		'<input class="regular-text" type="text" name="theme_options_option_name[change_current_user_display_color_except_rgb_only_2]" id="change_current_user_display_color_except_rgb_only_2" value="%s">',
		isset( $this->theme_options_options['change_current_user_display_color_except_rgb_only_2'] ) ? esc_attr( $this->theme_options_options['change_current_user_display_color_except_rgb_only_2']) : ''
	);
}

}
if ( is_admin() )
	$theme_options = new ThemeOptions();

/*
 * Retrieve this value with:
 * $theme_options_options = get_option( 'theme_options_option_name' ); // Array of All Options
 * $choose_your_color_scheme_0 = $theme_options_options['choose_your_color_scheme_0']; // Choose your color scheme
 * $choose_content_layouts_on_pages_1 = $theme_options_options['choose_content_layouts_on_pages_1']; // Choose content layouts on pages
 * $change_current_user_display_color_except_rgb_only_2 = $theme_options_options['change_current_user_display_color_except_rgb_only_2']; // Change current user display color (except RGB only)
 */

 ?>
