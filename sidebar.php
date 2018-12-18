<?php
/**
 * The sidebar containing the main widget area
 *
 * @package amply
 */

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
?>

<?php wp_print_styles( array( 'amply-sidebar', 'amply-widgets' ) ); ?>

<aside id="secondary" class="site-sidebar-right widget-area">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</aside><!-- #secondary -->
