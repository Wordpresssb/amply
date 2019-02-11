<?php
/**
 * Front page banner
 *
 * @package amply
 */

/**
 * Amply_Frontpage_Banner class
 */
if ( ! class_exists( 'Amply_Frontpage_Banner' ) ) {

	/**
	 * Amply_Frontpage_Banner class
	 */
	class Amply_Frontpage_Banner {

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

			add_action( 'after_setup_theme', array( $this, 'frontpage_banner_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_banner_component' ), 9 );

		}

		/**
		 * Register frontpage banner options.
		 */
		public function frontpage_banner_options() {

			require_once get_template_directory() . '/extra/frontpage/banner/options/frontpage-banner-options.php';

		}

		/**
		 * JS for frontpage banner controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-frontpage-banner-controls-pane-js', get_theme_file_uri( '/extra/frontpage/banner/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default banner component.
		 */
		public function replace_default_banner_component() {

			$fp_banner = amply_option( 'amply_frontpage_banner_type' );

			if ( is_front_page() && 'default' !== $fp_banner ) {

				// Remove default banner on front page.
				remove_action( 'template_redirect', array( Amply_Default_Banner::get_instance(), 'load_default_banner_component' ) );

				// Load the front page module instead.
				add_action( 'template_redirect', array( $this, 'load_frontpage_banner_component' ) );

			}

		}

		/**
		 * Load appropriate front page banner component.
		 */
		public function load_frontpage_banner_component() {

			require_once get_template_directory() . '/extra/frontpage/banner/class-amply-frontpage-banner-component.php';

		}

	}

}
Amply_Frontpage_Banner::get_instance();
