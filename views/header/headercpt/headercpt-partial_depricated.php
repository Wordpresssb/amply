<?php
/**
 * Header CPT
 *
 * @package amply
 */

$query_var = get_query_var( 'amply_header_var' );

$elements = get_query_var( 'amply_header_elements_var' );
?>

<?php wp_print_styles( array( 'amply-headercpt' ) ); ?>

<?php
$query_args = array(
	'post_type' => 'amply_header_cpt',
);

$query = new WP_query( $query_args );

if ( $query->have_posts() ) :

	/* Start the Loop. */
	while ( $query->have_posts() ) :
		$query->the_post();
		?>

		<header id="post-<?php the_ID(); ?>" <?php post_class( 'site-header' ); ?>>

			<div class="entry-content">
					<?php the_content(); ?>
			</div><!-- .entry-content -->

		</header>

	<?php	endwhile; ?>

	<?php
	/* Reset the query */
	rewind_posts();

endif;
