<?php
/**
 * Primary navigation
 *
 * @package amply
 */

$primary_menu_args = array(
	'theme_location' => 'primary',
	'menu_class'     => 'primary-navigation',
	'container'      => 'ul',
	'echo'           => false,
	'fallback_cb'    => false,
);

$primary_menu = wp_nav_menu( $primary_menu_args );
?>

<nav class="site-primary-nav" role="navigation" aria-label="<?php esc_attr_e( 'Navigation menu', 'amply' ); ?>">

	<?php echo $primary_menu; // WPCS: XSS OK. ?>

</nav>
