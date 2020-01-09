<?php

/**** TO ADD NEW TYPE NUMERIC SLIDER **/
add_action( 'cmb2_render_numeric_slider', 'spice_numeric_slider', 10, 5 );
function spice_numeric_slider( $field_args, $escaped_value, $object_id, $object_type, $field_type_object ) 
{		
	global $post;	
	$page_bgcolor_opacity=get_post_meta($post->ID,$field_args->args['id'],true);
	$max='100';
	if(isset($field_args->args['max']))
	{
		$max=(string)$field_args->args['max'];
	}
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-slider',array( 'jquery','jquery-ui-core' ));	
	wp_enqueue_script( 'cmb2_field_slider_js', get_template_directory_uri().'/js/spice_cmb2_field_slider.js' , array( 'jquery', 'jquery-ui-slider' ));
	wp_register_style( 'slider_ui', 'http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css', array(), '1.0' );
	wp_enqueue_style( 'cmb2_field_slider_css', get_template_directory_uri().'/css/spice_cmb2_field_slider.css', array( 'slider_ui'));	
	
    echo '<div class="numeric-slider-field"></div>';
	echo $field_type_object->input( array(
		'type'       => 'hidden',
		'class'      => 'numeric-slider-field-value',
		'readonly'   => 'readonly',
		'data-start' => absint( $page_bgcolor_opacity ),
		'data-min'   =>'0',
		'data-max'   => $max,
		'desc'       => '',
	) );
	echo '<span class="numeric-slider-field-value-display"> <span class="numeric-slider-field-value-text"></span></span>';

}
add_filter( 'cmb2_validate_numeric_slider', 'spice_cmb2_validate_numeric_slider' );
function spice_cmb2_validate_numeric_slider( $override_value, $value ) 
{   
    return $value;
}
/*********************END ***********************/

/********************* START FONT DROP DOWN *********************/
add_action( 'cmb2_render_font_dropdown', 'spice_font_dropdown', 10, 5 );
function spice_font_dropdown( $field_args, $escaped_value, $object_id, $object_type, $field_type_object ) 
{	
	global $post;

	wp_enqueue_style( 'chosen-style', get_template_directory_uri(). '/css/chosen.css'); 	 
	wp_enqueue_script( 'chosen-js', get_template_directory_uri(). '/js/chosen.jquery.js', array( 'jquery' ), '1.1.5',true );  
	wp_enqueue_script( 'chosen-custom', get_template_directory_uri(). '/js/chosen.js', array( 'chosen-js' ), '1.0',true );

	$select=get_post_meta($post->ID,$field_args->args['id'],true);
	$name=$field_args->args['id'];
	spice_font_meta($select,$name);

}
add_filter( 'cmb2_validate_font_dropdown', 'spice_cmb2_validate_font_dropdown' );
function spice_cmb2_validate_font_dropdown( $override_value, $value ) 
{   
    return $value;
}

/*********************  END FONT DROP DOWN **********************/

