/**
 * File single-footer customize-control.js.
 */

( function( $ ) {
	var api = wp.customize;

  api.bind( 'ready', function() {

		/**
		 * Trigger amply_single_footer_outer_section.
		 */
		$( '#amply_single_footer_type_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_single_footer_outer_section' ).expanded.set( ! api.section( 'amply_single_footer_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Trigger amply_single_footer_footer1_elements_outer_section.
		 */
		$( '#amply_single_footer_footer1_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_single_footer_footer1_elements_outer_section' ).expanded.set( ! api.section( 'amply_single_footer_footer1_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Trigger amply_single_footer_footer2_elements_outer_section.
		 */
		$( '#amply_single_footer_footer2_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_single_footer_footer2_elements_outer_section' ).expanded.set( ! api.section( 'amply_single_footer_footer2_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

  });

}( jQuery ) );
