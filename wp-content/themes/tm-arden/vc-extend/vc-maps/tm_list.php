<?php

class WPBakeryShortCode_TM_List extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$marker_tmp  = '';
		$heading_tmp = '';
		$text_tmp    = '';

		if ( $atts['marker_color'] === 'custom_color' ) {
			$marker_tmp .= "color: {$atts['custom_marker_color']}; ";
		}

		if ( $marker_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .tm-list__marker{ $marker_tmp }";
		}

		if ( $atts['title_color'] === 'custom_color' ) {
			$heading_tmp .= "color: {$atts['custom_title_color']}; ";
		}

		if ( $heading_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .tm-list__title{ $heading_tmp }";
		}

		if ( $atts['desc_color'] === 'custom_color' ) {
			$text_tmp .= "color: {$atts['custom_desc_color']}; ";
		}

		if ( $text_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .tm-list__desc{ $text_tmp }";
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'List', 'tm-arden' ),
	        'base'                      => 'tm_list',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-list',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Select style for box icon.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'list_style',
			                                                    'value'       => array(
				                                                    esc_html__( 'Basic vertical list', 'tm-arden' )       => 'basic',
				                                                    esc_html__( 'Icon vertical list', 'tm-arden' )        => 'icon',
				                                                    esc_html__( 'Numbered vertical list', 'tm-arden' )    => 'vertical-numbered',
				                                                    esc_html__( '(Automatic) Numbered list', 'tm-arden' ) => 'auto-numbered',
				                                                    esc_html__( '(Manual) Numbered list', 'tm-arden' )    => 'manual-numbered',
			                                                    ),
			                                                    'admin_label' => true,
			                                                    'std'         => 'icon',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Alignment', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'alignment',
			                                                    'value'      => array(
				                                                    esc_html__( 'Vertical', 'tm-arden' )   => 'vertical',
				                                                    esc_html__( 'Horizontal', 'tm-arden' ) => 'horizontal',
			                                                    ),
			                                                    'std'        => 'horizontal',
			                                                    'dependency' => array(
				                                                    'element' => 'list_style',
				                                                    'value'   => array(
					                                                    'auto-numbered',
					                                                    'manual-numbered',
				                                                    ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Marker Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'marker_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Custom Marker Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'custom_marker_color',
			                                                    'dependency' => array(
				                                                    'element' => 'marker_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Title Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'title_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Custom Title Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'custom_title_color',
			                                                    'dependency' => array(
				                                                    'element' => 'title_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Description Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'desc_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Custom Description Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'custom_desc_color',
			                                                    'dependency' => array(
				                                                    'element' => 'desc_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
	                                                    ),

	                                                    Insight_VC::icon_libraries( array(
		                                                                                'admin_label' => false,
		                                                                                'allow_none'  => true,
		                                                                                'group'       => '',
		                                                                                'param_name'  => 'icon_type',
		                                                                                'dependency'  => array(
			                                                                                'element' => 'list_style',
			                                                                                'value'   => array( 'icon' ),
		                                                                                ),
	                                                                                ) ), Insight_VC::get_vc_spacing_tab(), array(
		                                                    Insight_VC::get_animation_field(),
		                                                    Insight_VC::extra_class_field(),
		                                                    array(
			                                                    'group'      => esc_html__( 'Items', 'tm-arden' ),
			                                                    'heading'    => esc_html__( 'Items', 'tm-arden' ),
			                                                    'type'       => 'param_group',
			                                                    'param_name' => 'items',
			                                                    'params'     => array_merge( array(
				                                                                                 array(
					                                                                                 'heading'     => esc_html__( 'Number', 'tm-arden' ),
					                                                                                 'type'        => 'textfield',
					                                                                                 'param_name'  => 'item_number',
					                                                                                 'admin_label' => true,
					                                                                                 'description' => esc_html__( 'Only work with List Type: (Manual) Numbered list.', 'tm-arden' ),
				                                                                                 ),
				                                                                                 array(
					                                                                                 'heading'     => esc_html__( 'Item title', 'tm-arden' ),
					                                                                                 'type'        => 'textfield',
					                                                                                 'param_name'  => 'item_title',
					                                                                                 'admin_label' => true,
				                                                                                 ),
				                                                                                 array(
					                                                                                 'heading'    => esc_html__( 'Link', 'tm-arden' ),
					                                                                                 'type'       => 'vc_link',
					                                                                                 'param_name' => 'link',
				                                                                                 ),
				                                                                                 array(
					                                                                                 'heading'     => esc_html__( 'Description', 'tm-arden' ),
					                                                                                 'type'        => 'textarea',
					                                                                                 'param_name'  => 'item_desc',
					                                                                                 'description' => esc_html__( 'Only work with List Type: (Automatic) & (Manual) Numbered list', 'tm-arden' ),
				                                                                                 ),
			                                                                                 ), Insight_VC::icon_libraries( array(
				                                                                                                                'admin_label' => false,
				                                                                                                                'allow_none'  => true,
			                                                                                                                ) ) ),

		                                                    ),

	                                                    ) ),
        ) );
