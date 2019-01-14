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
			css = css.split( primary + ';/*prim*/' ).join( to + ';/*prim*/' );
			style.html( css ).data( 'primary', to );

		});
	});

	// Secondary color.
	wp.customize( 'amply_secondary_color', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				secondary = style.data( 'secondary' ),
				css = style.html();

			// Equivalent to css.replaceAll. Add //secondary to be sure it is secondary color
			css = css.split( secondary + ';/*sec*/' ).join( to + ';/*sec*/' );
			style.html( css ).data( 'secondary', to );

		});
	});

})( jQuery );