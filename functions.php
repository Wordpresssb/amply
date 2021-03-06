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
 * TGM
 */
if ( is_admin() ) {
	require get_parent_theme_file_path( 'tgm/tgm-plugin-activation.php' );
}

/**
 * Framework
 * Functions used throughout the theme.
 */
require_once get_parent_theme_file_path( 'framework/functions-common.php' );
require_once get_parent_theme_file_path( 'framework/functions-template.php' );
require_once get_parent_theme_file_path( 'framework/extended-template-parts/extended-template-parts.php' );


/**
 * Core features
 */


// Setup configurations.
require_once get_parent_theme_file_path( 'inc/setup/class-amply-setup.php' );

// Admin.
require_once get_parent_theme_file_path( 'inc/admin/admin-init.php' );

// Core hooks.
require_once get_parent_theme_file_path( 'inc/core-hooks/class-amply-general-hooks.php' );
require_once get_parent_theme_file_path( 'inc/core-hooks/class-amply-image-sizes.php' );

// Widgets.
require_once get_parent_theme_file_path( 'inc/widgets/class-amply-widgets.php' );

// Main assets management.
require_once get_parent_theme_file_path( 'inc/assets/class-amply-assets.php' );

// Colors.
require_once get_parent_theme_file_path( 'inc/color-patterns/class-amply-color-patterns.php' );

/**
 * Extra features
 */

// Sanitize callbacks.
require_once get_parent_theme_file_path( 'extra/sanitize-callbacks/functions-sanitize-callbacks.php' );

// Default header.
require_once get_parent_theme_file_path( 'extra/default-header/class-amply-default-header.php' );

// Default banner.
require_once get_parent_theme_file_path( 'extra/default-banner/class-amply-default-banner.php' );

// Default index loop.
require_once get_parent_theme_file_path( 'extra/default-index-loop/class-amply-default-index-loop.php' );

// Default single loop.
require_once get_parent_theme_file_path( 'extra/default-single-loop/class-amply-default-single-loop.php' );

// Default page loop.
require_once get_parent_theme_file_path( 'extra/default-page-loop/class-amply-default-page-loop.php' );

// Default sidebar.
require_once get_parent_theme_file_path( 'extra/default-sidebar/class-amply-default-sidebar.php' );

// Default footer.
require_once get_parent_theme_file_path( 'extra/default-footer/class-amply-default-footer.php' );

// Default mobile menu.
require_once get_parent_theme_file_path( 'extra/default-mobilemenu/class-amply-default-mobilemenu.php' );

// Default slide-out panel.
require_once get_parent_theme_file_path( 'extra/default-slideout-panel/class-amply-default-slideout-panel.php' );

// Frontpage.
require_once get_parent_theme_file_path( 'extra/frontpage/frontpage-panel.php' );
require_once get_parent_theme_file_path( 'extra/frontpage/header/class-amply-frontpage-header.php' );
require_once get_parent_theme_file_path( 'extra/frontpage/banner/class-amply-frontpage-banner.php' );
require_once get_parent_theme_file_path( 'extra/frontpage/sidebar/class-amply-frontpage-sidebar.php' );
require_once get_parent_theme_file_path( 'extra/frontpage/footer/class-amply-frontpage-footer.php' );

// Single.
require_once get_parent_theme_file_path( 'extra/single/single-panel.php' );
require_once get_parent_theme_file_path( 'extra/single/header/class-amply-single-header.php' );
require_once get_parent_theme_file_path( 'extra/single/banner/class-amply-single-banner.php' );
require_once get_parent_theme_file_path( 'extra/single/sidebar/class-amply-single-sidebar.php' );
require_once get_parent_theme_file_path( 'extra/single/footer/class-amply-single-footer.php' );

// Global components.
require_once get_parent_theme_file_path( 'extra/search-toggle/class-amply-search-toggle.php' );

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










// phpcs:disable


/**
 * Tests
 */
function tests() {

	// global $template;
	// var_dump( $template );
	// echo '<br>';
	// var_dump( basename( $template ) );

	// var_dump( 'Theme Path: ' . get_template_directory() );
	// var_dump( 'Theme URL: ' . get_template_directory_uri() );
	// var_dump( 'Kirki Path: ' . Kirki::$path );
	// var_dump( 'Kirki URL: ' . Kirki::$url );
	// var_dump( get_option( 'active_plugins' ) );
	// var_dump( wp_styles()->registered['amply-header1'] );

	// $test1 = amply_defaults( 'amply_default_header_header2_elements' );
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

	// echo '<pre>';
	// $theme = wp_get_theme();
	// print_r( $theme );
	// echo '</pre>';

}
add_action( 'wp_footer', 'tests' );

// function My_Test(){
//     var_dump(microtime(true));
//     for ($i=1; $i<100; $i++) { get_option('blogdescription'); }
//     var_dump(microtime(true));
//     for ($i=1; $i<100; $i++) { get_theme_mod('blogdescription'); }
//     var_dump(microtime(true));
//     exit;
// } 
// add_action('wp','My_Test');
