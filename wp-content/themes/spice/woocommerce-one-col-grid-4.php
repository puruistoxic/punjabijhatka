<div class="row shop-layout-one-col">
	          <section class="shop-left col-md-12 product-grid-4">			  		  
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
	 