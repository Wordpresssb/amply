<?php
/**
 * Template part for displaying a post's taxonomy terms
 *
 * @package amply
 */

$taxonomies = wp_list_filter(
	get_object_taxonomies( $post, 'objects' ),
	array(
		'public' => true,
	)
);

?>

<div class="entry-taxonomies">
	<?php
	// Show terms for all taxonomies associated with the post.
	foreach ( $taxonomies as $taxonomy ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

		/* translators: separator between taxonomy terms */
		$separator = _x( ', ', 'list item separator', 'amply' );

		switch ( $taxonomy->name ) {
			case 'category':
				$class = 'category-links term-links';
				$list  = get_the_category_list( esc_html( $separator ), '', $post->ID );
				break;
			case 'post_tag':
				$class = 'tag-links term-links';
				$list  = get_the_tag_list( '', esc_html( $separator ), '', $post->ID );
				break;
			default:
				$class = str_replace( '_', '-', $taxonomy->name ) . '-links term-links';
				$list  = get_the_term_list( $post->ID, $taxonomy->name, '', esc_html( $separator ), '' );
		}

		if ( empty( $list ) ) {
			continue;
		}

		if ( $taxonomy->hierarchical ) {
			/* translators: %s: list of taxonomy terms */
			$placeholder_text = __( 'Posted in %s', 'amply' );
		} else {
			/* translators: %s: list of taxonomy terms */
			$placeholder_text = __( 'Tagged %s', 'amply' );
		}

		?>
		<span class="<?php echo esc_attr( $class ); ?>">
			<?php
			printf(
				esc_html( $placeholder_text ),
				$list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
			?>
		</span>
		<?php
	}
	?>
</div><!-- .entry-taxonomies -->
