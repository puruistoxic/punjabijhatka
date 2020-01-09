<?php

class WPBakeryShortCode_TM_View_Demo_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'View Demo Icon', 'tm-arden' ),
	'base'                      => 'tm_view_demo_icon',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-iconbox',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		Insight_VC::extra_class_field(),
		array(
			'group'      => esc_html__( 'Items', 'tm-arden' ),
			'heading'    => esc_html__( 'Items', 'tm-arden' ),
			'type'       => 'param_group',
			'param_name' => 'items',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Page', 'tm-arden' ),
					'type'        => 'autocomplete',
					'param_name'  => 'pages',
					'admin_label' => true,
				),
				array(
					'type'        => 'iconpicker',
					'heading'     => esc_html__( 'Icon', 'tm-arden' ),
					'param_name'  => 'icon_linea',
					'value'       => 'icon-basic-accelerator',
					'settings'    => array(
						'emptyIcon'    => true,
						'type'         => 'linea',
						'iconsPerPage' => 400,
					),
					'description' => esc_html__( 'Select icon from library.', 'tm-arden' ),
				),
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );
