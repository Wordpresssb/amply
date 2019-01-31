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
			add_action( 'customize_controls_print_styles', array( $this, 'customize_controls_pane_css' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'load_default_header_component' ) );

		}

		/**
		 * Register default header options.
		 */
		public function default_header_options() {

			require_once get_template_directory() . '/extra/default-header/options/default-header-options.php';

		}

		/**
		 * CSS for default header controls.
		 */
		public function customize_controls_pane_css() {

			wp_enqueue_style( 'amply-default-header-controls-pane-css', get_theme_file_uri( '/extra/default-header/css/customize-controls.css' ), null, AMPLY_THEME_VERSION );

		}

		/**
		 * JS for default header controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-default-header-controls-pane-js', get_theme_file_uri( '/extra/default-header/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

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
