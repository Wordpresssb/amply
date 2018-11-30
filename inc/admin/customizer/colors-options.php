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

	$extra_defaults = array(
		'amply_body_bg_color'   => '#ffffff',
		'amply_primary_color'   => '#5C6BC0',
		'amply_secondary_color' => '#FF5252',
	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_colors_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_colors',
	array(
		'title'    => __( 'Colors', 'amply' ),
		'priority' => 160,
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
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
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
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '#primary',
				'property' => 'background-color',
			),
			array(
				'element'           => '#primary-dark',
				'property'          => 'background-color',
				'sanitize_callback' => 'sanitize_color_darker',
			),
			array(
				'element'           => '#primary-light',
				'property'          => 'background-color',
				'sanitize_callback' => 'sanitize_color_lighter',
			),
		),
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
		'transport' => 'auto',
		'output'    => array(
			array(
				'element'  => '#btn',
				'property' => 'border-color',
			),
			array(
				'element'  => '#btn',
				'property' => 'background-color',
			),
		),
	)
);

/**
 * Undocumented function
 *
 * @param string $value Initial color.
 * @return string
 */
function sanitize_color_darker( $value ) {

	if ( is_front_page() ) {
		return Kirki_Color::adjust_brightness( $value, -80 );
	}

}

/**
 * Undocumented function
 *
 * @param string $value Initial color.
 * @return string
 */
function sanitize_color_lighter( $value ) {

	if ( is_front_page() ) {
		return Kirki_Color::adjust_brightness( $value, 80 );
	}

}
