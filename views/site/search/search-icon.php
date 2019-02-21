<?php
/**
 * Search icon
 *
 * @package amply
 */

?>

<div id="search-icon" class="site-search-icon"
	<?php if ( amply_is_amp() ) : ?>
		on="tap:search-overlay-amp"
	<?php endif; ?>
>

	<?php
	echo amply_get_icon_svg( 'search' ); // wpcs: xss ok.
	?>

</div>
