<?php

class WPBakeryShortCode_TM_Gallery extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'     => esc_html__( 'Gallery', 'tm-arden' ),
	        'base'     => 'tm_gallery',
	        'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'     => 'tm-i tm-i-gallery',
	        'params'   => array_merge( array(
		                                   array(
			                                   'heading'     => esc_html__( 'Gallery Style', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'param_name'  => 'style',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Grid Classic', 'tm-arden' )    => '1',
				                                   esc_html__( 'Grid Masonry', 'tm-arden' )    => '2',
				                                   esc_html__( 'Justify Gallery', 'tm-arden' ) => '3',
				                                   esc_html__( 'Metro', 'tm-arden' )           => 'metro',
			                                   ),
			                                   'std'         => '1',
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Thumbnail Size', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'param_name'  => 'thumbnail_size',
			                                   'admin_label' => true,
			                                   'value'       => Insight_Helper::get_image_sizes(),
			                                   'std'         => 'insight-grid-classic-square',
			                                   'dependency'  => array( 'element' => 'style', 'value' => '1' ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Columns', 'tm-arden' ),
			                                   'type'        => 'number_responsive',
			                                   'param_name'  => 'columns',
			                                   'min'         => 1,
			                                   'max'         => 6,
			                                   'step'        => 1,
			                                   'suffix'      => '',
			                                   'media_query' => array(
				                                   'lg' => '4',
				                                   'md' => '',
				                                   'sm' => '2',
				                                   'xs' => '1',
			                                   ),
			                                   'dependency'  => array(
				                                   'element' => 'style',
				                                   'value'   => array( '1', '2', 'metro' ),
			                                   ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Grid Gutter', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the gutter of grid.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'param_name'  => 'gutter',
			                                   'std'         => 30,
			                                   'min'         => 0,
			                                   'max'         => 100,
			                                   'step'        => 1,
			                                   'suffix'      => 'px',
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Row Height', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the height of grid row.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'param_name'  => 'justify_row_height',
			                                   'std'         => 300,
			                                   'min'         => 50,
			                                   'max'         => 500,
			                                   'step'        => 10,
			                                   'suffix'      => 'px',
			                                   'dependency'  => array(
				                                   'element' => 'style',
				                                   'value'   => array( '3' ),
			                                   ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Max Row Height', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the max height of grid row. Leave blank or 0 keep it disabled.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'param_name'  => 'justify_max_row_height',
			                                   'std'         => 0,
			                                   'min'         => 0,
			                                   'max'         => 500,
			                                   'step'        => 10,
			                                   'suffix'      => 'px',
			                                   'dependency'  => array(
				                                   'element' => 'style',
				                                   'value'   => array( '3' ),
			                                   ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Last row alignment', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'param_name'  => 'justify_last_row_alignment',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Justify', 'tm-arden' )                              => 'justify',
				                                   esc_html__( 'Left', 'tm-arden' )                                 => 'nojustify',
				                                   esc_html__( 'Center', 'tm-arden' )                               => 'center',
				                                   esc_html__( 'Right', 'tm-arden' )                                => 'right',
				                                   esc_html__( 'Hide ( if row can not be justified )', 'tm-arden' ) => 'hide',
			                                   ),
			                                   'std'         => 'justify',
			                                   'dependency'  => array(
				                                   'element' => 'style',
				                                   'value'   => array( '3' ),
			                                   ),
		                                   ),
		                                   Insight_VC::get_animation_field(),
		                                   Insight_VC::extra_class_field(),
		                                   array(

			                                   'group'      => esc_html__( 'Data Items', 'tm-arden' ),
			                                   'heading'    => esc_html__( 'Items', 'tm-arden' ),
			                                   'type'       => 'param_group',
			                                   'param_name' => 'items',
			                                   'params'     => array(
				                                   array(
					                                   'heading'     => esc_html__( 'Image', 'tm-arden' ),
					                                   'type'        => 'attach_image',
					                                   'param_name'  => 'image',
					                                   'admin_label' => true,
				                                   ),
			                                   ),
		                                   ),
	                                   ), Insight_VC::get_vc_spacing_tab() ),
        ) );

