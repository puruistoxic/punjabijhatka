<?php
		/*
		Template Name: Meet Chef
		*/		
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);

	    if ( $pagequery->have_posts() ) : while ( $pagequery->have_posts() ) : $pagequery->the_post();	
	    
	    $chef_icon=get_post_meta($post_id,'spice_home_chefs_icon',true);	
	    $chefs_id=get_post_meta($post_id,'spice_home_chefs_to_display',true);	
	    $post_arr=array();
	    $all_chefs=array();
	   
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
			
				<section class="meet-chef">
					<div class="container clearfix">
						<?php the_content(); ?>
						<div class="figcaption">
							<h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title));?></h4>
							<h2 class="page-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h2>
							<!-- ============ FEATURED EVENTS ================== -->
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
							   
							    $all_chefs=$post_query->posts;
								if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post();	
								
							?>
							<article id='chef-<?php printf('%s',esc_attr(get_the_ID())); ?>' class="chef-details clearfix">
								<figure>
									<img src="<?php printf('%s',esc_url($chef_icon)); ?>" alt="">
								</figure>								
								<div class="figcaption">
									<h5><?php the_title(); ?></h5>
									<p><?php printf('%s',spice_get_the_excerpt(30));?></p>
								</div>
							</article>
							<?php

								endwhile; endif;
							?>				
							<!-- =============================================== -->
						</div>
						<figure>
						<?php 
								$chef_count=0;
								foreach($all_chefs as $chef)
								{
									$chef_class="";
									$chef_count++;
									if($chef_count==2)
									{
										$chef_class="centre-chef";
									}
									$chef_image=get_post_meta($chef->ID,'spice_chef_image',true);
						?>				
									<img class="<?php printf('%s',esc_attr($chef_class)); ?>" src="<?php printf('%s',esc_html($chef_image)); ?>" alt="">
						<?php
								}
							}
						?>
						</figure>
						
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