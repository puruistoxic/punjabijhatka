<?php
$panel    = 'footer';
$priority = 1;

Insight_Kirki::add_section( 'footer', array(
	'title'    => esc_html__( 'General', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'lg_footer', array(
	'title'       => esc_html__( 'Large Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of footer on large devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'md_footer', array(
	'title'       => esc_html__( 'Medium Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of footer on medium devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'sm_footer', array(
	'title'       => esc_html__( 'Small Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of footer on small devices.' , 'tm-arden'),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );

Insight_Kirki::add_section( 'xs_footer', array(
	'title'       => esc_html__( 'Extra Small Device', 'tm-arden' ),
	'description' => esc_html__( 'Controls settings of footer on extra small devices.', 'tm-arden' ),
	'panel'       => $panel,
	'priority'    => $priority ++,
) );
