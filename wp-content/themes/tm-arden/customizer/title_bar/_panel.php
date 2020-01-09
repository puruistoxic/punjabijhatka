<?php
$panel    = 'title_bar';
$priority = 1;

Insight_Kirki::add_section( 'title_bar', array(
	'title'    => esc_html__( 'General', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'lg_title_bar', array(
	'title'       => esc_html__( 'Large Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of page title bar on large devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'md_title_bar', array(
	'title'       => esc_html__( 'Medium Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of page title bar on medium devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'sm_title_bar', array(
	'title'       => esc_html__( 'Small Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of page title bar on small devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'xs_title_bar', array(
	'title'       => esc_html__( 'Extra Small Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of page title bar on extra small devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );
