<?php
/**
 * Header 1
 *
 * @package amply
 */

$elements = amply_option( 'amply_default_header_header1_elements' );
?>

<?php wp_print_styles( array( 'amply-header1' ) ); ?>

<header id="header1" class="site-header">

	<div class="site-header__brand">

	<?php
		get_template_part( 'views/site/site-logo' );
	?>

	</div>

	<div class="site-header__collapse">

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
			endforeach;

		endif;
		?>

	</div>

	<?php
	get_template_part( 'views/site/mobile-menu-trigger' );
	?>

</header>
