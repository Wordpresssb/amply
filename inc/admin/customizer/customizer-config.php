<?php
/**
 * Customizer config
 *
 * @package amply
 */

/**
 * Enqueue customizer custom style
 */
function amply_customizer_style() {

	wp_enqueue_style( 'amply-customizer-controls-css', AMPLY_THEME_URI . 'dist/css/customize-controls.css', null, AMPLY_THEME_VERSION );

}
add_action( 'customize_controls_print_styles', 'amply_customizer_style' );

/**
 * Enqueue customizer pane custom js
 */
function amply_customizer_js() {

	wp_enqueue_script( 'amply-customizer-controls-js', AMPLY_THEME_URI . 'dist/js/customize-controls.js', array( 'customize-controls', 'jquery' ), AMPLY_THEME_VERSION, true );

}
add_action( 'customize_controls_enqueue_scripts', 'amply_customizer_js' );
