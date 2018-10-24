<?php
/**
 * Customizer
 *
 * @package amply
 */

namespace Amply\Customizer;

/**
 * Customizer class
 */
class Customizer {

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

		add_action( 'customize_register', array( $this, 'core_options' ) );
		add_action( 'customize_register', array( $this, 'theme_options' ) );

	}

	/**
	 * Modify core options
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function core_options( $wp_customize ) {

		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		// Add partials.
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => function() {
						bloginfo( 'name' );
					},
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => function() {
						bloginfo( 'description' );
					},
				)
			);
		}

		// Inline editable partials.
		if ( class_exists( 'Customize_Inline_Editing' ) ) {
			$partials = array(
				$wp_customize->selective_refresh->get_partial( 'blogname' ),
				$wp_customize->selective_refresh->get_partial( 'blogdescription' ),
			);
			foreach ( $partials as $partial ) {
				if ( 'default' !== $partial->type ) {
					continue;
				}
				$partial->type = 'inline_editable';
			}
		}

	}

	/**
	 * Theme options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function theme_options( $wp_customize ) {

		$wp_customize->add_section(
			'theme_options',
			array(
				'title'    => __( 'Theme Options', 'amply' ),
				'priority' => 130, // Before Additional CSS.
			)
		);

		if ( class_exists( 'Amply\Images\Lazyload\Lazyload_Images' ) ) {

			$wp_customize->add_setting(
				'lazy_load_media',
				array(
					'default'           => 'lazyload',
					'sanitize_callback' => 'amply_sanitize_select',
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'lazy_load_media',
				array(
					'label'       => __( 'Lazy-load images', 'amply' ),
					'section'     => 'theme_options',
					'type'        => 'radio',
					'description' => __( 'Lazy-loading images means images are loaded only when they are in view. Improves performance, but can result in content jumping around on slower connections.', 'amply' ),
					'choices'     => array(
						'lazyload'    => __( 'Lazy-load on (default)', 'amply' ),
						'no-lazyload' => __( 'Lazy-load off', 'amply' ),
					),
				)
			);

		}

	}

}
