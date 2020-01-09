<?php

$styling_tab = esc_html__( 'Styling', 'tm-arden' );

vc_remove_param( 'vc_row_inner', 'css' );
vc_remove_param( 'vc_row', 'gap' );

vc_add_params( 'vc_row_inner', array_merge( Insight_VC::get_vc_spacing_tab(), array(
	array(
		'heading'     => esc_html__( 'Gutter', 'tm-arden' ),
		'type'        => 'number_responsive',
		'param_name'  => 'gutter',
		'min'         => 0,
		'max'         => 100,
		'step'        => 2,
		'suffix'      => 'px',
		'media_query' => array(
			'lg' => '',
			'md' => '',
			'sm' => '',
			'xs' => '',
		),
	),
	array(
		'heading'     => esc_html__( 'Width', 'tm-arden' ),
		'description' => esc_html__( 'Input the width for this row.', 'tm-arden' ),
		'type'        => 'textfield',
		'param_name'  => 'max_width',
	),
	array(
		'heading'    => esc_html__( 'Inner row Alignment Large Device', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'content_alignment',
		'value'      => array(
			esc_html__( 'Left', 'tm-arden' )   => 'left',
			esc_html__( 'Center', 'tm-arden' ) => 'center',
			esc_html__( 'Right', 'tm-arden' )  => 'right',
		),
		'std'        => 'left',
	),
	array(
		'heading'    => esc_html__( 'Inner row Alignment Medium Device', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'md_content_alignment',
		'value'      => array(
			esc_html__( 'Inherit from larger device', 'tm-arden' ) => '',
			esc_html__( 'Left', 'tm-arden' )                       => 'left',
			esc_html__( 'Center', 'tm-arden' )                     => 'center',
			esc_html__( 'Right', 'tm-arden' )                      => 'right',
		),
		'std'        => '',
	),
	array(
		'heading'    => esc_html__( 'Inner row Alignment Small Device', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'sm_content_alignment',
		'value'      => array(
			esc_html__( 'Inherit from larger device', 'tm-arden' ) => '',
			esc_html__( 'Left', 'tm-arden' )                       => 'left',
			esc_html__( 'Center', 'tm-arden' )                     => 'center',
			esc_html__( 'Right', 'tm-arden' )                      => 'right',
		),
		'std'        => '',
	),
	array(
		'heading'    => esc_html__( 'Inner row Alignment Extra Small Device', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'xs_content_alignment',
		'value'      => array(
			esc_html__( 'Inherit from larger device', 'tm-arden' ) => '',
			esc_html__( 'Left', 'tm-arden' )                       => 'left',
			esc_html__( 'Center', 'tm-arden' )                     => 'center',
			esc_html__( 'Right', 'tm-arden' )                      => 'right',
		),
		'std'        => '',
	),
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
		'group'      => $styling_tab,
		'heading'    => esc_html__( 'Scroll Effect', 'tm-arden' ),
		'type'       => 'dropdown',
		'param_name' => 'background_attachment',
		'value'      => array(
			esc_html__( 'Move with the content', 'tm-arden' ) => 'scroll',
			esc_html__( 'Fixed at its position', 'tm-arden' ) => 'fixed',
		),
		'std'        => 'scroll',
		'dependency' => array(
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
) ) );
