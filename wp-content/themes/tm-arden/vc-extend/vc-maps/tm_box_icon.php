<?php

class WPBakeryShortCode_TM_Box_Icon extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$tmp         = '';
		$icon_tmp    = '';
		$heading_tmp = '';
		$text_tmp    = '';

		$tmp .= "text-align: {$atts['align']};";
		if ( $atts['max_width'] !== '' ) {

			$tmp .= "max-width: {$atts['max_width']};";
		}

		if ( $atts['background_color'] === 'custom_color' ) {
			$tmp .= "background-color: {$atts['custom_background_color']};";
		} elseif ( $atts['background_color'] === 'gradient' ) {
			$tmp .= $atts['background_gradient'];
		}

		if ( $atts['background_image'] !== '' ) {
			$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
			if ( $_url !== false ) {
				$tmp .= "background-image: url( $_url );";

				if ( $atts['background_size'] !== 'auto' ) {
					$tmp .= "background-size: {$atts['background_size']};";
				}

				$tmp .= "background-repeat: {$atts['background_repeat']};";
				if ( $atts['background_position'] !== '' ) {
					$tmp .= "background-position: {$atts['background_position']};";
				}
			}
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_css .= "$selector{ $tmp }";
		}

		if ( $atts['icon_color'] === 'custom_color' ) {
			$icon_tmp .= "color: {$atts['custom_icon_color']}; border-color: {$atts['custom_icon_color']}; ";
		}

		if ( $icon_tmp !== '' ) {
			if ( $atts['style'] === '2' ) {
				$insight_shortcode_css .= "$selector .icon i{ $icon_tmp }";
			} else {
				$insight_shortcode_css .= "$selector .icon{ $icon_tmp }";
			}
		}

		if ( $atts['heading_color'] === 'custom_color' ) {
			$heading_tmp .= "color: {$atts['custom_heading_color']}; ";
		}

		if ( $heading_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .heading{ $heading_tmp }";
		}

		if ( $atts['text_color'] === 'custom_color' ) {
			$text_tmp .= "color: {$atts['custom_text_color']}; ";
		}

		if ( $text_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .text{ $text_tmp }";
		}

		if ( $atts['text'] === '' && $atts['heading'] === '' ) {
			$insight_shortcode_css .= "$selector .image{ margin-bottom: 0; }";
		}

		if ( $atts['tablet_align'] !== '' ) {
			$insight_shortcode_css .= Insight_VC::get_media_query_css( $selector, 'text-align', $atts['tablet_align'], 'max-width: 767px' );
		}

		if ( $atts['mobile_align'] !== '' ) {
			$insight_shortcode_css .= Insight_VC::get_media_query_css( $selector, 'text-align', $atts['mobile_align'], 'max-width: 543px' );
		}

		$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$styling_tab = esc_html__( 'Styling', 'tm-arden' );

