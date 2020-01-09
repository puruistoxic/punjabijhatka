<?php
$section  = 'footer';
$priority = 1;
$prefix   = 'footer_';
/*--------------------------------------------------------------
# Footer general
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'General', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'footer_enable',
	'label'       => esc_html__( 'Visibility', 'tm-arden' ),
	'description' => esc_html__( 'Turn on this option to display footer section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'preset',
	'settings'    => 'footer_preset',
	'description' => esc_html__( 'Choose a footer preset', 'tm-arden' ),
	'section'     => $section,
	'default'     => '-1',
	'priority'    => $priority++,
	'multiple'    => 1,
	'choices'     => array(
		'-1' => array(
			'label'    => esc_html__( 'None', 'tm-arden' ),
			'settings' => array(),
		),
		'2'  => array(
			'label'    => esc_html__( 'Footer Preset 02', 'tm-arden' ),
			'settings' => array(
				'footer_columns' => '2:1:1',
			),
		),
		'3'  => array(
			'label'    => esc_html__( 'Footer Preset 03', 'tm-arden' ),
			'settings' => array(
				'footer_columns'  => '2:1:1',
				'footer_bg_color' => '#fff',
			),
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer_effect',
	'label'       => esc_html__( 'Footer Effect', 'tm-arden' ),
	'description' => esc_html__( 'Select effect for footer & copyright section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'parallax',
	'choices'     => array(
		'none'          => esc_html__( 'None', 'tm-arden' ),
		'always_bottom' => esc_html__( 'Always Bottom.', 'tm-arden' ),
		'parallax'      => esc_html__( 'Parallax', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => $prefix . 'columns',
	'label'       => esc_html__( 'Footer Columns', 'tm-arden' ),
	'description' => esc_html__( 'Select number columns of footer.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '4',
	'choices'     => array(
		'1'     => esc_html__( '1 Column', 'tm-arden' ),
		'2'     => esc_html__( '2 Columns', 'tm-arden' ),
		'3'     => esc_html__( '3 Columns', 'tm-arden' ),
		'2:1:1' => esc_html__( '3 Columns ( 2/4 + 1/4 + 1/4 )', 'tm-arden' ),
		'4'     => esc_html__( '4 Columns', 'tm-arden' ),
		'5'     => esc_html__( '5 Columns', 'tm-arden' ),
		'6'     => esc_html__( '6 Columns', 'tm-arden' ),
	),
) );

/*--------------------------------------------------------------
# Footer typography
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Typography', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => 'footer_typography',
	'label'       => esc_html__( 'Font family', 'tm-arden' ),
	'description' => esc_html__( 'These settings control the typography for footer text.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.85',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
	),
	'output'      => array(
		array(
			'element' => '.page-footer, .page-footer a',
		),
	),
) );

/*--------------------------------------------------------------
# Footer color
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Styling', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'footer_bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of footer section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#0e1220',
	'output'      => array(
		array(
			'element'  => '.page-footer-inner',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => 'footer_bg_image',
	'label'       => esc_html__( 'Background', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background of footer section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center',
	),
	'output'      => array(
		array(
			'element' => '.page-footer-inner',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'footer_bg_overlay',
	'label'       => esc_html__( 'Background Overlay', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color overlay of footer section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba( 0, 0, 0, 0 )',
	'output'      => array(
		array(
			'element'  => '.page-footer-overlay',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'footer_text_color',
	'label'       => esc_html__( 'Text', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of footer text.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#878c9b',
	'output'      => array(
		array(
			'element'  => '.page-footer',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'footer_link_color',
	'label'       => esc_html__( 'Link color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of footer links.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#878c9b',
	'output'      => array(
		array(
			'element'  => '.page-footer a, .page-footer .widget_recent_entries li a, .page-footer .widget_recent_comments li a, .page-footer .widget_archive li a, .page-footer .widget_categories li a, .page-footer .widget_meta li a, .page-footer .widget_product_categories li a, .page-footer .widget_rss li a, .page-footer .widget_pages li a, .page-footer .widget_nav_menu li a, .page-footer .insight-core-bmw li a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'footer_link_color_hover',
	'label'       => esc_html__( 'Link hover color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color when hover of footer links.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-footer a:hover, .page-footer .widget_recent_entries li a:hover, .page-footer .widget_recent_comments li a:hover, .page-footer .widget_archive li a:hover, .page-footer .widget_categories li a:hover, .page-footer .widget_meta li a:hover, .page-footer .widget_product_categories li a:hover, .page-footer .widget_rss li a:hover, .page-footer .widget_pages li a:hover, .page-footer .widget_nav_menu li a:hover, .page-footer .insight-core-bmw li a:hover',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Footer widget title color
--------------------------------------------------------------*/
Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Widget Title', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => 'footer_widget_title_color',
	'label'       => esc_html__( 'Title Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of footer widget title.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-footer .widget-title',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'footer_widget_title_border_color',
	'label'       => esc_html__( 'Border', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of all menu item links.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255,255,255, 0)',
	'output'      => array(
		array(
			'element'  => '.page-footer .widget-title',
			'property' => 'border-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => 'footer_widget_title_margin_bottom',
	'label'     => esc_html__( 'Margin Bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority++,
	'default'   => 18,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'     => '.page-footer .widget-title',
			'property'    => 'margin-bottom',
			'media_query' => '@media (min-width: 1200px)',
			'units'       => 'px',
		),
	),
) );
