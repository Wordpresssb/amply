<?php
/**
 * Theme color patterns.
 *
 * @package amply
 */

/**
 * Amply_Color_Patterns class
 */
if ( ! class_exists( 'Amply_Color_Patterns' ) ) {

	/**
	 * Amply_Image_Sizes class
	 */
	class Amply_Color_Patterns {

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

			$this->register_color_options();

			add_action( 'after_setup_theme', array( $this, 'color_palette_theme_support' ) );
			add_action( 'wp_head', array( $this, 'colors_css_wrap' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_gutenberg_color_styles' ) );
			add_action( 'customize_preview_init', array( $this, 'color_customize_preview_js' ) );

		}

		/**
		 * Register color options.
		 */
		public function register_color_options() {

			require_once get_template_directory() . '/inc/color-patterns/color-options.php';

		}

		/**
		 * Add support for color palettes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-color-palettes
		 */
		public function color_palette_theme_support() {

			add_theme_support(
				'editor-color-palette',
				array(
					array(
						'name'  => __( 'Primary', 'amply' ),
						'slug'  => 'primary',
						'color' => get_theme_mod( 'amply_primary_color', amply_defaults( 'amply_primary_color' ) ),
					),
					array(
						'name'  => __( 'Secondary', 'amply' ),
						'slug'  => 'secondary',
						'color' => get_theme_mod( 'amply_secondary_color', amply_defaults( 'amply_secondary_color' ) ),
					),
					array(
						'name'  => __( 'Dark Gray', 'amply' ),
						'slug'  => 'dark-gray',
						'color' => '#111',
					),
					array(
						'name'  => __( 'Light Gray', 'amply' ),
						'slug'  => 'light-gray',
						'color' => '#767676',
					),
					array(
						'name'  => __( 'White', 'amply' ),
						'slug'  => 'white',
						'color' => '#FFF',
					),
				)
			);

		}

		/**
		 * Display custom color CSS in customizer and on frontend.
		 */
		public function colors_css_wrap() {

			// Only include custom colors in customizer or frontend.
			if ( is_admin() ) {
				return;
			}

			require_once get_parent_theme_file_path( '/inc/color-patterns/color-patterns.php' );

			$primary_color = get_theme_mod( 'amply_primary_color', amply_defaults( 'amply_primary_color' ) );
			// phpcs:disable
			?>
			<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-primary="' . esc_attr( $primary_color ) . '"' : ''; ?>>
				<?php
					echo amply_custom_colors_css();
				?>
			</style>
			<?php
			// phpcs:enable
		}

		/**
		 * Enqueue supplemental block editor styles.
		 */
		public function enqueue_gutenberg_color_styles() {

			// Include color patterns.
			require_once get_parent_theme_file_path( '/inc/color-patterns/color-patterns.php' );
			wp_add_inline_style( 'amply-editor-styles', amply_custom_colors_css() );

		}

		/**
		 * Bind JS handlers to instantly live-preview color changes.
		 */
		public function color_customize_preview_js() {
			wp_enqueue_script( 'amply-color-customize-preview', get_theme_file_uri( '/inc/color-patterns/color-customize-preview.js' ), array( 'customize-preview' ), '20151215', true );
		}

	}

}
Amply_Color_Patterns::get_instance();
