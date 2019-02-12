<?php
/**
 * Single Footer options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add single footer settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_single_footer_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_single_footer_type'               => 'default',

		'amply_single_footer_footercpt_template' => 'none',

		'amply_single_footer_footer1_elements'   => [],

		'amply_single_footer_footer2_elements'   => [],

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_single_footer_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_single_footer_section',
	array(
		'title'    => esc_html__( 'Single Posts Footer', 'amply' ),
		'priority' => 4,
		'panel'    => 'amply_single_panel',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_single_footer_type_trigger',
		'section'  => 'amply_single_footer_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Footer Type</span><button id="amply_single_footer_type_trigger_button" type="button" value="Choose the Footer Type">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_single_footer_type
 * Triggered by amply_single_footer_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_single_footer_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_single_footer_outer_section',
		array(
			'title'    => esc_html__( 'Footer type', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_single_footer_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_single_footer_type',
		'label'    => esc_html__( 'Choose footer type', 'amply' ),
		'section'  => 'amply_single_footer_outer_section',
		'default'  => amply_defaults( 'amply_single_footer_type' ),
		'priority' => 10,
		'choices'  => array(
			'default'   => get_template_directory_uri() . '/assets/images/default.png',
			'none'      => get_template_directory_uri() . '/assets/images/none.png',
			'footercpt' => get_template_directory_uri() . '/extra/default-footer/images/footercpt.png',
			'footer1'   => get_template_directory_uri() . '/extra/default-footer/images/footer1.png',
			'footer2'   => get_template_directory_uri() . '/extra/default-footer/images/footer2.png',
		),
	)
);

require_once get_template_directory() . '/extra/single/footer/options/footercpt-options.php';
require_once get_template_directory() . '/extra/single/footer/options/footer1-options.php';
require_once get_template_directory() . '/extra/single/footer/options/footer2-options.php';
