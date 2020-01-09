<?php
/**
 * Theme Customizer
 *
 * @package TM Arden
 * @since   1.0
 */

/**
 * Setup configuration
 */
Insight_Kirki::add_config( 'theme', array(
	'option_type' => 'theme_mod',
	'capability'  => 'edit_theme_options',
) );

/**
 * Add sections
 */
$priority = 1;

Insight_Kirki::add_section( 'layout', array(
	'title'    => esc_html__( 'Layout', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'color_', array(
	'title'    => esc_html__( 'Colors', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'background', array(
	'title'    => esc_html__( 'Background', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'typography', array(
	'title'    => esc_html__( 'Typography', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'topbar', array(
	'title'    => esc_html__( 'Top bar', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'header', array(
	'title'    => esc_html__( 'Header', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'logo', array(
	'title'    => esc_html__( 'Logo', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'navigation', array(
	'title'    => esc_html__( 'Navigation', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'title_bar', array(
	'title'    => esc_html__( 'Page Title Bar', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'breadcrumb', array(
	'title'    => esc_html__( 'Breadcrumb', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'sliders', array(
	'title'    => esc_html__( 'Sliders', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'sidebars', array(
	'title'    => esc_html__( 'Sidebars', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'footer', array(
	'title'    => esc_html__( 'Footer', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'copyright', array(
	'title'    => esc_html__( 'Copyright', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'blog', array(
	'title'    => esc_html__( 'Blog', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'portfolio', array(
	'title'    => esc_html__( 'Portfolio', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'shop', array(
	'title'    => esc_html__( 'Shop', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'socials', array(
	'title'    => esc_html__( 'Social Networks', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'social_sharing', array(
	'title'    => esc_html__( 'Social Sharing', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'search_page', array(
	'title'    => esc_html__( 'Search Page + Popup Search', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'error404_page', array(
	'title'    => esc_html__( 'Error 404 Page', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'animation', array(
	'title'    => esc_html__( 'Animation', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'maintenance', array(
	'title'    => esc_html__( 'Maintenance Mode', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_panel( 'advanced', array(
	'title'    => esc_html__( 'Advanced', 'tm-arden' ),
	'priority' => $priority ++,
) );

Insight_Kirki::add_section( 'custom_code', array(
	'title'    => esc_html__( 'Custom Code', 'tm-arden' ),
	'priority' => $priority ++,
) );

/**
 * Load panel & section files
 */
require_once INSIGHT_CUSTOMIZER_DIR . '/header/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/sticky.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/lg.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/md.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/sm.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/header/xs.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/desktop-menu.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/off-canvas-menu.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/navigation/mobile-menu.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/section-sliders.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/lg.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/md.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/sm.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/title_bar/xs.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/footer/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/footer/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/footer/lg.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/footer/md.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/footer/sm.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/footer/xs.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/section-animation.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-background.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-breadcrumb.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-color.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-copyright.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-custom.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-error404.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-layout.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-logo.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/blog/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/blog/archive.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/blog/single.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/blog/fullscreen-slider.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/archive.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-slider.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-carousel-slider.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/fullscreen-split-slider.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/portfolio/single.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/shop/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/general.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/archive.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/single.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/shop/cart.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/section-search.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-sharing.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-sidebars.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-socials.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-topbar.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-typography.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/section-maintenance.php';

require_once INSIGHT_CUSTOMIZER_DIR . '/advanced/_panel.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/advanced/advanced.php';
require_once INSIGHT_CUSTOMIZER_DIR . '/advanced/light-gallery.php';
