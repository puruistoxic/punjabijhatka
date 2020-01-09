<?php
	
	/*******************  ADDED WOOCOMMERCE RELATED FUNCTIONS *********/
	if ( class_exists( 'WooCommerce' ) )
	{
		require_once( get_template_directory() . '/includes/functions/spice_wc-functions.php' );
	}
	/****************************************************************************
	Install Plugins
	****************************************************************************/

	require_once( get_template_directory().'/plugins/spice-plugins.php' );	

	/**
	 * 	Function Name 	: spice_setup_theme
	 *	Description 	: This function will set all the default settings related to the theme.
	 */
	add_action( 'after_setup_theme', 'spice_setup_theme' );
	if ( ! function_exists( 'spice_setup_theme' ) )
	{
		function spice_setup_theme()
		{						
			/* Loading Scripts and Styles for Theme for users */
			add_action( 'wp_enqueue_scripts', 'spice_load_scripts_styles',1 );
			add_action( 'admin_enqueue_scripts', 'spice_admin_scripts_styles' );
			add_action( 'wp_head', 'spice_dynamic_scripts_styles',17);				
			add_action( 'wp_head', 'spice_getPageStyles',18);

			
			/* to make the woocomerce pagination identical to the default pagination for the theme */
			add_filter( 'woocommerce_pagination_args', 	'spice_woocommerce_pagination_arrow' );
		
			/* Register menus */
			add_action( 'init', 'spice_register_menus' );	

			/* Mobile Specific Metas */
			add_action( 'wp_head', 'spice_add_viewport_meta' );

			/****** REDUX SETTINGS STARTS ******/

			if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/includes/redux/ReduxCore/framework.php' ) ) 
			{
                require_once( get_template_directory() . '/includes/redux/ReduxCore/framework.php' );
            }         
            if ( !isset( $redux_demo ) && file_exists( get_template_directory() . '/includes/redux/theme-options/awesomespice-config.php' ) ) 
    		{
        		require_once( get_template_directory() . '/includes/redux/theme-options/awesomespice-config.php' );  

    		}     
    		//if ( !isset( $redux_demo ) &&  file_exists( get_template_directory().'/includes/redux/redux-extensions/extensions-init.php' ) )     			
    		//{
    			require_once get_template_directory() . '/includes/redux/redux-extensions/extensions-init.php';        		                
    		//}    		   		
            /****** REDUX SETTINGS ENDS ******/

            /****** ADDING CMB for Custom Metabox ******/
			if ( ! class_exists( 'cmb_Meta_Box' ) )	
			{	
				require_once (get_template_directory().'/includes/cmb/init.php');	
				add_filter('cmb2_meta_box_url','spice_filter_cmb2_url');
			}
			/****** END OF CMB ******/

			/****** ADDED CONTENT WIDTH ******/
			if ( ! isset( $content_width ) ) {	$content_width = 1170; }	

			/****** ADDING THEME SUPPORTS ******/

			add_theme_support( 'post-thumbnails' ); 			
			add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
			add_theme_support( 'title-tag' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'custom-header');
			add_theme_support( 'custom-background' );
			add_theme_support( 'woocommerce' ); //adding woo-commerce support to theme
			add_editor_style('css/editor-style.css');

			/****** END OF THEME SUPPORTS ******/

			/****** ADD IMAGE SIZE STARTS ******/

			if ( function_exists( 'add_image_size' ) ) 
			{
				add_image_size('spice-homepage-food-size',188,147);// Added for Breakfast, Lunch, Dinner Section in homepage	
				add_image_size('spice-homepage-everyday-events',269,348);// Added for Everyday Events Section in homepage							
				add_image_size('spice-blog-image-size',285,325,true);
				add_image_size('spice-blog-image-size-full',570,650,true);
				add_image_size('spice-blog-image-size-new',846,474,true);
				add_image_size('spice-blog-single-image-size',766,290,true);
				add_image_size('spice-single-page-thumb',766,290,true);
				add_image_size('spice-menu-list-banner-size',1034,247,true);
				add_image_size('spice-home-page-event-style2',572,370,true);
				add_image_size('spice-chef-style2-image', 200,500,true);



				add_image_size('spice-woocommerce-shop-thumb', 370, 270,true);
				add_image_size('spice-woocommerce-single-thumb-small', 115, 115, true);
				add_image_size('spice-woocommerce-single-thumb-big', 555, 380, true);
				add_image_size('spice-woocommerce-single-thumb2', 370);
				add_image_size('spice-cart_item_image_size', 200, 200, array( 'center', 'center' ) );
			}

			/****** ADD IMAGE SIZE ENDS ******/				
			add_theme_support( 'post-formats', array( 'gallery','image','video' ) );			
			if (isset($_GET["activated"]) && $pagenow = "themes.php") 
			{ 				
        		wp_safe_redirect(admin_url('themes.php?page=spice_options'));        		
        	}

		}//end of function
	}//end if

	
	
	// WooCommerce's SPICE Style
	function spice_enqueue_woocommerce_style()
	{	    
		if ( class_exists( 'woocommerce' ) ) 
		{
			wp_enqueue_style( 'woocommerce' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'spice_enqueue_woocommerce_style' );

	/**
	* 	Function Name 	: spice_add_viewport_meta
	*	Description 	: Adding Viewport Meta to the header
	*/
	function spice_add_viewport_meta()
	{
		echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />';
	}//end of function


	/**
	* 	Function Name 	: spice_load_scripts_styles
	*	Description 	: Loading the required script and style. 
	*/	
	function spice_load_scripts_styles()
	{
		$template_dir = get_template_directory_uri();
		global $wp_styles,$wp_scripts;
		$page_template='';

		/***** STYLE LOADING START *****/	

		wp_enqueue_style( 'spice-style-font-awesome', $template_dir . '/css/font-awesome.min.css', array() );
		wp_enqueue_style( 'spice-style-animate', $template_dir . '/css/animate.min.css', array() );	

		$font_families="Lato:300,400,700|Source Sans Pro|Great Vibes";
		$query_args['family'] =  urlencode( $font_families );
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		wp_enqueue_style( 'spice-theme-style-fonts',$fonts_url, array(), null );


		wp_enqueue_style( 'spice-style', get_stylesheet_uri() ); // BASIC STYLE FOR THEME				
		wp_enqueue_style( 'bxslider', $template_dir . '/css/jquery.bxslider.css', array(), null );		
		wp_enqueue_style( 'owl-carousel', $template_dir . '/css/owl.carousel.css', array(), null );
		wp_enqueue_style( 'owl-theme', $template_dir . '/css/owl.theme.css', array(), null );

		/***** STYLE LOADING ENDS *****/

		/***** SCRIPT LOADING START *****/	
		
		wp_enqueue_script( 'waypoints', $template_dir . '/js/waypoints.min.js', array( 'jquery' ), '1.6.2', true );


		if(spice_get_option('opt-smooth-scroll-switch'))
		{
			wp_enqueue_script( 'smoothscroll', $template_dir . '/js/smoothScroll.js', array( 'jquery' ), '1.6.2', true );
		}					

			if(is_page_template("page_templates/page-review.php")) //only for review template
        	{
				wp_enqueue_script( 'counterup', $template_dir . '/js/jquery.counterup.min.js', array( 'jquery' ), '1.6.2', true );				
			}
			wp_enqueue_script( 'fittext', $template_dir . '/js/jquery.fittext.js', array( 'jquery' ), '1.2', true );
			wp_enqueue_script( 'bxslider', $template_dir . '/js/jquery.bxslider.min.js', array( 'jquery' ), '1.2', true );
			if(is_page_template("page_templates/page-events.php")) //only for works template and frontpage
        	{
				wp_enqueue_script( 'calenderio', $template_dir . '/js/jquery.calendario.js',array('jquery'),"",true);	
			}
			if(is_page_template("page_templates/page-products.php")) //only for works template and frontpage
        	{		
        		$page_template="page-products";
				wp_enqueue_script( 'isotop', $template_dir . '/js/jquery.isotope.js', array( 'jquery' ), '' );
			}			
			wp_enqueue_script( 'imgLiquid', $template_dir . '/js/imgLiquid-min.js', array( 'jquery' ), '' ); 
			wp_enqueue_script( 'owl-carousel', $template_dir . '/js/owl.carousel.min.js', array( 'jquery' ), '' ); 			
			// Parallax Background
			wp_enqueue_script( 'stellar', $template_dir . '/js/jquery.stellar.min.js', array( 'jquery' ), '0.6.2', true );		

		if(!is_404())
		{
			if(spice_get_option('google-map-checkbox') || is_page_template("page_templates/page-contact.php"))
			{	
				if(spice_get_option('google-map-api')!='')
				{				
					$api_key=spice_get_option('google-map-api');					
					wp_enqueue_script( 'googlemap','https://maps.googleapis.com/maps/api/js?key='.$api_key.'&libraries=places&callback=initMap','','',true);
				}
			}
		}

		if(is_home() || is_front_page() || is_page_template("page_templates/page-reservation.php"))
		{
			wp_enqueue_style( 'datetime-picker', $template_dir . '/css/jquery.datetimepicker.css', array(), null );	
			wp_enqueue_script( 'validator', $template_dir . '/js/jquery.validate.min.js', array( 'jquery' ), '1.0', true );				
			wp_enqueue_script( 'datetime-picker-js', $template_dir . '/js/jquery.datetimepicker.js', array( 'jquery' ), '1.0', true );							
		}			

		if(is_home() || is_front_page() || is_page_template("page_templates/page-menu.php") )
		{
			wp_enqueue_script( 'spice-menu-food-carousel', $template_dir . '/js/spice_menu-food-carousel.js', array( 'jquery' ), '1.0', true );		
		}
		/**** SETTING GRID FOR WOOCOMMERCE */
		$grid_no=2;
		$owl_col=3;
		$banner_blur=0;
		if(spice_get_option('opt-grid-number'))
		{
			$grid_no=spice_get_option('opt-grid-number');
		}
		if($grid_no==1 || $grid_no==2)
		{
			$owl_col=3;
		}
		else
		{
			$owl_col=4;
		}		
		if(spice_get_option('opt-banner-blur-switch'))
		{
			$banner_blur=spice_get_option('opt-banner-blur-switch');
			wp_enqueue_script( 'scrollblur', $template_dir . '/js/scrollblur.js', array( 'jquery' ), '' ); 
		}
		/* SETTING ENDS */		
		if ( class_exists( 'woocommerce' ) ) 
		{	

			if(is_shop() )
			{
				$page_template='shop';
				wp_enqueue_script( 'jquery-cookie', $template_dir . '/js/jquery.cookie.js', array( 'jquery' ), '1.2', true );			
			}
			if(is_shop() || is_cart() || is_singular( 'product' ) || spice_isWishList() || is_woocommerce() || is_account_page() || is_page_template("page_templates/page-menu.php"))
			{
				add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
				wp_enqueue_style( 'spice-shop', $template_dir . '/css/woo-commerce/spice-shop.css', array(), null );			
			}

			if(is_checkout())
			{	
				wp_enqueue_style( 'spice-shop', $template_dir . '/css/woo-commerce/spice-shop.css', array(), null );		
				wp_enqueue_script( 'spice-bootstrap-js',$template_dir .'/js/bootstrap.min.js',array('jquery'),'1.1',true);
			}

			if( is_singular( 'product' ) ){
		        // Checkout Page        
		         wp_deregister_script('wc-single-product');
		         wp_register_script('wc-single-product', get_template_directory_uri() . "/js/woocommerce/single-product.js", 
		         array( 'jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n' ), WC_VERSION, TRUE);
		         wp_enqueue_script('wc-single-product');
		    }
		}

	    if ( ! function_exists( 'is_plugin_active' ) )
        {
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
        }
        if(is_page_template("page_templates/page-home-menu.php") || is_page_template("page_templates/page-product-review.php") || is_home() || is_front_page())
        {
        	wp_enqueue_style( 'spice-shop', $template_dir . '/css/woo-commerce/spice-shop.css', array(), null );
        }        
         
        /*---------For light box------------*/
  		if(is_page_template("page_templates/page-gallery.php")) //only for works template and frontpage
        {
            wp_enqueue_script( 'mouswheel', $template_dir . '/js/lightbox/lib/jquery.mousewheel-3.0.6.pack.js',array( 'jquery') , '2.1.4',true );        
            wp_enqueue_script( 'fancybox-js', $template_dir . '/js/lightbox/source/jquery.fancybox.js',array( 'jquery') , '2.1.4',true );
            wp_enqueue_script( 'spice-custom-lb', $template_dir . '/js/lightbox/spice_custom-lb.js',array( 'spice-js-fancybox') , '2.1.4',true );
            wp_enqueue_style( 'fancybox-css', $template_dir . '/js/lightbox/source/jquery.fancybox.css', '', '2.1.4');  
        }
        wp_enqueue_script( 'spice-myCustom', $template_dir . '/js/spice_myCustom.js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'spice-myCustom', 'spicesettings', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'owl_col'=>$owl_col ,'banner_blur'=> $banner_blur,'page_template'=>$page_template ) );    	


        wp_enqueue_script('comment-reply');

		/***** SCRIPT LOADING ENDS *****/	

		/****** VISUAL COMPOSER SUPPORTS *******/
		if ( ! function_exists( 'is_plugin_active' ) )
        {
            require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
        }
        if(is_plugin_active('js_composer/js_composer.php'))
        {
            $front_css_file = vc_asset_url( 'css/js_composer.css' );
            if ( vc_settings()->get( 'use_custom' ) == '1' && is_file( $upload_dir['basedir'] . '/' . vc_upload_dir() . '/js_composer_front_custom.css' ) ) {
            $front_css_file = $upload_dir['baseurl'] . '/' . vc_upload_dir() . '/js_composer_front_custom.css';
            }
            wp_enqueue_style( 'js_composer_front', $front_css_file, false, WPB_VC_VERSION, 'all' );         
        }   
		/****** VISUAL COMPOSER SUPPORTS END *******/

	}//end of function

	/**
	* 	Function Name 	: spice_admin_scripts_styles
	*	Description 	: Loading the required script and style for admin. 
	*/
	function spice_admin_scripts_styles()
	{
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array() );
		wp_register_script('spice-ptemplates', get_template_directory_uri().'/js/spice_template.js', array('jquery'));
		wp_enqueue_script('spice-ptemplates');	

		wp_enqueue_script('spice-admin', get_template_directory_uri().'/js/spice_admin.js', array('jquery'));			
		wp_enqueue_style( 'spice-meta-box-style', get_template_directory_uri().'/css/spice_meta_box_style.css');
	}

	/**
	 * 	Function Name 	: spice_register_menus
	 *	Description 	: Registering WP Nav Menus
	 */
	function spice_register_menus() 
	{
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Menu', 'SPICE' ),
				'homepage-block' => esc_html__( 'Homepage Block', 'SPICE' )
			)
		); 
	}//end of function


	/*****************  WIDGET AREA DEFINATIONS STARTS************************/
	require_once (trailingslashit( get_template_directory() ).'includes/widgets/register-widget-areas.php');
	require_once (trailingslashit( get_template_directory() ).'includes/widgets/recentProductSlider.php'); 
	require_once (trailingslashit( get_template_directory() ).'includes/widgets/recentPopularProducts.php'); 
	/*****************  WIDGET AREA DEFINATIONS ENDS************************/


	/****************** SPICE METABOX AREA STARTS *********************/	
	
	require_once (trailingslashit( get_template_directory() ).'includes/metabox/spice_page_metabox.php'); //for metabox in pages
	require_once (trailingslashit( get_template_directory() ).'includes/metabox/spice_post_metabox.php'); //for metabox in posts
		
	/******************* SPICE METABOX AREA ENDS **********************/
	

	/**
	* Function Name : spice_get_option
	* Description : Getting the redux options with the specific option name as parmater.
	**/
	if (!function_exists('spice_get_option')) 
	{
	   function spice_get_option($option_name, $default_value = '', $used_for_object = '') {
	       global $spice_options;
	       if (class_exists('ReduxFramework')) {
	           if (gettype($option_name) == 'string')
	           {
	             $option_value = isset( $spice_options[$option_name] )? $spice_options[$option_name] : false;
	           }elseif (is_array($option_name) && count($option_name) > 0)
	           {
	               $option_value = $spice_options;
	               foreach ($option_name as $i => $val) 
	               {
	                   if (is_array($option_value) && count($option_value) > 0){
	                        $option_value = isset( $option_value[$val] )? $option_value[$val] : false;
	                   }
	               }
	           }
	       } else {
	           $option_value = get_option($option_name);
	       }
	       if (!$option_value && '' != $default_value)
	           $option_value = $default_value;
	       return $option_value;
	   }//end of function
	}


