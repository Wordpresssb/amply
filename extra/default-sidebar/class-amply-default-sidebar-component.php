<?php
/**
 * Default Sidebar Component
 *
 * @package amply
 */

/**
 * Amply_Default_Sidebar_Component class
 */
if ( ! class_exists( 'Amply_Default_Sidebar_Component' ) ) {

	/**
	 * Amply_Default_Header_Component class
	 */
	class Amply_Default_Sidebar_Component {

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
		 * Get sidebar type from customizer.
		 */
		public function get_sidebar_type() {

			$this->sidebar = amply_option( 'amply_default_sidebar_type' );

		}

		/**
		 * Add sidebar right view.
		 */
		public function sidebar_right_view() {

			if ( 'template' === amply_option( 'amply_default_sidebar_sidebar_right_type' ) ) {

				$sidebar_right_id = amply_option( 'amply_default_sidebar_sidebar_right_template' );
				set_query_var( 'amply_sidebar_right_id_var', $sidebar_right_id );

				get_template_part( 'views/sidebar/sidebarcpt/sidebar-right-partial' );

			} else {

				get_sidebar( 'right' );

			}

		}

		/**
		 * Add sidebar left view.
		 */
		public function sidebar_left_view() {

			if ( 'template' === amply_option( 'amply_default_sidebar_sidebar_left_type' ) ) {

				$sidebar_left_id = amply_option( 'amply_default_sidebar_sidebar_left_template' );
				set_query_var( 'amply_sidebar_left_id_var', $sidebar_left_id );

				get_template_part( 'views/sidebar/sidebarcpt/sidebar-left-partial' );

			} else {

				get_sidebar( 'left' );

			}

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
Amply_Default_Sidebar_Component::get_instance();
