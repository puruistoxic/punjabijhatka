<?php
		/*
		Template Name: Events
		*/
		if(empty($is_home_page))
		{
			get_header();
		}

		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);		
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true)==''?sprintf(esc_html__('Our Event Calendar','SPICE')):get_post_meta($post_id,'spice_page_subtitle',true);
		$event_page_upcoming_text=get_post_meta($post_id,'spice_event_page_upcoming_text',true);
		$event_page_upcoming_title=get_post_meta($post_id,'spice_event_page_upcoming_title',true);
		$event_page_join_text=get_post_meta($post_id,'spice_event_page_join_text',true);
		$event_page_join_title=get_post_meta($post_id,'spice_event_page_join_title',true);
		$event_page_join_form=get_post_meta($post_id,'spice_event_page_join_form',true)!=''?get_post_meta($post_id,'spice_event_page_join_form',true):'';											

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
				<div class="our-events">
					<section class="main-content">
						<div class="container">
							<article class="content-wrapper clearfix">
								<h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title));?></h4>
								<?php the_content(); ?>

								<div class="event-calendar calendar">
									<!-- <div class="container"> -->
										<div class="">										
											<div class="calender clearfix" id="custom-inner">
												<div class="calender-info">
													<div class="currentdate">
													<span id="custom-month" class="custom-month"></span>
													<span id="custom-year" class="custom-year"></span>
													<nav>
														<span id="prev-date" class="prev-date"><i class="fa fa-chevron-left"></i></span>
														<span id="next-date" class="next-date"><i class="fa fa-chevron-right"></i></span>
													<!-- <span id="current-date" class="current-date" title="Go to current date"></span> -->
													</nav>
												</div>
												<div class="todays-article" id="updateArticle">
													<span id="current-date" class="current-date" title="Go to current date"></span>
													<h1><?php esc_html_e('Today\'s Event','SPICE'); ?></h1>
													<div id="event_content">
													<div class="img-wrapper imgLiquidFill imgLiquid">
														<img id="event_image" src="<?php echo get_template_directory_uri(); ?>/images/calendar-event-img.png" alt="">

														<div class="bullet blue"></div>
													</div>												
													<h3 id="event_title"><?php esc_html_e('Chef\'s meet 2014','SPICE'); ?></h3>
													<a id="event_link" href="#" class="button grey-btn"><?php esc_html_e('know more','SPICE'); ?></a>
													</div>
												</div>
												</div>
												<div class="calender-markup">
													<div id="calendar" class="fc-calendar-container"></div>
												</div>
											</div>										
										</div>
										<!-- </div>	 -->
								</div> <!-- EVENT-CALENDAR ends -->
								
								<div class="upcoming-events">
									<h3><?php printf(__('%s','SPICE'),esc_html($event_page_upcoming_title));?></h3>
									<p><?php printf(__('%s','SPICE'),$event_page_upcoming_text); ?></p>

									<div class="event-img-main-container clearfix">
									<?php
											$dt=date('Y-m-d');
											$query_args['post_type']='event';
							                $query_args['meta_key']='spice_event_date';
							                $query_args['orderby']='meta_value';
							                $query_args['order']='ASC';
							                $query_args['meta_query']=array(
							                                                      array(
							                                                          'key'     => 'spice_event_date',
							                                                          'value'   =>  DATE($dt),
							                                                          'compare' => '>=',
							                                                          'type'  => 'DATE',
							                                                         
							                                                      ),
							                                                   );
							                $events_query = new WP_Query( $query_args );
							                while($events_query->have_posts()) : $events_query->the_post();	
							                $post_id=get_the_ID();
							                $event_date=date('jS M Y',strtotime(get_post_meta($post_id,'spice_event_date',true)));				                
							                $event_start_time=get_post_meta($post_id,'spice_event_start_time',true);
							               	$event_date.=', '.$event_start_time;
							               	$event_poster=get_post_meta($post_id,'spice_event_poster',true);
									?>				
										<div <?php post_class('event-img-wrapper'); ?>>
											<div class="imgLiquidFill imgLiquid">
												<img src="<?php printf('%s',esc_url($event_poster)); ?>" alt="">
												<div class="event-banner clearfix">
													<div class="bullet-wrapper">
														<div class="blue bullet"></div>
													</div>
													<div class="name-date">
														<h3><?php the_title(); ?></h3>
														<h4><?php printf('%s',$event_date); ?></h4>
													</div>
													<div class="button-holder">
														<a href="<?php the_permalink(); ?>" class="button red-btn"><?php  esc_html_e('More','SPICE'); ?></a>
													</div>
												</div>
											</div>
										</div> <!-- EVENT-BANNER ends -->							

									<?php
											endwhile;
									?>	

									</div> <!-- EVENT IMG MAIN CONTAINER ends -->
								</div> <!-- UPCOMING EVENTS ends -->
								<div class="join-events">
									<h3><?php printf(__('%s','SPICE'),esc_html($event_page_join_title));?></h3>
									<p><?php printf(__('%s','SPICE'),$event_page_join_text); ?></p>
									<div class="clearfix event-form">
									<?php
											if ( has_shortcode( $event_page_join_form, 'contact-form-7' ) ) 
											{												
												echo do_shortcode($event_page_join_form); 
											}
											else
											{
									?>									
												<h3><?php esc_html_e('Create a Form with Contact Form 7','SPICE'); ?></h3>
									<?php
											}
									?>
									</div>

								</div> <!-- JOIN EVENTS ends -->

							</article> <!-- CONTENT-WRAPPER ends -->
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