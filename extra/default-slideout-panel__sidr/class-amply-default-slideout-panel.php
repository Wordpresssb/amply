<?php
/**
 * Default slide out panel
 *
 * @package amply
 */

/**
 * Amply_Default_Slideout_Panel class
 */
if ( ! class_exists( 'Amply_Default_Slideout_Panel' ) ) {

	/**
	 * Amply_Default_Slideout_Panel class
	 */
	class Amply_Default_Slideout_Panel {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Getter
		 *
		 * @return Init
		 */
		public static function get_instance() {

			if ( null === static::$instance ) {
					static::$instance = new static();
			}
			return static::$instance;

		}

		/**
		 * Constructor
		 */
		private function __construct() {

			add_action( 'after_setup_theme', array( $this, 'default_slideout_panel_options' ) );
			add_action( 'template_redirect', array( $this, 'load_default_slideout_panel_component' ) );

		}

		/**
		 * Register slideout panel options.
		 */
		public function default_slideout_panel_options() {

			require_once get_template_directory() . '/extra/default-slideout-panel/options/default-slideout-panel-options.php';

		}

		/**
		 * Load slideout panel component.
		 */
		public function load_default_slideout_panel_component() {

			if ( ! amply_option( 'amply_default_slideout_panel_activate' ) ) {
				return;
			}

			require_once get_template_directory() . '/extra/default-slideout-panel/class-amply-default-slideout-panel-component.php';

		}

	}

}
Amply_Default_Slideout_Panel::get_instance();
