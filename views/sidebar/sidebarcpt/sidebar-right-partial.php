<?php
/**
 * Sidebar right CPT
 *
 * @package amply
 */

$sidebar_right_id = get_query_var( 'amply_sidebar_right_id_var', '' );

if ( 'none' === $sidebar_right_id ) {
	return;
}

if ( ! empty( $sidebar_right_id ) ) {
	$sidebar_right_obj = get_post( $sidebar_right_id );
}

?>

<aside id="sidebar-right" class="site-sidebar-right">

	<div id="post-<?php echo esc_attr( $sidebar_right_id ); ?>" class="entry">

		<div class="entry-content">

			<?php
			if ( $sidebar_right_obj && ! is_wp_error( $sidebar_right_obj ) ) {

				setup_postdata( $sidebar_right_obj );
				the_content();
				wp_reset_postdata();

			}
			?>

		</div><!-- .entry-content -->

	</div><!-- #post-<?php echo esc_attr( $sidebar_right_id ); ?> -->

</aside>
