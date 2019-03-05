<?php
/**
 * Footer 1
 *
 * @package amply
 */

$footer_name = $this->vars['amply_footer_var'];
$elements    = $this->vars['amply_footer_elements_var'];
?>

<?php wp_print_styles( array( 'amply-footer1' ) ); ?>

<section id="<?php echo esc_attr( $footer_name ); ?>" class="site-footer">

	<h1>Footer 1</h1>

	<div class="site-footer__elements">

		<?php
		if ( $elements ) :

			// Loop through elements.
			foreach ( $elements as $element ) :
				?>

				<?php
				// Primary navigation.
				if ( 'primary-nav' === $element ) {
					get_template_part( 'views/site/primary-nav' );
				}
				?>

				<?php
				// Social navigation.
				if ( 'social-nav' === $element ) {
					get_template_part( 'views/site/social-nav' );
				}
				?>

				<?php
				// Search form.
				if ( 'search-form' === $element ) {
					get_template_part( 'views/site/search-form' );
				}
				?>

				<?php
				// Mobile menu trigger.
				if ( 'mobile-menu-trigger' === $element ) {
					get_template_part( 'views/site/mobile-menu-trigger' );
				}
				?>

				<?php
			endforeach;

		endif;
		?>

	</div>

</section>
