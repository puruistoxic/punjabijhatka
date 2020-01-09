<?php
		get_header();
?>
			<section class="chef-list">
				<div class="container">
					<div class="row">
					<?php
						$args = array(  'post_type' => 'chef', 'post_status'=> 'publish');	    
	    				$chef_query = new WP_Query( $args ); 
	    				while($chef_query->have_posts()) : $chef_query->the_post();
	    				$chef_id=get_the_ID();
	    				$chef_image=get_post_meta($chef_id,'spice_chef_image',true);

					?>	
						<div class="chef-single-wrapper">
							<figure class="chef-single clearfix">
								<img src="<?php printf('%s',esc_url($chef_image)); ?>" alt="">
								<figcaption>
									<h4><?php the_title(); ?></h4>									
									<a href="<?php the_permalink(); ?>" class="red-btn btn"><?php  esc_html_e('Read more','SPICE'); ?></a>
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