/**** PRODUCT PER PAGE ***/
add_filter( 'loop_shop_per_page', 'spice_shop_products', 20 );
function spice_shop_products($cols)
{
	$product_per_page=spice_get_option('opt-products-number');
	return $product_per_page;
}
/**
* 	Function Name 	: spice_get_comments_popup_link
*	Description 	: Will show the Comment Popup Section
*/
function spice_get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = esc_html__( 'No Comments','SPICE' );
    if ( false === $one ) $one = esc_html__( '1 Comment' ,'SPICE');
    if ( false === $more ) $more = esc_html__( '% Comments','SPICE' );
    if ( false === $none ) 
	{
		if(!comments_open())
        {
			$css_class='comment-off ';
		}
		$none = esc_html__( ' Comments Off ','SPICE' );
	}
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) 
    {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = esc_html__('Enter your password to view comments.','SPICE');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( esc_html__('Comment on %s','SPICE'), $title ) ) . '">';
    $str .= spice_get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}//end of function
/**
* 	Function Name 	: spice_get_comments_number_str
*	Description 	: Will show the number of comment for the respective post
*/
function spice_get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) 
{
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? esc_html__('% Comments','SPICE') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? esc_html__('No Comments','SPICE') : $zero;
    else // must be one
        $output = ( false === $one ) ? esc_html__('1 Comment','SPICE') : $one;
 
    return apply_filters('comments_number', $output, $number);
}//end of function
	
function spice_dynamic_scripts_styles()
{	
	require_once 'js/dynamic-js.php';
}


