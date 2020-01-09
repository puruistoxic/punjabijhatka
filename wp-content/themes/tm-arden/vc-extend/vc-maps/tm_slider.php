<?php

class WPBakeryShortCode_TM_Slider extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$text_tmp = '';

		if ( isset( $atts['text_align'] ) && $atts['text_align'] !== '' ) {
			$text_tmp .= "text-align: {$atts['text_align']};";
		}

		if ( $text_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .swiper-slide { $text_tmp }";
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}

}

$slides_tab  = esc_html__( 'Slides', 'tm-arden' );
$styling_tab = esc_html__( 'Styling', 'tm-arden' );

vc_map( array(
	        'name'                      => esc_html__( 'Slider', 'tm-arden' ),
	        'base'                      => 'tm_slider',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-carousel',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'    => esc_html__( 'Image Size', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'image_size',
			                                                    'value'      => Insight_Helper::get_image_sizes(),
			                                                    'std'        => 'insight-slider-three-columns',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Auto Height', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'auto_height',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
			                                                    'std'        => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Loop', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'loop',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
			                                                    'std'        => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Auto Play', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'tm-arden' ),
			                                                    'type'        => 'number',
			                                                    'suffix'      => 'ms',
			                                                    'param_name'  => 'auto_play',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Equal Height', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'equal_height',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Vertically Center', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'v_center',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Navigation', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'nav',
			                                                    'value'      => array(
				                                                    esc_html__( 'None', 'tm-arden' )     => '',
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
				                                                    esc_html__( 'Style 02', 'tm-arden' ) => '2',
				                                                    esc_html__( 'Style 03', 'tm-arden' ) => '3',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Pagination', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'pagination',
			                                                    'value'      => array(
				                                                    esc_html__( 'None', 'tm-arden' )    => '',
				                                                    esc_html__( 'Style 1', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Gutter', 'tm-arden' ),
			                                                    'type'       => 'number',
			                                                    'param_name' => 'gutter',
			                                                    'std'        => 30,
			                                                    'min'        => 0,
			                                                    'max'        => 50,
			                                                    'step'       => 1,
			                                                    'suffix'     => 'px',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Items Display', 'tm-arden' ),
			                                                    'type'        => 'number_responsive',
			                                                    'param_name'  => 'items_display',
			                                                    'min'         => 1,
			                                                    'max'         => 10,
			                                                    'suffix'      => 'item (s)',
			                                                    'media_query' => array(
				                                                    'lg' => 3,
				                                                    'md' => 3,
				                                                    'sm' => 2,
				                                                    'xs' => 1,
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Full-width Image', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'fw_image',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
		                                                    array(

			                                                    'group'      => $slides_tab,
			                                                    'heading'    => esc_html__( 'Slides', 'tm-arden' ),
			                                                    'type'       => 'param_group',
			                                                    'param_name' => 'items',
			                                                    'params'     => array(
				                                                    array(
					                                                    'heading'     => esc_html__( 'Image', 'tm-arden' ),
					                                                    'type'        => 'attach_image',
					                                                    'param_name'  => 'image',
					                                                    'admin_label' => true,
				                                                    ),
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
				                                                    array(
					                                                    'heading'    => esc_html__( 'Link', 'tm-arden' ),
					                                                    'type'       => 'vc_link',
					                                                    'param_name' => 'link',
					                                                    'value'      => esc_html__( 'Link', 'tm-arden' ),
				                                                    ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'group'      => $styling_tab,
			                                                    'heading'    => esc_html__( 'Text Align', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'text_align',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default', 'tm-arden' ) => '',
				                                                    esc_html__( 'Left', 'tm-arden' )    => 'left',
				                                                    esc_html__( 'Center', 'tm-arden' )  => 'center',
				                                                    esc_html__( 'Right', 'tm-arden' )   => 'right',
				                                                    esc_html__( 'Justify', 'tm-arden' ) => 'justify',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
