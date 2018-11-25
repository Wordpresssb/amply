<?php
/**
 * Images Options
 *
 * @package amply
 */

Kirki::add_section(
	'amply_images',
	array(
		'title'    => __( 'Images', 'amply' ),
		'priority' => 161,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'switch',
		'settings'  => 'lazy_load_media',
		'label'     => esc_html__( 'Lazy-load images', 'amply' ),
		'section'   => 'amply_images',
		'default'   => '1',
		'priority'  => 10,
		'transport' => 'postMessage',
		'choices'   => array(
			'lazyload'    => __( 'Lazy-load on (default)', 'amply' ),
			'no-lazyload' => __( 'Lazy-load off', 'amply' ),
		),
	)
);
