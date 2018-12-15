<?php
/**
 * Initial set up
 *
 * @package amply
 */

/**
 * Amply_Setup class
 */
if ( ! class_exists( 'Amply_Setup' ) ) {

	/**
	 * Amply_Setup class
	 */
	class Amply_Setup {

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
			add_action( 'after_setup_theme', array( $this, 'register_menus' ) );

		}

		/**
		 * Define constants
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

			// phpcs:disable
			// add_theme_support(
			// 	'custom-header',
			// 	apply_filters(
			// 		'amply_custom_header_args',
			// 		array(
			// 			'default-image' => '',
			// 			'header-text'   => false,
			// 			'width'         => 1600,
			// 			'height'        => 250,
			// 			'flex-height'   => true,
			// 			'video'         => false,
			// 		)
			// 	)
			// );
			// phpcs:enable

			// Set up the WordPress core custom background feature.
			// phpcs:disable
			// add_theme_support(
			// 	'custom-background',
			// 	apply_filters(
			// 		'amply_custom_background_args',
			// 		array(
			// 			'default-color' => 'ffffff',
			// 			'default-image' => '',
			// 		)
			// 	)
			// );
			// phpcs:enable

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			// Add support for core custom logo.
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 150,
					'width'       => 60,
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
						'name'  => __( 'Primary', 'amply' ),
						'slug'  => 'primary',
						'color' => get_theme_mod( 'amply_primary_color', '#5C6BC0' ),
					),
					array(
						'name'  => __( 'Secondary', 'amply' ),
						'slug'  => 'secondary',
						'color' => get_theme_mod( 'amply_secondary_color', '#FF5252' ),
					),
					array(
						'name'  => __( 'Black', 'amply' ),
						'slug'  => 'black',
						'color' => get_theme_mod( 'amply_black_color', '#000000' ),
					),
					array(
						'name'  => __( 'White', 'amply' ),
						'slug'  => 'white',
						'color' => get_theme_mod( 'amply_white_color', '#ffffff' ),
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
						'size'      => 12,
						'slug'      => 'small',
					),
					array(
						'name'      => __( 'regular', 'amply' ),
						'shortName' => __( 'M', 'amply' ),
						'size'      => 16,
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
		 * Register primary nav menu
		 */
		public function register_menus() {

			register_nav_menus(
				array(
					'primary' => esc_html__( 'Primary', 'amply' ),
					'mobile'  => esc_html__( 'Mobile', 'amply' ),
				)
			);

		}

	}

}
Amply_Setup::get_instance();
