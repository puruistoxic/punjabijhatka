<?php
		/*
		Template Name: Home Page Events Style2
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);
		$no_of_events=get_post_meta($post_id,'spice_home_event_style2_no',true);
		$home_page_icon=get_post_meta($post_id,'spice_home_event_style2_page_icon',true);

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
			<section class="everyday-events">
					<div class="container">
						<img src="<?php printf('%s',esc_html($home_page_icon)); ?>" alt="">
						<h2 class="page-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h2>
						<h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title)); ?></h4>

						<!-- ============ FEATURED EVENTS ================== -->
						<div class="feat-event">
						<?php
								$dt=date('Y-m-d');
								$query_args['post_type']='event';
								$query_args['posts_per_page']=($no_of_events==0?2:$no_of_events);
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

								$event_query = new WP_Query( $query_args );								

								while($event_query->have_posts()) : $event_query->the_post();
								
								$event_date=date('M d, Y',strtotime(get_post_meta(get_the_ID(),'spice_event_date',true)));
								$start_time=get_post_meta(get_the_ID(),'spice_event_start_time',true);
								$end_time=get_post_meta(get_the_ID(),'spice_event_end_time',true);
								$event_poster=get_post_meta( get_the_ID(), 'spice_event_poster', true );								
								
						?>
									<div class="event-style2 event-<?php printf(__('%s','SPICE'),get_the_ID()) ?>">
										<div class="clearfix">
											<div class="figure col-md-6 imgLiquidFill imgLiquid home-page-event-style2">
												<!-- <div class="imgLiquidFill imgLiquid home-page-event-style2" > -->
													<img src="<?php printf('%s',esc_url($event_poster)); ?>" alt="">													
												<!-- </div>												 -->
											</div>
											<div class="figcaption event col-md-6">
												<h3 class="blog-list-title"><?php the_title(); ?></h3>
												<h5><?php printf('%1$s | %2$s - %3$s',esc_html($event_date),esc_html($start_time),esc_html($end_time)); ?></h5>												
												<p><?php printf('%s',spice_get_the_excerpt(30));?></p>
												<a class="button red-btn" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read More','SPICE'); ?></a>
											</div>
										</div>
									</div>
						<?php
								endwhile;
						?>						

						</div>
						<!-- =============================================== -->
						<div class="clearfix"></div>
						<div class="spinner-loader-cont">
							<div class="spinner-loader">
							  <?php esc_html_e('Loading...','SPICE'); ?>
							</div>
						</div>
						
						<a href="javascript:void(0);" data-page="<?php echo esc_attr($post_id); ?>" class="button white-btn load-more-event-style2" data-item="2"><?php  esc_html_e('LOAD MORE','SPICE'); ?></a>
						<div id="testdata">	</div>
						
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