vc_map( array(
	'name'                      => esc_html__( 'Box Icon', 'tm-arden' ),
	'base'                      => 'tm_box_icon',
	'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'tm-i tm-i-icons',
	'allowed_container_element' => 'vc_row',
	'params'                    => array_merge( array(
		array(
			'heading'     => esc_html__( 'Style', 'tm-arden' ),
			'description' => esc_html__( 'Select style for box icon.', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'value'       => array(
				esc_html__( 'Style 01', 'tm-arden' ) => '1',
				esc_html__( 'Style 02', 'tm-arden' ) => '2',
			),
			'admin_label' => true,
			'std'         => '1',
		),
		array(
			'heading'     => esc_html__( 'Feature Type', 'tm-arden' ),
			'description' => esc_html__( 'Select icon or image that display.', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'feature',
			'value'       => array(
				esc_html__( 'Show Icon', 'tm-arden' )  => 'icon',
				esc_html__( 'Show Image', 'tm-arden' ) => 'image',
			),
			'std'         => 'icon',
		),
		array(
			'heading'    => esc_html__( 'Image', 'tm-arden' ),
			'type'       => 'attach_image',
			'param_name' => 'image',
			'dependency' => array(
				'element' => 'feature',
				'value'   => 'image',
			),
		),
		array(
			'heading'     => esc_html__( 'Image Size', 'tm-arden' ),
			'description' => esc_html__( 'Controls the size of image.', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'image_size',
			'value'       => Insight_Helper::get_image_sizes(),
			'std'         => 'full',
		),
		array(
			'heading'     => esc_html__( 'Box Max Width', 'tm-arden' ),
			'description' => esc_html__( 'Input max width of box icon. For ex: 300px', 'tm-arden' ),
			'type'        => 'textfield',
			'param_name'  => 'max_width',
		),
		array(
			'heading'     => esc_html__( 'Link', 'tm-arden' ),
			'description' => esc_html__( 'Add a link to title.', 'tm-arden' ),
			'type'        => 'vc_link',
			'param_name'  => 'link',
		),
		array(
			'heading'     => esc_html__( 'Heading', 'tm-arden' ),
			'type'        => 'textfield',
			'param_name'  => 'heading',
			'admin_label' => true,
		),
		array(
			'heading'    => esc_html__( 'Text', 'tm-arden' ),
			'type'       => 'textarea',
			'param_name' => 'text',
		),
		array(
			'heading'    => esc_html__( 'Heading Color', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'heading_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-arden' )   => '',
				esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary_color',
				esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Heading Color', 'tm-arden' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_heading_color',
			'dependency' => array(
				'element' => 'heading_color',
				'value'   => array( 'custom_color' ),
			),
			'std'        => '#222',
		),
		array(
			'heading'    => esc_html__( 'Icon Color', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'icon_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-arden' )   => '',
				esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			),
			'std'        => '',
			'dependency' => array(
				'element' => 'feature',
				'value'   => array( 'icon' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Custom Icon Color', 'tm-arden' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_icon_color',
			'dependency' => array(
				'element' => 'icon_color',
				'value'   => 'custom_color',
			),
			'std'        => '#999',
		),
		array(
			'heading'    => esc_html__( 'Text Color', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'text_color',
			'value'      => array(
				esc_html__( 'Default Color', 'tm-arden' )   => '',
				esc_html__( 'Primary Color', 'tm-arden' )   => 'primary',
				esc_html__( 'Secondary Color', 'tm-arden' ) => 'secondary',
				esc_html__( 'Custom Color', 'tm-arden' )    => 'custom_color',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Custom Text Color', 'tm-arden' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_text_color',
			'dependency' => array(
				'element' => 'text_color',
				'value'   => array( 'custom_color' ),
			),
			'std'        => '#999',
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
			'heading'    => esc_html__( 'Text Align on Tablet', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'tablet_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				esc_html__( 'Left', 'tm-arden' )                       => 'left',
				esc_html__( 'Center', 'tm-arden' )                     => 'center',
				esc_html__( 'Right', 'tm-arden' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Text Align on Mobile', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'mobile_align',
			'value'      => array(
				esc_html__( 'Inherit From Larger Device', 'tm-arden' ) => '',
				esc_html__( 'Left', 'tm-arden' )                       => 'left',
				esc_html__( 'Center', 'tm-arden' )                     => 'center',
				esc_html__( 'Right', 'tm-arden' )                      => 'right',
			),
			'std'        => '',
		),
		array(
			'heading'    => esc_html__( 'Button', 'tm-arden' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
		),
		array(
			'heading'     => esc_html__( 'Button Smooth Scroll', 'tm-arden' ),
			'description' => esc_html__( 'Make the button smooth scroll to a section when click.', 'tm-arden' ),
			'type'        => 'checkbox',
			'param_name'  => 'button_smooth_scroll',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Color', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'background_color',
			'value'      => array(
				esc_html__( 'None', 'tm-arden' )           => '',
				esc_html__( 'Primary Color', 'tm-arden' )  => 'primary',
				esc_html__( 'Custom Color', 'tm-arden' )   => 'custom_color',
				esc_html__( 'Gradient Color', 'tm-arden' ) => 'gradient',
			),
			'std'        => '',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Background Color', 'tm-arden' ),
			'type'       => 'colorpicker',
			'param_name' => 'custom_background_color',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'custom_color' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Gradient', 'tm-arden' ),
			'type'       => 'gradient',
			'param_name' => 'background_gradient',
			'dependency' => array(
				'element' => 'background_color',
				'value'   => array( 'gradient' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Image', 'tm-arden' ),
			'type'       => 'attach_image',
			'param_name' => 'background_image',
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Repeat', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'background_repeat',
			'value'      => array(
				esc_html__( 'No repeat', 'tm-arden' )         => 'no-repeat',
				esc_html__( 'Tile', 'tm-arden' )              => 'repeat',
				esc_html__( 'Tile Horizontally', 'tm-arden' ) => 'repeat-x',
				esc_html__( 'Tile Vertically', 'tm-arden' )   => 'repeat-y',
			),
			'std'        => 'no-repeat',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Background Size', 'tm-arden' ),
			'type'       => 'dropdown',
			'param_name' => 'background_size',
			'value'      => array(
				esc_html__( 'Auto', 'tm-arden' )    => 'auto',
				esc_html__( 'Cover', 'tm-arden' )   => 'cover',
				esc_html__( 'Contain', 'tm-arden' ) => 'contain',
			),
			'std'        => 'cover',
			'dependency' => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Position', 'tm-arden' ),
			'description' => esc_html__( 'Ex: left center', 'tm-arden' ),
			'type'        => 'textfield',
			'param_name'  => 'background_position',
			'dependency'  => array(
				'element'   => 'background_image',
				'not_empty' => true,
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Background Overlay', 'tm-arden' ),
			'description' => esc_html__( 'Choose an overlay background color.', 'tm-arden' ),
			'type'        => 'dropdown',
			'param_name'  => 'overlay_background',
			'value'       => array(
				esc_html__( 'None', 'tm-arden' )          => '',
				esc_html__( 'Primary Color', 'tm-arden' ) => 'primary',
				esc_html__( 'Custom Color', 'tm-arden' )  => 'overlay_custom_background',
			),
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Custom Background Overlay', 'tm-arden' ),
			'description' => esc_html__( 'Choose an custom background color overlay.', 'tm-arden' ),
			'type'        => 'colorpicker',
			'param_name'  => 'overlay_custom_background',
			'std'         => '#000000',
			'dependency'  => array(
				'element' => 'overlay_background',
				'value'   => array( 'overlay_custom_background' ),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Opacity', 'tm-arden' ),
			'type'       => 'number',
			'param_name' => 'overlay_opacity',
			'value'      => 100,
			'min'        => 0,
			'max'        => 100,
			'step'       => 1,
			'suffix'     => '%',
			'std'        => 80,
			'dependency' => array(
				'element'   => 'overlay_background',
				'not_empty' => true,
			),
		),
	), Insight_VC::get_vc_spacing_tab(), Insight_VC::icon_libraries() ),
) );
