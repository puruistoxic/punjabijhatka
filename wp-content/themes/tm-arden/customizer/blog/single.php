<?php
$section  = 'blog_single';
$priority = 1;
$prefix   = 'single_post_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_title_bar_enable',
	'label'       => esc_html__( 'Title Bar', 'tm-arden' ),
	'description' => esc_html__( 'Choose default to use setting from title bar section, choose on to force display title bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_feature_enable',
	'label'       => esc_html__( 'Featured Image', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display featured image on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_title_enable',
	'label'       => esc_html__( 'Post Title', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the post title.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_categories_enable',
	'label'       => esc_html__( 'Categories', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the categories on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_tags_enable',
	'label'       => esc_html__( 'Tags', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the tags on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_date_enable',
	'label'       => esc_html__( 'Post Meta Date', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the date on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_share_enable',
	'label'       => esc_html__( 'Post Sharing', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the social sharing on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_author_enable',
	'label'       => esc_html__( 'Author Info Box', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the author info box on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_pagination_enable',
	'label'       => esc_html__( 'Previous/Next Pagination', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the previous/next post pagination on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_related_enable',
	'label'       => esc_html__( 'Related', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display related posts on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'            => 'number',
	'settings'        => 'single_post_related_number_enable',
	'label'           => esc_html__( 'Number of related posts item', 'tm-arden' ),
	'section'         => $section,
	'priority'        => $priority ++,
	'default'         => 10,
	'choices'         => array(
		'min'  => 0,
		'max'  => 50,
		'step' => 1,
	),
	'active_callback' => array(
		array(
			'setting'  => 'single_post_related_enable',
			'operator' => '==',
			'value'    => '1',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_post_comment_enable',
	'label'       => esc_html__( 'Comments', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display comments on blog single posts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );
