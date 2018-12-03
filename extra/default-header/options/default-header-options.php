<?php
/**
 * Default Header options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add default header settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_default_header_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_default_header_type'             => 'header1',

		'amply_default_header_header1_elements' => array(
			'mobile-menu-trigger',
		),
		'amply_default_header_header2_elements' => array(
			'site-logo',
		),

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_default_header_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_default_header_section',
	array(
		'title'    => esc_html__( 'Header', 'amply' ),
		'priority' => 301,
	)
);

/**
 * Add outer section for amply_default_header_type
 * Triggered by amply_default_header_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_default_header_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_header_outer_section',
		array(
			'title'    => esc_html__( 'Header type', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_default_header_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_default_header_type',
		'label'    => esc_html__( 'Choose header type', 'amply' ),
		'section'  => 'amply_default_header_outer_section',
		'default'  => amply_defaults( 'amply_default_header_type' ),
		'priority' => 10,
		'choices'  => array(
			'header1' => get_template_directory_uri() . '/assets/images/header1.png',
			'header2' => get_template_directory_uri() . '/assets/images/header2.png',
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_default_header_header1_elements',
		'label'           => esc_html__( 'Header1 Elements', 'ubik' ),
		'section'         => 'amply_default_header_section',
		'priority'        => 10,
		'choices'         => array(
			'site-logo'           => esc_html__( 'Site Logo', 'amply' ),
			'site-name'           => esc_html__( 'Site Name', 'amply' ),
			'mobile-menu-trigger' => esc_html__( 'Mobile Menu Trigger', 'amply' ),
			'search'              => esc_html__( 'Search', 'amply' ),
		),
		'default'         => amply_defaults( 'amply_default_header_header1_elements' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_default_header_header2_elements',
		'label'           => esc_html__( 'Header2 Elements', 'ubik' ),
		'section'         => 'amply_default_header_section',
		'priority'        => 10,
		'choices'         => array(
			'site-logo'           => esc_html__( 'Site Logo', 'amply' ),
			'site-name'           => esc_html__( 'Site Name', 'amply' ),
			'mobile-menu-trigger' => esc_html__( 'Mobile Menu Trigger', 'amply' ),
			'search'              => esc_html__( 'Search', 'amply' ),
		),
		'default'         => amply_defaults( 'amply_default_header_header2_elements' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header2',
			),
		),
	)
);
