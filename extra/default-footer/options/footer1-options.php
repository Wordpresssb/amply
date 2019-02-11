<?php
/**
 * Default Footer options
 *
 * @package amply
 */

/**
 * Footer 1 options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_footer_footer1_title',
		'section'         => 'amply_default_footer_section',
		'default'         => '<h1 class="title-custom-field">FOOTER 1</h1>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_footer_type',
				'operator' => '==',
				'value'    => 'footer1',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_footer_footer1_elements_trigger',
		'section'         => 'amply_default_footer_section',
		'default'         => '<div class="outer-trigger-wrap"><span>Add and Sort Elements</span><button id="amply_default_footer_footer1_elements_trigger_button" type="button" value="Add and Sort Elements">Change</button></div>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_footer_type',
				'operator' => '==',
				'value'    => 'footer1',
			),
		),
	)
);

/**
 * Add outer section for amply_default_footer_footer1_elements
 * Triggered by amply_default_footer_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_default_footer_footer1_elements_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_footer_footer1_elements_outer_section',
		array(
			'title'    => esc_html__( 'Banner 1 Elements', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_default_footer_footer1_elements_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_default_footer_footer1_elements',
		'label'           => esc_html__( 'Header1 Elements', 'amply' ),
		'section'         => 'amply_default_footer_footer1_elements_outer_section',
		'priority'        => 10,
		'choices'         => [],
		'default'         => amply_defaults( 'amply_default_footer_footer1_elements' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_footer_type',
				'operator' => '==',
				'value'    => 'footer1',
			),
		),
	)
);