/**
* 	Function Name 	: spice_postinfo_meta
*	Description 	: Will show the information related to the specific post 
*/	
if ( ! function_exists( 'spice_postinfo_meta' ) )
{
	function spice_postinfo_meta()
	{
		
		(($spice_blog_author=spice_get_option('gn-author-checkbox')) && $spice_blog_author!='')  ? $spice_blog_author : true;		
		(( $spice_blog_cat = spice_get_option('gn-cat-checkbox') ) && '' != $spice_blog_cat ) ? $spice_blog_cat : true;        
		(( $spice_user_comments = spice_get_option('gn-comments-checkbox') ) && '' != $spice_user_comments ) ? $spice_user_comments : true;
        (( $spice_blog_tags = spice_get_option('gn-tags-checkbox') ) && '' != $spice_blog_tags ) ? $spice_blog_tags : true;
		
		$postinfo_meta = '';
		$set_meta = false;
		
		if ($spice_blog_author)
		{
			global $authordata;
			if ( !is_object( $authordata ) )
			{
				return false;	
			}
			$author_posts_link = sprintf(__('<a href="%1$s" title="%2$s" rel="author">%3$s</a>','SPICE'), esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ), esc_attr( sprintf( __( '%s','SPICE' ), get_the_author() ) ), ucfirst(get_the_author()));
			$postinfo_meta .= '<span class="user_meta"> <i class="fa fa-user"></i> ' . esc_html__(' ','SPICE') . ' ' . $author_posts_link .'</span>' ;
			$set_meta = true;
		}
		
		if ($spice_blog_cat)
		{
			if(has_category())
			{
		 		$postinfo_meta .= ' <span class="category_meta"> <i class="fa fa-folder-open"></i> ' . esc_html__(' ','SPICE') . ' ' . get_the_category_list(', ').'</span>';
		 		$set_meta = true;
		 	}
		}
       if ($spice_blog_tags)
        {
        	if(has_tag())
        	{
            	$postinfo_meta .= ' <span class="tags_meta"> ' . esc_html__(' ','SPICE') . ' ' . get_the_tag_list(' <i class="fa fa-tags"></i> ',', ','').'</span>';
            	$set_meta = true;
            }
        }       

		if ($spice_user_comments)
        {	
        	$postinfo_meta .='<span class="comment_meta"> ';
        	if(comments_open())
        	{
        		$postinfo_meta .= ' <i class="fa fa-comments"></i> ';
        	}
        	if(!comments_open())
        	{
        		$postinfo_meta .= ' <i class="fa fa-ban"></i> ';
        	}
			$postinfo_meta .=  spice_get_comments_popup_link( ''.esc_html__(' 0 comments','SPICE'), esc_html__(' 1 comment','SPICE'), ' %'.esc_html__(' Comments','SPICE') ) .'</span>';
			$set_meta = true;
		}
		if(is_single())
		{
			$category = get_the_category();
			$tags = get_the_tags();			
			if(comments_open())
			{
				if(count($category)>10 || count($tags)>10)
				{				
					$postinfo_meta .=' <span class="leave_comment_block"><a href="javascript:void(0);">Leave a Comment</a></span>';
				}
				else
				{
					$postinfo_meta .=' <span class="leave_comment"><a href="javascript:void(0);">Leave a Comment</a></span>';	
				}
			}
		}
		
		if($set_meta)
		{
			return $postinfo_meta;		
			
		}
	}//end of function
}
function spice_SearchFilter($query) 
{
	if ($query->is_search) 
	{
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','spice_SearchFilter');

function spice_custom_cmb2_date_format( $data ) 
{
	$data['defaults']['date_picker']['dateFormat'] = 'yy-mm-dd';
	return $data;
}
add_filter( 'cmb2_localized_data', 'spice_custom_cmb2_date_format' );


function spice_breadcrumb () {
     
    // Settings
    $separator  = '&gt;';
    $id         = 'breadcrumbs';
    $class      = 'breadcrumbs';
    $home_title = '<i class="fa fa-home"></i>';
    $parents='';
    $allowed_tags_before_after=array('ul' => array('class'=>array(),'id'=>array()),'i'=>array('class'=>array()),'li' => array('class'=>array()),'a'=>array('class'=>array(),'id'=>array(),'href'=>array(),'title'=>array()),'strong'=>array()); 
    // Get the query & post information
    global $post,$wp_query;
    $category = get_the_category();
     
    // Build the breadcrums
    printf(wp_kses(sprintf(__('<ul id="%1$s" class="%2$s">','SPICE'),esc_attr($id),esc_attr($class)),$allowed_tags_before_after));
     
    // Do not display on the homepage
    if ( !is_front_page() ) 
    {
         
        // Home page
        printf(wp_kses(sprintf(__('<li class="item-home"><a class="bread-link bread-home" href="%1$s" title="homepage">%2$s</a></li>','SPICE'),get_home_url(),$home_title),$allowed_tags_before_after));
        printf(wp_kses(sprintf(__('<li class="separator separator-home">%1$s</li>','SPICE'),esc_html($separator)),$allowed_tags_before_after));
        
        if ( is_single() ) 
        {            
            // Single post (Only display the first category)

            if(!empty($category))
            {
            	printf(wp_kses(sprintf(__('<li class="item-cat item-cat-%1$s item-cat-%2$s"><a class="bread-cat bread-cat-%3$s bread-cat-%4$s" href="%5$s" title="%6$s">%7$s</a></li>','SPICE'),esc_attr($category[0]->term_id),esc_attr($category[0]->category_nicename),esc_attr($category[0]->term_id),esc_attr($category[0]->category_nicename),esc_url(get_category_link($category[0]->term_id )),esc_attr($category[0]->cat_name),esc_html($category[0]->cat_name)),$allowed_tags_before_after));
            	printf(wp_kses(sprintf(__('<li class="separator separator-%1$s"> %2$s </li>','SPICE'),esc_attr($category[0]->term_id),esc_html($separator)),$allowed_tags_before_after));
            }
            printf(wp_kses(sprintf(__('<li class="item-current item-%1$s"><strong class="bread-current bread-%2$s" title="%3$s"> %4$s </strong></li>','SPICE'),esc_attr($post->ID),esc_attr($post->ID),esc_attr(get_the_title()),esc_attr(get_the_title())),$allowed_tags_before_after));
             
        }
        else if ( is_category() ) 
        {                    
            // Category page
            printf(wp_kses(sprintf(__('<li class="item-current item-cat-%1$s item-cat-%2$s"><strong class="bread-current bread-cat-%3$s bread-cat-%4$s">%5$s</strong></li>','SPICE'),esc_attr($category[0]->term_id),esc_attr($category[0]->category_nicename),esc_attr($category[0]->term_id),esc_attr($category[0]->category_nicename),single_cat_title( '', false )),$allowed_tags_before_after));
             
        } 
        else if ( is_page() ) 
        {
            
            // Standard page
            if( $post->post_parent ){
                 
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                 
                // Get parents in the right order
                $anc = array_reverse($anc);
                 
                // Parent page loop
                foreach ( $anc as $ancestor ) 
                {
                    $parents .= '<li class="item-parent item-parent-' . esc_attr($ancestor) . '"><a class="bread-parent bread-parent-' . esc_attr($ancestor) . '" href="' . esc_attr(get_permalink($ancestor)) . '" title="' . esc_attr(get_the_title($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
                    $parents .= '<li class="separator separator-' . esc_attr($ancestor) . '"> ' . esc_html($separator) . ' </li>';
                }
                 
                // Display parent pages
                printf(wp_kses(sprintf(__('%s','SPICE'),$parents),$allowed_tags_before_after));
                 
                // Current page
                printf(wp_kses(sprintf(__('<li class="item-current item-%1$s"><strong title="%2$s"> %3$s </strong></li>','SPICE'),esc_attr($post->ID),esc_attr(get_the_title()),esc_html(get_the_title())),$allowed_tags_before_after));
                 
            } else {
                 
                // Just display current page if not parents
                printf(wp_kses(sprintf(__('<li class="item-current item-%1$s"><strong class="bread-current bread-%2$s"> %3$s </strong></li>','SPICE'),esc_attr($post->ID),esc_attr($post->ID),esc_html(get_the_title())),$allowed_tags_before_after));
                 
            }
             
        } 
        else if ( is_tag() ) 
        {
             
            // Tag page
             
            // Get tag information
            $term_id = get_query_var('tag_id');
            $taxonomy = 'post_tag';
            $args ='include=' . $term_id;
            $terms = get_terms( $taxonomy, $args );
             
            // Display the tag name
            printf(wp_kses(sprintf(__('<li class="item-current item-tag-%1$s item-tag-%2$s"><strong class="bread-current bread-tag-%3$s bread-tag-%4$s"> %5$s </strong></li>','SPICE'),esc_attr($terms[0]->term_id),esc_attr($terms[0]->slug),esc_attr($terms[0]->term_id),esc_attr($terms[0]->slug),esc_html($terms[0]->name)),$allowed_tags_before_after));
         
        } elseif ( is_day() ) {
             
            // Day archive
             
            // Year link
            printf(wp_kses(sprintf(__('<li class="item-year item-year-%1$s"><a class="bread-year bread-year-%2$s" href="%3$s" title="%4$s"> %5$s ','SPICE'),esc_attr(get_the_time('Y')),esc_attr(get_the_time('Y')),esc_url(get_year_link( get_the_time('Y') )),esc_attr(get_the_time('Y')),esc_attr(get_the_time('Y'))),$allowed_tags_before_after));
             printf(wp_kses(__('Archives</a></li>','SPICE'),$allowed_tags_before_after));


            printf(wp_kses(sprintf(__('<li class="separator separator-%1$s"> %2$s </li>','SPICE'),esc_attr(get_the_time('Y')),esc_attr($separator)),$allowed_tags_before_after));
             
            // Month link
            printf(wp_kses(sprintf(__('<li class="item-month item-month-%1$s"><a class="bread-month bread-month-%2$s" href="%3$s" title="%4$s"> %5$s ','SPICE'),esc_attr(get_the_time('m')),esc_attr(get_the_time('m')),esc_url(get_month_link( get_the_time('Y'), get_the_time('m') )),esc_attr(get_the_time('M')),esc_html(get_the_time('M'))),$allowed_tags_before_after));

            printf(wp_kses(__('Archives</a></li>','SPICE'),$allowed_tags_before_after));


            printf(wp_kses(sprintf(__('<li class="separator separator-%1$s"> %2$s </li>','SPICE'),esc_attr(get_the_time('m')), esc_html($separator)),$allowed_tags_before_after));
             
            // Day display
            printf(wp_kses(sprintf(__('<li class="item-current item-%1$s"><strong class="bread-current bread-%2$s"> %3$s %4$s ','SPICE'),esc_attr(get_the_time('j')),esc_attr(get_the_time('j')),esc_html(get_the_time('jS')),get_the_time('M')),$allowed_tags_before_after));

             printf(wp_kses(__('Archives</li>','SPICE'),$allowed_tags_before_after));


             
        } else if ( is_month() ) {
             
            // Month Archive
             
            // Year link
            printf(wp_kses(sprintf(__('<li class="item-year item-year-%1$s"><a class="bread-year bread-year-%2$s" href="%3$s" title="%4$s"> %5$s ','SPICE'),esc_attr(get_the_time('Y')),esc_attr(get_the_time('Y')),esc_attr(get_year_link( get_the_time('Y') )),esc_attr(get_the_time('Y')),esc_html(get_the_time('Y'))),$allowed_tags_before_after));
         
	        printf(wp_kses(__('Archives</a></li>','SPICE'),$allowed_tags_before_after));


            printf(wp_kses(sprintf(__('<li class="separator separator-%1$s"> %2$s </li>','SPICE'),esc_attr(get_the_time('Y')),esc_html($separator)),$allowed_tags_before_after));
             
            // Month display         

            printf(wp_kses(sprintf(__('<li class="item-month item-month-%1$s"><strong class="bread-current bread-current-%2$s" title="%3$s"> %4$s ','SPICE'),esc_attr(get_the_time('m')),esc_attr(get_the_time('m')),esc_attr(get_the_time('M')),esc_html(get_the_time('M'))),$allowed_tags_before_after));

		     printf(wp_kses(__('Archives</strong></li>','SPICE'),$allowed_tags_before_after));


             
        } else if ( is_year() ) 
        {             
            // Display year archive            


            printf(wp_kses(sprintf(__('<li class="item-current item-current-%1$s"><strong class="bread-current bread-current-%2$s" title="%3$s"> %4$s ','SPICE'),esc_attr(get_the_time('Y')),esc_attr(get_the_time('Y')),esc_attr(get_the_time('Y')),esc_html(get_the_time('Y'))),$allowed_tags_before_after));

		     printf(wp_kses(__('Archives</strong></li>','SPICE'),$allowed_tags_before_after));


        } 
        else if ( is_author() )
        {
             
            // Auhor archive
             
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );             
            // Display author name
            printf(wp_kses(sprintf(__('<li class="item-current item-current- %1$s"><strong class="bread-current bread-current-%2$s" title="%3$s"> Author: %4$s</strong></li>','SPICE'),esc_attr($userdata->user_nicename),esc_attr($userdata->user_nicename),esc_attr($userdata->display_name),esc_html(ucfirst($userdata->display_name))),$allowed_tags_before_after));
         
        } else if ( get_query_var('paged') ) 
        {
             
            // Paginated archives           

            printf(wp_kses(sprintf(__('<li class="item-current item-current-%1$s"><strong class="bread-current bread-current-%2$s">','SPICE'),esc_attr(get_query_var('paged')),esc_attr(get_query_var('paged'))),$allowed_tags_before_after));
           	esc_html_e('Page ','SPICE'); 
            printf(wp_kses(sprintf(__( ' %1$s </strong></li>','SPICE'),esc_attr(get_query_var('paged'))),$allowed_tags_before_after));


             
        } 
        else if ( is_search() ) 
        {
         
            // Search results page          
            printf(wp_kses(sprintf(__('<li class="item-current item-current-%1$s"><strong class="bread-current bread-current-%2$s">','SPICE'),esc_attr(get_search_query()),esc_attr(get_search_query())),$allowed_tags_before_after));
            	esc_html_e('Search results for: ','SPICE');
            	printf(wp_kses(sprintf(__( ' %1$s </strong></li>','SPICE'),esc_attr(get_search_query())),$allowed_tags_before_after));
            	
         
        }
        elseif(is_404())
        {
        	 printf(wp_kses(sprintf(__('<li> Error 404 </li>','SPICE')),$allowed_tags_before_after));
        } 
        elseif(is_home())
        {
        	 printf(wp_kses(sprintf(__('<li> BLOG PAGE </li>','SPICE')),$allowed_tags_before_after));
        }
        else
        {             
           printf(wp_kses(sprintf(__('<li> PAGE NAME </li>','SPICE')),$allowed_tags_before_after));
        }
         
    }
    else
    {
    	if(is_home())
    	{
    		 printf(wp_kses(sprintf(__('<li> BLOG PAGE </li>','SPICE')),$allowed_tags_before_after));  
    	}
    }     
    printf(wp_kses(sprintf(__('</ul>','SPICE')),$allowed_tags_before_after));    
}

add_action('wp_ajax_nopriv_calendarEvents', 'spice_calendarEvents' );
add_action("wp_ajax_calendarEvents","spice_calendarEvents");	
	
function spice_calendarEvents()
{				
	if(isset($_POST["dt"]))
	{		
		$dt=$_POST["dt"];
	}
	else
	{
		$dt=date("Y-m-d");	
	}
	$query_args['post_type']='event';
    $query_args['meta_key']='spice_event_date';
    $query_args['orderby']='meta_value';
    $query_args['order']='ASC';
    $query_args['meta_query']=array(
                                          array(
                                              'key'     => 'spice_event_date',
                                              'value'   =>  DATE($dt),
                                              'compare' => '=',
                                              'type'  => 'DATE',
                                             
                                          ),
                                       );
    $event = new WP_Query( $query_args );			
     
	if($event->post_count==0)
	{
		$p['status']=0;
		$p['event_image'] = get_template_directory_uri()."/images/calendar-event-img.png";
		$p['post_title']=' No event found :( <span>Please try other dates.</span>';
		echo json_encode($p);	
		die();			
	}
	else
	{			
		$post=$event->post;	
		$p['status']=1;
		$p['event_image'] = get_post_meta($post->ID,'spice_event_poster',true);
		$p['post_link']=get_permalink($post->ID);
		$p['post_title']=$post->post_title;
		$p['content']=$post->post_content;
        echo json_encode($p);
        die();	
				
	}
	
}//end of fucntion
add_action('wp_ajax_nopriv_calendarEventsForMonth', 'spice_calendarEventsForMonth' );
add_action("wp_ajax_calendarEventsForMonth","spice_calendarEventsForMonth");	
	
function spice_calendarEventsForMonth()
{ 	
	
	if(isset($_POST["mn"]) && isset($_POST["yr"]))
	{			
		$mn = date('M', mktime(0, 0, 0, $_POST["mn"], 10));
		$yr=$_POST["yr"];			 			
	}
	else
	{
		$mn=date("M");
		$yr=date("Y");	
	}

	$end_date=date('Y-m-t', strtotime($mn)); 
	$start_date=date('Y-m-01',strtotime("$mn ,$yr"));


	$query_args['post_type']='event';
	$query_args['post_per_page']=-1;
    $query_args['meta_key']='spice_event_date';
    $query_args['orderby']='meta_value';
    $query_args['order']='ASC';
    $query_args['meta_query']=array(
                                          array(
                                              'key'     => 'spice_event_date',
                                              'value'   =>  array($start_date, $end_date),
                                              'compare' => 'BETWEEN',
                                              'type'  => 'DATE',
                                             
                                          ),
                                       );
    $event = new WP_Query( $query_args );	

   // print_r($event);
    $events=$event->posts;
    foreach($events as $event)
	{
		$event_date=get_post_meta($event->ID,'spice_event_date',true);
		$dt=date("m-d-Y",strtotime($event_date));	
		$data[$dt]='<a href="'.get_permalink($event->ID).'">'.$event->post_title.'</a>';					
	}		
	
	$str=json_encode($data);		
	printf(__('%s','SPICE'),$str);

	die();
	
}//end of function

	/**
 * 	Function Name 	: spice_custom_comments_template
 *	Description 	: Overriding the default design for Custom Template
 */
if ( ! function_exists( 'spice_custom_comments_template' ) ) :
function spice_custom_comments_template($comment, $args, $depth) 
{	
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="post-comment-<?php comment_ID() ?>">    
    
        
        <div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix posted-comments level-1">
            <div class="clearfix">
                <div class="user-img-holder">
                    <?php echo get_avatar( $comment, $size='60' ); ?>
                </div>
                <div class="comment-details">
                    <div class="clearfix">
                        <h4><?php echo get_comment_author(); ?></h4>
                       <div class="comment-content clearfix">
                        <?php
								$et_comment_reply_link = get_comment_reply_link( array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i>'.esc_attr__('Reply','SPICE'),'depth' => $depth, 'max_depth' => $args['max_depth'])) );
								if ( $et_comment_reply_link )
								{
						?>
								<div class="reply-container"><?php printf(__('%s','SPICE'),$et_comment_reply_link);?></div>						
                        <?php
                        		}
                        	 edit_comment_link( esc_html__( 'Edit', 'SPICE' ), ' ' );
                        ?>
                        </div>
                    </div>
                    <h6><?php
						/* Sequence: 1: date, 2: time */
						printf( __( '%1$s', 'SPICE' ), get_comment_date() );
					?>
                    </h6>
                    <?php if ($comment->comment_approved == '0') : ?>
                            <em class="moderation"><?php esc_html_e('Your comment is awaiting moderation.','SPICE') ?></em>
                            <br />
					<?php endif; ?>
                    <?php 
                            $allowed_comment_tags=array('cite' => array(),'b' => array(),'s' => array(),'strike' => array(),'strong'=>array(),'blockquote' => array('cite'=>array()),'q' => array('cite'=>array()),'code' => array(),'a'=>array('href'=>array(),'title'=>array()),'acronym'=>array('title'=>array()));
                            echo wp_kses(get_comment_text(),$allowed_comment_tags); 

                    ?>
                    
                </div>
            </div>
        </div>
      
<?php

}//end of function
endif;
/**
 * 	Function Name 	: spice_replace_reply_link_class
 *	Description 	: Adding a class to Comment Reply Link
 */
add_filter('comment_reply_link', 'spice_replace_reply_link_class');
function spice_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link red-btn comment-btn", $class);
    return $class;
}//end of function

/**
 * 	Function Name 	: spice_edit_comment_link
 *	Description 	: Adding a class to  Edit Comment Link
 */
function spice_edit_comment_link( $output ) 
{
  $myclass = 'red-btn';
  return preg_replace( '/comment-edit-link/', 'comment-edit-link ' . $myclass, $output, 1 );
}//end of function
add_filter( 'edit_comment_link', 'spice_edit_comment_link' );


// function spice_excerptMore($more) {
//        global $post;
//     return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Continue Reading...</a>';
// }
// add_filter('excerpt_more', 'spice_excerptMore');


/****** HOME PAGE BLOCK CONSTRUCT *********/

function spice_home_page_blocks()
{
	$templates = wp_get_theme()->get_page_templates();		
    $templates['page.php'] = 'Default Template';	
	$menu_name = 'homepage-block';
	$locations = get_nav_menu_locations();
	$is_home_page=1;
	$homepage_blocks_new=array(); //added
	$menu ='';
	if(array_key_exists($menu_name,$locations))
	{
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	}
	$locations = get_theme_mod('nav_menu_locations');
	$menu_items =array();
	if(array_key_exists($menu_name, $locations))
	{		
		$menu_items = wp_get_nav_menu_items($menu->term_id);
	}	
	$allowed_tags_before_after=array('div' => array('class'=>array()),'section'=>array(),'h1'=>array()); 
	if(!is_object($menu) || count($menu_items)<1)
	{

		printf(wp_kses(__('<div class="no-menu-set">','SPICE'),$allowed_tags_before_after));
		printf(wp_kses(__('<section>','SPICE'),$allowed_tags_before_after));
		printf(wp_kses(__('<h1>','SPICE'),$allowed_tags_before_after));
		printf(wp_kses(__('Set Menu to get result in Home Page','SPICE'),$allowed_tags_before_after));
		printf(wp_kses(__('</h1>','SPICE'),$allowed_tags_before_after));
		printf(wp_kses(__('</section>','SPICE'),$allowed_tags_before_after));
		printf(wp_kses(__('</div>','SPICE'),$allowed_tags_before_after));
		return;	
	}
	
	foreach($menu_items as $menu_item_new)
	{		
			$homepage_blocks_new[$menu_item_new->object_id]=$menu_item_new->title;				
			$children = get_pages('child_of='.$menu_item_new->object_id);			
			if(!empty($children))
			{					
				foreach($children as $child)
				{						
					$homepage_blocks_new[$child->ID]=$child->post_title;	
				}
			}			
	}				
	$p_arr=array_keys($homepage_blocks_new);

	$query = new WP_Query( array( 'post_type' => 'page', 'post__in' => $p_arr,'orderby'=>'post__in','posts_per_page'=>-1 ) );	
	while( $query->have_posts() ) : $query->the_post();
	
		    $id=get_the_ID();				
			if (get_page_template_slug($id) !== '') 
			{
              	$template = get_page_template_slug($id);					
            }
			else
			{				
				$template="page.php";
			}
			if (array_key_exists($template, $templates)) 
			{
				$active_template = explode(".", $template);					
				$temp_path="".$template;
				require $temp_path;
			}			
	endwhile;		
}

function spice_getPageStyles()
{
	$page_styler='';
	$str='';
	$style='';
	$style_overlay='';
	$wrapper_style='';
	$title_style='';
	$subtitle_style='';
	$font_to_load='';
	$spice_page_bg_pattern='';
	$p_arr=array();
	$homepage_blocks_new=array();//added
	if(!is_front_page())
	{
		global $post;		

		if(!is_404() && !is_search())
		{
			if ( class_exists( 'WooCommerce' ) ) 
			{
				if(is_shop())
				{
					$p_arr[]=get_option( 'woocommerce_shop_page_id' );
				}
				else
				{
					$p_arr[]=$post->ID;
				}
			}
			else
			{
				
				$p_arr[]=$post->ID;
			}
		}
	}
	else
	{
		$menu_name = 'homepage-block';
		$locations = get_nav_menu_locations();	

		if(array_key_exists($menu_name,$locations))
		{	
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );	
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			if(is_array($menu_items))
			{
				foreach($menu_items as $menu_item_new)
				{			
					
						$homepage_blocks_new[$menu_item_new->object_id]=$menu_item_new->title;				
						$children = get_pages('child_of='.$menu_item_new->object_id);			
						if(!empty($children))
						{					
							foreach($children as $child)
							{						
								$homepage_blocks_new[$child->ID]=$child->post_title;	
							}
						}						
					
				}			
				$p_arr=array_keys($homepage_blocks_new);	
			}
		}
	}

	if(count($p_arr)>0)
	{
		foreach($p_arr as $index)
		{
			$overlay_class='#page-'.$index;
			$page_wrapper_class='.page-wrapper-'.$index;
			$page_title_class='.page-title-'.$index;
			$spice_page_subtitle_class='.page-sub-title-'.$index;		
			$contact_style='';		
			$title_style='';
			$subtitle_style='';

			$spice_page_bg_color= get_post_meta( $index, 'spice_page_bg_color', true );
			$spice_page_bgcolor_opacity= (float)intval(get_post_meta( $index, 'spice_page_bgcolor_opacity', true ))/100;
			$spice_page_bg_pattern=get_post_meta( $index, 'spice_page_bg_pattern', true );
			$spice_page_bg_image=get_post_meta( $index, 'spice_page_bg_image', true );
			$spice_page_font_color=get_post_meta( $index, 'spice_page_font_color', true );
			$spice_page_title_font=get_post_meta( $index, 'spice_page_title_font', true );
			$spice_page_title_font_size=get_post_meta( $index, 'spice_page_title_font_size', true );
			$spice_page_title_font_color=get_post_meta( $index, 'spice_page_title_font_color', true );
			$spice_page_title_align=get_post_meta( $index, 'spice_page_title_align', true );
			$spice_spice_page_subtitle_font=get_post_meta( $index, 'spice_page_subtitle_font', true );
			$spice_spice_page_subtitle_font_color=get_post_meta( $index, 'spice_page_subtitle_font_color', true );
			$spice_page_bg_style=get_post_meta( $index, 'spice_page_bg_style', true );

			$style_overlay='background-size: cover;'; 


			
			if(trim($spice_page_bg_color)!='')  //background color of static-overlay class
			{
				$style_overlay='background-color: '.$spice_page_bg_color.' !important;';
			}
			if(!empty($spice_page_bg_image))  // background image of static overlay class
			{
				$style_overlay='background:url('.esc_url($spice_page_bg_image).');background-size:cover !important;';
			}
			if(isset($spice_page_bgcolor_opacity)) // background opacity of static overlay clas
			{
				$style_overlay.='opacity: '.$spice_page_bgcolor_opacity.' !important;';
			}	
			if(!empty($spice_page_bg_style) && $spice_page_bg_style==2)
			{
				$style_overlay.='background-attachment: fixed !important;';
			}
			
			if(!empty($spice_page_bg_pattern)) // background image of wrapper class
			{
				$wrapper_style.='background-image:url("'.$spice_page_bg_pattern.'");position:relative;';	
			}
			if(!empty($spice_page_font_color)) // font color wrapper class
			{
				$wrapper_style.='color:'.$spice_page_font_color.'!important; ';
			}
			if(!empty($spice_page_bg_style) && $spice_page_bg_style==2)
			{
				$wrapper_style.='z-index:0 !important;';
			}
			if(isset($spice_page_title_font) && strlen($spice_page_title_font)>0 && $spice_page_title_font!='') // font color wrapper class
			{				
				$font_name=spice_Font($spice_page_title_font);
				if($font_name!='')
				{
					$title_style.='font-family:'.$font_name.'!important; ';				
				}
				if($font_to_load!='')
				{
					if($font_name!='')
					{
						$font_to_load.='|'.str_replace(' ','+',$font_name);	
					}
				}
				else
				{
					$font_to_load=str_replace(' ','+',$font_name);	
				}
			}
			if(!empty($spice_page_title_font_size)) // font color wrapper class
			{
				$title_style.='font-size:'.$spice_page_title_font_size.'px !important; ';
			}
			if(!empty($spice_page_title_font_color))
			{
				$title_style.='color:'.$spice_page_title_font_color.'!important; ';
			}
			if(!empty($spice_page_title_align))
			{
				$title_style.='text-align:'.$spice_page_title_align.'; ';
			}

			/*****************  SUBTITLE *******************/
			$subtitle=get_post_meta($index,'spice_page_subtitle',true);
			if(trim($subtitle)!='')
			{
				$font_name=spice_Font($spice_spice_page_subtitle_font);				

				if($font_to_load!='')
				{
					if($font_name!='')
					{
						$font_to_load.='|'.str_replace(' ','+',$font_name);	
					}
				}
				else
				{
					$font_to_load=str_replace(' ','+',$font_name);	
				}
								
				if($font_name!='')
				{
					$subtitle_style.='font-family:'.$font_name.' !important;'; 
				}
				if($spice_spice_page_subtitle_font_color!='')
				{
					$subtitle_style.='color:'.$spice_spice_page_subtitle_font_color.' !important;';
				}
				if($spice_page_title_align!='')
				{
					$subtitle_style.='text-align:'.$spice_page_title_align.' !important;';
				}
				if($subtitle_style!='')
				{
					$spice_page_subtitle_class.='{'.$subtitle_style.'}';	
				}
				
			}
			else
			{
				$spice_page_subtitle_class='';	
			}

			if(get_post_meta($index,'spice_contact_logo_box',true))
			{
				$contact_logo_box=get_post_meta($index,'spice_contact_logo_box',true)!=''?get_post_meta($index,'spice_contact_logo_box',true):'';
				$contact_logo_box_bg=get_post_meta($index,'spice_contact_logo_box_background',true)!=''?get_post_meta($index,'spice_contact_logo_box_background',true):'#ffffff';
				$contact_style=$page_wrapper_class.' .logo-box{background-color:'.$contact_logo_box_bg.'!important;}';
			}

			$overlay_style=$overlay_class.'{'.$style_overlay.'}';
			$style.=$page_wrapper_class.'{'.$wrapper_style.'}';
			if($title_style!='')
			{
				$page_title_class.='{'.$title_style.'}';
			}
			else
			{
				$page_title_class='';
			}
			$page_styler.=$style.$overlay_style.$page_title_class.$spice_page_subtitle_class.$contact_style;
			$wrapper_style='';
		}

		if($font_to_load!='')
		{
			$GLOBALS['font_to_load']=urlencode($font_to_load);
			$query_args['family']=$GLOBALS['font_to_load'];	
			$font_url=esc_url_raw(add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ));
			wp_enqueue_style( 'spice-theme-fonts', $font_url, array(), null );	
		}	
		printf(' <style type="text/css" id="spice-inpage-css"> %1$s  </style> ',$page_styler);
	}
		
}//end of function

/**
 *  Function Name   : spice_get_menu_css
 *  Description     : Setting Style for Menu Section 
 */
if ( ! function_exists( 'spice_get_menu_css' ) )
{
    add_action( 'wp_head', 'spice_get_menu_css' );
    function spice_get_menu_css()
    {
    	$menu_styles=spice_get_option('opt-typography-menu');    	
    	if(is_array($menu_styles))
    	{

    		$menu_css='#navigation-list .navbar-nav a{';

    		if(array_key_exists('font-family',$menu_styles))
    		{
    				$menu_css.='font-family:"'.$menu_styles['font-family'].'"';
    		}
    		if(array_key_exists('font-weight',$menu_styles))
    		{
    				$menu_css.=';font-weight:'.$menu_styles['font-weight'];
    		}
    		if(array_key_exists('color',$menu_styles))
    		{
    				$menu_css.=';color:'.$menu_styles['color'];
    		}
    		$menu_css.='}';
    		   	
    	}
    	$top=0;
    	if(is_admin_bar_showing())
		{
    	   	$top="32px";	
    	}    	    	
    	$menu_css.='header.new-type1 .lower-part.is-fixed,header.new-type3 .lower-part.is-fixed,header.new-type2.is-fixed .lower-part, header.default.is-fixed .header-inner-wrapper { top: '.$top.'; }'; 
    	printf(' <style type="text/css" id="spice-menu-css"> %1$s  </style> ',$menu_css);
   	}
}
/**
 *  Function Name   : spice_single_page_banner_css
 *  Description     : Setting for Single Page Banner 
 */
if ( ! function_exists( 'spice_single_page_banner_css' ) )
{
    add_action( 'wp_head', 'spice_single_page_banner_css' );
    function spice_single_page_banner_css()
    {
    	$banner_css='';
    	if(spice_get_option('single-page-banner')!='')
    	{
	    	if(spice_get_option('single-page-banner')==1)
			{
				$single_page_banner_image=spice_get_option('single-page-static-banner');
				if(!empty($single_page_banner_image['url']))
				{
	    			$banner_css.='.banner { background-image: url("'.esc_url($single_page_banner_image['url']).'"); }';     	
	    		}
	    		else
	    		{
	    			$banner_css.='.banner{ background-color:#f3f3f3;}';
	    		}
	    		printf(' <style type="text/css" id="single-page-banner-css"> %1$s  </style> ',$banner_css);
	    	}
	    }
   	}
}
if ( ! function_exists( 'spice_home_single_page_banner_css' ) )
{
    add_action( 'wp_head', 'spice_home_single_page_banner_css' );
    function spice_home_single_page_banner_css()
    {
    	$banner_css='';
    	if(spice_get_option('home-page-banner')!='')
    	{   		
	    	if(spice_get_option('home-page-banner')==1)
			{				
				$home_page_banner_image=spice_get_option('home-page-static-banner');
				if(!empty($home_page_banner_image['url']))
				{
	    			$banner_css.='.home .top-content, .top-content{ background-image: url("'.esc_url($home_page_banner_image['url']).'"); background-size:cover;}';     	
	    		}
	    		else
	    		{
	    			$banner_css.='.home .top-content, .top-content{ height:350px !important; } .banner{ background-color:#f3f3f3;}';
	    		}
	    		printf(' <style type="text/css" id="home-single-page-banner-css"> %1$s  </style> ',$banner_css);
	    	}
	    }
   	}
}
function spice_Font($font)
{	
	if(function_exists('request_filesystem_credentials'))
    {    
        $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

       /* initialize the API */
       if ( ! WP_Filesystem($creds) ) {
       /* any problems and we exit */
       return false;
       }
    }
    else
    {
       return false;
    }
	global $wp_filesystem;
	$fontFile =get_stylesheet_directory().'/includes/cache/google-web-fonts.txt';
	$content = json_decode($wp_filesystem->get_contents($fontFile));	
	$new_content=array();
	$new_content[0]='';										
	$new_content=array_merge($new_content,$content->items);	
	$font_name='';
	if($font!=0)
	{							
		$font_name=$new_content[$font]->family;
	}																	
	return $font_name;			
}//end of function
function spice_BannerContent()
{	
	$banner='';
	$banner_text='SET BANNER FROM THEME OPTION';
	$banner_css='';
	$allowed_tags_before_after=array('span'=>array(),'div' => array('class'=>array()),'section'=>array('class'=>array()),'h2'=>array('class'=>array()),'h5'=>array('class'=>array()),'article'=>array('class'=>array())); 
	if(is_front_page() && !is_single() && !is_category() && !is_tag() && !is_day() && !is_month() && !is_year() && !is_author() && !is_search())
	{			

			if(spice_get_option('home-page-banner')==0)
			{
			    $slider=spice_get_option('opt-header-slider-shortcode');
			    if(!empty($slider))
			    {
					$banner.=do_shortcode($slider);
				}	
			}
			else
			{	
				$banner_text=spice_get_option('home-page-banner-text');			
				$banner.='<section class="top-content static_banner">';
				$banner.=$banner_text;
				$banner.='</section>';
			}
			printf('%s',$banner);
	}
	else
	{		
		if(!is_404())
		{	
			$top_text='<h5 class="animated fadeInUp"><span></span> '.get_bloginfo('description').' <span></span></h5>';
			if(spice_get_option('single-page-banner')==1)
			{
				
				$banner.='<section class="banner">';
				$banner.='<div class="container">';
				$page_title=get_the_title();
				if(empty($page_title))
				{
					if(is_search())
					{
						$page_title=_x('Results For : ','','SPICE').get_search_query();
						$title=$top_text.'<h2 class="animated fadeInUp">'.$page_title.'</h2>';
					}
					else
					{
						$title=$banner_text;
					}					
				}
				else
				{
					
					if(is_home())
					{
						$page_title='Blog Page';
					}
					if(is_single())				
					{
						$page_title= get_the_title();        
					}

					if(is_category())
					{
						$page_title= single_cat_title( '', false );
					}
					if(is_year())
					{
						$page_title= get_the_time('Y').' Archives';
					}
					if(is_month())
					{
						$page_title= get_the_time('M').' - '.get_the_time('Y').' Archives';
					}
					if(is_day())
					{
						$page_title=esc_html(get_the_time('jS')).' '.get_the_time('M').' - '.get_the_time('Y').' Archives';
					}
					if(is_tag())
					{
						$page_title=single_tag_title("", false);
					}
					if(is_author())
					{
						global $author;
            			$userdata = get_userdata( $author );   
            			$page_title='Author: '.esc_html(ucfirst($userdata->display_name));
					}
					if ( class_exists( 'WooCommerce' ) ) 
					{
						if(is_shop())
						{
							$page_title='Products Page';
						}

						if(is_product_category())
						{
							$page_title=single_tag_title("", false);
						}
					}
					if(is_search())
					{
						$page_title='Results For : '.get_search_query();
						$title=$top_text.'<h2 class="animated fadeInUp">'.$page_title.'</h2>';
					}

					$title=$top_text.'<h2 class="animated fadeInUp">'.$page_title.'</h2>';
				}
				if(!empty($title) && trim($title)!='')
				{
					$banner.='<article class="banner-caption">';
						$banner.=$title;				
					$banner.='</article>';					
				}
				$banner.='</div>';
				$banner.='</section>';

			}
			else
			{
				$banner_slider=spice_get_option('single-page-slider');
				$banner.='<section class="banner">';
				$banner.='<div class="container">';
				$banner.=do_shortcode($banner_slider);
				$banner.='</div>';
				$banner.='</section>';
			}
			
			printf(wp_kses(sprintf(__('%s','SPICE'), $banner),$allowed_tags_before_after));
		}
		else
		{
			$banner_404_image=spice_get_option('banner-404-image');
			$banner=get_template_directory_uri().'/images/404-bg.jpg';
			if(!empty($banner_404_image))
			{
				$banner=$banner_404_image['url'];
			}			
	    	$banner_css.='.error-page-html > section { background-image: url("'.esc_url($banner).'");background-position: center; background-size: contain; height: 100%;}';     	
	    	printf(' <style type="text/css" id="404-page-banner-css"> %1$s  </style> ',$banner_css);
		}		
	}	
}
function spice_SocialIcon()
{		
		$social_one_icon='';
		$social_two_icon='';
		$social_three_icon='';
		$social_four_icon='';	
		$social_four_link='';						
		$class='';
		$allowed_tags_before_after=array('ul' => array('class'=>array()),'li'=>array('class'=>array()),'a'=>array('class'=>array(),'href'=>array()),'i'=>array('class'=>array())); 
		
		if(spice_get_option('social-media-one-checkbox')==1)
		{
        	$social_one_icon = (( $social_one = spice_get_option('social-one-icon') ) && '' != $social_one ) ? $social_one : false;
			$social_one_url = (( $social_one_link = spice_get_option('social-one-url') ) && '' != $social_one_link ) ? $social_one_link : false;
		}
		if(spice_get_option('social-media-two-checkbox')==1)
		{
        	$social_two_icon = (( $social_two = spice_get_option('social-two-icon') ) && '' != $social_two ) ? $social_two : false;
			$social_two_url = (( $social_two_link = spice_get_option('social-two-url') ) && '' != $social_two_link ) ? $social_two_link : false;
		}
		if(spice_get_option('social-media-three-checkbox')==1)
		{
        	$social_three_icon = (( $social_three = spice_get_option('social-three-icon') ) && '' != $social_three ) ? $social_three : false;
			$social_three_url = (( $social_three_link = spice_get_option('social-three-url') ) && '' != $social_three_link ) ? $social_three_link : false;
		}
		if(spice_get_option('social-media-four-checkbox')==1)
		{
        	$social_four_icon = (( $social_four = spice_get_option('social-four-icon') ) && '' != $social_four ) ? $social_four : false;
			$social_four_url = (( $social_four_link = spice_get_option('social-four-url') ) && '' != $social_four_link ) ? $social_four_link : false;
		}
							

		$str='<ul class="social-btns clearfix">';
		
		if($social_four_icon)
		{
			$class=substr($social_four_icon,3);
			$str.='<li><a class="'.$class.'" href="'.esc_url($social_four_url).'"><i class="fa '.esc_attr($social_four_icon).'"></i></a></li>';
		}
		if($social_three_icon)
		{
			$class=substr($social_three_icon,3);
			$str.='<li><a class="'.$class.'" href="'.esc_url($social_three_url).'"><i class="fa '.esc_attr($social_three_icon).'"></i></a></li>';
		}
		if($social_two_icon)
		{
			$class=substr($social_two_icon,3);
			$str.='<li><a class="'.$class.'" href="'.esc_url($social_two_url).'"><i class="fa '.esc_attr($social_two_icon).'"></i></a></li>';
		}
		if($social_one_icon)
		{
			$class=substr($social_one_icon,3);
			$str.='<li><a class="'.$class.'" href="'.esc_url($social_one_url).'"><i class="fa '.esc_attr($social_one_icon).'"></i></a></li>';
		}
		
		$str.='</ul>'; 

		printf(wp_kses(sprintf(__('%s','SPICE'), $str),$allowed_tags_before_after));

}//end of function
function spice_font_meta( $select,$name)
{  	    		
		$creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

		/* initialize the API */
		if ( ! WP_Filesystem($creds) ) {
			/* any problems and we exit */
			return false;
		}	
		global $wp_filesystem;
        $fontFile =get_stylesheet_directory().'/includes/cache/google-web-fonts.txt';
        //Total time the file will be cached in seconds, set to a week
        $cachetime = 86400 * 7;
        if(file_exists($fontFile))
        {            
            $content = json_decode($wp_filesystem->get_contents($fontFile));
        } 
        
        
		$new_content=$content->items;
		$i=1;			
		echo '<select name="'.esc_attr($name).'" class="chosen-select-deselect" style="width:350px;">';
		echo '<option value="0"></option>';			

		foreach($content->items as $nc)
		{
			
			$selected="";
			if($i==$select)
			{
				$selected="selected";	
			}
			echo '<option value="'.esc_attr($i).'" '.esc_attr($selected).'>'.esc_html($nc->family).'</option>';		
			$i++;

		}
		echo '</select>';		
}//end of function
function spice_PageSubTitle($postid)
{
	$subtitle=get_post_meta($postid,'spice_page_subtitle',true);
	$str='<h4 class="page-sub-title-'.$postid.'">';
	if(isset($subtitle) && trim($subtitle)!='')
	{
		$str.=strip_tags($subtitle);
	}
	$str.='</h4>';
	return $str;
}
function spice_woocommerce_pagination_arrow( $args ) {

	$args['prev_text'] = _x('<','','SPICE');
	$args['next_text'] = _x('>','','SPICE');

	return $args;
}
add_action( 'woocommerce_before_shop_loop', 'spice_viewListGrid', 10);
function spice_viewListGrid()
{
	$allowed_tags_before_after=array('span' => array('class'=>array(),'title'=>array()),'i'=>array('class'=>array())); 
	printf(wp_kses(__('<span class="woocommerce-product-view list_container"><span class="box_span view_list" title="List View"><i class="fa fa-th-list"></i></span><span class="box_span view_grid" title="Grid View"><i class="fa fa-th-large"></i></span></span>','SPICE'),$allowed_tags_before_after));
}

add_filter( 'woocommerce_add_to_cart_fragments', 'spice_woocommerce_header_add_to_cart_fragment' );
function spice_woocommerce_header_add_to_cart_fragment( $fragments ) 
{

	ob_start();	
?>
	<a class="cart-contents" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php esc_html_e( 'View your shopping cart' ,'SPICE'); ?>"> <i class="fa fa-shopping-cart"></i>&nbsp;<?php echo sprintf (_n( ' %d item', '%d items', WC()->cart->cart_contents_count,'SPICE' ), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a> 
<?php
	
	
	$fragments['a.cart-contents'] = ob_get_clean();	
	return $fragments;
}
function spice_isWishList()
{
	$classes=get_body_class();
	if (in_array('woocommerce-wishlist',$classes)) 
	{
	   return true;
	}
	else
	{
		return false;
	}
}

function spice_post_type_cmb2($post_type='')
{
	  	$args = array(  'post_type' => $post_type, 
	            'orderby' => 'date', 
	            'order'   => 'DESC',
	            'post_status'=> 'publish', 
	            'posts_per_page'=>-1           
	          );
	    
	    $post_query = new WP_Query( $args ); 
	    $post_arr=array();
	    $all_posts=$post_query->posts;
	    if (count($all_posts) > 0) 
		{	
			foreach ($all_posts as $post) 
			{		    	      
				$post_arr[$post->ID]= $post->post_title;
			}	 
		}
		return $post_arr;
	 
}//end of function

add_action('wp_ajax_nopriv_everydayEvents', 'spice_everydayEvents' );
add_action("wp_ajax_everydayEvents","spice_everydayEvents");	
function spice_everydayEvents()
{	
	$items=$_POST['items'];
	$page_id=$_POST['page_id'];
	$offset=get_post_meta($page_id,'spice_home_event_no',true);

	$dt=date('Y-m-d');
	$query_args['post_type']='event';
	$query_args['posts_per_page']=$items;
	$query_args['meta_key']='spice_event_date';
    $query_args['orderby']='meta_value';
    $query_args['order']='ASC';
    $query_args['offset']=$offset;
    $query_args['meta_query']=array(
                                         array(
                                             'key'     => 'spice_event_date',
                                             'value'   =>  DATE($dt),
                                             'compare' => '>=',
                                             'type'  => 'DATE',
                                             
                                         ),
                                      );

							
	$event_query = new WP_Query( $query_args ); 
	

	if($event_query->have_posts())
	{
		while($event_query->have_posts()) : $event_query->the_post();
		$event_date=date('M d, Y',strtotime(get_post_meta(get_the_ID(),'spice_event_date',true)));
		$start_time=get_post_meta(get_the_ID(),'spice_event_start_time',true);
		$end_time=get_post_meta(get_the_ID(),'spice_event_end_time',true);
		$event_poster=get_post_meta(get_the_ID(),'spice_event_poster',true);

?>
		<div class="feature-events-wrapper">
			<div class="feature-events clearfix">
				<div class="figure">
					<div class="imgLiquidFill imgLiquid" >
						<img src="<?php printf('%s',esc_url($event_poster)); ?>" alt="">
						<div class="shine"></div>
					</div>
					<div class="corner-date"><?php printf('%s',esc_html($event_date)); ?></div>
				</div>

				<div class="figcaption event">
					<div class="corner-details">						
						<div class="corner-time"><i class="fa fa-clock-o"></i>
							<?php printf(__('%s - %s','SPICE'),esc_html($start_time),esc_html($end_time)); ?>
						</div>
					</div>

					<h3><?php the_title(); ?></h3>
					<p><?php printf('%s',spice_get_the_excerpt(30));?></p>					
					<a class="button" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read More','SPICE'); ?></a>
				</div>
			</div>
		</div>	

<?php
		endwhile;
	}//end if
	else
	{
		echo 1;
	}	
	die();
}


add_action('wp_ajax_nopriv_everydayEventsStyle2', 'spice_everydayEventsStyle2' );
add_action("wp_ajax_everydayEventsStyle2","spice_everydayEventsStyle2");	
function spice_everydayEventsStyle2()
{	
	$items=$_POST['items'];
	$page_id=$_POST['page_id'];
	$offset=get_post_meta($page_id,'spice_home_event_style2_no',true);

	$dt=date('Y-m-d');
	$query_args['post_type']='event';
	$query_args['posts_per_page']=$items;
	$query_args['meta_key']='spice_event_date';
    $query_args['orderby']='meta_value';
    $query_args['order']='ASC';
    $query_args['offset']=$offset;
    $query_args['meta_query']=array(
                                         array(
                                             'key'     => 'spice_event_date',
                                             'value'   =>  DATE($dt),
                                             'compare' => '>=',
                                             'type'  => 'DATE',
                                             
                                         ),
                                      );

							
	$event_query = new WP_Query( $query_args ); 

	if($event_query->have_posts())
	{
		while($event_query->have_posts()) : $event_query->the_post();
		$event_date=date('M d, Y',strtotime(get_post_meta(get_the_ID(),'spice_event_date',true)));
		$start_time=get_post_meta(get_the_ID(),'spice_event_start_time',true);
		$end_time=get_post_meta(get_the_ID(),'spice_event_end_time',true);
		$event_poster=get_post_meta(get_the_ID(),'spice_event_poster',true);

?>
		<div class="event-style2 event-<?php printf(__('%s','SPICE'),get_the_ID()) ?>">
			<div class="clearfix">
				<div class="figure col-md-6 imgLiquidFill imgLiquid home-page-event-style2">					
						<img src="<?php printf('%s',esc_url($event_poster)); ?>" alt="">																		
				</div>
				<div class="figcaption event col-md-6">
					<h3 class="blog-list-title"><?php the_title(); ?></h3>
					<h5><?php printf('%1$s | %2$s - %3$s',esc_html($event_date),esc_html($start_time),esc_html($end_time)); ?></h5>												
					<p><?php printf('%s',spice_get_the_excerpt(30));?></p>
					<a class="button red-btn" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read More','SPICE'); ?></a>
				</div>
			</div>
		</div>
<?php
		endwhile;
	}//end if
	else
	{
		echo 1;
	}	
	die();
}
function spice_header_block()
{
	$header_style=spice_get_option('opt-header-style');
	$opt_header_type=spice_get_option('opt-header-type');
	switch($header_style)
	{
		case 1: 
			$file_post_fix="default";
			break;

		case 2:
			$file_post_fix="one";	
			break;

		case 3:
			$file_post_fix="two";	
			break;

		case 4:
			$file_post_fix="three";	
			break;

		default :
			$file_post_fix="default";
			break;
	}
	if($opt_header_type==0)
	{
		$header_type='header-type2';
	}
	else
	{
		$header_type='header-type1';
	}
	$filename="includes/header-styles/spice-header-style-".$file_post_fix.'.php';

	if($file_post_fix!='three')
	{
		$enqueue_style_path=get_template_directory_uri().'/css/spice-header-style-default.css';
		wp_enqueue_style( 'spice-header-style', $enqueue_style_path, array() );
	}
	
	require_once $filename;
}//end of function

function spice_topheader_block($contact_flag=0)
{		
		$logo=spice_get_option(array('opt-logo-image','url')); 
		$contact_email=spice_get_option('opt-contact-email');
		$contact_phone=spice_get_option('opt-contact-phone');
		if(empty($logo))
		{
			$logo=get_template_directory_uri().'/images/logo-small.png';
		}

		if($contact_flag==0)
		{
	?>	
	<div class="head-contact">
		<?php 
				if(!empty($contact_phone) && $contact_phone!=0) 
				{
		?>
					<h5><i class="fa fa-phone"></i><span class="phone"><?php printf('%s',esc_html($contact_phone)); ?></span></h5>
		<?php
				}
		?>
		<h5><i class="fa fa-envelope-o"></i> <?php printf('%s',esc_html($contact_email)); ?></h5>
	</div>
	<?php
		}
	?>	
	<a class="logo" href="<?php echo site_url(); ?>">			            	
    	<img src="<?php printf('%s',esc_url($logo)); ?>" alt="">
  	</a>	
  	<?php			

}





add_action('wp_ajax_nopriv_bookingTable', 'spice_bookingTable' );
add_action("wp_ajax_bookingTable","spice_bookingTable");	
function spice_bookingTable()
{
	parse_str($_POST["formdata"], $post_data);		
	$page_id=$_POST['id'];	
	$occasion_var="occasion_date_time_".$page_id;
	$to=spice_get_option('opt-booking-contact-email');
	$personNo=$post_data["personNo_$page_id"];
	$occasionType=$post_data["occasionType_$page_id"];
	$customerName=$post_data["customer_name_$page_id"];
	$customerEmail=$post_data["customer_email_$page_id"];
	$customerPhone=$post_data["customer_phone_$page_id"];
	$occasion_date_time=$post_data[$occasion_var];	

	/********BOOKING MAIL SECTION START ****/
	
	$headers = array('Content-Type: text/html; charset=UTF-8','From: '.$customerName.' <'.$customerEmail.'>');
	$subject='Table Booking Mail';

	$message='Customer Name :'.$customerName;
	$message.='<br>No.of Heads:'.$personNo;
	$message.='<br>Date & Time:'.$occasion_date_time;
	$message.='<br>Customer Email:'.$customerEmail;
	$message.='<br>Customer Phone:'.$customerPhone;

	@wp_mail( $to, $subject, $message, $headers );

	/********BOOKING MAIL SECTION END ****/
	/********RESPONSE MAIL SECTION START ****/

	$re_headers = array('Content-Type: text/html; charset=UTF-8','From: Booking Executive <'.$to.'>');
	$re_subject="Re:".$subject;
	$re_message=spice_get_option('booking-reponse-msg');
	@wp_mail( $customerEmail, $re_subject, $re_message, $re_headers );

	/********RESPONSE MAIL SECTION END ****/

	global $wpdb;				
	$table_name = $wpdb->prefix . "booking_details";

	$booked_on=date('Y-m-d H:i:s');
	$sql="insert into $table_name values(NULL,'".$customerName."','".$customerEmail."','".$customerPhone."',".$personNo.",'".$occasion_date_time."','".$booked_on."','".$occasionType."',1);";
	$results = $wpdb->query( $sql );


	esc_html_e('Your booking will be confirmed over the mail','SPICE');


	die();
}//end of function
register_activation_hook(get_template_directory(),'spice_booking_install');
add_action('admin_menu','spice_booking_menu_page',100);
function spice_booking_menu_page() 
{
	add_theme_page( esc_html__( 'Booking Details', 'SPICE' ), esc_html__( 'Bookings', 'SPICE' ), 'manage_options', 'spice_menu_output', 'spice_booking_lists', '', 9 );		
}
function spice_booking_install()
{
    global $wpdb;				
	$table_name = $wpdb->prefix . "booking_details";

	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) 
	{
			$sql = "CREATE TABLE `".$table_name."` (
				  `booking_id` int(11) NOT NULL,
				  `customer_name` varchar(200) NOT NULL,
				  `customer_email` varchar(200) NOT NULL,
				  `customer_phone` varchar(20) NOT NULL,
				  `no_of_heads` int(10) NOT NULL,
				  `booking_date_time` datetime NOT NULL,
				  `booked_on` datetime NOT NULL,
				  `occasion_type` int(10) NOT NULL,
				  `status` int(2) NOT NULL DEFAULT '1'
				)";
		  
			  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		      dbDelta($sql);
	}
	
}//end of function
function spice_booking_lists()
{
	require_once  get_template_directory().'/includes/class/spice_table_class.php';
	global $wpdb;
	$msg_str='';
	$table_name = $wpdb->prefix . "booking_details";
	$sql="select * from $table_name where status=1";	

	$data_booking=$wpdb->get_results($sql);			
	$home_booking_occasions=spice_get_option('opt-occasions');

	if(isset($_GET['action']))
	{
		$booking_id=$_GET['booking'];
		switch($_GET['action'])
		{
			case 'trash':
							$msg_str=spice_booking_delete($booking_id);
							break;

		}
	}

	$booking_data=array();
	$i=0;
	foreach($data_booking as $data)
	{
		$booking_data[$i]['ID']=$data->booking_id;
		$booking_data[$i]['title']=ucwords($data->customer_name);	
		$booking_data[$i]['customer_email']=$data->customer_email;			
		$booking_data[$i]['customer_phone']=$data->customer_phone;
		$booking_data[$i]['no_of_heads']=$data->no_of_heads;		
		$booking_data[$i]['booking_date_time']=$data->booking_date_time;
		$booking_data[$i]['occasion_type']=ucwords($home_booking_occasions[$data->occasion_type]);
		$booking_data[$i]['booked_on']=$data->booked_on;		  
		$i++;
	} 	

	$testListTable = new TT_Example_List_Table($booking_data);
    //Fetch, prepare, sort, and filter our data...
    $testListTable->prepare_items();
    
    ?>
    <div class="wrap">        
        <div id="icon-users" class="icon32"><br/></div>
        <h2>Booking Lists</h2>     
        <?php printf(__('%s','SPICE'),$msg_str); ?>  
        <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
        <form id="movies-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $testListTable->display(); ?>
        </form>
    </div>
    <?php		
}//end of function

