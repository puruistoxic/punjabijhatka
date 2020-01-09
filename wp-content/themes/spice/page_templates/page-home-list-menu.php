<?php
		/*
		Template Name: Home Page List Menu
		*/
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$pagequery =new WP_Query('page_id='.$post_id);	
		$page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true);
		$home_page_icon=get_post_meta($post_id,'spice_home_list_menu_page_icon',true);
		$home_list_menu_item=get_post_meta($post_id,'spice_home_list_menu_item',true);
		$home_list_menu_featured_text=get_post_meta($post_id,'spice_home_list_menu_featured_text',true);



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

		$page_categories=get_post_meta($post_id,'spice_home_list_menu_product_cetegories',true);
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
						<div class="list_menu_container row">
							<?php if(has_post_thumbnail()){	?>
									<div class="list_menu_thumb_img">
										<?php if(!empty($home_list_menu_featured_text)){?><div class="featured_text"><?php printf('%s',$home_list_menu_featured_text); ?></div><?php }?>
									
										<?php the_post_thumbnail('spice-menu-list-banner-size'); ?>
									</div>
							<?php } ?>
							<div class="product_cat_list_wrapper row">
	
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
					                                'posts_per_page'=>$home_list_menu_item,
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
									<div id="product-cat-<?php echo esc_attr($cat); ?>" class="product_cat_list col-sm-4">
										<h3><?php printf('%s',esc_html(ucwords($term->name))); ?></h3>
										<ul>
											<?php
													$product_count=$menu_posts->post_count;
					                                foreach( $menu_posts->posts as $menu)
					                                { 
					                                	$product = new WC_Product( $menu->ID );                                	
														$price = $product->get_price_html();										
														if($product->is_in_stock())
														{                 
					                        ?>
												<li>
													<a href="<?php echo $product->get_permalink(); ?>"><h4><?php printf('%s',esc_html($menu->post_title)); ?></h4></a>
													<div><?php printf('%s',$product->get_categories('/')); ?></div>
													<div class="menu_list_price"><?php printf ('%s',$price); ?></div>
												</li>																						
					                        <?php
					                        			}//is in stock

					                                }
											?>
										</ul>
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
							</div>
						</div>
							
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