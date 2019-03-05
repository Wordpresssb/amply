<?php
/**
 * Sidebar left CPT
 *
 * @package amply
 */

$sidebar_left_id = $this->vars['amply_sidebar_left_id_var'];

if ( 'none' === $sidebar_left_id ) {
	return;
}

if ( ! empty( $sidebar_left_id ) ) {
	$sidebar_left_obj = get_post( $sidebar_left_id );
}

?>

<aside id="sidebar-left" class="site-sidebar-left">

	<div id="post-<?php echo esc_attr( $sidebar_left_id ); ?>" class="entry">

		<div class="entry-content">

			<?php
			if ( $sidebar_left_obj && ! is_wp_error( $sidebar_left_obj ) ) {

				global $post;

				// Set $post global variable to the right post object.
				$post = $sidebar_left_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

				// Set up "environment" for template tags.
				setup_postdata( $post );

				the_content();

				// point $post back to wherever it was pointing before we got involved.
				wp_reset_postdata();

			}
			?>

		</div><!-- .entry-content -->

	</div><!-- #post-<?php echo esc_attr( $sidebar_left_id ); ?> -->

</aside>
