<?php
	    if(empty($is_home_page))
		{
			get_header();
		}
		$classes=get_body_class();		
	    $content_flag=0;
	    if (in_array('woocommerce-wishlist',$classes)) 
	    {
	        $content_flag=1;
	    }    
		if(empty($is_home_page))
		{					
			if ( class_exists( 'WooCommerce' ) ) 
            {
				if(!is_cart() && !is_checkout() && !is_account_page() && $content_flag!=1)
				{
					get_template_part('includes/partials/content','single');
				}							
				else
				{
					get_template_part('includes/partials/content','loop');
				}
			}
			else
			{
				get_template_part('includes/partials/content','loop');
			}
		}
		else
		{
        	require_once get_template_directory().'/page_templates/page-default.php';    	
		}
		
		if(empty($is_home_page))
		{
			get_footer();
		}
?>