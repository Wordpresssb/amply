<?php
/**
 * Sidebar right CPT
 *
 * @package amply
 */

$sidebar_right_id      = get_query_var( 'amply_sidebar_right_id_var' );
$sidebar_right_content = '';

if ( 'none' === $sidebar_right_id ) {
	return;
}

if ( ! empty( $sidebar_right_id ) ) {

	$sidebar_right_obj = get_post( $sidebar_right_id );

	if ( $sidebar_right_obj && ! is_wp_error( $sidebar_right_obj ) ) {
		$sidebar_right_content = $sidebar_right_obj->post_content;
	}
}

?>

<aside id="sidebar-right" class="site-sidebar-right">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">

			<?php echo do_shortcode( $sidebar_right_content ); ?>

		</div><!-- .entry-content -->

	</div><!-- #post-<?php the_ID(); ?> -->

</aside>
