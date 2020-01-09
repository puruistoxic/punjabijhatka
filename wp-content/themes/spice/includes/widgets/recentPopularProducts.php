<?php
	 class RecentPopularProducts extends WP_Widget
		{
			function __construct()
			{
				$widget_ops = array('description' => 'Display Popular & Recent Products');
				$control_ops = array('width' => 400, 'height' => 600);
				parent::__construct(false,$name='Spice Recent & Popular Products Thumb',$widget_ops,$control_ops);
			}
		
			/* Displays the Widget in the front-end */
			function widget($args, $instance)
			{
				extract($args);
		 
				$instance = wp_parse_args( (array) $instance, array( 'title'=>'Recent Post', 'recentPost'=>'','no_of_post'=>'','spice_cat_name'=>'' ) );
				$recentPost = $instance['recentPost'];
				//$title = strip_tags($instance['title']);
				$no_of_post = strip_tags($instance['no_of_post']);
				$allowed_tags_before_after='';
				
														?>





<article class="widgets popular-events-widget popular-products-widget">
													 <ul class="tabs clearfix">
															 
															<li>
																 <a class="selected" href="javascript:void(0)">popular</a>
																 
																	<?php query_posts("post_type=product&showposts=".$no_of_post."&post_status=publish&meta_key=total_sales&orderby=meta_value_num&order=DESC");
																 $regular_price = get_post_meta( get_the_ID(), '_regular_price');
																 $sale_price = get_post_meta( get_the_ID(), '_sale_price');

																		
																	?>
																 <ul class="popular-events-list popular-products-list" style="display: block;">
																		 <?php while(have_posts()):the_post(); 
																		 
																		 global $product;
																		 
																		 ?>
																		<li>
																				<a href="<?php the_permalink(); ?>" class="clearfix">
																					 <figure> 
																							<div class="imgLiquidFill imgLiquid liquidProductSpice">    
																								<?php echo woocommerce_get_product_thumbnail(); ?>
																							</div>
																					 </figure>
																					<div class="figcaption">																					 
																								<h4><?php the_title(); ?></h4>
																								<h3><?php printf(__('%s%s','SPICE'),get_woocommerce_currency_symbol(),$product->get_price()); ?></h3>
																				 </div>

																			 </a>
																		</li>
																		 <?php endwhile; ?>
																		 <?php wp_reset_query(); ?>  
																</ul>
															</li>

															<li>
																 <a href="javascript:void(0)">recent</a>
																 
																 
																 <?php query_posts("post_type=product&showposts=".$no_of_post."&post_status=publish"); 
																					$regular_price = get_post_meta( get_the_ID(), '_regular_price');
																					$sale_price = get_post_meta( get_the_ID(), '_sale_price');
																 ?>
																 <ul class="popular-events-list recent-list popular-products-list">
																		
																		<?php while(have_posts()):the_post();
																					global $product;
																		 ?>
																		<li>
																			 <a href="<?php the_permalink(); ?>" class="clearfix">
																					<figure>
																					<div class="imgLiquidFill imgLiquid liquidProductSpice">  
																							<?php echo woocommerce_get_product_thumbnail(); ?>
																						</div>
																					</figure>
																					<div class="figcaption">
																						 <h4><?php the_title(); ?></h4>
																						 <h3><?php printf(__('%s%s','SPICE'),get_woocommerce_currency_symbol(),$product->get_price()); ?></h3>
																					</div>
																			 </a>
																		</li>
																 <?php endwhile; ?>
																		 <?php wp_reset_query(); ?> 
																 
																 </ul>
															</li>
													 </ul>
													 
												</article>
		
		<?php
								
													
								
											
				echo wp_kses($after_widget,$allowed_tags_before_after);	
			}
		
			/*Saves the settings. */
			function update($new_instance, $old_instance){
														$instance = $old_instance;
														
													 
														
														//$instance['title'] = strip_tags($new_instance['title']);
														$instance['no_of_post'] = strip_tags($new_instance['no_of_post']);
															
														return $instance;
			}
		
				/*Creates the form for the widget in the back-end. */
			function form($instance){
				
											
														
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title'=>'Recent Post', 'recentPost'=>'','no_of_post'=>'','spice_cat_name'=>'' ) );
				$recentPost = $instance['recentPost'];
				//$title = strip_tags($instance['title']);
				$no_of_post = strip_tags($instance['no_of_post']);
																$selected='';
															
						
				# Title
																
																
																//echo '<p><label for="' . esc_attr($this->get_field_id('no_of_post')) . '">' . 'No of posts to Show:' . '</label><input class="widefat" id="' . esc_attr($this->get_field_id('no_of_post')) . '" name="' . esc_attr($this->get_field_name('no_of_post')) . '" type="text" size="3" value="' . esc_attr($no_of_post) . '" /></p>';
				
																printf( '<p><label for="%1$s">' . 'No of products to Show:' . '</label><input class="widefat" id="%1$s" name="%3$s" type="text" size="3" value="%2$s" /></p>',
																				esc_attr($this->get_field_id('no_of_post')),
																				esc_attr($no_of_post),
																				esc_attr($this->get_field_name('no_of_post'))
																				);
																													 
			}			
		
		}
		// end CustomLogoWidget class		
		function RecentPopularProducts() {
			register_widget('RecentPopularProducts');
		}
		if ( class_exists( 'woocommerce' ) ) 
		{
			add_action('widgets_init', 'RecentPopularProducts');
		}


