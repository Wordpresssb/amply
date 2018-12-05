<?php
/**
 * Header 1
 *
 * @package wprig
 */

?>

<h1>HEADER 1</h1>

<?php amply_logo(); ?>

<?php
$my_query_var = get_query_var( 'amply_header_var' );
if ( $my_query_var ) {
	var_dump( $my_query_var );
}
