<?php
/**
 * Front page panel
 *
 * @package amply
 */

Kirki::add_panel(
	'amply_frontpage_panel',
	array(
		'title'    => esc_html__( 'Frontpage', 'amply' ),
		'priority' => 311,
	)
);
