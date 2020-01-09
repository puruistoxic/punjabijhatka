<?php
$section  = 'search_page';
$priority = 1;
$prefix   = 'search_page_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'search_page_filter',
	'label'       => esc_html__( 'Search Results Filter', 'tm-arden' ),
	'description' => esc_html__( 'Controls the type of content that displays in search results.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'all',
	'choices'     => array(
		'all'       => esc_html__( 'All Post Types and Pages', 'tm-arden' ),
		'page'      => esc_html__( 'Only Pages', 'tm-arden' ),
		'post'      => esc_html__( 'Only Blog Posts', 'tm-arden' ),
		'portfolio' => esc_html__( 'Only Portfolio Items', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'number',
	'settings'    => 'search_page_number_results',
	'label'       => esc_html__( 'Number of Search Results Per Page', 'tm-arden' ),
	'description' => esc_html__( 'Controls the number of search results per page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 10,
	'choices'     => array(
		'min'  => 1,
		'max'  => 100,
		'step' => 1,
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'search_page_search_form_display',
	'label'       => esc_html__( 'Search Form Display', 'tm-arden' ),
	'description' => esc_html__( 'Controls the display of the search form on the search results page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'disabled',
	'choices'     => array(
		'below'    => esc_html__( 'Below Result List', 'tm-arden' ),
		'above'    => esc_html__( 'Above Result List', 'tm-arden' ),
		'disabled' => esc_html__( 'Hide', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'search_page_no_results_text',
	'label'       => esc_html__( 'No Results Text', 'tm-arden' ),
	'description' => esc_html__( 'Enter the text that displays on search no results page.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'textarea',
	'settings'    => 'search_popup_text',
	'label'       => esc_html__( 'Search Popup Text', 'tm-arden' ),
	'description' => esc_html__( 'Enter the text that displays below search field in popup search.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => esc_html__( 'Hit enter to search or ESC to close', 'tm-arden' ),
) );
