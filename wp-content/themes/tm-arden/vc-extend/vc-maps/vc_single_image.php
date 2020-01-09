<?php

vc_add_params( 'vc_single_image', array(
	array(
		'heading'    => esc_html__( 'Full Width', 'tm-arden' ),
		'type'       => 'checkbox',
		'param_name' => 'full_width',
	),
	array(
		'heading'    => esc_html__( 'Alignment on Tablet', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'tablet_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
			esc_html__( 'Left', 'tm-arden' )                       => 'left',
			esc_html__( 'Center', 'tm-arden' )                     => 'center',
			esc_html__( 'Right', 'tm-arden' )                      => 'right',
		),
		'std'        => '',
	),
	array(
		'heading'    => esc_html__( 'Alignment on Mobile', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'mobile_align',
		'value'      => array(
			esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
			esc_html__( 'Left', 'tm-arden' )                       => 'left',
			esc_html__( 'Center', 'tm-arden' )                     => 'center',
			esc_html__( 'Right', 'tm-arden' )                      => 'right',
		),
		'std'        => '',
	),
) );
