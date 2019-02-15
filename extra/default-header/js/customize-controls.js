/**
 * File default-header customize-control.js.
 */

( function( $ ) {
	var api = wp.customize;

  api.bind( 'ready', function() {

		/**
		 * Trigger amply_default_header_outer_section.
		 */
		$( '#amply_default_header_type_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_outer_section' ).expanded.set( ! api.section( 'amply_default_header_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Trigger amply_default_header_header1_elements_outer_section.
		 */
		$( '#amply_default_header_header1_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_header1_elements_outer_section' ).expanded.set( ! api.section( 'amply_default_header_header1_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		/**
		 * Trigger amply_default_header_header2_elements_outer_section.
		 */
		$( '#amply_default_header_header2_elements_trigger_button' ).on( 'click', function( event ) {
			event.preventDefault();
			api.section( 'amply_default_header_header2_elements_outer_section' ).expanded.set( ! api.section( 'amply_default_header_header2_elements_outer_section' ).expanded.get() );
			$(this).parent().toggleClass('outer-open');
		} );

		// /**
		//  * TEST : Trigger primary nav options
		//  */
		// 	var controls = [
		// 		'amply_default_header_header1_primary_nav_visibility'
		// 	];
			
    //   $.each( controls, function( index, id ) {

		// 		// api.control( id ).toggle();

    //     api.control( id, function( control ) {
    //       var visibility = function() {
    //         control.container.slideUp( 280 );
    //       };
    //       visibility();
		// 			setting.bind( visibility );					
		// 		});
				
    //   });

		// } );

  });

}( jQuery ) );
