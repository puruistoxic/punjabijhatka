<?php
		/*
		Template Name: Favourite Dish
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);		


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
	    
	    $fav_dish_chef_id=get_post_meta($post_id,'spice_fav_dish_chef',true);
	    $args = array(  'post_type' => 'chef','p'=>  $fav_dish_chef_id);	    
	    $post_query = new WP_Query( $args ); 

	    $chef_image=get_post_meta($fav_dish_chef_id,'spice_chef_image',true);

	    $chef_product_id=get_post_meta($post_id,'spice_fav_dish_recipe',true);	    
	    $product = new WC_PRODUCT( $chef_product_id );		
	    $chef_post=get_post($fav_dish_chef_id); 
	    $tag_count=0;


	    $fav_dish_review=get_post_meta($post_id,'spice_fav_dish_review',true);
	    $fav_dish_review_heading=get_post_meta($post_id,'spice_fav_dish_review_heading',true)==''?'Review':get_post_meta($post_id,'spice_fav_dish_review_heading',true);
 

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
		<div class="wrapper page-wrapper-<?php echo get_the_ID(); ?>">
			<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay" <?php echo esc_attr($data_steller); ?>></div>	
				<div class="fav-dish">
				<section class="main-content">
					<div class="container">						
						<article class="content-wrapper">
							<div class="clearfix">

								<div class="about-chef about-dish">
									<h2><?php printf(__('%s','SPICE'),esc_html($product->post->post_title)); ?></h2>
									<!-- <h3>names will go here</h3> -->
									<hr>
									<ul class="clearfix dish-type">
										<li><?php  esc_html_e('Italian recipe','SPICE'); ?></li>
										<li><?php printf(__('%s','SPICE'),$product->get_tags( ', ', '<span class="green"></span> ', '' )); ?></li>


										<li><?php printf(__('%s','SPICE'),$product->get_categories( ', ', '<span class="brown"></span>', '' )); ?></li>
										<?php if($product->get_attribute( 'state' )){ ?>
											<li><span class="red"></span><?php printf(__('%s','SPICE'),esc_html($product->get_attribute( 'state' )));?></li>
										<?php } ?>
									</ul>
									<?php printf(__('%s','SPICE'),$product->post->post_content);	?>
								</div>

								
								<div class="chef-details">
									<div class="imgLiquidFill imgLiquid dish-img" >
										<?php printf(__('%s','SPICE'),$product->get_image()); ?>	
									</div>
									
									<div class="imgLiquidFill imgLiquid chef-img" >
										<img src="<?php printf(__('%s','SPICE'),esc_url($chef_image)); ?>" alt="">
									</div>

									<?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
									<h5><?php the_title(); ?></h5>
									<p><?php printf('%s',spice_get_the_excerpt(30)); ?></p>
									<?php endwhile;endif; ?>
									<a href="<?php echo esc_url(get_the_permalink($fav_dish_chef_id)); ?>"><?php esc_html_e('Know more about the chef','SPICE'); ?></a>
								</div>
								
								
							</div>
						</article>
					<?php

						if($fav_dish_review=='on')
						{
					?>
						<article class="content-wrapper">
							<h3 class="review_heading"><?php printf(__('%1$s','SPICE'),esc_html($fav_dish_review_heading)); ?></h3>
							<div class="review">								
								<div class="reviews-container clearfix">
								<?php
										$args = array('post_type' => 'review','posts_per_page'=>6,'post_status'=>'publish','orderby'=> 'post_date','order' => 'DESC');
										$review_query = new WP_Query( $args );
										while($review_query->have_posts()) : $review_query->the_post();
										$post_id=get_the_ID();
										$reviewer_image=get_post_meta($post_id,'spice_reviewer_image',true);		
										$reviewer_profession=get_post_meta($post_id,'spice_reviewer_profession',true);
										$reviewer_short_addr=get_post_meta($post_id,'spice_reviewer_short_addr',true);
										$review['food_test']=get_post_meta($post_id,'spice_reviewer_food_test',true);							
										$review['food_quality']=get_post_meta($post_id,'spice_reviewer_food_quality',true);							
										$review['food_service']=get_post_meta($post_id,'spice_reviewer_food_service',true);							
										$review['food_price']=get_post_meta($post_id,'spice_reviewer_food_price',true);												
										$reviewer_val=round(array_sum($review)/count($review));	
													
								?>									
									<div id="post-<?php echo get_the_ID(); ?>" <?php post_class('review-comments-wrapper'); ?>>
										<div class="review-comments clearfix">
											<div class="figure imgLiquidFill imgLiquid" >
												<?php
													if(!empty($reviewer_image))
													{
												?>
														<img src="<?php printf("%s",esc_attr($reviewer_image)); ?>" alt="">
												<?php
													}
												?>
											</div>
											<div class="clearfix review-rating">
												<div class="cust-review">
													<div>
														<h6><?php the_title(); ?>,</h6>
														<h6><?php printf(__('%1$s','SPICE'),esc_html($reviewer_profession)); ?>, <?php printf("%s",esc_html($reviewer_short_addr)); ?></h6>
													</div>
													<p><?php the_content(); ?></p>
												</div>
												<div class="cust-rating">
													<?php 
														for($rv_count=1;$rv_count<=5;$rv_count++)
														{
															$rv_class='grey';
															if($rv_count<=$reviewer_val)
															{
																$rv_class='red';
															}
													?>
															<i class="fa fa-star <?php printf("%s",esc_attr($rv_class)); ?>"></i>
													<?php
														}
													?>
												</div>
												
											</div>
										</div>
									</div>
								<?php
										endwhile;
								?>
								</div>
							</div>
						</article>
					<?php
						}
					?>

					</div> <!-- CONTAINER ends -->
				</section> <!-- MAIN CONTENT ends -->

</div>

<?php
		endwhile;endif;
		if(empty($is_home_page))
		{
			get_footer();
		}
?>