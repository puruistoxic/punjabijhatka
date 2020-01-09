<?php

class WPBakeryShortCode_TM_Button_Group extends WPBakeryShortCodesContainer {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$tmp = '';

		if ( $atts['align'] !== '' ) {
			$tmp .= "text-align: {$atts['align']};";
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_css .= "$selector { $tmp }";
		}
	}
}

vc_map( array(
	        'name'                    => esc_html__( 'Button Group', 'tm-arden' ),
	        'base'                    => 'tm_button_group',
	        'as_parent'               => array( 'only' => 'tm_button' ),
	        // Use only|except attributes to limit child shortcodes (separate multiple values with comma).
	        'content_element'         => true,
	        'show_settings_on_create' => false,
	        'is_container'            => true,
	        'category'                => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                    => 'tm-i tm-i-divider',
	        'params'                  => array(
		        // add params same as with any other content element.
		        array(
			        'heading'    => esc_html__( 'Align', 'tm-arden' ),
			        'type'       => 'dropdown',
			        'param_name' => 'align',
			        'value'      => array(
				        esc_html__( 'Default', 'tm-arden' ) => '',
				        esc_html__( 'Left', 'tm-arden' )    => 'left',
				        esc_html__( 'Center', 'tm-arden' )  => 'center',
				        esc_html__( 'Right', 'tm-arden' )   => 'right',
			        ),
			        'std'        => '',
		        ),
		        Insight_VC::extra_class_field(),
	        ),
	        'js_view'                 => 'VcColumnView',
        ) );

