<?php
/**
 * The left sidebar containing the left widget area
 *
 * @package amply
 */

?>

<?php wp_print_styles( array( 'amply-sidebar-left', 'amply-widgets' ) ); ?>

<aside id="sidebar-left" class="site-sidebar-left widget-area">

	<?php dynamic_sidebar( 'sidebar-left' ); ?>

</aside><!-- #sidebar-left -->
