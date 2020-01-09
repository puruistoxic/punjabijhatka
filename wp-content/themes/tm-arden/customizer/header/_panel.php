<?php
$panel    = 'header';
$priority = 1;

Insight_Kirki::add_section( 'header', array(
	'title'    => esc_html__( 'General', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'lg_header', array(
	'title'       => esc_html__( 'Large Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of header on large devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'md_header', array(
	'title'       => esc_html__( 'Medium Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of header on medium devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'sm_header', array(
	'title'       => esc_html__( 'Small Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of header on small devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'xs_header', array(
	'title'       => esc_html__( 'Extra Small Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of header on extra small devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'header_sticky', array(
	'title'    => esc_html__( 'Header Sticky', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
