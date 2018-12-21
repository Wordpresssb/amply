<?php
/**
 * Page loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Page_Loop_Component class
 */
if ( ! class_exists( 'Amply_Default_Page_Loop_Component' ) ) {

	/**
	 * Amply_Default_Page_Loop_Component class
	 */
	class Amply_Default_Page_Loop_Component {

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

			add_action( 'amply_page_loop', array( $this, 'page_loop' ) );

		}

		/**
		 * Load appropriate loop
		 */
		public function page_loop() {

			get_template_part( 'views/page/loop' );

		}

	}

}
Amply_Default_Page_Loop_Component::get_instance();
