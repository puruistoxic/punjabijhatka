<?php
		/*
		Template Name: Home Page Menu
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);
		$home_page_icon=get_post_meta($post_id,'spice_home_menu_page_icon',true);


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

		$page_categories=get_post_meta($post_id,'spice_home_menu_product_cetegories',true);
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
		<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay"  <?php echo esc_attr($data_steller); ?>></div>
			<section class="food-solutions">
				<div class="container">
					<img src="<?php printf('%s',esc_html($home_page_icon)); ?>" alt="">
					<h2 class="page-title-<?php echo get_the_ID(); ?>"><?php the_title(); ?></h2>
					<h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title));?></h4>

					<!-- ============= FOOD MENUS ================== -->
				
					<?php

						if(!empty($page_categories))
						{
								foreach($page_categories as $cat)
								{

									$thumbnail_id = get_woocommerce_term_meta( $cat, 'thumbnail_id', true );
				    				$image = wp_get_attachment_url( $thumbnail_id );
				    				$args = array(  'post_type' => 'product', 
			                                'orderby' => 'date', 
			                                'order'   => 'DESC', 
			                                'tax_query'=> array(
			                                              array(
			                                                'taxonomy'=>'product_cat',
			                                                'field'=> 'id',
			                                                'terms'=>$cat
			                                              )
			                                            ) 
			                        );
			                        
			                        $menu_posts = new WP_Query( $args );    
			                        $term = get_term_by( 'id',$cat, 'product_cat' );         
							?>		

							<div class="food-menus clearfix">
								<figure>
									<img src="<?php printf('%s',esc_url($image)); ?>" alt="">
								</figure>
								<div class="figcaption">
									<div class="food-menu-heading">
										<h1><?php printf('%s',esc_html(ucwords($term->name))); ?></h1>
										<h6><?php printf('%s',esc_html($term->description));?></h6>
									</div>
									<div class="menu-items-list clearfix">
										<ul class="bxslider a clearfix">
										
										<?php 
											$sum_avg=0.0;
											$product_count=$menu_posts->post_count;
			                                foreach( $menu_posts->posts as $menu)
			                                {   
			                                	$product = new WC_Product( $menu->ID );                                	
												$price = $product->get_price_html();										
												if($product->is_in_stock())
												{                 

													$sum_avg=$sum_avg+(float)$product->get_average_rating();
			                            ?>
											<li class="clearfix">
												<article class="menu-items">
													<figure>
														 <?php printf('%s',$product->get_image('full')); ?>
													</figure>
													<div class="figcaption">
														<a href="<?php echo $product->get_permalink(); ?>"><h2><?php printf('%s',esc_html($menu->post_title)); ?></h2></a>
														<h5><?php printf ('%s',$price); ?></h5>
														<?php
																if($product->get_rating_html()!='')
		                                                  		{
														?>
														<div class="rating-stars"><?php printf('%s',$product->get_rating_html());  ?></div>
														<?php
																}														
														?>
													</div>
												</article>
											</li>								
										<?php
												}//stock check
											}
											$total_avg=round(($sum_avg/$product_count),2);
										?>

										</ul>
									</div>
					
									<div class="direction-btns">
										<a class="prev-btn" href="#">
											<i class="fa fa-angle-left"></i>
										</a>
										<a class="next-btn" href="#">
											<i class="fa fa-angle-right"></i>
										</a>
									</div>

									<div class="cust-rating">
										<h5><?php printf('%s',esc_attr($total_avg)); ?></h5>
										<h6><?php  esc_html_e('Customer Review','SPICE'); ?></h6>
									</div>
								</div>
							</div>
							
							<?php
								}
						}//end if
						else
						{
					?>
						<h4>No Categories to Display</h4>	
					<?php
						}
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