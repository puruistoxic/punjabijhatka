<?php

class WPBakeryShortCode_TM_Counter extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$align = 'center';
		$skin  = $number_color = $custom_number_color = $text_color = $custom_text_color = $icon_color = $custom_icon_color = '';
		$tmp   = '';
		extract( $atts );

		$tmp .= "text-align: {$align}";

		if ( $skin === 'custom' ) {
			$number_tmp = $text_tmp = $icon_tmp = '';

			if ( $number_color === 'custom_color' ) {
				$number_tmp .= "color: $custom_number_color;";
			}

			if ( $number_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .number-wrap{ $number_tmp }";
			}

			if ( $text_color === 'custom_color' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .text{ $text_tmp }";
			}

			if ( $icon_color === 'custom_color' ) {
				$icon_tmp .= "color: $custom_icon_color;border-color: $custom_icon_color;";
			}

			if ( $icon_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .icon{ $icon_tmp }";
			}
		}

		$insight_shortcode_css .= "$selector { $tmp }";
		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Counter', 'tm-arden' ),
	        'base'                      => 'tm_counter',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-counter',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'type'        => 'dropdown',
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( '01', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'         => '1',
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
			                                                    'std'        => 'center',
		                                                    ),
		                                                    array(
			                                                    'type'        => 'dropdown',
			                                                    'heading'     => esc_html__( 'Skin', 'tm-arden' ),
			                                                    'param_name'  => 'skin',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Dark', 'tm-arden' )   => 'dark',
				                                                    esc_html__( 'Light', 'tm-arden' )  => 'light',
				                                                    esc_html__( 'Custom', 'tm-arden' ) => 'custom',
			                                                    ),
			                                                    'std'         => 'dark',
		                                                    ),
		                                                    array(
			                                                    'type'             => 'dropdown',
			                                                    'heading'          => esc_html__( 'Number Color', 'tm-arden' ),
			                                                    'param_name'       => 'number_color',
			                                                    'value'            => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			                                                    ),
			                                                    'std'              => 'primary_color',
			                                                    'dependency'       => array(
				                                                    'element' => 'skin',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'type'        => 'colorpicker',
			                                                    'heading'     => esc_html__( 'Custom Number Color', 'tm-arden' ),
			                                                    'param_name'  => 'custom_number_color',
			                                                    'description' => esc_html__( 'Controls the color of number.', 'tm-arden' ),
			                                                    'dependency'  => array(
				                                                    'element' => 'number_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'type'       => 'dropdown',
			                                                    'heading'    => esc_html__( 'Text Color', 'tm-arden' ),
			                                                    'param_name' => 'text_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			                                                    ),
			                                                    'std'        => 'custom_color',
			                                                    'dependency' => array(
				                                                    'element' => 'skin',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'type'        => 'colorpicker',
			                                                    'heading'     => esc_html__( 'Custom Text Color', 'tm-arden' ),
			                                                    'param_name'  => 'custom_text_color',
			                                                    'description' => esc_html__( 'Controls the color of text.', 'tm-arden' ),
			                                                    'dependency'  => array(
				                                                    'element' => 'text_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'         => '#a9a9a9',
		                                                    ),
		                                                    array(
			                                                    'type'       => 'dropdown',
			                                                    'heading'    => esc_html__( 'Icon Color', 'tm-arden' ),
			                                                    'param_name' => 'icon_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			                                                    ),
			                                                    'std'        => 'custom_color',
			                                                    'dependency' => array(
				                                                    'element' => 'skin',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'type'        => 'colorpicker',
			                                                    'heading'     => esc_html__( 'Custom Icon Color', 'tm-arden' ),
			                                                    'param_name'  => 'custom_icon_color',
			                                                    'description' => esc_html__( 'Controls the color of icon.', 'tm-arden' ),
			                                                    'dependency'  => array(
				                                                    'element' => 'icon_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'         => '#a9a9a9',
		                                                    ),
		                                                    array(
			                                                    'group'       => esc_html__( 'Data', 'tm-arden' ),
			                                                    'heading'     => esc_html__( 'Number', 'tm-arden' ),
			                                                    'type'        => 'number',
			                                                    'admin_label' => true,
			                                                    'param_name'  => 'number',
		                                                    ),
		                                                    array(
			                                                    'group'       => esc_html__( 'Data', 'tm-arden' ),
			                                                    'heading'     => esc_html__( 'Number Prefix', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Prefix your number with a symbol or text.', 'tm-arden' ),
			                                                    'type'        => 'textfield',
			                                                    'admin_label' => true,
			                                                    'param_name'  => 'number_prefix',
		                                                    ),
		                                                    array(
			                                                    'group'       => esc_html__( 'Data', 'tm-arden' ),
			                                                    'heading'     => esc_html__( 'Number Suffix', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Suffix your number with a symbol or text.', 'tm-arden' ),
			                                                    'type'        => 'textfield',
			                                                    'admin_label' => true,
			                                                    'param_name'  => 'number_suffix',
		                                                    ),
		                                                    array(
			                                                    'group'       => esc_html__( 'Data', 'tm-arden' ),
			                                                    'type'        => 'textfield',
			                                                    'heading'     => esc_html__( 'Text', 'tm-arden' ),
			                                                    'admin_label' => true,
			                                                    'param_name'  => 'text',
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::icon_libraries( array( 'allow_none' => true ) ), Insight_VC::get_vc_spacing_tab() ),
        ) );
