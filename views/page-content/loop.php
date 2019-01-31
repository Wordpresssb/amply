<?php
/**
 * Page loop
 *
 * @package amply
 */

/**
 * Include the component stylesheet for pages.
 * This call runs only once on pages.
 */
wp_print_styles( array( 'amply-page-entry' ) ); // Note: If this was already done it will be skipped.

/* Start the Loop. */
while ( have_posts() ) :
	the_post();

	/**
	 * Include the template for the content.
	 */
	get_template_part( 'views/page-content/entry' );

endwhile;
