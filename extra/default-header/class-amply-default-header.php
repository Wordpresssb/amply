<?php
/**
 * Default Header
 *
 * @package amply
 */

/**
 * Amply_Default_Header class
 */
if ( ! class_exists( 'Amply_Default_Header' ) ) {

	/**
	 * Amply_Default_Header class
	 */
	class Amply_Default_Header {

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

			add_action( 'after_setup_theme', array( $this, 'default_header_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_default_header_controls_pane' ) );
			add_action( 'template_redirect', array( $this, 'load_default_header_component' ) );

		}

		/**
		 * Register default header options.
		 */
		public function default_header_options() {

			require_once get_template_directory() . '/extra/default-header/options/default-header-options.php';

		}

		/**
		 * Customize default header controls.
		 */
		public function customize_default_header_controls_pane() {

			wp_enqueue_script( 'wprig-default-header-controls-pane-js', get_theme_file_uri( '/extra/default-header/js/customizer-control.js' ), array( 'customize-controls', 'jquery' ), '20151215', true );

		}

		/**
		 * Load appropriate header component.
		 */
		public function load_default_header_component() {

			require_once get_template_directory() . '/extra/default-header/class-amply-default-header-component.php';

		}

	}

}
Amply_Default_Header::get_instance();
