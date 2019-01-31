<?php
/**
 * Default Index Loop options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add default index loop settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_default_index_loop_defaults( $defaults ) {

	$extra_defaults = array(

		'amply_default_index_layout' => 'classic',

	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_default_index_loop_defaults' );

/**
 * Add settings
 */

Kirki::add_panel(
	'amply_default_content_panel',
	array(
		'title'    => esc_html__( 'Content', 'amply' ),
		'priority' => 303,
	)
);

Kirki::add_section(
	'amply_default_index_section',
	array(
		'title'    => esc_html__( 'Posts Index Options', 'amply' ),
		'panel'    => 'amply_default_content_panel',
		'priority' => 160,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'     => 'select',
		'settings' => 'amply_default_index_layout',
		'label'    => esc_html__( 'Choose Posts Layout', 'amply' ),
		'section'  => 'amply_default_index_section',
		'default'  => amply_defaults( 'amply_default_index_layout' ),
		'priority' => 10,
		'choices'  => array(
			'classic' => esc_html__( 'Classic', 'amply' ),
			'card1'   => esc_html__( 'Cards', 'amply' ),
		),
	)
);
