<?php
/**
 * Slide out panel
 *
 * @package amply
 */

/**
 * Amply_Slideout_Panel class
 */
if ( ! class_exists( 'Amply_Slideout_Panel' ) ) {

	/**
	 * Amply_Slideout_Panel class
	 */
	class Amply_Slideout_Panel {

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

			add_action( 'after_setup_theme', array( $this, 'slideout_panel_options' ) );
			add_action( 'template_redirect', array( $this, 'load_slideout_panel_component' ) );

		}

		/**
		 * Register slideout panel options.
		 */
		public function slideout_panel_options() {

			require_once get_template_directory() . '/extra/slideout-panel/options/slideout-panel-options.php';

		}

		/**
		 * Load slideout panel component.
		 */
		public function load_slideout_panel_component() {

			if ( ! amply_option( 'amply_slideout_panel_activate' ) ) {
				return;
			}

			require_once get_template_directory() . '/extra/slideout-panel/class-amply-slideout-panel-component.php';

		}

	}

}
Amply_Slideout_Panel::get_instance();
