<?php
/**
 * The right sidebar containing the right widget area
 *
 * @package amply
 */

?>

<?php wp_print_styles( array( 'amply-sidebar-right', 'amply-widgets' ) ); ?>

<aside id="sidebar-right" class="site-sidebar-right widget-area">

	<?php dynamic_sidebar( 'sidebar-right' ); ?>

</aside><!-- #sidebar-right -->
