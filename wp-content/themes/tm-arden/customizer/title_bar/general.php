<?php
$section  = 'title_bar';
$priority = 1;
$prefix   = 'title_bar_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'tm-arden' ),
	'description' => esc_html__( 'Enable this option to turn on page title bar section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of the page title bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-title-bar-inner',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'background_image',
	'description' => esc_html__( 'Select an image for the page title bar background. If left empty, the page title bar background color will be used.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
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
			'element' => '.page-title-bar-inner',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_overlay_color',
	'label'       => esc_html__( 'Background Overlay Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background overlay color when has background image of page title bar.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(24, 33, 65, 0.9)',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-overlay',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="big_title">' . esc_html__( 'Heading', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'kirki-typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Font Family', 'tm-arden' ),
	'description' => esc_html__( 'Controls the font family for the page title heading.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => array(
		'font-family'    => Insight::PRIMARY_FONT,
		'variant'        => '400',
		'line-height'    => '1.2',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'none',
	),
	'output'      => array(
		array(
			'element' => '.page-title-bar-heading .heading',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'heading_color',
	'label'       => esc_html__( 'Normal', 'tm-arden' ),
	'description' => esc_html__( 'Controls the text color of the page title fonts.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#fff',
	'output'      => array(
		array(
			'element'  => '.page-title-bar-heading .heading',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'search_title',
	'label'       => esc_html__( 'Search Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on search results page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Search results for: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'home_title',
	'label'       => esc_html__( 'Home Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text that displays on front latest posts page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_category_title',
	'label'       => esc_html__( 'Archive Category Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive category page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Category: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_tag_title',
	'label'       => esc_html__( 'Archive Tag Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive tag page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Tag: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_author_title',
	'label'       => esc_html__( 'Archive Author Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive author page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Author: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_year_title',
	'label'       => esc_html__( 'Archive Year Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive year page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Year: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_month_title',
	'label'       => esc_html__( 'Archive Month Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive month page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Month: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'archive_day_title',
	'label'       => esc_html__( 'Archive Day Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text prefix that displays on archive day page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Day: ', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_blog_title',
	'label'       => esc_html__( 'Single Blog Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text that displays on single blog posts. Leave blank to use post title.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'Blog', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => $prefix . 'single_portfolio_title',
	'label'       => esc_html__( 'Single Portfolio Heading', 'tm-arden' ),
	'description' => esc_html__( 'Enter text that displays on single portfolio pages. Leave blank to use portfolio title.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '',
) );
