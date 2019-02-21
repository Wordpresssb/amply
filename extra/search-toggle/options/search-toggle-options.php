<?php
/**
 * Search toggle options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add search toggle settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_search_toggle_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_search_toggle_type' => 'overlay1',

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_search_toggle_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_search_toggle_section',
	array(
		'title'    => esc_html__( 'Search Toggle', 'amply' ),
		'panel'    => 'amply_global_components_panel',
		'priority' => 1,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'custom',
		'settings' => 'amply_search_toggle_type_trigger',
		'section'  => 'amply_search_toggle_section',
		'default'  => '<div class="outer-trigger-wrap"><span>Choose the Search Style</span><button id="amply_search_toggle_type_trigger_button" type="button" value="Choose the search style">Change</button></div>',
		'priority' => 10,
	)
);

/**
 * Add outer section for amply_search_toggle_type
 * Triggered by amply_search_toggle_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_register_search_toggle_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_search_toggle_outer_section',
		array(
			'title'    => esc_html__( 'Search Style', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_register_search_toggle_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'radio-image',
		'settings' => 'amply_search_toggle_type',
		'label'    => esc_html__( 'Choose search style', 'amply' ),
		'section'  => 'amply_search_toggle_outer_section',
		'default'  => amply_defaults( 'amply_search_toggle_type' ),
		'priority' => 10,
		'choices'  => array(
			'overlay1' => get_template_directory_uri() . '/extra/search-toggle/images/search-overlay1.png',
			'overlay2' => get_template_directory_uri() . '/extra/search-toggle/images/search-overlay2.png',
		),
	)
);
