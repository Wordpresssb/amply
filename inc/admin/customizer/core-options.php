<?php
/**
 * Core options
 *
 * @package amply
 */

/**
 * Modify core options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_core_options( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

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
add_action( 'customize_register', 'amply_core_options' );
