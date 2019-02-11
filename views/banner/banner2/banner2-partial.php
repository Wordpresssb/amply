<?php
/**
 * Banner 2
 *
 * @package amply
 */

$banner_name = get_query_var( 'amply_banner_var', '' );
$elements    = get_query_var( 'amply_banner_elements_var', '' );
?>

<?php wp_print_styles( array( 'amply-banner2' ) ); ?>

<section id="<?php echo esc_attr( $banner_name ); ?>" class="site-banner">

	<h1>Banner 2</h1>

	<div class="site-banner__elements">

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
