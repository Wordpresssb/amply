<?php
/**
 * Front page sidebar
 *
 * @package amply
 */

/**
 * Amply_Frontpage_Sidebar class
 */
if ( ! class_exists( 'Amply_Frontpage_Sidebar' ) ) {

	/**
	 * Amply_Frontpage_Sidebar class
	 */
	class Amply_Frontpage_Sidebar {

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

			add_action( 'after_setup_theme', array( $this, 'frontpage_sidebar_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_sidebar_component' ), 9 );

		}

		/**
		 * Register frontpage sidebar options.
		 */
		public function frontpage_sidebar_options() {

			require_once get_template_directory() . '/extra/frontpage/sidebar/options/frontpage-sidebar-options.php';

		}

		/**
		 * JS for frontpage sidebar controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-frontpage-sidebar-controls-pane-js', get_theme_file_uri( '/extra/frontpage/sidebar/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default sidebar component.
		 */
		public function replace_default_sidebar_component() {

			$fp_sidebar = amply_option( 'amply_frontpage_sidebar_type' );

			if ( is_front_page() && 'default' !== $fp_sidebar ) {

				// Remove default header on front page.
				remove_action( 'template_redirect', array( Amply_Default_Sidebar::get_instance(), 'load_default_sidebar_component' ) );

				// Load the front page module instead.
				add_action( 'template_redirect', array( $this, 'load_frontpage_sidebar_component' ) );

			}

		}

		/**
		 * Load appropriate front page sidebar component.
		 */
		public function load_frontpage_sidebar_component() {

			$fp_sidebar = amply_option( 'amply_frontpage_sidebar_type' );

			if ( 'none' === $fp_sidebar ) {
				return;
			}

			require_once get_template_directory() . '/extra/frontpage/sidebar/class-amply-frontpage-sidebar-component.php';

		}

	}

}
Amply_Frontpage_Sidebar::get_instance();
