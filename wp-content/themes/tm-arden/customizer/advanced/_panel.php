<?php
$panel    = 'advanced';
$priority = 1;

Insight_Kirki::add_section( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'light_gallery', array(
	'title'    => esc_html__( 'Light Gallery', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
