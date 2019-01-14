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

	$primary_color   = esc_attr( get_theme_mod( 'amply_primary_color', amply_defaults( 'amply_primary_color' ) ) );
	$secondary_color = esc_attr( get_theme_mod( 'amply_secondary_color', amply_defaults( 'amply_secondary_color' ) ) );

	$theme_css = '
		/*
		* Theme
		*/

		/*
		* Blocks
		*/

		/* --Background colors-- */
		.entry .entry-content > .has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-primary-background-color {
			background-color: ' . $primary_color . ';/*prim*/
		}
		.entry .entry-content > .has-secondary-background-color,
		.entry .entry-content > *[class^="wp-block-"].has-secondary-background-color,
		.entry .entry-content > *[class^="wp-block-"] .has-secondary-background-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color.has-secondary-background-color {
			background-color: ' . $secondary_color . ';/*sec*/
		}

		/* --Foreground colors-- */
		.entry .entry-content > .has-primary-color,
		.entry .entry-content > *[class^="wp-block-"] .has-primary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color p {
			color: ' . $primary_color . ';/*prim*/
		}
		.entry .entry-content > .has-secondary-color,
		.entry .entry-content > *[class^="wp-block-"] .has-secondary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color,
		.entry .entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color p {
			color: ' . $secondary_color . ';/*sec*/
		}

		/* --button-- */
		.entry .entry-content .wp-block-button .wp-block-button__link:not(.has-background) {
			background-color: ' . $primary_color . ';/*prim*/
		}
		.entry .entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
			color: ' . $primary_color . ';/*prim*/
		}

		/* --quote-- */
		blockquote,
		.entry .entry-content blockquote,
		.entry .entry-content .wp-block-quote:not(.is-large),
		.entry .entry-content .wp-block-quote:not(.is-style-large) {
			border-left-color: ' . $primary_color . ';/*prim*/
		}

		/* --file-- */
		.entry .entry-content .wp-block-file .wp-block-file__button {
			background-color: ' . $primary_color . ';/*prim*/
		}
	';

	$editor_css = '
		/* links */
		.editor-block-list__layout .editor-block-list__block a {
			color: ' . $primary_color . ';/*prim*/
		}

		/* button */
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:hover .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:focus .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:active .wp-block-button__link:not(.has-text-color) {
			color: ' . $primary_color . ';/*prim*/
		}
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover {
			background-color: ' . $primary_color . ';/*prim*/
		}
		/* Pullquote (solid color) */
		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color) {
			background-color: ' . $primary_color . ';/*prim*/
		}
		/* Do not overwrite solid color pullquote or cover links */
		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color a,
		.editor-block-list__layout .editor-block-list__block .wp-block-cover a {
			color: inherit;
		}
		/* quote */
		.editor-block-list__layout .editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .editor-block-list__layout .wp-block-freeform blockquote {
			border-left: 2px solid ' . $primary_color . ';/*prim*/
		}
		/* file */
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink {
			color: ' . $primary_color . ';/*prim*/
		}
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__button {
			background-color: ' . $primary_color . ';/*prim*/
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
