<?php
/**
 * Single sidebar
 *
 * @package amply
 */

/**
 * Amply_Single_Sidebar class
 */
if ( ! class_exists( 'Amply_Single_Sidebar' ) ) {

	/**
	 * Amply_Single_Sidebar class
	 */
	class Amply_Single_Sidebar {

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

			add_action( 'after_setup_theme', array( $this, 'single_sidebar_options' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'replace_default_sidebar_component' ), 9 );

		}

		/**
		 * Register single sidebar options.
		 */
		public function single_sidebar_options() {

			require_once get_template_directory() . '/extra/single/sidebar/options/single-sidebar-options.php';

		}

		/**
		 * JS for single sidebar controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-single-sidebar-controls-pane-js', get_theme_file_uri( '/extra/single/sidebar/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Replace the default sidebar component.
		 */
		public function replace_default_sidebar_component() {

			$single_sidebar = amply_option( 'amply_single_sidebar_type' );

			if ( is_singular( 'post' ) && 'default' !== $single_sidebar ) {

				// Remove default header on single posts page.
				remove_action( 'template_redirect', array( Amply_Default_Sidebar::get_instance(), 'load_default_sidebar_component' ) );

				// Load the single module instead.
				add_action( 'template_redirect', array( $this, 'load_single_sidebar_component' ) );

			}

		}

		/**
		 * Load appropriate single sidebar component.
		 */
		public function load_single_sidebar_component() {

			$single_sidebar = amply_option( 'amply_single_sidebar_type' );

			if ( 'none' === $single_sidebar ) {
				return;
			}

			require_once get_template_directory() . '/extra/single/sidebar/class-amply-single-sidebar-component.php';

		}

	}

}
Amply_Single_Sidebar::get_instance();
