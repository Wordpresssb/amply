<?php
/**
 * Mobile Menu cpt
 *
 * @package amply
 */

$mobilemenu_id = amply_option( 'amply_default_mobilemenu_mobilemenucpt_template' );

if ( ! empty( $mobilemenu_id ) && 'none' !== $mobilemenu_id ) {
	$mobilemenu_post_obj = get_post( $mobilemenu_id );
}
?>

<?php if ( amply_is_amp() ) { ?>

	<amp-sidebar id="amply-sidebar-amp" class="mobile-sidebar-amp"
		layout="nodisplay"
		side="left">

		<div class="menu-header">
			<button class="close-menu" on="tap:amply-sidebar-amp.close">
				<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
			</button>
		</div>

		<div id="post-<?php echo esc_attr( $mobilemenu_id ); ?>" class="entry">

			<div class="entry-content">

				<?php
				if ( 'none' !== $mobilemenu_id ) {

					if ( $mobilemenu_post_obj && ! is_wp_error( $mobilemenu_post_obj ) ) {

						global $post;

						// Set $post global variable to the right post object.
						$post = $mobilemenu_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

						// Set up "environment" for template tags.
						setup_postdata( $post );

						the_content();

						// point $post back to wherever it was pointing before we got involved.
						wp_reset_postdata();
					}
				}
				?>

			</div><!-- .entry-content -->

		</div><!-- #post-<?php echo esc_attr( $mobilemenu_id ); ?> -->

	</amp-sidebar>

<?php } else { ?>

	<div id="sidr-menu-container">

		<div class="menu-header">
			<button class="close-menu">
				<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
			</button>
		</div>

		<div id="post-<?php echo esc_attr( $mobilemenu_id ); ?>" class="entry">

			<div class="entry-content">

				<?php
				if ( 'none' !== $mobilemenu_id ) {

					if ( $mobilemenu_post_obj && ! is_wp_error( $mobilemenu_post_obj ) ) {

						global $post;

						// Set $post global variable to the right post object.
						$post = $mobilemenu_post_obj; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

						// Set up "environment" for template tags.
						setup_postdata( $post );

						the_content();

						// point $post back to wherever it was pointing before we got involved.
						wp_reset_postdata();
					}
				}
				?>

			</div><!-- .entry-content -->

		</div><!-- #post-<?php echo esc_attr( $mobilemenu_id ); ?> -->

	</div>

	<?php
}
