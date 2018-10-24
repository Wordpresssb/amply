<?php
/**
 * Widgets
 *
 * @package amply
 */

namespace Amply;

/**
 * Widgets class
 */
class Widgets {

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
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'amply' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'amply' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}

}
