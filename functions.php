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
	require_once get_template_directory() . '/inc/compatibility/back-compat.php';
	return;
}

/**
 * Core features.
 */

// Functions used throughout the theme.
require_once get_parent_theme_file_path( 'inc/functions/common-functions.php' );
require_once get_parent_theme_file_path( 'inc/functions/sanitization-callbacks.php' );
require_once get_parent_theme_file_path( 'inc/functions/template-tags.php' );

// Setup configurations.
require_once get_parent_theme_file_path( 'inc/setup/class-amply-setup.php' );

// Core hooks.
require_once get_parent_theme_file_path( 'inc/core-hooks/class-amply-general-hooks.php' );
require_once get_parent_theme_file_path( 'inc/core-hooks/class-amply-image-sizes.php' );

// Widgets.
require_once get_parent_theme_file_path( 'inc/widgets/class-amply-widgets.php' );

// Main assets management.
require_once get_parent_theme_file_path( 'inc/assets/class-amply-assets.php' );

// Admin.
if ( current_user_can( 'manage_options' ) ) {
	require_once get_parent_theme_file_path( 'inc/admin/admin-init.php' );
}

/**
 * Compatibility.
 */

// Load Jetpack compatibility, if plugin is active.
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once get_parent_theme_file_path( 'inc/compatibility/class-amply-jetpack-compat.php' );
}

/**
 * Pluggable
 */

// Add theme support for lazyloading images.
require_once get_parent_theme_file_path( 'pluggable/lazyload/class-amply-lazyload-images.php' );

// Add Custom Header feature.
// require_once get_parent_theme_file_path( 'pluggable/custom-header/class-amply-custom-header.php' ); // phpcs:ignore




// phpcs:disable

/**
 * Tests
 */
function tests() {

	// var_dump( 'Theme Path: ' . get_template_directory() );
	// var_dump( 'Theme URL: ' . get_template_directory_uri() );
	// var_dump( 'Kirki Path: ' . Kirki::$path );
	// var_dump( 'Kirki URL: ' . Kirki::$url );
	// var_dump( get_option( 'active_plugins' ) );

}
add_action( 'wp_footer', 'tests' );
