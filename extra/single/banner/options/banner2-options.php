<?php
/**
 * Single banner options
 *
 * @package amply
 */

/**
 * Banner 2 options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_single_banner_banner2_title',
		'section'         => 'amply_single_banner_section',
		'default'         => '<h1 class="title-custom-field">BANNER 2</h1>',
		'priority'        => 10,
		'active_callback' => [
			[
				'setting'  => 'amply_single_banner_type',
				'operator' => '==',
				'value'    => 'banner2',
			],
		],
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_single_banner_banner2_elements_trigger',
		'section'         => 'amply_single_banner_section',
		'default'         => '<div class="outer-trigger-wrap"><span>Add and Sort Elements</span><button id="amply_single_banner_banner2_elements_trigger_button" type="button" value="Add and Sort Elements">Change</button></div>',
		'priority'        => 10,
		'active_callback' => [
			[
				'setting'  => 'amply_single_banner_type',
				'operator' => '==',
				'value'    => 'banner2',
			],
		],
	)
);

/**
 * Add outer section for amply_single_banner_banner1_elements
 * Triggered by amply_single_banner_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_single_banner_banner2_elements_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_single_banner_banner2_elements_outer_section',
		array(
			'title'    => esc_html__( 'Banner 2 Elements', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_single_banner_banner2_elements_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_single_banner_banner2_elements',
		'label'           => esc_html__( 'Banner 2 Elements', 'amply' ),
		'section'         => 'amply_single_banner_banner2_elements_outer_section',
		'priority'        => 10,
		'choices'         => [],
		'default'         => amply_defaults( 'amply_single_banner_banner2_elements' ),
		'active_callback' => [
			[
				'setting'  => 'amply_single_banner_type',
				'operator' => '==',
				'value'    => 'banner2',
			],
		],
	)
);
