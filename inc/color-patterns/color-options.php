<?php
/**
 * Colors Options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add colors settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_colors_defaults( $defaults ) {

	$color_defaults = array(
		'amply_primary_color'   => '#5C6BC0',
		'amply_secondary_color' => '#FF5252',
		'amply_body_bg_color'   => '#ffffff',
	);

	$defaults = array_merge( $color_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_colors_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_colors',
	array(
		'title'    => esc_html__( 'Colors', 'amply' ),
		'panel'    => 'amply_general_panel',
		'priority' => 160,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'color-palette',
		'settings'  => 'amply_primary_color',
		'label'     => esc_html__( 'Primary Color', 'amply' ),
		'section'   => 'amply_colors',
		'priority'  => 10,
		'default'   => amply_defaults( 'amply_primary_color' ),
		'choices'   => array(
			'colors' => Kirki_Helper::get_material_design_colors( 'all' ),
			'size'   => 27,
		),
		'transport' => 'postMessage',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'color-palette',
		'settings'  => 'amply_secondary_color',
		'label'     => esc_html__( 'Secondary Color', 'amply' ),
		'section'   => 'amply_colors',
		'priority'  => 10,
		'default'   => amply_defaults( 'amply_secondary_color' ),
		'choices'   => array(
			'colors' => Kirki_Helper::get_material_design_colors( 'A200' ),
			'size'   => 20,
			'style'  => 'round',
		),
		'transport' => 'postMessage',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'color',
		'settings'  => 'amply_body_bg_color',
		'label'     => esc_html__( 'Body background color', 'amply' ),
		'section'   => 'amply_colors',
		'priority'  => 10,
		'choices'   => array(
			'alpha' => false,
		),
		'default'   => amply_defaults( 'amply_body_bg_color' ),
		'transport' => 'postMessage',
	)
);

