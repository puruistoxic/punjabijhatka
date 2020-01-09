<?php

class WPBakeryShortCode_TM_CountDown extends WPBakeryShortCode {
	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$skin = $number_color = $custom_number_color = $text_color = $custom_text_color = '';
		extract( $atts );

		if ( $skin === 'custom' ) {
			$number_tmp = $text_tmp = '';

			if ( $number_color === 'custom_color' ) {
				$number_tmp .= "color: $custom_number_color; border-color: $custom_number_color";
			}

			if ( $number_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .number{ $number_tmp }";
			}

			if ( $text_color === 'custom_color' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .text{ $text_tmp }";
			}
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Countdown', 'tm-arden' ),
	        'base'                      => 'tm_countdown',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-countdownclock',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( '01', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Skin', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'skin',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Custom', 'tm-arden' ) => 'custom',
				                                                    esc_html__( 'Dark', 'tm-arden' )   => 'dark',
				                                                    esc_html__( 'Light', 'tm-arden' )  => 'light',
			                                                    ),
			                                                    'std'         => 'dark',
		                                                    ),
		                                                    array(
			                                                    'type'             => 'dropdown',
			                                                    'heading'          => esc_html__( 'Number Color', 'tm-arden' ),
			                                                    'param_name'       => 'number_color',
			                                                    'value'            => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' ) => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' ) => 'primary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )  => 'custom_color',
			                                                    ),
			                                                    'std'              => 'primary_color',
			                                                    'edit_field_class' => 'vc_col-sm-4',
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
				                                                    esc_html__( 'Default Color', 'tm-arden' ) => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' ) => 'primary_color',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )  => 'custom_color',
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
			                                                    'heading'     => esc_html__( 'Date Time', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Date and time format (yyyy/mm/dd hh:mm).', 'tm-arden' ),
			                                                    'type'        => 'datetimepicker',
			                                                    'param_name'  => 'datetime',
			                                                    'value'       => '',
			                                                    'admin_label' => true,
			                                                    'settings'    => array(
				                                                    'minDate' => 0,
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'type'       => 'textfield',
			                                                    'heading'    => esc_html__( '"Days" text', 'tm-arden' ),
			                                                    'param_name' => 'days',
			                                                    'value'      => esc_attr( 'Days', 'tm-arden' ),
		                                                    ),
		                                                    array(
			                                                    'type'       => 'textfield',
			                                                    'heading'    => esc_html__( '"Hours" text', 'tm-arden' ),
			                                                    'param_name' => 'hours',
			                                                    'value'      => 'Hours',
		                                                    ),
		                                                    array(
			                                                    'type'       => 'textfield',
			                                                    'heading'    => esc_html__( '"Minutes" text', 'tm-arden' ),
			                                                    'param_name' => 'minutes',
			                                                    'value'      => esc_attr( 'Minutes', 'tm-arden' ),
		                                                    ),
		                                                    array(
			                                                    'type'       => 'textfield',
			                                                    'heading'    => esc_html__( '"Seconds" text', 'tm-arden' ),
			                                                    'param_name' => 'seconds',
			                                                    'value'      => esc_attr( 'Seconds', 'tm-arden' ),
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );

