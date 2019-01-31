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

<div id="content-wrap" class="site-content-wrap">

	<div class="site-banner">
		<h1 style="background:#cacaca;margin:0;min-height:200px;">Site banner</h1>
	</div>

	<div id="content" class="site-content">

		<?php do_action( 'amply_sidebar_left' ); ?>

		<?php do_action( 'amply_before_main' ); ?>

		<main id="main" class="site-main">

			<?php
			if ( have_posts() ) :

				// Index loop.
				do_action( 'amply_index_loop' );

				// Index navivation.
				if ( ! is_singular() ) :
					the_posts_navigation();
				endif;

			else :

				get_template_part( 'views/none/none' );

			endif;
			?>

		</main><!-- #main -->

		<?php do_action( 'amply_after_main' ); ?>

		<?php do_action( 'amply_sidebar_right' ); ?>

	</div><!-- #content -->

</div><!-- #content-wrap -->

<?php get_footer(); ?>
