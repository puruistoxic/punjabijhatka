<?php
$section  = 'topbar';
$priority = 1;
$prefix   = 'topbar_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Visibility', 'tm-arden' ),
	'description' => esc_html__( 'Controls the visibility of top bar section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Hide', 'tm-arden' ),
		'1' => esc_html__( 'Show', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'columns',
	'label'    => esc_html__( 'Columns', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '2',
	'choices'  => array(
		'1' => esc_html__( '1 Column', 'tm-arden' ),
		'2' => esc_html__( '2 Columns', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'left_element',
	'label'    => esc_html__( 'Left Element', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'info',
	'choices'  => array(
		'none'            => esc_html__( 'None', 'tm-arden' ),
		'social_networks' => esc_html__( 'Social Networks', 'tm-arden' ),
		'info'            => esc_html__( 'Info List', 'tm-arden' ),
		'widgets'         => esc_html__( 'Widget', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'select',
	'settings' => $prefix . 'right_element',
	'label'    => esc_html__( 'Right Element', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => 'social_networks',
	'choices'  => array(
		'none'            => esc_html__( 'None', 'tm-arden' ),
		'social_networks' => esc_html__( 'Social Networks', 'tm-arden' ),
		'info'            => esc_html__( 'Info List', 'tm-arden' ),
		'widgets'         => esc_html__( 'Widget', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 11,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-top-bar',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 11,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-top-bar',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_margin_top',
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
			'element'  => '.page-top-bar',
			'property' => 'margin-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_margin_bottom',
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
			'element'  => '.page-top-bar',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => 'topbar_typography',
	'label'       => esc_html__( 'Typography', 'tm-arden' ),
	'description' => esc_html__( 'These settings control the typography of texts of top bar section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => 'regular',
		'line-height'    => '1.8',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
	),
	'output'      => array(
		array(
			'element' => '.page-top-bar, .page-top-bar a',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'topbar_font_size',
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
			'element'  => '.page-top-bar, .page-top-bar a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'topbar_bg_color',
	'label'       => esc_html__( 'Background', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of top bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-top-bar',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'text_color',
	'label'       => esc_html__( 'Text', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of text on top bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#878c9b',
	'output'      => array(
		array(
			'element'  => '.page-top-bar',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of links on top bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#878c9b',
	'output'      => array(
		array(
			'element'  => '.page-top-bar a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'topbar_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color when hover of links on top bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-top-bar a:hover, .page-top-bar a:focus',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'topbar_icon_color',
	'label'       => esc_html__( 'Icon Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of icons on top bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.top-bar-info .info-icon',
			'property' => 'color',
		),
	),
) );

//Info List

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'repeater',
	'settings'    => 'topbar_info_list',
	'label'       => esc_html__( 'Info List', 'tm-arden' ),
	'description' => wp_kses( __( 'You can find icon class <a target="_blank" href="http://fontawesome.io/cheatsheet/">here</a>.', 'tm-arden' ), array(
		'a' => array(
			'href'   => array(),
			'target' => array(),
		),
	) ),
	'section'     => $section,
	'priority'    => $priority ++,
	'choices'     => array(
		'labels' => array(
			'add-new-row' => esc_html__( 'Add new info', 'tm-arden' ),
		),
	),
	'row_label'   => array(
		'type'  => 'field',
		'field' => 'text',
	),
	'default'     => array(
		array(
			'text'       => esc_html__( '(102) 6666 8888', 'tm-arden' ),
			'icon_class' => 'fa-phone',
		),
		array(
			'text'       => esc_html__( 'Mon - Sat: 9:00 - 18:00', 'tm-arden' ),
			'icon_class' => 'fa-clock-o',
		),
		array(
			'text'       => esc_html__( 'info@example.com', 'tm-arden' ),
			'icon_class' => 'fa-envelope-o',
			'link_url'   => 'mailto:info@example.com',
		),
	),
	'fields'      => array(
		'text'       => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Text', 'tm-arden' ),
			'description' => esc_html__( 'Enter your text for your info item', 'tm-arden' ),
			'default'     => '',
		),
		'icon_class' => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Font Awesome Class', 'tm-arden' ),
			'description' => esc_html__( 'This will be the icon class for your item', 'tm-arden' ),
			'default'     => '',
		),
		'link_url'   => array(
			'type'        => 'text',
			'label'       => esc_html__( 'Link URL', 'tm-arden' ),
			'description' => esc_html__( 'This will be the link URL', 'tm-arden' ),
			'default'     => '',
		),
	),
) );
