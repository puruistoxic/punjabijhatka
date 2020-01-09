<?php
$section  = 'header';
$priority = 1;
$prefix   = 'header_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'header_enable',
	'label'       => esc_html__( 'Visibility', 'tm-arden' ),
	'description' => esc_html__( 'Turn on this option to enable header section.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'preset',
	'settings'    => 'header_preset',
	'description' => esc_html__( 'Choose a header preset you want', 'tm-arden' ),
	'section'     => $section,
	'default'     => '-1',
	'priority'    => $priority++,
	'multiple'    => 3,
	'choices'     => array(
		'-1'                      => array(
			'label'    => esc_html__( 'None', 'tm-arden' ),
			'settings' => array(),
		),
		'classic_l'               => array(
			'label'    => esc_html__( 'Header Classic - Light', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '01',
				'header_bg_color'             => '#fff',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_color'       => Insight::PRIMARY_COLOR,
				'navigation_link_hover_color' => Insight::PRIMARY_COLOR,
				'header_icon_color'           => Insight::PRIMARY_COLOR,
				'logo'                        => 'logo_dark',
			),
		),
		'classic_grid_l'          => array(
			'label'    => esc_html__( 'Header Classic Grid- Light', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '06',
				'header_bg_color'             => '#fff',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_color'       => Insight::PRIMARY_COLOR,
				'navigation_link_hover_color' => Insight::PRIMARY_COLOR,
				'header_icon_color'           => Insight::PRIMARY_COLOR,
				'logo'                        => 'logo_dark',
				'navigation_item_padding'     => array(
					'top'    => '47px',
					'bottom' => '47px',
					'left'   => '22px',
					'right'  => '22px',
				),
			),
		),
		'classic_d'               => array(
			'label'    => esc_html__( 'Header Classic - Dark', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '01',
				'header_bg_color'             => Insight::PRIMARY_COLOR,
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_color'       => '#fff',
				'navigation_link_hover_color' => '#fff',
				'header_icon_color'           => '#fff',
				'logo'                        => 'logo_light',
			),
		),
		'classic_lt'              => array(
			'label'    => esc_html__( 'Header Classic - Light/Transparent', 'tm-arden' ),
			'settings' => array(
				'header_type'                             => '01',
				'header_bg_color'                         => 'rgba(0, 0, 0, 0)',
				'header_border_color'                     => 'rgba(0, 0, 0, 0)',
				'navigation_link_color'                   => '#fff',
				'navigation_link_hover_color'             => '#fff',
				'navigation_link_current_underline_color' => '#fff',
				'header_icon_color'                       => '#fff',
				'logo'                                    => 'logo_light',
			),
		),
		'classic_dt'              => array(
			'label'    => esc_html__( 'Header Classic - Dark/Transparent', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '01',
				'header_bg_color'             => 'rgba(0, 0, 0, 0)',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_color'       => Insight::PRIMARY_COLOR,
				'navigation_link_hover_color' => Insight::PRIMARY_COLOR,
				'logo'                        => 'logo_dark',
			),
		),
		'minimal_l'               => array(
			'label'    => esc_html__( 'Header Minimal - Light', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '02',
				'header_bg_color'             => '#fff',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_hover_color' => Insight::PRIMARY_COLOR,
				'navigation_link_color'       => Insight::PRIMARY_COLOR,
				'lg_header_padding_top'       => 40,
				'lg_header_padding_bottom'    => 40,
				'header_icon_color'           => Insight::PRIMARY_COLOR,
				'logo'                        => 'logo_dark',
			),
		),
		'minimal_d'               => array(
			'label'    => esc_html__( 'Header Minimal - Dark', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '02',
				'header_bg_color'             => Insight::PRIMARY_COLOR,
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_hover_color' => '#fff',
				'navigation_link_color'       => '#fff',
				'lg_header_padding_top'       => 40,
				'lg_header_padding_bottom'    => 40,
				'header_icon_color'           => '#fff',
				'logo'                        => 'logo_light',
			),
		),
		'minimal_lt'              => array(
			'label'    => esc_html__( 'Header Minimal - Light/Transparent', 'tm-arden' ),
			'settings' => array(
				'header_type'              => '02',
				'header_bg_color'          => 'rgba(0, 0, 0, 0)',
				'header_border_color'      => 'rgba(0, 0, 0, 0)',
				'lg_header_padding_top'    => 40,
				'lg_header_padding_bottom' => 40,
				'header_icon_color'        => '#fff',
				'logo'                     => 'logo_light',
			),
		),
		'minimal_dt'              => array(
			'label'    => esc_html__( 'Header Minimal - Dark/Transparent', 'tm-arden' ),
			'settings' => array(
				'header_type'              => '02',
				'header_bg_color'          => 'rgba(0, 0, 0, 0)',
				'header_border_color'      => 'rgba(0, 0, 0, 0)',
				'lg_header_padding_top'    => 40,
				'lg_header_padding_bottom' => 40,
				'header_icon_color'        => Insight::PRIMARY_COLOR,
				'logo'                     => 'logo_dark',
			),
		),
		'minimal_fluid_l'         => array(
			'label'    => esc_html__( 'Header Minimal Fluid - Light', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '03',
				'header_bg_color'             => '#fff',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_hover_color' => '#fff',
				'navigation_link_color'       => '#fff',
				'lg_header_padding_top'       => 40,
				'lg_header_padding_bottom'    => 40,
				'logo'                        => 'logo_dark',
			),
		),
		'minimal_fluid_d'         => array(
			'label'    => esc_html__( 'Header Minimal Fluid - Dark', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '03',
				'header_bg_color'             => Insight::PRIMARY_COLOR,
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_hover_color' => '#fff',
				'navigation_link_color'       => '#fff',
				'lg_header_padding_top'       => 40,
				'lg_header_padding_bottom'    => 40,
				'header_icon_color'           => '#fff',
				'logo'                        => 'logo_light',
			),
		),
		'minimal_fluid_lt'        => array(
			'label'    => esc_html__( 'Header Minimal Fluid - Light/Transparent', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '03',
				'header_bg_color'             => 'rgba( 0, 0, 0, 0 )',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_hover_color' => '#fff',
				'navigation_link_color'       => '#fff',
				'lg_header_padding_top'       => 40,
				'lg_header_padding_bottom'    => 40,
				'header_icon_color'           => '#fff',
				'logo'                        => 'logo_light',
			),
		),
		'minimal_fluid_dt'        => array(
			'label'    => esc_html__( 'Header Minimal Fluid - Dark/Transparent', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '03',
				'header_bg_color'             => 'rgba( 0, 0, 0, 0 )',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_hover_color' => '#fff',
				'navigation_link_color'       => '#fff',
				'lg_header_padding_top'       => 40,
				'lg_header_padding_bottom'    => 40,
				'header_icon_color'           => Insight::PRIMARY_COLOR,
				'logo'                        => 'logo_dark',
			),
		),
		'left'                    => array(
			'label'    => esc_html__( 'Left Header', 'tm-arden' ),
			'settings' => array(
				'header_type'              => '04',
				'header_border_color'      => 'rgba(0, 0, 0, 0)',
				'navigation_item_padding'  => array(
					'top'    => '19px',
					'bottom' => '19px',
					'left'   => '60px',
					'right'  => '60px',
				),
				'lg_header_padding_top'    => 40,
				'lg_header_padding_bottom' => 40,
				'logo'                     => 'logo_dark',
			),
		),
		'left_no_shadow'          => array(
			'label'    => esc_html__( 'Left Header', 'tm-arden' ),
			'settings' => array(
				'header_type'              => '04',
				'header_border_color'      => 'rgba(0, 0, 0, 0)',
				'navigation_item_padding'  => array(
					'top'    => '19px',
					'bottom' => '19px',
					'left'   => '60px',
					'right'  => '60px',
				),
				'lg_header_padding_top'    => 40,
				'lg_header_padding_bottom' => 40,
				'logo'                     => 'logo_dark',
				'left_header_shadow'       => '0',
			),
		),
		'classic_fluid_right_nav' => array(
			'label'    => esc_html__( 'Classic - Fluid - Right Navigation', 'tm-arden' ),
			'settings' => array(
				'header_type'                 => '05',
				'header_bg_color'             => '#fff',
				'header_border_color'         => 'rgba(0, 0, 0, 0)',
				'navigation_link_color'       => Insight::PRIMARY_COLOR,
				'navigation_link_hover_color' => Insight::PRIMARY_COLOR,
				'header_icon_color'           => Insight::PRIMARY_COLOR,
				'logo'                        => 'logo_dark',
			),
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'select',
	'settings'    => 'header_type',
	'label'       => esc_html__( 'Header Type', 'tm-arden' ),
	'description' => esc_html__( 'Select header type that you want.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '01',
	'choices'     => array(
		'01' => esc_attr__( 'Classic', 'tm-arden' ),
		'02' => esc_attr__( 'Canvas Grid', 'tm-arden' ),
		'03' => esc_attr__( 'Canvas Fluid', 'tm-arden' ),
		'04' => esc_attr__( 'Left Header', 'tm-arden' ),
		'05' => esc_attr__( 'Classic - Fluid - Right Navigation', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => 'rgba(255, 255, 255, 1)',
	'output'      => array(
		array(
			'element'  => '.page-header-inner',
			'property' => 'background-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_border_color',
	'label'       => esc_html__( 'Border Bottom Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the border bottom color of header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => '#ddd',
	'output'      => array(
		array(
			'element'  => '.page-header-inner',
			'property' => 'border-bottom-color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'left_header_shadow',
	'label'       => esc_html__( 'Left Header Shadow', 'tm-arden' ),
	'description' => esc_html__( 'Control the shadow of left header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => '1',
	'choices'     => array(
		'0' => esc_html__( 'None', 'tm-arden' ),
		'1' => esc_html__( 'Yes', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'background',
	'settings'    => $prefix . 'bg_image',
	'label'       => esc_html__( 'Background Image', 'tm-arden' ),
	'description' => esc_html__( 'Select an image to use as background for header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => array(
		'background-color'      => '',
		'background-image'      => '',
		'background-repeat'     => 'no-repeat',
		'background-size'       => 'cover',
		'background-attachment' => 'scroll',
		'background-position'   => 'center',
	),
	'output'      => array(
		array(
			'element' => '.page-header-inner',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_icon_color',
	'label'       => esc_html__( 'Controls the color of icon in header', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of toggle menu canvas.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.page-open-mobile-menu i, .page-open-mobile-menu i:before, .page-open-mobile-menu i:after, .page-open-main-menu i, .page-open-main-menu i:before, .page-open-main-menu i:after',
			'property' => 'background-color',
		),
		array(
			'element'  => '.header-right > div > i, .popup-search-wrap i, .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
	),
) );

/*--------------------------------------------------------------
# Header button
--------------------------------------------------------------*/

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority++,
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '<div class="group_title">' . esc_html__( 'Button', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'header_button_text',
	'label'       => esc_html__( 'Button text', 'tm-arden' ),
	'description' => esc_html__( 'Text of button', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => esc_html__( 'BUY NOW $59', 'tm-arden' ),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'text',
	'settings'    => 'header_button_link',
	'label'       => esc_html__( 'Button link', 'tm-arden' ),
	'description' => esc_html__( 'Link of button', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority++,
	'default'     => 'https://themeforest.net/item/arden-a-sharp-modern-multipurpose-wordpress-theme/19710416?Ref=ThemeMove',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'radio-buttonset',
	'settings' => 'header_button_link_target',
	'label'    => esc_html__( 'Open link in a new tab.', 'tm-arden' ),
	'section'  => $section,
	'priority' => $priority++,
	'default'  => '1',
	'choices'  => array(
		'0' => esc_html__( 'No', 'tm-arden' ),
		'1' => esc_html__( 'Yes', 'tm-arden' ),
	),
) );
