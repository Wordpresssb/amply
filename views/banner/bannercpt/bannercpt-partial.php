<?php
/**
 * Banner CPT
 *
 * @package amply
 */

$banner_name = get_query_var( 'amply_banner_var', '' );

$banner_id = get_query_var( 'amply_banner_id_var', '' );

if ( 'none' === $banner_id ) {
	return;
}

if ( ! empty( $banner_id ) ) {
	$banner_post_obj = get_post( $banner_id );
}
?>

<?php wp_print_styles( array( 'amply-bannercpt' ) ); ?>

<section id="<?php echo esc_attr( $banner_name ); ?>" class="site-banner">

	<article id="post-<?php echo esc_attr( $banner_id ); ?>" class="entry">

		<div class="entry-content">

			<?php
			if ( $banner_post_obj && ! is_wp_error( $banner_post_obj ) ) {

				global $post;

				// Set $post global variable to the right post object.
				$post = $banner_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

				// Set up "environment" for template tags.
				setup_postdata( $post );

				the_content();

				// point $post back to wherever it was pointing before we got involved.
				wp_reset_postdata();
			}
			?>

		</div><!-- .entry-content -->

	</article><!-- #post-<?php echo esc_attr( $banner_id ); ?> -->

</section>
