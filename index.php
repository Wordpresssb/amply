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

		<?php
		if ( have_posts() ) :

			// Index loop.
			do_action( 'amply_index_loop' );

			// Index navivation.
			if ( ! is_singular() ) :
				the_posts_navigation();
			endif;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

	<?php do_action( 'amply_after_main' ); ?>

</div><!-- #content -->

<?php
get_footer();
