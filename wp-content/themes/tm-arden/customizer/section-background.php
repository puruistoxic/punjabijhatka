<?php
$section  = 'background';
$priority = 1;
$prefix   = 'site_background_';

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Boxed Mode Background', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'color_body',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of the outer background area in boxed mode.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.site',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'image_body',
	'label'       => esc_html__( 'Background Image', 'tm-arden' ),
	'description' => esc_html__( 'Select an image to use for the outer background area in boxed mode.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'left-top',
	),
	'output'      => array(
		array(
			'element' => 'body.boxed .site',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Content Background', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'color_main_content',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of the main content area which is everything below header and above footer.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'inherit',
	'output'      => array(
		array(
			'element'  => '.page-content',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'image_main_content',
	'label'       => esc_html__( 'Background Image', 'tm-arden' ),
	'description' => esc_html__( 'Select an image to use for the main content area background.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
		'background-position'   => 'left-top',
	),
	'output'      => array(
		array(
			'element' => '.page-content',
		),
	),
) );
