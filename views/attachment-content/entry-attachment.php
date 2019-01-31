<?php
/**
 * Template part for displaying a post of post type 'attachment'
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

		<figure class="entry-attachment wp-block-image">
			<?php
			/**
			 * Filter the default image attachment size.
			 *
			 * @param string $image_size Image size. Default 'full'.
			 */
			$image_size = apply_filters( 'amply_attachment_size', 'full' );

			echo wp_get_attachment_image( get_the_ID(), $image_size );
			?>

			<figcaption class="wp-caption-text"><?php the_excerpt(); ?></figcaption>

		</figure><!-- .entry-attachment -->
		<?php
		the_content();

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

<?php
if ( is_singular( get_post_type() ) ) {
	// Show attachment navigation only when the attachment has a parent.
	if ( ! empty( $post->post_parent ) ) {

		// TODO: There should be a WordPress core function for this, similar to `the_post_navigation()`.
		$attachment_navigation = '';

		ob_start();
		previous_image_link( false );
		$prev_link = ob_get_clean();
		if ( ! empty( $prev_link ) ) {
			$attachment_navigation .= '<div class="nav-previous">';
			$attachment_navigation .= '<div class="post-navigation-sub"><span>' . esc_html__( 'Previous:', 'amply' ) . '</span></div>';
			$attachment_navigation .= $prev_link;
			$attachment_navigation .= '</div>';
		}

		ob_start();
		next_image_link( false );
		$next_link = ob_get_clean();
		if ( ! empty( $next_link ) ) {
			$attachment_navigation .= '<div class="nav-next">';
			$attachment_navigation .= '<div class="post-navigation-sub"><span>' . esc_html__( 'Next:', 'amply' ) . '</span></div>';
			$attachment_navigation .= $next_link;
			$attachment_navigation .= '</div>';
		}

		if ( ! empty( $attachment_navigation ) ) {
			echo _navigation_markup( $attachment_navigation, $class = 'post-navigation', __( 'Post navigation', 'amply' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	// Show comments only when the post type supports it and when comments are open or at least one comment exists.
	if ( post_type_supports( get_post_type(), 'comments' ) && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}
?>
