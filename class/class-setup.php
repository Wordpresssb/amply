<?php
/**
 * Set up
 *
 * @package amply
 */

namespace Amply;

/**
 * Setup class
 */
class Setup {

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

		add_action( 'after_setup_theme', array( $this, 'constants' ) );
		add_action( 'after_setup_theme', array( $this, 'textdomain' ) );
		add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
		add_filter( 'embed_defaults', array( $this, 'embed_dimensions' ) );

	}

	/**
	 * Undocumented function
	 *
	 * @return void
	 */
	public function constants() {

		$version = $this->theme_version();

		// Theme version.
		define( 'AMPLY_THEME_VERSION', $version );

	}

	/**
	 * Returns current theme version.
	 *
	 * @return string
	 */
	public function theme_version() {

		$theme = wp_get_theme();

		return $theme->get( 'Version' );

	}

	/**
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 *
	 * @return void
	 */
	public function textdomain() {

		load_theme_textdomain( 'amply', get_parent_theme_file_path( 'languages' ) );

	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return void
	 */
	public function theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'amply_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		/**
		 * Add support for default block styles.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#default-block-styles
		 */
		add_theme_support( 'wp-block-styles' );

		/**
		 * Add support for wide aligments.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#wide-alignment
		 */
		add_theme_support( 'align-wide' );

		/**
		 * Add support for block color palettes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#block-color-palettes
		 */
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dusty orange', 'amply' ),
					'slug'  => 'dusty-orange',
					'color' => '#ed8f5b',
				),
				array(
					'name'  => __( 'Dusty red', 'amply' ),
					'slug'  => 'dusty-red',
					'color' => '#e36d60',
				),
				array(
					'name'  => __( 'Dusty wine', 'amply' ),
					'slug'  => 'dusty-wine',
					'color' => '#9c4368',
				),
				array(
					'name'  => __( 'Dark sunset', 'amply' ),
					'slug'  => 'dark-sunset',
					'color' => '#33223b',
				),
				array(
					'name'  => __( 'Almost black', 'amply' ),
					'slug'  => 'almost-black',
					'color' => '#0a1c28',
				),
				array(
					'name'  => __( 'Dusty water', 'amply' ),
					'slug'  => 'dusty-water',
					'color' => '#41848f',
				),
				array(
					'name'  => __( 'Dusty sky', 'amply' ),
					'slug'  => 'dusty-sky',
					'color' => '#72a7a3',
				),
				array(
					'name'  => __( 'Dusty daylight', 'amply' ),
					'slug'  => 'dusty-daylight',
					'color' => '#97c0b7',
				),
				array(
					'name'  => __( 'Dusty sun', 'amply' ),
					'slug'  => 'dusty-sun',
					'color' => '#eee9d1',
				),
			)
		);

		/*
		 * Optional: Disable custom colors in block color palettes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
		 *
		 * add_theme_support( 'disable-custom-colors' );
		 */

		/**
		 * Add support for font sizes.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'small', 'amply' ),
					'shortName' => __( 'S', 'amply' ),
					'size'      => 16,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'regular', 'amply' ),
					'shortName' => __( 'M', 'amply' ),
					'size'      => 20,
					'slug'      => 'regular',
				),
				array(
					'name'      => __( 'large', 'amply' ),
					'shortName' => __( 'L', 'amply' ),
					'size'      => 36,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'larger', 'amply' ),
					'shortName' => __( 'XL', 'amply' ),
					'size'      => 48,
					'slug'      => 'larger',
				),
			)
		);

		/**
		 * Add AMP support for modules.
		 */
		add_theme_support(
			'amp',
			array(
				'comments_live_list' => true,
			)
		);

	}

	/**
	 * Set the embed width in pixels, based on the theme's design and stylesheet.
	 *
	 * @param array $dimensions An array of embed width and height values in pixels (in that order).
	 * @return array
	 */
	public function embed_dimensions( array $dimensions ) {
		$dimensions['width'] = 720;
		return $dimensions;
	}

}
