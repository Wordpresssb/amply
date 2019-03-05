<?php
/**
 * Footer CPT
 *
 * @package amply
 */

$footer_name = $this->vars['amply_footer_var'];
$footer_id   = $this->vars['amply_footer_id_var'];

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

				global $post;

				// Set $post global variable to the right post object.
				$post = $footer_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

				// Set up "environment" for template tags.
				setup_postdata( $post );

				the_content();

				// point $post back to wherever it was pointing before we got involved.
				wp_reset_postdata();
			}
			?>

		</div><!-- .entry-content -->

	</article><!-- #post-<?php echo esc_attr( $footer_id ); ?> -->

</section>