add_filter( 'cmb2_init', 'spice_page_meta_box' );
function spice_page_meta_box()
{	
	$prefix = 'spice_page_';
	$cmb_page = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Page Settings', 'SPICE' ),
		'object_types'  => array( 'page', ), // Post type	
	) );

	/******************* BACKGROUND SETTINGS STARTS ************/
	$cmb_page->add_field( array(
		'name'     => esc_html__( 'Background Settings', 'SPICE' ),		
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
		
	) );

	$cmb_page->add_field( array(
		'name'    => esc_html__( 'Background Color', 'SPICE' ),
		'desc'    => esc_html__( 'Set Background Page Color', 'SPICE' ),
		'id'      => $prefix . 'bg_color',
		'type'    => 'colorpicker',
		
	) );

	$cmb_page->add_field( array(
		'name' => esc_html__( 'Background Pattern', 'SPICE' ),
		'desc' => esc_html__( 'Upload an bacground pattern image', 'SPICE' ),
		'id'   => $prefix . 'bg_pattern',
		'type' => 'file',
		'preview_size' => array( 50, 50 ),
		
	) );


	$cmb_page->add_field( array(
		'name' => esc_html__( 'Background Image', 'SPICE' ),
		'desc' => esc_html__( 'Upload an bacground image', 'SPICE' ),
		'id'   => $prefix . 'bg_image',
		'type' => 'file',
		'preview_size' => array( 50, 50 ),
		
	) );



	$cmb_page->add_field( array(
		'name' => esc_html__( 'Background Image Style', 'SPICE' ),
		'desc' => esc_html__( 'check if you want to set parallax/fixed background ', 'SPICE' ),
		'id'   => $prefix . 'bg_style',
		'type' => 'radio_inline',
		'default'          => '1',
		'options'          => array(
			'1' => esc_html__( 'None', 'SPICE' ),
			'2'   => esc_html__( 'Fixed', 'SPICE' ),
			'3'   => esc_html__( 'Parallax', 'SPICE' ),
		),		
	) );

	$cmb_page->add_field( array(
	    'name'        => 'Parallax Background Ratio',
	    'desc'        => 'will effect the background opacity.',
	    'id'          => $prefix . 'bg_ratio',
	    'type'        => 'numeric_slider',			   
	    'default'     => '0', // start value
	    'max'		  => '200',	 
	    'before_row'   => '<div class="bg_parallax" style="display:none;">', // callback   	   
			   
	));

	$cmb_page->add_field( array(
	    'name'        => 'Parallax Background Vertical Ratio',
	    'desc'        => 'will effect the background opacity.',
	    'id'          => $prefix . 'bg_vertical_ratio',
	    'type'        => 'numeric_slider',			   
	    'default'     => '0', // start value
	    'max'		  => '1000',	   	    
	    'after_row'    => '</div>',
			   
	));


	$cmb_page->add_field( array(
		'name'             => esc_html__( 'Background Video', 'SPICE' ),		
		'id'               => $prefix . 'include_bg_video',			
		'type' => 'checkbox',
	) );

	$cmb_page->add_field( array(
		'name'             => esc_html__( 'Background Video Type', 'SPICE' ),		
		'id'               => $prefix . 'bg_video',
		'type'             => 'radio_inline',	
		'attributes'  => array('class'=>'testc'),	
		'options'          => array(
			'3' => esc_html__( 'Upload Video', 'SPICE' ),
			'1'   => esc_html__( 'Embed Video', 'SPICE' ),			
		),
	) );
	/****** UPLOAD VIDEO SECTION *****/
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Upload Background Video', 'SPICE' ),
		'desc' => esc_html__( 'Upload a MP4 format bacground video', 'SPICE' ),
		'id'   => $prefix . 'bg_video_mp4',
		'type' => 'file',
		'preview_size' => array( 50, 50 ),
		'before_row'   => '<div class="upload_video">', // callback			
		
		
	) );
	$cmb_page->add_field( array(
		'name' => esc_html__( ' ', 'SPICE' ),
		'desc' => esc_html__( 'Upload a OGG bacground video', 'SPICE' ),
		'id'   => $prefix . 'bg_video_ogg',
		'type' => 'file',
		'preview_size' => array( 50, 50 ),	
		
	) );
	$cmb_page->add_field( array(
		'name' => esc_html__( ' ', 'SPICE' ),
		'desc' => esc_html__( 'Upload a WMV bacground video', 'SPICE' ),
		'id'   => $prefix . 'bg_video_wmv',
		'type' => 'file',
		'preview_size' => array( 50, 50 ),	
		'after_row'    => '</div>',
		
	) );
	/****** EMBED VIDEO SECTION *****/
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Embed Video', 'SPICE' ),
		'desc' => esc_html__( 'embed video', 'SPICE' ),
		'id'   => $prefix . 'bg_video_embed',
		'type' => 'text',
		'preview_size' => array( 50, 50 ),
		'before_row'   => '<div class="embed_video" style="display:none;">', // callback	
		'after_row'    => '</div>',
		
	) );
	/*********************************/


		
	$cmb_page->add_field( array(
			    'name'        => 'Background Opacity',
			    'desc'        => 'will effect the background opacity.',
			    'id'          => $prefix . 'bgcolor_opacity',
			    'type'        => 'numeric_slider',			   
			    'default'     => '0', // start value
			   
	));

	/******************* BACKGROUND SETTINGS ENDS ************/

    /*******************  TITLE SETTINGS STARTS **************/
	$cmb_page->add_field( array(
		'name'     => esc_html__( 'Title & Subtitle Settings', 'SPICE' ),		
		'id'       => $prefix . 'extra_info_1',
		'type'     => 'title',
		'on_front' => false,
		
	) );


	$cmb_page->add_field( array(
		'name'    => esc_html__( 'Text Font Color', 'SPICE' ),
		'desc'    => esc_html__( 'Set Background Page Color', 'SPICE' ),
		'id'      => $prefix . 'font_color',
		'type'    => 'colorpicker',		
	) );
	$cmb_page->add_field( array(
		'name'             => esc_html__( 'Title Alignment', 'SPICE' ),
		'desc'             => esc_html__( 'field description (optional)', 'SPICE' ),
		'id'               => $prefix . 'title_align',
		'type'             => 'radio_inline',		
		'options'          => array(
			'left' =>  '<i class="fa fa-align-left"></i>',
			'center'   => '<i class="fa fa-align-center"></i>',
			'right'     => '<i class="fa fa-align-right"></i>',
		),
		'before_field' => '<div class="title-align">',
		'after_field'  => '</div>',
	) );


	$cmb_page->add_field( array(
		'name'    => esc_html__( 'Title Font', 'SPICE' ),
		'desc'    => esc_html__( 'Set Font for Page Title', 'SPICE' ),
		'id'      => $prefix . 'title_font',
		'type'    => 'font_dropdown',		
	) );

	$cmb_page->add_field( array(
		'name'    => esc_html__( 'Title Font Color', 'SPICE' ),
		'desc'    => esc_html__( 'Set Background Page Color', 'SPICE' ),
		'id'      => $prefix . 'title_font_color',
		'type'    => 'colorpicker',
		
	) );
	
	
	$cmb_page->add_field( array(
		'name' => esc_html__( 'Title Font Size ', 'SPICE' ),
		'desc' => esc_html__( 'set font size for title', 'SPICE' ),
		'id'   => $prefix . 'title_font_size',
		'type' => 'text_medium',
		
	) );


	$cmb_page->add_field( array(
		'name' => esc_html__( 'Subtitle ', 'SPICE' ),
		'desc' => esc_html__( 'subtitle for page', 'SPICE' ),
		'id'   => $prefix . 'subtitle',
		'type' => 'text',
		
	) );	

	$cmb_page->add_field( array(
		'name'    => esc_html__( 'Subtitle Font', 'SPICE' ),
		'desc'    => esc_html__( 'Set Font for Page Subtitle', 'SPICE' ),
		'id'      => $prefix . 'subtitle_font',
		'type'    => 'font_dropdown',		
	) );
	$cmb_page->add_field( array(
		'name'    => esc_html__( 'Subtitle Font Color', 'SPICE' ),
		'desc'    => esc_html__( 'Set Background Page Color', 'SPICE' ),
		'id'      => $prefix . 'subtitle_font_color',
		'type'    => 'colorpicker',
		
	) );
	 /*******************  TITLE SETTINGS ENDS **************/
	
	
}//end of function



