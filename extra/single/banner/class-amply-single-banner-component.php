<?php
/**
 * Single Banner Component
 *
 * @package amply
 */

/**
 * Amply_Single_Banner_Component class
 */
if ( ! class_exists( 'Amply_Single_Banner_Component' ) ) {

	/**
	 * Amply_Single_Banner_Component class
	 */
	class Amply_Single_Banner_Component {

		/**
		 * Instance
		 *
		 * @var object $instance
		 */
		private static $instance;

		/**
		 * Holds the banner type.
		 *
		 * @var string
		 */
		public $banner;

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

			$this->get_banner_type();

			add_action( 'amply_banner', array( $this, 'single_banner_view' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_banner_style' ) );
			add_action( 'wp_head', array( $this, 'preload_banner_body_style' ) );
			add_filter( 'amply_head_custom_css', array( $this, 'head_css' ) );

		}

		/**
		 * Get banner type from customizer.
		 */
		public function get_banner_type() {

			$this->banner = amply_option( 'amply_single_banner_type' );

		}

		/**
		 * Add banner template.
		 */
		public function single_banner_view() {

			if ( 'none' === $this->banner ) {
				return;
			}

			$data = 'single-' . $this->banner;
			set_query_var( 'amply_banner_var', $data );

			if ( 'bannercpt' === $this->banner ) {

				$banner_id = amply_option( 'amply_single_banner_' . $this->banner . '_template' );
				set_query_var( 'amply_banner_id_var', $banner_id );

			} else {

				$elements = amply_option( 'amply_single_banner_' . $this->banner . '_elements' );
				set_query_var( 'amply_banner_elements_var', $elements );

			}

			get_template_part( 'views/banner/' . $this->banner . '/' . $this->banner, 'partial' );

		}

		/**
		 * Register banner style.
		 */
		public function register_banner_style() {

			$file = locate_template( 'views/banner/' . $this->banner . '/' . $this->banner . '.css', false, false );

			if ( $file ) {
				wp_register_style( 'amply-' . $this->banner, get_theme_file_uri( '/views/banner/' . $this->banner . '/' . $this->banner . '.css' ), array(), '20180514' );
			}

		}

		/**
		 * Adds preload for banner in-body stylesheet.
		 * Disabled when AMP is active as AMP injects the stylesheets inline.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_banner_body_style() {

			// If AMP is active, do nothing.
			if ( amply_is_amp() ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			if ( empty( $wp_styles->registered[ 'amply-' . $this->banner ] ) ) {
				return;
			}

			// Preload banner1 css.
			$src = amply_get_preload_stylesheet_uri( $wp_styles, 'amply-' . $this->banner );

			echo '<link rel="preload" id="amply-' . esc_attr( $this->banner ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
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
			locate_template( 'views/banner/' . $this->banner . '/' . $this->banner . '-head-css.php', true, false );

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* ' . $this->banner . ' CSS */' . $css;
			}

			// Return output css.
			return $output;

		}

	}

}
Amply_Single_Banner_Component::get_instance();
