<?php
/**
 * Colors Options
 *
 * @package amply
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
		'settings'  => 'test',
		'label'     => esc_html__( 'Body color', 'amply' ),
		'section'   => 'amply_colors',
		'priority'  => 10,
		'choices'   => array(
			'alpha' => false,
		),
		'default'   => '#ffffff',
		'transport' => 'refresh',
		'output'    => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
	)
);

// phpcs:disable

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'color-palette',
		'settings'  => 'amply_primary_color',
		'label'     => esc_html__( 'Primary Color', 'amply' ),
		'section'   => 'amply_colors',
		'priority'  => 10,
		'default'   => '#5C6BC0',
		'choices'   => array(
			'colors' => Kirki_Helper::get_material_design_colors( 'all' ),
			'size'   => 27,
			//'style'  => 'round',
		),
		'transport' => 'auto',
    'output'    => array(
			array(
				'element'  => '#primary',
				'property' => 'background-color',
			),
			array(
				'element'  => '#primary-dark',
				'property' => 'background-color',
				'sanitize_callback' => 'sanitize_color_darker',
			),
			array(
				'element'  => '#primary-light',
				'property' => 'background-color',
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
		'default'   => '#FF5252',
		'choices'   => array(
			'colors' => Kirki_Helper::get_material_design_colors( 'A200' ),
			'size'   => 20,
			'style'  => 'round',
		),
		'transport' => 'auto',
    'output'      => array(
			array(
					'element'           => '#btn',
					'property'          => 'border-color',
			),
			array(
				'element'           => '#btn',
				'property'          => 'background-color',
		),
	),
	)
);

function sanitize_color_darker( $value ) {

	if ( is_front_page() ) {
		return Kirki_Color::adjust_brightness( $value, -80 );
	}

}

function sanitize_color_lighter( $value ) {

	if ( is_front_page() ) {
		return Kirki_Color::adjust_brightness( $value, 80 );
	}

}
