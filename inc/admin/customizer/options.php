<?php
/**
 * Options
 *
 * @package amply
 */

Kirki::add_section(
	'amply_theme_options',
	array(
		'title'    => __( 'Theme Options', 'amply' ),
		'priority' => 160,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'switch',
		'settings'  => 'lazy_load_media',
		'label'     => esc_html__( 'Lazy-load images', 'amply' ),
		'section'   => 'amply_theme_options',
		'default'   => '1',
		'priority'  => 10,
		'transport' => 'postMessage',
		'choices'   => array(
			'lazyload'    => __( 'Lazy-load on (default)', 'amply' ),
			'no-lazyload' => __( 'Lazy-load off', 'amply' ),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'color',
		'settings'  => 'test',
		'label'     => esc_html__( 'Body_color', 'amply' ),
		'section'   => 'amply_theme_options',
		'priority'  => 10,
		'choices'   => array(
			'alpha' => false,
		),
		'default'   => '#ffffff',
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
	)
);
