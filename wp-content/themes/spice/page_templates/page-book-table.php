<?php
		/*
		Template Name: Book Table
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);			
		$home_page_icon=get_post_meta($post_id,'spice_home_booking_page_icon',true);
		$home_booking_dining_space=get_post_meta($post_id,'spice_home_booking_dining_space',true);
		$home_booking_occasions=spice_get_option('opt-occasions');
		
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
<div class="wrapper page-wrapper-<?php echo get_the_ID(); ?>">
	<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay" <?php echo esc_attr($data_steller); ?>></div>					
		
				<section class="book-table">
					<div class="container">
						<img src="<?php printf('%s',esc_url($home_page_icon)); ?>" alt="">
						<h2 class="page-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h2>
						<?php echo spice_PageSubTitle(get_the_ID()); ?>
						<?php
								if(!empty($home_booking_dining_space))
								{
						?>
									<div class="book-form clearfix">
										<figure>
											<?php
													the_post_thumbnail(array(380,620));
											?>
										</figure>
										
										<form id="book-table-<?php printf('%s',esc_attr($post_id)); ?>">	
												
												<div class="dining-space clearfix">
			
													<h5><?php  esc_html_e('Select your dining space','SPICE'); ?></h5>												
													
													<?php
															if(count($home_booking_dining_space)>0)
															{
																foreach($home_booking_dining_space as $k=>$dining_space)
																{
																	$img_flag=0;
													?>
																	<div class="dining-space-types fixed-type">
																		<div class="type-wrapper clearfix">
																			<input type="checkbox" checked="checked" name="booking-check-<?php printf('%d',esc_attr($k)); ?>" value="<?php printf('%d',intval($dining_space['spice_home_booking_max_number'])); ?>">
																			<i class="fa fa-check-square"></i>
																			<?php
																					if(array_key_exists('spice_home_booking_dining_icon',$dining_space) && !empty($dining_space['spice_home_booking_dining_icon']))
																					{
																						$img_flag=1;
																			?>
																						<figure>
																							<img class="" src="<?php printf('%s',esc_url($dining_space['spice_home_booking_dining_icon'])); ?>" alt="">																	
																						</figure>
																			<?php
																					}//if icon added
																			?>
																			

																			<?php

																				if($img_flag==1)
																				{
																					$dining_str=explode(' ',$dining_space['spice_home_booking_caption']);

																					if(!empty($dining_str))
																					{
																			?>
																						<div class="dining-desc">

																							<?php 
																									if($dining_str[0]!='')
																									{
																							?>																						
																							<h4><?php printf('%s',esc_html($dining_str[0])); ?></h4>
																							<?php
																									}
																									if(count($dining_str)>1)
																									{
																							?>
																							<h5><?php printf('%s',esc_html($dining_str[1])); ?></h5>
																							<?php
																									}
																							?>
																						</div>
																			<?php
																					}
																				}
																				else
																				{
																			?>
																			<div class="banquet-type">
																					<h5><?php printf('%s',esc_html($dining_space['spice_home_booking_caption'])); ?></h5>
																			</div>
																			<?php		
																				}
																			?>
																			
																		</div>
																	</div>		
													<?php
																}//foreach end
															}
													?>
													

													<!-- ========================================= -->
												</div> <!-- DINING SPACE ends -->

												<div class="category clearfix">
													<div class="choice">
														<h5><?php  esc_html_e('Custom dining space','SPICE'); ?></h5>
														<input class="personNo" type="text" id="personNo_<?php printf('%s',esc_attr($post_id)); ?>" name="personNo_<?php printf('%s',esc_attr($post_id)); ?>" value="2" placeholder="<?php esc_html_e('Enter your choice','SPICE'); ?>" readonly>
													</div>
													<?php
															if(!empty($home_booking_occasions))
															{	
													?>
													<div class="occasion">
														<h5>Occasion</h5>
														<select id="occasionType_<?php printf('%s',esc_attr($post_id)); ?>" name="occasionType_<?php printf('%s',esc_attr($post_id)); ?>">
														<?php
															foreach($home_booking_occasions as $k=>$occasion)
															{
														?>
															  <option value="<?php printf('%s',esc_html($k)); ?>"><?php printf('%s',esc_html(ucwords($occasion))); ?></option>
															 
														<?php
															}
														?>
														</select>
													</div>
													<?php
															}
													?>			
													<div class="reservation input-wrapper">
														<h5><?php  esc_html_e('Occasion Time','SPICE'); ?></h5>
														<input type="text" placeholder="<?php esc_html_e('Date & Time','SPICE'); ?>" id="occasion_date_time_<?php printf('%s',esc_attr($post_id)); ?>" class="icons occasion_date_time" name="occasion_date_time_<?php printf('%s',esc_attr($post_id)); ?>">
													</div>											
												</div> <!-- CATEGORY ends -->

												<div class="cust-details clearfix">
													<div class="name">
														<h5><?php  esc_html_e('Enter your name','SPICE'); ?></h5>
														<input type="text" placeholder="<?php esc_html_e('Name','SPICE'); ?>" id="customer_name_<?php printf('%s',esc_attr($post_id)); ?>" name="customer_name_<?php printf('%s',esc_attr($post_id)); ?>">
													</div>

													<div class="number">
														<h5><?php  esc_html_e('Phone number','SPICE'); ?></h5>
														<input type="text" placeholder="<?php esc_html_e('Phone','SPICE'); ?>"  id="customer_phone_<?php printf('%s',esc_attr($post_id)); ?>" name="customer_phone_<?php printf('%s',esc_attr($post_id)); ?>">
													</div>

													<div class="email">
														<h5><?php  esc_html_e('Email id','SPICE'); ?></h5>
														<input type="text" placeholder="<?php esc_html_e('Email','SPICE'); ?>"  id="customer_email_<?php printf('%s',esc_attr($post_id)); ?>" name="customer_email_<?php printf('%s',esc_attr($post_id)); ?>">
													</div>
												</div> <!-- CUST DETAILS ENDS -->
												<div class="cust-details clearfix">																								
													
												</div> <!-- CUST DETAILS ENDS -->

												<div class="submit-btn-area clearfix">
												<div class="book_spinner_wrapper">
													<div class="spinner">
													  <div class="rect1"></div>
													  <div class="rect2"></div>
													  <div class="rect3"></div>
													  <div class="rect4"></div>
													  <div class="rect5"></div>
													</div>						
												</div>
													<button id="book_home_table-<?php printf('%s',esc_attr($post_id)); ?>" type="button" class="button red-btn"><?php  esc_html_e('book now','SPICE'); ?></button>													
												</div>	
												
										</form>
									</div>
						<?php
								}
								else
								{

								}
						?>
					</div> <!-- CONTAINER ends -->
				</section>
		

</div>

<?php
		endwhile;endif;
		if(empty($is_home_page))
		{
			get_footer();
		}
?>