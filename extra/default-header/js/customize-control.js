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
    defaultHeaderTypeTrigger = new api.Control( 'amply_default_header_type_trigger', {
      type: 'button',
      section: 'amply_default_header_section',
      priority: 1,
      input_attrs: { // eslint-disable-line
        'class': 'default-header-type-trigger',
        value: 'Choose header type'
      }
    });
    api.control.add( defaultHeaderTypeTrigger );
    defaultHeaderTypeTrigger.container.find( '.default-header-type-trigger' ).on( 'click', function( event ) {
      event.preventDefault();
      api.section( 'amply_default_header_outer_section' ).expanded.set( ! api.section( 'amply_default_header_outer_section' ).expanded.get() );
		});

		/**
		 * Only show controls of the selected amply_default_header_type.
		 */
    api( 'wprig_header_template', function( setting ) {

      var Headerbar1Controls = [

      ];

      var Header1Controls = [

			];

      $.each( Headerbar1Controls, function( index, id ) {
        api.control( id, function( control ) {
          var visibility = function() {
            if ( 'headerbar1' === setting.get() ) {
              control.container.slideDown( 280 );
            } else {
              control.container.slideUp( 280 );
            }
          };
          visibility();
          setting.bind( visibility );
        });
      });

      $.each( Header1Controls, function( index, id ) {
        api.control( id, function( control ) {
          var visibility = function() {
            if ( 'header1' === setting.get() ) {
              control.container.slideDown( 280 );
            } else {
              control.container.slideUp( 280 );
            }
          };
          visibility();
          setting.bind( visibility );
        });
			});

    });

  });

}( jQuery ) );
