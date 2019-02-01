<?php
/**
 * Front page header options
 *
 * @package amply
 */

/**
 * Header 2 options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_frontpage_header_header2_title',
		'section'         => 'amply_frontpage_header_section',
		'default'         => '<h1 class="title-custom-field">HEADER 2</h1>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_frontpage_header_type',
				'operator' => '==',
				'value'    => 'header2',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_frontpage_header_header2_elements_trigger',
		'section'         => 'amply_frontpage_header_section',
		'default'         => '<div class="outer-trigger-wrap"><span>Add and Sort Elements</span><button id="amply_frontpage_header_header2_elements_trigger_button" type="button" value="Add and Sort Elements">Change</button></div>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_frontpage_header_type',
				'operator' => '==',
				'value'    => 'header2',
			),
		),
	)
);

/**
 * Add outer section for amply_frontpage_header_header1_elements
 * Triggered by amply_frontpage_header_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_frontpage_header_header2_elements_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_frontpage_header_header2_elements_outer_section',
		array(
			'title'    => esc_html__( 'Header 2 Elements', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_frontpage_header_header2_elements_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_frontpage_header_header2_elements',
		'label'           => esc_html__( 'Header 2 Elements', 'amply' ),
		'section'         => 'amply_frontpage_header_header2_elements_outer_section',
		'priority'        => 10,
		'choices'         => array(
			'site-logo'   => esc_html__( 'Site Logo', 'amply' ),
			'primary-nav' => esc_html__( 'Primary Navigation', 'amply' ),
			'social-nav'  => esc_html__( 'Social Navigation', 'amply' ),
			'search-form' => esc_html__( 'Search Form', 'amply' ),
		),
		'default'         => amply_defaults( 'amply_frontpage_header_header2_elements' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_frontpage_header_type',
				'operator' => '==',
				'value'    => 'header2',
			),
		),
	)
);
