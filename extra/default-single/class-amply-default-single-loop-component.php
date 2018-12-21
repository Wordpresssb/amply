<?php
/**
 * Single loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Single_Loop_Component class
 */
if ( ! class_exists( 'Amply_Default_Single_Loop_Component' ) ) {

	/**
	 * Amply_Default_Single_Loop_Component class
	 */
	class Amply_Default_Single_Loop_Component {

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

			add_action( 'amply_single_loop', array( $this, 'single_loop' ) );

		}

		/**
		 * Load appropriate loop
		 */
		public function single_loop() {

			get_template_part( 'views/single/loop' );

		}

	}

}
Amply_Default_Single_Loop_Component::get_instance();
