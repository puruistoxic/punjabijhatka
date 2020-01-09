<?php
$section  = 'error404_page';
$priority = 1;
$prefix   = 'error404_page_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'error404_page_background',
	'label'       => esc_html__( 'Background', 'tm-arden' ),
	'description' => esc_html__( 'Select an image to use for the background area on error 404 page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => INSIGHT_THEME_URI . '/assets/images/error404_bg.png',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center-center',
	),
	'output'      => array(
		array(
			'element' => '.error404 .side-left',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'error404_page_title',
	'label'       => esc_html__( 'Title', 'tm-arden' ),
	'description' => esc_html__( 'Controls the title that display on error 404 page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Woops, looks like this page doesn\'t exist', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'error404_page_text',
	'label'       => esc_html__( 'Text', 'tm-arden' ),
	'description' => esc_html__( 'Controls the text that display on error 404 page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'You could either go back or go to homepage', 'tm-arden' ),
) );
