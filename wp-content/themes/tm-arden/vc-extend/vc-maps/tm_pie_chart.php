<?php

class WPBakeryShortCode_TM_Pie_Chart extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Pie Chart', 'tm-arden' ),
	        'base'                      => 'tm_pie_chart',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-pie-chart',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array(
		        array(
			        'heading'     => esc_html__( 'Value', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the percent of chart.', 'tm-arden' ),
			        'type'        => 'number',
			        'param_name'  => 'chart_value',
			        'admin_label' => true,
		        ),
		        array(
			        'heading'     => esc_html__( 'Text', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the text display inside chart.', 'tm-arden' ),
			        'type'        => 'textfield',
			        'param_name'  => 'chart_text',
			        'admin_label' => true,
		        ),
		        array(
			        'heading'     => esc_html__( 'Description', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the text display below chart.', 'tm-arden' ),
			        'type'        => 'textfield',
			        'param_name'  => 'chart_desc',
			        'admin_label' => true,
		        ),
		        array(
			        'heading'     => esc_html__( 'Size', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the size of chart. Default: 200', 'tm-arden' ),
			        'type'        => 'number',
			        'param_name'  => 'size',
		        ),
		        array(
			        'heading'     => esc_html__( 'Line Width', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the line width of chart. Default: 5', 'tm-arden' ),
			        'type'        => 'number',
			        'param_name'  => 'line_width',
		        ),
		        array(
			        'heading'     => esc_html__( 'Track Width', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the track width of chart. Default: 5', 'tm-arden' ),
			        'type'        => 'number',
			        'param_name'  => 'track_width',
		        ),
		        array(
			        'heading'    => esc_html__( 'Bar Color', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'bar_color',
			        'value'      => array(
				        esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				        esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				        esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			        ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Custom Bar Color', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the color of bar', 'tm-arden' ),
			        'type'        => 'colorpicker',
			        'param_name'  => 'custom_bar_color',
			        'dependency'  => array( 'element' => 'bar_color', 'value' => array( 'custom_color' ) ),
		        ),
		        array(
			        'heading'    => esc_html__( 'Track Color', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'track_color',
			        'value'      => array(
				        esc_html__( 'Primary Color', 'tm-arden' )   => 'primary_color',
				        esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				        esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			        ),
			        'std'        => 'custom_color',
		        ),
		        array(
			        'heading'     => esc_html__( 'Custom Track Color', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the color of track for the bar', 'tm-arden' ),
			        'type'        => 'colorpicker',
			        'param_name'  => 'custom_track_color',
			        'dependency'  => array( 'element' => 'track_color', 'value' => array( 'custom_color' ) ),
			        'std'         => '#eee',
		        ),
	        ),
        ) );
