<?php
/**
 * Header CPT
 *
 * @package amply
 */

$header_name = get_query_var( 'amply_header_var', '' );

$header_id      = get_query_var( 'amply_header_id_var', '' );
$header_content = '';

if ( 'none' === $header_id ) {
	return;
}

if ( ! empty( $header_id ) ) {
	$header_post_obj = get_post( $header_id );
}
?>

<?php wp_print_styles( array( 'amply-headercpt' ) ); ?>

<header id="<?php echo esc_attr( $header_name ); ?>" class="site-header">

	<article id="post-<?php echo esc_attr( $header_id ); ?>" class="entry">

		<div class="entry-content">

			<?php
			if ( $header_post_obj && ! is_wp_error( $header_post_obj ) ) {

				setup_postdata( $header_post_obj );
				the_content();
				wp_reset_postdata();

				// // Other way => widget block don'work.
				// echo do_shortcode( $header_post_obj->post_content );
			}
			?>

		</div><!-- .entry-content -->

	</article><!-- #post-<?php echo esc_attr( $header_id ); ?> -->

</header>
