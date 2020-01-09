<?php
add_filter( 'vc_autocomplete_tm_portfolio_filter_by_callback', array(
	'WPBakeryShortCode_TM_Portfolio',
	'autocomplete_taxonomies_field_search',
), 10, 1 );

add_filter( 'vc_autocomplete_tm_portfolio_filter_by_render', array(
	Insight_VC::instance(),
	'autocomplete_taxonomies_field_render',
), 10, 1 );

class WPBakeryShortCode_TM_Portfolio extends WPBakeryShortCode {

	/**
	 * @param $search_string
	 *
	 * @return array|bool
	 */
	public static function autocomplete_taxonomies_field_search( $search_string ) {
		$data = Insight_VC::instance()->autocomplete_get_data_from_post_type( $search_string, 'portfolio' );

		return $data;
	}

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'tm-arden' );

vc_map( array(
	'name'     => esc_html__( 'Portfolio', 'tm-arden' ),
	'base'     => 'tm_portfolio',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-portfoliogrid',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Portfolio Style', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'tm-arden' )         => '1',
				esc_html__( 'Grid Metro', 'tm-arden' )           => '2',
				esc_html__( 'Grid Masonry', 'tm-arden' )         => '3',
				esc_html__( 'Carousel Slider', 'tm-arden' )      => '4',
				esc_html__( 'Grid Justify Gallery', 'tm-arden' ) => '5',
				esc_html__( 'List Of Name', 'tm-arden' )         => '6',
			),
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Thumbnail Size', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'thumbnail_size',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '500x675', 'tm-arden' ) => 'insight-grid-classic',
				esc_html__( '600x463', 'tm-arden' ) => 'insight-grid-classic-2',
				esc_html__( '600x600', 'tm-arden' ) => 'insight-grid-classic-square',
			),
			'std'         => 'insight-grid-classic',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( '1', '4' ),
			),
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
				'value'   => array( '1', '2', '3' ),
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
				'value'   => array( '1', '2', '3', '5' ),
			),
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
				'value'   => array( '5' ),
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
				'value'   => array( '5' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Last row alignment', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'justify_last_row_alignment',
			'value'      => array(
				esc_html__( 'Justify', 'tm-arden' )                              => 'justify',
				esc_html__( 'Left', 'tm-arden' )                                 => 'nojustify',
				esc_html__( 'Center', 'tm-arden' )                               => 'center',
				esc_html__( 'Right', 'tm-arden' )                                => 'right',
				esc_html__( 'Hide ( if row can not be justified )', 'tm-arden' ) => 'hide',
			),
			'std'        => 'justify',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '5' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Overlay Style', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'None', 'tm-arden' )                       => 'none',
				esc_html__( 'Hover Dir', 'tm-arden' )                  => 'hover-dir',
				esc_html__( 'Image zoom - content below', 'tm-arden' ) => 'zoom',
				esc_html__( 'Faded', 'tm-arden' )                      => 'faded',
			),
			'std'         => 'faded',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( '1', '2', '3', '4', '5' ),
			),
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Auto Play', 'tm-arden' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'tm-arden' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array( 'element' => 'style', 'value' => '4' ),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Navigation', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => array(
				esc_html__( 'None', 'tm-arden' )     => '',
				esc_html__( 'Style 01', 'tm-arden' ) => '1',
			),
			'std'        => '',
			'dependency' => array( 'element' => 'style', 'value' => '4' ),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Pagination', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => array(
				esc_html__( 'None', 'tm-arden' )    => '',
				esc_html__( 'Style 1', 'tm-arden' ) => '1',
			),
			'std'        => '',
			'dependency' => array( 'element' => 'style', 'value' => '4' ),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Gutter', 'tm-arden' ),
			'type'       => 'number',
			'param_name' => 'carousel_gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
			'dependency' => array( 'element' => 'style', 'value' => '4' ),
		),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Items Display', 'tm-arden' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array( 'element' => 'style', 'value' => '4' ),
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-arden' ),
			'heading'     => esc_html__( 'Items per page', 'tm-arden' ),
			'description' => esc_html__( 'Number of items to show per page.', 'tm-arden' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => 9,
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'tm-arden' ),
			'heading'            => esc_html__( 'Narrow data source', 'tm-arden' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'tm-arden' ),
			'type'               => 'autocomplete',
			'param_name'         => 'taxonomies',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
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
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-arden' ),
			'heading'     => esc_html__( 'Order by', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'orderby',
			'value'       => array(
				esc_html__( 'Date', 'tm-arden' )                  => 'date',
				esc_html__( 'Post ID', 'tm-arden' )               => 'ID',
				esc_html__( 'Author', 'tm-arden' )                => 'author',
				esc_html__( 'Title', 'tm-arden' )                 => 'title',
				esc_html__( 'Last modified date', 'tm-arden' )    => 'modified',
				esc_html__( 'Post/page parent ID', 'tm-arden' )   => 'parent',
				esc_html__( 'Number of comments', 'tm-arden' )    => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'tm-arden' ) => 'menu_order',
				esc_html__( 'Meta value', 'tm-arden' )            => 'meta_value',
				esc_html__( 'Meta value number', 'tm-arden' )     => 'meta_value_num',
				esc_html__( 'Random order', 'tm-arden' )          => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'tm-arden' ),
			'std'         => 'date',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-arden' ),
			'heading'     => esc_html__( 'Sort order', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'order',
			'value'       => array(
				esc_html__( 'Descending', 'tm-arden' ) => 'DESC',
				esc_html__( 'Ascending', 'tm-arden' )  => 'ASC',
			),
			'description' => esc_html__( 'Select sorting order.', 'tm-arden' ),
			'std'         => 'DESC',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-arden' ),
			'heading'     => esc_html__( 'Meta key', 'tm-arden' ),
			'description' => esc_html__( 'Input meta key for grid ordering.', 'tm-arden' ),
			'type'        => 'textfield',
			'param_name'  => 'meta_key',
			'dependency'  => array(
				'element' => 'orderby',
				'value'   => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-arden' ),
			'heading'    => esc_html__( 'Filter Enable', 'tm-arden' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_enable',
			'value'      => array( esc_html__( 'Enable', 'tm-arden' ) => 1 ),
			'std'        => 1,
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '1', '2', '3', '4', '5' ),
			),
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-arden' ),
			'heading'    => esc_html__( 'Filter Style', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'filter_style',
			'value'      => array(
				esc_html__( 'Style 01', 'tm-arden' ) => '1',
				esc_html__( 'Style 02', 'tm-arden' ) => '2',
			),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '1', '2', '3', '4', '5' ),
			),
		),
		array(
			'group'              => esc_html__( 'Filter', 'tm-arden' ),
			'heading'            => esc_html__( 'Filter By', 'tm-arden' ),
			'description'        => esc_html__( 'Enter only categories that you want to show in filter or leave blank to show all.', 'tm-arden' ),
			'type'               => 'autocomplete',
			'param_name'         => 'filter_by',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
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
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-arden' ),
			'heading'    => esc_html__( 'Filter Counter', 'tm-arden' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_counter',
			'value'      => array( esc_html__( 'Enable', 'tm-arden' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '1', '2', '3', '4', '5' ),
			),
		),
		array(
			'group'       => esc_html__( 'Filter', 'tm-arden' ),
			'heading'     => esc_html__( 'Filter Grid Wrapper', 'tm-arden' ),
			'description' => esc_html__( 'Wrap filter into grid container.', 'tm-arden' ),
			'type'        => 'checkbox',
			'param_name'  => 'filter_wrap',
			'value'       => array( esc_html__( 'Enable', 'tm-arden' ) => '1' ),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( '1', '2', '3', '4', '5' ),
			),
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-arden' ),
			'heading'    => esc_html__( 'Filter Align', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'filter_align',
			'value'      => array(
				esc_html__( 'Left', 'tm-arden' )   => 'left',
				esc_html__( 'Center', 'tm-arden' ) => 'center',
				esc_html__( 'Right', 'tm-arden' )  => 'right',
			),
			'std'        => 'center',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( '1', '2', '3', '4', '5' ),
			),
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-arden' ),
			'heading'    => esc_html__( 'Pagination', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => array(
				esc_html__( 'No Pagination', 'tm-arden' ) => '',
				esc_html__( 'Button', 'tm-arden' )        => 'loadmore',
				esc_html__( 'Infinite', 'tm-arden' )      => 'infinite',
			),
			'std'        => '',
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-arden' ),
			'heading'    => esc_html__( 'Pagination Align', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination_align',
			'value'      => array(
				esc_html__( 'Left', 'tm-arden' )   => 'left',
				esc_html__( 'Center', 'tm-arden' ) => 'center',
				esc_html__( 'Right', 'tm-arden' )  => 'right',
			),
			'std'        => 'center',
			'dependency' => array(
				'element' => 'pagination',
				'value'   => array( 'pagination', 'loadmore', 'infinite' ),
			),
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-arden' ),
			'heading'    => esc_html__( 'Pagination Button Text', 'tm-arden' ),
			'type'       => 'textfield',
			'param_name' => 'pagination_button_text',
			'std'        => esc_html__( 'Load More', 'tm-arden' ),
			'dependency' => array(
				'element' => 'pagination',
				'value'   => 'loadmore',
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );

