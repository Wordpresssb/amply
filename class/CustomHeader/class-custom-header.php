<?php
/**
 * Custom header
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package amply
 */

namespace Amply\CustomHeader;

/**
 * Custom header class
 */
class Custom_Header {

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

		add_action( 'after_setup_theme', array( $this, 'custom_header_theme_support' ) );
		add_action( 'customize_preview_init', array( $this, 'custom_header_customize_preview_js' ) );

	}

	/**
	 * Custom header image support.
	 */
	public function custom_header_theme_support() {

		add_theme_support(
			'custom-header',
			apply_filters(
				'amply_custom_header_args',
				array(
					'default-image'      => '',
					'default-text-color' => '000000',
					'width'              => 1600,
					'height'             => 250,
					'flex-height'        => true,
					'wp-head-callback'   => array( $this, 'custom_header_style' ),
				)
			)
		);

	}

	/**
	 * Styles the header image and text displayed on the blog.
	 */
	public function custom_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function custom_header_customize_preview_js() {

		wp_enqueue_script( 'custom-header-customize-preview-js', get_theme_file_uri( 'class/CustomHeader/js/customizer-preview.js' ), array( 'jquery', 'customize-preview' ), '20151215', true );

	}

}
