<?php
/**
 * Default mobile menu 1 options
 *
 * @package amply
 */

/**
 * General options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_mobilemenu_mobilemenu1_title',
		'section'         => 'amply_default_mobilemenu_section',
		'default'         => '<h1 class="title-custom-field">MOBILE MENU 1</h1>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_mobilemenu_type',
				'operator' => '==',
				'value'    => 'mobilemenu1',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_mobilemenu_mobilemenu1_elements_trigger',
		'section'         => 'amply_default_mobilemenu_section',
		'default'         => '<div class="outer-trigger-wrap"><span>Add and Sort Elements</span><button id="amply_default_mobilemenu_mobilemenu1_elements_trigger_button" type="button" value="Add and Sort Elements">Change</button></div>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_mobilemenu_type',
				'operator' => '==',
				'value'    => 'mobilemenu1',
			),
		),
	)
);

/**
 * Add outer section for amply_default_mobilemenu_mobilemenu1_elements
 * Triggered by amply_default_mobilemenu_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_default_mobilemenu_mobilemenu1_elements_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_mobilemenu_mobilemenu1_elements_outer_section',
		array(
			'title'    => esc_html__( 'Mobile Menu 1 Elements', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_default_mobilemenu_mobilemenu1_elements_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_default_mobilemenu_mobilemenu1_elements',
		'label'           => esc_html__( 'Mobile Menu 1 Elements', 'amply' ),
		'section'         => 'amply_default_mobilemenu_mobilemenu1_elements_outer_section',
		'priority'        => 10,
		'choices'         => [],
		'default'         => amply_defaults( 'amply_default_mobilemenu_mobilemenu1_elements' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_mobilemenu_type',
				'operator' => '==',
				'value'    => 'mobilemenu1',
			),
		),
	)
);
