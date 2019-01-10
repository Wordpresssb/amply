/**
 * File color-customize-preview.js.
 */

(function( $ ) {

	// Primary color.
	wp.customize( 'amply_primary_color', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				primary = style.data( 'primary' ),
				css = style.html();

			// Equivalent to css.replaceAll. Add //primary to be sure it is primary color
			css = css.split( primary + ';//primary' ).join( to + ';//primary' );
			style.html( css ).data( 'primary', to );

		});
	});

})( jQuery );