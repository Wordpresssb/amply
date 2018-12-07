/**
 * File default-header customizer-control.js.
 */

( function( $ ) {
	var api = wp.customize,
		defaultHeaderTypeTrigger;

  api.bind( 'ready', function() {

		/**
		 * Add outer trigger button control to header section.
		 */
		$( '#amply_default_header_type_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_outer_section' ).expanded.set( ! api.section( 'amply_default_header_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

  });

}( jQuery ) );
