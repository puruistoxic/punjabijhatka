<?php
	 class RecentProductsSlider extends WP_Widget
		{
			function __construct()
			{
				$widget_ops = array('description' => 'Displays Products as Slider');
				$control_ops = array('width' => 400, 'height' => 600);
				parent::__construct(false,$name='Spice Recent Products Slider',$widget_ops,$control_ops);
			}
		
			/* Displays the Widget in the front-end */
			function widget($args, $instance)
			{
				extract($args);
				$template_dir = get_template_directory_uri();
				wp_enqueue_script( 'bootcar', $template_dir . '/js/bootstrap.min.js', array( 'jquery' ), '' ); 
				$instance = wp_parse_args( (array) $instance, array( 'title'=>'Recent Post', 'recentPost'=>'','no_of_post'=>'','spice_cat_name'=>'' ) );
				$recentPost = $instance['recentPost'];
				$title = strip_tags($instance['title']);
				$no_of_post = strip_tags($instance['no_of_post']);
				$spice_cat = $instance['spice_cat_name'];
				$allowed_tags_before_after='';
				
?>
<article class="widgets archive-list-new">
		 <h4><?php 
				printf("%s",$title);
		  ?></h4>
							<?php 							
									$query_args = array(
										'post_type'	=> 'product',
										'post_status' => 'publish',
										'posts_per_page' => 8,
										'orderby' => 'date',
										'order' => 'DESC',
												'tax_query' => array(
															 array(
																	'taxonomy' => 'product_cat',
																	'field' => 'id',
																	'terms' => $spice_cat,
															 ),
													 ),	   
										);		
										$loop = new WP_Query( $query_args );          					 
							?>
													  <div class="widget-content clearfix">																		 
															<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">															 															  
																			<div class="carousel-inner" role="listbox">
																					  <?php 
																					  	$act=0;
																					  	while($loop->have_posts()):$loop->the_post();  
																					  			$active_class="";
																					  			if($act==0)
																					  			{
																					  				$active_class="active";
																					  			}
																					  ?> 
																					  			  <div class="item <?php printf('%s',esc_attr($active_class)); ?>">																			     
																					  			  	 <div class="imgLiquidFill imgLiquid productSliderImg" >
																									     <?php echo woocommerce_get_product_thumbnail(); ?>
																									     </div>
																									      <div class="carousel-caption">
																									       	<h3><?php the_title(); ?></h3> 
																									      </div>
																									  </div>                          

																						<?php 
																									$act++;
																									endwhile; 
																						?> 
																			</div>
																			<!-- Controls -->
																		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
																		    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
																		    <span class="sr-only">Previous</span>
																		  </a>
																		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
																		    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
																		    <span class="sr-only">Next</span>
																		  </a>														 
														  </div>                                                                                        
														</div>							 
												</article>
		
		<?php
								
				echo wp_kses($after_widget,$allowed_tags_before_after);	
			}
		
			/*Saves the settings. */
			function update($new_instance, $old_instance){
														$instance = $old_instance;												 													
														$instance['title'] = strip_tags($new_instance['title']);
														$instance['no_of_post'] = strip_tags($new_instance['no_of_post']);
														$instance['spice_cat_name'] = ($new_instance['spice_cat_name']);                       
														return $instance;
			}
		
				/*Creates the form for the widget in the back-end. */
			function form($instance){
								
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title'=>'Recent Post', 'recentPost'=>'','no_of_post'=>'','spice_cat_name'=>'' ) );
				$recentPost = $instance['recentPost'];
				$title = strip_tags($instance['title']);
				$no_of_post = strip_tags($instance['no_of_post']);
																$selected='';
																$spice_cat_name = ($instance['spice_cat_name']);                                  
						
			
				
																echo '<p><label for="' . esc_attr($this->get_field_id('title')) . '">' . 'Title:' . '</label><input class="widefat" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" type="text" value="' . esc_attr($title) . '" /></p>';
																
																printf( '<p><label for="%1$s">' . 'No of products to Show:' . '</label><input class="widefat" id="%1$s" name="%3$s" type="text" size="3" value="%2$s" /></p>',
																				esc_attr($this->get_field_id('no_of_post')),
																				esc_attr($no_of_post),
																				esc_attr($this->get_field_name('no_of_post'))
																				);
																
																		$taxonomy     = 'product_cat';
																		$orderby      = 'name';  
																		$show_count   = 0;      // 1 for yes, 0 for no
																		$pad_counts   = 0;      // 1 for yes, 0 for no
																		$hierarchical = 1;      // 1 for yes, 0 for no  
																		$title        = '';  
																		$empty        = 0;

																		$args = array(
																					 'taxonomy'     => $taxonomy,
																					 'orderby'      => $orderby,
																					 'show_count'   => $show_count,
																					 'pad_counts'   => $pad_counts,
																					 'hierarchical' => $hierarchical,
																					 'title_li'     => $title,
																					 'hide_empty'   => $empty
																		);
																	 $all_categories = get_categories( $args );                            
																	 
																	
																	 foreach( $all_categories as $all_cat )
																	 {
																			$selected='';
																			if(is_array($spice_cat_name))
																			{
																					if(in_array($all_cat->term_id,$spice_cat_name))
																					{
																						$selected='checked=checked';
																					}
																			}
																			 
																		?>
																	 
																		<input type="checkbox" id="<?php echo esc_attr($this->get_field_id('spice_cat_name')) ?>" name="<?php echo esc_attr($this->get_field_name('spice_cat_name')) ?>[]" value='<?php printf('%s',esc_attr($all_cat->term_id)); ?>' <?php printf('%s',esc_attr($selected)); ?>>  <?php echo esc_html($all_cat->name); ?><br>
																				
																<?php

																	 }
													 
			}			
		
		}// end CustomLogoWidget class		
		function RecentProductsSlider() {
			register_widget('RecentProductsSlider');
		}
		if ( class_exists( 'woocommerce' ) ) 
		{
			add_action('widgets_init', 'RecentProductsSlider');
		}


