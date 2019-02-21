var $j = jQuery.noConflict();

$j( document ).on( 'ready', function() {
	"use strict";
	// Search overlay
	amplyOverlaySearch();
} );

/* ==============================================
OVERLAY SEARCH
============================================== */
function amplyOverlaySearch() {
	"use strict"

	var $searchOverlayToggle 	= $j( '#search-icon' ),
			$searchOverlay 				= $j( '#search-overlay' ),
			$searchOverlayClose 	= $j( '.search-overlay-content__close' );

	if ( $searchOverlayToggle.length ) {

		$searchOverlayToggle.on( 'click', function( e ) {
			e.preventDefault();

			$searchOverlay.addClass( 'active' );
			$searchOverlay.fadeIn( 200 );

      setTimeout( function() {
				$j( 'html' ).css( 'overflow', 'hidden' );
      }, 400);

		} );

	}

	$searchOverlayClose.on( 'click', function( e ) {
		e.preventDefault();

		$searchOverlay.removeClass( 'active' );
		$searchOverlay.fadeOut( 200 );

    setTimeout( function() {
			$j( 'html' ).css( 'overflow', 'visible' );
    }, 400);

	} );

	$searchOverlayToggle.on( 'click', function() {
		$j( '#search-overlay input' ).focus();
	} );

}