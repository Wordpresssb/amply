<?php
/**
 * Single banner
 *
 * @package amply
 */

/**
 * Amply_Single_Banner class
 */
if ( ! class_exists( 'Amply_Single_Banner' ) ) {

	/**
	 * Amply_Single_Banner class
	 */
	class Amply_Single_Banner {

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

			add_action( 'after_setup_theme', array( $this, 'single_banner_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_banner_component' ), 9 );

		}

		/**
		 * Register single banner options.
		 */
		public function single_banner_options() {

			require_once get_template_directory() . '/extra/single/banner/options/single-banner-options.php';

		}

		/**
		 * JS for single banner controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-single-banner-controls-pane-js', get_theme_file_uri( '/extra/single/banner/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default banner component.
		 */
		public function replace_default_banner_component() {

			$single_banner = amply_option( 'amply_single_banner_type' );

			if ( is_singular( 'post' ) && 'default' !== $single_banner ) {

				// Remove default banner on single posts.
				remove_action( 'template_redirect', array( Amply_Default_Banner::get_instance(), 'load_default_banner_component' ) );

				// Load the appropriate module instead.
				add_action( 'template_redirect', array( $this, 'load_single_banner_component' ) );

			}

		}

		/**
		 * Load appropriate banner component.
		 */
		public function load_single_banner_component() {

			require_once get_template_directory() . '/extra/single/banner/class-amply-single-banner-component.php';

		}

	}

}
Amply_Single_Banner::get_instance();
