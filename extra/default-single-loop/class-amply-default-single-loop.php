<?php
/**
 * Single loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Single_Loop class
 */
if ( ! class_exists( 'Amply_Default_Single_Loop' ) ) {

	/**
	 * Amply_Default_Single_Loop class
	 */
	class Amply_Default_Single_Loop {

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

			add_action( 'template_redirect', array( $this, 'load_default_single_loop_component' ) );

		}

		/**
		 * Load appropriate single loop component.
		 */
		public function load_default_single_loop_component() {

			require_once get_template_directory() . '/extra/default-single-loop/class-amply-default-single-loop-component.php';

		}

	}

}
Amply_Default_Single_Loop::get_instance();
