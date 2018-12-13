<?php
/**
 * Header 2
 *
 * @package wprig
 */

$elements = amply_option( 'amply_default_header_header2_elements' );
?>

<h1>HEADER 2</h1>

<?php
if ( $elements ) :

	// Loop through elements.
	foreach ( $elements as $element ) :
		?>

		<?php
		// Site-logo.
		if ( 'site-logo' === $element ) {
			get_template_part( 'views/site/site-logo' );
		}
		?>

		<?php
		// Social navigation.
		if ( 'social-nav' === $element ) {
			get_template_part( 'views/site/social-nav' );
		}
		?>

		<?php
		// Primary navigation.
		if ( 'primary-nav' === $element ) {
			get_template_part( 'views/site/primary-nav' );
		}
		?>

		<?php
		// Mobile menu trigger.
		if ( 'mobile-menu-trigger' === $element ) {
			get_template_part( 'views/site/mobile-menu-trigger' );
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
