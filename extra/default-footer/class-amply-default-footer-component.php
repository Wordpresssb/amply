<?php
/**
 * Default Footer Component
 *
 * @package amply
 */

/**
 * Amply_Default_Footer_Component class
 */
if ( ! class_exists( 'Amply_Default_Footer_Component' ) ) {

	/**
	 * Amply_Default_Footer_Component class
	 */
	class Amply_Default_Footer_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the footer type.
		 *
		 * @var string
		 */
		public $footer;

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

			$this->get_footer_type();

			add_action( 'amply_footer', array( $this, 'default_footer_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_footer_style' ) );
			add_action( 'wp_head', array( $this, 'preload_footer_body_style' ) );
			add_filter( 'amply_head_custom_css', array( $this, 'head_css' ) );

		}

		/**
		 * Get footer type from customizer.
		 */
		public function get_footer_type() {

			$this->footer = amply_option( 'amply_default_footer_type' );

		}

		/**
		 * Add footer view.
		 */
		public function default_footer_view() {

			if ( 'none' === $this->footer ) {
				return;
			}

			$footer_name     = 'default-' . $this->footer;
			$footer_id       = amply_option( 'amply_default_footer_' . $this->footer . '_template' );
			$footer_elements = amply_option( 'amply_default_footer_' . $this->footer . '_elements' );

			get_extended_template_part(
				'footer/' . $this->footer . '/' . $this->footer,
				'partial',
				[
					'amply_footer_var'          => $footer_name,
					'amply_footer_id_var'       => $footer_id,
					'amply_footer_elements_var' => $footer_elements,
				],
				[
					'dir' => 'views',
				]
			);

		}

		/**
		 * Register footer style.
		 */
		public function register_footer_style() {

			$file = locate_template( 'views/footer/' . $this->footer . '/' . $this->footer . '.css', false, false );

			if ( $file ) {
				wp_register_style( 'amply-' . $this->footer, get_theme_file_uri( '/views/footer/' . $this->footer . '/' . $this->footer . '.css' ), array(), '20180514' );
			}

		}

		/**
		 * Adds preload for footer in-body stylesheet.
		 * Disabled when AMP is active as AMP injects the stylesheets inline.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_footer_body_style() {

			// If AMP is active, do nothing.
			if ( amply_is_amp() ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			if ( empty( $wp_styles->registered[ 'amply-' . $this->footer ] ) ) {
				return;
			}

			// Preload footer css.
			$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-' . $this->footer );

			echo '<link rel="preload" id="amply-' . esc_attr( $this->footer ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
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
			locate_template( 'views/footer/' . $this->footer . '/' . $this->footer . '-head-css.php', true, false );

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* ' . $this->footer . ' CSS */' . $css;
			}

			// Return output css.
			return $output;

		}

	}

}
Amply_Default_Footer_Component::get_instance();
