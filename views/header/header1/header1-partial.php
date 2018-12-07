<?php
/**
 * Header 1
 *
 * @package wprig
 */

?>

<h1>HEADER 1</h1>

<?php amply_logo(); ?>

<br>

<?php
$my_query_var = get_query_var( 'amply_header_var' );
if ( $my_query_var ) {
	var_dump( $my_query_var );
}
?>

<br>

<?php
wp_nav_menu(
	array(
		'theme_location' => 'social',
		'menu_class'     => 'social-links-menu',
		'depth'          => 1,
		'fallback_cb'    => false,
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>' . amply_get_svg( array( 'icon' => 'chain' ) ),
	)
);
