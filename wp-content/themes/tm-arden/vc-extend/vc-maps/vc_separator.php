<?php

vc_add_params( 'vc_separator', array(
	array(
		'heading'     => esc_html__( 'Position', 'tm-arden' ),
		'description' => esc_html__( 'Make the separator position absolute with column', 'tm-arden' ),
		'type'        => 'dropdown',
		'param_name'  => 'position',
		'value'       => array(
			esc_html__( 'None', 'tm-arden' )   => '',
			esc_html__( 'Top', 'tm-arden' )    => 'top',
			esc_html__( 'Bottom', 'tm-arden' ) => 'bottom',
		),
		'std'         => '',
	),
) );
