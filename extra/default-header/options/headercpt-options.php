<?php
/**
 * Default Header options
 *
 * @package amply
 */

/**
 * Header cpt options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_headercpt_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h1 class="title-custom-field">HEADER CPT</h1>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'headercpt',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'select',
		'settings'        => 'amply_default_header_headercpt_template',
		'label'           => esc_html__( 'Select Template', 'amply' ),
		'section'         => 'amply_default_header_section',
		'priority'        => 10,
		'multiple'        => 1,
		'choices'         => Kirki_Helper::get_posts(
			array(
				'posts_per_page' => -1,
				'post_type'      => 'amply_header_cpt',
			)
		),
		'default'         => amply_defaults( 'amply_default_header_headercpt_template' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'headercpt',
			),
		),
	)
);