/******* START OF CALL TO ACTION PAGE TEMPLATE *******/


add_filter( 'cmb2_init', 'spice_cta_page_meta_box' );
function spice_cta_page_meta_box()
{	
	$prefix = 'spice_cta_';
	$cmb_cta = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Call To Action Settings', 'SPICE' ),
		'object_types'  => array( 'page', ), // Post type
	
	) );

	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Button Text ', 'SPICE' ),
		'desc' => esc_html__( 'text for button', 'SPICE' ),
		'id'   => $prefix . 'button_text',
		'type' => 'text_medium',
		
	) );	
	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Button  URL ', 'SPICE' ),
		'desc' => esc_html__( 'URL for button', 'SPICE' ),
		'id'   => $prefix . 'button_url',
		'type' => 'text_medium',
		
	) );		
	
}//end of function

/******* END OF CALL TO ACTION PAGE TEMPLATE *******/

/******* START OF CONTACT PAGE TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_contact_page_meta_box' );
function spice_contact_page_meta_box()
{	
	$prefix = 'spice_contact_';
	$cmb_contact = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Contact Page Settings', 'SPICE' ),
		'object_types'  => array( 'page', ), // Post type
	
	) );

	
	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Contact Page Google Map', 'SPICE' ),
		'desc' => esc_html__( 'check to show google map with contact form', 'SPICE' ),
		'id'   => $prefix . 'google_map',
		'type' => 'checkbox',
		'before_row'   => '<div class="">', // callback	
		'after_row'    => '</div>',
	) );

	$cmb_contact->add_field( array(
		'name'    => esc_html__( 'Google Map Color', 'SPICE' ),
		'desc'    => esc_html__( 'Set Google map Color', 'SPICE' ),
		'id'      => $prefix . 'google_map_color',
		'type'    => 'colorpicker',		
		'before_row'   => '<div class="contact-map-class">', // callback	
		'after_row'    => '</div>',
	) );
	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Google Map Marker', 'SPICE' ),
		'desc' => esc_html__( 'Leave blank if not default is required', 'SPICE' ),
		'id'   => $prefix . 'google_marker',
		'type' => 'file',
		'before_row'   => '<div class="contact-map-class">', // callback	
		'after_row'    => '</div>',
	) );
	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Contact Page Logo box', 'SPICE' ),
		'desc' => esc_html__( 'logo box with google map', 'SPICE' ),
		'id'   => $prefix . 'logo_box',
		'type' => 'checkbox',
		
	) );
	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Contact Page Logo box Background', 'SPICE' ),
		'desc' => esc_html__( 'logo box with google map', 'SPICE' ),
		'id'   => $prefix . 'logo_box_background',
		'type'    => 'colorpicker',
		
		
	) );

	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Contact Form ', 'SPICE' ),
		'desc' => esc_html__( 'shortcode for contact form', 'SPICE' ),
		'id'   => $prefix . 'form_shortcode',
		'type' => 'text_medium',
		
	) );		
	
}//end of function

/******* END OF CONTACT PAGE TEMPLATE *******/

