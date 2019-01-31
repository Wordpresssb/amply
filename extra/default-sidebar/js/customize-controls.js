/**
 * File default-sidebar customize-control.js.
 */

( function( $ ) {
	var api = wp.customize;

  api.bind( 'ready', function() {

		/**
		 * Trigger amply_default_sidebar_outer_section.
		 */
		$( '#amply_default_sidebar_type_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_sidebar_outer_section' ).expanded.set( ! api.section( 'amply_default_sidebar_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

  });

}( jQuery ) );
