<?php
/**
 * Default Header Component
 *
 * @package amply
 */

Kirki::add_panel(
	'amply_frontpage_panel',
	array(
		'title'    => esc_html__( 'Frontpage', 'amply' ),
		'priority' => 311,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'test',
		'section'  => 'amply_frontpage_panel',
		'default'  => '<h1>test</h1>',
		'priority' => 10,
	)
);
