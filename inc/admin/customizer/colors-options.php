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
		'title'    => esc_html__( 'Colors', 'amply' ),
		'panel'    => 'amply_general_panel',
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
				'element'           => '.site-header',
				'property'          => 'background-color',
				'sanitize_callback' => 'sanitize_frontpage',
			),
			array(
				'element'           => '.site-header__brand a',
				'property'          => 'color',
				'sanitize_callback' => 'sanitize_color_darker',
			),
			array(
				'element'           => '.primary-menu > li:hover > a, .primary-menu > li:hover > svg',
				'property'          => 'color',
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
				'element'  => '.primary-menu .sub-menu',
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
function sanitize_frontpage( $value ) {

	if ( is_front_page() ) {
		return $value;
	}

}

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
