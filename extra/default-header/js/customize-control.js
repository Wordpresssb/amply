/**
 * File default-header customizer-control.js.
 */

( function( $ ) {
	var api = wp.customize,
		defaultHeaderTypeTrigger;

  api.bind( 'ready', function() {

		/**
		 * Add outer trigger button for amply_default_header_outer_section.
		 */
		$( '#amply_default_header_type_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_outer_section' ).expanded.set( ! api.section( 'amply_default_header_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Add outer trigger button for amply_default_header_header1_elements_outer_section.
		 */
		$( '#amply_default_header_header1_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_header1_elements_outer_section' ).expanded.set( ! api.section( 'amply_default_header_header1_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Add outer trigger button for amply_default_header_header2_elements_outer_section.
		 */
		$( '#amply_default_header_header2_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_header2_elements_outer_section' ).expanded.set( ! api.section( 'amply_default_header_header2_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

  });

}( jQuery ) );
