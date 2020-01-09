<?php
		get_header();
?>
			<section class="chef-list">
				<div class="container">
					<div class="row">
					<?php
						$args = array(  'post_type' => 'event', 'post_status'=> 'publish');	    
	    				$chef_query = new WP_Query( $args ); 
	    				while($chef_query->have_posts()) : $chef_query->the_post();
	    				$event_id=get_the_ID();
	    				$event_poster=get_post_meta($event_id,'spice_event_poster',true);
					?>	
						<div class="chef-single-wrapper">
							<figure class="chef-single clearfix">
								<img src="<?php printf(__('%s','SPICE'),esc_url($event_poster)); ?>" alt="">
								<figcaption>
									<h4><?php the_title(); ?></h4>									
									<a href="<?php the_permalink(); ?>" class="red-btn btn"><?php  esc_html_e('Read More','SPICE'); ?></a>
								</figcaption>
							</figure>
						</div>
					<?php
						endwhile;
					?>
					</div>				
					
				</div>
			</section>
		<?php
		get_footer();
?>
