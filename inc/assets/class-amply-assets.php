<?php
/**
 * Assets Management
 *
 * @package amply
 */

/**
 * Amply_Assets class
 */
if ( ! class_exists( 'Amply_Assets' ) ) {

	/**
	 * Assets class
	 */
	class Amply_Assets {

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

			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_filter( 'wp_resource_hints', array( $this, 'resource_hints' ), 10, 2 );
			add_action( 'wp_head', array( $this, 'preload_in_body_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_gutenberg_styles' ) );

		}

		/**
		 * Enqueue styles
		 *
		 * @return void
		 */
		public function enqueue_styles() {

			// Add custom fonts, used in the main stylesheet.
			$fonts_url = $this->amply_fonts_url();
			if ( ! empty( $fonts_url ) ) {
				wp_enqueue_style( 'amply-fonts', $fonts_url, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			}

			// Load Font Awesome.
			wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.5.0/css/all.css', array(), AMPLY_THEME_VERSION );

			// enqueue main style and register component styles that are called conditionally on an as-needed basis.
			$css_uri   = get_theme_file_uri( '/dist/css/' );
			$css_files = $this->get_css_files();

			foreach ( $css_files as $css_file ) {

				if ( 'main' === $css_file ) {
					wp_enqueue_style(
						'amply-' . $css_file,
						$css_uri . $css_file . '.css',
						array(),
						AMPLY_THEME_VERSION
					);
				} else {
					wp_register_style(
						'amply-' . $css_file,
						$css_uri . $css_file . '.css',
						array(),
						AMPLY_THEME_VERSION
					);
				}
			}

		}

		/**
		 * Google Fonts query
		 *
		 * @return string
		 */
		public function amply_fonts_url() {

			$fonts_register = $this->amply_get_google_fonts();

			if ( empty( $fonts_register ) ) {
				return '';
			}

			$font_families = array();

			foreach ( $fonts_register as $font_name => $font_variants ) {
				if ( ! empty( $font_variants ) ) {

					// Make sure its an array.
					if ( ! is_array( $font_variants ) ) {
						$font_variants = explode( ',', str_replace( ' ', '', $font_variants ) );
					}

					$font_families[] = $font_name . ':' . implode( ',', $font_variants );

				} else {
					$font_families[] = $font_name;
				}
			}

			$query_args = array(
				'family' => implode( '|', $font_families ),
				'subset' => 'latin-ext',
			);

			return add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		/**
		 * Returns Google Fonts used in theme.
		 * Has filter : "amply_google_fonts".
		 *
		 * @return array $fonts_default array of fonts to use
		 */
		public function amply_get_google_fonts() {

			$fonts_default = array(
				'Roboto Condensed' => array( '400', '400i', '700', '700i' ),
				'Crimson Text'     => array( '400', '400i', '600', '600i' ),
			);

			return apply_filters( 'amply_google_fonts', $fonts_default );
		}

		/**
		 * Add preconnect for Google Fonts.
		 *
		 * @param array  $urls          URLs to print for resource hints.
		 * @param string $relation_type The relation type the URLs are printed.
		 * @return array $urls          URLs to print for resource hints.
		 */
		public function resource_hints( $urls, $relation_type ) {
			if ( wp_style_is( 'amply-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
				$urls[] = array(
					'href' => 'https://fonts.gstatic.com',
					'crossorigin',
				);
			}
			return $urls;
		}

		/**
		 * Returns the theme CSS files.
		 *
		 * @return array List of CSS file names.
		 */
		public function get_css_files() {

			$css_files = array(
				'main',
			);

			/**
			 * Filters default CSS files.
			 *
			 * @param array $css_files List of CSS file names to register and enqueue with WordPress.
			 */
			return apply_filters( 'amply_css_files', $css_files );
		}

		/**
		 * Adds preload for in-body stylesheets depending on what templates are being used.
		 *
		 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Preloading_content
		 */
		public function preload_in_body_styles() {

			// Disabled when AMP is active as AMP injects the stylesheets inline.
			if ( amply_is_amp() ) {
				return;
			}

			// Get registered styles.
			$wp_styles = wp_styles();

			$preloads = array();

			// Output the preload markup in <head>.
			foreach ( $preloads as $handle => $src ) {
				echo '<link rel="preload" id="' . esc_attr( $handle ) . '-preload" href="' . esc_url( $src ) . '" as="style" />';
				echo "\n";
			}

		}

		/**
		 * Enqueue scripts.
		 *
		 * @return void
		 */
		public function enqueue_scripts() {

			// If the AMP plugin is active, return early.
			if ( amply_is_amp() ) {
				return;
			}

			// Enqueue skip-link-focus script.
			wp_enqueue_script( 'amply-skip-link-focus-fix', get_theme_file_uri( 'dist/js/skip-link-focus-fix.js' ), array(), '20151215', false );
			wp_script_add_data( 'amply-skip-link-focus-fix', 'defer', true );

			// Enqueue the navigation script.
			wp_enqueue_script( 'amply-all-js', get_theme_file_uri( 'dist/js/all.js' ), array(), AMPLY_THEME_VERSION, false );
			wp_script_add_data( 'amply-all-js', 'async', true );
			wp_localize_script(
				'amply-all-js',
				'amplyScreenReaderText',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'rtl'     => is_rtl(),
					'user'    => array(
						'can_edit_pages' => current_user_can( 'edit_pages' ),
					),
				)
			);

			// Enqueue comment script on singular post/page views only.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		/**
		 * Enqueue WordPress theme styles within Gutenberg.
		 *
		 * @return void
		 */
		public function enqueue_gutenberg_styles() {

			// Add custom fonts, used in the main stylesheet.
			$fonts_url = $this->amply_fonts_url();
			if ( ! empty( $fonts_url ) ) {
				wp_enqueue_style( 'amply-fonts', $fonts_url, array(), null ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			}

			// Enqueue main stylesheet.
			wp_enqueue_style( 'amply-editor-style', get_theme_file_uri( 'dist/css/editor-styles.css' ), array(), AMPLY_THEME_VERSION );

			// Unregister core block and theme styles.
			// see: https://github.com/WordPress/gutenberg/issues/7776.
			wp_deregister_style( 'wp-block-library' );
			wp_deregister_style( 'wp-block-library-theme' );

			// Re-register core block and theme styles with an empty string. This is necessary to get styles set up correctly.
			wp_register_style( 'wp-block-library', '' ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
			wp_register_style( 'wp-block-library-theme', '' ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		}

	}

}
Amply_Assets::get_instance();
