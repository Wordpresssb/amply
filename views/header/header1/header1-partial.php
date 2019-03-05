<?php
/**
 * Header 1
 *
 * @package amply
 */

$header_name = $this->vars['amply_header_var'];
$elements    = $this->vars['amply_header_elements_var'];
?>

<?php wp_print_styles( array( 'amply-header1' ) ); ?>

<header id="<?php echo esc_attr( $header_name ); ?>" class="site-header">

	<div class="site-header__brand">

		<?php get_template_part( 'views/site/site-logo' ); ?>

	</div>

	<div class="site-header__elements">

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
				// Search toggle.
				if ( 'search-toggle' === $element ) {
					do_action( 'amply_search_toggle' );
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

</header>
