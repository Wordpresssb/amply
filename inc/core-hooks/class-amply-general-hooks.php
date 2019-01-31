<?php
/**
 * General hooks : functions which enhance the theme by hooking into WordPress
 *
 * @package amply
 */

/**
 * Amply_General_Hooks class
 */
if ( ! class_exists( 'Amply_General_Hooks' ) ) {

	/**
	 * Amply_General_Hooks class
	 */
	class Amply_General_Hooks {

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

			add_filter( 'body_class', array( $this, 'body_classes' ) );
			add_filter( 'post_class', array( $this, 'post_classes' ), 10, 3 );
			add_action( 'wp_head', array( $this, 'pingback_header' ) );
			add_action( 'wp_head', array( $this, 'head_custom_css' ), PHP_INT_MAX );
			add_filter( 'embed_defaults', array( $this, 'embed_dimensions' ) );
			add_filter( 'script_loader_tag', array( $this, 'filter_script_loader_tag' ), 10, 2 );
			add_filter( 'walker_nav_menu_start_el', array( $this, 'add_primary_menu_dropdown_icon' ), 10, 4 );
			add_filter( 'nav_menu_link_attributes', array( $this, 'add_nav_menu_aria_current' ), 10, 2 );
			add_filter( 'page_menu_link_attributes', array( $this, 'add_nav_menu_aria_current' ), 10, 2 );

		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			return $classes;
		}

		/**
		 * Adds custom classes to the array of posts classes.
		 *
		 * @param array $classes .
		 * @param array $class .
		 * @param int   $post_id .
		 */
		public function post_classes( $classes, $class, $post_id ) {

			$classes[] = 'entry';

			return $classes;

		}

		/**
		 * Add a pingback url auto-discovery header for singularly identifiable articles.
		 */
		public function pingback_header() {
			if ( is_singular() && pings_open() ) {
				echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
			}
		}

		/**
		 * Outputs custom CSS to the head.
		 *
		 * @param string $output The custom css.
		 */
		public function head_custom_css( $output = null ) {

			// Add filter for adding custom css.
			$output = apply_filters( 'amply_head_custom_css', $output );

			// Minify and output CSS in the wp_head.
			if ( ! empty( $output ) ) {
				echo "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( amply_minify_css( $output ) ) . "\n</style>"; // WPCS: XSS ok.
			}

		}

		/**
		 * Set the embed width in pixels, based on the theme's design and stylesheet.
		 *
		 * @param array $dimensions An array of embed width and height values in pixels (in that order).
		 * @return array Filtered dimensions array.
		 */
		public function embed_dimensions( array $dimensions ) {
			$dimensions['width'] = 720;
			return $dimensions;
		}

		/**
		 * Adds async/defer attributes to enqueued / registered scripts.
		 * If #12009 lands in WordPress, this function can no-op since it would be handled in core.
		 *
		 * @link https://core.trac.wordpress.org/ticket/12009
		 *
		 * @param string $tag    The script tag.
		 * @param string $handle The script handle.
		 * @return array
		 */
		public function filter_script_loader_tag( $tag, $handle ) {

			foreach ( array( 'async', 'defer' ) as $attr ) {
				if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
					continue;
				}

				// Prevent adding attribute when already added in #12009.
				if ( ! preg_match( ":\s$attr(=|>|\s):", $tag ) ) {
					$tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
				}

				// Only allow async or defer, not both.
				break;
			}

			return $tag;
		}

		/**
		 * Add a dropdown icon to top-level items of the primary menu.
		 *
		 * @param string $output Nav menu item start element.
		 * @param object $item   Nav menu item.
		 * @param int    $depth  Depth.
		 * @param object $args   Nav menu args.
		 * @return string Nav menu item start element.
		 */
		public function add_primary_menu_dropdown_icon( $output, $item, $depth, $args ) {

			// Only add class to 'top level' items on the 'primary' menu.
			if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
				return $output;
			}

			if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

				// Add SVG icon to parent items.
				$icon = amply_get_icon_svg( 'keyboard_arrow_down', 24 );

				// phpcs:disable
				// $output .= sprintf(
				// 	'<span class="submenu-expand" tabindex="-1">%s</span>',
				// 	$icon
				// );
				// phpcs:enable
				$output .= $icon;
			}

			return $output;
		}

		/**
		 * Filters the HTML attributes applied to a menu item's anchor element.
		 * Checks if the menu item is the current menu item and adds the aria "current" attribute.
		 *
		 * @param array   $atts   The HTML attributes applied to the menu item's `<a>` element.
		 * @param WP_Post $item  The current menu item.
		 * @return array Modified HTML attributes
		 */
		public function add_nav_menu_aria_current( $atts, $item ) {
			/*
			* First, check if "current" is set, which means the item is a nav menu item.
			* Otherwise, it's a post item so check if the item is the current post.
			*/
			if ( isset( $item->current ) ) {
				if ( $item->current ) {
					$atts['aria-current'] = 'page';
				}
			} elseif ( ! empty( $item->ID ) ) {
				global $post;
				if ( ! empty( $post->ID ) && $post->ID == $item->ID ) {
					$atts['aria-current'] = 'page';
				}
			}

			return $atts;
		}

	}

}
Amply_General_Hooks::get_instance();
