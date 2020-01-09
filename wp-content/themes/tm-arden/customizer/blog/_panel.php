<?php
$panel    = 'blog';
$priority = 1;

/*Insight_Kirki::add_section( 'blog_archive', array(
	'title'    => esc_html__( 'Blog Archive', 'tm-arden' ),
	'panel'    => $panel,
	'priority' => $priority ++,
) );*/

Insight_Kirki::add_section( 'blog_single', array(
    'title'    => esc_html__( 'Blog Single Post', 'tm-arden' ),
    'panel'    => $panel,
    'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'blog_fullscreen_slider', array(
    'title'    => esc_html__( 'Blog Fullscreen Slider Template', 'tm-arden' ),
    'panel'    => $panel,
    'priority' => $priority ++,
) );
