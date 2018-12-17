<?php
/**
 * Index loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Index_Loop class
 */
if ( ! class_exists( 'Amply_Default_Index_Loop' ) ) {

	/**
	 * Amply_Default_Index_Loop class
	 */
	class Amply_Default_Index_Loop {

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

			add_action( 'after_setup_theme', array( $this, 'default_index_options' ) );
			add_action( 'template_redirect', array( $this, 'load_default_index_loop_component' ) );

		}

		/**
		 * Register default index options.
		 */
		public function default_index_options() {

			require_once get_template_directory() . '/extra/default-index/options/default-index-options.php';

		}

		/**
		 * Load appropriate index loop component.
		 */
		public function load_default_index_loop_component() {

			require_once get_template_directory() . '/extra/default-index/class-amply-default-index-loop-component.php';

		}

	}

}
Amply_Default_Index_Loop::get_instance();
