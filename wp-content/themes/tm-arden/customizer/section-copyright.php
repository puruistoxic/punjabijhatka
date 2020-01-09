<?php
$section  = 'copyright';
$priority = 1;
$prefix   = 'copyright_';
/*--------------------------------------------------------------
# Copyright layout
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'copyright_enable',
	'label'       => esc_html__( 'Visibility', 'tm-arden' ),
	'description' => esc_html__( 'Enable this option to turn on copyright section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'layout',
	'label'       => esc_html__( 'Copyright Layout', 'tm-arden' ),
	'description' => esc_html__( 'Controls the layout of copyright section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'grid',
	'choices'     => array(
		'fluid' => esc_html__( 'Off', 'tm-arden' ),
		'grid'  => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'preset',
	'settings'    => 'copyright_preset',
	'description' => esc_html__( 'Choose a copyright preset you want', 'tm-arden' ),
	'section'     => $section,
	'default'     => '-1',
	'priority'    => $priority ++,
	'multiple'    => 3,
	'choices'     => array(
		'-1' => array(
			'label'    => esc_html__( 'None', 'tm-arden' ),
			'settings' => array(),
		),
		'2'  => array(
			'label'    => esc_html__( 'Preset 02 ( 2 Columns - White )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'   => 'grid',
				'copyright_bg_color' => '#fff',
			),
		),
		'3'  => array(
			'label'    => esc_html__( 'Preset 03 ( 1 Column - Secondary )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'           => 'grid',
				'copyright_columns'          => '1',
				'copyright_padding_top'      => 93,
				'copyright_padding_bottom'   => 93,
				'copyright_bg_color'         => Insight::SECONDARY_COLOR,
				'copyright_font_size'        => 18,
				'copyright_text_color'       => '#fff',
				'copyright_link_color'       => '#fff',
				'copyright_link_hover_color' => '#fff',
			),
		),
		'4'  => array(
			'label'    => esc_html__( 'Preset 04 ( 2 Columns - Primary )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'           => 'grid',
				'copyright_columns'          => '2',
				'copyright_padding_top'      => 92,
				'copyright_padding_bottom'   => 92,
				'copyright_bg_color'         => Insight::PRIMARY_COLOR,
				'copyright_text_color'       => '#878c9b',
				'copyright_link_color'       => '#fff',
				'copyright_link_hover_color' => '#fff',
			),
		),
		'5'  => array(
			'label'    => esc_html__( 'Preset 05 ( 2 Columns - Black )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'           => 'grid',
				'copyright_columns'          => '2',
				'copyright_padding_top'      => 92,
				'copyright_padding_bottom'   => 92,
				'copyright_bg_color'         => '#000',
				'copyright_text_color'       => '#878c9b',
				'copyright_link_color'       => '#fff',
				'copyright_link_hover_color' => '#fff',
			),
		),
		'6'  => array(
			'label'    => esc_html__( 'Preset 06 ( Fluid Layout - 2 Columns - Gray )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'           => 'fluid',
				'copyright_columns'          => '2',
				'copyright_padding_top'      => 45,
				'copyright_padding_bottom'   => 45,
				'copyright_bg_color'         => '#F5f5f5',
				'copyright_text_color'       => '#878c9b',
				'copyright_link_color'       => '#878c9b',
				'copyright_link_hover_color' => Insight::SECONDARY_COLOR,
			),
		),
		'7'  => array(
			'label'    => esc_html__( 'Preset 07 ( 2 Columns - Gray )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'           => 'grid',
				'copyright_columns'          => '2',
				'copyright_padding_top'      => 45,
				'copyright_padding_bottom'   => 45,
				'copyright_bg_color'         => '#F5f5f5',
				'copyright_text_color'       => '#878c9b',
				'copyright_link_color'       => '#878c9b',
				'copyright_link_hover_color' => Insight::SECONDARY_COLOR,
			),
		),
		'8'  => array(
			'label'    => esc_html__( 'Preset 08 ( 1 Column - Black )', 'tm-arden' ),
			'settings' => array(
				'copyright_layout'           => 'grid',
				'copyright_columns'          => '1',
				'copyright_padding_top'      => 67,
				'copyright_padding_bottom'   => 67,
				'copyright_bg_color'         => '#222222',
				'copyright_text_color'       => '#878c9b',
				'copyright_link_color'       => '#fff',
				'copyright_link_hover_color' => '#fff',
			),
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'columns',
	'label'       => esc_html__( 'Copyright Columns', 'tm-arden' ),
	'description' => esc_html__( 'Select number columns of copyright.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '2',
	'choices'     => array(
		'1' => esc_html__( '1 Column', 'tm-arden' ),
		'2' => esc_html__( '2 Columns', 'tm-arden' ),
		'3' => esc_html__( '3 Columns', 'tm-arden' ),
	),
) );

/*--------------------------------------------------------------
# Copyright spacing
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Spacing', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 47,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-copyright-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 47,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-copyright-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_margin_top',
	'label'     => esc_html__( 'Margin top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => - 200,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-copyright-inner',
			'property' => 'margin-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_margin_bottom',
	'label'     => esc_html__( 'Margin bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => - 200,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-copyright-inner',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Copyright color
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Styling', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'copyright_bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of copyright.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#0e1220',
	'output'      => array(
		array(
			'element'  => '.page-copyright-inner',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'copyright_border_color',
	'label'       => esc_html__( 'Border Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the border top color of copyright.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(0,0,0,0)',
	'output'      => array(
		array(
			'element'  => '.page-copyright-inner',
			'property' => 'border-top-color',
		),
	),
) );

/*--------------------------------------------------------------
# Text typography
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Typography', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => 'copyright_typography',
	'label'       => esc_html__( 'Font family', 'tm-arden' ),
	'description' => esc_html__( 'These settings control the typography for all copyright text.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.8',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
	),
	'output'      => array(
		array(
			'element' => '.page-copyright, .page-copyright a',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'copyright_font_size',
	'label'     => esc_html__( 'Font size', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 14,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 10,
		'max'  => 50,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.page-copyright, .page-copyright a',
			'property' => 'font-size',
			'units'    => 'px',
		),
	),
) );

/*--------------------------------------------------------------
# Text color
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="group_title">' . esc_html__( 'Styling', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'copyright_text_color',
	'label'       => esc_html__( 'Text Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of text.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#878c9b',
	'output'      => array(
		array(
			'element'  => '.page-copyright',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'copyright_link_color',
	'label'       => esc_html__( 'Link Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of links', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#878c9b',
	'output'      => array(
		array(
			'element'  => '.page-copyright a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'copyright_link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color when hover of links.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-copyright a:hover,
			.page-copyright .widget_recent_entries li a:hover,
			.page-copyright .widget_recent_comments li a:hover,
			.page-copyright .widget_archive li a:hover,
			.page-copyright .widget_categories li a:hover,
			.page-copyright .widget_meta li a:hover,
			.page-copyright .widget_product_categories li a:hover,
			.page-copyright .widget_rss li a:hover,
			.page-copyright .widget_pages li a:hover,
			.page-copyright .widget_nav_menu li a:hover,
			.page-copyright .insight-core-bmw li a:hover',
			'property' => 'color',
		),
	),
) );
