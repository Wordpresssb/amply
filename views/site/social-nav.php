<?php
/**
 * Social navigation
 *
 * @package amply
 */

$social_args = array(
	'theme_location' => 'social',
	'menu_class'     => 'social-menu',
	'depth'          => 1,
	'container'      => false,
	'fallback_cb'    => false,
	'link_before'    => '<span class="screen-reader-text">',
	'link_after'     => '</span>' . amply_get_icon_svg( 'link' ),
);
?>

<nav class="site-social-nav" aria-label="<?php esc_attr_e( 'Social links menu', 'amply' ); ?>">

	<?php wp_nav_menu( $social_args ); ?>

</nav>
