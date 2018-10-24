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
define( 'AMPLY_THEME_DIR', plugin_dir_path( __FILE__ ) );
define( 'AMPLY_THEME_URI', get_template_directory_uri() );
define( 'AMPLY_THEME_CLASSPATH', AMPLY_THEME_DIR . 'class/' );

/**
 * Bail if requirements are not met.
 */
if ( version_compare( $GLOBALS['wp_version'], AMPLY_MINIMUM_WP_VERSION, '<' ) || version_compare( phpversion(), AMPLY_MINIMUM_PHP_VERSION, '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Optional: Load Jetpack compatibility, if plugin is active.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( 'inc/jetpack-compat.php' );
}

require get_parent_theme_file_path( 'inc/common-functions.php' );

require get_parent_theme_file_path( 'inc/sanitization-callbacks.php' );

require get_parent_theme_file_path( 'inc/template-tags.php' );

require get_parent_theme_file_path( 'inc/class-autoloader.php' );

$autoloader = new Autoloader(
	array(
		'directory'        => __DIR__,       // Directory of your project. It can be your theme or plugin. __DIR__ is probably your best bet.
		'namespace_prefix' => 'Amply', // Main namespace of your project. E.g My_Project\Admin\Tests should be My_Project. Probably if you just pass the constant __NAMESPACE__ it should work.
		'classes_dir'      => 'class',         // (optional). It is where your namespaced classes are located inside your project. If your classes are in the root level, leave this empty. If they are located on 'src' folder, write 'src' here.
	)
);
$autoloader->init();

Amply\Init::get_instance();
