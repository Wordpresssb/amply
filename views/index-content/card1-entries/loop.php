<?php
/**
 * Classic entries loop
 *
 * @package amply
 */

/**
 * Include the component stylesheet for the card1 entries.
 * This call runs only once on index page.
 * At some point, override functionality should be built in similar to the template part below.
 */
wp_print_styles( array( 'amply-card1-entries' ) ); // Note: If this was already done it will be skipped.
?>

<div class="card1-entries">

	<?php
	/* Start the Loop. */
	while ( have_posts() ) :
		the_post();

		/**
		 * Include the Post-Type-specific template for the index-content.
		 */
		get_template_part( 'views/index-content/card1-entries/entry', get_post_type() );

	endwhile;
	?>

</div>

