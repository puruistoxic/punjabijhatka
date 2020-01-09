<?php

class WPBakeryShortCode_TM_Rotate_Box extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$front_tmp         = '';
		$front_heading_tmp = '';
		$front_text_tmp    = '';
		$back_tmp          = '';
		$back_heading_tmp  = '';
		$back_text_tmp     = '';
		
		if ( $atts['front_heading_color'] === 'custom' ) {
			$front_heading_tmp .= "color: {$atts['front_custom_heading_color']};";
		}

		if ( $atts['front_text_color'] === 'custom' ) {
			$front_text_tmp .= "color: {$atts['front_custom_text_color']};";
		}

		if ( $atts['back_heading_color'] === 'custom' ) {
			$back_heading_tmp .= "color: {$atts['back_custom_heading_color']};";
		}

		if ( $atts['back_text_color'] === 'custom' ) {
			$back_text_tmp .= "color: {$atts['back_custom_text_color']};";
		}

		if ( $atts['front_background_color'] === 'custom' ) {
			$front_tmp .= "background-color: {$atts['front_custom_background_color']};";
		} elseif ( $atts['front_background_color'] === 'gradient' ) {
			$front_tmp .= $atts['front_background_gradient'];
		}

		if ( $atts['front_background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['front_background_image'], 'full' );
			if ( $_url !== false ) {
				$front_tmp .= "background-image: url( $_url );";

				$front_tmp .= "background-size: cover; background-repeat: no-repeat;";
			}
		}

		if ( $atts['back_background_color'] === 'custom' ) {
			$back_tmp .= "background-color: {$atts['back_custom_background_color']};";
		} elseif ( $atts['back_background_color'] === 'gradient' ) {
			$back_tmp .= $atts['back_background_gradient'];
		}

		if ( $atts['back_background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['back_background_image'], 'full' );
			if ( $_url !== false ) {
				$back_tmp .= "background-image: url( $_url );";

				$back_tmp .= "background-size: cover; background-repeat: no-repeat;";
			}
		}

		if ( $front_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .front{ $front_tmp }";
		}

		if ( $front_heading_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .front .heading{ $front_heading_tmp }";
		}

		if ( $front_text_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .front .text{ $front_text_tmp }";
		}

		if ( $back_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .back{ $back_tmp }";
		}

		if ( $back_heading_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .back .heading{ $back_heading_tmp }";
		}

		if ( $back_text_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .back .text{ $back_text_tmp }";
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$front_tab = esc_html__( 'Front', 'tm-arden' );
$back_tab  = esc_html__( 'Back', 'tm-arden' );

vc_map( array(
	        'name'                      => esc_html__( 'Flip Box', 'tm-arden' ),
	        'base'                      => 'tm_rotate_box',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-flip-box',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array_merge( array(
		                                                    array(
			                                                    'heading'     => esc_html__( 'Direction', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Select direction for box.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'direction',
			                                                    'value'       => array(
				                                                    esc_html__( 'To Top', 'tm-arden' )    => 'top',
				                                                    esc_html__( 'To Right', 'tm-arden' )  => 'right',
				                                                    esc_html__( 'To Bottom', 'tm-arden' ) => 'bottom',
				                                                    esc_html__( 'To Left', 'tm-arden' )   => 'left',
			                                                    ),
			                                                    'admin_label' => true,
			                                                    'std'         => 'top',
		                                                    ),
		                                                    Insight_VC::get_animation_field(),
		                                                    Insight_VC::extra_class_field(),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'front_heading',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Text', 'tm-arden' ),
			                                                    'type'       => 'textarea',
			                                                    'param_name' => 'front_text',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Button', 'tm-arden' ),
			                                                    'type'       => 'vc_link',
			                                                    'param_name' => 'front_button',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Heading Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'front_heading_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom',
			                                                    ),
			                                                    'std'        => 'secondary',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Custom Heading Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'front_custom_heading_color',
			                                                    'dependency' => array(
				                                                    'element' => 'front_heading_color',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Text Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'front_text_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Custom Text Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'front_custom_text_color',
			                                                    'dependency' => array(
				                                                    'element' => 'front_text_color',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
		                                                    array(
			                                                    'group'       => $front_tab,
			                                                    'heading'     => esc_html__( 'Button', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Select color for button.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'front_button_color',
			                                                    'value'       => array(
				                                                    esc_html__( 'Default', 'tm-arden' )   => 'default',
				                                                    esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Black', 'tm-arden' )     => 'black',
				                                                    esc_html__( 'Grey', 'tm-arden' )      => 'grey',
				                                                    esc_html__( 'White', 'tm-arden' )     => 'white',
			                                                    ),
			                                                    'std'         => 'secondary',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Background Image', 'tm-arden' ),
			                                                    'type'       => 'attach_image',
			                                                    'param_name' => 'front_background_image',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Background Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'front_background_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'None', 'tm-arden' )            => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom',
				                                                    esc_html__( 'Gradient Color', 'tm-arden' )  => 'gradient',
			                                                    ),
			                                                    'std'        => 'primary',
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Custom Background Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'front_custom_background_color',
			                                                    'dependency' => array(
				                                                    'element' => 'front_background_color',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'group'      => $front_tab,
			                                                    'heading'    => esc_html__( 'Background Gradient', 'tm-arden' ),
			                                                    'type'       => 'gradient',
			                                                    'param_name' => 'front_background_gradient',
			                                                    'dependency' => array(
				                                                    'element' => 'front_background_color',
				                                                    'value'   => array( 'gradient' ),
			                                                    ),
		                                                    ),

		                                                    // Back Content Tab.
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Heading', 'tm-arden' ),
			                                                    'type'       => 'textfield',
			                                                    'param_name' => 'back_heading',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Text', 'tm-arden' ),
			                                                    'type'       => 'textarea',
			                                                    'param_name' => 'back_text',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Button', 'tm-arden' ),
			                                                    'type'       => 'vc_link',
			                                                    'param_name' => 'back_button',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Heading Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'back_heading_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom',
			                                                    ),
			                                                    'std'        => 'secondary',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Custom Heading Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'back_custom_heading_color',
			                                                    'dependency' => array(
				                                                    'element' => 'back_heading_color',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Text Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'back_text_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'Default Color', 'tm-arden' )   => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom',
			                                                    ),
			                                                    'std'        => '',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Custom Text Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'back_custom_text_color',
			                                                    'dependency' => array(
				                                                    'element' => 'back_text_color',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
			                                                    'std'        => '#fff',
		                                                    ),
		                                                    array(
			                                                    'group'       => $back_tab,
			                                                    'heading'     => esc_html__( 'Button', 'tm-arden' ),
			                                                    'description' => esc_html__( 'Select color for button.', 'tm-arden' ),
			                                                    'type'        => 'dropdown',
			                                                    'param_name'  => 'back_button_color',
			                                                    'value'       => array(
				                                                    esc_html__( 'Default', 'tm-arden' )   => 'default',
				                                                    esc_html__( 'Primary', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Black', 'tm-arden' )     => 'black',
				                                                    esc_html__( 'Grey', 'tm-arden' )      => 'grey',
				                                                    esc_html__( 'White', 'tm-arden' )     => 'white',
			                                                    ),
			                                                    'std'         => 'secondary',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Background Image', 'tm-arden' ),
			                                                    'type'       => 'attach_image',
			                                                    'param_name' => 'back_background_image',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Background Color', 'tm-arden' ),
			                                                    'type'       => 'dropdown',
			                                                    'param_name' => 'back_background_color',
			                                                    'value'      => array(
				                                                    esc_html__( 'None', 'tm-arden' )            => '',
				                                                    esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				                                                    esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				                                                    esc_html__( 'Custom Color', 'tm-arden' )    => 'custom',
				                                                    esc_html__( 'Gradient Color', 'tm-arden' )  => 'gradient',
			                                                    ),
			                                                    'std'        => 'primary',
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Custom Background Color', 'tm-arden' ),
			                                                    'type'       => 'colorpicker',
			                                                    'param_name' => 'back_custom_background_color',
			                                                    'dependency' => array(
				                                                    'element' => 'back_background_color',
				                                                    'value'   => array( 'custom' ),
			                                                    ),
		                                                    ),
		                                                    array(
			                                                    'group'      => $back_tab,
			                                                    'heading'    => esc_html__( 'Background Gradient', 'tm-arden' ),
			                                                    'type'       => 'gradient',
			                                                    'param_name' => 'back_background_gradient',
			                                                    'dependency' => array(
				                                                    'element' => 'back_background_color',
				                                                    'value'   => array( 'gradient' ),
			                                                    ),
		                                                    ),
	                                                    ), Insight_VC::get_vc_spacing_tab() ),

        ) );
