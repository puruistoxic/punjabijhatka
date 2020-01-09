<?php
$section  = 'shop_archive';
$priority = 1;
$prefix   = 'shop_archive_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'shop_archive_new_days',
	'label'       => esc_html__( 'New Badge (Days)', 'tm-arden' ),
	'description' => esc_html__( 'If the product was published within the newness time frame display the new badge.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '3',
	'choices'     => array(
		''   => esc_html__( 'None', 'tm-arden' ),
		'1'  => esc_html__( '1 day', 'tm-arden' ),
		'2'  => esc_html__( '2 days', 'tm-arden' ),
		'3'  => esc_html__( '3 days', 'tm-arden' ),
		'4'  => esc_html__( '4 days', 'tm-arden' ),
		'5'  => esc_html__( '5 days', 'tm-arden' ),
		'6'  => esc_html__( '6 days', 'tm-arden' ),
		'7'  => esc_html__( '7 days', 'tm-arden' ),
		'8'  => esc_html__( '8 days', 'tm-arden' ),
		'9'  => esc_html__( '9 days', 'tm-arden' ),
		'10' => esc_html__( '10 days', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'shop_archive_number_item',
	'label'       => esc_html__( 'Number items', 'tm-arden' ),
	'description' => esc_html__( 'Controls the number of products display on shop archive page', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 12,
	'choices'     => array(
		'min'  => 1,
		'max'  => 30,
		'step' => 1,
	),
) );
