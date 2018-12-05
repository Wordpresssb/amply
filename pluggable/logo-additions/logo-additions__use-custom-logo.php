<?php
/**
 * Retina logo additions
 * Add retina logo option and expose the amply_logo() function to render the logo
 *
 * @package amply
 */

// phpcs:disable

Kirki::add_field(
	'theme_config_id',
	array(
		'type'        => 'checkbox',
		'settings'    => 'amply_add_retina_logo',
		'label'       => esc_attr__( 'Add a Logo for Retina devices', 'amply' ),
		'section'     => 'title_tagline',
		'priority'    => 8,
		'default'     => false,
	)
);

Kirki::add_field(
	'amply_config',
	array(
		'type'            => 'image',
		'settings'        => 'amply_retina_logo',
		'label'           => esc_html__( 'Retina Logo', 'amply' ),
		'description'     => esc_html__( 'Select a logo twice the normal size', 'amply' ),
		'section'         => 'title_tagline',
		'default'         => '',
		'priority'        => 9,
		'active_callback' => array(
			array(
				'setting'  => 'amply_add_retina_logo',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);


if ( ! function_exists( 'amply_logo' ) ) {

	/**
	 * Echo (or return) site logo markup.
	 * Use the core function get_custom_logo()
	 *
	 * @param  boolean $echo Echo markup.
	 * @return mixed echo or return markup.
	 */
	function amply_logo( $echo = true ) {

		$html = '';

		$html .= get_custom_logo();

		$html = apply_filters( 'amply_logo', $html );

		/**
		 * Echo or Return the Logo Markup
		 */
		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
	}
}

/**
 * Modify custom logo attributes.
 *
 * @param array  $attr Image.
 * @param object $attachment Image obj.
 * @param sting  $size Size name.
 *
 * @return array Image attr.
 */
function amply_retina_logo_attr( $attr, $attachment, $size ) {

	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id == $attachment->ID ) {

		$add_retina_logo = get_theme_mod( 'amply_add_retina_logo', false );

		if ( apply_filters( 'amply_add_retina_logo_filter', true ) && $add_retina_logo ) {

			$retina_logo_url = get_theme_mod( 'amply_retina_logo', '' );

			$attr['srcset'] = '';

			if ( '' !== $retina_logo_url ) {

				$cutom_logo     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
				$cutom_logo_url = $cutom_logo[0];

				$attr['srcset'] = $cutom_logo_url . ' 1x, ' . $retina_logo_url . ' 2x';

				// Remove the size attr
				unset( $attr['sizes'] );

			}
		}
	}

	return apply_filters( 'astra_replace_header_attr', $attr );
}
add_filter( 'wp_get_attachment_image_attributes', 'amply_retina_logo_attr', 10, 3 );
