<?php
/**
 * Single footer
 *
 * @package amply
 */

/**
 * Amply_Single_Footer class
 */
if ( ! class_exists( 'Amply_Single_Footer' ) ) {

	/**
	 * Amply_Single_Footer class
	 */
	class Amply_Single_Footer {

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

			add_action( 'after_setup_theme', array( $this, 'single_footer_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_footer_component' ), 9 );

		}

		/**
		 * Register single footer options.
		 */
		public function single_footer_options() {

			require_once get_template_directory() . '/extra/single/footer/options/single-footer-options.php';

		}

		/**
		 * JS for single footer controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-single-footer-controls-pane-js', get_theme_file_uri( '/extra/single/footer/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default footer component.
		 */
		public function replace_default_footer_component() {

			$single_footer = amply_option( 'amply_single_footer_type' );

			if ( is_singular( 'post' ) && 'default' !== $single_footer ) {

				// Remove default footer on single posts.
				remove_action( 'template_redirect', array( Amply_Default_Footer::get_instance(), 'load_default_footer_component' ) );

				// Load the appropriate module instead.
				add_action( 'template_redirect', array( $this, 'load_single_footer_component' ) );

			}

		}

		/**
		 * Load appropriate footer component.
		 */
		public function load_single_footer_component() {

			require_once get_template_directory() . '/extra/single/footer/class-amply-single-footer-component.php';

		}

	}

}
Amply_Single_Footer::get_instance();
