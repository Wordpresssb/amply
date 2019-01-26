<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package amply
 */

get_header(); ?>

<div id="content-wrap" class="site-content-wrap">

	<div class="site-banner">
		<h1 style="background:#cacaca;margin:0;min-height:200px;">Site banner</h1>
	</div>

	<div id="content" class="site-content">

		<?php do_action( 'amply_before_main' ); ?>

		<main id="main" class="site-main">

			<?php
			// Index loop.
			do_action( 'amply_single_loop' );
			?>

		</main><!-- #main -->

		<?php do_action( 'amply_after_main' ); ?>

		<?php get_sidebar(); ?>

	</div><!-- #content -->

	</div><!-- #content-wrap -->

<?php get_footer(); ?>
