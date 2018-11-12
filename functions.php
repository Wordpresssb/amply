<?php
/**
 * WP Rig functions and definitions
 *
 * This file must be parseable by PHP 5.2.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package amply
 */

// Core contants.
define( 'AMPLY_MINIMUM_WP_VERSION', '4.5' );
define( 'AMPLY_MINIMUM_PHP_VERSION', '7.0' );
define( 'AMPLY_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'AMPLY_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Bail if requirements are not met.
 */
if ( version_compare( $GLOBALS['wp_version'], AMPLY_MINIMUM_WP_VERSION, '<' ) || version_compare( phpversion(), AMPLY_MINIMUM_PHP_VERSION, '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Core features.
 */

// Functions used throughout the theme.
require_once get_parent_theme_file_path( 'inc/common-functions.php' );

// Sanitize callbacks.
require_once get_parent_theme_file_path( 'inc/sanitization-callbacks.php' );

// Custom template tags used throughout the theme.
require_once get_parent_theme_file_path( 'inc/template-tags.php' );

// Setup configurations.
require_once get_parent_theme_file_path( 'inc/class-amply-setup.php' );

// Core hooks.
require_once get_parent_theme_file_path( 'inc/class-amply-general-hooks.php' );
require_once get_parent_theme_file_path( 'inc/class-amply-image-sizes.php' );

// Widgets.
require_once get_parent_theme_file_path( 'inc/class-amply-widgets.php' );

// Customizer additions.
require_once get_parent_theme_file_path( 'inc/class-amply-customizer.php' );

// Main assets management.
require_once get_parent_theme_file_path( 'inc/class-amply-assets.php' );

/**
 * Compatibility.
 */

// Load Jetpack compatibility, if plugin is active.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( 'inc/jetpack-compat.php' );
}

/**
 * Pluggable
 */

// Add theme support for lazyloading images.
require_once get_parent_theme_file_path( 'pluggable/lazyload/class-amply-lazyload-images.php' );

// Add Custom Header feature.
require_once get_parent_theme_file_path( 'pluggable/custom-header/class-amply-custom-header.php' );
