<?php
/**
 * Front page footer
 *
 * @package amply
 */

/**
 * Amply_Frontpage_Footer class
 */
if ( ! class_exists( 'Amply_Frontpage_Footer' ) ) {

	/**
	 * Amply_Frontpage_Footer class
	 */
	class Amply_Frontpage_Footer {

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

			add_action( 'after_setup_theme', array( $this, 'frontpage_footer_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_footer_component' ), 9 );

		}

		/**
		 * Register frontpage footer options.
		 */
		public function frontpage_footer_options() {

			require_once get_template_directory() . '/extra/frontpage/footer/options/frontpage-footer-options.php';

		}

		/**
		 * JS for frontpage footer controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-frontpage-footer-controls-pane-js', get_theme_file_uri( '/extra/frontpage/footer/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default footer component.
		 */
		public function replace_default_footer_component() {

			$fp_footer = amply_option( 'amply_frontpage_footer_type' );

			if ( is_front_page() && 'default' !== $fp_footer ) {

				// Remove default footer on front page.
				remove_action( 'template_redirect', array( Amply_Default_Footer::get_instance(), 'load_default_footer_component' ) );

				// Load the front page module instead.
				add_action( 'template_redirect', array( $this, 'load_frontpage_footer_component' ) );

			}

		}

		/**
		 * Load appropriate front page footer component.
		 */
		public function load_frontpage_footer_component() {

			require_once get_template_directory() . '/extra/frontpage/footer/class-amply-frontpage-footer-component.php';

		}

	}

}
Amply_Frontpage_Footer::get_instance();
