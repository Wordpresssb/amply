<?php
/**
 * Header 2
 *
 * @package amply
 */

$elements = amply_option( 'amply_default_header_header2_elements' );

$query_var = get_query_var( 'amply_default_header_var' );
?>

<?php wp_print_styles( array( 'amply-header2' ) ); ?>

<header id="<?php echo esc_attr( $query_var ); ?>" class="site-header">

	<div class="site-header__trigger">

		<?php get_template_part( 'views/site/mobile-menu-trigger' ); ?>

	</div>

	<div class="site-header__elements">

		<?php
		if ( $elements ) :

			// Loop through elements.
			foreach ( $elements as $element ) :
				?>

				<?php
				// Logo.
				if ( 'site-logo' === $element ) {
					get_template_part( 'views/site/site-logo' );
				}
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

</header>


