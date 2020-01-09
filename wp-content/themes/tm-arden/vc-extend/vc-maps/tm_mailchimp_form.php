<?php

class WPBakeryShortCode_TM_Mailchimp_Form extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Mailchimp Form', 'tm-arden' ),
	        'base'                      => 'tm_mailchimp_form',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'icon'                      => 'tm-i tm-i-mailchimp-form',
	        'allowed_container_element' => 'vc_row',
	        'params'                    => array(
		        array(
			        'heading'     => esc_html__( 'Form Id', 'tm-arden' ),
			        'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'tm-arden' ),
			        'type'        => 'textfield',
			        'param_name'  => 'form_id',
		        ),
		        array(
			        'heading'     => esc_html__( 'Form Skin', 'tm-arden' ),
			        'type'        => 'dropdown',
			        'param_name'  => 'skin',
			        'admin_label' => true,
			        'value'       => array(
				        esc_html__( 'Default', 'tm-arden' )   => '',
				        esc_html__( 'Secondary', 'tm-arden' ) => 'secondary',
				        esc_html__( 'Primary', 'tm-arden' )   => 'primary',
			        ),
			        'std'         => '',
		        ),
		        Insight_VC::extra_class_field(),
	        ),
        ) );
