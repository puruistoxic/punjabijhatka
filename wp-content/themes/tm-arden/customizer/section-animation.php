<?php
$section  = 'animation';
$priority = 1;
$prefix   = 'animation_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'mobile_animation_enable',
	'label'       => esc_html__( 'Mobile Animation', 'tm-arden' ),
	'description' => esc_html__( 'Controls the css animations on mobile.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '0',
	'choices'     => array(
		'0' => esc_html__( 'None', 'tm-arden' ),
		'1' => esc_html__( 'Yes', 'tm-arden' ),
	),
) );
