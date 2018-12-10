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

	<?php
	get_template_part( 'views/site/site-logo' );
	?>

	<?php
	get_template_part( 'views/site/primary-nav' );
	?>

</header>




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
	endforeach;

endif;