/******* START OF PRODUCT PAGE TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_product_page_meta_box' );
function spice_product_page_meta_box()
{	
	$prefix = 'spice_product_page_';
	$cmb_product = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Product Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );
	if ( class_exists( 'WooCommerce' ) ) 
	{		
		$cmb_product->add_field( array(
			'name'    => esc_html__( 'Category To Display ', 'SPICE' ),			
			'id'      => $prefix . 'cetegories',
			'type'    => 'multicheck',			
			'options' => spice_woocommerce_product_categories_cmb2(),
			'inline'  => true, // Toggles display to inline
		) );
	}
	else
	{

	}
	
	
}//end of function

/******* END OF PRODUCT PAGE TEMPLATE *******/

/******* START OF MENU PAGE TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_menu_page_meta_box' );
function spice_menu_page_meta_box()
{	
	$prefix = 'spice_menu_page_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Menu Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	if ( class_exists( 'WooCommerce' ) ) 
	{	
		$cmb_menu->add_field( array(
			'name'    => esc_html__( 'Category To Display ', 'SPICE' ),
			'desc'    => esc_html__( 'in menu page categories', 'SPICE' ),
			'id'      => $prefix . 'product_cetegories',
			'type'    => 'multicheck',
			//'multiple' => true, // Store values in individual rows
			'options' => spice_woocommerce_product_categories_cmb2(),
			'inline'  => true, // Toggles display to inline
		) );
	}else
	{
		
	}

	
	
}//end of function

/******* END OF MENU PAGE TEMPLATE *******/
/******* START OF HOME PAGE MENU  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_menu_meta_box' );
function spice_home_menu_meta_box()
{	
	$prefix = 'spice_home_menu_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Menu Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );
	if ( class_exists( 'WooCommerce' ) ) 
	{		
		$cmb_menu->add_field( array(
			'name'    => esc_html__( 'Category To Display ', 'SPICE' ),
			'desc'    => esc_html__( 'in menu page categories', 'SPICE' ),
			'id'      => $prefix . 'product_cetegories',
			'type'    => 'multicheck',			
			'options' => spice_woocommerce_product_categories_cmb2(),
			'inline'  => false, // Toggles display to inline
		) );
	}

	
	
}//end of function

/******* END OF HOME PAGE MENU TEMPLATE *******/

