<?php

class WPBakeryShortCode_TM_Timeline extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Timeline', 'tm-arden' ),
	        'base'                      => 'tm_timeline',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-timeline',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array(
		        array(
			        'group'      => esc_html__( 'Items', 'tm-arden' ),
			        'heading'    => esc_html__( 'Items', 'tm-arden' ),
			        'type'       => 'param_group',
			        'param_name' => 'items',
			        'params'     => array(
				        array(
					        'heading'     => esc_html__( 'Title', 'tm-arden' ),
					        'type'        => 'textfield',
					        'param_name'  => 'title',
					        'admin_label' => true,
				        ),
				        array(
					        'heading'    => esc_html__( 'Text', 'tm-arden' ),
					        'type'       => 'textarea',
					        'param_name' => 'text',
				        ),
			        ),

		        ),
	        ),
        ) );
