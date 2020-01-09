<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "spice_options";
    
    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
         'dev_mode'             => false,
        'opt_name'             => $opt_name,
        'disable_tracking'      => true,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => '<img src="'.get_template_directory_uri().'/images/logo-small.png" width="60px" height="60px" style="top:7px;position:relative;margin-right:5px;">'.$theme->get('Name'),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Spice Options', 'SPICE' ),
        'page_title'           => esc_html__( 'Spice Options', 'SPICE' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                   
        // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
       
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'spice_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        
        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'SPICE' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'SPICE' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'SPICE' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
       // $args['intro_text'] = sprintf( esc_html__( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'SPICE' ), $v );
    } else {
        //$args['intro_text'] = esc_html__( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'SPICE' );
    }

    // Add content after the form.
    //$args['footer_text'] = esc_html__( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'SPICE' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'SPICE' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'SPICE' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'SPICE' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'SPICE' )
        )
    );



     $sample_patterns_path   = ReduxFramework::$_dir . '../theme-options/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../theme-options/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;          

    ob_start();        



    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( 'This is the sidebar content, HTML is allowed.', 'SPICE' );
    Redux::setHelpSidebar( $opt_name, $content );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'General Settings', 'SPICE' ),
        'id'    => 'section-general-settings',
        'desc'  => esc_html__( 'Basic fields as subsections.', 'SPICE' ),
        'icon'  => 'el el-home'
    ) );  



    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Logo & Favicon', 'SPICE' ),
        'id'         => 'subsection-logo-settings',
        'icon'      => 'el el-certificate',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'opt-logo-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Add/Edit Logo', 'SPICE'),
            ),
            array(
                'id'       => 'opt-favicon-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Add/Edit Favicon', 'SPICE'),
            ),
            array(
                'id'        => 'opt-front-login-form',
                'type'      => 'switch',
                'title'     => esc_html__('Front End Login', 'SPICE'),                   
                'default'   =>1
            ),
            array(
                'id'        => 'opt-banner-blur-switch',
                'type'      => 'switch',
                'title'     => esc_html__('Banner Blur Effect', 'SPICE'),                   
                'default'   =>0
            ),
            array(
                'id'        => 'opt-smooth-scroll-switch',
                'type'      => 'switch',
                'title'     => esc_html__('Smooth Scroll', 'SPICE'),                   
                'default'   =>0
            ),
            array(
                    'id'        => 'google-map-api',
                    'type'      => 'text',
                    'title'     => esc_html__('API key for Google Map', 'SPICE'),                        
                    'desc'      => esc_html__('Please enter api key for google map', 'SPICE'),
            ),                    
        )
    ) );  


    /**************  CONTACT OPTION *********/
            
            Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Contact Option', 'SPICE' ),
        'id'         => 'section-contact-settings',
        'subsection' => true,
        'icon'      => 'el-icon-phone',
        'fields'     => array(
            array(   
                'id'        => 'opt-contact-email',
                'type'      => 'text',
                'title'     => esc_html__('Email', 'SPICE'),                               
                'validate'  => 'email',
                'msg'       => 'Please enter valid email id for contact',
                'default'   => 'info@0effortthemes.com',
            ),
            array(
                'id'        => 'opt-contact-phone',
                'type'      => 'text',
                'title'     => esc_html__('Phone No.', 'SPICE'),               
                'validate'  => 'no_special_chars',
                'default'   => '91__________'
            ), 
        )
    ) );   
            /************   CONTACT OPTIONS ENDS HERE *****/
            
            /***** side SECTION *****/
          Redux::setSection( $opt_name,array(
                'icon'      => 'el-icon-website',
                'title'     => esc_html__('Sidebar', 'SPICE'),
                'subsection'=> true,                
                'fields'    => array(
                    array(
                        'id'        => 'opt-single-post-sidebar',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Single Post sidebar Option', 'SPICE'),                                              
                        
                        'options'   => array(
                            '1' => array('alt' => '1 Column',        'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            '2' => array('alt' => '2 Column Left',   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            '3' => array('alt' => '2 Column Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png')
                          
                        ), 
                        'default' => '3'
                        
                    ),
                     array(
                        'id'        => 'opt-single-page-sidebar',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Single Page sidebar Option', 'SPICE'),                       
                        
                        //Must provide key => value(array:title|img) pairs for radio options
                        'options'   => array(
                            '1' => array('alt' => '1 Column',        'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
                            '2' => array('alt' => '2 Column Left',   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                            '3' => array('alt' => '2 Column Right',  'img' => ReduxFramework::$_url . 'assets/img/2cr.png')                          
                        ), 
                        'default' => '3'
                    ),                    
                ),
            ));  
            


    Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Social Links', 'SPICE' ),
        'id'    => 'section-sociallinks-settings',
        'desc'  => esc_html__( 'Basic fields as subsections.', 'SPICE' ),
        'icon'  => 'el el-icon-link',
        'subsection'=> true,
        'fields'=> array(
          
                    /***** Social Media One Starts HERE **/
                      
                    array(
                        'id'        => 'social-media-one-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Media One', 'SPICE'),                       

                    ),
                    array(
                        'id'        => 'social-media-one-start',
                        'type'      => 'section',
                        'title'     => esc_html__('Social One', 'SPICE'),                       
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-one-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-one-text',
                        'type'      => 'text',
                        'title'     => esc_html__('Social One Title', 'SPICE'),                        
                        'desc'      => esc_html__('Please enter the title for Social One', 'SPICE'),
                    ),
                    array(
                        'id'        => 'social-one-url',
                        'type'      => 'text',
                        'title'     => esc_html__('Social One URL', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter your social one page', 'SPICE'),
                        'validate'  => 'url',                      
                    ),
                    array(
                        'id'        => 'social-one-icon',
                        'type'      => 'select',
                        'title'     => esc_html__('Social Icons', 'SPICE'),
                        'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'SPICE'),
                        'options'   => array(
                            'fa-facebook' => 'Facebook', 
                            'fa-google-plus' => 'Google+', 
                            'fa-twitter' => 'Twitter',
                            'fa-dribbble'=>'Dribble',
                            'fa-pinterest'=>'Pinterest',
                            'fa-instagram'=>'Instagram',
                            'fa-linkedin'=>'Linkedin',
                            'fa-reddit'=>'Red IT',
                            'fa-flickr'=>'Flickr',
                            'fa-behance'=>'Behance',
                            'fa-digg'=>'Digg',
                            'fa-youtube'=>'Youtube',
                            'fa-tumblr'=>'Tumblr',
                            'fa-delicious'=>'Delicious',
                            'fa-vimeo-square'=>'Vimeo'
                        ),                       
                    ),
                    array(
                        'id'        => 'social-media-one-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-one-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-media-two-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Media Two', 'SPICE'),                       
                    ),
                    array(
                        'id'        => 'social-media-two-start',
                        'type'      => 'section',
                        'title'     => esc_html__('Social Two', 'SPICE'),                       
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-two-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-two-text',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Two Title', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter the title for Social Two', 'SPICE'),   
                    ),
                    array(
                        'id'        => 'social-two-url',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Two URL', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter your social two page', 'SPICE'),
                        'validate'  => 'url',                       
                    ),
                    array(
                        'id'        => 'social-two-icon',
                        'type'      => 'select',
                        'title'     => esc_html__('Social Icons', 'SPICE'),
                        'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'SPICE'),
                        'options'   => array(
                            'fa-facebook' => 'Facebook', 
                            'fa-google-plus' => 'Google+', 
                            'fa-twitter' => 'Twitter',
                            'fa-dribbble'=>'Dribble',
                            'fa-pinterest'=>'Pinterest',
                            'fa-instagram'=>'Instagram',
                            'fa-linkedin'=>'Linkedin',
                            'fa-reddit'=>'Red IT',
                            'fa-flickr'=>'Flickr',
                            'fa-behance'=>'Behance',
                            'fa-digg'=>'Digg',
                            'fa-youtube'=>'Youtube',
                            'fa-tumblr'=>'Tumblr',
                            'fa-delicious'=>'Delicious',
                            'fa-vimeo-square'=>'Vimeo'
                        ), 
                    ),
                    array(
                        'id'        => 'social-media-two-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-two-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-media-three-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Media Three', 'SPICE'),                       

                    ),
                    array(
                        'id'        => 'social-media-three-start',
                        'type'      => 'section',
                        'title'     => esc_html__('Social Three', 'SPICE'),                       
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-three-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-three-text',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Three Title', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter the title for Social Three', 'SPICE'),
                    ),
                    array(
                        'id'        => 'social-three-url',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Three URL', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter your social three page', 'SPICE'),
                        'validate'  => 'url',                      
                    ),
                    array(
                        'id'        => 'social-three-icon',
                        'type'      => 'select',
                        'title'     => esc_html__('Social Icons', 'SPICE'),
                        'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'SPICE'),
                        'options'   => array(
                            'fa-facebook' => 'Facebook', 
                            'fa-google-plus' => 'Google+', 
                            'fa-twitter' => 'Twitter',
                            'fa-dribbble'=>'Dribble',
                            'fa-pinterest'=>'Pinterest',
                            'fa-instagram'=>'Instagram',
                            'fa-linkedin'=>'Linkedin',
                            'fa-reddit'=>'Red IT',
                            'fa-flickr'=>'Flickr',
                            'fa-behance'=>'Behance',
                            'fa-digg'=>'Digg',
                            'fa-youtube'=>'Youtube',
                            'fa-tumblr'=>'Tumblr',
                            'fa-delicious'=>'Delicious',
                            'fa-vimeo-square'=>'Vimeo'
                        ),
                    ),
                    array(
                        'id'        => 'social-media-three-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-three-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-media-four-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Social Media Four', 'SPICE'),                       
                    ),
                    array(
                        'id'        => 'social-media-four-start',
                        'type'      => 'section',
                        'title'     => esc_html__('Social Four', 'SPICE'),                       
                        'indent'    => true, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-four-checkbox', "=", 1),
                    ),
                    array(
                        'id'        => 'social-four-text',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Four Title', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter the title for Social Four', 'SPICE'),   
                    ),
                    array(
                        'id'        => 'social-four-url',
                        'type'      => 'text',
                        'title'     => esc_html__('Social Four URL', 'SPICE'),                       
                        'desc'      => esc_html__('Please enter your social three page', 'SPICE'),
                        'validate'  => 'url',
                    ),
                    array(
                        'id'        => 'social-four-icon',
                        'type'      => 'select',
                        'title'     => esc_html__('Social Icons', 'SPICE'),
                        'subtitle'  => esc_html__('Selected Icon will be shown in called sections', 'SPICE'),
                        'options'   => array(
                            'fa-facebook' => 'Facebook', 
                            'fa-google-plus' => 'Google+', 
                            'fa-twitter' => 'Twitter',
                            'fa-dribbble'=>'Dribble',
                            'fa-pinterest'=>'Pinterest',
                            'fa-instagram'=>'Instagram',
                            'fa-linkedin'=>'Linkedin',
                            'fa-reddit'=>'Red IT',
                            'fa-flickr'=>'Flickr',
                            'fa-behance'=>'Behance',
                            'fa-digg'=>'Digg',
                            'fa-youtube'=>'Youtube',
                            'fa-tumblr'=>'Tumblr',
                            'fa-delicious'=>'Delicious',
                            'fa-vimeo-square'=>'Vimeo'                         
                        ),                       
                    ),             
                    array(
                        'id'        => 'social-media-four-end',
                        'type'      => 'section',
                        'indent'    => false, // Indent all options below until the next 'section' option is set.
                        'required'  => array('social-media-four-checkbox', "=", 1),
                    ),


            ),
    ) ); 

    
        /***** side SECTION *****/
          Redux::setSection( $opt_name,array(
                'icon'      => ' el el-screen',
                'title'     => esc_html__('Header Options', 'SPICE'),
                'subsection'=> true,               
                'fields'    => array(
                                    array(
                                        'id'        => 'opt-header-type',
                                        'type'      => 'switch',
                                        'title'     => esc_html__('Header Type', 'SPICE'),
                                        'off'       => 'Light',
                                        'on'        => 'Dark',
                                    ),
                                     array(
                                        'id'        => 'opt-sticky-header',
                                        'type'      => 'switch',
                                        'title'     => esc_html__('Sticky Menu', 'SPICE'),
                                        'on'       => 'Yes',
                                        'off'        => 'No',
                                        'default'   =>1
                                    ),
                                    array(
                                        'id'        => 'opt-header-style',
                                        'type'      => 'image_select',
                                        'title'     => esc_html__('Header Styles', 'SPICE'),                                          
                                        'options'   => array(
                                            '1' => array('alt' => 'Default Header',   'title' => 'Default Header',     'img' =>get_template_directory_uri() . '/images/header_images/default_header.jpg'), 
                                            '2' => array('alt' => 'Header Style One',   'title' => 'Header Style One',     'img' => get_template_directory_uri() . '/images/header_images/header_style_1.jpg'),                                                  
                                            '3' => array('alt' => 'Header Style Two',   'title' => 'Header Style Two',     'img' => get_template_directory_uri() . '/images/header_images/header_style_2.jpg'),                                                  
                                            '4' => array('alt' => 'Header Style Three',   'title' => 'Header Style Three',     'img' => get_template_directory_uri() . '/images/header_images/header_style_3.jpg'),                                                  
                                        ), 
                                        'default'   => '1'                        
                                    ),      
                      
                ),
            ));  
            Redux::setSection( $opt_name,array(
                'icon'      => 'el el-screen',
                'title'     => esc_html__('Banner Options', 'SPICE'),
                'subsection'=> true,                
                'fields'    => array(     

                                        array(
                                            'id'        => 'home-page-banner',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Home Page banner', 'SPICE'),
                                            'subtitle'  => esc_html__('', 'SPICE'),
                                            'on'       => 'Static',
                                            'off'        => 'Slider',
                                            'default'   => 1
                                        ),
                                        array(
                                            'id'        => 'home-page-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Static Banner', 'SPICE'),
                                            'subtitle'  => esc_html__('', 'SPICE'),
                                            'indent'    => true, 
                                            'required'  => array('home-page-banner', "=", 1),
                                        ),
                                        array(
                                            'id'       => 'home-page-static-banner',
                                            'type'     => 'media',
                                            'url'      => true,
                                            'title'    => esc_html__('Home Page Static Banner', 'SPICE'),
                                        ),
                                        array(
                                            'id'               => 'home-page-banner-text',
                                            'type'             => 'editor',
                                            'title'            => esc_html__('Banner Text', 'SPICE'),                                            
                                            'default'          => '<div class="top-heading"><h2>SET BANNER & CONTENT FROM THEME OPTIONS</h2></div>',
                                            'args'   => array(
                                                'media_buttons'    => false,
                                                'teeny'            => true,
                                                'textarea_rows'    => 10
                                            )
                                        ),
                                        
                                        array(
                                            'id'        => 'home-page-end',
                                            'type'      => 'section',
                                            'indent'    => false, 
                                            'required'  => array('home-page-banner', "=", 1),
                                        ),
                                        /*****************************************************/
                                        array(
                                            'id'        => 'home-slider-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Home Page slider', 'SPICE'),
                                            'subtitle'  => esc_html__('', 'SPICE'),
                                            'indent'    => true, 
                                            'required'  => array('home-page-banner', "=", 0),
                                        ),
                                        array(
                                            'id'       => 'opt-header-slider-shortcode',
                                            'type'     => 'text',
                                            'title'    => esc_html__('Slider shortcode', 'SPICE'),
                                        ),                                      
                                        
                                        array(
                                            'id'        => 'home-slider-end',
                                            'type'      => 'section',
                                            'indent'    => false, 
                                            'required'  => array('home-page-banner', "=", 0),
                                        ),


                                       
                                    ),
            ));  

            Redux::setSection( $opt_name,array(
                'icon'      => 'el el-photo',
                'title'     => esc_html__('Footer Options', 'SPICE'),
                'subsection'=> true,               
                'fields'    => array(  

                                        array(
                                            'id'        => 'footer-logo',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Show Logo in footer', 'SPICE'),                                                                                        
                                            'default'   => 0

                                        ), 
                                        array(
                                            'id'        => 'footer-logo-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Add Footer Logo', 'SPICE'),                                            
                                            'indent'    => true, 
                                            'required'  => array('footer-logo', "=", 1),
                                        ),
                                        array(
                                            'id'       => 'footer-logo-image',
                                            'type'     => 'media',
                                            'url'      => true,
                                            'title'    => esc_html__('Add/Edit Logo', 'SPICE'),
                                            'subtitle'  => esc_html__('If blank default logo will be shown','SPICE'),
                                        ),
                                        
                                        array(
                                            'id'        => 'footer-logo-end',
                                            'type'      => 'section',
                                            'indent'    => false, 
                                            'required'  => array('footer-logo', "=", 1),
                                        ),

                                        /*---------------------------------------------------------*/

                                        

                                        array(
                                            'id'        => 'google-map-checkbox',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Show Footer Google Map', 'SPICE'),   
                                            'subtitle'  => esc_html__('Please set GOOGLE MAP API to get the result','SPICE'),
                                            'default'   => 0

                                        ),
                                        array(
                                            'id'        => 'google-map-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Google Map Setting', 'SPICE'),                                           
                                            'indent'    => true, // Indent all options below until the next 'section' option is set.
                                            'required'  => array('google-map-checkbox', "=", 1),
                                        ),
                                        array(
                                            'id'        => 'google-map-color',
                                            'type'      => 'color',
                                            'title'     => esc_html__('Google Map Color', 'SPICE'),
                                            'default'  => '#FFFFFF',
                                            'validate' => 'color',
                                            'transparent'=>false,                                            
                                            'subtitle'  => esc_html__('', 'SPICE'),
                                            
                                        ),                                        

                                        array(
                                            'id'       => 'google-map-latlong',
                                            'type'     => 'text',
                                            'title'    => esc_html__('Latitude and Longitute for Main Shop', 'SPICE'),
                                        ),
                                        array(
                                            'id'       => 'main-shop-title',
                                            'type'     => 'text',
                                            'title'    => esc_html__('Main Shop Title', 'SPICE'),
                                        ),
                                        array(
                                            'id'               => 'main-shop-infowindow',
                                            'type'             => 'editor',
                                            'title'            => esc_html__('Main Shop Infowindow Text', 'SPICE'),                                                                                        
                                            'args'   => array(
                                                'media_buttons'    => false,
                                                'teeny'            => true,
                                                'textarea_rows'    => 10
                                            )
                                        ),

                                        array(
                                            'id'        => 'google-map-marker',
                                            'type'      => 'media',
                                            'title'     => esc_html__('Google Map Marker ', 'SPICE'),                                           
                                                           
                                        ),

                                        array(
                                            'id'        => 'footer-map-search',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Show Search in footer', 'SPICE'),                                           
                                            'default'   => 1

                                        ), 
                                       
                                        array(
                                            'id'        => 'google-map-end',
                                            'type'      => 'section',
                                            'indent'    => false, // Indent all options below until the next 'section' option is set.
                                            'required'  => array('google-map-checkbox', "=", 1),
                                        ),

                                    ),
            ));  
    
            Redux::setSection( $opt_name,array(
                'icon'      => 'el el-lines',
                'title'     => esc_html__('Menu Styling', 'SPICE'),
                'subsection'=> true,               
                'fields'    => array(                                    
                                        array(
                                                    'id'            => 'opt-typography-menu',
                                                    'type'          => 'typography',
                                                    'title'         => esc_html__('Menu Font, size and color', 'SPICE'),
                                                    //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                                                    'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                                                    //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                                                    'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                                                    'subsets'       => false, // Only appears if google is true and subsets not set to false
                                                    //'font-size'     => false,
                                                    'line-height'   => false,
                                                    'text-align'=>false,                                                   
                                                    'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                                                    'output'        => array('menu'), // An array of CSS selectors to apply this font style to dynamically
                                                    'compiler'      => array('menu'), // An array of CSS selectors to apply this font style to dynamically
                                                    'units'         => 'px', // Defaults to px
                                                    'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                                                    'default'       => array(
                                                            'color'         => '#333',
                                                            'font-style'    => '700',
                                                            'font-family'   => 'Abel',
                                                            'google'        => true,
                                                            'font-size'     => '33px',
                                                            'line-height'   => '50px'
                                                            ),
                                            ),
                                    ),
            ));  
    // 
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Page Settings', 'SPICE' ),
        'id'         => 'single-page-settings',
        'icon'       => 'el-icon-list',
        'fields'     => array(
                                        array(
                                            'id'        => 'single-page-banner',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Single Page banner', 'SPICE'),                                           
                                            'on'       => 'Static',
                                            'off'        => 'Slider',
                                            'default'   => 1
                                        ),
                                        array(
                                            'id'        => 'single-page-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Static Banner', 'SPICE'),                                           
                                            'indent'    => true, 
                                            'required'  => array('single-page-banner', "=", 1),
                                        ),
                                        array(
                                            'id'       => 'single-page-static-banner',
                                            'type'     => 'media',
                                            'url'      => true,
                                            'title'    => esc_html__('Single Page Static Banner', 'SPICE'),
                                        ),                                       
                                        
                                        array(
                                            'id'        => 'single-page-end',
                                            'type'      => 'section',
                                            'indent'    => false, 
                                            'required'  => array('single-page-banner', "=", 1),
                                        ),
                                        /*****************************************************/
                                        array(
                                            'id'        => 'single-slider-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Single Page slider', 'SPICE'),                                           
                                            'indent'    => true, 
                                            'required'  => array('single-page-banner', "=", 0),
                                        ),
                                        array(
                                            'id'       => 'single-page-slider',
                                            'type'     => 'text',
                                            'url'      => true,
                                            'title'    => esc_html__('Slider Shortcode', 'SPICE'),
                                        ),                                        
                                        
                                        array(
                                            'id'        => 'single-slider-end',
                                            'type'      => 'section',
                                            'indent'    => false, 
                                            'required'  => array('single-page-banner', "=", 0),
                                        ),

                            )    
    ) ); 
    
    
      Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page Settings', 'SPICE' ),
        'id'         => 'fourofour-page-settings',
        'icon'       => 'el-icon-list',
        'fields'     => array(
                                        array(
                                            'id'       => 'banner-404-image',
                                            'type'     => 'media',
                                            'url'      => true,
                                            'title'    => esc_html__('Banner Image for 404', 'SPICE'),
                                        ),
                                        array(
                                            'id'               => '404-page-text',
                                            'type'             => 'editor',
                                            'title'            => esc_html__('Banner Text', 'SPICE'),                                            
                                            'default'          => '',
                                            'args'   => array(
                                                'media_buttons'    => true,
                                                'teeny'            => true,
                                                'textarea_rows'    => 10
                                            )
                                        ),                                       
                                       
                            )    
    ) ); 
    
    
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Styling Option', 'SPICE' ),
        'id'         => 'section-styling-settings',
        'icon'       => 'el-icon-fontsize',
        'fields'     => array(
            
                array(
                        'id'            => 'opt-typography-h1',
                        'type'          => 'typography',
                        'title'         => esc_html__('H1 Font, size and color', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key									
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        //'color'=>true,
                        'text-align'=>false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h2.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                        
                ),


                  array(
                        'id'            => 'opt-typography-h2',
                        'type'          => 'typography',
                        'title'         => esc_html__('H2 Font, size and color', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        'text-align'=>false,                       
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                       
                ),

                 array(
                        'id'            => 'opt-typography-h3',
                        'type'          => 'typography',
                        'title'         => esc_html__('H3 Font, size and color', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        'text-align'=>false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h3.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('h3.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                        
                ),

                 array(
                        'id'            => 'opt-typography-h4',
                        'type'          => 'typography',
                        'title'         => esc_html__('H4 Font, size and color', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        'text-align'=>false,                       
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h4.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('h4.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                        
                ),

                 array(
                        'id'            => 'opt-typography-h5',
                        'type'          => 'typography',
                        'title'         => esc_html__('H5 Font, size and color', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        'text-align'=>false,                        
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h5.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('h5.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                        
                ),
                 array(
                        'id'            => 'opt-typography-h6',
                        'type'          => 'typography',
                        'title'         => esc_html__('H6 Font, size and color', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        'text-align'=>false,                       
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h6.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('h6.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                        
                ),

                 array(
                        'id'            => 'opt-typography-p',
                        'type'          => 'typography',
                        'title'         => esc_html__('Paragraphs', 'SPICE'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        //'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height'   => false,
                        'text-align'=>false,                       
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('p.site-description, .entry-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'      => array('p.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => esc_html__('Typography option with each property can be called individually.', 'SPICE'),
                        
                ),
            
        ) 
    ) );  
    
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Post/Page Layout', 'SPICE' ),
        'id'         => 'section-layout-settings',
        'icon'       => 'el-icon-list',
        'fields'     => array(
                    array(
                        'id'        => 'gn-author-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Author', 'SPICE'),                       
                        'default'=> '1',
                    ),                   
                    array(
                        'id'        => 'gn-cat-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Category', 'SPICE'),                       
                        'default'=> '1',

                    ),
                    array(
                        'id'        => 'gn-comments-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Comments', 'SPICE'),                       
                        'default'=> '1',
                    ),
                    array(
                        'id'        => 'gn-tags-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Tags', 'SPICE'),                       
                        'default'=> '1',
                    ),
                    array(
                        'id'        => 'gn-fitimage-checkbox',
                        'type'      => 'switch',
                        'title'     => esc_html__('Post Fit Image', 'SPICE'),
                        'subtitle'  => esc_html__('This will make the Post Thumbnail image fit with the container & work only in the blog page', 'SPICE'),
                        'default'=> '0',
                    ),
                    /************************************/

                         array(
                                            'id'        => 'spice-share-checkbox',
                                            'type'      => 'switch',    
                                            'title'     =>'Show Social Share',                                                                                   
                                            'default'   => 1

                                        ),
                                        array(
                                            'id'        => 'social-share-start',
                                            'type'      => 'section',
                                            'title'     => esc_html__('Social Sharing', 'SPICE'),                                           
                                            'indent'    => true, // Indent all options below until the next 'section' option is set.
                                            'required'  => array('spice-share-checkbox', "=", 1),
                                        ),                                       
                                               
                                        array(
                                            'id'        => 'twitter-share',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Share in Twitter', 'SPICE'),                                           
                                            'default'   => 1

                                        ), 
                                         array(
                                            'id'        => 'fb-share',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Share in Facebook', 'SPICE'),                                           
                                            'default'   => 1

                                        ), 
                                          array(
                                            'id'        => 'pinterest-share',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Share in Pinterest', 'SPICE'),                                           
                                            'default'   => 1

                                        ), 
                                        
                                        array(
                                            'id'        => 'gp-share',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Share in Google Plus', 'SPICE'),                                           
                                            'default'   => 1

                                        ), 

                                        array(
                                            'id'        => 'linkedin-share',
                                            'type'      => 'switch',
                                            'title'     => esc_html__('Share in Linkedin', 'SPICE'),                                           
                                            'default'   => 1

                                        ),

                                        array(
                                            'id'        => 'social-share-end',
                                            'type'      => 'section',
                                            'indent'    => false, // Indent all options below until the next 'section' option is set.
                                            'required'  => array('spice-share-checkbox', "=", 1),
                                        ),

                    /***********************************/

        )    
    ) ); 
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Book Table Settings', 'SPICE' ),
        'id'         => 'section-boktable-settings',
        'icon'       => 'el-icon-tag',
        'fields'     => array(   


             array(   
                'id'        => 'opt-booking-contact-email',
                'type'      => 'text',
                'title'     => esc_html__('Booking Contact Email', 'SPICE'),                
                'validate'  => 'email',
                'msg'       => 'Please enter valid email id for contact',
                'default'   => 'info@0effortthemes.com',
            ), 
            array(
                'id'               => 'booking-reponse-msg',
                'type'             => 'editor',
                'title'            => esc_html__('Automail Response Text', 'SPICE'), 
                'desc'         => esc_html__('Auto Responder mail against booking,[customername] will replaced by the custome name', 'SPICE'),
                'default'          => 'Hi [customername],<br>Thanks for booking.<br>Once approved you will get mail from our Team.',
                'args'   => array(
                    'media_buttons'    => false,
                    'teeny'            => true,
                    'textarea_rows'    => 10
                )
            ),
           array(
                'id'       => 'opt-occasions',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'Booking Occasions', 'SPICE' ),
                'subtitle' => esc_html__( 'add occasions for table booking', 'SPICE' ),
              
            ),
        )    
    ) ); 
    
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Codes', 'SPICE' ),
        'id'         => 'section-customcode-settings',
        'icon'       => 'el-icon-tag',
        'fields'     => array(

             array(
                'id'        => 'opt-ace-editor-css',
                'type'      => 'ace_editor',
                'title'     => esc_html__('CSS Code', 'SPICE'),
                'subtitle'  => esc_html__('Paste your CSS code here.', 'SPICE'),
                'mode'      => 'css',
                'theme'     => 'monokai',                
                'default'   => "#header{\nmargin: 0 auto;\n}"
            ),
            array(
                'id'        => 'footer-text',
                'type'      => 'ace_editor',
                'title'     => esc_html__('Footer Text', 'SPICE'),
                'subtitle'  => esc_html__('Paste your Footer Text here.', 'SPICE'),
                'mode'      => 'html',
                'theme'     => 'monokai',
                'desc'      => '',
                'default'   => "<p>&copy;0effortthemes Developed by ITOBUZ</p>"
            ),
            array(
                'id' => 'opt-ace-editor-js',
                'type' => 'ace_editor',
                'title' => esc_html__('Javascript Code', 'SPICE'),
                'subtitle' => esc_html__('Paste your Javascript code here.', 'SPICE'),
                'mode' => 'javascript',
                'theme' => 'monokai',
                'default' => ""
            )
        )    
    ) ); 
    
    
  if ( class_exists( 'WooCommerce' ) ) {
    
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Shop Settings', 'SPICE' ),
        'id'         => 'section-woocommerce-settings',
        'icon'       => 'el-icon-shopping-cart-sign',
        'fields'     => array(

                            array(
                                        'id'        => 'opt-cart-menu',
                                        'type'      => 'switch',
                                        'title'     => esc_html__('Cart in Top Menu', 'SPICE'),
                                        'on'       => 'Yes',
                                        'off'        => 'No',
                                        'default'   =>1
                                    ),

                            array(
                                        'id'        => 'opt-cart-side',
                                        'type'      => 'switch',
                                        'title'     => esc_html__('Cart at Side', 'SPICE'),
                                        'on'       => 'Yes',
                                        'off'        => 'No',
                                        'default'   =>1
                                    ),

                            array(
                                        'id'        => 'opt-cart-off',
                                        'type'      => 'switch',
                                        'title'     => esc_html__('Catalogue Mode', 'SPICE'),
                                        'on'       => 'Yes',
                                        'off'        => 'No',
                                        'default'   =>'off'
                                    ),

                            array(
                                'id'        => 'opt-products-number',
                                'type'      => 'text',
                                'title'     => esc_html__('Number of products in shop page', 'SPICE'),                               
                                'validate'  => 'no_special_chars',
                                'default'   => '9'
                            ), 
                            
                            array(
                                        'id'        => 'opt-grid-number',
                                        'type'      => 'image_select',
                                        'title'     => esc_html__('Grid Column', 'SPICE'),                                          
                                        
                                        'options'   => array(
                                            '1' => array('alt' => 'Two Column',   'title' => '2 Column',     'img' =>get_template_directory_uri() . '/images/shop-settings-images/2.png'), 
                                            '2' => array('alt' => 'Three Column',   'title' => '3 Column',     'img' => get_template_directory_uri() . '/images/shop-settings-images/3.png'),                                                  
                                            '3' => array('alt' => 'Four Column', 'class'=>'col-4-shop',  'title' => '4 Column',     'img' => get_template_directory_uri() . '/images/shop-settings-images/4.png'),                                                  
                                            
                                        ), 
                                        'default'   => '2'                        
                                    ),      

                            array(
                                'id'        => 'opt-shop-layout',
                                'type'      => 'image_select',
                                'title'     => esc_html__('Shop Page Layout', 'SPICE'),                               
                                'options'  => array(
                                                '1'      => array(
                                                    'alt'   => '1 Column', 
                                                    'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                                                ),
                                                '2'      => array(
                                                    'alt'   => '2 Column Left', 
                                                    'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                                                ),
                                                '3'      => array(
                                                    'alt'   => '2 Column Right', 
                                                    'img'  => ReduxFramework::$_url.'assets/img/2cr.png',
                                                    
                                                ),                                              
                                            ),
                                'default' => '3'
                            ), 
            
         )    
    ) ); 

    }   
    /*
     * <--- END SECTIONS
     */
