<?php
/**
 * Slideout panel cpt
 *
 * @package amply
 */

$slideout_id = amply_option( 'amply_default_slideout_panel_content_template' );

if ( ! empty( $slideout_id ) && 'none' !== $slideout_id ) {
	$slideout_post_obj = get_post( $slideout_id );
}
?>

<?php if ( amply_is_amp() ) { ?>

	<amp-sidebar id="amply-slideout-panel-amp" class="slideout-panel-amp"
		layout="nodisplay"
		side="right">

		<div class="slideout-header">
			<button class="close-slideout" on="tap:amply-slideout-panel-amp.close">
				<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
			</button>
		</div>

		<div id="post-<?php echo esc_attr( $slideout_id ); ?>" class="entry">

			<div class="entry-content">

				<?php
				if ( 'none' !== $slideout_id ) {

					if ( $slideout_post_obj && ! is_wp_error( $slideout_post_obj ) ) {

						global $post;

						// Set $post global variable to the right post object.
						$post = $slideout_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

						// Set up "environment" for template tags.
						setup_postdata( $post );

						the_content();

						// point $post back to wherever it was pointing before we got involved.
						wp_reset_postdata();
					}
				}
				?>

			</div><!-- .entry-content -->

		</div><!-- #post-<?php echo esc_attr( $slideout_id ); ?> -->

	</amp-sidebar>

<?php } else { ?>

	<div id="sidr-slideout-panel-container">

		<div class="slideout-header">
			<button class="close-slideout">
				<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
			</button>
		</div>

		<div id="post-<?php echo esc_attr( $slideout_id ); ?>" class="entry">

			<div class="entry-content">

				<?php
				if ( 'none' !== $slideout_id ) {

					if ( $slideout_post_obj && ! is_wp_error( $slideout_post_obj ) ) {

						global $post;

						// Set $post global variable to the right post object.
						$post = $slideout_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

						// Set up "environment" for template tags.
						setup_postdata( $post );

						the_content();

						// point $post back to wherever it was pointing before we got involved.
						wp_reset_postdata();
					}
				}
				?>

			</div><!-- .entry-content -->

		</div><!-- #post-<?php echo esc_attr( $slideout_id ); ?> -->

	</div>

	<?php
}
