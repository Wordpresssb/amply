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

	wp_enqueue_style( 'amply-customizer-style', AMPLY_THEME_URI . 'assets/css/admin/customizer-style.css', null, AMPLY_THEME_VERSION );

}
add_action( 'customize_controls_print_styles', 'amply_customizer_style' );
