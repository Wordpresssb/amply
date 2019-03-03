<?php
/**
 * Slide out panel trigger
 *
 * @package amply
 */

?>

<div  id="slideout-panel-toggle"
	<?php if ( amply_is_amp() ) : ?>
		on="tap:amply-slideout-panel-amp.toggle"
	<?php endif; ?>
>

	<?php	echo amply_get_icon_svg( 'hamburger' ); // wpcs: xss ok. ?>

</div>
