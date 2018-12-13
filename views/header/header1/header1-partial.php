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
		get_template_part( 'views/site/primary-nav' );
		?>

	</div>

</header>
