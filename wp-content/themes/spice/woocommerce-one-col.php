<?php 
// Woo commerce one col without sidebar 
// product grid 3
get_header(); ?>
<div class="wrapper">
   <div class="shop-page">     
      <section class="main-content">
        <div class="container">	         
	         	<?php          			
	         			if(is_shop() || is_product_category())         		
	         			{
	         	?>	
				    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
						<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
						<?php endif;  ?>
						<?php	} ?>
						<!-- Breadcrumb -->
						<div class="breadcrumb-with-price">
							<span class="cart-short-desc">
							<?php
                                if(spice_get_option('opt-cart-off')==0)
                                {
                            ?>
									<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart' ,'SPICE'); ?>">
										<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ,'SPICE'), WC()->cart->cart_contents_count ); ?> - <?php echo WC()->cart->get_cart_total(); ?>
									</a>
							<?php
								}
							?>							
							</span>
							<?php woocommerce_breadcrumb(); ?>
						</div>	
						<!-- // Breadcrumb -->
						<!-- Layout Section  -->
						<div class="row shop-layout-one-col">
			            <section class="shop-left col-md-12 product-grid-3">			  		  
								  	<?php
								  	if (is_singular('product'))
								  		{
								  		woocommerce_content();
								  		}
								  	  else
								  		{
								  		if (is_product_category())
								  			{
								  			woocommerce_get_template('taxonomy-product_cat.php');
								  			}
								  		  else
								  		if (is_product_tag())
								  			{
								  			woocommerce_get_template('taxonomy-product_tag.php');
								  			}
								  		  else
								  			{
								  			woocommerce_get_template('archive-product.php');
								  			}
								  		}
								  	?>				                     
			        	</section> <!-- POST SECTION ends -->   
	        	
	        	</div>
	 					<!-- // Layout Section  -->
	         
       	</div>
      </section>    
   </div>  
</div>
<!-- WRAPPER ends -->
<?php get_footer(); ?>