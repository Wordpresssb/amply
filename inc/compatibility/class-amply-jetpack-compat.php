<?php
/**
 * Jetpack Compatibility
 *
 * @link https://jetpack.com/
 * @package amply
 */

/**
 * Amply_Jetpack_Compat class
 */
if ( ! class_exists( 'Amply_Jetpack_Compat' ) ) {

	/**
	 * Assets class
	 */
	class Amply_Jetpack_Compat {

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

			add_action( 'after_setup_theme', array( $this, 'jetpack_setup' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ) );

		}

		/**
		 * Jetpack setup function.
		 *
		 * See: https://jetpack.com/support/infinite-scroll/
		 * See: https://jetpack.com/support/responsive-videos/
		 * See: https://jetpack.com/support/content-options/
		 */
		public function jetpack_setup() {
			// Add theme support for Infinite Scroll.
			add_theme_support(
				'infinite-scroll',
				array(
					'container' => 'main',
					'render'    => $this->infinite_scroll_render(),
					'footer'    => 'page',
				)
			);

			// Add theme support for Responsive Videos.
			add_theme_support( 'jetpack-responsive-videos' );

			// Add theme support for Content Options.
			add_theme_support(
				'jetpack-content-options',
				array(
					'post-details' => array(
						'stylesheet' => 'amply-style',
						'date'       => '.posted-on',
						'categories' => '.cat-links',
						'tags'       => '.tags-links',
						'author'     => '.byline',
						'comment'    => '.comments-link',
					),
				)
			);
		}

		/**
		 * Custom render function for Infinite Scroll.
		 */
		public function infinite_scroll_render() {
			while ( have_posts() ) {
				the_post();
				// phpcs:disable
				if ( is_search() ) :
					// get_template_part( 'template-parts/content', 'search' );
				else :
					// get_template_part( 'template-parts/content', get_post_type() );
				endif;
				// phpcs:enable
			}
		}

		/**
		 * Enqueue style
		 */
		public function enqueue_style() {

			// Load infinite scroll style.
			wp_enqueue_style( 'amply-main-style', get_theme_file_uri( '/inc/compatibility/css/infinite-scroll.css' ), array(), AMPLY_THEME_VERSION );

		}

	}

}
Amply_Jetpack_Compat::get_instance();
