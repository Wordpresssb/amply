<?php
/**
 * Default Header options
 *
 * @package amply
 */

Kirki::add_section(
	'amply_default_header_section',
	array(
		'title'    => esc_html__( 'Header', 'amply' ),
		'priority' => 160,
	)
);

Kirki::add_section(
	'amply_default_header_outer_section',
	array(
		'title'    => esc_html__( 'Header type', 'amply' ),
		'priority' => 0,
		'type'     => 'outer',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_default_header_type',
		'label'    => esc_html__( 'Choose header type', 'amply' ),
		'section'  => 'amply_default_header_outer_section',
		'default'  => 'header1',
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
		'default'         => array(
			'mobile-menu-trigger',
		),
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
		'default'         => array(
			'mobile-menu-trigger',
		),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header2',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'theme_options[test-1]',
		'label'           => esc_html__( 'Test', 'ubik' ),
		'section'         => 'amply_default_header_section',
		'priority'        => 10,
		'choices'         => array(
			'site-logo'           => esc_html__( 'Site Logo', 'amply' ),
			'site-name'           => esc_html__( 'Site Name', 'amply' ),
			'mobile-menu-trigger' => esc_html__( 'Mobile Menu Trigger', 'amply' ),
			'search'              => esc_html__( 'Search', 'amply' ),
		),
		'default'         => array(
			'mobile-menu-trigger',
		),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header2',
			),
		),
	)
);
