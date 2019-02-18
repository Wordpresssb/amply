<?php
/**
 * Menu sidebar
 *
 * Description: Add a slide out panel triggered by element with id="mobile-toggle".
 * Amp ready: on="tap:amply-sidebar-amp.toggle".
 *
 * @package amply
 */

/**
 * Add custom wp_nav_menu walker class if amp.
 */
require get_template_directory() . '/pluggable/mobile-sidebar/walker/class-walker-amp-nav-menu.php';

/**
 * Enqueue menu sidebar styles.
 */
function amply_menu_sidebar_styles() {

	if ( amply_is_amp() ) {
		wp_enqueue_style( 'amply-mobile-sidebar-amp', get_theme_file_uri( 'pluggable/mobile-sidebar/css/mobile-sidebar-amp.css' ), array(), '20180514' );
	} else {
		wp_enqueue_style( 'amply-sidr', get_theme_file_uri( 'pluggable/mobile-sidebar/css/sidr.css' ), array(), '20180514' );
		wp_enqueue_style( 'amply-mobile-sidebar-sidr', get_theme_file_uri( 'pluggable/mobile-sidebar/css/mobile-sidebar-sidr.css' ), array(), '20180514' );
	}
}
add_action( 'wp_enqueue_scripts', 'amply_menu_sidebar_styles' );

/**
 * Enqueue menu sidebar scripts.
 */
function amply_menu_sidebar_scripts() {

	// If the AMP plugin is active, return early.
	if ( amply_is_amp() ) {
		return;
	}

	// Enqueue sidr script.
	wp_enqueue_script( 'amply-sidr', get_theme_file_uri( 'pluggable/mobile-sidebar/js/jquery.sidr.min.js' ), array( 'jquery' ), '20180514', false );
	wp_script_add_data( 'amply-sidr', 'defer', true );

	// Enqueue sidr menu script.
	wp_enqueue_script( 'amply-mobile-sidebar-sidr', get_theme_file_uri( 'pluggable/mobile-sidebar/js/mobile-sidebar-sidr.js' ), array( 'jquery' ), '20180514', false );
	wp_script_add_data( 'amply-mobile-sidebar-sidr', 'defer', true );

}
add_action( 'wp_enqueue_scripts', 'amply_menu_sidebar_scripts' );

/**
 * Add either amp or sidr menu sidebar templates.
 * To do : Remove it to hook directly from modules chosen in the customizer. Each modules will hook to amply_after_page and templates will deal with amp and non amp.
 *         This file is here to enqueue css and scripts for mobile sidebar.
 */
function amply_menu_sidebar_templates() {

	// Path.
	$path = 'pluggable/mobile-sidebar/templates/';

	if ( amply_is_amp() ) {

		get_template_part( $path . 'mobile-sidebar-amp' );

	} else {

		get_template_part( $path . 'mobile-sidebar-sidr' );

	}

}
add_action( 'amply_after_page', 'amply_menu_sidebar_templates' );
