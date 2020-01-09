<?php

$styling_tab = esc_html__( 'Styling', 'tm-arden' );

vc_remove_param( 'vc_column', 'css' );

vc_add_params( 'vc_column', array_merge( Insight_VC::get_vc_spacing_tab(), array(
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Border Radius', 'tm-arden' ),
		'description' => esc_html__( 'Ex: 5px or 50%', 'tm-arden' ),
		'type'        => 'textfield',
		'param_name'  => 'border_radius',
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Box Shadow', 'tm-arden' ),
		'description' => esc_html__( 'Ex: 0 20px 30px #ccc', 'tm-arden' ),
		'type'        => 'textfield',
		'param_name'  => 'box_shadow',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Color', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'background_color',
		'value'      => array(
			esc_html__( 'None', 'tm-arden' )            => '',
			esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
		),
		'std'        => '',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Custom Background Color', 'tm-arden' ),
		'type'       => 'colorpicker',
		'param_name' => 'custom_background_color',
		'dependency' => array(
			'element' => 'background_color',
			'value'   => array( 'custom_color' ),
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Image', 'tm-arden' ),
		'type'       => 'attach_image',
		'param_name' => 'background_image',
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Repeat', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'background_repeat',
		'value'      => array(
			esc_html__( 'No repeat', 'tm-arden' )         => 'no-repeat',
			esc_html__( 'Tile', 'tm-arden' )              => 'repeat',
			esc_html__( 'Tile Horizontally', 'tm-arden' ) => 'repeat-x',
			esc_html__( 'Tile Vertically', 'tm-arden' )   => 'repeat-y',
		),
		'std'        => 'no-repeat',
		'dependency' => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Background Size', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'background_size',
		'value'      => array(
			esc_html__( 'Auto', 'tm-arden' )    => 'auto',
			esc_html__( 'Cover', 'tm-arden' )   => 'cover',
			esc_html__( 'Contain', 'tm-arden' ) => 'contain',
		),
		'std'        => 'cover',
		'dependency' => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Background Position', 'tm-arden' ),
		'description' => esc_html__( 'Ex: left center', 'tm-arden' ),
		'type'        => 'textfield',
		'param_name'  => 'background_position',
		'dependency'  => array(
			'element'   => 'background_image',
			'not_empty' => true,
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Background Overlay', 'tm-arden' ),
		'description' => esc_html__( 'Choose an overlay background color.', 'tm-arden' ),
		'type'        => 'dropdown',
		'param_name'  => 'overlay_background',
		'value'       => array(
			esc_html__( 'None', 'tm-arden' )            => '',
			esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
			esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
			esc_html__( 'Custom Color', 'tm-arden' )    => 'overlay_custom_background',
		),
	),
	array(
		'group'       => $styling_tab,
		'heading'     => esc_html__( 'Custom Background Overlay', 'tm-arden' ),
		'description' => esc_html__( 'Choose an custom background color overlay.', 'tm-arden' ),
		'type'        => 'colorpicker',
		'param_name'  => 'overlay_custom_background',
		'std'         => '#000000',
		'dependency'  => array( 'element' => 'overlay_background', 'value' => array( 'overlay_custom_background' ) ),
	),
	array(
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Opacity', 'tm-arden' ),
		'type'       => 'number',
		'param_name' => 'overlay_opacity',
		'value'      => 100,
		'min'        => 0,
		'max'        => 100,
		'step'       => 1,
		'suffix'     => '%',
		'std'        => 80,
		'dependency' => array(
			'element'   => 'overlay_background',
			'not_empty' => true,
		),
	),
	array(
		'heading'     => esc_html__( 'Max Width', 'tm-arden' ),
		'description' => esc_html__( 'Controls the max width of the column on large device. For Ex: 570px.', 'tm-arden' ),
		'type'        => 'textfield',
		'param_name'  => 'max_width',
	),
) ) );
