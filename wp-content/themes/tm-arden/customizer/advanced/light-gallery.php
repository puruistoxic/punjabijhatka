<?php
$section  = 'light_gallery';
$priority = 1;
$prefix   = 'light_gallery_';

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'auto_play',
	'label'    => esc_html__( 'Auto Play', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '0',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'download',
	'label'    => esc_html__( 'Download Button', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'full_screen',
	'label'    => esc_html__( 'Full Screen Button', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'zoom',
	'label'    => esc_html__( 'Zoom Buttons', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => $prefix . 'thumbnail',
	'label'    => esc_html__( 'Thumbnail Gallery', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );
