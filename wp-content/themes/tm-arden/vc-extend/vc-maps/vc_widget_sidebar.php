<?php

vc_add_params( 'vc_widget_sidebar', array(
	array(
		'heading'    => esc_html__( 'Sidebar Position', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'sidebar_position',
		'value'      => array(
			esc_html__( 'Left', 'tm-arden' )  => 'left',
			esc_html__( 'Right', 'tm-arden' ) => 'right',
		),
		'std'        => 'right',
	),
) );
