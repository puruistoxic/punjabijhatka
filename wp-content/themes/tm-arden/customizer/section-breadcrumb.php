<?php
$section  = 'breadcrumb';
$priority = 1;
$prefix   = 'breadcrumb_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'breadcrumb_enable',
	'label'       => esc_html__( 'Enable', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to show breadcrumb in title bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'text',
	'settings' => $prefix . 'home_text',
	'label'    => esc_html__( 'Home Text', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => esc_html__( 'Home', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'breadcrumb_padding_top',
	'label'     => esc_html__( 'Breadcrumb Padding top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 23,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-breadcrumb-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'breadcrumb_padding_bottom',
	'label'     => esc_html__( 'Breadcrumb Padding bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 20,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-breadcrumb-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'breadcrumb_margin_top',
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
			'element'     => '.page-breadcrumb-inner',
			'property'    => 'margin-top',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'breadcrumb_margin_bottom',
	'label'     => esc_html__( 'Margin bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 50,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-breadcrumb-inner',
			'property'    => 'margin-bottom',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . '_typography',
	'label'       => esc_html__( 'Typography', 'tm-arden' ),
	'description' => esc_html__( 'Controls the font family for the breadcrumb text.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '18px',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.page-breadcrumb-inner li, .page-breadcrumb-inner li a',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'slider',
	'settings'    => $prefix . 'font_size',
	'label'       => esc_html__( 'Font size', 'tm-arden' ),
	'description' => esc_html__( 'Controls the font size for the breadcrumb text.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 16,
	'transport'   => 'auto',
	'choices'     => array(
		'min'  => 10,
		'max'  => 80,
		'step' => 1,
	),
	'output'      => array(
		array(
			'element'  => '.page-breadcrumb-inner li, .page-breadcrumb-inner li a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of text on breadcrumb.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-breadcrumb-inner li',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of links on breadcrumb.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-breadcrumb-inner li a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color when hover of links on breadcrumb.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-breadcrumb-inner li a:hover',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of the breadcrumb.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(0, 0, 0, 0)',
	'output'      => array(
		array(
			'element'  => '.page-breadcrumb-inner',
			'property' => 'background-color',
		),
	),
) );