/******* START OF HOME PAGE LIST MENU  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_list_menu_meta_box' );
function spice_home_list_menu_meta_box()
{	
	$prefix = 'spice_home_list_menu_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'List Menu Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );
	if ( class_exists( 'WooCommerce' ) ) 
	{		
		$cmb_menu->add_field( array(
			'name'    => esc_html__( 'Category To Display ', 'SPICE' ),
			'desc'    => esc_html__( 'in menu page categories', 'SPICE' ),
			'id'      => $prefix . 'product_cetegories',
			'type'    => 'multicheck',			
			'options' => spice_woocommerce_product_categories_cmb2(),
			'inline'  => false, // Toggles display to inline
		) );
		$cmb_menu->add_field( array(
		'name'    => esc_html__( 'No.of Items To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'No.of items per category ', 'SPICE' ),
		'id'      => $prefix . 'item',
		'type' => 'text_medium',
		'default'=>2
		
	) );
		$cmb_menu->add_field( array(
		'name' => esc_html__( 'Featured Text', 'SPICE' ),		
		'id'   => $prefix . 'featured_text',
		'desc'    => esc_html__( 'Appear with featured Image only ', 'SPICE' ),
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, 'media_buttons' => false),		
	) );
	}

	
	
}//end of function

/******* END OF HOME PAGE LIST MENU TEMPLATE *******/

/******* START OF HOME PAGE EVENT  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_event_meta_box' );
function spice_home_event_meta_box()
{	
	$prefix = 'spice_home_event_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Events Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );	
	$cmb_menu->add_field( array(
		'name'    => esc_html__( 'No.of Events To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'No.of events in home page ', 'SPICE' ),
		'id'      => $prefix . 'no',
		'type' => 'text_medium',
		'default'=>4
		
	) );

	
	
}//end of function

/******* END OF HOME PAGE MENU TEMPLATE *******/


/******* START OF HOME PAGE EVENT STYLE2  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_event_style2_meta_box' );
function spice_home_event_style2_meta_box()
{	
	$prefix = 'spice_home_event_style2_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Events Style2 Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );	
	$cmb_menu->add_field( array(
		'name'    => esc_html__( 'No.of Events To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'No.of events in home page ', 'SPICE' ),
		'id'      => $prefix . 'no',
		'type' => 'text_medium',
		'default'=>2
		
	) );

	
	
}//end of function

/******* END OF HOME PAGE EVENT STYLE2 TEMPLATE *******/



/******* START OF HOME PAGE REVIEW  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_review_meta_box' );
function spice_home_review_meta_box()
{	
	$prefix = 'spice_home_review_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Review Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );	
	$cmb_menu->add_field( array(
		'name'    => esc_html__( 'No.of Reviews To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'No.of reviews in home page ', 'SPICE' ),
		'id'      => $prefix . 'no',
		'type' => 'text_medium',
		'default'=>3		
	) );

	
	
}//end of function

/******* END OF HOME PAGE REVIEW STYLE 2 TEMPLATE *******/

/******* START OF HOME PAGE REVIEW  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_review_style2_meta_box' );
function spice_home_review_style2_meta_box()
{	
	$prefix = 'spice_home_review_style2_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Product Review Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );	
	$cmb_menu->add_field( array(
		'name'    => esc_html__( 'No.of Reviews To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'No.of reviews in home page ', 'SPICE' ),
		'id'      => $prefix . 'no',
		'type' => 'text_medium',
		'default'=>4		
	) );

	
	
}//end of function

/******* END OF HOME PAGE REVIEW STYLE 2  TEMPLATE *******/

/******* START OF HOME PAGE FEATURED  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_featured_meta_box' );
function spice_home_featured_meta_box()
{	
	$prefix = 'spice_home_featured_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Featured Product Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );		
	
}//end of function
/******* START OF HOME PAGE FEATURED  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_cta_section_meta_box' );
function spice_cta_section_meta_box()
{	
	$prefix = 'spice_cta_section_';
	$cmb_cta = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Call to Action Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Show Order Call to Action', 'SPICE' ),
		'desc' => esc_html__( 'check if oder call to action is to show', 'SPICE' ),
		'id'   => $prefix . 'order_cta',
		'type' => 'checkbox',
	) );

	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Order CTA Title', 'SPICE' ),
		'desc' => esc_html__( 'enter title for cta', 'SPICE' ),
		'id'   => $prefix . 'title',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, 'media_buttons' => false),
		'before_row'   => '<div id="home-featured-order-cta-holder" class="home-featured-order-cta">', 
		
	) );

	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Order CTA Content', 'SPICE' ),
		'desc' => esc_html__( 'enter content for cta', 'SPICE' ),
		'id'   => $prefix . 'content',
		'type'    => 'wysiwyg',	
		'options' => array( 'textarea_rows' => 5, 'media_buttons' => false),		
		
	) );
	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Order Button Text', 'SPICE' ),
		'desc' => esc_html__( 'enter the text for button', 'SPICE' ),
		'id'   => $prefix . 'button',
		'type' => 'text_medium',
		
		// 'repeatable' => true,
	) );	
	$cmb_cta->add_field( array(
		'name' => esc_html__( 'Order Button URL', 'SPICE' ),
		'desc' => esc_html__( 'enter the URL for button', 'SPICE' ),
		'id'   => $prefix . 'url',
		'type' => 'text_medium',
		'after_row'    => '</div>',		
	) );		
	
}//end of function

/******* END OF HOME PAGE FEATURED TEMPLATE *******/


