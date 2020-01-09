<?php
$section  = 'logo';
$priority = 1;
$prefix   = 'logo_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'logo',
	'label'       => esc_html__( 'Default logo', 'tm-arden' ),
	'description' => esc_html__( 'Choose default logo.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'logo_dark',
	'choices'     => array(
		'logo_dark'  => esc_html__( 'Dark Logo', 'tm-arden' ),
		'logo_light' => esc_html__( 'Light Logo', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'logo_dark',
	'label'       => esc_html__( 'Dark logo', 'tm-arden' ),
	'description' => esc_html__( 'Select an image file for your logo.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/logo.png',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'logo_light',
	'label'       => esc_html__( 'Light logo', 'tm-arden' ),
	'description' => esc_html__( 'Select an image file for your light logo.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/logo_light.png',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'width',
	'label'       => esc_html__( 'Logo Width', 'tm-arden' ),
	'description' => esc_html__( 'Ex: 200px', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '120px',
	'output'      => array(
		array(
			'element'  => '.branding__logo img,
			.page-mobile-menu-logo img,
			.maintenance-header img
			',
			'property' => 'width',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'padding',
	'label'       => esc_html__( 'Logo Padding', 'tm-arden' ),
	'description' => esc_html__( 'Ex: 30px 0px 30px 0px', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '20px',
		'right'  => '0px',
		'bottom' => '20px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.branding__logo img',
			'property' => 'padding',
		),
	),
) );
