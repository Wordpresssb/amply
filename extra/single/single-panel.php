<?php
/**
 * Single panel
 *
 * @package amply
 */

Kirki::add_panel(
	'amply_single_panel',
	array(
		'title'    => esc_html__( 'Single Posts', 'amply' ),
		'priority' => 312,
	)
);
