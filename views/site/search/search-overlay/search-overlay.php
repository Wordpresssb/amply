<?php
/**
 * Search overlay
 *
 * @package amply
 */

?>

<div id="search-overlay">

	<div class="search-overlay-content">

		<a href="#" class="search-overlay-content__close" role="button" tabindex="0"><?php echo amply_get_icon_svg( 'cross' ); // wpcs: xss ok. ?></a>

		<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-overlay-content__form">
			<input class="search-overlay-content__input" type="search" name="s" autocomplete="off" value="" />
		</form>

	</div>

</div>
