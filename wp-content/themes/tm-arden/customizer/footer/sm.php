<?php
$section     = 'sm_footer';
$priority    = 1;
$prefix      = 'sm_footer_';
$media_query = Insight_Helper::get_sm_media_query();

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Spacing', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 90,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-footer-inner',
			'property'    => 'padding-top',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-footer-inner',
			'property'    => 'padding-bottom',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'margin_top',
	'label'     => esc_html__( 'Margin top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.footer',
			'property'    => 'margin-top',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'margin_bottom',
	'label'     => esc_html__( 'Margin bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.footer',
			'property'    => 'margin-bottom',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Typography', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'footer_font_size',
	'label'     => esc_html__( 'Font size', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 16,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-footer, .page-footer a',
			'property'    => 'font-size',
			'units'       => 'px',
			'media_query' => $media_query,
		),
	),
) );
