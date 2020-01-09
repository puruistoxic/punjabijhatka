<?php
$panel    = 'shop';
$priority = 1;

Insight_Kirki::add_section( 'shop_general', array(
	'title'    => esc_html__( 'Shop General', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'shop_archive', array(
	'title'    => esc_html__( 'Shop Archive', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'shop_single', array(
	'title'    => esc_html__( 'Shop Single', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'shopping_cart', array(
	'title'    => esc_html__( 'Shopping Cart', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
