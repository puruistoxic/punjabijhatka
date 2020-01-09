<?php 
// Woo commerce one col without sidebar 
// product grid 3
get_header(); 
$grid_no=spice_get_option('opt-grid-number');			
$file_name="";
switch($grid_no)
{

	case 1: $file_name="woocommerce-one-col-grid-2";
			break;

	case 2 :
			$file_name="woocommerce-two-col-grid-3";
			break;

	case 3:	$file_name="woocommerce-one-col-grid-4";
			break;

}	

/*****  PARALLAX SETTINGS ******/
		$post_id=get_the_ID();
		$parallax_settings=get_post_meta( $post_id, 'spice_page_bg_style', true )=='3'?1:0;
		$data_steller='';
		if($parallax_settings==1)
		{
		 	$bg_ratio=intval(get_post_meta($post_id, 'spice_page_bg_ratio', true ))/100 ;
		 	$parallax_vertical_offset=get_post_meta( $post_id, 'spice_page_bg_vertical_ratio', true )  !='' ? (esc_attr( get_post_meta( $post_id, 'spice_page_bg_vertical_ratio', true ) )) : "500";				
		 	$bg_vertical_offset=intval($parallax_vertical_offset);		
		 	$data_steller='data-stellar-background-ratio='.$bg_ratio.' data-stellar-vertical-offset='.$bg_vertical_offset;	
		}			
?>
<div class="wrapper page-wrapper-<?php echo get_the_ID(); ?>">
   <div id="page-<?php echo get_option( 'woocommerce_shop_page_id' );  ?>" class="static-overlay" <?php echo esc_attr($data_steller); ?>></div>
   <div class="shop-page">     
      <section class="main-content">
        <div class="container">	         
	         	<?php          			
	         			if(is_shop() || is_product_category())         		
	         			{
	         	?>	
				    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>						
						<?php endif;  ?>
						<?php	} ?>
						<!-- Breadcrumb -->
						<div class="breadcrumb-with-price">
							<span class="cart-short-desc">
							<?php
                                if(spice_get_option('opt-cart-off')==0)
                                {
                            ?>
								<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart','SPICE' ); ?>">
									<?php echo sprintf(_n( '%d item', '%d items', WC()->cart->cart_contents_count ,'SPICE'), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
								</a>	
							<?php
								}
							?>						
							</span>
							<?php woocommerce_breadcrumb(); ?>
						</div>	
						<!-- // Breadcrumb -->
						<!-- Layout Section  -->
						<?php get_template_part($file_name); ?>
	 					<!-- // Layout Section  -->
	         
       	</div>
      </section>    
   </div>  
</div>
<!-- WRAPPER ends -->
<?php get_footer(); ?>