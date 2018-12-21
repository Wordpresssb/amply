<?php
/**
 * Classic entries loop
 *
 * @package amply
 */

/**
 * Include the component stylesheet for the classic entries.
 * This call runs only once on index page.
 * At some point, override functionality should be built in similar to the template part below.
 */
wp_print_styles( array( 'amply-classic-entries' ) ); // Note: If this was already done it will be skipped.

/* Start the Loop. */
while ( have_posts() ) :
	the_post();

	/**
	 * Include the Post-Type-specific template for the content.
	 */
	get_template_part( 'views/index/classic/entry', get_post_type() );

endwhile;
