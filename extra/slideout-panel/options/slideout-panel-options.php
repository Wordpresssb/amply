<?php
/**
 * Slide out panel options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add slideout panel settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_slideout_panel_defaults( $defaults ) {

	$extra_defaults = array(
		'amply_slideout_panel_activate'         => 0,
		'amply_slideout_panel_content_type'     => 'widgets',
		'amply_slideout_panel_content_template' => 'none',
	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_slideout_panel_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_slideout_panel_section',
	array(
		'title'    => esc_html__( 'Slide-out Panel', 'amply' ),
		'panel'    => 'amply_global_components_panel',
		'priority' => 2,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'switch',
		'settings'  => 'amply_slideout_panel_activate',
		'label'     => esc_html__( 'Add a Slide-out Panel', 'amply' ),
		'section'   => 'amply_slideout_panel_section',
		'default'   => amply_defaults( 'amply_slideout_panel_activate' ),
		'priority'  => 10,
		'transport' => 'auto',
	)
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_slideout_panel_content_type',
		'label'           => esc_html__( 'Slide-out Panel Content', 'amply' ),
		'description'     => esc_html__( 'Choose if the panel content is widgets or a custom template', 'amply' ),
		'section'         => 'amply_slideout_panel_section',
		'priority'        => 10,
		'choices'         => [
			'widgets'  => esc_html__( 'Widgets', 'amply' ),
			'template' => esc_html__( 'Template', 'amply' ),
		],
		'default'         => amply_defaults( 'amply_slideout_panel_content_type' ),
		'active_callback' => [
			[
				'setting'  => 'amply_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_slideout_panel_content_template',
		'label'           => esc_html__( 'Select Template', 'amply' ),
		'description'     => esc_html__( 'Select a template in Admin > Section Templates > Slide-out Panels', 'amply' ),
		'section'         => 'amply_slideout_panel_section',
		'priority'        => 10,
		'multiple'        => 1,
		'choices'         => Kirki_Helper::get_posts(
			[
				'posts_per_page' => -1,
				'post_type'      => 'amply_slideout_cpt',
			]
		) + [ 'none' => esc_html__( 'None', 'amply' ) ],
		'default'         => amply_defaults( 'amply_slideout_panel_content_template' ),
		'active_callback' => [
			[
				'setting'  => 'amply_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'amply_slideout_panel_content_type',
				'operator' => '==',
				'value'    => 'template',
			],
		],
	]
);
