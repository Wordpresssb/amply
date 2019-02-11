<?php
/**
 * Default Footer
 *
 * @package amply
 */

/**
 * Amply_Default_Footer class
 */
if ( ! class_exists( 'Amply_Default_Footer' ) ) {

	/**
	 * Amply_Default_Footer class
	 */
	class Amply_Default_Footer {

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

			add_action( 'after_setup_theme', array( $this, 'default_footer_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'load_default_footer_component' ) );

		}

		/**
		 * Register default footer options.
		 */
		public function default_footer_options() {

			require_once get_template_directory() . '/extra/default-footer/options/default-footer-options.php';

		}

		/**
		 * JS for default footer controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-default-footer-controls-pane-js', get_theme_file_uri( '/extra/default-footer/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Load appropriate footer component.
		 */
		public function load_default_footer_component() {

			require_once get_template_directory() . '/extra/default-footer/class-amply-default-footer-component.php';

		}

	}

}
Amply_Default_Footer::get_instance();
