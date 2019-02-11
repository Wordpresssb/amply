<?php
/**
 * The template for displaying search forms.
 *
 * @package Amply
 */

$unique_id = uniqid( 'search-form-' );
?>

<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label for="<?php echo esc_attr( $unique_id ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'amply' ); ?></span>
	</label>

	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" name="s" id="s" autocomplete="off" placeholder="<?php esc_attr_e( 'Search &hellip;', 'amply' ); ?>" value="<?php echo get_search_query(); ?>" />

	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>

</form>