function spice_booking_delete($booking_id)
{	
	global $wpdb;
	$msg_str='';
	$table_name = $wpdb->prefix . "booking_details";
	$sql="update $table_name set status=-1 where booking_id=".$booking_id;
	$wpdb->query( $sql );
	$msg_str="<div>One Item Deleted</div>";
	return $msg_str;
}//end of function

/**
 *  Function Name   : spice_get_favicon
 *  Description     : Setting the favicon 
 */
function spice_get_favicon()
{
		if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) 
        {
	        $favicon=spice_get_option(array('opt-favicon-image','url')); 
	        if($favicon=='')
	        {		        		
	        	$favicon=get_template_directory_uri().'/images/favicon.png';	        		                     
	        }
	        printf('<link rel="shortcut icon" href="%1$s" type="image/png" sizes="16x16">',esc_url($favicon));
		}
		else
		{
			if(function_exists('wp_site_icon'))
			{
				wp_site_icon();
			}
		}        
}//end of function

/**
*   Function Name   : spice_hook_internal_css
*   Description     : Will add internal CSS added through Redux at the header section on Load
*/
add_action('wp_head','spice_hook_internal_css');
function spice_hook_internal_css()
{
    $internal_css = spice_get_option('opt-ace-editor-css');
    if ( false === $internal_css || '' == $internal_css ) 
    {
        return;
    }    
    printf(' <style type="text/css" id="spice-internal-css"> %1$s  </style> ',$internal_css);
} //end of function

