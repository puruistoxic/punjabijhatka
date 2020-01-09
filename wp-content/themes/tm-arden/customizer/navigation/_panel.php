<?php
$panel    = 'navigation';
$priority = 1;

Insight_Kirki::add_section( 'navigation', array(
	'title'    => esc_html__( 'Desktop Menu', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'navigation_minimal', array(
	'title'    => esc_html__( 'Off Canvas Menu', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'navigation_mobile', array(
	'title'    => esc_html__( 'Mobile Menu', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
