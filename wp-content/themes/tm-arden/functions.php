<?php
/**
 * Define constant
 */
$theme = wp_get_theme();

if ( ! empty( $theme['Template'] ) ) {
    $theme = wp_get_theme( $theme['Template'] );
}

if ( ! defined( 'DS' ) ) {
    define( 'DS', DIRECTORY_SEPARATOR );
}

define( 'INSIGHT_THEME_NAME', $theme['Name'] );
define( 'INSIGHT_THEME_SLUG', $theme['Template'] );
define( 'INSIGHT_THEME_VERSION', $theme['Version'] );
define( 'INSIGHT_THEME_DIR', get_template_directory() );
define( 'INSIGHT_THEME_URI', get_template_directory_uri() );
define( 'INSIGHT_CHILD_THEME_URI', get_stylesheet_directory_uri() );
define( 'INSIGHT_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'INSIGHT_FRAMEWORK_DIR', get_template_directory() . DS . 'framework' );
define( 'INSIGHT_CUSTOMIZER_DIR', INSIGHT_THEME_DIR . DS . 'customizer' );
define( 'INSIGHT_PLUGINS_DIR', INSIGHT_THEME_DIR . DS . 'plugins' );
define( 'INSIGHT_WIDGETS_DIR', INSIGHT_THEME_DIR . DS . 'widgets' );
define( 'INSIGHT_VC_MAPS_DIR', INSIGHT_THEME_DIR . DS . 'vc-extend' . DS . 'vc-maps' );
define( 'INSIGHT_VC_PARAMS_DIR', INSIGHT_THEME_DIR . DS . 'vc-extend' . DS . 'vc-params' );
define( 'INSIGHT_VC_SHORTCODE_CATEGORY', esc_html__( 'By', 'tm-arden' ) . ' ' . INSIGHT_THEME_NAME );
define( 'INSIGHT_PROTOCOL', is_ssl() ? 'https' : 'http' );

/**
 * Load Insight Framework.
 */
require_once INSIGHT_FRAMEWORK_DIR . '/class-actions-filters.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-admin.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-compatible.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-customize.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-detect.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-enqueue.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-functions.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-helper.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-maintenance.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-import.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-init.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-instagram.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-kirki.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-metabox.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-plugins.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-post-like.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-query.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-responsive.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-security.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-static.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-templates.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-aqua-resizer.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-visual-composer.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-walker-nav-menu.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-widget.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-widgets.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-blog.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-portfolio.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-woo.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-walker-nav-menu-extra-items.php';
require_once INSIGHT_FRAMEWORK_DIR . '/class-minify.php';
require_once INSIGHT_FRAMEWORK_DIR . '/tgm-plugin-activation.php';
require_once INSIGHT_FRAMEWORK_DIR . '/tgm-plugin-registration.php';

/**
 * Init the theme
 */
Insight_Init::instance();
