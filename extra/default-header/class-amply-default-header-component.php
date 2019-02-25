<?php
/**
 * Default Header Component
 *
 * @package amply
 */

/**
 * Amply_Default_Header_Component class
 */
if ( ! class_exists( 'Amply_Default_Header_Component' ) ) {

	/**
	 * Amply_Default_Header_Component class
	 */
	class Amply_Default_Header_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the header type.
		 *
		 * @var string
		 */
		public $header;

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

			$this->get_header_type();

			add_action( 'amply_header', array( $this, 'default_header_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_header_style' ) );
			add_action( 'wp_head', array( $this, 'preload_header_body_style' ) );
			add_filter( 'amply_head_custom_css', array( $this, 'head_css' ) );

		}

		/**
		 * Get header type from customizer.
		 */
		public function get_header_type() {

			$this->header = amply_option( 'amply_default_header_type' );

		}

		/**
		 * Add header template.
		 */
		public function default_header_view() {

			$name = 'default-' . $this->header;
			set_query_var( 'amply_header_var', $name );

			if ( 'headercpt' === $this->header ) {

				$header_id = amply_option( 'amply_default_header_' . $this->header . '_template' );
				set_query_var( 'amply_header_id_var', $header_id );

			} else {

				$elements = amply_option( 'amply_default_header_' . $this->header . '_elements' );
				set_query_var( 'amply_header_elements_var', $elements );

			}

			get_template_part( 'views/header/' . $this->header . '/' . $this->header, 'partial' );

		}

		/**
		 * Register header style.
		 */
		public function register_header_style() {

			$file = locate_template( 'views/header/' . $this->header . '/' . $this->header . '.css', false, false );

			if ( $file ) {
				wp_register_style( 'amply-' . $this->header, get_theme_file_uri( '/views/header/' . $this->header . '/' . $this->header . '.css' ), array(), '20180514' );
			}

		}

		/**
		 * Adds preload for header in-body stylesheet.
		 * Disabled when AMP is active as AMP injects the stylesheets inline.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_header_body_style() {

			// If AMP is active, do nothing.
			if ( amply_is_amp() ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			if ( empty( $wp_styles->registered[ 'amply-' . $this->header ] ) ) {
				return;
			}

			// Preload header1 css.
			$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-' . $this->header );

			echo '<link rel="preload" id="amply-' . esc_attr( $this->header ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
			echo "\n";

		}

		/**
		 * Custom head css
		 *
		 * @param string $output Inline css.
		 * @return string $output Inline css.
		 */
		public function head_css( $output ) {

			$css = '';

			// Add custom head css if there are any.
			locate_template( 'views/header/' . $this->header . '/' . $this->header . '-head-css.php', true, false );

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* ' . $this->header . 'Blog CSS */' . $css;
			}

			// Return output css.
			return $output;

		}

	}

}
Amply_Default_Header_Component::get_instance();
