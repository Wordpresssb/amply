<?php
/**
 * Default Header 1 options
 *
 * @package amply
 */

/**
 * General options
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_header1_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h1 class="title-custom-field">HEADER 1</h1>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_header1_elements_trigger',
		'section'         => 'amply_default_header_section',
		'default'         => '<div class="outer-trigger-wrap"><span>Add and Sort Elements</span><button id="amply_default_header_header1_elements_trigger_button" type="button" value="Add and Sort Elements">Change</button></div>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
		),
	)
);

/**
 * Add outer section for amply_default_header_header1_elements
 * Triggered by amply_default_header_type_trigger
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function amply_default_header_header1_elements_outer_section( $wp_customize ) {
	$wp_customize->add_section(
		'amply_default_header_header1_elements_outer_section',
		array(
			'title'    => esc_html__( 'Header 1 Elements', 'amply' ),
			'priority' => 0,
			'type'     => 'outer',
		)
	);
}
add_action( 'customize_register', 'amply_default_header_header1_elements_outer_section' );

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'sortable',
		'settings'        => 'amply_default_header_header1_elements',
		'label'           => esc_html__( 'Header1 Elements', 'amply' ),
		'section'         => 'amply_default_header_header1_elements_outer_section',
		'priority'        => 10,
		'choices'         => array(
			'primary-nav'         => esc_html__( 'Primary Navigation', 'amply' ),
			'social-nav'          => esc_html__( 'Social Navigation', 'amply' ),
			'search-form'         => esc_html__( 'Search Form', 'amply' ),
			'mobile-menu-trigger' => esc_html__( 'Mobile Menu Trigger', 'amply' ),
		),
		'default'         => amply_defaults( 'amply_default_header_header1_elements' ),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'radio-buttonset',
		'settings'        => 'amply_default_header_header1_logo_position',
		'label'           => esc_html__( 'Logo Position', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => 'left',
		'priority'        => 10,
		'transport'       => 'auto',
		'choices'         => array(
			'left'  => esc_html__( 'Left', 'amply' ),
			'right' => esc_html__( 'Right', 'amply' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
		),
		'output'          => array(
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'flex-direction',
				'sanitize_callback' => 'sanitize_logo_position',
			),
			array(
				'element'           => '#default-header1 .site-header__brand',
				'property'          => 'flex-direction',
				'sanitize_callback' => 'sanitize_logo_position',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'radio-buttonset',
		'settings'        => 'amply_default_header_header1_position',
		'label'           => esc_html__( 'Header Position', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => 'normal',
		'priority'        => 10,
		'transport'       => 'auto',
		'choices'         => array(
			'normal'      => esc_html__( 'Normal', 'amply' ),
			'sticky'      => esc_html__( 'Sticky', 'amply' ),
			'transparent' => esc_html__( 'Transparent', 'amply' ),
		),
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
		),
		'output'          => array(
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'position',
				'sanitize_callback' => 'sanitize_header_position',
			),
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'width',
				'sanitize_callback' => 'sanitize_header_width',
			),
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'top',
				'sanitize_callback' => 'sanitize_header_top',
			),
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'top',
				'media_query'       => '@media (max-width: 768px)',
				'sanitize_callback' => 'sanitize_header_top_mobile',
			),
			array(
				'element'           => '#default-header1 + .site-content-wrap',
				'property'          => 'padding-top',
				'sanitize_callback' => 'sanitize_header_padding',
			),
		),
	)
);

/**
 * Primary navigation element
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_header1_primary_nav_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h3 class="subtitle-custom-field">Primary Navivation</h3>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'primary-nav',
			),
		),
	)
);

// // phpcs:disable
// // Test dropdown title
// Kirki::add_field(
// 	'amply_config',
// 	array(
// 		'type'            => 'custom',
// 		'settings'        => 'amply_default_header_header1_primary_nav_title_test',
// 		'section'         => 'amply_default_header_section',
// 		'default'         => '<h3 class="custom-dropdown-section">Primary Navivation Test</h3>',
// 		'priority'        => 10,
// 		'active_callback' => array(
// 			array(
// 				'setting'  => 'amply_default_header_type',
// 				'operator' => '==',
// 				'value'    => 'header1',
// 			),
// 			array(
// 				'setting'  => 'amply_default_header_header1_elements',
// 				'operator' => 'contains',
// 				'value'    => 'primary-nav',
// 			),
// 		),
// 	)
// );
// // phpcs:enable

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'switch',
		'settings'        => 'amply_default_header_header1_primary_nav_visibility',
		'label'           => esc_html__( 'Show on Mobile/Tablet', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => '0',
		'priority'        => 10,
		'transport'       => 'auto',
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'primary-nav',
			),
		),
		'output'          => array(
			array(
				'element'           => '#default-header1 .site-primary-nav',
				'property'          => 'display',
				'sanitize_callback' => 'sanitize_visibility',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'select',
		'settings'        => 'amply_default_header_header1_primary_nav_colors',
		'label'           => esc_html__( 'Colors', 'amply' ),
		'section'         => 'amply_default_header_section',
		'priority'        => 10,
		'multiple'        => 1,
		'choices'         => [
			'default' => esc_html__( 'Default', 'amply' ),
			'custom'  => esc_html__( 'Custom', 'amply' ),
		],
		'default'         => 'default',
		'transport'       => 'refresh',
		'active_callback' => [
			[
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			],
			[
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'primary-nav',
			],
		],
	)
);

Kirki::add_field(
	'amply_config',
	[
		'type'            => 'color',
		'settings'        => 'amply_default_header_header1_primary_nav_color',
		'description'     => esc_html__( 'Color', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => '',
		'priority'        => 10,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			],
			[
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'primary-nav',
			],
			[
				'setting'  => 'amply_default_header_header1_primary_nav_colors',
				'operator' => '==',
				'value'    => 'custom',
			],
		],
		'transport'       => 'auto',
		'output'          => [
			[
				'element'           => '#default-header1.site-header .primary-menu, #default-header1.site-header .primary-menu > li > a',
				'property'          => 'color',
				'sanitize_callback' => function( $value ) {
					if ( '' === $value ) {
						return;
					} else {
						return $value;
					}
				},
			],
		],
	]
);

/**
 * Social navigation element
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_header1_social_nav_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h3 class="subtitle-custom-field">Social Navivation</h3>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'social-nav',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'switch',
		'settings'        => 'amply_default_header_header1_social_nav_visibility',
		'label'           => esc_html__( 'Show on Mobile/Tablet', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => '0',
		'priority'        => 10,
		'transport'       => 'auto',
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'social-nav',
			),
		),
		'output'          => array(
			array(
				'element'           => '#default-header1 .site-social-nav',
				'property'          => 'display',
				'sanitize_callback' => 'sanitize_visibility',
			),
		),
	)
);

/**
 * Search element
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_header1_search_form_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h3 class="subtitle-custom-field">Search Form</h3>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'search-form',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'switch',
		'settings'        => 'amply_default_header_header1_search_form_visibility',
		'label'           => esc_html__( 'Show on Mobile/Tablet', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => '0',
		'priority'        => 10,
		'transport'       => 'auto',
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'search-form',
			),
		),
		'output'          => array(
			array(
				'element'           => '#default-header1 .site-search-form',
				'property'          => 'display',
				'sanitize_callback' => 'sanitize_visibility',
			),
		),
	)
);

/**
 * Mobile menu trigger element
 */

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'custom',
		'settings'        => 'amply_default_header_header1_mobile_menu_trigger_title',
		'section'         => 'amply_default_header_section',
		'default'         => '<h3 class="subtitle-custom-field">Mobile Menu Trigger</h3>',
		'priority'        => 10,
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'mobile-menu-trigger',
			),
		),
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'switch',
		'settings'        => 'amply_default_header_header1_mobile_menu_trigger_visibility',
		'label'           => esc_html__( 'Show on Desktop', 'amply' ),
		'section'         => 'amply_default_header_section',
		'default'         => '0',
		'priority'        => 10,
		'transport'       => 'auto',
		'active_callback' => array(
			array(
				'setting'  => 'amply_default_header_type',
				'operator' => '==',
				'value'    => 'header1',
			),
			array(
				'setting'  => 'amply_default_header_header1_elements',
				'operator' => 'contains',
				'value'    => 'mobile-menu-trigger',
			),
		),
		'output'          => array(
			array(
				'element'           => '#default-header1 .mobile-menu-trigger',
				'property'          => 'display',
				'sanitize_callback' => 'sanitize_visibility',
			),
		),
	)
);
