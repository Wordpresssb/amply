<?php
/**
 * Search overlay
 *
 * @package amply
 */

?>

<amp-lightbox id="search-overlay-amp" layout="nodisplay">

	<div class="search-overlay-content">

		<a href="#" class="search-overlay-content__close" role="button" tabindex="0" on="tap:search-overlay-amp.close">
			<?php echo amply_get_icon_svg( 'cross' ); // wpcs: xss ok. ?>
		</a>

		<h1>Hello World!</h1>

	</div>

</amp-lightbox>
