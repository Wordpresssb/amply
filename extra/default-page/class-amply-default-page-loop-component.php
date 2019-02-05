<?php
/**
 * Page loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Page_Loop_Component class
 */
if ( ! class_exists( 'Amply_Default_Page_Loop_Component' ) ) {

	/**
	 * Amply_Default_Page_Loop_Component class
	 */
	class Amply_Default_Page_Loop_Component {

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

			add_action( 'amply_page_loop', array( $this, 'page_loop_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_page_loop_style' ) );
			add_action( 'wp_head', array( $this, 'preload_page_loop_body_style' ) );

		}

		/**
		 * Load appropriate loop
		 */
		public function page_loop_view() {

			get_template_part( 'views/page-content/loop' );

		}

		/**
		 * Register page loop style.
		 */
		public function register_page_loop_style() {

			wp_register_style( 'amply-page-entry', get_theme_file_uri( '/views/page-content/page-entry.css' ), array(), '20180514' );

		}

		/**
		 * Adds preload for page entry in-body stylesheet.
		 * Disabled when AMP is active as AMP injects the stylesheets inline.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_page_loop_body_style() {

			// If AMP is active, do nothing.
			if ( amply_is_amp() ) {
				return;
			}

			// If is singular page, do nothing.
			if ( ! is_singular( 'page' ) ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			if ( empty( $wp_styles->registered['amply-page-entry'] ) ) {
				return;
			}

			// Preload page entry css.
			$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-page-entry' );

			echo '<link rel="preload" id="amply-page-entry-preload" href="' . esc_url( $src ) . '" as="style" />';
			echo "\n";

		}

	}

}
Amply_Default_Page_Loop_Component::get_instance();
