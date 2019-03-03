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

<body <?php body_class(); ?><?php amply_body_attr(); ?>
	<?php if ( amply_is_amp() ) : ?>
		[class]="bodyState.bodyClasses.concat( bodyState.panelOpened ? 'sp-opened' : '' ).concat( bodyState.myTest ? 'test' : '' )"
	<?php endif; ?>
>

<?php if ( amply_is_amp() ) : ?>
	<amp-state id="bodyState">
		<?php
		$state = [
			'bodyClasses' => get_body_class(),
			'panelOpened' => false,
			'myTest'      => false,
		]
		?>
		<script type="application/json"><?php echo wp_json_encode( $state ); ?></script>
	</amp-state>
<?php endif; ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'amply' ); ?></a>

	<?php do_action( 'amply_header' ); ?>
