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
 * Core features
 */

// Functions used throughout the theme.
require_once get_parent_theme_file_path( 'inc/functions/functions-common.php' );
require_once get_parent_theme_file_path( 'inc/functions/functions-template.php' );

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
require_once get_parent_theme_file_path( 'inc/admin/admin-init.php' );

/**
 * Extra features
 */

// Default header.
require_once get_parent_theme_file_path( 'extra/default-header/class-amply-default-header.php' );

/**
 * Compatibility
 */

// Load Jetpack compatibility, if plugin is active.
if ( defined( 'JETPACK__VERSION' ) ) {
	require_once get_parent_theme_file_path( 'inc/compatibility/class-amply-jetpack-compat.php' );
}

/**
 * Pluggable
 */

// Add theme support for lazyloading images.
require_once get_parent_theme_file_path( 'pluggable/lazyload/lazyload.php' );

// Add theme option for retina logo.
require_once get_parent_theme_file_path( 'pluggable/logo-additions/logo-additions.php' );

// Add svg icons functions.
require_once get_parent_theme_file_path( 'pluggable/svg-icons/class-amply-svg-icons.php' );

// Add social nav menu.
require_once get_parent_theme_file_path( 'pluggable/social-nav-menu/class-amply-social-nav-menu.php' );

// Add mobile sidebar.
require get_parent_theme_file_path( '/pluggable/mobile-sidebar/mobile-sidebar.php' );









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
	// var_dump( wp_styles()->registered['amply-header1'] );

	// $test1 = amply_defaults( 'amply_default_header_type' );
	// var_dump($test1);
	// echo '<br>';
	// $test3 = amply_option('amply_default_header_type');
	// var_dump($test3);
	// echo '<br>';
	// $test4 = locate_template( 'views/header/header1/header1.css', false, false );
	// var_dump( $test4 );

	// echo '<pre>';
	// var_dump( wp_styles()->registered[ 'amply-header2' ] );
	// echo '</pre>';

}
add_action( 'wp_footer', 'tests' );
