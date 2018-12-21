<?php
/**
 * Index loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Index_Loop_Component class
 */
if ( ! class_exists( 'Amply_Default_Index_Loop_Component' ) ) {

	/**
	 * Amply_Default_Index_Loop_Component class
	 */
	class Amply_Default_Index_Loop_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the index layout.
		 *
		 * @var string
		 */
		public $index_layout;

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

			$this->get_index_layout();

			add_action( 'amply_index_loop', array( $this, 'index_loop' ) );

		}

		/**
		 * Get index layout from customizer.
		 */
		public function get_index_layout() {

			$this->index_layout = amply_option( 'amply_default_index_layout' );

		}

		/**
		 * Load appropriate loop
		 */
		public function index_loop() {

			if ( 'classic' === $this->index_layout ) {

				get_template_part( 'views/index/classic/loop' );

			}

		}

	}

}
Amply_Default_Index_Loop_Component::get_instance();
