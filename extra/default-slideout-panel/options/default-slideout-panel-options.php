<?php
/**
 * Default slide out panel options
 *
 * @package amply
 */

/**
 * Filter the defaults array to add slideout panel settings default values
 *
 * @param array $defaults Defaults values.
 * @return array
 */
function amply_add_default_slideout_panel_defaults( $defaults ) {

	$extra_defaults = array(
		'amply_default_slideout_panel_activate'          => 0,
		'amply_default_slideout_panel_position'          => 'sp-right',
		'amply_default_slideout_panel_open_btn_position' => 'beside',
		'amply_default_slideout_panel_close_btn_display' => 1,
		'amply_default_slideout_panel_close_btn_text'    => esc_html__( 'Close Panel', 'amply' ),
		'amply_default_slideout_panel_content_type'      => 'widgets',
		'amply_default_slideout_panel_content_template'  => 'none',
	);

	$defaults = array_merge( $extra_defaults, $defaults );

	return $defaults;
}
add_filter( 'amply_default_options_filter', 'amply_add_default_slideout_panel_defaults' );

/**
 * Add settings
 */

Kirki::add_section(
	'amply_default_slideout_panel_section',
	array(
		'title'    => esc_html__( 'Slide-out Panel', 'amply' ),
		'priority' => 308,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'      => 'switch',
		'settings'  => 'amply_default_slideout_panel_activate',
		'label'     => esc_html__( 'Add a Slide-out Panel', 'amply' ),
		'section'   => 'amply_default_slideout_panel_section',
		'default'   => amply_defaults( 'amply_default_slideout_panel_activate' ),
		'priority'  => 10,
		'transport' => 'auto',
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'radio-buttonset',
		'settings'        => 'amply_default_slideout_panel_position',
		'label'           => esc_html__( 'Panel Position', 'amply' ),
		'section'         => 'amply_default_slideout_panel_section',
		'default'         => 'sp-right',
		'priority'        => 10,
		'transport'       => 'auto',
		'choices'         => [
			'sp-left'  => esc_html__( 'Left', 'amply' ),
			'sp-right' => esc_html__( 'Right', 'amply' ),
		],
		'default'         => amply_defaults( 'amply_default_slideout_panel_position' ),
		'active_callback' => [
			[
				'setting'  => 'amply_default_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
		],
	)
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_default_slideout_panel_open_btn_position',
		'label'           => esc_html__( 'Opening Button Position', 'amply' ),
		'section'         => 'amply_default_slideout_panel_section',
		'priority'        => 10,
		'choices'         => [
			'beside' => esc_html__( 'Beside the panel', 'amply' ),
		],
		'default'         => amply_defaults( 'amply_default_slideout_panel_open_btn_position' ),
		'active_callback' => [
			[
				'setting'  => 'amply_default_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'switch',
		'settings'        => 'amply_default_slideout_panel_close_btn_display',
		'label'           => esc_html__( 'Display Close Button', 'amply' ),
		'section'         => 'amply_default_slideout_panel_section',
		'default'         => amply_defaults( 'amply_default_slideout_panel_close_btn_display' ),
		'priority'        => 10,
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'text',
		'settings'        => 'amply_default_slideout_panel_close_btn_text',
		'label'           => esc_html__( 'Close Button Text', 'kirki' ),
		'section'         => 'amply_default_slideout_panel_section',
		'default'         => amply_defaults( 'amply_default_slideout_panel_close_btn_text' ),
		'priority'        => 10,
		'active_callback' => [
			[
				'setting'  => 'amply_default_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'amply_default_slideout_panel_close_btn_display',
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
		'settings'        => 'amply_default_slideout_panel_content_type',
		'label'           => esc_html__( 'Slide-out Panel Content', 'amply' ),
		'description'     => esc_html__( 'Choose if the panel content is widgets or a custom template', 'amply' ),
		'section'         => 'amply_default_slideout_panel_section',
		'priority'        => 10,
		'choices'         => [
			'widgets'  => esc_html__( 'Widgets', 'amply' ),
			'template' => esc_html__( 'Template', 'amply' ),
		],
		'default'         => amply_defaults( 'amply_default_slideout_panel_content_type' ),
		'active_callback' => [
			[
				'setting'  => 'amply_default_slideout_panel_activate',
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
		'settings'        => 'amply_default_slideout_panel_content_template',
		'label'           => esc_html__( 'Select Template', 'amply' ),
		'description'     => esc_html__( 'Select a template in Admin > Section Templates > Slide-out Panels', 'amply' ),
		'section'         => 'amply_default_slideout_panel_section',
		'priority'        => 10,
		'multiple'        => 1,
		'choices'         => Kirki_Helper::get_posts(
			[
				'posts_per_page' => -1,
				'post_type'      => 'amply_slideout_cpt',
			]
		) + [ 'none' => esc_html__( 'None', 'amply' ) ],
		'default'         => amply_defaults( 'amply_default_slideout_panel_content_template' ),
		'active_callback' => [
			[
				'setting'  => 'amply_default_slideout_panel_activate',
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => 'amply_default_slideout_panel_content_type',
				'operator' => '==',
				'value'    => 'template',
			],
		],
	]
);
