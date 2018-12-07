<?php
/**
 * Add social nav menu
 *
 * Needs amply_get_svg()
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
		 * usage :
		 * wp_nav_menu( array(
		 * 'theme_location' => 'social',
		 * 'menu_class'     => 'social-links-menu',
		 * 'depth'          => 1,
		 * 'fallback_cb'    => false,
		 * 'link_before'    => '<span class="screen-reader-text">',
		 * 'link_after'     => '</span>' . wprig_get_svg( array( 'icon' => 'chain' ) ),
		 * ) );
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
			// Get supported social icons.
			$social_icons = $this->social_links_icons();

			// Change SVG icon inside social links menu if there is supported URL.
			if ( 'social' === $args->theme_location ) {
				foreach ( $social_icons as $attr => $value ) {
					if ( false !== strpos( $item_output, $attr ) ) {
						$item_output = str_replace( $args->link_after, '</span>' . amply_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
					}
				}
			}

			return $item_output;
		}

		/**
		 * Returns an array of supported social links (URL and icon name).
		 *
		 * @return array $social_links_icons
		 */
		public function social_links_icons() {
			// Supported social links icons ( see svg-icons.svg).
			$social_links_icons = array(
				'behance.net'     => 'behance',
				'codepen.io'      => 'codepen',
				'deviantart.com'  => 'deviantart',
				'digg.com'        => 'digg',
				'docker.com'      => 'dockerhub',
				'dribbble.com'    => 'dribbble',
				'dropbox.com'     => 'dropbox',
				'facebook.com'    => 'facebook',
				'flickr.com'      => 'flickr',
				'foursquare.com'  => 'foursquare',
				'plus.google.com' => 'google-plus',
				'github.com'      => 'github',
				'instagram.com'   => 'instagram',
				'linkedin.com'    => 'linkedin',
				'mailto:'         => 'envelope-o',
				'medium.com'      => 'medium',
				'pinterest.com'   => 'pinterest-p',
				'pscp.tv'         => 'periscope',
				'getpocket.com'   => 'get-pocket',
				'reddit.com'      => 'reddit-alien',
				'skype.com'       => 'skype',
				'skype:'          => 'skype',
				'slideshare.net'  => 'slideshare',
				'snapchat.com'    => 'snapchat-ghost',
				'soundcloud.com'  => 'soundcloud',
				'spotify.com'     => 'spotify',
				'stumbleupon.com' => 'stumbleupon',
				'tumblr.com'      => 'tumblr',
				'twitch.tv'       => 'twitch',
				'twitter.com'     => 'twitter',
				'vimeo.com'       => 'vimeo',
				'vine.co'         => 'vine',
				'vk.com'          => 'vk',
				'wordpress.org'   => 'wordpress',
				'wordpress.com'   => 'wordpress',
				'yelp.com'        => 'yelp',
				'youtube.com'     => 'youtube',
			);

			return apply_filters( 'amply_social_links_icons', $social_links_icons );
		}

	}

}
Amply_Social_Nav_Menu::get_instance();
