<?php
/**
 * Logo additions
 * Add retina logo option and expose the amply_logo() function to render the logo
 * amply_logo() is amp ready
 *
 * @package amply
 */

Kirki::add_field(
	'theme_config_id',
	array(
		'type'     => 'checkbox',
		'settings' => 'amply_add_retina_logo',
		'label'    => esc_attr__( 'Add a Logo for Retina devices', 'amply' ),
		'section'  => 'title_tagline',
		'priority' => 8,
		'default'  => false,
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

/**
 * Echo the logo.
 */
function amply_logo() {
	echo amply_get_logo(); // WPCS:XSS ok.
}

/**
 * Returns the logo
 *
 * @return string $html logo markup
 */
function amply_get_logo() {

	$html = '';

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$size           = 'full';
	$attr           = '';

	if ( $custom_logo_id ) {

		$logo = wp_get_attachment_image_src( $custom_logo_id, $size, false );

		if ( $logo ) {

			list($src, $width, $height) = $logo;
			$hwstring                   = image_hwstring( $width, $height );

			$attachment = get_post( $custom_logo_id );

			$attr = array(
				'class'    => 'site-logo',
				'itemprop' => 'logo',
				'src'      => $src,
				'alt'      => wp_strip_all_tags( get_post_meta( $custom_logo_id, '_wp_attachment_image_alt', true ) ),
			);

			// Generate 'srcset' for retina devices.
			$logo_url        = $logo[0];
			$add_retina_logo = get_theme_mod( 'amply_add_retina_logo', false );
			$retina_logo_url = get_theme_mod( 'amply_retina_logo', '' );

			if ( $add_retina_logo && '' !== $retina_logo_url ) {

				$attr['srcset'] = $logo_url . ' 1x, ' . $retina_logo_url . ' 2x';

			}

			// Filter and escape the list of logo attributes.
			$attr = apply_filters( 'amply_logo_attributes', $attr, $attachment, $size );
			$attr = array_map( 'esc_attr', $attr );

			if ( amply_is_amp() ) {
				$html = rtrim( "<amp-img $hwstring" );
			} else {
				$html = rtrim( "<img $hwstring" );
			}

			foreach ( $attr as $name => $value ) {
				$html .= " $name=" . '"' . $value . '"';
			}

			if ( amply_is_amp() ) {
				$html .= ' ></amp-img>';
			} else {
				$html .= ' />';
			}
		}
	}

	return $html;

}
