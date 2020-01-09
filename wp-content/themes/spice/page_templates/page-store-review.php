<?php
		/*
		Template Name: Store Review
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);
		$no_of_reviews=get_post_meta($post_id,'spice_home_review_no',true);
		$home_page_icon=get_post_meta($post_id,'spice_home_review_page_icon',true);

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
				<section class="user-reviews">
					<div class="container">
						<img src="<?php printf('%s',esc_html($home_page_icon)); ?>" alt="">
						<h2 class='page-title-<?php echo get_the_ID(); ?>'><?php the_title(); ?></h2>
						<h4 class='page-sub-title-<?php echo get_the_ID(); ?>'><?php printf('%s',esc_html($page_sub_title)); ?></h4>
						<!-- ============= REVIEWS ================== -->
						<?php

								$args = array(  'post_type' => 'review', 
                                'orderby' => 'date', 
                                'order'   => 'DESC',
                                'posts_per_page'=>($no_of_reviews==0?3:$no_of_reviews)
                                );
                        
                        		$review_posts = new WP_Query( $args );    
                                while ( $review_posts->have_posts() ) : $review_posts->the_post(); 
                                 	$reviewer_id=get_the_ID();
                                 	$meta_data=get_post_meta($reviewer_id); 
                                 	unset($food_test);
                                 	unset($food_quality);
                                 	unset($food_service);
                                 	unset($food_price);
                                 	
                                 	if(isset($meta_data['spice_reviewer_food_test']))
                                 	{
                                 		$food_test=$meta_data['spice_reviewer_food_test'][0];
                                 	}
                                 	if(isset($meta_data['spice_reviewer_food_quality']))
                                 	{
                                 		$food_quality=$meta_data['spice_reviewer_food_quality'][0];
                                 	}
                                 	if(isset($meta_data['spice_reviewer_food_service']))
                                 	{
                                 		$food_service=$meta_data['spice_reviewer_food_service'][0];
                                 	}
                                 	if(isset($meta_data['spice_reviewer_food_service']))
                                 	{
                                 		$food_price=$meta_data['spice_reviewer_food_price'][0];                      	
                                 	}                                	

                        ?>
									<article class="review clearfix">
										<figure class="imgLiquid imgLiquidFill">											
											<img src="<?php printf('%s',esc_html($meta_data['spice_reviewer_image'][0])); ?>" alt="">
										</figure>
										<div class="figcaption">
											<h5><?php the_title(); ?></h5>											
											<h6><?php printf('%s, %s',esc_html(get_post_meta(get_the_ID(),'spice_reviewer_profession',true)),esc_html(get_post_meta(get_the_ID(),'spice_reviewer_short_addr',true))); ?></h6>											
											<?php the_content(); ?>
											<div class="user-rating clearfix">
												<ul class="attributes">
												<?php
													if(isset($food_test))
													{
												?>
													<li><?php esc_html_e('Food Test','SPICE'); ?></li>
												<?php
													}
													if(isset($food_quality))
													{
												?>
													<li><?php esc_html_e('Food Quality','SPICE'); ?></li>
												<?php
													}
													if(isset($food_service))
													{
												?>
													<li><?php esc_html_e('Service','SPICE'); ?></li>
												<?php
													}
													if(isset($food_price))
													{
												?>
													<li><?php esc_html_e('Price','SPICE'); ?></li>
												<?php
													}
												?>
												</ul>
												
												<ul class="ratings">
													<li>
													<?php
														if(!empty($food_test))
														{
															for($i=0;$i<5;$i++)
															{
																$class="grey";
																if($i<$food_test)
																{
																	$class="red";
																}
													?>
																<i class="fa fa-star <?php printf('%s',esc_attr($class)); ?>"></i>														
													<?php
															}
														}
													?>
													</li>
													<li>
														<?php
														if(!empty($food_quality))
														{
															for($i=0;$i<5;$i++)
															{
																$class="grey";
																if($i<$food_quality)
																{
																	$class="red";
																}
													?>
																<i class="fa fa-star <?php printf('%s',esc_attr($class)); ?>"></i>														
													<?php
															}
														}
													?>
													</li>
													<li>
														<?php
														if(!empty($food_service))
														{
															for($i=0;$i<5;$i++)
															{
																$class="grey";
																if($i<$food_service)
																{
																	$class="red";
																}
													?>
																<i class="fa fa-star <?php printf('%s',esc_attr($class)); ?>"></i>														
													<?php
															}
														}
													?>
													</li>
													<li>
														<?php
														if(!empty($food_price))
														{
															for($i=0;$i<5;$i++)
															{
																$class="grey";
																if($i<$food_price)
																{
																	$class="red";
																}
													?>
																<i class="fa fa-star <?php printf('%s',esc_attr($class)); ?>"></i>														
													<?php
															}
														}
													?>
													</li>
													
												</ul>
											</div>
										</div>
									</article>
						<?php
								endwhile;							
						?>
						<!-- ============================================ -->
					</div>
				</section>
		</div>
<?php
		endwhile;endif;
		if(empty($is_home_page))
		{
			get_footer();
		}
?>