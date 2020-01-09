<?php
		/*
		Template Name: Meet Chef Style2
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

		$chef_icon=get_post_meta($post_id,'spice_home_chefs_icon',true);	
	    $chefs_id=get_post_meta($post_id,'spice_home_chefs_to_display',true);

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
				<section class="meet-chef-v2">
					<div class="container clearfix">
						<h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title));?></h4>
						<h2 class="page-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h2>
						<div class="chef-v2-wrapper">
							<?php							
									if(!empty($chefs_id))
			    					{		


			    						$args = array(  'post_type' => 'chef', 
									            'orderby' => 'date', 
									            'order'   => 'DESC',
									            'post_status'=> 'publish',
									            'post__in'=>  $chefs_id           
									          );
									    
									    $post_query = new WP_Query( $args ); 
									    if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post();	
									    
									    $thumb = wp_get_attachment_image_src( get_post_meta(get_the_ID(),'spice_chef_image_id',true), 'spice-chef-style2-image' );
									    $url = $thumb['0']; 
									    $chef_designation=get_post_meta(get_the_ID(),'spice_chef_designation',true);
							?>
											<div id="chef-<?php echo get_the_ID(); ?>" class="chef-v2-item">

												<?php 
													if(!empty($url))
													{
												?>
												<div class="chef-img-wrapper2 imgLiquid imgLiquidFill">
													<img src="<?php printf('%s',esc_url($url)); ?>" alt="">
												</div>
												<?php
													}
												?>
												<div class="chef-text-wrapper">
													<h4 class="chef-name"><?php the_title(); ?></h4>
													<div class="lower-text">				
														<h4><?php printf(__("%s",'SPICE'),esc_html($chef_designation)); ?></h4>				
														<p><?php printf('%s',spice_get_the_excerpt(30));?></p>
													</div>
												</div>
											</div>
							<?php
										endwhile;endif;
									}
							?>
						</div>
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