<?php
/**
 * Classic entry
 *
 * @package amply
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-featured">
		<?php amply_post_thumbnail(); ?>
	</div>

	<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
					amply_posted_on();
					amply_posted_by();
					amply_comments_link();
				?>
			</div><!-- .entry-meta -->
			<?php
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<p>
			<?php
			// Display custom excerpt.
			echo esc_html( amply_excerpt() );
			?>
		</p>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
		amply_post_categories();
		amply_post_tags();
		amply_edit_post_link();
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

