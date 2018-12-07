<?php
/**
 * Default Header options
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
		'settings'        => 'amply_default_header_header2_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h1 class="title-custom-field">HEADER 2</h1>',
		'priority'        => 10,
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
		'settings'        => 'amply_default_header_header2_elements',
		'label'           => esc_html__( 'Header2 Elements', 'amply' ),
		'tooltip'         => esc_html__( 'This is a tooltip, I can put here all what I want, but it has not to be too long', 'amply' ),
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
