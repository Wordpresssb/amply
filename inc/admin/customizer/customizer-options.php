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
		'priority' => 250,
	)
);

Kirki::add_panel(
	'amply_global_components_panel',
	array(
		'title'    => esc_html__( 'Global Components Options', 'amply' ),
		'priority' => 251,
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

Kirki::add_section(
	'amply_page_options_expanded_section',
	array(
		'title'    => esc_html__( 'Page Options' ),
		'priority' => 310,
		'type'     => 'expanded',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_empty_separator_page_options_expanded_section',
		'label'    => '',
		'section'  => 'amply_page_options_expanded_section',
		'priority' => 10,
	)
);
