<?php
/**
 * Sanitize_callback.
 *
 * @package amply
 */

// phpcs:disable

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'switch',
		'settings'        => 'amply_default_header_header1_sticky',
		'label'           => esc_html__( 'Sticky Header', 'amply' ),
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
		),
		'output'          => array(
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'position',
				'sanitize_callback' => 'sanitize_sticky_position',
			),
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'width',
				'sanitize_callback' => 'sanitize_sticky_width',
			),
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'top',
				'sanitize_callback' => 'sanitize_sticky_top',
			),
			array(
				'element'           => '#default-header1.site-header',
				'property'          => 'top',
				'media_query'       => '@media (max-width: 768px)',
				'sanitize_callback' => 'sanitize_sticky_top_mobile',
			),
			array(
				'element'           => '#default-header1 + .site-content-wrap',
				'property'          => 'padding-top',
				'sanitize_callback' => 'sanitize_sticky_padding',
			),
		),
	)
);

/**
 * Sanitize sticky position
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_position( $value ) {

	if ( $value ) {
		return 'fixed';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky width
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_width( $value ) {

	if ( $value ) {
		return '100%';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky top
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_top( $value ) {

	if ( $value && is_admin_bar_showing() ) {
		return '32px';
	} elseif ( $value ) {
		return '0';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky top mobile
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_top_mobile( $value ) {

	if ( $value && is_admin_bar_showing() ) {
		return '45px';
	} elseif ( $value ) {
		return '0';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky padding
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_padding( $value ) {

	if ( $value ) {
		return '3.5rem';
	} else {
		return false;
	}

}
