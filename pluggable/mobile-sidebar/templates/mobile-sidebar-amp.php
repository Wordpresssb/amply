<?php
/**
 * Amp-sidebar
 *
 * @package amply
 */

?>

<amp-sidebar id="amply-sidebar-amp" class="mobile-sidebar-amp"
	layout="nodisplay"
	side="left">

	<div class="menu-header">
		<button class="close-menu" on="tap:amply-sidebar-amp.close">
			<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
		</button>
	</div>

	<?php
	$args = array(
		'theme_location' => 'mobile',
		'container'      => 'ul',
		'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		'before'         => '<header>',
		'after'          => '</header>',
		'fallback_cb'    => false,
		'walker'         => new Walker_Amp_Nav_Menu(),
	);

	wp_nav_menu( $args );
	?>

</amp-sidebar>