/**
*   Function Name   : spice_integrate_head_scripts
*   Description     : Will add internal JS added through Redux at the header section on Load
*/
function spice_integrate_head_scripts()
{
    $integrate_script = spice_get_option('opt-ace-editor-js');
    if ( false === $integrate_script || '' == $integrate_script )
    {
         return;
    }   
    printf(' <script> %1$s  </script> ',$integrate_script);
} //end of function
add_action('wp_head','spice_integrate_head_scripts');

/**
 *  Function Name   : spice_add_last_nav_item
 *  Description     : Adding Search as last menu item to the Nav Menu. The Serach Menu can be Added/ Removed from Redux Admin. 
 */

function spice_add_last_nav_item($items,$args) 
{
		if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary-menu' !== $args->theme_location )
		{			
			return $items;
		}
		$template_dir = get_template_directory_uri();
		wp_enqueue_style( 'spice-style-font-awesome', $template_dir . '/css/font-awesome.min.css', array() );
		ob_start();
		global $woocommerce;		
        if(spice_get_option('opt-cart-menu')==1 && !spice_get_option('opt-cart-off'))                                            
        {          

            $items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page menu-cart">';
            $items .='<a href="'.$woocommerce->cart->get_cart_url().'">';
            $class_cart="display_none";
            if($woocommerce->cart->cart_contents_count>0)
            {
            	$class_cart="";            	
            }            
            $items .='<span class="item-count '.$class_cart.'">'.sprintf(__('%d', 'SPICE'), $woocommerce->cart->cart_contents_count).'</span>';            
            $items .='</a>';
            // Start of Sub Menu //                        
            $items .='<ul class="sub-menu"><li>';
            if($woocommerce->cart->cart_contents_count>0)
            {
	        	$items .= '<a class="cart-amount" href="'.$woocommerce->cart->get_cart_url().'">'.sprintf(__('Total Amount : %s','SPICE'),$woocommerce->cart->get_cart_total()).'</a>';
	        }
	        else
	        {
	        	$items .= '<a class="cart-amount" href="'.$woocommerce->cart->get_cart_url().'"><span class="no-cart-item">Cart is Empty</span></a>';
	        }
	        $items .= '</li></ul>';
	        //End of submenu
	       	$items .= '</li>'; //main menu li
        }
    
    return $items;
}
add_filter('wp_nav_menu_items','spice_add_last_nav_item',10,2);


