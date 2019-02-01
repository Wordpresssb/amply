<?php
/**
 * Front page sidebar Component
 *
 * @package amply
 */

/**
 * Amply_Frontpage_Sidebar_Component class
 */
if ( ! class_exists( 'Amply_Frontpage_Sidebar_Component' ) ) {

	/**
	 * Amply_Frontpage_Sidebar_Component class
	 */
	class Amply_Frontpage_Sidebar_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the sidebar type.
		 *
		 * @var string
		 */
		public $sidebar;

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

			$this->get_sidebar_type();

			if ( 'sidebar-right' === $this->sidebar ) {

				add_action( 'amply_sidebar_right', array( $this, 'sidebar_right_view' ) );
				add_filter( 'body_class', array( $this, 'add_sidebar_right_body_class' ) );

			}

			if ( 'sidebar-left' === $this->sidebar ) {

				add_action( 'amply_sidebar_left', array( $this, 'sidebar_left_view' ) );
				add_filter( 'body_class', array( $this, 'add_sidebar_left_body_class' ) );

			}

			if ( 'sidebar-both' === $this->sidebar ) {

				add_action( 'amply_sidebar_left', array( $this, 'sidebar_left_view' ) );
				add_action( 'amply_sidebar_right', array( $this, 'sidebar_right_view' ) );
				add_filter( 'body_class', array( $this, 'add_sidebar_both_body_class' ) );

			}

		}

		/**
		 * Get front page sidebar type from customizer.
		 */
		public function get_sidebar_type() {

			$this->sidebar = amply_option( 'amply_frontpage_sidebar_type' );

		}

		/**
		 * Add sidebar right view.
		 */
		public function sidebar_right_view() {

			get_sidebar( 'right' );

		}

		/**
		 * Add sidebar left view.
		 */
		public function sidebar_left_view() {

			get_sidebar( 'left' );

		}

		/**
		 * Adds sidebar right class to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function add_sidebar_right_body_class( $classes ) {

			$classes[] = 'has-sidebar-right';

			return $classes;
		}

		/**
		 * Adds sidebar left class to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function add_sidebar_left_body_class( $classes ) {

			$classes[] = 'has-sidebar-left';

			return $classes;
		}

		/**
		 * Adds sidebar both class to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function add_sidebar_both_body_class( $classes ) {

			$classes[] = 'has-sidebar-both';

			return $classes;
		}

	}

}
Amply_Frontpage_Sidebar_Component::get_instance();
