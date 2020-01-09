<?php

class WPBakeryShortCode_TM_Contact_Form_7 extends WPBakeryShortCode {

	public function get_inline_css( $selector = '', $atts ) {
		global $insight_shortcode_css;
		$tmp              = '';
		$button_tmp       = '';
		$button_hover_tmp = '';
		if ( isset( $atts['skin'] ) && $atts['skin'] === 'custom' ) {
			$tmp .= "color: {$atts['custom_text_color']};";
			$tmp .= "border-color: {$atts['custom_border_color']};";
			if ( $atts['font_size'] !== '' ) {
				$tmp .= "font-size: {$atts['font_size'] }px;";
			}
			$button_tmp .= "color: {$atts['custom_text_color']};";
			$button_tmp .= "border-color: {$atts['custom_border_color']};";
			$button_hover_tmp .= "background-color: {$atts['custom_border_color']};";
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_css .= "$selector .wpcf7-text.wpcf7-text, $selector .wpcf7-textarea, $selector .wpcf7-select { $tmp }";
		}
		if ( $button_tmp !== '' ) {
			$insight_shortcode_css .= "$selector .wpcf7-submit { $button_tmp }";
			$insight_shortcode_css .= "$selector .wpcf7-submit:hover { $button_hover_tmp }";
		}
	}
}

/**
 * Add Shortcode To Visual Composer
 */
$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

$contact_forms = array();
if ( $cf7 ) {
	foreach ( $cf7 as $cform ) {
		$contact_forms[ $cform->post_title ] = $cform->ID;
	}
} else {
	$contact_forms[ esc_html__( 'No contact forms found', 'tm-arden' ) ] = 0;
}

vc_map( array(
	        'name'                      => esc_html__( 'Contact Form 7', 'tm-arden' ),
	        'base'                      => 'tm_contact_form_7',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-contact-form-7',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array(
		        array(
			        'type'        => 'dropdown',
			        'heading'     => esc_html__( 'Select contact form', 'tm-arden' ),
			        'param_name'  => 'id',
			        'value'       => $contact_forms,
			        'save_always' => true,
			        'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'tm-arden' ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Form Skin', 'tm-arden' ),
			        'type'        => 'dropdown',
			        'param_name'  => 'skin',
			        'admin_label' => true,
			        'value'       => array(
				        esc_html__( 'Default', 'tm-arden' )   => '',
				        esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				        esc_html__( 'Classic', 'tm-arden' )   => 'classic',
				        esc_html__( 'Custom', 'tm-arden' )    => 'custom',
			        ),
			        'std'         => '',
		        ),
		        array(
			        'heading'    => esc_html__( 'Custom Text Color', 'tm-arden' ),
			        'type'       => 'colorpicker',
			        'param_name' => 'custom_text_color',
			        'dependency' => array(
				        'element' => 'skin',
				        'value'   => array( 'custom' ),
			        ),
			        'std'        => '#ffffff',
		        ),
		        array(
			        'heading'    => esc_html__( 'Custom Border Color', 'tm-arden' ),
			        'type'       => 'colorpicker',
			        'param_name' => 'custom_border_color',
			        'dependency' => array(
				        'element' => 'skin',
				        'value'   => array( 'custom' ),
			        ),
			        'std'        => '#f2b636',
		        ),
		        array(
			        'heading'     => esc_html__( 'Font size', 'tm-arden' ),
			        'description' => esc_html__( 'Controls the font size of fields.', 'tm-arden' ),
			        'type'        => 'number',
			        'suffix'      => 'px',
			        'param_name'  => 'font_size',
			        'dependency'  => array(
				        'element' => 'skin',
				        'value'   => array( 'custom' ),
			        ),
		        ),
		        Insight_VC::extra_class_field(),
	        ),
        ) );
