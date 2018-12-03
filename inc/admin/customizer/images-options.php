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
		'panel'    => 'amply_general_panel',
		'priority' => 161,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'switch',
		'settings'  => 'amply_lazy_load_images',
		'label'     => esc_html__( 'Lazy-load images', 'amply' ),
		'section'   => 'amply_images',
		'default'   => '1',
		'priority'  => 10,
		'transport' => 'postMessage',
	)
);
