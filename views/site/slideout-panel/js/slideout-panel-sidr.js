/**
 * Theme functions file.
 *
 * Contains handlers for slide-out panel.
 */

var $j = jQuery.noConflict(),
	$window = $j( window );

$j( document ).on( 'ready', function() {
	'use strict';

	// Mobile menu.
	amplySlideout();
});

function amplySlideout() {

	$j( '#slideout-panel-toggle' ).sidr({
		name: 'slideout-panel-sidr',
		source: '#sidr-slideout-panel-container',
		displace: true,
		speed: 300,
		renaming: false,
		bind: 'click',

		onOpen: function onOpen() {

			// Add overlay to content
			$j( 'body' ).append( '<div class="sidr-overlay"></div>' );
			$j( '.sidr-overlay' ).fadeIn( 300 );

			// Close sidr when clicking overlay
			$j( '.sidr-overlay' ).on( 'click', function() {
				$j.sidr( 'close', 'slideout-panel-sidr' );
				return false;
			});

			// Close sidr when clicking close button.
			$j( '.close-slideout' ).on( 'click', function() {
				$j.sidr( 'close', 'slideout-panel-sidr' );
			});

		},

		onClose: function onClose() {

			// FadeOut overlay
			$j( '.sidr-overlay' ).fadeOut( 300, function() {
				$j( this ).remove();
			});

		}
	});

}

$j( window ).resize( function() {
	$j.sidr( 'close', 'slideout-panel-sidr' );
});