add_action('wp_ajax_nopriv_cartMenuUpdate', 'spice_cartMenuUpdate' );
add_action("wp_ajax_cartMenuUpdate","spice_cartMenuUpdate");
function spice_cartMenuUpdate()
{
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	{			
		return $items;
	}
	ob_start();
	global $woocommerce;	
	echo sprintf(__('%d','SPICE'), $woocommerce->cart->cart_contents_count);
	die();
}

add_action('wp_ajax_nopriv_cartMenuTextUpdate', 'spice_cartMenuTextUpdate' );
add_action("wp_ajax_cartMenuTextUpdate","spice_cartMenuTextUpdate");
function spice_cartMenuTextUpdate()
{
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	{			
		return $items;
	}
	ob_start();
	global $woocommerce;	
	echo sprintf(__('Total Amount : %s','SPICE'), $woocommerce->cart->get_cart_total());
	die();
}

function spice_facebook_likes($pageid="tristupmyrest")
{         
		if(function_exists('request_filesystem_credentials'))
	    {    
	        $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

	       /* initialize the API */
	       if ( ! WP_Filesystem($creds) ) {
	       /* any problems and we exit */
	       return false;
	       }
	    }
	    else
	    {
	       return false;
	    }
		global $wp_filesystem;            
		
        $fb_fans=0;
        $cache = get_template_directory()."/includes/cache/social.data";

        $expire = 900; 
        if(!file_exists($cache) or (filemtime($cache) > $expire))
        {        
            $json_data = $wp_filesystem->get_contents($cache);
			$json_data =json_decode($json_data,true);
			$facebookUrl = 'https://www.facebook.com/'.$pageid;
	        $fql="select share_count, like_count, comment_count ";
		    $fql.= " FROM link_stat WHERE url = '$facebookUrl'";		 
		    $fqlURL = "http://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);		 
		    // Facebook Response is in JSON
		    $res = wp_remote_get($fqlURL);
        	$file_content = $res['body'];
		    $response = json_decode($file_content);
		    $json_data['social']['facebook']['like']= $response[0]->like_count;		   
		    $wp_filesystem->put_contents($cache,json_encode($json_data));
        }
        $json_data = $wp_filesystem->get_contents($cache);
		$json_data =json_decode($json_data,true);		
        $fb_like=$json_data['social']['facebook']['like'];
        return spice_nbr_format($fb_like);
        
}//end of function
function spice_nbr_format($nbr)
{
        if(is_numeric($nbr))
        {
            return number_format($nbr);
        }
        else
        { 
        	return null;
        }
}
function spice_social_icons_cmb2()
{
	$social_arr=array();
	$social_arr['fa-facebook']='Facebook';
	$social_arr['fa-google-plus']='Google Plus';
	$social_arr['fa-pinterest']='Pinterest';
	$social_arr['fa-tumblr']='Tumblr';
	$social_arr['fa-twitter']='Twitter';
	$social_arr['fa-flickr']='Flickr';
	$social_arr['fa-vimeo-square']='Vimeo';
	$social_arr['fa-youtube']='Youtube';
	$social_arr['fa-linkedin']='Linkedin';
	$social_arr['fa-rss']='RSS';	 

	return $social_arr;	
}
function spice_all_location()
{
	$query_args['post_type']='location';
	$query_args['post_status']='publish';
    
    $locations = new WP_Query( $query_args );			
    $markers=array();
    $str=''; 

    foreach($locations->posts as $location)
    {    	
    	$lat_long=explode(',',get_post_meta($location->ID,'spice_location_lat_long',true));
    	$infowindow= get_post_meta($location->ID,'spice_location_wysiwyg',true);
    	$str.="['".$location->ID."','".$lat_long[0]."','".$lat_long[1]."','".$location->post_title."','".$infowindow."'],";   	
    }
    return $str;   
}//end of function
function spice_getLogo()
{
	$logo=spice_get_option(array('opt-logo-image','url')); 
	return $logo;
}

