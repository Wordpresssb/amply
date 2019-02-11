<?php
/**
 * Default Banner
 *
 * @package amply
 */

/**
 * Amply_Default_Banner class
 */
if ( ! class_exists( 'Amply_Default_Banner' ) ) {

	/**
	 * Amply_Default_Banner class
	 */
	class Amply_Default_Banner {

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

			add_action( 'after_setup_theme', array( $this, 'default_banner_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'load_default_banner_component' ) );

		}

		/**
		 * Register default banner options.
		 */
		public function default_banner_options() {

			require_once get_template_directory() . '/extra/default-banner/options/default-banner-options.php';

		}

		/**
		 * JS for default banner controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-default-banner-controls-pane-js', get_theme_file_uri( '/extra/default-banner/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Load appropriate banner component.
		 */
		public function load_default_banner_component() {

			require_once get_template_directory() . '/extra/default-banner/class-amply-default-banner-component.php';

		}

	}

}
Amply_Default_Banner::get_instance();
