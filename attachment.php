<?php
/**
 * The template for displaying attachments and their metadata.
 *
 * Attachments are a special post type that holds information
 * about a file uploaded through the WordPress media upload system.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/attachment-template-files/
 *
 * @package amply
 */

get_header();
?>

<div id="content-wrap" class="site-content-wrap">

	<div class="site-banner">
		<h1 style="background:#cacaca;margin:0;min-height:200px;">Site banner</h1>
	</div>

	<div id="content" class="site-content">

		<?php do_action( 'amply_before_main' ); ?>

		<main id="main" class="site-main">

			<?php
			wp_print_styles( array( 'amply-attachement-entry' ) );

			while ( have_posts() ) {
				the_post();

				get_template_part( 'views/attachment-content/entry-attachment' );
			}
			?>

		</main><!-- #main -->

		<?php do_action( 'amply_after_main' ); ?>

		<?php get_sidebar(); ?>

	</div><!-- #content -->

</div><!-- #content-wrap -->

<?php get_footer(); ?>
