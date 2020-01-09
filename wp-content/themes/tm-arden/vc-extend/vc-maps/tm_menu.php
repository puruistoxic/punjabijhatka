<?php

class WPBakeryShortCode_TM_Menu extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Restaurant Menu', 'tm-arden' ),
	        'base'                      => 'tm_menu',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-restaurant-menu',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Select style for menu.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'value'       => array(
				                                                    esc_html__( '01', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'admin_label' => true,
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'        => 'textfield',
			                                                    'param_name'  => 'heading',
			                                                    'admin_label' => true,
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
		                                                    array(
			                                                    'group'      => esc_html__( 'Items', 'tm-arden' ),
			                                                    'heading'    => esc_html__( 'Items', 'tm-arden' ),
			                                                    'type'       => 'param_group',
			                                                    'param_name' => 'items',
			                                                    'params'     => array(
				                                                    array(
					                                                    'heading'     => esc_html__( 'Item Title', 'tm-arden' ),
					                                                    'type'        => 'textfield',
					                                                    'param_name'  => 'title',
					                                                    'admin_label' => true,
				                                                    ),
				                                                    array(
					                                                    'heading'    => esc_html__( 'Item Description', 'tm-arden' ),
					                                                    'type'       => 'textarea',
					                                                    'param_name' => 'text',
				                                                    ),
				                                                    array(
					                                                    'heading'    => esc_html__( 'Item Price', 'tm-arden' ),
					                                                    'type'       => 'textfield',
					                                                    'param_name' => 'price',
				                                                    ),
			                                                    ),
		                                                    ),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
