<?php		
		get_header();
?>

		<div class="wrapper">
			<div class="about-chef-page">				
				<section class="main-content">
					<div class="container">
						<?php 							
							if ( have_posts() ) : the_post(); 
							$post_id=get_the_ID();
							$chef_image=get_post_meta($post_id,'spice_chef_image',true);
							$chef_designation=get_post_meta($post_id,'spice_chef_designation',true);
							$social_meta=get_post_meta($post_id,'spice_chef_social_link_group',true);	
							$favdish_meta=get_post_meta($post_id,'spice_chef_favdish',true);		
						?>
							<article id="post-<?php get_the_ID(); ?>" <?php post_class('content-wrapper'); ?>>
							<div class="clearfix">
								<div class="chef-details">
								<?php
									if(!empty($chef_image))
									{
								?>
									<img src="<?php printf(__('%s','SPICE'),esc_url($chef_image)); ?>" alt="">									
								<?php
									}
									if(!empty($favdish_meta))									
									{
								?>
									<h3>chef's favourite recipes</h3>
									<div class="fav-recipes clearfix">									
									<?php
											foreach($favdish_meta as $favdish)
											{
												 $product = wc_get_product( $favdish['spice_chef_recipe'] );		
									?>
												<div class="img-holder">
													<div class="imgLiquidFill imgLiquid chef-fav-dish"><?php printf(__('%s','SPICE'),$product->get_image()); ?></div>
													<h4><?php printf(__('%s','SPICE'),esc_html($product->post->post_title)); ?></h4>
												</div>
									<?php
											}
									?>	
									</div>
								<?php
									}//fav dish
								?>
								</div>								
								<div class="about-chef">
									<h2><?php the_title(); ?></h2>
									<h3><?php printf(__("%s",'SPICE'),esc_html($chef_designation)); ?></h3>
									<hr>
									<!-- <h4>About chef</h4> -->
									<?php the_content(); ?>
								</div>
							</div>

							<!-- <div> -->
							<?php
								if(!empty($social_meta))
								{
							?>
								<h3><?php  esc_html_e('Connect with chef','SPICE'); ?></h3>
								<div class="social-connect clearfix">
									<?php
											foreach($social_meta as $social)
											{			
												if(!empty($social['spice_chef_social_url']) && !empty($social['spice_chef_social_link']))
												{									
									?>
													<a href="<?php printf(__('%s','SPICE'),esc_url($social['spice_chef_social_url'])); ?>" class="connect-<?php printf('%s',esc_attr($social['spice_chef_social_link'])); ?>" ><i class="fa <?php printf('%s',esc_attr($social['spice_chef_social_link'])); ?>"></i></a>
									<?php
												}
											}																			
									?>
									
								</div>
							<?php
								}//social
							?>
							<!-- </div> -->
						<?php endif; ?>
						</article>
					</div> <!-- CONTAINER ends -->
				</section> <!-- MAIN CONTENT ends -->
			</div>
		</div>
<?php
		get_footer();
?>