<?php
$section  = 'blog_fullscreen_slider';
$priority = 1;
$prefix   = 'blog_fullscreen_slider_';

Insight_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => $prefix . 'categories',
    'label'       => esc_html__( 'Filter By Cats', 'tm-arden' ),
    'description' => esc_html__( 'Select categories to filter by.', 'tm-arden' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'multiple'    => 1000,
    'choices'     => Insight_Blog::get_categories(),
) );

Insight_Kirki::add_field( 'theme', array(
    'type'        => 'select',
    'settings'    => $prefix . 'tags',
    'label'       => esc_html__( 'Filter By Tags', 'tm-arden' ),
    'description' => esc_html__( 'Select tags to filter by.', 'tm-arden' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'multiple'    => 1000,
    'choices'     => Insight_Blog::get_tags(),
) );

Insight_Kirki::add_field( 'theme', array(
    'type'        => 'number',
    'settings'    => $prefix . 'number',
    'label'       => esc_html__( 'Number posts', 'tm-arden' ),
    'description' => esc_html__( 'Controls the number of posts display on this template.', 'tm-arden' ),
    'section'     => $section,
    'priority'    => $priority ++,
    'default'     => 5,
    'choices'     => array(
        'min'  => 3,
        'max'  => 30,
        'step' => 1,
    ),
) );
