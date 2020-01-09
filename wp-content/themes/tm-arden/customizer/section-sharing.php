<?php
$section  = 'social_sharing';
$priority = 1;
$prefix   = 'social_sharing_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'multicheck',
	'settings'    => $prefix . 'item_enable',
	'label'       => esc_attr__( 'Sharing Links', 'tm-arden' ),
	'description' => esc_html__( 'Check to the box to enable social share links.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array( 'facebook', 'twitter', 'linkedin', 'google_plus', 'tumblr', 'email' ),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'tm-arden' ),
		'twitter'     => esc_attr__( 'Twitter', 'tm-arden' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'tm-arden' ),
		'google_plus' => esc_attr__( 'Google+', 'tm-arden' ),
		'tumblr'      => esc_attr__( 'Tumblr', 'tm-arden' ),
		'email'       => esc_attr__( 'Email', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'sortable',
	'settings'    => $prefix . 'order',
	'label'       => esc_attr__( 'Order', 'tm-arden' ),
	'description' => esc_html__( 'Controls the order of social share links.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'facebook',
		'twitter',
		'google_plus',
		'tumblr',
		'linkedin',
		'email',
	),
	'choices'     => array(
		'facebook'    => esc_attr__( 'Facebook', 'tm-arden' ),
		'twitter'     => esc_attr__( 'Twitter', 'tm-arden' ),
		'google_plus' => esc_attr__( 'Google+', 'tm-arden' ),
		'tumblr'      => esc_attr__( 'Tumblr', 'tm-arden' ),
		'linkedin'    => esc_attr__( 'Linkedin', 'tm-arden' ),
		'email'       => esc_attr__( 'Email', 'tm-arden' ),
	),
) );
