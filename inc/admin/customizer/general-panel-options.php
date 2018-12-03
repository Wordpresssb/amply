<?php
/**
 * General panel
 *
 * @package amply
 */

Kirki::add_panel(
	'amply_general_panel',
	array(
		'title'    => esc_html__( 'General Options', 'amply' ),
		'priority' => 300,
	)
);
