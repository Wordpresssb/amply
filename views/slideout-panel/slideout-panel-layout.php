<?php
/**
 * Slideout panel cpt
 *
 * @package amply
 */

$close_text = amply_option( 'amply_default_slideout_panel_close_btn_text' );

$slideout_id = amply_option( 'amply_default_slideout_panel_content_template' );

if ( ! empty( $slideout_id ) && 'none' !== $slideout_id ) {
	$slideout_post_obj = get_post( $slideout_id );
}
?>

<?php
// phpcs:disable
/*
<!-- TEST -->

<a href="#" style="position:absolute;top:200px;left:100px;"
<?php if ( amply_is_amp() ) : ?>
	on="tap:AMP.setState({ bodyState: { myTest : ! bodyState.myTest } })"
<?php endif; ?>
>
	<?php	echo amply_get_icon_svg( 'hamburger', 24 ); // wpcs: xss ok. ?>
</a>

<!-- END TEST -->
*/
// phpcs:enable
?>

<div id="slideout-panel-wrap">

	<?php
	// If the opening button is beside the panel.
	if ( 'beside' === amply_option( 'amply_default_slideout_panel_open_btn_position' ) ) {
		?>

		<a href="#" class="slideout-panel-btn"
		<?php if ( amply_is_amp() ) : ?>
			on="tap:AMP.setState({ bodyState: { panelOpened : ! bodyState.panelOpened } })"
		<?php endif; ?>
		>
			<?php	echo amply_get_icon_svg( 'hamburger', 24 ); // wpcs: xss ok. ?>
		</a>

	<?php	} ?>

	<div id="slideout-panel-inner">

		<?php
		// If close button enabled.
		if ( false !== amply_option( 'amply_default_slideout_panel_close_btn_display' ) ) {
			?>
			<a href="#" class="close-panel"
			<?php if ( amply_is_amp() ) : ?>
				on="tap:AMP.setState({ bodyState: { panelOpened : ! bodyState.panelOpened } })"
			<?php endif; ?>
			>
				<?php	echo amply_get_icon_svg( 'cross', 24 ); // wpcs: xss ok. ?><span class="close-panel-text"><?php echo esc_attr( $close_text ); ?></span>
			</a>
		<?php	} ?>

		<div id="slideout-panel-content">

			<?php
			// If content type is template.
			if ( 'template' === amply_option( 'amply_default_slideout_panel_content_type' ) ) {
				?>

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

				<?php
				// Else display widgets.
			} else {

				dynamic_sidebar( 'slideout-panel' );

			}
			?>

		</div><!-- #slideout-panel-content -->

	</div><!-- #slideout-panel-inner -->

</div><!-- #slideout-panel-wrap -->
