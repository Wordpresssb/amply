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

	<?php do_action( 'amply_banner' ); ?>

	<div id="content" class="site-content">

		<?php do_action( 'amply_sidebar_left' ); ?>

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

		<?php do_action( 'amply_sidebar_right' ); ?>

	</div><!-- #content -->

</div><!-- #content-wrap -->

<?php get_footer(); ?>
