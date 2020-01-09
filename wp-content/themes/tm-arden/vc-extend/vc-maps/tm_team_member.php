<?php

class WPBakeryShortCode_TM_Team_Member extends WPBakeryShortCode {

}

vc_map( array(
	        'name'                      => esc_html__( 'Team Member', 'tm-arden' ),
	        'base'                      => 'tm_team_member',
	        'category'                  => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'allowed_container_element' => 'vc_row',
	        'icon'                      => 'tm-i tm-i-member',
	        'params'                    => array(
		        array(
			        'type'        => 'dropdown',
			        'heading'     => esc_html__( 'Style', 'tm-arden' ),
			        'param_name'  => 'style',
			        'admin_label' => true,
			        'value'       => array(
				        esc_html__( '1', 'tm-arden' ) => '1',
			        ),
			        'std'         => '1',
		        ),
		        array(
			        'type'        => 'attach_image',
			        'heading'     => esc_html__( 'Photo of member', 'tm-arden' ),
			        'param_name'  => 'photo',
			        'admin_label' => true,
		        ),
		        array(
			        'type'        => 'textfield',
			        'heading'     => esc_html__( 'Name', 'tm-arden' ),
			        'admin_label' => true,
			        'param_name'  => 'name',
		        ),
		        array(
			        'type'        => 'textfield',
			        'heading'     => esc_html__( 'Position', 'tm-arden' ),
			        'param_name'  => 'position',
			        'description' => esc_html__( 'Example: CEO/Founder', 'tm-arden' ),
		        ),
		        array(
			        'type'       => 'textarea',
			        'heading'    => esc_html__( 'Description', 'tm-arden' ),
			        'param_name' => 'desc',
		        ),
		        array(
			        'type'       => 'textfield',
			        'heading'    => esc_html__( 'Profile url', 'tm-arden' ),
			        'param_name' => 'profile',
		        ),
		        Insight_VC::extra_class_field(),
		        Insight_VC::get_animation_field(),
		        array(
			        'group'      => esc_html__( 'Social Networks', 'tm-arden' ),
			        'type'       => 'param_group',
			        'heading'    => esc_html__( 'Social Networks', 'tm-arden' ),
			        'param_name' => 'social_networks',
			        'params'     => array(
				        array(
					        'type'       => 'iconpicker',
					        'heading'    => esc_html__( 'Icon', 'tm-arden' ),
					        'param_name' => 'icon',
					        'settings'   => array(
						        'emptyIcon'    => false,
						        'iconsPerPage' => 4000,
					        ),
				        ),
				        array(
					        'type'        => 'textfield',
					        'heading'     => esc_html__( 'Link', 'tm-arden' ),
					        'param_name'  => 'link',
					        'admin_label' => true,
				        ),
			        ),
		        ),
		        Insight_VC::css_editor_field(),
	        ),
        ) );
