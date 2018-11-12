<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package amply
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'amply' ) ); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', 'amply' ), 'WordPress' );
			?>
		</a>
		<span class="sep"> | </span>
		<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'amply' ), '<a href="' . esc_url( 'https://github.com/wprig/wprig/' ) . '">WP Rig</a>', 'the contributors' );
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>