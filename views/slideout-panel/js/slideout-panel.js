/**
 * Theme functions file.
 *
 * Contains handlers for slide-out panel.
 */

var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	initSlideoutPanel();
} );

// Init slideout panel
function initSlideoutPanel() {
	"use strict"

	// Close function
	var amply_close_slideout_panel = function() {
		$j( 'a.slideout-panel-btn' ).removeClass( 'opened' );
		$j( 'body' ).removeClass( 'sp-opened' );
	};

	// Open/Close panel
	$j( 'a.slideout-panel-btn, #slideout-panel-wrap a.close-panel, .sp-overlay' ).on( 'click', function( e ) {
		e.preventDefault();

		if ( ! $j( 'a.slideout-panel-btn' ).hasClass( 'opened' ) ) {

			// $j( '#slideout-panel-inner' ).css( { 'visibility': 'visible' } );
			$j( this ).addClass( 'opened' );
			$j( 'body' ).addClass( 'sp-opened' );

		} else {

			amply_close_slideout_panel();

		}

	} );

	// // Close when click on mobile button
	// $j( '#ocean-mobile-menu-icon a.mobile-menu' ).on( 'click', function() {
	// 	amply_close_slideout_panel();
	// } );

	// // Panel scrollbar
	// if ( ! navigator.userAgent.match( /(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/ ) ) {
	// 	$j( '#slideout-panel-inner' ).niceScroll( {
	// 		autohidemode		: false,
	// 		cursorborder		: 0,
	// 		cursorborderradius	: 0,
	// 		cursorcolor			: 'transparent',
	// 		cursorwidth			: 0,
	// 		horizrailenabled	: false,
	// 		mousescrollstep		: 40,
	// 		scrollspeed			: 60,
	// 		zindex				: 100005,
	// 	} );
	// }

}