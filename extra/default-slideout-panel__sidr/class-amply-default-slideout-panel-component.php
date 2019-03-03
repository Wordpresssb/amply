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
			add_action( 'wp_footer', array( $this, 'default_slideout_panel_trigger_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'default_slideout_panel_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'default_slideout_panel_scripts' ) );

		}

		/**
		 * Load default slideout panel view
		 */
		public function default_slideout_panel_view() {

			if ( 'template' === amply_option( 'amply_default_slideout_panel_content_type' ) ) {

				get_template_part( 'views/slideout-panel/slideout-panel-cpt' );

			}

			if ( 'widgets' === amply_option( 'amply_default_slideout_panel_content_type' ) ) {

				get_template_part( 'views/slideout-panel/slideout-panel-widgets' );

			}

		}

		/**
		 * Load default slideout panel trigger view
		 */
		public function default_slideout_panel_trigger_view() {

			get_template_part( 'views/slideout-panel/slideout-panel-trigger' );

		}

		/**
		 * Enqueue default slideout panel styles.
		 */
		public function default_slideout_panel_styles() {

			if ( amply_is_amp() ) {

				wp_enqueue_style( 'amply-slideout-slideout-panel-amp', get_theme_file_uri( 'views/slideout-panel/css/slideout-panel-amp.css' ), array(), '20180514' );

			} else {

				wp_enqueue_style( 'amply-slideout-slideout-panel-sidr', get_theme_file_uri( 'views/slideout-panel/css/slideout-panel-sidr.css' ), array(), '20180514' );

				if ( 'template' === amply_option( 'amply_default_slideout_panel_content_type' ) ) {
					wp_enqueue_style( 'amply-slideout-cpt-sidr', get_theme_file_uri( 'views/slideout-panel/css/slideout-cpt-sidr.css' ), array(), '20180514' );
				} else {
					wp_enqueue_style( 'amply-slideout-widgets-sidr', get_theme_file_uri( 'views/slideout-panel/css/slideout-widgets-sidr.css' ), array(), '20180514' );
				}
			}

		}

		/**
		 * Enqueue default slideout-panel scripts.
		 */
		public function default_slideout_panel_scripts() {

			// If the AMP plugin is active, return early.
			if ( amply_is_amp() ) {
				return;
			}

			// Enqueue sidr menu script.
			wp_enqueue_script( 'amply-slideout-panel-sidr', get_theme_file_uri( 'views/slideout-panel/js/slideout-panel-sidr.js' ), array( 'jquery', 'amply-sidr' ), '20180514', true );

		}

	}

}
Amply_Default_Slideout_Panel_Component::get_instance();
