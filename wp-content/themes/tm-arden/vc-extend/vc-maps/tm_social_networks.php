<?php

class WPBakeryShortCode_TM_Social_Networks extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );
		$tmp = $link_tmp = $link_hover_color = '';

		if ( $custom_style === 'true' ) {
			$link_tmp .= "font-size: {$font_size}px;";
		}

		if ( $skin === 'custom' ) {
			if ( $custom_link_color !== '' ) {
				$link_tmp .= "color: {$custom_link_color};";
			}

			if ( $custom_link_hover_color !== '' ) {
				$link_hover_color .= "color: {$custom_link_hover_color};";
			}
		}

		if ( $atts['align'] !== '' ) {
			$tmp .= "text-align: {$atts['align']};";
		}

		if ( $atts['md_align'] !== '' ) {
			$insight_shortcode_md_css .= "$selector { text-align: {$atts['md_align']} }";
		}

		if ( $atts['sm_align'] !== '' ) {
			$insight_shortcode_sm_css .= "$selector { text-align: {$atts['sm_align']} }";
		}

		if ( $atts['xs_align'] !== '' ) {
			$insight_shortcode_xs_css .= "$selector { text-align: {$atts['xs_align']} }";
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_css .= "$selector{ $tmp }";
		}

		if ( $link_tmp !== '' ) {
			$insight_shortcode_css .= "$selector a{ $link_tmp }";
		}

		if ( $link_hover_color !== '' ) {
			$insight_shortcode_css .= "$selector a:hover{ $link_hover_color }";
		}
	}
}

