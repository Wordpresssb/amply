<?php
/**
 * Template part for displaying a post's title
 *
 * @package amply
 */

if ( is_singular( get_post_type() ) ) {
	the_title( '<h1 class="entry-title">', '</h1>' );
} else {
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
}