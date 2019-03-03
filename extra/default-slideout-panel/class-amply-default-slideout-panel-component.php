<?php
/**
 * Default slide out panel component
 *
 * @package amply
 */

/**
 * Amply_Default_Slideout_Panel_Component class
 */
if ( ! class_exists( 'Amply_Default_Slideout_Panel_Component' ) ) {

	/**
	 * Amply_Default_Slideout_Panel_Component class
	 */
	class Amply_Default_Slideout_Panel_Component {

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

			add_action( 'wp_footer', array( $this, 'default_slideout_panel_view' ) );
			add_action( 'body_class', array( $this, 'default_slideout_panel_body_classes' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'default_slideout_panel_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'default_slideout_panel_scripts' ) );

		}

		/**
		 * Load default slideout panel view
		 */
		public function default_slideout_panel_view() {

			get_template_part( 'views/slideout-panel/slideout-panel-layout' );

		}

		/**
		 * Add classes to body
		 *
		 * @param array $classes Body classes.
		 * @return array $classes Body classes.
		 */
		public function default_slideout_panel_body_classes( $classes ) {

			// Slideout panel position.
			$classes[] = amply_option( 'amply_default_slideout_panel_position' );

			return $classes;

		}

		/**
		 * Enqueue default slideout panel styles.
		 */
		public function default_slideout_panel_styles() {

			wp_enqueue_style( 'amply-slideout-panel-style', get_theme_file_uri( 'views/slideout-panel/css/slideout-panel.css' ), array(), '20180514' );

		}

		/**
		 * Enqueue default slideout-panel scripts.
		 */
		public function default_slideout_panel_scripts() {

			// If the AMP plugin is active, return early.
			if ( amply_is_amp() ) {
				return;
			}

			wp_enqueue_script( 'amply-slideout-panel-script', get_theme_file_uri( 'views/slideout-panel/js/slideout-panel.js' ), array( 'jquery', 'amply-sidr' ), '20180514', true );

		}

	}

}
Amply_Default_Slideout_Panel_Component::get_instance();