/**
*  Function Name   : spice_render_videobackground
*  Description     : Setting the background video 
*/
function spice_render_videobackground( $post_id, $page_video_opt=3 )
{	
	$page_bg_video = array();
	$is_html5_video = false;	
	$page_bg_video['html5']['mp4']=get_post_meta($post_id,'spice_page_bg_video_mp4',true);
	$page_bg_video['html5']['webm']=get_post_meta($post_id,'spice_page_bg_video_wmv',true);
	$page_bg_video['html5']['ogg']=get_post_meta($post_id,'spice_page_bg_video_ogg',true);	
	$page_video_opt=$page_bg_video['type']=intval(get_post_meta($post_id,'spice_page_bg_video',true));
	$page_bg_video['embed']=get_post_meta($post_id,'spice_page_bg_video_embed',true);
	$embed_type='';	
	$video_id='';		

	if(get_post_meta($post_id,'spice_page_include_bg_video',true)=='on')
	{
			if($page_bg_video['type']==1)
			{

				if(!empty($page_bg_video['embed']))
				{

						if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $page_bg_video['embed'], $match))            
						{
							$embed_type='youtube';
							$youtube=true;  
							$vimeo=false;                
							$video_id=$match[1];
						}
						if(strpos($page_bg_video['embed'],'vimeo.com'))
						{
							$embed_type='vimeo';  
							$video_id=$page_bg_video['embed'];            
						}
				}
			}	
			if($page_video_opt!=0 && is_array($page_bg_video) && count($page_bg_video) > 0)
			{
					$is_html5_video = is_array( $page_bg_video['html5'] ) && count( $page_bg_video['html5'] ) > 0 && $page_video_opt===3 ? true : false;
				?>
				<div class="spice_section_video_bg <?php echo $is_html5_video ? 'translate_center' : ''; ?>">
					<?php 
					switch($page_video_opt)
					{

						case 1:	echo spice_EmbedVideoBg($embed_type,$video_id);
								break;			
						
						case 3:									
								if($is_html5_video)
								{
									?>
									<video loop="loop" autoplay="autoplay">
										<?php										
												foreach($page_bg_video['html5'] as $video_idx=>$video_val)
												{											
													if(!empty($video_val))
													{
														
										?>
														<source src="<?php echo $video_val; ?>" type="video/<?php echo $video_idx; ?>">
										<?php 
													}
												} 
										?>
									</video>
									<?php 

										
								}
								break; 
					}//switch 
					?>	
				</div>
				<?php 
			}
	}
}//end of function
function spice_EmbedVideoBg($embed_type,$video_id)
{
	$str='';
	if($embed_type=='youtube')
	{
		$str=sprintf('<div class="sharing_frame"><iframe src="//www.youtube.com/embed/'.esc_html($video_id).'?autoplay=1&amp;controls=0&amp;loop=1&amp;modestbranding=1&amp;wmode=Opaque&amp;enablejsapi=1&amp;rel=0&amp;playlist='.esc_html($video_id).'" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe></div>');
	}
	else
	{
		$str=sprintf('<div class="sharing_frame">
							<iframe src="https://player.vimeo.com/video/'.(int) substr(parse_url(esc_url($video_id), PHP_URL_PATH), 1).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1&amp;loop=1&amp;controls=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						</div>');			
	}
	return $str;
}//end of function
function spice_HasVideo($post_id)
{
	$page_video_opt=intval(get_post_meta($post_id,'spice_page_bg_video',true));
	if(!empty($page_video_opt))
	{
		echo 'has_video';
		wp_enqueue_style('wp-mediaelement');
    	wp_enqueue_script('wp-mediaelement');       
		wp_enqueue_script( 'spice-js-videobg', get_template_directory_uri() . '/js/video-background.js', array( 'jquery' ), '1.6.2', true );
	}
}
if ( class_exists( 'WooCommerce' ) ) 
{
	function spice_woocommerce_product_categories_cmb2()
	{
		$args = array( 'taxonomy' => 'product_cat' );
		$terms = get_terms('product_cat', $args);	
		$cat_arr=array();
		if (count($terms) > 0) 
		{	
			foreach ($terms as $term) 
			{		    	      
				$cat_arr[$term->term_id]= $term->name;
			}	 
		}
		return $cat_arr;	
	}//end of function
}
function spice_SocialMeta()
{
	$str='';
	$flag=0;
	if(spice_get_option('spice-share-checkbox'))
	{

		$str='<div class="spice-share-options">';
		$str.='<h6 class="share_it">Share it</h6>';

		if(spice_get_option('twitter-share'))
		{
			$str.='<a href="" class="twitter-sharer" onClick="spiceShare(\'twitter\')"><i class="fa fa-twitter"></i></a>';
			$flag=1;
		}
		if(spice_get_option('fb-share'))
		{
			$str.='<a href="" class="facebook-sharer" onClick="spiceShare(\'fb\')"><i class="fa fa-facebook"></i></a>';
			$flag=1;
		}
		if(spice_get_option('pinterest-share'))
		{
			$str.='<a href="" class="pinterest-sharer" onClick="spiceShare(\'pinterest\')"><i class="fa fa-pinterest"></i></a>';
			$flag=1;
		}
		if(spice_get_option('gp-share'))
		{
			$str.='<a href="" class="google-sharer" onClick="spiceShare(\'gp\')"><i class="fa fa-google-plus"></i></a>';        
			$flag=1;
		}
		if(spice_get_option('linkedin-share'))
		{	    
	    	$str.='<a href="" class="linkedin-sharer" onClick="spiceShare(\'linkedin\')"><i class="fa fa-linkedin"></i></a>';
	    	$flag=1;
	    }

	    $str.='</div>';

	    if($flag==1)
	    {
	    	return $str;
	    }
	}
}//end of function

function spice_loggedin_user()
{
	$user = wp_get_current_user();	
	if(!empty($user->ID))
	{
		$currentuser['ID'] = $user->ID;
		$currentuser['user_nicename'] = $user->data->user_nicename;
		$currentuser['user_email'] = $user->data->user_email;
		$currentuser['display_name'] = $user->data->display_name;
		$currentuser['caps'] = $user->caps;
		$currentuser['roles'] = $user->roles[0];
		
	}
	$currentuser['is_loggedin'] = is_user_logged_in();
	return $currentuser;
}

add_action('init', 'spice_filter_shortcode_array');
function spice_filter_shortcode_array()
{
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
	{
		add_filter('mce_external_plugins', 'spice_shortcodes_plugin');
		add_filter('mce_buttons', 'spice_register_shortcodes');
	}
}

function spice_register_shortcodes($buttons) 
{  
   array_push($buttons, "spiceshortcode");
   return $buttons;
}
function spice_cpt_shortcodes()
{
	if(is_plugin_active('spice-cpt/spice-cpt.php'))
	{
		 $args = array(
		    'post_type' => 'chef',
		    'post_status' => 'published',		   
		    'numberposts' => -1
		);
		$chef_num = count(get_posts($args));
		if($chef_num>0)
		{
		
?>	
		<script type="text/javascript">
					var my_plugin_shortcode = ['chef'];				
		</script>
<?php
		}
	}
	else
	{
?>	
		<script type="text/javascript">
					var my_plugin_shortcode = [];
		</script>
<?php
	}
}
add_action( 'admin_head', 'spice_cpt_shortcodes');
function spice_shortcodes_plugin($plugin_array) 
{

    if(is_plugin_active('spice-shortcode/spice-shortcode.php'))
    {	
    	$plugin_array['spiceshortcode'] =  get_template_directory_uri().'/js/shortcode_generator/shortcodes-generator.js'; 
   		return $plugin_array;
   	}
}

function spice_googleplus_count( $user, $apikey ) 
{	
	if(function_exists('request_filesystem_credentials'))
    {    
        $creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());

       /* initialize the API */
       if ( ! WP_Filesystem($creds) ) {
       /* any problems and we exit */
       return false;
       }
    }
    else
    {
       return false;
    }
	global $wp_filesystem;
	$google='';
  if($user <> '' && $apikey <> '')
  {
   	$google = $wp_filesystem->get_contents( 'https://www.googleapis.com/plus/v1/people/' . $user . '?key=' . $apikey );
  }
  if(property_exists($google,'circledByCount'))
  {
  	return json_decode( $google )->circledByCount;
  }
}
function spice_dribbble_count($access_token){  
   // we have bearer token wether we obtained it from API or from options
   $args = array(
       'httpversion' => '1.1',
       'blocking' => true,
       'headers' => array(
           'Authorization' => "Bearer ".$access_token
       )
   );

   add_filter('https_ssl_verify', '__return_false');
   $api_url = "https://api.dribbble.com/v1/user?access_token=$access_token";
   $response = wp_remote_get($api_url, $args);
   $getdribbble_followers = json_decode(wp_remote_retrieve_body($response));
   $getdribbble_response = json_decode(wp_remote_retrieve_response_code($response));
   
   if($access_token!=''){
     if ($getdribbble_response=='200') {
             $dribbble_followers = $getdribbble_followers->followers_count;
         } else {
              $dribbble_followers =wp_remote_retrieve_response_message($response);                     
         }
   }else{
        $dribbble_followers=wp_remote_retrieve_response_message($response);                         
   }
 return $dribbble_followers;      
}

