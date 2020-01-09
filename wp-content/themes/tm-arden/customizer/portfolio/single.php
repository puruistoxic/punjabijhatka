<?php
$section  = 'single_portfolio';
$priority = 1;
$prefix   = 'single_portfolio_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_title_bar_enable',
	'label'       => esc_html__( 'Title Bar', 'tm-arden' ),
	'description' => esc_html__( 'Choose default to use setting from title bar section, choose on to force display title bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_sticky_detail_enable',
	'label'       => esc_html__( 'Sticky Detail Column', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to enable sticky of detail column.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'single_portfolio_style',
	'label'       => esc_html__( 'Single Portfolio Style', 'tm-arden' ),
	'description' => esc_html__( 'Select style of all single portfolio post pages.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'1' => esc_attr__( 'Left Description', 'tm-arden' ),
		'2' => esc_attr__( 'Right Description', 'tm-arden' ),
		'3' => esc_attr__( 'Image Gallery', 'tm-arden' ),
		'4' => esc_attr__( 'Image Slider', 'tm-arden' ),
		'5' => esc_attr__( 'Video', 'tm-arden' ),
		'6' => esc_attr__( 'Fullscreen Slider', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'portfolio_related_enable',
	'label'       => esc_html__( 'Related Portfolios', 'tm-arden' ),
	'description' => esc_html__( 'Turn on this option to display related portfolio section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'portfolio_related_title',
	'label'           => esc_html__( 'Related Title Section', 'tm-arden' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => esc_html__( 'Related Projects', 'tm-arden' ),
	'active_callback' => array(
		array(
			'setting'  => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'multicheck',
	'settings'        => 'portfolio_related_by',
	'label'           => esc_attr__( 'Related By', 'tm-arden' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => array( 'portfolio_category' ),
	'choices'         => array(
		'portfolio_category' => esc_html__( 'Portfolio Category', 'tm-arden' ),
		'portfolio_tags'     => esc_html__( 'Portfolio Tags', 'tm-arden' ),
	),
	'active_callback' => array(
		array(
			'setting'  => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );


Insight_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'portfolio_related_number',
	'label'           => esc_html__( 'Number portfolios', 'tm-arden' ),
	'description'     => esc_html__( 'Controls the number of related portfolios', 'tm-arden' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => 10,
	'choices'         => array(
		'min'  => 3,
		'max'  => 30,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'portfolio_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_tags_enable',
	'label'       => esc_html__( 'Tags', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display tags on single portfolio posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'text',
	'settings'        => 'single_portfolio_tags_label',
	'label'           => esc_html__( 'Tags Label', 'tm-arden' ),
	'description'     => esc_html__( 'Custom label for portfolio tags. Leave blank to use default.', 'tm-arden' ),
	'section'         => $section,
	'priority'        => $priority++,
	'default'         => '',
	'active_callback' => array(
		array(
			'setting'  => 'single_portfolio_tags_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_comment_enable',
	'label'       => esc_html__( 'Comments', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display comments on single portfolio posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_share_enable',
	'label'       => esc_html__( 'Share', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display Share list on single portfolio posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_meta_view_enable',
	'label'       => esc_html__( 'View', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display View on single portfolio posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_portfolio_meta_like_enable',
	'label'       => esc_html__( 'Like', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display Like on single portfolio posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );
