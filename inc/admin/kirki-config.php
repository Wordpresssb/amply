<?php
/**
 * Kirki configuration
 *
 * @package amply
 */

if ( ! function_exists( 'amply_kirki_config' ) ) {

	/**
	 * Conig kirki.
	 *
	 * @param array $config kirki config.
	 * @return array
	 */
	function amply_kirki_config( $config ) {
		$config['url_path'] = get_template_directory_uri() . '/inc/admin/kirki/';
		return $config;
	}
}
add_filter( 'kirki/config', 'amply_kirki_config' );

Kirki::add_config(
	'amply_config',
	array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'theme_mod',
	)
);
