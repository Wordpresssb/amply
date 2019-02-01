<?php
/**
 * Front page header
 *
 * @package amply
 */

/**
 * Amply_Frontpage_Header class
 */
if ( ! class_exists( 'Amply_Frontpage_Header' ) ) {

	/**
	 * Amply_Frontpage_Header class
	 */
	class Amply_Frontpage_Header {

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

			add_action( 'after_setup_theme', array( $this, 'frontpage_header_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_header_component' ), 9 );

		}

		/**
		 * Register frontpage header options.
		 */
		public function frontpage_header_options() {

			require_once get_template_directory() . '/extra/frontpage/header/options/frontpage-header-options.php';

		}

		/**
		 * JS for frontpage header controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-frontpage-header-controls-pane-js', get_theme_file_uri( '/extra/frontpage/header/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default header component.
		 */
		public function replace_default_header_component() {

			$fp_header = amply_option( 'amply_frontpage_header_type' );

			if ( is_front_page() && 'default' !== $fp_header ) {

				// Remove default header on front page.
				remove_action( 'template_redirect', array( Amply_Default_Header::get_instance(), 'load_default_header_component' ) );

				// Load the front page module instead.
				add_action( 'template_redirect', array( $this, 'load_frontpage_header_component' ) );

			}

		}

		/**
		 * Load appropriate front page header component.
		 */
		public function load_frontpage_header_component() {

			require_once get_template_directory() . '/extra/frontpage/header/class-amply-frontpage-header-component.php';

		}

	}

}
Amply_Frontpage_Header::get_instance();