/**
 *  Function Name   : spice_get_the_excerpt
 *  Description     : Geting the excerpt data with length specified as parameter
 */
function spice_get_the_excerpt($word_limit)
{
    
    $excerpt = get_the_excerpt();

    $words = explode(' ', $excerpt, ($word_limit + 1));

        if(count($words) > $word_limit) 
        {
          array_pop($words);
          
          return implode(' ', $words)."..."; 
        } else {
          //otherwise
          return implode(' ', $words); 
        }

} //end of function


function spice_added_to_cart_text( $translation, $text, $domain ) {
 
    if ( $text == 'View Cart' ) 
    { // current text that shows
        $translation = esc_html__("<i class='fa  fa-check-circle'></i>",'SPICE'); // The text that you would like to show
    }
 

  return $translation;
}
add_filter( 'gettext', 'spice_added_to_cart_text', 10, 3 );

/**
** Overriding wp_login_form
 */
function spice_login_form( $args = array() ) 
{
	$defaults = array( 'echo' => true,
						'redirect' => site_url( esc_url($_SERVER['REQUEST_URI']) ), // Default redirect is back to the current page
	 					'form_id' => 'loginform',
						'label_username' => esc_html__( 'Username','SPICE' ),
						'label_password' => esc_html__( 'Password' ,'SPICE'),
						'label_remember' => esc_html__( 'Remember Me','SPICE' ),
						'label_log_in' => esc_html__( 'Log In' ,'SPICE'),
						'id_username' => 'user_login',
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => true,
						'value_username' => '',
						'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
					);
	$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

	$form = '
		<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . site_url( 'wp-login.php', 'login' ) . '" method="post">
			' . apply_filters( 'login_form_top', '' ) . '
			<p class="login-username">
				<label for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
				<input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" tabindex="10" />
			</p>
			<p class="login-password">
				<label for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
				<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" tabindex="20" />
			</p>
			' . apply_filters( 'login_form_middle', '' ) . '
			' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever" tabindex="90"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
			<p class="login-submit">
				<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button-primary red-btn" value="' . esc_attr( $args['label_log_in'] ) . '" tabindex="100" />
				<input type="hidden" name="redirect_to" value="' . esc_attr( $args['redirect'] ) . '" />
			</p>
			' . apply_filters( 'login_form_bottom', '' ) . '
		</form>';

	if ( $args['echo'] )
		echo $form;
	else
		return $form;
} //end of function
if ( class_exists( 'WooCommerce' ) ) 
{	
	function spice_remove_cart()
	{		
		if(spice_get_option('opt-cart-off'))
		{
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		}
	}	
	add_action('wp_head','spice_remove_cart');	
}
function spice_widget_no_title($params) 
{
    global $wp_registered_widgets;
    $settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
    $settings = $settings_getter->get_settings();
    $settings = $settings[ $params[1]['number'] ];   

    if ( $params[0]['widget_name']=='Search' ) 
    {
    	$params[0]['before_widget']='<article id="%1$s" class="widgets archive-list %2$s"><div class="widget-content">';       
    }
   
    
    return $params;
}
add_filter('dynamic_sidebar_params', 'spice_widget_no_title');
/**
 *  Function Name   : spice_list_pings
 *  Description     : 
 */
if ( ! function_exists( 'spice_list_pings' ) )
{
    function spice_list_pings($comment, $args, $depth) 
    {
        $GLOBALS['comment'] = $comment; 
?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
<?php 
    }
}
function spice_woocommerce_comments($comment)
{ 	  
	
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ));
		$star_width=(((float)$rating*100)/5).'%';
		$product = new WC_Product( $comment->comment_post_ID );  
		$customer=new WC_Customer($comment->user_id);
		
?>
	<div class="review-item-wrapper col-md-6">
		<div id="product-comment-<?php echo esc_attr($comment->comment_ID); ?>" class="product_review_container">
				<h4><?php printf('%s',esc_html($comment->post_title)); ?>
					<span class="rating-stars">
						<div class="star-rating" title="Rated <?php echo esc_attr($rating); ?> out of 5">
							<span style="width:<?php echo esc_attr($star_width); ?>">
									<strong class="rating"><?php echo esc_html($rating); ?></strong><?php esc_html_e('out of 5','SPICE'); ?>
							</span>
						</div>
					</span>
				</h4>
        <div class="comment_description">
				<?php printf('%s',esc_html($comment->comment_content)); ?>
          </div>    
          <div class="reviewer_container">
          	<div class="reviewer_avatar">
          		<?php echo get_avatar( $comment->user_id, $size='60' ); ?>
          		<div>
          			<div class="reviewer_name"><?php printf('%s',ucfirst(esc_html($comment->comment_author))); ?></div>
          			<div class="reviewer_addr"><?php printf('%s',esc_html($customer->address_1)); ?></div>
          		</div>
          	</div>	            	   
          	<div class="reviewer_rating"><i class="fa fa-heart"></i><?php esc_html_e('Your Rating','SPICE'); ?><strong><?php printf('%s',esc_html($rating)); ?></strong></div>            	
          </div>
		</div>
	</div>
<?php
	

}//end of function
function spice_cart_at_side()
{
	ob_start();
    global $woocommerce; 
?>
	<div class="menu-cart">
        <a class="cart-btn" href="<?php echo esc_url($woocommerce->cart->get_cart_url()); ?>">
        <?php
        		$class_cart='display_none';
        		if($woocommerce->cart->cart_contents_count>0)
        		{
        			$class_cart="";
        		}
        ?>
        <span class="item-count <?php echo esc_attr($class_cart); ?>"><?php printf(__('%d', 'SPICE'), $woocommerce->cart->cart_contents_count); ?></span>
        </a>
    </div>
<?php
}
function spice_excerpt_length( $length ) 
{
	return 25;
}
add_filter( 'excerpt_length', 'spice_excerpt_length', 999 );

/*****  CMB2 URL For WINDOWS **/
function spice_filter_cmb2_url()
{
	return get_template_directory_uri()."/includes/cmb/";
}//end of function
add_action( 'admin_menu', 'remove_redux_menu',12 );
function remove_redux_menu() {
    remove_submenu_page('themes.php','redux-about');
}