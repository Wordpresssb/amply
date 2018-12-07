<?php
/**
 * General panel
 *
 * @package amply
 */

Kirki::add_panel(
	'amply_general_panel',
	array(
		'title'    => esc_html__( 'General Options', 'amply' ),
		'priority' => 300,
	)
);

Kirki::add_section(
	'amply_section_options_expanded_section',
	array(
		'title'    => esc_html__( 'Section Options' ),
		'priority' => 301,
		'type'     => 'expanded',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_empty_separator_section_options_expanded_section',
		'label'    => '',
		'section'  => 'amply_section_options_expanded_section',
		'priority' => 10,
	)
);
