<?php
/**
 * Sanitize callbacks
 *
 * @package amply
 */

/**
 * Header 1
 */

/**
 * Sanitize logo position
 *
 * @param string $value Initial value.
 * @return mixed
 */
function sanitize_logo_position( $value ) {

	if ( 'right' === $value ) {
		return 'row-reverse';
	} else {
		return false;
	}

}

/**
 * Sanitize header position
 *
 * @param string $value Buttonset value.
 * @return mixed
 */
function sanitize_header_position( $value ) {

	if ( 'sticky' === $value ) {
		return 'fixed';
	} elseif ( 'transparent' === $value ) {
		return 'absolute';
	} else {
		return false;
	}

}

/**
 * Sanitize header width
 *
 * @param string $value Buttonset value.
 * @return mixed
 */
function sanitize_header_width( $value ) {

	if ( 'sticky' === $value || 'transparent' === $value ) {
		return '100%';
	} else {
		return false;
	}

}

/**
 * Sanitize header top
 *
 * @param string $value Buttonset value.
 * @return mixed
 */
function sanitize_header_top( $value ) {

	if ( 'sticky' === $value && is_admin_bar_showing() ) {
		return '32px';
	} elseif ( 'sticky' === $value ) {
		return '0';
	} else {
		return false;
	}

}

/**
 * Sanitize header top mobile
 *
 * @param string $value Buttonset value.
 * @return mixed
 */
function sanitize_header_top_mobile( $value ) {

	if ( 'sticky' === $value && is_admin_bar_showing() ) {
		return '45px';
	} elseif ( 'sticky' === $value ) {
		return '0';
	} else {
		return false;
	}

}

/**
 * Sanitize header padding
 *
 * @param string $value Buttonset value.
 * @return mixed
 */
function sanitize_header_padding( $value ) {

	if ( 'sticky' === $value ) {
		return '3.5rem';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky position
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_position( $value ) {

	if ( $value ) {
		return 'fixed';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky width
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_width( $value ) {

	if ( $value ) {
		return '100%';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky top
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_top( $value ) {

	if ( $value && is_admin_bar_showing() ) {
		return '32px';
	} elseif ( $value ) {
		return '0';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky top mobile
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_top_mobile( $value ) {

	if ( $value && is_admin_bar_showing() ) {
		return '45px';
	} elseif ( $value ) {
		return '0';
	} else {
		return false;
	}

}

/**
 * Sanitize sticky padding
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_sticky_padding( $value ) {

	if ( $value ) {
		return '3.5rem';
	} else {
		return false;
	}

}

/**
 * Sanitize transparent position
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_transparent_position( $value ) {

	if ( $value ) {
		return 'absolute';
	} else {
		return false;
	}

}

/**
 * Sanitize transparent width
 *
 * @param string $value Switch value.
 * @return mixed
 */
function sanitize_transparent_width( $value ) {

	if ( $value ) {
		return '100%';
	} else {
		return false;
	}

}

/**
 * Sanitize visibility
 *
 * @param string $value Initial value.
 * @return mixed
 */
function sanitize_visibility( $value ) {

	if ( $value ) {
		return 'flex';
	} else {
		return false;
	}

}
