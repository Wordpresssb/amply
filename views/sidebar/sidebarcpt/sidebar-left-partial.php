<?php
/**
 * Sidebar left CPT
 *
 * @package amply
 */

$sidebar_left_id      = get_query_var( 'amply_sidebar_left_id_var' );
$sidebar_left_content = '';

if ( 'none' === $sidebar_left_id ) {
	return;
}

if ( ! empty( $sidebar_left_id ) ) {

	$sidebar_left_obj = get_post( $sidebar_left_id );

	if ( $sidebar_left_obj && ! is_wp_error( $sidebar_left_obj ) ) {
		$sidebar_left_content = $sidebar_left_obj->post_content;
	}
}

?>

<aside id="sidebar-left" class="site-sidebar-left">

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content">

			<?php echo do_shortcode( $sidebar_left_content ); ?>

		</div><!-- .entry-content -->

	</div><!-- #post-<?php the_ID(); ?> -->

</aside>
