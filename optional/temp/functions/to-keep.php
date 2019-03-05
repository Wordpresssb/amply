<?php
// phpcs:ignoreFile

/**
 * Add header template.
 */
function default_header_view__safe() {

	$name = 'default-' . $this->header;
	set_query_var( 'amply_header_var', $name );

	if ( 'headercpt' === $this->header ) {

		$header_id = amply_option( 'amply_default_header_' . $this->header . '_template' );
		set_query_var( 'amply_header_id_var', $header_id ); // => $header_id = get_query_var( 'amply_header_id_var', '' );.

	} else {

		$elements = amply_option( 'amply_default_header_' . $this->header . '_elements' );
		set_query_var( 'amply_header_elements_var', $elements );

	}

	get_template_part( 'views/header/' . $this->header . '/' . $this->header, 'partial' );

}
