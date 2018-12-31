<?php
/**
 * Single loop
 *
 * @package amply
 */

/**
 * Include the component stylesheet for the single posts.
 * This call runs only once on single page.
 */
wp_print_styles( array( 'amply-single-entry' ) ); // Note: If this was already done it will be skipped.

/* Start the Loop. */
while ( have_posts() ) :
	the_post();

	/**
	 * Include the Post-Type-specific template for the content.
	 */
	get_template_part( 'views/single/entry', get_post_type() );

	if ( is_singular( 'attachment' ) ) {
		// Parent post navigation.
		the_post_navigation(
			array(
				/* translators: %s: parent post link */
				'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'amply' ), '%title' ),
			)
		);
	} elseif ( is_singular( 'post' ) ) {
		// Previous/next post navigation.
		the_post_navigation(
			array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'amply' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'amply' ) . '</span> <br/>' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'amply' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'amply' ) . '</span> <br/>' .
					'<span class="post-title">%title</span>',
			)
		);
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

endwhile;
