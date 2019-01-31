<?php
/**
 * Classic entry
 *
 * @package amply
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<?php get_template_part( 'views/site/post-title', get_post_type() ); ?>	

		<?php get_template_part( 'views/site/post-meta', get_post_type() ); ?>

		<?php get_template_part( 'views/site/post-thumbnail', get_post_type() ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'amply' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'amply' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php get_template_part( 'views/site/post-taxonomies', get_post_type() ); ?>

		<?php get_template_part( 'views/site/post-actions', get_post_type() ); ?>

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
