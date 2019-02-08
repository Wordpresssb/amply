<?php
/**
 * Single loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Single_Loop_Component class
 */
if ( ! class_exists( 'Amply_Default_Single_Loop_Component' ) ) {

	/**
	 * Amply_Default_Single_Loop_Component class
	 */
	class Amply_Default_Single_Loop_Component {

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

			add_action( 'amply_single_loop', array( $this, 'single_loop_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_single_loop_style' ) );
			add_action( 'wp_head', array( $this, 'preload_single_loop_body_style' ) );

		}

		/**
		 * Load appropriate loop
		 */
		public function single_loop_view() {

			get_template_part( 'views/single-content/loop' );

		}

		/**
		 * Register single loop style.
		 */
		public function register_single_loop_style() {

			wp_register_style( 'amply-single-entry', get_theme_file_uri( '/views/single-content/single-entry.css' ), array(), '20180514' );

		}

		/**
		 * Adds preload for single entry in-body stylesheet.
		 * Disabled when AMP is active as AMP injects the stylesheets inline.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_single_loop_body_style() {

			// If AMP is active, do nothing.
			if ( amply_is_amp() ) {
				return;
			}

			// If is singular page, do nothing.
			if ( ! is_singular( 'post' ) ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			if ( empty( $wp_styles->registered['amply-single-entry'] ) ) {
				return;
			}

			// Preload single entry css.
			$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-single-entry' );

			echo '<link rel="preload" id="amply-single-entry-preload" href="' . esc_url( $src ) . '" as="style" />';
			echo "\n";

		}

	}

}
Amply_Default_Single_Loop_Component::get_instance();
