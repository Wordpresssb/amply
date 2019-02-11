<?php
/**
 * Footer CPT
 *
 * @package amply
 */

$footer_name = get_query_var( 'amply_footer_var', '' );

$footer_id      = get_query_var( 'amply_footer_id_var', '' );
$footer_content = '';

if ( 'none' === $footer_id ) {
	return;
}

if ( ! empty( $footer_id ) ) {
	$footer_post_obj = get_post( $footer_id );
}
?>

<?php wp_print_styles( array( 'amply-footercpt' ) ); ?>

<section id="<?php echo esc_attr( $footer_name ); ?>" class="site-footer">

	<article id="post-<?php echo esc_attr( $footer_id ); ?>" class="entry">

		<div class="entry-content">

			<?php
			if ( $footer_post_obj && ! is_wp_error( $footer_post_obj ) ) {

				setup_postdata( $footer_post_obj );
				the_content();
				wp_reset_postdata();
			}
			?>

		</div><!-- .entry-content -->

	</article><!-- #post-<?php echo esc_attr( $footer_name ); ?> -->

</section>
