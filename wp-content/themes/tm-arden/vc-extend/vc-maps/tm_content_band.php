<?php

class WPBakeryShortCode_TM_Content_Band extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$tmp = '';
		$tmp .= "text-align: {$atts['align']};";

		if ( $tmp !== '' ) {
			$insight_shortcode_css .= "$selector{ $tmp }";
		}

		if ( $atts['tablet_align'] !== '' ) {
			$insight_shortcode_css .= Insight_VC::get_media_query_css( $selector, 'text-align', $atts['tablet_align'], 'max-width: 767px' );
		}

		if ( $atts['mobile_align'] !== '' ) {
			$insight_shortcode_css .= Insight_VC::get_media_query_css( $selector, 'text-align', $atts['mobile_align'], 'max-width: 543px' );
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Content Band', 'tm-arden' ),
	        'base'                      => 'tm_content_band',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-content-band',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Select style for content band.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'value'       => array(
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'admin_label' => true,
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Image', 'tm-arden' ),
			                                                    'type'       => 'attach_image',
			                                                    'param_name' => 'image',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'        => 'textfield',
			                                                    'param_name'  => 'heading',
			                                                    'admin_label' => true,
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Text', 'tm-arden' ),
			                                                    'type'       => 'textarea',
			                                                    'param_name' => 'text',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Text Align', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'align',
			                                                    'value'      => array(
				                                                    esc_html__( 'Left', 'tm-arden' )   => 'left',
				                                                    esc_html__( 'Center', 'tm-arden' ) => 'center',
				                                                    esc_html__( 'Right', 'tm-arden' )  => 'right',
			                                                    ),
			                                                    'std'        => 'left',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Text Align on Tablet', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'tablet_align',
			                                                    'value'      => array(
				                                                    esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				                                                    esc_html__( 'Left', 'tm-arden' )                       => 'left',
				                                                    esc_html__( 'Center', 'tm-arden' )                     => 'center',
				                                                    esc_html__( 'Right', 'tm-arden' )                      => 'right',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Text Align on Mobile', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'mobile_align',
			                                                    'value'      => array(
				                                                    esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				                                                    esc_html__( 'Left', 'tm-arden' )                       => 'left',
				                                                    esc_html__( 'Center', 'tm-arden' )                     => 'center',
				                                                    esc_html__( 'Right', 'tm-arden' )                      => 'right',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    Insight_VC::get_animation_field(),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),

        ) );
