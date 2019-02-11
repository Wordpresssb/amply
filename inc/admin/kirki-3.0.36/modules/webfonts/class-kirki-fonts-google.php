<?php
/**
 * Processes typography-related fields
 * and generates the google-font link.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license    https://opensource.org/licenses/MIT
 * @since       1.0
 */

/**
 * Manages the way Google Fonts are enqueued.
 */
final class Kirki_Fonts_Google {

	/**
	 * The Kirki_Fonts_Google instance.
	 * We use the singleton pattern here to avoid loading the google-font array multiple times.
	 * This is mostly a performance tweak.
	 *
	 * @access private
	 * @var null|object
	 */
	private static $instance = null;

	/**
	 * DUMMY. DOESN'T DO ANYTHING, SIMPLY BACKWARDS-COMPATIBILITY.
	 *
	 * @static
	 * @access public
	 * @var bool
	 */
	public static $force_load_all_subsets = false;

	/**
	 * If set to true, forces loading ALL variants.
	 *
	 * @static
	 * @access public
	 * @var bool
	 */
	public static $force_load_all_variants = false;

	/**
	 * The array of fonts
	 *
	 * @access public
	 * @var array
	 */
	public $fonts = array();

	/**
	 * An array of all google fonts.
	 *
	 * @access private
	 * @var array
	 */
	private $google_fonts = array();

	/**
	 * An array of fonts that should be hosted locally instead of served via the google-CDN.
	 *
	 * @access protected
	 * @since 3.0.32
	 * @var array
	 */
	protected $hosted_fonts = array();

	/**
	 * The class constructor.
	 */
	private function __construct() {
		$config = apply_filters( 'kirki_config', array() );

		// If we have set $config['disable_google_fonts'] to true then do not proceed any further.
		if ( isset( $config['disable_google_fonts'] ) && true === $config['disable_google_fonts'] ) {
			return;
		}

		add_action( 'wp_ajax_kirki_fonts_google_all_get', array( $this, 'get_googlefonts_json' ) );
		add_action( 'wp_ajax_nopriv_kirki_fonts_google_all_get', array( $this, 'get_googlefonts_json' ) );
		add_action( 'wp_ajax_kirki_fonts_standard_all_get', array( $this, 'get_standardfonts_json' ) );
		add_action( 'wp_ajax_nopriv_kirki_fonts_standard_all_get', array( $this, 'get_standardfonts_json' ) );

		// Populate the array of google fonts.
		$this->google_fonts = Kirki_Fonts::get_google_fonts();
	}

	/**
	 * Get the one, true instance of this class.
	 * Prevents performance issues since this is only loaded once.
	 *
	 * @return object Kirki_Fonts_Google
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Kirki_Fonts_Google();
		}
		return self::$instance;
	}

	/**
	 * Processes the arguments of a field
	 * determines if it's a typography field
	 * and if it is, then takes appropriate actions.
	 *
	 * @param array $args The field arguments.
	 */
	public function generate_google_font( $args ) {
		global $wp_customize;

		// Process typography fields.
		if ( isset( $args['type'] ) && 'kirki-typography' === $args['type'] ) {

			// Get the value.
			$value = Kirki_Values::get_sanitized_field_value( $args );

			// If we don't have a font-family then we can skip this.
			if ( ! $wp_customize && ( ! isset( $value['font-family'] ) || in_array( $value['font-family'], $this->hosted_fonts, true ) ) ) {
				return;
			}

			// If not a google-font, then we can skip this.
			if ( ! isset( $value['font-family'] ) || ! Kirki_Fonts::is_google_font( $value['font-family'] ) ) {
				return;
			}

			// Set a default value for variants.
			if ( ! isset( $value['variant'] ) ) {
				$value['variant'] = 'regular';
			}

			// Add the requested google-font.
			if ( ! isset( $this->fonts[ $value['font-family'] ] ) ) {
				$this->fonts[ $value['font-family'] ] = array();
			}
			if ( ! in_array( $value['variant'], $this->fonts[ $value['font-family'] ], true ) ) {
				$this->fonts[ $value['font-family'] ][] = $value['variant'];
			}

			// Are we force-loading all variants?
			if ( true === self::$force_load_all_variants ) {
				$all_variants               = Kirki_Fonts::get_all_variants();
				$args['choices']['variant'] = array_keys( $all_variants );
			}

			if ( ! empty( $args['choices']['variant'] ) && is_array( $args['choices']['variant'] ) ) {
				foreach ( $args['choices']['variant'] as $extra_variant ) {
					$this->fonts[ $value['font-family'] ][] = $extra_variant;
				}
			}
			return;
		}

		// Process non-typography fields.
		if ( isset( $args['output'] ) && is_array( $args['output'] ) ) {
			foreach ( $args['output'] as $output ) {

				// If we don't have a typography-related output argument we can skip this.
				if ( ! isset( $output['property'] ) || ! in_array( $output['property'], array( 'font-family', 'font-weight' ), true ) ) {
					continue;
				}

				// Get the value.
				$value = Kirki_Values::get_sanitized_field_value( $args );

				if ( is_string( $value ) ) {
					if ( 'font-family' === $output['property'] ) {
						if ( ! array_key_exists( $value, $this->fonts ) ) {
							$this->fonts[ $value ] = array();
						}
					} elseif ( 'font-weight' === $output['property'] ) {
						foreach ( $this->fonts as $font => $variants ) {
							if ( ! in_array( $value, $variants, true ) ) {
								$this->fonts[ $font ][] = $value;
							}
						}
					}
				}
			}
		}
	}

	/**
	 * Determines the vbalidity of the selected font as well as its properties.
	 * This is vital to make sure that the google-font script that we'll generate later
	 * does not contain any invalid options.
	 */
	public function process_fonts() {

		// Early exit if font-family is empty.
		if ( empty( $this->fonts ) ) {
			return;
		}

		foreach ( $this->fonts as $font => $variants ) {

			// Determine if this is indeed a google font or not.
			// If it's not, then just remove it from the array.
			if ( ! array_key_exists( $font, $this->google_fonts ) ) {
				unset( $this->fonts[ $font ] );
				continue;
			}

			// Get all valid font variants for this font.
			$font_variants = array();
			if ( isset( $this->google_fonts[ $font ]['variants'] ) ) {
				$font_variants = $this->google_fonts[ $font ]['variants'];
			}
			foreach ( $variants as $variant ) {

				// If this is not a valid variant for this font-family
				// then unset it and move on to the next one.
				if ( ! in_array( $variant, $font_variants, true ) ) {
					$variant_key = array_search( $variant, $this->fonts[ $font ], true );
					unset( $this->fonts[ $font ][ $variant_key ] );
					continue;
				}
			}
		}
	}

	/**
	 * Gets the googlefonts JSON file.
	 *
	 * @since 3.0.17
	 * @return void
	 */
	public function get_googlefonts_json() {
		include wp_normalize_path( dirname( __FILE__ ) . '/webfonts.json' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude
		wp_die();
	}

	/**
	 * Get the standard fonts JSON.
	 *
	 * @since 3.0.17
	 * @return void
	 */
	public function get_standardfonts_json() {
		echo wp_json_encode( Kirki_Fonts::get_standard_fonts() );
		wp_die();
	}
}