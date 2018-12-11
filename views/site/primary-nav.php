<?php
/**
 * Primary navigation
 *
 * @package amply
 */

$args = array(
	'theme_location' => 'primary',
	'menu_class'     => 'primary-menu',
	'items_wrap'     => '<ul id="%1$s" class="%2$s" tabindex="0">%3$s</ul>',
	// 'container'      => false,
	'fallback_cb'    => false,
);
?>

<nav class="site-primary-nav" role="navigation" aria-label="<?php esc_attr_e( 'Navigation menu', 'amply' ); ?>">

	<?php wp_nav_menu( $args ); ?>

</nav>
