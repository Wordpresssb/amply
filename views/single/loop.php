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

endwhile;
