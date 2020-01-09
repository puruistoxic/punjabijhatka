<?php

class WPBakeryShortCode_TM_Testimonial extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$skin = $text_color = $custom_text_color = $name_color = $custom_name_color = $by_line_color = $custom_by_line_color = '';
		extract( $atts );

		if ( $skin === 'custom' ) {
			$text_tmp = $name_tmp = $by_line_tmp = '';

			if ( $text_color === 'custom_color' ) {
				$text_tmp .= "color: $custom_text_color;";
			}

			if ( $text_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .testimonial-desc{ $text_tmp }";
			}

			if ( $name_color === 'custom_color' ) {
				$name_tmp .= "color: $custom_name_color;";
			}

			if ( $name_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .testimonial-name{ $name_tmp }";
			}

			if ( $by_line_color === 'custom_color' ) {
				$by_line_tmp .= "color: $custom_by_line_color;";
			}

			if ( $by_line_tmp !== '' ) {
				$insight_shortcode_css .= "$selector .testimonial-by-line{ $by_line_tmp }";
			}
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Slider Options', 'tm-arden' );

vc_map( array(
	        'name'                      => esc_html__( 'Testimonials', 'tm-arden' ),
	        'base'                      => 'tm_testimonial',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-testimonials',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Style 1', 'tm-arden' ) => '1',
				                                                    esc_html__( 'Style 2', 'tm-arden' ) => '2',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Skin', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'skin',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( 'Default', 'tm-arden' ) => '',
				                                                    esc_html__( 'Custom', 'tm-arden' )  => 'custom',
			                                                    ),
			                                                    'std'         => '',
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
			                                                    'description' => esc_html__( 'Controls the color of testimonial text.', 'tm-arden' ),
			                                                    'dependency'  => array(
				                                                    'element' => 'text_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'         => '#a9a9a9',
		                                                    ),
		                                                    array(
			                                                    'type'       => 'dropdown',
			                                                    'heading'    => esc_html__( 'Name Color', 'tm-arden' ),
			                                                    'param_name' => 'name_color',
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
			                                                    'heading'     => esc_html__( 'Custom Name Color', 'tm-arden' ),
			                                                    'param_name'  => 'custom_name_color',
			                                                    'description' => esc_html__( 'Controls the color of name text.', 'tm-arden' ),
			                                                    'dependency'  => array(
				                                                    'element' => 'name_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'         => '#a9a9a9',
		                                                    ),
		                                                    array(
			                                                    'type'       => 'dropdown',
			                                                    'heading'    => esc_html__( 'By Line Color', 'tm-arden' ),
			                                                    'param_name' => 'by_line_color',
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
			                                                    'heading'     => esc_html__( 'Custom By Line Color', 'tm-arden' ),
			                                                    'param_name'  => 'custom_by_line_color',
			                                                    'description' => esc_html__( 'Controls the color of by line text.', 'tm-arden' ),
			                                                    'dependency'  => array(
				                                                    'element' => 'by_line_color',
				                                                    'value'   => array( 'custom_color' ),
			                                                    ),
			                                                    'std'         => '#a9a9a9',
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
		                                                    array(
			                                                    'group'       => esc_html__( 'Data Settings', 'tm-arden' ),
			                                                    'heading'     => esc_html__( 'Number', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Number of items to show.', 'tm-arden' ),
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
			                                                    'heading'    => esc_html__( 'Loop', 'tm-arden' ),
			                                                    'group'      => $carousel_group,
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'loop',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
			                                                    'std'        => '1',
		                                                    ),
		                                                    array(
			                                                    'group'       => $carousel_group,
			                                                    'heading'     => esc_html__( 'Auto Play', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'tm-arden' ),
			                                                    'type'        => 'number',
			                                                    'suffix'      => 'ms',
			                                                    'param_name'  => 'auto_play',
		                                                    ),
		                                                    array(
			                                                    'group'      => $carousel_group,
			                                                    'heading'    => esc_html__( 'Pagination', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'pagination',
			                                                    'value'      => array(
				                                                    esc_html__( 'None', 'tm-arden' )    => '',
				                                                    esc_html__( 'Style 1', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'group'      => $carousel_group,
			                                                    'heading'    => esc_html__( 'Navigation', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'nav',
			                                                    'value'      => array(
				                                                    esc_html__( 'None', 'tm-arden' )     => '',
				                                                    esc_html__( 'Style 01', 'tm-arden' ) => '1',
				                                                    esc_html__( 'Style 02', 'tm-arden' ) => '2',
			                                                    ),
			                                                    'std'        => '',
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
			                                                    'dependency' => array(
				                                                    'element' => 'style',
				                                                    'value'   => '1',
			                                                    ),
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
			                                                    'dependency'  => array(
				                                                    'element' => 'style',
				                                                    'value'   => '1',
			                                                    ),
		                                                    ),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
