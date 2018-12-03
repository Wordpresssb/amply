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

	// Remove custom header text color control.
	$wp_customize->remove_control( 'header_textcolor' );

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

}
add_action( 'customize_register', 'amply_core_options' );
