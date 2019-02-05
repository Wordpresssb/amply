<?php
/**
 * Index loop Component
 *
 * @package amply
 */

/**
 * Amply_Default_Index_Loop_Component class
 */
if ( ! class_exists( 'Amply_Default_Index_Loop_Component' ) ) {

	/**
	 * Amply_Default_Index_Loop_Component class
	 */
	class Amply_Default_Index_Loop_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the index layout.
		 *
		 * @var string
		 */
		public $index_layout;

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

			$this->get_index_layout();

			add_action( 'amply_index_loop', array( $this, 'index_loop_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_index_loop_style' ) );
			add_action( 'wp_head', array( $this, 'preload_index_loop_body_style' ) );
			add_filter( 'body_class', array( $this, 'body_classes' ) );

		}

		/**
		 * Get index layout from customizer.
		 */
		public function get_index_layout() {

			$this->index_layout = amply_option( 'amply_default_index_layout' );

		}

		/**
		 * Load appropriate loop
		 */
		public function index_loop_view() {

			if ( 'classic' === $this->index_layout ) {

				get_template_part( 'views/index-content/classic-entries/loop' );

			}

			if ( 'card1' === $this->index_layout ) {

				get_template_part( 'views/index-content/card1-entries/loop' );

			}

		}

		/**
		 * Register index loop style.
		 */
		public function register_index_loop_style() {

			if ( 'classic' === $this->index_layout ) {

				wp_register_style( 'amply-classic-entries', get_theme_file_uri( '/views/index-content/classic-entries/classic-entries.css' ), array(), '20180514' );

			}

			if ( 'card1' === $this->index_layout ) {

				wp_register_style( 'amply-card1-entries', get_theme_file_uri( '/views/index-content/card1-entries/card1-entries.css' ), array(), '20180514' );

			}

		}

		/**
		 * Adds preload for entries in-body stylesheet.
		 * Disabled when AMP is active as AMP injects the stylesheets inline.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_index_loop_body_style() {

			// If AMP is active, do nothing.
			if ( amply_is_amp() ) {
				return;
			}

			// If is singular page, do nothing.
			if ( is_singular() ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			if ( 'classic' === $this->index_layout ) {

				if ( empty( $wp_styles->registered['amply-classic-entries'] ) ) {
					return;
				}

				// Preload classic entries css.
				$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-classic-entries' );

				echo '<link rel="preload" id="amply-classic-entries-preload" href="' . esc_url( $src ) . '" as="style" />';
				echo "\n";

			}

			if ( 'card1' === $this->index_layout ) {

				if ( empty( $wp_styles->registered['amply-card1-entries'] ) ) {
					return;
				}

				// Preload classic entries css.
				$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-card1-entries' );

				echo '<link rel="preload" id="amply-card1-entries-preload" href="' . esc_url( $src ) . '" as="style" />';
				echo "\n";

			}

		}

		/**
		 * Adds entries class to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 * @return array
		 */
		public function body_classes( $classes ) {

			if ( ! is_singular() ) {

				if ( 'classic' === $this->index_layout ) {
					$classes[] = 'classic-entries-layout';
				}

				if ( 'card1' === $this->index_layout ) {
					$classes[] = 'card1-entries-layout';
				}
			}

			return $classes;
		}

	}

}
Amply_Default_Index_Loop_Component::get_instance();
