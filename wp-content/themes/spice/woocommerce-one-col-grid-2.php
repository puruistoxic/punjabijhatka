<?php
		$sidebar_flag=spice_get_option('opt-shop-layout');
		$col_class="col-md-9";
		$sidebar_class='';
		if($sidebar_flag==1)
		{
			$col_class="col-md-12";
		}
		else if($sidebar_flag==2)
		{
			 $sidebar_class='sidebar-2';
		}
?>
<div class="row shop-layout-one-col">
	            <section class="shop-left <?php printf(__('%s','SPICE'),esc_attr($col_class)) ?> <?php printf(__('%s','SPICE'),esc_attr($sidebar_class)); ?> product-grid-2">			  		  
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
	        	<?php 
					if($sidebar_flag!=1)
					{
						do_action( 'woocommerce_sidebar' );  
					}

				?>  
	        	
</div>