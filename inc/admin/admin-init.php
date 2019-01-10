<?php
/**
 * Admin initialization
 *
 * @package amply
 */

// Include Kirki.
require_once dirname( __FILE__ ) . '/kirki/kirki.php';
require_once dirname( __FILE__ ) . '/kirki-config.php';

// Customizer.
require_once get_parent_theme_file_path( 'inc/admin/customizer/customizer-config.php' );
require_once get_parent_theme_file_path( 'inc/admin/customizer/general-panel-options.php' );
require_once get_parent_theme_file_path( 'inc/admin/customizer/core-options.php' );
require_once get_parent_theme_file_path( 'inc/admin/customizer/images-options.php' );
