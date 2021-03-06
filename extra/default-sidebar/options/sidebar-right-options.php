<?php
/**
 * Default sidebar right options
 *
 * @package amply
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_sidebar_sidebar_right_title',
		'section'         => 'amply_default_sidebar_section',
		'default'         => '<h1 class="title-custom-field">SIDEBAR RIGHT OPTIONS</h1>',
		'priority'        => 11,
		'active_callback' => array(
			array(
				array(
					'setting'  => 'amply_default_sidebar_type',
					'operator' => '==',
					'value'    => 'sidebar-right',
				),
				array(
					'setting'  => 'amply_default_sidebar_type',
					'operator' => '==',
					'value'    => 'sidebar-both',
				),
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'select',
		'settings'        => 'amply_default_sidebar_sidebar_right_type',
		'label'           => esc_html__( 'Sidebar Content', 'amply' ),
		'description'     => esc_html__( 'Choose if sidebar content is widgets or a custom template', 'amply' ),
		'section'         => 'amply_default_sidebar_section',
		'priority'        => 11,
		'choices'         => [
			'widgets'  => esc_html__( 'Widgets', 'amply' ),
			'template' => esc_html__( 'Template', 'amply' ),
		],
		'default'         => amply_defaults( 'amply_default_sidebar_sidebar_right_type' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'amply_default_sidebar_type',
					'operator' => '==',
					'value'    => 'sidebar-right',
				),
				array(
					'setting'  => 'amply_default_sidebar_type',
					'operator' => '==',
					'value'    => 'sidebar-both',
				),
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'select',
		'settings'        => 'amply_default_sidebar_sidebar_right_template',
		'label'           => esc_html__( 'Select Template', 'amply' ),
		'description'     => esc_html__( 'Select a template in Admin > Section Templates > Sidebars', 'amply' ),
		'section'         => 'amply_default_sidebar_section',
		'priority'        => 11,
		'multiple'        => 1,
		'choices'         => Kirki_Helper::get_posts(
			[
				'posts_per_page' => -1,
				'post_type'      => 'amply_sidebar_cpt',
			]
		) + [ 'none' => esc_html__( 'None', 'amply' ) ],
		'default'         => amply_defaults( 'amply_default_sidebar_sidebar_right_template' ),
		'active_callback' => array(
			array(
				array(
					'setting'  => 'amply_default_sidebar_type',
					'operator' => '==',
					'value'    => 'sidebar-right',
				),
				array(
					'setting'  => 'amply_default_sidebar_type',
					'operator' => '==',
					'value'    => 'sidebar-both',
				),
			),
			array(
				'setting'  => 'amply_default_sidebar_sidebar_right_type',
				'operator' => '==',
				'value'    => 'template',
			),
		),
	)
);
