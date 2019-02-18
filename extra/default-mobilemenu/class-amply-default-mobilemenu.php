<?php
/**
 * Default mobile menu
 *
 * @package amply
 */

/**
 * Amply_Default_Mobilemenu class
 */
if ( ! class_exists( 'Amply_Default_Mobilemenu' ) ) {

	/**
	 * Amply_Default_Mobilemenu class
	 */
	class Amply_Default_Mobilemenu {

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

			add_action( 'after_setup_theme', array( $this, 'default_mobilemenu_options' ) );
			add_action( 'after_setup_theme', array( $this, 'load_walker_amp_nav_menu' ) );
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_controls_pane_js' ) );
			add_action( 'template_redirect', array( $this, 'load_default_mobilemenu_component' ) );

		}

		/**
		 * Register default mobile menu options.
		 */
		public function default_mobilemenu_options() {

			require_once get_template_directory() . '/extra/default-mobilemenu/options/default-mobilemenu-options.php';

		}

		/**
		 * Load Walker_Amp_Nav_Menu.
		 */
		public function load_walker_amp_nav_menu() {

			require get_template_directory() . '/extra/default-mobilemenu/walker/class-walker-amp-nav-menu.php';

		}

		/**
		 * JS for default mobile menu controls.
		 */
		public function customize_controls_pane_js() {

			wp_enqueue_script( 'amply-default-mobilemenu-controls-pane-js', get_theme_file_uri( '/extra/default-mobilemenu/js/customize-controls.js' ), array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

		}

		/**
		 * Load appropriate mobile menu component.
		 */
		public function load_default_mobilemenu_component() {

			require_once get_template_directory() . '/extra/default-mobilemenu/class-amply-default-mobilemenu-component.php';

		}

	}

}
Amply_Default_Mobilemenu::get_instance();
