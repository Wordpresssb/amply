<?php
/**
 * Default Sidebar
 *
 * @package amply
 */

/**
 * Amply_Default_Sidebar class
 */
if ( ! class_exists( 'Amply_Default_Sidebar' ) ) {

	/**
	 * Amply_Default_Sidebar class
	 */
	class Amply_Default_Sidebar {

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

			add_action( 'after_setup_theme', array( $this, 'default_sidebar_options' ) );
			add_action( 'customize_controls_print_styles', array( $this, 'customize_controls_pane_css' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'load_default_sidebar_component' ) );

		}

		/**
		 * Register default sidebar options.
		 */
		public function default_sidebar_options() {

			require_once get_template_directory() . '/extra/default-sidebar/options/default-sidebar-options.php';

		}

		/**
		 * CSS for default sidebar controls.
		 */
		public function customize_controls_pane_css() {

			wp_enqueue_style( 'amply-default-sidebar-controls-pane-css', get_theme_file_uri( '/extra/default-sidebar/css/customize-controls.css' ), null, AMPLY_THEME_VERSION );

		}

		/**
		 * JS for default sidebar controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-default-sidebar-controls-pane-js', get_theme_file_uri( '/extra/default-sidebar/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Load appropriate sidebar component.
		 */
		public function load_default_sidebar_component() {

			$sidebar_layout = amply_option( 'amply_default_sidebar_type' );

			if ( 'none' === $sidebar_layout ) {
				return;
			}

			require_once get_template_directory() . '/extra/default-sidebar/class-amply-default-sidebar-component.php';

		}

	}

}
Amply_Default_Sidebar::get_instance();
