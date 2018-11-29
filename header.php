<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package amply
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php if ( ! amply_is_amp() ) : ?>
		<script>document.documentElement.classList.remove("no-js");</script>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'amply' ); ?></a>

	<?php do_action( 'amply_header' ); ?>






<?php
/**
 * Tests
 */
if ( is_front_page() ) :
	?>

<h1>TESTS</h1>

<div id="primary-dark" style="height:100px;"></div>
<div id="primary" style="height:200px;text-align:right;padding:100px;">
	<span id="btn" style="font-size: 30px;padding: 15px 20px;border-style: solid;border-width: 3px;;border-radius: 50px;">+</span>
</div>
<div id="primary-light" style="height:100px;"></div>

<?php endif ?>
