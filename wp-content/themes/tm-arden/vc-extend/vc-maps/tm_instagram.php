<?php

class WPBakeryShortCode_TM_Instagram extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		extract( $atts );

		if ( $gutter !== '' ) {
			$_gutter = $gutter / 2;
			$insight_shortcode_css .= "$selector .tm-instagram-pics{ margin: -{$_gutter}px; }";
			$insight_shortcode_css .= "$selector .item{ padding: {$_gutter}px; }";
		}

		$insight_shortcode_css .= $this->get_responsive_columns_css( "$selector .item", $number_columns );

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}

	public function get_responsive_columns_css( $element, $number_columns ) {
		$css = $lg_css = $md_css = $sm_css = $xs_css = '';

		if ( $number_columns !== '' ) {
			$arr = explode( ';', $number_columns );
			foreach ( $arr as $value ) {
				$key = explode( ':', $value );

				switch ( $key[0] ) {
					case 'xs':
						$xs_css .= "@media (max-width: 543px){ $element { width: calc( 100%  / {$key[1]} ) !important; }}";
						break;
					case 'sm':
						$sm_css .= "@media (max-width: 767px){ $element { width: calc( 100%  / {$key[1]} ) !important; }}";
						break;
					case 'md':
						$md_css .= "@media (max-width: 1199px){ $element { width: calc( 100%  / {$key[1]} ) !important; }}";
						break;
					case 'lg':
						$lg_css .= "$element { width: calc( 100%  / {$key[1]} );}";
						break;
					default:
						break;
				}
			}

			if ( $lg_css !== '' ) {
				$css .= $lg_css;
			}

			if ( $md_css !== '' ) {
				$css .= $md_css;
			}

			if ( $sm_css !== '' ) {
				$css .= $sm_css;
			}

			if ( $xs_css !== '' ) {
				$css .= $xs_css;
			}
		}

		return $css;
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Instagram', 'tm-arden' ),
	        'base'                      => 'tm_instagram',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-instagram',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'type'        => 'dropdown',
			                                                    'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                                    'param_name'  => 'style',
			                                                    'admin_label' => true,
			                                                    'value'       => array(
				                                                    esc_html__( '01', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'         => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'User Name', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'username',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Number of items', 'tm-arden' ),
			                                                    'type'       => 'number',
			                                                    'param_name' => 'number_items',
		                                                    ),
		                                                    array(
			                                                    'heading'     => esc_html__( 'Columns', 'tm-arden' ),
			                                                    'type'        => 'number_responsive',
			                                                    'param_name'  => 'number_columns',
			                                                    'min'         => 1,
			                                                    'max'         => 10,
			                                                    'step'        => 1,
			                                                    'suffix'      => 'column (s)',
			                                                    'media_query' => array(
				                                                    'lg' => '',
				                                                    'md' => '',
				                                                    'sm' => '',
				                                                    'xs' => '',
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Gutter', 'tm-arden' ),
			                                                    'type'       => 'number',
			                                                    'param_name' => 'gutter',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Show overlay likes and comments', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'overlay',
			                                                    'value'      => array( esc_html__( 'Yes', 'tm-arden' ) => '1' ),
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Open links in a new tab.', 'tm-arden' ),
			                                                    'type'       => 'checkbox',
			                                                    'param_name' => 'link_target',
			                                                    'value'      => array(
				                                                    esc_html__( 'Yes', 'tm-arden' ) => '1',
			                                                    ),
			                                                    'std'        => '1',
		                                                    ),
		                                                    array(
			                                                    'heading'    => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'heading',
			                                                    'std'        => esc_html__( 'From Instagram', 'tm-arden' ),
		                                                    ),
		                                                    Insight_VC::extra_class_field(),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),
        ) );
