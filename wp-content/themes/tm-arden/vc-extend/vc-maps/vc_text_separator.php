<?php

$param                                                     = WPBMap::getParam( 'vc_text_separator', 'i_type' );
$param['value'][ esc_html__( 'Pe Stroke 7', 'tm-arden' ) ] = 'pe7stroke';
$param['value'][ esc_html__( 'Linea', 'tm-arden' ) ]       = 'linea';
vc_update_shortcode_param( 'vc_text_separator', $param );

$attributes = array(
	array(
		'group'       => esc_html( 'Icon', 'tm-arden' ),
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Icon', 'tm-arden' ),
		'param_name'  => 'i_icon_pe7stroke',
		'value'       => 'pe-7s-album',
		'settings'    => array(
			'emptyIcon'    => true,
			'type'         => 'pe7stroke',
			'iconsPerPage' => 400,
		),
		'dependency'  => array(
			'element' => 'i_type',
			'value'   => 'pe7stroke',
		),
		'description' => esc_html__( 'Select icon from library.', 'tm-arden' ),
	),
	array(
		'group'       => esc_html( 'Icon', 'tm-arden' ),
		'type'        => 'iconpicker',
		'heading'     => esc_html__( 'Icon', 'tm-arden' ),
		'param_name'  => 'i_icon_linea',
		'value'       => 'icon-basic-accelerator',
		'settings'    => array(
			'emptyIcon'    => true,
			'type'         => 'linea',
			'iconsPerPage' => 400,
		),
		'dependency'  => array(
			'element' => 'i_type',
			'value'   => 'linea',
		),
		'description' => esc_html__( 'Select icon from library.', 'tm-arden' ),
	),
);

vc_add_params( 'vc_text_separator', $attributes );
