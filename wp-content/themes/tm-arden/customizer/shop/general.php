<?php
$section  = 'shop_general';
$priority = 1;
$prefix   = 'shop_general_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shopping_cart_icon_enable',
	'label'       => esc_html__( 'Cart Icon', 'tm-arden' ),
	'description' => esc_html__( 'Controls the display for cart icon on header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0'             => esc_html__( 'Hide', 'tm-arden' ),
		'1'             => esc_html__( 'Show', 'tm-arden' ),
		'hide_on_empty' => esc_html__( 'Hide On Empty', 'tm-arden' ),
	),
) );
