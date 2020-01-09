<?php
$section  = 'header_sticky';
$priority = 1;
$prefix   = 'header_sticky_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => $prefix . 'enable',
	'label'       => esc_html__( 'Enable', 'tm-arden' ),
	'description' => esc_html__( 'Enable this option to turn on header sticky feature.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 1,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'behaviour',
	'label'       => esc_html__( 'Behaviour.', 'tm-arden' ),
	'description' => esc_html__( 'Controls the behaviour of header sticky when you scroll down to page', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'both',
	'choices'     => array(
		'both' => esc_html__( 'Sticky on scroll up/down', 'tm-arden' ),
		'up'   => esc_html__( 'Sticky on scroll up', 'tm-arden' ),
		'down' => esc_html__( 'Sticky on scroll down', 'tm-arden' ),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'height',
	'label'     => esc_html__( 'Height', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 70,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 50,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'height',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_top',
	'label'     => esc_html__( 'Padding top', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-top',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'slider',
	'settings'  => $prefix . 'padding_bottom',
	'label'     => esc_html__( 'Padding bottom', 'tm-arden' ),
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 0,
	'transport' => 'auto',
	'choices'   => array(
		'min'  => 0,
		'max'  => 200,
		'step' => 1,
	),
	'output'    => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'padding-bottom',
			'units'    => 'px',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'item_padding',
	'label'       => esc_html__( 'Item Padding', 'tm-arden' ),
	'description' => esc_html__( 'Controls the item level 1 padding of navigation when sticky.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '27px',
		'bottom' => '27px',
		'left'   => '22px',
		'right'  => '22px',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => array(
				'.headroom--not-top.headroom--not-top .menu--primary .menu__container > li > a',
				'.headroom--not-top.headroom--not-top .menu--primary .menu__container > ul > li >a',
			),
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'bg_color',
	'label'       => esc_html__( 'Background Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the background color of navigation when sticky.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 'rgba( 255, 255, 255, 1 )',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .page-header-inner',
			'property' => 'background',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Logo', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'image',
	'settings'    => 'sticky_logo',
	'label'       => esc_html__( 'Sticky logo', 'tm-arden' ),
	'description' => esc_html__( 'Select an image file for your sticky header logo.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => INSIGHT_THEME_URI . '/assets/images/logo.png',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'dimension',
	'settings'    => $prefix . 'logo_width',
	'label'       => esc_html__( 'Logo Width', 'tm-arden' ),
	'description' => esc_html__( 'Controls the width of sticky header logo. Ex: 120px', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => '96px',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'width',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'spacing',
	'settings'    => $prefix . 'logo_padding',
	'label'       => esc_html__( 'Logo Padding', 'tm-arden' ),
	'description' => esc_html__( 'Controls the padding of sticky header logo.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => array(
		'top'    => '18px',
		'right'  => '0px',
		'bottom' => '18px',
		'left'   => '0px',
	),
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .branding__logo .sticky-logo',
			'property' => 'padding',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'custom',
	'settings' => $prefix . 'group_title_' . $priority ++,
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '<div class="big_title">' . esc_html__( 'Main Menu', 'tm-arden' ) . '</div>',
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_color',
	'label'       => esc_html__( 'Link Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of main menu items on sticky header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => '#222',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary > ul > li > a',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_hover_color',
	'label'       => esc_html__( 'Link Hover Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items on sticky header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '
				.headroom--not-top .menu--primary > ul > li:hover > a,
				.headroom--not-top .menu--primary > ul > li > a:focus,
				.headroom--not-top .menu--primary > ul > li.current-menu-item > a,
				.headroom--not-top .menu--primary > ul > li.current-menu-item > a .menu-item-title',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_arrow_color',
	'label'       => esc_html__( 'Link Arrow Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color for main menu items arrow.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => 'rgba(17,17,17 ,0.5)',
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary .menu__container > li.menu-item-has-children > a:after',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color',
	'settings'    => $prefix . 'link_arrow_hover_color',
	'label'       => esc_html__( 'Link Arrow Hover Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color when hover for main menu items arrow.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary .menu__container > li.menu-item-has-children:hover > a:after',
			'property' => 'color',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => $prefix . 'link_current_underline_color',
	'label'       => esc_html__( 'Hover Underline Color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the underline color when hover or current for main menu items.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::SECONDARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .menu--primary .sm-simple > li:hover > a .menu-item-title:after,
				.headroom--not-top .menu--primary .sm-simple > li.current-menu-item > a .menu-item-title:after,
				.headroom--not-top .menu--primary .sm-simple > li.current-menu-parent > a .menu-item-title:after',
			'property' => 'background-color',
		),
	),
) );

/*--------------------------------------------------------------
# Toggle Menu Button
--------------------------------------------------------------*/

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'color-alpha',
	'settings'    => 'header_sticky_icon_color',
	'label'       => esc_html__( 'Sticky icon color', 'tm-arden' ),
	'description' => esc_html__( 'Controls the color of icon in sticky header.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'transport'   => 'auto',
	'default'     => Insight::PRIMARY_COLOR,
	'output'      => array(
		array(
			'element'  => '.headroom--not-top .page-open-mobile-menu i, .headroom--not-top .page-open-mobile-menu i:before, .headroom--not-top .page-open-mobile-menu i:after, .headroom--not-top .page-open-main-menu i, .headroom--not-top .page-open-main-menu i:before, .headroom--not-top .page-open-main-menu i:after',
			'property' => 'background-color',
		),
		array(
			'element'  => '.headroom--not-top .header-right > div > i, .headroom--not-top .popup-search-wrap i, .headroom--not-top .mini-cart .mini-cart-icon',
			'property' => 'color',
		),
	),
) );
