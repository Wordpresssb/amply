<?php
/**
 * Register widget areas.
 *
 * @package amply
 */

/**
 * Amply_Widgets class
 */
if ( ! class_exists( 'Amply_Widgets' ) ) {

	/**
	 * Amply_Widgets class
	 */
	class Amply_Widgets {

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

			add_action( 'widgets_init', array( $this, 'register_widgets' ) );

		}

		/**
		 * Register widget areas.
		 *
		 * @return void
		 */
		public function register_widgets() {

			// Sidebar left.
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar Left', 'amply' ),
					'id'            => 'sidebar-left',
					'description'   => esc_html__( 'Add widgets here.', 'amply' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);

			// Sidebar right.
			register_sidebar(
				array(
					'name'          => esc_html__( 'Sidebar Right', 'amply' ),
					'id'            => 'sidebar-right',
					'description'   => esc_html__( 'Add widgets here.', 'amply' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			);
		}

	}

}
Amply_Widgets::get_instance();
