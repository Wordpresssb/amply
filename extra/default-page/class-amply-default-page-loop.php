<?php
/**
 * Page loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Page_Loop class
 */
if ( ! class_exists( 'Amply_Default_Page_Loop' ) ) {

	/**
	 * Amply_Default_Page_Loop class
	 */
	class Amply_Default_Page_Loop {

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

			add_action( 'template_redirect', array( $this, 'load_default_page_loop_component' ) );

		}

		/**
		 * Load appropriate index loop component.
		 */
		public function load_default_page_loop_component() {

			require_once get_template_directory() . '/extra/default-page/class-amply-default-page-loop-component.php';

		}

	}

}
Amply_Default_Page_Loop::get_instance();
