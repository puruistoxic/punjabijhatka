<?php

class WPBakeryShortCode_TM_Drop_Cap extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Drop Cap', 'tm-arden' ),
	        'base'                      => 'tm_drop_cap',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-dropcap',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
				                                                    esc_html__( 'Style 02', 'tm-arden' ) => '2',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Text', 'tm-arden' ),
			                                                    'type'       => 'textarea',
			                                                    'param_name' => 'text',
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
