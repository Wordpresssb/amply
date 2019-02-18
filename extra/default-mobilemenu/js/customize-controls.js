/**
 * File default-mobilemenu customize-control.js.
 */

( function( $ ) {
	var api = wp.customize;

  api.bind( 'ready', function() {

		/**
		 * Trigger amply_default_mobilemenu_outer_section.
		 */
		$( '#amply_default_mobilemenu_type_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_mobilemenu_outer_section' ).expanded.set( ! api.section( 'amply_default_mobilemenu_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Trigger amply_default_mobilemenu_mobilemenu1_elements_outer_section.
		 */
		$( '#amply_default_mobilemenu_mobilemenu1_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_mobilemenu_mobilemenu1_elements_outer_section' ).expanded.set( ! api.section( 'amply_default_mobilemenu_mobilemenu1_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Trigger amply_default_mobilemenu_mobilemenu2_elements_outer_section.
		 */
		$( '#amply_default_mobilemenu_mobilemenu2_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_mobilemenu_mobilemenu2_elements_outer_section' ).expanded.set( ! api.section( 'amply_default_mobilemenu_mobilemenu2_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

  });

}( jQuery ) );
