<?php

class WPBakeryShortCode_TM_Info_Boxes extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'tm-arden' );

vc_map( array(
	        'name'     => esc_html__( 'Info Boxes', 'tm-arden' ),
	        'base'     => 'tm_info_boxes',
	        'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'     => 'tm-i tm-i-info-boxes',
	        'params'   => array_merge( array(
		                                   array(
			                                   'heading'     => esc_html__( 'Info Boxes Style', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'param_name'  => 'style',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Grid Metro', 'tm-arden' ) => 'metro',
			                                   ),
			                                   'std'         => 'metro',
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
				                                   'lg' => '3',
				                                   'md' => '',
				                                   'sm' => '2',
				                                   'xs' => '1',
			                                   ),
			                                   'dependency'  => array(
				                                   'element' => 'style',
				                                   'value'   => array( 'metro' ),
			                                   ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Grid Gutter', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the gutter of grid.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'param_name'  => 'gutter',
			                                   'std'         => 0,
			                                   'min'         => 0,
			                                   'max'         => 100,
			                                   'step'        => 2,
			                                   'suffix'      => 'px',
			                                   'dependency'  => array(
				                                   'element' => 'style',
				                                   'value'   => array( 'metro' ),
			                                   ),
		                                   ),
		                                   Insight_VC::get_animation_field(),
		                                   Insight_VC::extra_class_field(),
		                                   array(

			                                   'group'      => esc_html__( 'Items', 'tm-arden' ),
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
				                                   array(
					                                   'heading'     => esc_html__( 'Skin', 'tm-arden' ),
					                                   'type'        => 'dropdown',
					                                   'param_name'  => 'skin',
					                                   'admin_label' => true,
					                                   'value'       => array(
						                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
						                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
					                                   ),
					                                   'std'         => 'primary',
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
			                                   ),
		                                   ),
	                                   ), Insight_VC::get_vc_spacing_tab() ),
        ) );

