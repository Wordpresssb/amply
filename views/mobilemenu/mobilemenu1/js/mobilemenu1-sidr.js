/* global amplyScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for side menu.
 */

var $j = jQuery.noConflict(),
	$window = $j( window );

$j( document ).on( 'ready', function() {
	'use strict';

	// Mobile menu.
	amplySidebar();
});

function amplySidebar() {

	$j( '#mobile-toggle' ).sidr({
		name: 'mobile-sidebar-sidr',
		source: '#sidr-menu-container',
		displace: false,
		speed: 300,
		renaming: false,
		bind: 'click',

		onOpen: function onOpen() {

			// Vars.
			var container = $j( '.sidr' ),
					dropdownToggle;

			// Add overlay to content
			$j( 'body' ).append( '<div class="sidr-overlay"></div>' );
			$j( '.sidr-overlay' ).fadeIn( 300 );

			// Close sidr when clicking overlay
			$j( '.sidr-overlay' ).on( 'click', function() {
				$j.sidr( 'close', 'mobile-sidebar-sidr' );
				return false;
			});

			// Close sidr when clicking close button.
			$j( '.close-menu' ).on( 'click', function() {
				$j.sidr( 'close', 'mobile-sidebar-sidr' );
			});

			// Add dropdown toggle that displays child menu items.
			dropdownToggle = $j( '<span />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			.append( '+' );

			container.find( '.menu-item-has-children > .link-wrap > a' ).after( dropdownToggle );

			// Add toggle click event
			container.find( '.dropdown-toggle' ).click( function( e ) {
				var _this = $j( this );

				e.preventDefault();
				_this.parent().next( '.sub-menu' ).toggleClass( 'toggled-on' );
				_this.attr( 'aria-expanded', 'false' === _this.attr( 'aria-expanded' ) ? 'true' : 'false' );
				_this.text( '+' === _this.text() ? '–' : '+' );
			});

		},

		onClose: function onClose() {

			//Remove dropdown toggle that displays child menu items.
			$j( '.dropdown-toggle' ).remove();

			// Remove toggle-on class from sub-menu.
			$j( '.sub-menu.toggled-on' ).removeClass( 'toggled-on' );

			// FadeOut overlay
			$j( '.sidr-overlay' ).fadeOut( 300, function() {
				$j( this ).remove();
			});

		}
	});

}

$j( window ).resize( function() {
	$j.sidr( 'close', 'mobile-sidebar-sidr' );
});