vc_map( array(
	        'name'                      => esc_html__( 'Social Networks', 'tm-arden' ),
	        'base'                      => 'tm_social_networks',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-social-networks',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array(
		        array(
			        'heading'     => esc_html__( 'Style', 'tm-arden' ),
			        'type'        => 'dropdown',
			        'param_name'  => 'style',
			        'admin_label' => true,
			        'value'       => array(
				        esc_html__( 'Icons', 'tm-arden' ) => 'icons',
				        esc_html__( 'Title', 'tm-arden' ) => 'title',
			        ),
			        'std'         => 'icons',
		        ),
		        array(
			        'heading'     => esc_html__( 'Skin', 'tm-arden' ),
			        'type'        => 'dropdown',
			        'param_name'  => 'skin',
			        'admin_label' => true,
			        'value'       => array(
				        esc_html__( 'Dark', 'tm-arden' )   => 'dark',
				        esc_html__( 'Light', 'tm-arden' )  => 'light',
				        esc_html__( 'Custom', 'tm-arden' ) => 'custom',
			        ),
			        'std'         => 'dark',
		        ),
		        array(
			        'heading'    => esc_html__( 'Custom Link Color', 'tm-arden' ),
			        'type'       => 'colorpicker',
			        'param_name' => 'custom_link_color',
			        'dependency' => array( 'element' => 'skin', 'value' => array( 'custom' ) ),
		        ),
		        array(
			        'heading'    => esc_html__( 'Custom Link Hover Color', 'tm-arden' ),
			        'type'       => 'colorpicker',
			        'param_name' => 'custom_link_hover_color',
			        'dependency' => array( 'element' => 'skin', 'value' => array( 'custom' ) ),
		        ),
		        array(
			        'heading'    => esc_html__( 'Text Align', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'align',
			        'value'      => array(
				        esc_html__( 'Left', 'tm-arden' )   => 'left',
				        esc_html__( 'Center', 'tm-arden' ) => 'center',
				        esc_html__( 'Right', 'tm-arden' )  => 'right',
			        ),
			        'std'        => 'left',
		        ),
		        array(
			        'heading'    => esc_html__( 'Text Align on Medium Device', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'md_align',
			        'value'      => array(
				        esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				        esc_html__( 'Left', 'tm-arden' )                       => 'left',
				        esc_html__( 'Center', 'tm-arden' )                     => 'center',
				        esc_html__( 'Right', 'tm-arden' )                      => 'right',
			        ),
			        'std'        => '',
		        ),
		        array(
			        'heading'    => esc_html__( 'Text Align on Small Device', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'sm_align',
			        'value'      => array(
				        esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				        esc_html__( 'Left', 'tm-arden' )                       => 'left',
				        esc_html__( 'Center', 'tm-arden' )                     => 'center',
				        esc_html__( 'Right', 'tm-arden' )                      => 'right',
			        ),
			        'std'        => '',
		        ),
		        array(
			        'heading'    => esc_html__( 'Text Align on Extra Small Device', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'xs_align',
			        'value'      => array(
				        esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				        esc_html__( 'Left', 'tm-arden' )                       => 'left',
				        esc_html__( 'Center', 'tm-arden' )                     => 'center',
				        esc_html__( 'Right', 'tm-arden' )                      => 'right',
			        ),
			        'std'        => '',
		        ),
		        array(
			        'heading'    => esc_html__( 'Open link in a new tab.', 'tm-arden' ),
			        'type'       => 'checkbox',
			        'param_name' => 'target',
			        'value'      => array(
				        esc_html__( 'Yes', 'tm-arden' ) => 'true',
			        ),
			        'std'        => 'true',
		        ),
		        array(
			        'heading'    => esc_html__( 'Show tooltip as item title.', 'tm-arden' ),
			        'type'       => 'checkbox',
			        'param_name' => 'tooltip_enable',
			        'value'      => array(
				        esc_html__( 'Yes', 'tm-arden' ) => 'true',
			        ),
			        'std'        => 'true',
		        ),
		        array(
			        'heading'    => esc_html__( 'Custom style', 'tm-arden' ),
			        'type'       => 'checkbox',
			        'param_name' => 'custom_style',
			        'value'      => array(
				        esc_html__( 'Yes', 'tm-arden' ) => 'true',
			        ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Font Size', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the font size of links', 'tm-arden' ),
			        'type'        => 'number',
			        'param_name'  => 'font_size',
			        'std'         => 20,
			        'min'         => 10,
			        'max'         => 100,
			        'step'        => 1,
			        'suffix'      => 'px',
			        'dependency'  => array(
				        'element' => 'custom_style',
				        'value'   => array( 'true' ),
			        ),
		        ),

		        array(
			        'heading'    => esc_html__( 'Items', 'tm-arden' ),
			        'type'       => 'param_group',
			        'param_name' => 'items',
			        'params'     => array_merge( array(
				                                     array(
					                                     'heading'     => esc_html__( 'Title', 'tm-arden' ),
					                                     'type'        => 'textfield',
					                                     'param_name'  => 'title',
					                                     'admin_label' => true,
				                                     ),
				                                     array(
					                                     'heading'    => esc_html__( 'Link', 'tm-arden' ),
					                                     'type'       => 'textfield',
					                                     'param_name' => 'link',
				                                     ),
			                                     ), // Icon.
			                                     Insight_VC::icon_libraries( array(
				                                                                 'element' => 'add_icon',
				                                                                 'value'   => 'true',
			                                                                 ), false, true ) ),

			        'value' => rawurlencode( wp_json_encode( array(
				                                                 array(
					                                                 'title'            => esc_html__( 'Facebook', 'tm-arden' ),
					                                                 'link'             => '#',
					                                                 'type'             => 'fontawesome',
					                                                 'icon_fontawesome' => 'fa fa-facebook',
				                                                 ),
				                                                 array(
					                                                 'title'            => esc_html__( 'Twitter', 'tm-arden' ),
					                                                 'link'             => '#',
					                                                 'type'             => 'fontawesome',
					                                                 'icon_fontawesome' => 'fa fa-twitter',
				                                                 ),
				                                                 array(
					                                                 'title'            => esc_html__( 'Behance', 'tm-arden' ),
					                                                 'link'             => '#',
					                                                 'type'             => 'fontawesome',
					                                                 'icon_fontawesome' => 'fa fa-behance',
				                                                 ),
				                                                 array(
					                                                 'title'            => esc_html__( 'Dribbble', 'tm-arden' ),
					                                                 'link'             => '#',
					                                                 'type'             => 'fontawesome',
					                                                 'icon_fontawesome' => 'fa fa-dribbble',
				                                                 ),
				                                                 array(
					                                                 'title'            => esc_html__( 'Pinterest', 'tm-arden' ),
					                                                 'link'             => '#',
					                                                 'type'             => 'fontawesome',
					                                                 'icon_fontawesome' => 'fa fa-pinterest-p',
				                                                 ),
			                                                 ) ) ),

		        ),
		        Insight_VC::extra_class_field(),
	        ),
        ) );
