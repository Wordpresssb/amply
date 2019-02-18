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

				setup_postdata( $banner_post_obj );
				the_content();
				wp_reset_postdata();
			}
			?>

		</div><!-- .entry-content -->

	</article><!-- #post-<?php echo esc_attr( $banner_id ); ?> -->

</section>
