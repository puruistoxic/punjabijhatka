<?php
		/*
		Template Name: Home Contact
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);
		$home_page_icon=get_post_meta($post_id,'spice_home_contact_page_icon',true);

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
		
			<section class="contact-us">
					<div class="container">
						<img src="<?php printf('%s',esc_url($home_page_icon)); ?>" alt="">
						<h2 class="page-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h2>
						<h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title)); ?></h4>
						<?php											
								$contact_form=get_post_meta($post_id,'spice_home_contact_form_shortcode',true)!=''?get_post_meta($post_id,'spice_home_contact_form_shortcode',true):'';											
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
				</section>
</div>

<?php
		endwhile;endif;
		if(empty($is_home_page))
		{
			get_footer();
		}
?>