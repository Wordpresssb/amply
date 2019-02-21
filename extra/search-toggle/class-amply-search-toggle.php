<?php
/**
 * Search toggle
 *
 * @package amply
 */

/**
 * Amply_Search_Toggle class
 */
if ( ! class_exists( 'Amply_Search_Toggle' ) ) {

	/**
	 * Amply_Search_Toggle class
	 */
	class Amply_Search_Toggle {

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

			add_action( 'after_setup_theme', array( $this, 'search_toggle_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'load_search_toggle_component' ) );

		}

		/**
		 * Register search toggle options.
		 */
		public function search_toggle_options() {

			require_once get_template_directory() . '/extra/search-toggle/options/search-toggle-options.php';

		}

		/**
		 * JS for search toggle controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-search-toggle-controls-pane-js', get_theme_file_uri( '/extra/search-toggle/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Load appropriate search toggle component.
		 */
		public function load_search_toggle_component() {

			require_once get_template_directory() . '/extra/search-toggle/class-amply-search-toggle-component.php';

		}

	}

}
Amply_Search_Toggle::get_instance();
