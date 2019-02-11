<?php
/**
 * Default banner options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add default banner settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_default_banner_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_default_banner_type'               => 'banner1',

		'amply_default_banner_bannercpt_template' => 'none',

		'amply_default_banner_banner1_elements'   => [],

		'amply_default_banner_banner2_elements'   => [],

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_default_banner_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_default_banner_section',
	array(
		'title'    => esc_html__( 'Banner', 'amply' ),
		'priority' => 303,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_default_banner_type_trigger',
		'section'  => 'amply_default_banner_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Banner Type</span><button id="amply_default_banner_type_trigger_button" type="button" value="Choose the Banner Type">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_default_banner_type
 * Triggered by amply_default_banner_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_default_banner_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_banner_outer_section',
		array(
			'title'    => esc_html__( 'Banner type', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_default_banner_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_default_banner_type',
		'label'    => esc_html__( 'Choose banner type', 'amply' ),
		'section'  => 'amply_default_banner_outer_section',
		'default'  => amply_defaults( 'amply_default_banner_type' ),
		'priority' => 10,
		'choices'  => array(
			'none'      => get_template_directory_uri() . '/assets/images/none.png',
			'bannercpt' => get_template_directory_uri() . '/extra/default-banner/images/bannercpt.png',
			'banner1'   => get_template_directory_uri() . '/extra/default-banner/images/banner1.png',
			'banner2'   => get_template_directory_uri() . '/extra/default-banner/images/banner2.png',
		),
	)
);

require_once get_template_directory() . '/extra/default-banner/options/bannercpt-options.php';
require_once get_template_directory() . '/extra/default-banner/options/banner1-options.php';
require_once get_template_directory() . '/extra/default-banner/options/banner2-options.php';
