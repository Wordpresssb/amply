<?php
/**
 * Social navigation
 *
 * @package amply
 */

?>

<?php
wp_nav_menu(
	array(
		'theme_location' => 'social',
		'menu_class'     => 'social-navigation',
		'depth'          => 1,
		'fallback_cb'    => false,
		'link_before'    => '<span class="screen-reader-text">',
		'link_after'     => '</span>' . amply_get_icon_svg( 'link' ),
	)
);
