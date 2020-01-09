<?php

add_filter( 'vc_autocomplete_tm_product_categories_items_category_callback', array(
	'WPBakeryShortCode_TM_Product_Categories',
	'autocomplete_category_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_product_categories_items_category_render', array(
	'WPBakeryShortCode_TM_Product_Categories',
	'autocomplete_category_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Product_Categories extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	function autocomplete_category_field_search( $search_string ) {
		$terms = get_terms( array(
			                    'taxonomy'   => 'product_cat',
			                    'hide_empty' => false,
			                    'search'     => $search_string,
		                    ) );

		$data = array();
		if ( ! empty( $terms ) || ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$data[] = array(
					'label' => $term->name,
					'value' => $term->slug,
				);
			}
		}

		return $data;
	}

	function autocomplete_category_field_render( $term ) {
		$term = get_term_by( 'slug', $term['value'], 'product_cat' );

		$data = false;
		if ( $term ) {
			$data = array(
				'label' => $term->name,
				'value' => $term->slug,
			);
		}

		return $data;
	}

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'     => esc_html__( 'Product Categories', 'tm-arden' ),
	        'base'     => 'tm_product_categories',
	        'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'     => 'tm-i tm-i-product-categories',
	        'params'   => array_merge( array(
		                                   array(
			                                   'heading'     => esc_html__( 'Categories Style', 'tm-arden' ),
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
			                                   'std'         => 30,
			                                   'min'         => 0,
			                                   'max'         => 100,
			                                   'step'        => 1,
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
					                                   'heading'            => esc_html__( 'Category', 'tm-arden' ),
					                                   'description'        => esc_html__( 'Enter category name.', 'tm-arden' ),
					                                   'type'               => 'autocomplete',
					                                   'param_name'         => 'category',
					                                   'settings'           => array(
						                                   'multiple'       => false,
						                                   'min_length'     => 1,
						                                   // In UI show results grouped by groups, default false.
						                                   'unique_values'  => true,
						                                   // In UI show results except selected. NB! You should manually check values in backend, default false.
						                                   'display_inline' => true,
						                                   // In UI show results inline view, default false (each value in own line).
						                                   'delay'          => 500,
						                                   // delay for search. default 500.
						                                   'auto_focus'     => true,
						                                   // auto focus input, default true.
					                                   ),
					                                   'param_holder_class' => 'vc_not-for-custom',
					                                   'admin_label'        => true,
				                                   ),
				                                   array(
					                                   'type'       => 'colorpicker',
					                                   'heading'    => esc_html__( 'Heading Color', 'tm-arden' ),
					                                   'param_name' => 'heading_color',
				                                   ),
			                                   ),
		                                   ),

	                                   ), Insight_VC::get_vc_spacing_tab() ),
        ) );
