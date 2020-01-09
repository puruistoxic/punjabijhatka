<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Insight_Metabox' ) ) {
    class Insight_Metabox {

        /**
         * Insight_Metabox constructor.
         */
        public function __construct() {
            add_filter( 'insight_core_meta_boxes', array( $this, 'register_meta_boxes' ) );
            add_filter( 'insight_page_meta_box_presets', array( $this, 'page_meta_box_presets' ) );
        }

        public function page_meta_box_presets( $presets ) {
            $presets[] = 'header_preset';
            $presets[] = 'footer_preset';
            $presets[] = 'copyright_preset';

            return $presets;
        }

        /**
         * Register Metabox
         *
         * @param $meta_boxes
         *
         * @return array
         */
        public function register_meta_boxes( $meta_boxes ) {

            $page_registered_sidebars      = Insight_Helper::get_registered_sidebars( true );
            $copyright_registered_sidebars = Insight_Helper::get_registered_sidebars( true, false );


            $general_options = array(
                array(
                    'title'  => esc_attr__( 'Layout', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'site_layout',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Layout', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Controls the layout of this page.', 'tm-arden' ),
                            'options' => array(
                                ''      => esc_html__( 'Default', 'tm-arden' ),
                                'boxed' => esc_html__( 'Boxed', 'tm-arden' ),
                                'wide'  => esc_html__( 'Wide', 'tm-arden' ),
                            ),
                            'default' => '',
                        ),
                        array(
                            'id'    => 'site_width',
                            'type'  => 'text',
                            'title' => esc_attr__( 'Site Width', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the site width for this page. Enter value including any valid CSS unit, ex: 1200px. Leave blank to use global setting.', 'tm-arden' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Background', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'site_background_message',
                            'type'    => 'message',
                            'title'   => esc_attr__( 'Info', 'tm-arden' ),
                            'message' => esc_attr__( 'These options controls the background on boxed mode.', 'tm-arden' ),
                        ),
                        array(
                            'id'    => 'site_background_color',
                            'type'  => 'color',
                            'title' => esc_attr__( 'Background Color', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the background color of the outer background area in boxed mode of this page.', 'tm-arden' ),
                        ),
                        array(
                            'id'    => 'site_background_image',
                            'type'  => 'media',
                            'title' => esc_attr__( 'Background Image', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the background image of the outer background area in boxed mode of this page.', 'tm-arden' ),
                        ),
                        array(
                            'id'      => 'site_background_repeat',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Background Repeat', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Controls the background repeat of the outer background area in boxed mode of this page.', 'tm-arden' ),
                            'options' => array(
                                'no-repeat' => esc_html__( 'No repeat', 'tm-arden' ),
                                'repeat'    => esc_html__( 'Repeat', 'tm-arden' ),
                                'repeat-x'  => esc_html__( 'Repeat X', 'tm-arden' ),
                                'repeat-y'  => esc_html__( 'Repeat Y', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'    => 'site_background_position',
                            'type'  => 'text',
                            'title' => esc_html__( 'Background Position', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the background position of the outer background area in boxed mode of this page.', 'tm-arden' ),
                        ),
                        array(
                            'id'      => 'content_background_message',
                            'type'    => 'message',
                            'title'   => esc_attr__( 'Info', 'tm-arden' ),
                            'message' => esc_attr__( 'These options controls the background of main content on this page.', 'tm-arden' ),
                        ),
                        array(
                            'id'    => 'content_background_color',
                            'type'  => 'color',
                            'title' => esc_attr__( 'Background Color', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the background color of main content on this page.', 'tm-arden' ),
                        ),
                        array(
                            'id'    => 'content_background_image',
                            'type'  => 'media',
                            'title' => esc_attr__( 'Background Image', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the background image of main content on this page.', 'tm-arden' ),
                        ),
                        array(
                            'id'      => 'content_background_repeat',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Background Repeat', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Controls the background repeat of main content on this page.', 'tm-arden' ),
                            'options' => array(
                                'no-repeat' => esc_html__( 'No repeat', 'tm-arden' ),
                                'repeat'    => esc_html__( 'Repeat', 'tm-arden' ),
                                'repeat-x'  => esc_html__( 'Repeat X', 'tm-arden' ),
                                'repeat-y'  => esc_html__( 'Repeat Y', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'    => 'content_background_position',
                            'type'  => 'text',
                            'title' => esc_html__( 'Background Position', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Controls the background position of main content on this page.', 'tm-arden' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Top Bar', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'top_bar_enable',
                            'type'    => 'switch',
                            'title'   => esc_attr__( 'Enable', 'tm-arden' ),
                            'default' => '2',
                            'options' => array(
                                '0' => esc_html__( 'Disable', 'tm-arden' ),
                                '1' => esc_html__( 'Enable', 'tm-arden' ),
                                '2' => esc_html__( 'Default', 'tm-arden' ),
                            ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Header', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'header_preset',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Header Preset', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select header preset that displays on this page.', 'tm-arden' ),
                            'default' => '-1',
                            'options' => array(
                                '-1'                      => esc_html__( 'Default', 'tm-arden' ),
                                'classic_l'               => esc_html__( 'Header Classic - Light', 'tm-arden' ),
                                'classic_d'               => esc_html__( 'Header Classic - Dark', 'tm-arden' ),
                                'classic_lt'              => esc_html__( 'Header Classic - Light/Transparent', 'tm-arden' ),
                                'classic_dt'              => esc_html__( 'Header Classic - Dark/Transparent', 'tm-arden' ),
                                'classic_grid_l'          => esc_html__( 'Header Classic Grid- Light', 'tm-arden' ),
                                'minimal_l'               => esc_html__( 'Header Minimal - Light', 'tm-arden' ),
                                'minimal_d'               => esc_html__( 'Header Minimal - Dark', 'tm-arden' ),
                                'minimal_lt'              => esc_html__( 'Header Minimal - Light/Transparent', 'tm-arden' ),
                                'minimal_dt'              => esc_html__( 'Header Minimal - Dark/Transparent', 'tm-arden' ),
                                'minimal_fluid_l'         => esc_html__( 'Header Minimal Fluid - Light', 'tm-arden' ),
                                'minimal_fluid_d'         => esc_html__( 'Header Minimal Fluid - Dark', 'tm-arden' ),
                                'minimal_fluid_lt'        => esc_html__( 'Header Minimal Fluid - Light/Transparent', 'tm-arden' ),
                                'minimal_fluid_dt'        => esc_html__( 'Header Minimal Fluid - Dark/Transparent', 'tm-arden' ),
                                'left'                    => esc_html__( 'Left Header', 'tm-arden' ),
                                'left_no_shadow'          => esc_html__( 'Left Header - No Shadow', 'tm-arden' ),
                                'classic_fluid_right_nav' => esc_html__( 'Header Classic Fluid - Right Navigation', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'header_position',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Header Position', 'tm-arden' ),
                            'default' => 'above',
                            'options' => array(
                                'above'  => esc_attr__( 'Above Slider', 'tm-arden' ),
                                'below'  => esc_attr__( 'Below Slider', 'tm-arden' ),
                                'behind' => esc_attr__( 'Overlay Header', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'menu_display',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Primary menu', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select which menu displays on this page.', 'tm-arden' ),
                            'default' => '',
                            'options' => Insight_Helper::get_all_menus(),
                        ),
                        array(
                            'id'      => 'menu_one_page',
                            'type'    => 'switch',
                            'title'   => esc_attr__( 'One Page Menu', 'tm-arden' ),
                            'default' => '0',
                            'options' => array(
                                '0' => esc_html__( 'Disable', 'tm-arden' ),
                                '1' => esc_html__( 'Enable', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'custom_logo',
                            'type'    => 'media',
                            'title'   => esc_attr__( 'Custom Logo', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select custom logo for this page.', 'tm-arden' ),
                            'default' => '',
                        ),
                        array(
                            'id'      => 'custom_logo_width',
                            'type'    => 'text',
                            'title'   => esc_attr__( 'Custom Logo Width', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Controls the width of custom logo. For ex: 150px', 'tm-arden' ),
                            'default' => '',
                        ),
                        array(
                            'id'      => 'custom_sticky_logo',
                            'type'    => 'media',
                            'title'   => esc_attr__( 'Custom Sticky Logo', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select custom sticky logo for this page.', 'tm-arden' ),
                            'default' => '',
                        ),
                        array(
                            'id'      => 'custom_sticky_logo_width',
                            'type'    => 'text',
                            'title'   => esc_attr__( 'Custom Sticky Logo Width', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Controls the width of custom sticky logo. For ex: 150px', 'tm-arden' ),
                            'default' => '',
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Page Title Bar', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'page_title_bar_enable',
                            'type'    => 'switch',
                            'title'   => esc_attr__( 'Visibility', 'tm-arden' ),
                            'default' => 2,
                            'options' => array(
                                0 => esc_html__( 'Disable', 'tm-arden' ),
                                1 => esc_html__( 'Enable', 'tm-arden' ),
                                2 => esc_html__( 'Default', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'page_title_bar_background',
                            'type'    => 'attach',
                            'title'   => esc_attr__( 'Background Image', 'tm-arden' ),
                            'default' => '',
                        ),
                        array(
                            'id'      => 'page_title_bar_background_overlay',
                            'type'    => 'color',
                            'title'   => esc_attr__( 'Background Overlay', 'tm-arden' ),
                            'default' => '',
                        ),
                        array(
                            'id'    => 'page_title_bar_custom_heading',
                            'type'  => 'text',
                            'title' => esc_attr__( 'Custom Heading Text', 'tm-arden' ),
                            'desc'  => esc_attr__( 'Insert custom heading for the page title bar. Leave blank to use default.', 'tm-arden' ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Sidebars', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'page_sidebar_1',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Sidebar 1', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select sidebar 1 that will display on this page.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $page_registered_sidebars,
                        ),
                        array(
                            'id'      => 'page_sidebar_2',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Sidebar 2', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select sidebar 2 that will display on this page.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $page_registered_sidebars,
                        ),
                        array(
                            'id'      => 'page_sidebar_position',
                            'type'    => 'switch',
                            'title'   => esc_html__( 'Sidebar Position', 'tm-arden' ),
                            'default' => 'default',
                            'options' => Insight_Helper::get_list_sidebar_positions( true ),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Sliders', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'revolution_slider',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Revolution Slider', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select the unique name of the slider.', 'tm-arden' ),
                            'options' => Insight_Helper::get_list_revslider(),
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Footer', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'footer_enable',
                            'type'    => 'switch',
                            'title'   => esc_attr__( 'Visibility', 'tm-arden' ),
                            'default' => 2,
                            'options' => array(
                                0 => esc_html__( 'Disable', 'tm-arden' ),
                                1 => esc_html__( 'Enable', 'tm-arden' ),
                                2 => esc_html__( 'Default', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'footer_preset',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Footer Preset', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select footer preset that displays on this page.', 'tm-arden' ),
                            'default' => '-1',
                            'options' => array(
                                '-1' => esc_html__( 'Default', 'tm-arden' ),
                                '2'  => esc_html__( 'Preset 02', 'tm-arden' ),
                                '3'  => esc_html__( 'Preset 03', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'footer_widget_01',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Footer Widget 01', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the first column of footer.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'footer_widget_02',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Footer Widget 02', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the second column of footer.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'footer_widget_03',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Footer Widget 03', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the third column of footer.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'footer_widget_04',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Footer Widget 04', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the fourth column of footer.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'footer_widget_05',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Footer Widget 05', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the fifth column of footer.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'footer_widget_06',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Footer Widget 06', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the sixth column of footer.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'footer_background',
                            'type'    => 'media',
                            'title'   => esc_attr__( 'Footer Background', 'tm-arden' ),
                            'default' => '',
                        ),
                        array(
                            'id'      => 'footer_background_overlay',
                            'type'    => 'color',
                            'title'   => esc_attr__( 'Footer Background Overlay', 'tm-arden' ),
                            'default' => '',
                        ),
                    ),
                ),
                array(
                    'title'  => esc_attr__( 'Copyright', 'tm-arden' ),
                    'fields' => array(
                        array(
                            'id'      => 'copyright_enable',
                            'type'    => 'switch',
                            'title'   => esc_attr__( 'Visibility', 'tm-arden' ),
                            'default' => 2,
                            'options' => array(
                                0 => esc_html__( 'Disable', 'tm-arden' ),
                                1 => esc_html__( 'Enable', 'tm-arden' ),
                                2 => esc_html__( 'Default', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'copyright_preset',
                            'type'    => 'select',
                            'title'   => esc_attr__( 'Copyright Preset', 'tm-arden' ),
                            'desc'    => esc_attr__( 'Select copyright preset that displays on this page.', 'tm-arden' ),
                            'default' => '-1',
                            'options' => array(
                                '-1' => esc_html__( 'Default', 'tm-arden' ),
                                '2'  => esc_html__( 'Preset 02 ( 2 Columns - White )', 'tm-arden' ),
                                '3'  => esc_html__( 'Preset 03 ( 1 Column - Secondary )', 'tm-arden' ),
                                '4'  => esc_html__( 'Preset 04 ( 2 Columns - Primary )', 'tm-arden' ),
                                '5'  => esc_html__( 'Preset 05 ( 2 Columns - Black )', 'tm-arden' ),
                                '6'  => esc_html__( 'Preset 06 ( Fluid - 2 Columns - Gray )', 'tm-arden' ),
                                '7'  => esc_html__( 'Preset 07 ( 2 Columns - Gray )', 'tm-arden' ),
                                '8'  => esc_html__( 'Preset 08 ( 1 Column - Black )', 'tm-arden' ),
                            ),
                        ),
                        array(
                            'id'      => 'copyright_widget_01',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Copyright Widget 01', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the first column of copyright.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'copyright_widget_02',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Copyright Widget 02', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the second column of copyright.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'copyright_widget_03',
                            'type'    => 'select',
                            'title'   => esc_html__( 'Copyright Widget 03', 'tm-arden' ),
                            'desc'    => esc_html__( 'Select widget that will display on the third column of copyright.', 'tm-arden' ),
                            'default' => 'default',
                            'options' => $copyright_registered_sidebars,
                        ),
                        array(
                            'id'      => 'copyright_background_color',
                            'type'    => 'color',
                            'title'   => esc_attr__( 'Copyright Background Color', 'tm-arden' ),
                            'default' => '',
                        ),
                    ),
                ),
            );

            $meta_boxes[] = array(
                'id'         => 'insight_page_options',
                'title'      => esc_html__( 'Page Options', 'tm-arden' ),
                'post_types' => array( 'page' ),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields'     => array(
                    array(
                        'type'  => 'tabpanel',
                        'items' => $general_options,
                    ),
                ),
            );

            $meta_boxes[] = array(
                'id'         => 'insight_post_options',
                'title'      => esc_html__( 'Page Options', 'tm-arden' ),
                'post_types' => array( 'post' ),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields'     => array(
                    array(
                        'type'  => 'tabpanel',
                        'items' => array_merge( array(
                                                    array(
                                                        'title'  => esc_attr__( 'Post', 'tm-arden' ),
                                                        'fields' => array(
                                                            array(
                                                                'id'    => 'post_gallery',
                                                                'type'  => 'gallery',
                                                                'title' => esc_attr__( 'Gallery Format', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'post_video',
                                                                'type'  => 'textarea',
                                                                'title' => esc_html__( 'Video Format', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'post_audio',
                                                                'type'  => 'textarea',
                                                                'title' => esc_html__( 'Audio Format', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'post_quote_text',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Quote Format - Source Text', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'post_quote_name',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Quote Format - Source Name', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'post_quote_url',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Quote Format - Source Url', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'post_link',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Link Format', 'tm-arden' ),
                                                            ),
                                                        ),
                                                    ),
                                                ), $general_options ),
                    ),
                ),
            );

            $meta_boxes[] = array(
                'id'         => 'insight_product_options',
                'title'      => esc_html__( 'Page Options', 'tm-arden' ),
                'post_types' => array( 'product' ),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields'     => array(
                    array(
                        'type'  => 'tabpanel',
                        'items' => $general_options,
                    ),
                ),
            );

            $meta_boxes[] = array(
                'id'         => 'insight_portfolio_options',
                'title'      => esc_html__( 'Page Options', 'tm-arden' ),
                'post_types' => array( 'portfolio' ),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields'     => array(
                    array(
                        'type'  => 'tabpanel',
                        'items' => array_merge( array(
                                                    array(
                                                        'title'  => esc_attr__( 'Portfolio', 'tm-arden' ),
                                                        'fields' => array(
                                                            array(
                                                                'id'      => 'portfolio_layout_style',
                                                                'type'    => 'select',
                                                                'title'   => esc_attr__( 'Single Portfolio Style', 'tm-arden' ),
                                                                'desc'    => esc_attr__( 'Select style of this single portfolio post page.', 'tm-arden' ),
                                                                'default' => '',
                                                                'options' => array(
                                                                    ''  => esc_html__( 'Default', 'tm-arden' ),
                                                                    '1' => esc_html__( 'Left Description', 'tm-arden' ),
                                                                    '2' => esc_html__( 'Right Description', 'tm-arden' ),
                                                                    '3' => esc_html__( 'Image Gallery', 'tm-arden' ),
                                                                    '4' => esc_html__( 'Image Slider', 'tm-arden' ),
                                                                    '5' => esc_html__( 'Video', 'tm-arden' ),
                                                                    '6' => esc_html__( 'Fullscreen Slider', 'tm-arden' ),
                                                                ),
                                                            ),
                                                            array(
                                                                'id'    => 'portfolio_gallery',
                                                                'type'  => 'gallery',
                                                                'title' => esc_attr__( 'Gallery', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'portfolio_video_url',
                                                                'type'  => 'textarea',
                                                                'title' => esc_html__( 'Video Url', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'portfolio_client',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Client', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'portfolio_date',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Date', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'portfolio_awards',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Awards', 'tm-arden' ),
                                                            ),
                                                            array(
                                                                'id'    => 'portfolio_url',
                                                                'type'  => 'text',
                                                                'title' => esc_html__( 'Url', 'tm-arden' ),
                                                            ),
                                                        ),
                                                    ),
                                                ), $general_options ),
                    ),
                ),
            );

            $meta_boxes[] = array(
                'id'         => 'insight_testimonial_options',
                'title'      => esc_html__( 'Testimonial Options', 'tm-arden' ),
                'post_types' => array( 'testimonial' ),
                'context'    => 'normal',
                'priority'   => 'high',
                'fields'     => array(
                    array(
                        'type'  => 'tabpanel',
                        'items' => array(
                            array(
                                'title'  => esc_html__( 'Testimonial Details', 'tm-arden' ),
                                'fields' => array(
                                    array(
                                        'id'      => 'by_line',
                                        'type'    => 'text',
                                        'title'   => esc_html__( 'By Line', 'tm-arden' ),
                                        'desc'    => esc_html__( 'Enter a byline for the customer giving this testimonial (for example: "CEO of Thememove").', 'tm-arden' ),
                                        'default' => '',
                                    ),
                                    array(
                                        'id'      => 'url',
                                        'type'    => 'text',
                                        'title'   => esc_html__( 'Url', 'tm-arden' ),
                                        'desc'    => esc_html__( 'Enter a URL that applies to this customer (for example: http://www.thememove.com/).', 'tm-arden' ),
                                        'default' => '',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            );

            return $meta_boxes;
        }

    }

    new Insight_Metabox();
}
