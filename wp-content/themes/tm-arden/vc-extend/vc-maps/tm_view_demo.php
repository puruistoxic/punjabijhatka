<?php

class WPBakeryShortCode_TM_View_Demo extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	'name'                      => esc_html__( 'View Demo', 'tm-arden' ),
	'base'                      => 'tm_view_demo',
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
					'heading'    => esc_html__( 'Image', 'tm-arden' ),
					'type'       => 'attach_image',
					'param_name' => 'image',
				),
				array(
					'heading'     => esc_html__( 'Category', 'tm-arden' ),
					'description' => esc_html__( 'Multi categories separator with comma', 'tm-arden' ),
					'type'        => 'textfield',
					'param_name'  => 'category',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Badge', 'tm-arden' ),
					'type'       => 'dropdown',
					'param_name' => 'badge',
					'value'      => array(
						esc_html__( 'None', 'tm-arden' ) => '',
						esc_html__( 'New', 'tm-arden' )  => 'new',
					),
					'std'        => '',
				),
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );
