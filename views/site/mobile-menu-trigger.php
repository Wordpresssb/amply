<?php
/**
 * Header 1
 *
 * @package amply
 */

?>

<div  id="mobile-toggle" class="mobile-menu-trigger"
	<?php if ( amply_is_amp() ) : ?>
		on="tap:amply-sidebar-amp.toggle"
	<?php endif; ?>
>

	<?php
	echo amply_get_icon_svg( 'hamburger' ); // wpcs: xss ok.
	?>

</div>
