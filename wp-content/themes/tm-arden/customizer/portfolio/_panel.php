<?php
$panel    = 'portfolio';
$priority = 1;

Insight_Kirki::add_section( 'archive_portfolio', array(
	'title'    => esc_html__( 'Portfolio Archive', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'single_portfolio', array(
	'title'    => esc_html__( 'Portfolio Single', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_slider', array(
	'title'    => esc_html__( 'Fullscreen Slider Template', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_carousel_slider', array(
	'title'    => esc_html__( 'Fullscreen Carousel Slider Template', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'portfolio_fullscreen_split_slider', array(
	'title'    => esc_html__( 'Fullscreen Split Slider Template', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );
