<?php
		/*
		Template Name: Contact
		*/		
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$contact_google_map=get_post_meta($post_id,'spice_contact_google_map',true)!=''?get_post_meta($post_id,'spice_contact_google_map',true):'';
		$contact_logo_box=get_post_meta($post_id,'spice_contact_logo_box',true)!=''?get_post_meta($post_id,'spice_contact_logo_box',true):'';
		$contact_logo_box_bg=get_post_meta($post_id,'spice_logo_box_background',true)!=''?get_post_meta($post_id,'spice_logo_box_background',true):'#ffffff';

		$post_id=get_the_ID();
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

		<div class="wrapper page-wrapper-<?php echo get_the_ID(); ?>">
			<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay" <?php echo esc_attr($data_steller); ?>></div>
			<div class="contact-page">
				<section class="main-content">
					<div class="container">
						<?php 
								if($contact_google_map=="on")
								{
						?>
								<!-- <div id="contact-map-section" style="width:1140px;height:454px;"> -->
								<div id="contact-map-section" style="height:454px;">
										<img src="<?php echo get_template_directory_uri(); ?>/images/contact-map.png" alt="">
								</div>
						<?php
								}
						?>
						<article class="content-wrapper">							
							<?php 
								if($contact_logo_box=="on")
								{
									$logo=spice_get_option(array('opt-logo-image','url'));	
									if(empty($logo))
									{
										$logo=get_template_directory_uri().'/images/logo-small.png';
									}
							?>
							<div class="logo-box" >
								<img src="<?php echo esc_url($logo); ?>" alt="">
							</div>
							<?php
								}
							?>
							<div class="clearfix">
								<div class="office-details">
									<?php
											the_content();
									?>
								</div>

								<div class="write-us">
									<h3><?php  esc_html_e('write to us','SPICE'); ?></h3>									
									<?php											
											$contact_form=get_post_meta($post_id,'spice_contact_form_shortcode',true)!=''?get_post_meta($post_id,'spice_contact_form_shortcode',true):'';											
											if ( has_shortcode( $contact_form, 'contact-form-7' ) ) 
											{												
												echo do_shortcode($contact_form); 
											}
											else
											{
									?>									
												<h3><?php esc_html_e('Create a Form on Contact Us','SPICE'); ?></h3>
									<?php
											}
									?>
								</div>						

							</div>
							<div class="socials-holder">
									<h4><?php  esc_html_e('Socialize with us','SPICE'); ?></h4>
									<div class="social-connect clearfix">
										<a href="#" class="fb"><i class="fa fa-facebook"></i></a>
										<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
										<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
										<a href="#" class="rss"><i class="fa fa-rss"></i></a>
										<a href="#" class="gplus"><i class="fa fa-google-plus"></i></a>
										<a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a>
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