<?php
$param                                                       = WPBMap::getParam( 'vc_tta_tabs', 'color' );
$param['value'][ esc_html__( 'Primary Color', 'tm-arden' ) ] = 'primary';
vc_update_shortcode_param( 'vc_tta_tabs', $param );

vc_update_shortcode_param( 'vc_tta_tabs', array(
	'param_name' => 'style',
	'value'      => array(
		esc_html__( 'Arden 01', 'tm-arden' ) => 'arden-01',
		esc_html__( 'Arden 02', 'tm-arden' ) => 'arden-02',
		esc_html__( 'Arden 03', 'tm-arden' ) => 'arden-03',
		esc_html__( 'Classic', 'tm-arden' )  => 'classic',
		esc_html__( 'Modern', 'tm-arden' )   => 'modern',
		esc_html__( 'Flat', 'tm-arden' )     => 'flat',
		esc_html__( 'Outline', 'tm-arden' )  => 'outline',
	),
) );
