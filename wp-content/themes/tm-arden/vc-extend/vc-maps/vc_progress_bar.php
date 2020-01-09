<?php

vc_remove_param( 'vc_progress_bar', 'bgcolor' );
vc_remove_param( 'vc_progress_bar', 'custombgcolor' );
vc_remove_param( 'vc_progress_bar', 'customtxtcolor' );
vc_remove_param( 'vc_progress_bar', 'values' );
vc_remove_param( 'vc_progress_bar', 'css' );

vc_add_params( 'vc_progress_bar', array_merge( array(
	array(
		'type'        => 'param_group',
		'heading'     => esc_html__( 'Values', 'tm-arden' ),
		'param_name'  => 'values',
		'description' => esc_html__( 'Enter values for graph - value, title and color.', 'tm-arden' ),
		'value'       => rawurlencode( wp_json_encode( array(
			array(
				'label' => esc_html__( 'Development', 'tm-arden' ),
				'value' => '90',
			),
			array(
				'label' => esc_html__( 'Design', 'tm-arden' ),
				'value' => '80',
			),
			array(
				'label' => esc_html__( 'Marketing', 'tm-arden' ),
				'value' => '70',
			),
		) ) ),
		'params'      => array(
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Label', 'tm-arden' ),
				'param_name'  => 'label',
				'description' => esc_html__( 'Enter text used as title of bar.', 'tm-arden' ),
				'admin_label' => true,
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Value', 'tm-arden' ),
				'param_name'  => 'value',
				'description' => esc_html__( 'Enter value of bar.', 'tm-arden' ),
				'admin_label' => true,
			),
			array(
				'heading'    => esc_html__( 'Background Color', 'tm-arden' ),
				'type'       => 'dropdown',
				'param_name' => 'background_color',
				'value'      => array(
					esc_html__( 'Default', 'tm-arden' )         => '',
					esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
					esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
					esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Background Color', 'tm-arden' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_background_color',
				'dependency' => array(
					'element' => 'background_color',
					'value'   => array( 'custom_color' ),
				),
				'std'        => '#222',
			),
			array(
				'heading'    => esc_html__( 'Text Color', 'tm-arden' ),
				'type'       => 'dropdown',
				'param_name' => 'text_color',
				'value'      => array(
					esc_html__( 'Default', 'tm-arden' )         => '',
					esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
					esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
					esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
				),
				'std'        => '',
			),
			array(
				'heading'    => esc_html__( 'Custom Text Color', 'tm-arden' ),
				'type'       => 'colorpicker',
				'param_name' => 'custom_text_color',
				'dependency' => array(
					'element' => 'text_color',
					'value'   => array( 'custom_color' ),
				),
				'std'        => '#222',
			),
		),
	),
	array(
		'heading'     => esc_html__( 'Bar height', 'tm-arden' ),
		'description' => esc_html__( 'Controls the height of bar.', 'tm-arden' ),
		'type'        => 'number',
		'param_name'  => 'bar_height',
		'std'         => 4,
		'min'         => 1,
		'max'         => 50,
		'step'        => 1,
		'suffix'      => 'px',
	),
	array(
		'heading'    => esc_html__( 'Background Color', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
		),
		'std'        => 'custom_color',
	),
	array(
		'heading'    => esc_html__( 'Custom Background Color', 'tm-arden' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom_color' ),
		),
		'std'        => '#222',
	),
	array(
		'heading'    => esc_html__( 'Track Color', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'track_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
		),
		'std'        => 'custom_color',
	),
	array(
		'heading'    => esc_html__( 'Custom Track Color', 'tm-arden' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_track_color',
		'dependency' => array(
			'element' => 'track_color',
			'value'   => array( 'custom_color' ),
		),
		'std'        => '#f5f5f5',
	),
	array(
		'heading'    => esc_html__( 'Text Color', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'text_color',
		'value'      => array(
			esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
		),
		'std'        => 'custom_color',
	),
	array(
		'heading'    => esc_html__( 'Custom Text Color', 'tm-arden' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_text_color',
		'dependency' => array(
			'element' => 'text_color',
			'value'   => array( 'custom_color' ),
		),
		'std'        => '#222',
	),
), Insight_VC::get_vc_spacing_tab() ) );

vc_map_update( 'vc_progress_bar', array(
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-processbar',
) );
