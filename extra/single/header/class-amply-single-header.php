<?php
/**
 * Single header
 *
 * @package amply
 */

/**
 * Amply_Single_Header class
 */
if ( ! class_exists( 'Amply_Single_Header' ) ) {

	/**
	 * Amply_Single_Header class
	 */
	class Amply_Single_Header {

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

			add_action( 'after_setup_theme', array( $this, 'single_header_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_header_component' ), 9 );

		}

		/**
		 * Register frontpage header options.
		 */
		public function single_header_options() {

			require_once get_template_directory() . '/extra/single/header/options/single-header-options.php';

		}

		/**
		 * JS for single header controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-single-header-controls-pane-js', get_theme_file_uri( '/extra/single/header/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default header component.
		 */
		public function replace_default_header_component() {

			$single_header = amply_option( 'amply_single_header_type' );

			if ( is_singular( 'post' ) && 'default' !== $single_header ) {

				// Remove default header on singular posts.
				remove_action( 'template_redirect', array( Amply_Default_Header::get_instance(), 'load_default_header_component' ) );

				// Load the front page module instead.
				add_action( 'template_redirect', array( $this, 'load_single_header_component' ) );

			}

		}

		/**
		 * Load appropriate single header component.
		 */
		public function load_single_header_component() {

			require_once get_template_directory() . '/extra/single/header/class-amply-single-header-component.php';

		}

	}

}
Amply_Single_Header::get_instance();
