<?php
/**
 * Default sidebar options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add default sidebar settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_default_sidebar_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_default_sidebar_type' => 'none',

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_default_sidebar_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_default_sidebar_section',
	array(
		'title'    => esc_html__( 'Sidebars', 'amply' ),
		'priority' => 304,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_default_sidebar_type_trigger',
		'section'  => 'amply_default_sidebar_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Sidebar Layout</span><button id="amply_default_sidebar_type_trigger_button" type="button" value="Choose the Sidebar Layout">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_default_sidebar_type
 * Triggered by amply_default_sidebar_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_default_sidebar_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_sidebar_outer_section',
		array(
			'title'    => esc_html__( 'Sidebar Layout', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_default_sidebar_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_default_sidebar_type',
		'label'    => esc_html__( 'Choose Sidebar Layout', 'amply' ),
		'section'  => 'amply_default_sidebar_outer_section',
		'default'  => amply_defaults( 'amply_default_sidebar_type' ),
		'priority' => 10,
		'choices'  => array(
			'none'          => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-none.png',
			'sidebar-right' => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-right.png',
			'sidebar-left'  => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-left.png',
			'sidebar-both'  => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-both.png',
		),
	)
);
