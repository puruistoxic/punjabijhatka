<?php

class WPBakeryShortCode_TM_Pricing extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Pricing Table', 'tm-arden' ),
	        'base'                      => 'tm_pricing',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-pricing',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( '01', 'tm-arden' ) => '1',
				                                                    esc_html__( '02', 'tm-arden' ) => '2',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Featured', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Checked the box if you want make this item featured', 'tm-arden' ),
			                                                    'type'        => 'checkbox',
			                                                    'param_name'  => 'featured',
			                                                    'value'       => array( esc_html__( 'Yes', 'tm-arden' ) => 1 ),
			                                                    'std'         => 0,
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Image', 'tm-arden' ),
			                                                    'type'       => 'attach_image',
			                                                    'param_name' => 'image',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Title', 'tm-arden' ),
			                                                    'type'        => 'textfield',
			                                                    'admin_label' => true,
			                                                    'param_name'  => 'title',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Price', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'price',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Currency', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'currency',
			                                                    'value'      => '$',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Period', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'period',
			                                                    'value'      => 'per monthly',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Description', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Controls the text that display under price', 'tm-arden' ),
			                                                    'type'        => 'textarea',
			                                                    'param_name'  => 'desc',
		                                                    ),
		                                                    array(
			                                                    'type'       => 'vc_link',
			                                                    'heading'    => esc_html__( 'Button', 'tm-arden' ),
			                                                    'param_name' => 'button',
		                                                    ),
		                                                    Insight_VC::get_animation_field(),
		                                                    Insight_VC::extra_class_field(),
		                                                    array(
			                                                    'group'      => esc_html__( 'Items', 'tm-arden' ),
			                                                    'heading'    => esc_html__( 'Items', 'tm-arden' ),
			                                                    'type'       => 'param_group',
			                                                    'param_name' => 'items',
			                                                    'params'     => array(
				                                                    array(
					                                                    'heading'    => esc_html__( 'Icon', 'tm-arden' ),
					                                                    'type'       => 'iconpicker',
					                                                    'param_name' => 'icon',
					                                                    'settings'   => array(
						                                                    'emptyIcon'    => true,
						                                                    'iconsPerPage' => 4000,
					                                                    ),
					                                                    'value'      => '',
				                                                    ),
				                                                    array(
					                                                    'heading'     => esc_html__( 'Text', 'tm-arden' ),
					                                                    'type'        => 'textfield',
					                                                    'param_name'  => 'text',
					                                                    'admin_label' => true,
				                                                    ),
			                                                    ),
		                                                    ),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
