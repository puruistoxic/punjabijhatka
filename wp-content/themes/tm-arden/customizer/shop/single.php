<?php
$section  = 'shop_single';
$priority = 1;
$prefix   = 'single_product_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'single_product_title_bar_enable',
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
	'settings'    => 'single_product_categories_enable',
	'label'       => esc_html__( 'Categories', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the categories.', 'tm-arden' ),
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
	'settings'    => 'single_product_tags_enable',
	'label'       => esc_html__( 'Tags', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the tags.', 'tm-arden' ),
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
	'settings'    => 'single_product_sharing_enable',
	'label'       => esc_html__( 'Sharing', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the sharing.', 'tm-arden' ),
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
	'settings'    => 'single_product_up_sells_enable',
	'label'       => esc_html__( 'Up-sells products', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the up-sells products section.', 'tm-arden' ),
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
	'settings'    => 'single_product_related_enable',
	'label'       => esc_html__( 'Related products', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to display the related products section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'Off', 'tm-arden' ),
		'1' => esc_html__( 'On', 'tm-arden' ),
	),
) );
