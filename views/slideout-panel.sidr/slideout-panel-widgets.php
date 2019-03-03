<?php
/**
 * Slide out panel widgets
 *
 * @package amply
 */

?>

<?php if ( amply_is_amp() ) { ?>

<amp-sidebar id="amply-slideout-panel-amp" class="slideout-panel-amp"
	layout="nodisplay"
	side="right">

	<div  id="slideout-panel-toggle"
		<?php if ( amply_is_amp() ) : ?>
			on="tap:amply-slideout-panel-amp.toggle"
		<?php endif; ?>
	>

		<?php	echo amply_get_icon_svg( 'hamburger' ); // wpcs: xss ok. ?>

	</div>

	<div class="slideout-header">
		<button class="close-slideout" on="tap:amply-slideout-panel-amp.close">
			<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
		</button>
	</div>

	<?php dynamic_sidebar( 'slideout-panel' ); ?>

</amp-sidebar>

<?php } else { ?>

<div id="sidr-slideout-panel-container">

	<div class="slideout-header">
		<button class="close-slideout">
			<?php echo amply_get_icon_svg( 'cross' ); // WPCS: XSS OK. ?>
		</button>
	</div>

	<?php dynamic_sidebar( 'slideout-panel' ); ?>

</div>

	<?php
}
