<?php
		/*
		Template Name: Reservation
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
		<div class="reservation">

				<section class="main-content">
					<div class="container page-reserv">
						<h3><?php  esc_html_e('fill your details in the below fields for reservation','SPICE'); ?></h3>

						<article class="content-wrapper">
							<form id="book-table-<?php printf('%s',esc_attr($post_id)); ?>">
								<h4><?php  esc_html_e('Personal Information','SPICE'); ?></h4>
								<div class="row basic-info">
									<div class="input-wrapper col-sm-6">
										<input type="text" class="icons name" placeholder="<?php esc_html_e('Enter Your Name','SPICE'); ?>" id="customer_name_<?php printf('%s',esc_attr($post_id)); ?>" name="customer_name_<?php printf('%s',esc_attr($post_id)); ?>">
									</div>
									<div class="input-wrapper col-sm-6">
										<input type="text" class="icons phone" placeholder="<?php esc_html_e('Enter Your Phone','SPICE'); ?>" id="customer_phone_<?php printf('%s',esc_attr($post_id)); ?>" name="customer_phone_<?php printf('%s',esc_attr($post_id)); ?>">
									</div>
									<div class="input-wrapper col-sm-6">
										<input type="text" class="icons email" placeholder="<?php esc_html_e('Your Email','SPICE'); ?> " id="customer_email_<?php printf('%s',esc_attr($post_id)); ?>" name="customer_email_<?php printf('%s',esc_attr($post_id)); ?>">
									</div>									
								</div>

								<h4><?php  esc_html_e('Read More','SPICE'); ?><?php  esc_html_e('Requirement options','SPICE'); ?></h4>
								<div class="requirement row">
									<div class="col-md-4 col-sm-6">
										<div class="select input-wrapper">
										<?php
												if(is_array($home_booking_occasions) && !empty($home_booking_occasions))
												{
										?>
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
										<?php
												}
										?>
										</div>
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="clearfix">
											<div class="input-wrapper">
												<input type="text" placeholder="<?php esc_html_e('Occassion Date/Time','SPICE'); ?>" id="occasion_date_time_<?php printf('%s',esc_attr($post_id)); ?>" class="icons occasion_date_time" name="occasion_date_time_<?php printf('%s',esc_attr($post_id)); ?>">
											</div>
											
										</div>
										
									</div>

									<div class="col-md-4 col-sm-6">
										<div class="input-wrapper">
											<input class="" type="text" id="personNo_<?php printf('%s',esc_attr($post_id)); ?>" name="personNo_<?php printf('%s',esc_attr($post_id)); ?>" placeholder="<?php esc_html_e('No. of person','SPICE'); ?>">	
										</div>										
									</div>
								</div>

								<div class="tc-submit clearfix ">
									<div class="tc">
										<h4><?php  esc_html_e('*Terms and conditions','SPICE'); ?></h4>
										<p><?php  esc_html_e('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.','SPICE'); ?></p>
									</div>
									<button class="red-btn button" type="button" id="book_home_table-<?php printf('%s',esc_attr($post_id)); ?>"><?php  esc_html_e('Order now','SPICE'); ?></button>
								</div>

								<div class="reservation_final_msg" >
									<div class="book_spinner_wrapper">
											<div class="spinner">
											  <div class="rect1"></div>
											  <div class="rect2"></div>
											  <div class="rect3"></div>
											  <div class="rect4"></div>
											  <div class="rect5"></div>
											</div>
									</div>
								</div>
							</form>
							
						</article>
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