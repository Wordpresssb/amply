<?php
/**
 * Default mobilemenu options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add default mobilemenu settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_default_mobilemenu_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_default_mobilemenu_type'                   => 'mobilemenu1',

		'amply_default_mobilemenu_mobilemenucpt_template' => 'none',

		'amply_default_mobilemenu_mobilemenu1_elements'   => [],

		'amply_default_mobilemenu_mobilemenu2_elements'   => [],

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_default_mobilemenu_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_default_mobilemenu_section',
	array(
		'title'    => esc_html__( 'Mobile Menu', 'amply' ),
		'priority' => 307,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_default_mobilemenu_type_trigger',
		'section'  => 'amply_default_mobilemenu_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Mobile Menu Type</span><button id="amply_default_mobilemenu_type_trigger_button" type="button" value="Choose the Mobile Menu Type">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_default_mobilemenu_type
 * Triggered by amply_default_mobilemenu_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_default_mobilemenu_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_mobilemenu_outer_section',
		array(
			'title'    => esc_html__( 'Mobile menu type', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_default_mobilemenu_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_default_mobilemenu_type',
		'label'    => esc_html__( 'Choose mobile menu type', 'amply' ),
		'section'  => 'amply_default_mobilemenu_outer_section',
		'default'  => amply_defaults( 'amply_default_mobilemenu_type' ),
		'priority' => 10,
		'choices'  => array(
			'mobilemenucpt' => get_template_directory_uri() . '/extra/default-mobilemenu/images/mobilemenucpt.png',
			'mobilemenu1'   => get_template_directory_uri() . '/extra/default-mobilemenu/images/mobilemenu1.png',
			'mobilemenu2'   => get_template_directory_uri() . '/extra/default-mobilemenu/images/mobilemenu2.png',
		),
	)
);

require_once get_template_directory() . '/extra/default-mobilemenu/options/mobilemenucpt-options.php';
require_once get_template_directory() . '/extra/default-mobilemenu/options/mobilemenu1-options.php';
require_once get_template_directory() . '/extra/default-mobilemenu/options/mobilemenu2-options.php';
