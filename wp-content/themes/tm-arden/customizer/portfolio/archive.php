<?php
$section  = 'archive_portfolio';
$priority = 1;
$prefix   = 'archive_portfolio_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_style',
	'label'       => esc_html__( 'Portfolio Style', 'tm-arden' ),
	'description' => esc_html__( 'Select portfolio style that display for archive pages.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'1' => esc_attr__( 'Grid Classic', 'tm-arden' ),
		'2' => esc_attr__( 'Grid Metro', 'tm-arden' ),
		'3' => esc_attr__( 'Grid Masonry', 'tm-arden' ),
		'4' => esc_attr__( 'Carousel Slider', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_thumbnail_size',
	'label'    => esc_html__( 'Thumbnail Size', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'insight-grid-classic',
	'choices'  => array(
		'insight-grid-classic'        => esc_attr__( '500x675', 'tm-arden' ),
		'insight-grid-classic-2'      => esc_attr__( '600x463', 'tm-arden' ),
		'insight-grid-classic-square' => esc_attr__( '600x600', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_columns',
	'label'    => esc_html__( 'Columns', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '3',
	'choices'  => array(
		'2' => esc_attr__( '2 Columns', 'tm-arden' ),
		'3' => esc_attr__( '3 Columns', 'tm-arden' ),
		'4' => esc_attr__( '4 Columns', 'tm-arden' ),
		'5' => esc_attr__( '5 Columns', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => 'archive_portfolio_overlay_style',
	'label'    => esc_html__( 'Columns', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'faded',
	'choices'  => array(
		'none'      => esc_attr__( 'None', 'tm-arden' ),
		'hover-dir' => esc_attr__( 'Hover Dir', 'tm-arden' ),
		'zoom'      => esc_attr__( 'Image zoom - content below', 'tm-arden' ),
		'faded'     => esc_attr__( 'Faded', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'archive_portfolio_animation',
	'label'       => esc_html__( 'CSS Animation', 'tm-arden' ),
	'description' => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'scale-up',
	'choices'     => array(
		'none'             => esc_attr__( 'None', 'tm-arden' ),
		'fade-in'          => esc_attr__( 'Fade In', 'tm-arden' ),
		'move-up'          => esc_attr__( 'Move Up', 'tm-arden' ),
		'scale-up'         => esc_attr__( 'Scale Up', 'tm-arden' ),
		'fall-perspective' => esc_attr__( 'Fall Perspective', 'tm-arden' ),
		'fly'              => esc_attr__( 'Fly', 'tm-arden' ),
		'flip'             => esc_attr__( 'Flip', 'tm-arden' ),
		'helix'            => esc_attr__( 'Helix', 'tm-arden' ),
		'pop-up'           => esc_attr__( 'Pop Up', 'tm-arden' ),
	),
) );
