<?php
		/*
		Template Name: Products Gallery
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$product_page_categories=get_post_meta($post_id,'spice_product_page_cetegories',true);			
		$pagequery =new WP_Query('page_id='.$post_id);		

		/*****  PARALLAX SETTINGS ******/
		$parallax_settings=get_post_meta( $post_id, 'spice_page_bg_style', true )=='3'?1:0;
		$data_steller='';
		if($parallax_settings==1)
		{
		 	$bg_ratio=intval(get_post_meta($post_id, 'spice_page_bg_ratio', true ))/100 ;
		 	$parallax_vertical_offset=get_post_meta( $post_id, 'spice_page_bg_vertical_ratio', true )  !='' ? (esc_attr( get_post_meta( $post_id, 'spice_page_bg_vertical_ratio', true ) )) : "500";				
		 	$bg_vertical_offset=intval($parallax_vertical_offset);		
		 	$data_steller='data-stellar-background-ratio='.$bg_ratio.' data-stellar-vertical-offset='.$bg_vertical_offset;	
		}	


		/*******************************/

	    if ( $pagequery->have_posts() ) : while ( $pagequery->have_posts() ) : $pagequery->the_post();			  


				$order_cta=get_post_meta($post_id,'spice_cta_section_order_cta',true);
				$order_cta_title=get_post_meta($post_id,'spice_cta_section_title',true);
				$order_cta_content=get_post_meta($post_id,'spice_cta_section_content',true);
				$order_cta_button=get_post_meta($post_id,'spice_cta_section_button',true);
				$order_cta_url=get_post_meta($post_id,'spice_cta_section_url',true);
				if(!empty($order_cta))
				{
		?>
			<!-- ============ PLACE ORDER ============= -->	                   
             <div class="spice-cta">
	            <div class="place-order clearfix">
	                <div class="desc">
	                    <?php printf('%s',$order_cta_title); ?>
	                </div>                          
	                <?php printf('%s',$order_cta_content); ?>                 
	                <div class="order">
	                    <a class="button white-btn scale-btn" href="<?php printf('%s',esc_url($order_cta_url)); ?>"><?php printf('%s',esc_html($order_cta_button)); ?></a>
	                </div>
	            </div>    
	        </div>
        <?php
        	}
        ?>
			<div class="wrapper page-wrapper-<?php echo get_the_ID(); ?>" >
			<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay" <?php echo esc_attr($data_steller); ?>></div>		
				<div class="food-gallery">
						<section class="main-content">
							<div class="container">
								<?php printf('%s',spice_woocommerce_product_categories($product_page_categories)); ?>	
								<article class="content-wrapper clearfix food-items" id="food-items">													
									<?php   										
    										$args = array( 	'post_type' => 'product', 
    														'orderby' => 'date', 
    														'order'   => 'DESC', 
    														'posts_per_page'=>-1,
    													   	'tax_query'=> array(
    													   							array(
    													   								'taxonomy'=>'product_cat',
    													   								'field'=> 'id',
    													   								'terms'=>$product_page_categories
    													   							)
    													   						) 
    													);
    										
    										$loop = new WP_Query( $args );    	

    										$currency=get_woocommerce_currency_symbol();
    										while ( $loop->have_posts() ) : $loop->the_post(); 
    											global $product; 
    											$taxonomy='product_cat';   											    											
    											$slugs_arr=wc_get_product_terms( get_the_ID(), $taxonomy , array( 'fields' => 'slugs' ) ); 
    											$slug=implode(' ', $slugs_arr);
    											$price = get_post_meta( get_the_ID(), '_regular_price');
    											$sale_price = get_post_meta( get_the_ID(), '_sale_price', true);
    											$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );    
    																				
    								?>
    											<div id="product-<?php the_Id(); ?>" class="food-item-wrapper <?php printf('%s',esc_attr($slug)); ?>">
													<div class="food-item">
														<a href="<?php the_permalink(); ?>">
														<div class="figure imgLiquidFill imgLiquid">
															<?php echo woocommerce_get_product_thumbnail(); ?>
														</div>
														</a>
														<div class="figcaption clearfix">
															<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
															<h2><span><?php printf(__('%s','SPICE'),esc_html($currency)) ?></span><?php printf(__('%s','SPICE'),esc_html($product->get_price())); ?></h2>
															<div class="food-name-type">
																<!-- <h3>Food name</h3> -->
																<div class="clearfix">
																	<?php printf(__('%s','SPICE'),$product->get_tags( ', ', '<h4><span class="green"></span>' . _n( '', '', $tag_count, 'SPICE' ) . ' ', '.</h4>' )); ?>
																	<?php if($product->get_attribute( 'state' )){ ?>
																	<h4><span class="red"></span><?php printf(__('%s','SPICE'),esc_html($product->get_attribute( 'state' )));?></h4>
																	<?php } ?>
																</div>
															</div>
															
														</div>

														<div class="heart-ribbon">
															<i class="fa fa-star"></i>															
															<h5><?php printf(__('%d','SPICE'),esc_html($product->get_rating_count())) ?></h5>
														</div>
													</div>
												</div>
    								<?php
    										endwhile; 
    										wp_reset_query(); 
    								?>
    								<div class="clearfix"></div>	
								</article>								
							</div> <!-- CONTAINER ends -->
						</section> <!-- MAIN CONTENT ends -->
				</div>
			</div>
<?php
		endwhile;endif;
		if(empty($is_home_page))
		{
			get_footer();
		}
?>