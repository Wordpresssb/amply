<?php
/**
 * Sidr sidebar menu
 *
 * @package amply
 */

?>

<div id="sidr-menu-container">

	<div class="menu-header">
		<button class="close-menu">
			<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
		</button>
	</div>

	<?php
	$args = array(
		'theme_location' => 'mobile',
		'container'      => 'ul',
		'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
		'before'         => '<div class="link-wrap">',
		'after'          => '</div>',
		'fallback_cb'    => false,
	);

	wp_nav_menu( $args );
	?>

</div>