/******* START OF HOME PAGE FEATURED STYLE2  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_featured_style2_meta_box' );
function spice_home_featured_style2_meta_box()
{	
	$prefix = 'spice_home_featured_style2_';
	$cmb_menu = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Featured Product Style2 Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_menu->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );	
	$cmb_menu->add_field( array(
		'name'    => esc_html__( 'Chef To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'chefs to show in home page', 'SPICE' ),
		'id'      => $prefix . 'chef',
		'type'    => 'radio',
		//'multiple' => true, // Store values in individual rows
		'options' => spice_post_type_cmb2('chef'),
		'inline'  => false, // Toggles display to inline
	) );	
	
	
}//end of function

/******* END OF HOME PAGE FEATURED STYLE2 TEMPLATE *******/




/******* START OF HOME PAGE CHEF  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_chefs_meta_box' );
function spice_home_chefs_meta_box()
{	
	$prefix = 'spice_home_chefs_';
	$cmb_chefs = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Chefs Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_chefs->add_field( array(
		'name' => esc_html__( 'Chef Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'icon',
		'type' => 'file',
	) );	
	$cmb_chefs->add_field( array(
		'name'    => esc_html__( 'Chef To Display ', 'SPICE' ),
		'desc'    => esc_html__( 'chefs to show in home page', 'SPICE' ),
		'id'      => $prefix . 'to_display',
		'type'    => 'multicheck',
		//'multiple' => true, // Store values in individual rows
		'options' => spice_post_type_cmb2('chef'),
		'inline'  => false, // Toggles display to inline
	) );	
	
}//end of function

/******* END OF HOME PAGE FEATURED TEMPLATE *******/

/******* START OF HOME PAGE CONTACT  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_contact_meta_box' );
function spice_home_contact_meta_box()
{	
	$prefix = 'spice_home_contact_';
	$cmb_contact = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Home Page Contact Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );
	$cmb_contact->add_field( array(
		'name' => esc_html__( 'Contact Form ', 'SPICE' ),
		'desc' => esc_html__( 'shortcode for contact form', 'SPICE' ),
		'id'   => $prefix . 'form_shortcode',
		'type' => 'text_medium',		
	) );		
	
	
}//end of function

/******* END OF HOME PAGE CONTACT TEMPLATE *******/

/******* START OF HOME PAGE BOOK TABLE  TEMPLATE *******/
add_filter( 'cmb2_init', 'spice_home_booking_meta_box' );
function spice_home_booking_meta_box()
{	
	$prefix = 'spice_home_booking_';
	$cmb_book = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Home Page Book Table Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_book->add_field( array(
		'name' => esc_html__( 'Home Page Icon', 'SPICE' ),
		'desc' => esc_html__( 'Upload an Icon image, 60x60 or greater to get the proper result', 'SPICE' ),
		'id'   => $prefix . 'page_icon',
		'type' => 'file',
	) );


	$group_field_id = $cmb_book->add_field( array(
		'id'          => $prefix . 'dining_space',
		'type'        => 'group',
		'description' => esc_html__( 'Add Dining Spaces', 'SPICE' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Dining Space {#}', 'SPICE' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Entry', 'SPICE' ),
			'remove_button' => esc_html__( 'Remove Entry', 'SPICE' ),
			'sortable'      => true, // beta
		),
	) );
	
	$cmb_book->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Add Caption', 'SPICE' ),
		'id'         => $prefix . 'caption',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_book->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Maximum Allowed', 'SPICE' ),
		'id'         => $prefix . 'max_number',
		'type'       => 'text',
		'desc' => esc_html__( 'Max number of heads allowed, Set -1 to take input from users', 'SPICE' ),
		
	) );	

	$cmb_book->add_group_field( $group_field_id, array(
		'name' => esc_html__( 'Entry Image', 'SPICE' ),
		'id'   => $prefix.'dining_icon',
		'type' => 'file',
	) );

	
	
}//end of function
/******* END OF HOME PAGE BOOK TABLE  TEMPLATE *******/

