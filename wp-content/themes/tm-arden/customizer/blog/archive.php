<?php
$section  = 'blog_archive';
$priority = 1;
$prefix   = 'blog_archive_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'style',
	'label'       => esc_html__( 'Blog Style', 'tm-arden' ),
	'description' => esc_html__( 'Select blog style that display for archive pages.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'1' => esc_html__( 'Large Image', 'tm-arden' ),
		'2' => esc_html__( 'Grid Classic', 'tm-arden' ),
		'3' => esc_html__( 'Grid Masonry', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'columns',
	'label'       => esc_html__( 'Grid Layout Columns', 'tm-arden' ),
	'description' => esc_html__( 'Select columns for blog.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '2',
	'choices'     => array(
		'2' => esc_html__( '2 Columns', 'tm-arden' ),
		'3' => esc_html__( '3 Columns', 'tm-arden' ),
		'4' => esc_html__( '4 Columns', 'tm-arden' ),
	),
) );
