<?php
/**
 * Frontpage Header options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add frontpage header settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_frontpage_header_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_frontpage_header_type'             => 'default',

		'amply_frontpage_header_header1_elements' => array(
			'primary-nav',
			'mobile-menu-trigger',
		),
		'amply_frontpage_header_header2_elements' => array(
			'site-logo',
			'social-nav',
			'primary-nav',
			'search-form',
		),

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_frontpage_header_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_frontpage_header_section',
	array(
		'title'    => esc_html__( 'Front Page Header', 'amply' ),
		'priority' => 1,
		'panel'    => 'amply_frontpage_panel',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_frontpage_header_type_trigger',
		'section'  => 'amply_frontpage_header_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Header Type</span><button id="amply_frontpage_header_type_trigger_button" type="button" value="Choose the Header Type">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_frontpage_header_type
 * Triggered by amply_frontpage_header_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_frontpage_header_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_frontpage_header_outer_section',
		array(
			'title'    => esc_html__( 'Header type', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_frontpage_header_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_frontpage_header_type',
		'label'    => esc_html__( 'Choose header type', 'amply' ),
		'section'  => 'amply_frontpage_header_outer_section',
		'default'  => amply_defaults( 'amply_frontpage_header_type' ),
		'priority' => 10,
		'choices'  => array(
			'default' => get_template_directory_uri() . '/assets/images/default.png',
			'header1' => get_template_directory_uri() . '/extra/default-header/images/header1.png',
			'header2' => get_template_directory_uri() . '/extra/default-header/images/header2.png',
		),
	)
);

require_once get_template_directory() . '/extra/frontpage/header/options/header1-options.php';
require_once get_template_directory() . '/extra/frontpage/header/options/header2-options.php';
