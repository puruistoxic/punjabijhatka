<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <?php               
                spice_get_favicon(); 
                wp_head(); 
        ?>
    </head>
    <body <?php body_class(); ?> >
    	<div class="inside-body-wrapper index-pg">

    	<!-- ============ HEADER ================== -->
    	<?php spice_header_block();	?>
	    <!-- ============ HEADER ================== -->
        <?php
            if(spice_get_option('opt-front-login-form')==1 && !spice_get_option('opt-front-login-form'))
            {
                if(!is_user_logged_in())
                {
        ?>
    	           <a href="javascript:void(0)" class="login-btn"><i class="fa  fa-user"></i><span><?php esc_html_e('Login','SPICE'); ?></span></a>	
        <?php
                } 
            }          
        ?>
        <?php
            if ( class_exists( 'WooCommerce' ) ) 
            {
                if(spice_get_option('opt-cart-side')==1 && !spice_get_option('opt-cart-off'))
                {
                    if(is_shop())
                    {                          
                        spice_cart_at_side();        
                    }
                }  
            }                   

        ?>        
    	<?php spice_BannerContent(); ?>
       
        

