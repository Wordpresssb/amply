<?php
/**
 * Default Banner options
 *
 * @package amply
 */

/**
 * Banner cpt options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_banner_bannercpt_title',
		'section'         => 'amply_default_banner_section',
		'default'         => '<h1 class="title-custom-field">BANNER CPT</h1>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'select',
		'settings'        => 'amply_default_banner_bannercpt_template',
		'label'           => esc_html__( 'Select Template', 'amply' ),
		'description'     => esc_html__( 'Select a template in Admin > Section Templates > Headers', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'priority'        => 10,
		'multiple'        => 1,
		'choices'         => Kirki_Helper::get_posts(
			[
				'posts_per_page' => -1,
				'post_type'      => 'amply_banner_cpt',
			]
		) + [ 'none' => esc_html__( 'None', 'amply' ) ],
		'default'         => amply_defaults( 'amply_default_banner_bannercpt_template' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'color',
		'settings'        => 'amply_default_banner_bannercpt_bg_color',
		'label'           => esc_html__( 'Background Color', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'default'         => 'rgba(250,250,250,0)',
		'priority'        => 10,
		'choices'         => [
			'alpha' => true,
		],
		'output'          => [
			[
				'element'  => '#default-bannercpt.site-banner',
				'property' => 'background-color',
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'image',
		'settings'        => 'amply_default_banner_bannercpt_bg_image',
		'label'           => esc_html__( 'Background Image', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'default'         => '',
		'priority'        => 10,
		'output'          => [
			[
				'element'  => '#default-bannercpt.site-banner',
				'property' => 'background-image',
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_default_banner_bannercpt_bg_image_position',
		'label'           => esc_html__( 'Background Image Position', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'priority'        => 10,
		'default'         => 'center center',
		'choices'         => [
			'default'       => esc_html__( 'Default', 'amply' ),
			'top left'      => esc_html__( 'Top Left', 'amply' ),
			'top center'    => esc_html__( 'Top Center', 'amply' ),
			'top right'     => esc_html__( 'Top Right', 'amply' ),
			'center left'   => esc_html__( 'Center Left', 'amply' ),
			'center center' => esc_html__( 'Center Center', 'amply' ),
			'center right'  => esc_html__( 'Center Right', 'amply' ),
			'bottom left'   => esc_html__( 'Bottom Left', 'amply' ),
			'bottom center' => esc_html__( 'Bottom Center', 'amply' ),
			'bottom right'  => esc_html__( 'Bottom Right', 'amply' ),
		],
		'output'          => [
			[
				'element'           => '#default-bannercpt.site-banner',
				'property'          => 'background-position',
				'sanitize_callback' => function( $value ) {
					if ( 'default' === $value ) {
						return 'center center';
					} else {
						return $value;
					}
				},
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			],
			[
				'setting'  => 'amply_default_banner_bannercpt_bg_image',
				'operator' => '!=',
				'value'    => '',
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_default_banner_bannercpt_bg_image_repeat',
		'label'           => esc_html__( 'Background Image Repeat', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'priority'        => 10,
		'default'         => 'repeat',
		'choices'         => [
			'default'   => esc_html__( 'Default', 'amply' ),
			'no-repeat' => esc_html__( 'No-repeat', 'amply' ),
			'repeat'    => esc_html__( 'Repeat', 'amply' ),
			'repeat-x'  => esc_html__( 'Repeat-x', 'amply' ),
			'repeat-y'  => esc_html__( 'Repeat-y', 'amply' ),
		],
		'output'          => [
			[
				'element'           => '#default-bannercpt.site-banner',
				'property'          => 'background-repeat',
				'sanitize_callback' => function( $value ) {
					if ( 'default' === $value ) {
						return 'repeat';
					} else {
						return $value;
					}
				},
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			],
			[
				'setting'  => 'amply_default_banner_bannercpt_bg_image',
				'operator' => '!=',
				'value'    => '',
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_default_banner_bannercpt_bg_image_attachment',
		'label'           => esc_html__( 'Background Image Attachment', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'priority'        => 10,
		'default'         => 'scroll',
		'choices'         => [
			'default' => esc_html__( 'Default', 'amply' ),
			'scroll'  => esc_html__( 'Scroll', 'amply' ),
			'fixed'   => esc_html__( 'Fixed', 'amply' ),
		],
		'output'          => [
			[
				'element'           => '#default-bannercpt.site-banner',
				'property'          => 'background-attachment',
				'sanitize_callback' => function( $value ) {
					if ( 'default' === $value ) {
						return 'scroll';
					} else {
						return $value;
					}
				},
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			],
			[
				'setting'  => 'amply_default_banner_bannercpt_bg_image',
				'operator' => '!=',
				'value'    => '',
			],
		],
	]
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'select',
		'settings'        => 'amply_default_banner_bannercpt_bg_image_size',
		'label'           => esc_html__( 'Background Image Size', 'amply' ),
		'section'         => 'amply_default_banner_section',
		'priority'        => 10,
		'default'         => 'auto',
		'choices'         => [
			'default' => esc_html__( 'Default', 'amply' ),
			'auto'    => esc_html__( 'Auto', 'ubik' ),
			'cover'   => esc_html__( 'Cover', 'ubik' ),
			'contain' => esc_html__( 'Contain', 'ubik' ),
		],
		'output'          => [
			[
				'element'           => '#default-bannercpt.site-banner',
				'property'          => 'background-size',
				'sanitize_callback' => function( $value ) {
					if ( 'default' === $value ) {
						return 'auto';
					} else {
						return $value;
					}
				},
			],
		],
		'transport'       => 'auto',
		'active_callback' => [
			[
				'setting'  => 'amply_default_banner_type',
				'operator' => '==',
				'value'    => 'bannercpt',
			],
			[
				'setting'  => 'amply_default_banner_bannercpt_bg_image',
				'operator' => '!=',
				'value'    => '',
			],
		],
	]
);
