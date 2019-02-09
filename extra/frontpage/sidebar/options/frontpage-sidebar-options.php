<?php
/**
 * Front page sidebar options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add front page sidebar settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_frontpage_sidebar_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_frontpage_sidebar_type'                   => 'default',
		'amply_frontpage_sidebar_sidebar_left_type'      => 'widgets',
		'amply_frontpage_sidebar_sidebar_left_template'  => 'none',
		'amply_frontpage_sidebar_sidebar_right_type'     => 'widgets',
		'amply_frontpage_sidebar_sidebar_right_template' => 'none',

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_frontpage_sidebar_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_frontpage_sidebar_section',
	array(
		'title'    => esc_html__( 'Front Page Sidebars', 'amply' ),
		'priority' => 1,
		'panel'    => 'amply_frontpage_panel',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_frontpage_sidebar_type_trigger',
		'section'  => 'amply_frontpage_sidebar_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Sidebar Layout</span><button id="amply_frontpage_sidebar_type_trigger_button" type="button" value="Choose the Sidebar Layout">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_frontpage_sidebar_type
 * Triggered by amply_frontpage_sidebar_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_frontpage_sidebar_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_frontpage_sidebar_outer_section',
		array(
			'title'    => esc_html__( 'Sidebar Layout', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_frontpage_sidebar_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_frontpage_sidebar_type',
		'label'    => esc_html__( 'Choose Sidebar Layout', 'amply' ),
		'section'  => 'amply_frontpage_sidebar_outer_section',
		'default'  => amply_defaults( 'amply_frontpage_sidebar_type' ),
		'priority' => 10,
		'choices'  => array(
			'default'       => get_template_directory_uri() . '/assets/images/default.png',
			'none'          => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-none.png',
			'sidebar-right' => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-right.png',
			'sidebar-left'  => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-left.png',
			'sidebar-both'  => get_template_directory_uri() . '/extra/default-sidebar/images/sidebar-both.png',
		),
	)
);

require_once get_template_directory() . '/extra/frontpage/sidebar/options/sidebar-left-options.php';
require_once get_template_directory() . '/extra/frontpage/sidebar/options/sidebar-right-options.php';