/******* START OF FAV DISH PAGE  *******/
add_filter( 'cmb2_init', 'spice_fav_dish_meta_box' );
function spice_fav_dish_meta_box()
{	
	$prefix = 'spice_fav_dish_';
	$cmb_fav = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Favourite Dish Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_fav->add_field(array(
			'name'             => esc_html__( 'Select Chef', 'SPICE' ),			
			'id'               => $prefix . 'chef',
			'type'             => 'select',			
			'options'          => spice_post_type_cmb2('chef'),
		) );
	$cmb_fav->add_field(array(
			'name'             => esc_html__( 'Select Recipe', 'SPICE' ),			
			'id'               => $prefix . 'recipe',
			'type'             => 'select',			
			'options'          => spice_post_type_cmb2('product'),
		) );

	$cmb_fav->add_field( array(
		'name' => esc_html__( 'Show Review Section', 'SPICE' ),
		'desc' => esc_html__( 'check if you want to shoow review section', 'SPICE' ),
		'id'   => $prefix . 'review',
		'type' => 'checkbox',		
	) );	

	$cmb_fav->add_field(  array(
		'name'       => esc_html__( 'Review Section Heading', 'SPICE' ),
		'id'         => $prefix . 'review_heading',
		'type'       => 'text',	
		
	) );
	
	
}//end of function


/******* END OF FAV DISH TEMPLATE *******/
/******* START OF ABOUT US PAGE  *******/
add_filter( 'cmb2_init', 'spice_about_meta_box' );
function spice_about_meta_box()
{	
	$prefix = 'spice_about_';
	$cmb_about = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'About Us Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type
	
	) );	
	$cmb_about->add_field(  array(
		'name'       => esc_html__( 'Content Title', 'SPICE' ),
		'id'         => $prefix . 'content_title',
		'type'       => 'text',
		'desc' => esc_html__( 'About us content title', 'SPICE' ),
		
	) );
	$cmb_about->add_field( array(
		'name'       => esc_html__( 'Content Sub Title', 'SPICE' ),
		'id'         => $prefix . 'content_subtitle',
		'type'       => 'text',
		'desc' => esc_html__( 'About us content sub-title', 'SPICE' ),
		
	) );	
	$cmb_about->add_field( array(
		'name'             => esc_html__( 'Show Logo with title', 'SPICE' ),		
		'id'               => $prefix . 'title_logo',
		'type'             => 'select',		
		'options'          => array(
			'0' => esc_html__( 'No', 'SPICE' ),
			'1' => esc_html__( 'Yes', 'SPICE' ),			
		),
	) );
	$cmb_about->add_field(  array(
		'name' => esc_html__( 'Title Image', 'SPICE' ),
		'id'   => $prefix.'title_image',
		'type' => 'file',
	) );

	
	
}//end of function


/******* END OF ABOUT US TEMPLATE *******/

/******* START OF EVENT  PAGE  *******/
add_filter( 'cmb2_init', 'spice_event_page_meta_box' );
function spice_event_page_meta_box()
{	
	$prefix = 'spice_event_page_';
	$cmb_event = new_cmb2_box( array(
		'id'            => $prefix.'metabox',
		'title'         => esc_html__( 'Event Page Settings', 'SPICE' ),
		'object_types'  => array( 'page' ), // Post type	
	) );
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Upcoming Event Title', 'SPICE' ),		
		'id'   => $prefix . 'upcoming_title',
		'type'    => 'text',		
	) );	
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Upcoming Event Text', 'SPICE' ),		
		'id'   => $prefix . 'upcoming_text',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, 'media_buttons' => false),		
	) );
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Join Event Title', 'SPICE' ),		
		'id'   => $prefix . 'join_title',
		'type'    => 'text',		
	) );	
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Join Event Text', 'SPICE' ),		
		'id'   => $prefix . 'join_text',
		'type'    => 'wysiwyg',
		'options' => array( 'textarea_rows' => 5, 'media_buttons' => false),		
	) );
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Join Event Form Shortcode', 'SPICE' ),		
		'id'   => $prefix . 'join_form',
		'type'    => 'text',		
	) );	
	
	
}//end of function


/******* END OF EVENT PAGE TEMPLATE *******/