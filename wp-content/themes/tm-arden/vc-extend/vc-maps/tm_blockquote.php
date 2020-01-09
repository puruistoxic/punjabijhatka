<?php

class WPBakeryShortCode_TM_Blockquote extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Blockquote', 'tm-arden' ),
	        'base'                      => 'tm_blockquote',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-blockquote',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'type'        => 'dropdown',
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
				                                                    esc_html__( 'Style 02', 'tm-arden' ) => '2',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'type'        => 'dropdown',
			                                                    'heading'     => esc_html__( 'Skin', 'tm-arden' ),
			                                                    'param_name'  => 'skin',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Light', 'tm-arden' ) => 'light',
				                                                    esc_html__( 'Dark', 'tm-arden' )  => 'dark',
			                                                    ),
			                                                    'std'         => 'light',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'heading',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Text', 'tm-arden' ),
			                                                    'type'       => 'textarea',
			                                                    'param_name' => 'text',
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
