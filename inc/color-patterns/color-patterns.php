<?php
/**
 * Color Patterns
 *
 * @package amply
 */

/**
 * Generate the CSS for the current primary color.
 */
function amply_custom_colors_css() {

	$primary_color = esc_attr( get_theme_mod( 'amply_primary_color', amply_defaults( 'amply_primary_color' ) ) );

	$theme_css = '
		/*
		 * Primary - background :
		 * - Blocks
		 */
		.entry .entry-content > .has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-primary-background-color {
			background-color: ' . $primary_color . ';//primary
		}
	';

	$editor_css = '
		/*
		 * Primary:
		 * - pullquote (solid color)
		 */
		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color) {
			background-color: ' . $primary_color . ';
		}
	';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	/**
	 * Filters custom colors CSS.
	 *
	 * @param string $css           Base theme colors CSS.
	 * @param int    $primary_color The user's selected color hue.
	 * @param string $saturation    Filtered theme color saturation level.
	 */
	return apply_filters( 'amply_custom_colors_css', $theme_css );
}
