<?php

class WPBakeryShortCode_TM_Button extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;
		$wrapper_tmp = '';
		$button_tmp  = $button_hover_tmp = '';

		if ( $atts['align'] !== '' ) {
			$wrapper_tmp .= "text-align: {$atts['align']};";
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

		if ( $atts['size'] === 'custom' ) {
			if ( $atts['width'] !== '' ) {
				$button_tmp .= "min-width: {$atts['width']}px;";
			}

			if ( $atts['height'] !== '' ) {
				$button_tmp .= "min-height: {$atts['height']}px;";
				if ( $atts['border_width'] !== '' ) {
					$_line_height = $atts['height'] - ( $atts['border_width'] * 2 );
					$button_tmp .= "line-height: {$_line_height}px;";
				}
			}
		}

		if ( $atts['color'] === 'custom' ) {
			if ( $atts['custom_button_bg_color'] !== '' ) {
				$button_tmp .= "background-color: {$atts['custom_button_bg_color']} !important;";
			}
			if ( $atts['custom_font_color'] !== '' ) {
				$button_tmp .= "color: {$atts['custom_font_color']};";
			}
			if ( $atts['custom_button_border_color'] !== '' ) {
				$button_tmp .= "border-color: {$atts['custom_button_border_color']} !important;";
			}
			// Hover.
			if ( $atts['custom_button_bg_color_hover'] !== '' ) {
				$button_hover_tmp .= "background-color: {$atts['custom_button_bg_color_hover']} !important;";
			}
			if ( $atts['custom_font_color_hover'] !== '' ) {
				$button_hover_tmp .= "color: {$atts['custom_font_color_hover']};";
			}
			if ( $atts['custom_button_border_color_hover'] !== '' ) {
				$button_hover_tmp .= "border-color: {$atts['custom_button_border_color_hover']} !important;";
			}
		}

		if ( $wrapper_tmp !== '' ) {
			$insight_shortcode_css .= "$selector { $wrapper_tmp }";
		}

		if ( $button_tmp !== '' ) {
			if ( $atts['style'] === '3' ) {
				$insight_shortcode_css .= "$selector .tm-button span { $button_tmp }";
			} else {
				$insight_shortcode_css .= "$selector .tm-button{ $button_tmp }";
			}
		}

		if ( $button_hover_tmp !== '' ) {
			if ( $atts['style'] === '3' ) {
				$insight_shortcode_css .= "$selector .tm-button:hover span { $button_hover_tmp }";
			} else {
				$insight_shortcode_css .= "$selector .tm-button:hover{ $button_hover_tmp }";
			}
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

vc_map( array(
	        'name'     => esc_html__( 'Button', 'tm-arden' ),
	        'base'     => 'tm_button',
	        'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'     => 'tm-i tm-i-button',
	        'params'   => array_merge( array(
		                                   array(
			                                   'heading'     => esc_html__( 'Style', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'param_name'  => 'style',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Flat', 'tm-arden' )          => '1',
				                                   esc_html__( 'Outline', 'tm-arden' )       => '2',
				                                   esc_html__( 'No background', 'tm-arden' ) => '3',
			                                   ),
			                                   'std'         => '1',
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Button Size', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'param_name'  => 'size',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Large', 'tm-arden' )       => 'lg',
				                                   esc_html__( 'Normal', 'tm-arden' )      => 'nm',
				                                   esc_html__( 'Small', 'tm-arden' )       => 'sm',
				                                   esc_html__( 'Extra small', 'tm-arden' ) => 'xs',
				                                   esc_html__( 'Custom', 'tm-arden' )      => 'custom',
			                                   ),
			                                   'std'         => 'nm',
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Width', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the width of button.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'suffix'      => 'px',
			                                   'param_name'  => 'width',
			                                   'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Height', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the height of button.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'suffix'      => 'px',
			                                   'param_name'  => 'height',
			                                   'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Border Width', 'tm-arden' ),
			                                   'description' => esc_html__( 'Controls the border width of button.', 'tm-arden' ),
			                                   'type'        => 'number',
			                                   'suffix'      => 'px',
			                                   'param_name'  => 'border_width',
			                                   'dependency'  => array( 'element' => 'size', 'value' => 'custom' ),
		                                   ),
		                                   array(
			                                   'heading'    => esc_html__( 'Button', 'tm-arden' ),
			                                   'type'       => 'vc_link',
			                                   'param_name' => 'button',
			                                   'value'      => esc_html__( 'Button', 'tm-arden' ),
		                                   ),
		                                   array(
			                                   'heading'    => esc_html__( 'Button Alignment', 'tm-arden' ),
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
			                                   'heading'    => esc_html__( 'Button Align on medium device', 'tm-arden' ),
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
			                                   'heading'    => esc_html__( 'Button Align on small device', 'tm-arden' ),
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
			                                   'heading'    => esc_html__( 'Button Align on extra small device', 'tm-arden' ),
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
			                                   'heading'    => esc_html__( 'Icon', 'tm-arden' ),
			                                   'type'       => 'iconpicker',
			                                   'param_name' => 'icon',
			                                   'settings'   => array(
				                                   'emptyIcon'    => true,
				                                   'iconsPerPage' => 4000,
			                                   ),
		                                   ),
		                                   array(
			                                   'heading'    => esc_html__( 'Icon Align', 'tm-arden' ),
			                                   'type'       => 'dropdown',
			                                   'param_name' => 'icon_align',
			                                   'value'      => array(
				                                   esc_html__( 'Left', 'tm-arden' )  => 'left',
				                                   esc_html__( 'Right', 'tm-arden' ) => 'right',
			                                   ),
			                                   'std'        => 'right',
			                                   'dependency' => array(
				                                   'element'   => 'icon',
				                                   'not_empty' => true,
			                                   ),
		                                   ),
		                                   array(
			                                   'heading'     => esc_html__( 'Smooth Scroll', 'tm-arden' ),
			                                   'description' => esc_html__( 'Make button smooth scroll on click.', 'tm-arden' ),
			                                   'type'        => 'checkbox',
			                                   'param_name'  => 'smooth_scroll',
		                                   ),
		                                   Insight_VC::get_animation_field(),
		                                   Insight_VC::extra_class_field(),
	                                   ),

		        // Color.
		                               array(
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Color', 'tm-arden' ),
			                                   'param_name'  => 'color',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => 'default',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Black', 'tm-arden' )     => 'black',
				                                   esc_html__( 'Grey', 'tm-arden' )      => 'grey',
				                                   esc_html__( 'White', 'tm-arden' )     => 'white',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
		                                   ),
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Background color', 'tm-arden' ),
			                                   'param_name'  => 'button_bg_color',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => '',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
			                                   'dependency'  => array(
				                                   'element' => 'color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'      => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'       => 'colorpicker',
			                                   'heading'    => esc_html__( 'Custom background color', 'tm-arden' ),
			                                   'param_name' => 'custom_button_bg_color',
			                                   'dependency' => array(
				                                   'element' => 'button_bg_color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Text color', 'tm-arden' ),
			                                   'param_name'  => 'font_color',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => '',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
			                                   'dependency'  => array(
				                                   'element' => 'color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'      => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'       => 'colorpicker',
			                                   'heading'    => esc_html__( 'Custom text color', 'tm-arden' ),
			                                   'param_name' => 'custom_font_color',
			                                   'dependency' => array(
				                                   'element' => 'font_color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Border color', 'tm-arden' ),
			                                   'param_name'  => 'button_border_color',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => '',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
			                                   'dependency'  => array(
				                                   'element' => 'color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'      => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'       => 'colorpicker',
			                                   'heading'    => esc_html__( 'Custom Border color', 'tm-arden' ),
			                                   'param_name' => 'custom_button_border_color',
			                                   'dependency' => array(
				                                   'element' => 'button_border_color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Background color (on hover)', 'tm-arden' ),
			                                   'param_name'  => 'button_bg_color_hover',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => '',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
			                                   'dependency'  => array(
				                                   'element' => 'color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'      => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'       => 'colorpicker',
			                                   'heading'    => esc_html__( 'Custom background color (on hover)', 'tm-arden' ),
			                                   'param_name' => 'custom_button_bg_color_hover',
			                                   'dependency' => array(
				                                   'element' => 'button_bg_color_hover',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Text color (on hover)', 'tm-arden' ),
			                                   'param_name'  => 'font_color_hover',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => '',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
			                                   'dependency'  => array(
				                                   'element' => 'color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'      => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'       => 'colorpicker',
			                                   'heading'    => esc_html__( 'Custom Text color (on hover)', 'tm-arden' ),
			                                   'param_name' => 'custom_font_color_hover',
			                                   'dependency' => array(
				                                   'element' => 'font_color_hover',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'       => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'        => 'dropdown',
			                                   'heading'     => esc_html__( 'Border color (on hover)', 'tm-arden' ),
			                                   'param_name'  => 'button_border_color_hover',
			                                   'admin_label' => true,
			                                   'value'       => array(
				                                   esc_html__( 'Default', 'tm-arden' )   => '',
				                                   esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                   esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                   esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			                                   ),
			                                   'std'         => 'default',
			                                   'dependency'  => array(
				                                   'element' => 'color',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
		                                   array(
			                                   'group'      => esc_html__( 'Color', 'tm-arden' ),
			                                   'type'       => 'colorpicker',
			                                   'heading'    => esc_html__( 'Custom Border color (on hover)', 'tm-arden' ),
			                                   'param_name' => 'custom_button_border_color_hover',
			                                   'dependency' => array(
				                                   'element' => 'button_border_color_hover',
				                                   'value'   => 'custom',
			                                   ),
		                                   ),
	                                   ),

		                               Insight_VC::get_vc_spacing_tab() ),
        ) );
