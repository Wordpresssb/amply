<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package amply
 */

get_header(); ?>

<div id="content" class="site-content">

	<?php do_action( 'amply_before_main' ); ?>

	<main id="main" class="site-main">

		<?php do_action( 'amply_main' ); ?>

	</main><!-- #main -->

	<?php do_action( 'amply_after_main' ); ?>

</div><!-- #content -->

<?php
get_footer();
