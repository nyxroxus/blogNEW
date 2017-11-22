<?php
/**
 * Class: WOP_Model_Settings
 * @author Flipper Code <hello@flippercode.com>
 * @version 2.0.0
 * @package Posts
 */

if ( ! class_exists( 'WOP_Model_Settings' ) ) {

	/**
	 * Setting model for Plugin Options.
	 * @package Posts
	 * @author Flipper Code <hello@flippercode.com>
	 */
	class WOP_Model_Settings extends FlipperCode_Model_Base {
		/**
		 * Intialize Backup object.
		 */
		function __construct() {
		}
		/**
		 * Admin menu for Settings Operation
		 * @return array Admin menu navigation(s).
		 */
		function navigation() {
			return array(
				'ihep_how_overview' => __( 'How to Use', WOP_TEXT_DOMAIN ),
				'ihep_effects_settings' => __( 'Effects Gallery', WOP_TEXT_DOMAIN ),
				'ihep_manage_settings' => __( 'Plugin Settings', WOP_TEXT_DOMAIN )
			);
		}
		/**
		 * Add or Edit Operation.
		 */
		function save() {
			
			if ( isset( $_REQUEST['_wpnonce'] ) )
			$nonce = sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) );

			if ( isset( $nonce ) and ! wp_verify_nonce( $nonce, 'wpgmp-nonce' ) )
			die( 'Cheating...' );


			$this->verify( $_POST );

			if ( is_array( $this->errors ) and ! empty( $this->errors ) )
			$this->throw_errors();
			
			$settings = wp_unslash( $_POST );
			$settings = apply_filters('wp_ihep_final_settings',$settings);
			update_option( 'wp-ihep-settings',  $settings);
			$response['success'] = __( 'Setting(s) saved successfully.',WOP_TEXT_DOMAIN );
			return $response;

		}
	}
}
