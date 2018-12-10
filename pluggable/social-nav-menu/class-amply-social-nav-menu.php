<?php
/**
 * Add social nav menu
 *
 * @package amply
 */

/**
 * Amply_Social_Nav_Menu class
 */
if ( ! class_exists( 'Amply_Social_Nav_Menu' ) ) {

	/**
	 * Amply_Social_Nav_Menu class
	 */
	class Amply_Social_Nav_Menu {

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

			add_action( 'after_setup_theme', array( $this, 'social_nav_menu' ) );
			add_filter( 'walker_nav_menu_start_el', array( $this, 'nav_menu_social_icons' ), 10, 4 );

		}

		/**
		 * Register social nav menu
		 */
		public function social_nav_menu() {

			register_nav_menus(
				array(
					'social' => esc_html__( 'Social Links Menu', 'amply' ),
				)
			);

		}

		/**
		 * Display SVG icons in social links menu.
		 *
		 * @param  string  $item_output The menu item output.
		 * @param  WP_Post $item        Menu item object.
		 * @param  int     $depth       Depth of the menu.
		 * @param  array   $args        wp_nav_menu() arguments.
		 * @return string  $item_output The menu item output with social icon.
		 */
		public function nav_menu_social_icons( $item_output, $item, $depth, $args ) {

			// Change SVG icon inside social links menu if there is supported URL.
			if ( 'social' === $args->theme_location ) {
				$svg = amply_get_social_link_svg( $item->url, 26 );
				if ( empty( $svg ) ) {
					$svg = amply_get_icon_svg( 'link' );
				}
				$item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
			}

			return $item_output;
		}

	}

}
Amply_Social_Nav_Menu::get_instance();
