<?php
/**
 * The template for displaying all pages
 *
 * @package amply
 */

get_header(); ?>

<div id="content-wrap" class="site-content-wrap">

	<?php do_action( 'amply_banner' ); ?>

	<div id="content" class="site-content">

		<?php do_action( 'amply_sidebar_left' ); ?>

		<?php do_action( 'amply_before_main' ); ?>

		<main id="main" class="site-main">

			<?php
			// Index loop.
			do_action( 'amply_page_loop' );
			?>

		</main><!-- #main -->

		<?php do_action( 'amply_after_main' ); ?>

		<?php do_action( 'amply_sidebar_right' ); ?>

	</div><!-- #content -->

	</div><!-- #content-wrap -->

<?php get_footer(); ?>
