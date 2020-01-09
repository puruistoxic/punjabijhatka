<?php

class WPBakeryShortCode_TM_Twitter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		extract( $atts );
		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Twitter', 'tm-arden' ),
	        'base'                      => 'tm_twitter',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-twitter',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'type'        => 'dropdown',
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Carousel', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Consumer Key', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'consumer_key',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Consumer Secret', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'consumer_secret',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Access Token', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'access_token',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Access Token Secret', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'access_token_secret',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Twitter Username', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'username',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Number of tweets', 'tm-arden' ),
			                                                    'type'       => 'number',
			                                                    'param_name' => 'number_items',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'heading',
			                                                    'std'        => esc_html__( 'From Twitter', 'tm-arden' ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Show date.', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'show_date',
			                                                    'value'      => array(
				                                                    esc_html__( 'Yes', 'tm-arden' ) => '1',
			                                                    ),
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
