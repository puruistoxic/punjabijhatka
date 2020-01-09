<?php
		/*
		Template Name: Review
		*/		
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);		
	    if ( $pagequery->have_posts() ) : while ( $pagequery->have_posts() ) : $pagequery->the_post();	


	    $qargs = array('post_type' => 'review','post_status'=>'publish','fields'=>'ids');
		$reviews = new WP_Query( $qargs );			
		$review_ids=($reviews->posts);		
		$revw[1]=0;
		$revw[2]=0;
		$revw[3]=0;
		$revw[4]=0;
		$revw[5]=0;
		$cnt=0;
		foreach($review_ids as $rvw)
		{			
			$review['food_test']=get_post_meta($rvw,'spice_reviewer_food_test',true);							
			$review['food_quality']=get_post_meta($rvw,'spice_reviewer_food_quality',true);							
			$review['food_service']=get_post_meta($rvw,'spice_reviewer_food_service',true);							
			$review['food_price']=get_post_meta($rvw,'spice_reviewer_food_price',true);												
			$reviewer_val=round(array_sum($review)/count($review));	
			$revw[$reviewer_val]=$revw[$reviewer_val]+1;
			$cnt++;
		}

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
			<div class="testimonials-page">		


				<section class="main-content">					
					<div class="container">
						
						<article class="content-wrapper">
												
							<div class="clearfix">
								
								<div class="star-level-wrapper box-wrapper">
								<div class="star-level">
									<!-- <i class="fa fa-star red"></i><span>Star provided</span> -->
									
									<div class="star-rating-home five clearfix">
										<div class="star-number"><i class="fa fa-star red"></i><h4>5</h4></div>
										<div class="level-bar">
											<div class="level-bar-filled" data-level="<?php if($revw[5]>0){ $prcntg=(($revw[5]*100)/$cnt); printf('%d',$prcntg);  }else{ ?>0 <?php } ?>"></div>
										</div>
										<div class="level-percent">
											<h3 class="counter">0</h3><span>%</span>
										</div>
									</div>

									<div class="star-rating-home four clearfix">
										<div class="star-number"><i class="fa fa-star orange"></i><h4>4</h4></div>
										<div class="level-bar">
											<div class="level-bar-filled" data-level="<?php if($revw[4]>0){ $prcntg=(($revw[4]*100)/$cnt); printf('%d',$prcntg);  }else{ ?>0 <?php } ?>"></div>
										</div>
										<!-- <h3>47</h3> -->
										<div class="level-percent">
											<h3 class="counter">0</h3><span>%</span>
										</div>
									</div>

									<div class="star-rating-home three clearfix">
										<div class="star-number"><i class="fa fa-star yellow"></i><h4>3</h4></div>
										<div class="level-bar">
											<div class="level-bar-filled" data-level="<?php if($revw[3]>0){ $prcntg=(($revw[3]*100)/$cnt); printf('%d',$prcntg);  }else{ ?>0 <?php } ?>"></div>
										</div>
										<!-- <h3>73</h3> -->
										<div class="level-percent">
											<h3 class="counter">0</h3><span>%</span>
										</div>
									</div>

									<div class="star-rating-home two clearfix">
										<div class="star-number"><i class="fa fa-star green"></i><h4>2</h4></div>
										<div class="level-bar">
											<div class="level-bar-filled" data-level="<?php if($revw[2]>0){ $prcntg=(($revw[2]*100)/$cnt); printf('%d',$prcntg);  }else{ ?>0 <?php } ?>"></div>
										</div>
										<!-- <h3>69</h3> -->
										<div class="level-percent">
											<h3 class="counter">0</h3><span>%</span>
										</div>
									</div>

									<div class="star-rating-home two clearfix">
										<div class="star-number"><i class="fa fa-star green"></i><h4>1</h4></div>
										<div class="level-bar">
											<div class="level-bar-filled" data-level="<?php if($revw[1]>0){ $prcntg=(($revw[1]*100)/$cnt); printf('%d',$prcntg);  }else{ ?>0 <?php } ?>"></div>
										</div>
										<!-- <h3>69</h3> -->
										<div class="level-percent">
											<h3 class="counter"></h3><span>%</span>
										</div>
									</div>
								</div>
								</div>

								<div class="comment-box-wrapper box-wrapper">
								<div class="comment-box">
									<h2 class="counter">
									<?php 
										$comments_count = wp_count_comments();										
										printf( __('%1$s', 'SPICE' ), $comments_count->approved);
										
									?>
									</h2>
									<h3><i class="fa fa-comment"></i>comments</h3>
								</div>
								</div>
								
								<div class="facebook-box-wrapper box-wrapper">
								<div class="facebook-like-box">
									<h2 class="counter"><?php printf('%d',spice_facebook_likes()); ?></h2>
									<h3><i class="fa fa-facebook"></i>facebook likes</h3>
								</div>
								</div>
							</div>
						</article>

						<article class="content-wrapper">
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