<?php
/**
 * Functions used throughout the theme.
 *
 * @package amply
 */

/**
 * Generate preload markup for stylesheets.
 *
 * @param object $wp_styles Registered styles.
 * @param string $handle The style handle.
 */
function amply_get_preload_stylesheet_uri( $wp_styles, $handle ) {
	$preload_uri = $wp_styles->registered[ $handle ]->src . '?ver=' . $wp_styles->registered[ $handle ]->ver;
	return $preload_uri;
}

/**
 * Minify CSS
 *
 * @param string $css The css to minify.
 * @return string $css Minified css
 */
function amply_minify_css( $css = '' ) {

	// Return if no CSS.
	if ( ! $css ) {
		return;
	}

	// Normalize whitespace.
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove ; before }.
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >.
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { }.
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px).
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0).
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Trim.
	$css = trim( $css );

	// Return minified CSS.
	return $css;

}

/**
 * Get default theme options
 *
 * @param string $option Option key.
 * @return mixed Option default value.
 */
function amply_defaults( $option = '' ) {

	$default = array();

	// Pass array through filter.
	$default = apply_filters( 'amply_default_options_filter', $default );

	$value = '';

	$value = ( isset( $default[ $option ] ) && '' !== $default[ $option ] ) ? $default[ $option ] : $value;

	return $value;

}

/**
 * Wrapper function for get_theme_mod()
 *
 * @param string $option Option name.
 * @return mixed Option value.
 */
function amply_option( $option ) {

	return get_theme_mod( $option, amply_defaults( $option ) );

}
