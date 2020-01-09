<?php
$section  = 'custom_code';
$priority = 1;
$prefix   = 'custom_code_';

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'custom_css_enable',
	'label'       => esc_html__( 'Custom CSS', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to enable custom css.', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'      => 'code',
	'settings'  => 'custom_css',
	'section'   => $section,
	'priority'  => $priority ++,
	'default'   => 'body{background-color:#fff;}',
	'choices'   => array(
		'language' => 'css',
		'theme'    => 'monokai',
	),
	'transport' => 'postMessage',
	'js_vars'   => array(
		array(
			'element'  => '#insight-style-inline-css',
			'function' => 'html',
		),
	),
) );

Insight_Kirki::add_field( 'theme', array(
	'type'        => 'toggle',
	'settings'    => 'custom_js_enable',
	'label'       => esc_html__( 'Custom Javascript', 'tm-arden' ),
	'description' => esc_html__( 'Turn on to enable custom javascript', 'tm-arden' ),
	'section'     => $section,
	'priority'    => $priority ++,
	'default'     => 0,
) );

Insight_Kirki::add_field( 'theme', array(
	'type'     => 'code',
	'settings' => 'custom_js',
	'section'  => $section,
	'priority' => $priority ++,
	'default'  => '
jQuery(document).ready(function ($) {

});',
	'choices'  => array(
		'language' => 'javascript',
		'theme'    => 'monokai',
	),
) );
