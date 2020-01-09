<?php

class WPBakeryShortCode_TM_Popup_Video extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Popup Video', 'tm-arden' ),
	        'base'                      => 'tm_popup_video',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-video',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Poster Preview', 'tm-arden' )                      => 'poster',
				                                                    esc_html__( 'Button ( Use on Revolution slider )', 'tm-arden' ) => 'button',
			                                                    ),
			                                                    'std'         => 'poster',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Button Play Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'button_style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
				                                                    esc_html__( 'Style 02', 'tm-arden' ) => '2',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Video Url', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'video',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Poster Image', 'tm-arden' ),
			                                                    'type'       => 'attach_image',
			                                                    'param_name' => 'poster',
			                                                    'dependency' => array(
				                                                    'element' => 'style',
				                                                    'value'   => array( 'poster' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Poster Image Size', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Controls the size of poster image.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'image_size',
			                                                    'value'       => Insight_Helper::get_image_sizes(),
			                                                    'std'         => 'insight-popup-video-poster',
			                                                    'dependency'  => array(
				                                                    'element' => 'style',
				                                                    'value'   => array( 'poster' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Overlay Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'overlay_style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'None', 'tm-arden' )     => '',
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'         => '1',
			                                                    'dependency'  => array(
				                                                    'element' => 'style',
				                                                    'value'   => array( 'poster' ),
			                                                    ),
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
