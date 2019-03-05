<?php
/**
 * Header CPT
 *
 * @package amply
 */

$header_name = $this->vars['amply_header_var'];
$header_id   = $this->vars['amply_header_id_var'];

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

				global $post;

				// Set $post global variable to the right post object.
				$post = $header_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

				// Set up "environment" for template tags.
				setup_postdata( $post );

				the_content();

				// point $post back to wherever it was pointing before we got involved.
				wp_reset_postdata();
			}
			?>

		</div><!-- .entry-content -->

	</article><!-- #post-<?php echo esc_attr( $header_id ); ?> -->

</header>
