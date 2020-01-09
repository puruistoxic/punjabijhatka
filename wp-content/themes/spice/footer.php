	<!-- ============ FOOTER ================== -->
	<?php	

		
		if(!is_404())
		{
	?>	
			<?php 
				if(spice_get_option('google-map-checkbox'))
				{
			?>						
					<section class="map-search">              
						<?php
							if(spice_get_option('footer-map-search'))
							{
						?>
								<div class="container">
									<!-- ============= CITY SEARCH ================== -->
									<article class="city-search clearfix">
										<div class="search-caption">
											<h4><?php  esc_html_e('WE ARE','SPICE'); ?></h4>
											<h4><?php  esc_html_e('AT YOUR CITY','SPICE'); ?></h4>
										</div>

										<div class="search-form">
											<form id="map-search-form">
												<div>
												<input type="text" id="pac-input" name="pac-input" placeholder="<?php esc_html_e('Enter your city name','SPICE'); ?>">
												</div>																							
											</form>
										</div>
									</article>
									<!-- ============================================ -->
								</div>
						<?php
							}
						?>						
						<div id="map-canvas-new">
						<?php
								if(spice_get_option('google-map-api')!='')
								{	
						?>
								<h1><?php  esc_html_e('GOOGLE MAP','SPICE'); ?></h1>
						<?php
								}
								else
								{
						?>
									<h1><?php  esc_html_e('ENTER GOOGLE MAP API KEY ','SPICE'); ?></h1>
						<?php			
								}
						?>
						</div>
			        </section>
	        <?php
	        	}
	        ?>
	        <?php
				$current_user = spice_loggedin_user();
				if (empty($current_user['is_loggedin'] ) )
				{
			?>
			        <div class="overlay">
						<div class="modal login-page">
							<i class="fa fa-times"></i>
							<?php
									$logo=spice_get_option(array('opt-logo-image','url')); 									
									if(empty($logo))
									{										
										$logo=get_template_directory_uri().'/images/logo-small.png';
									}
							?>
							<a href="<?php echo site_url(); ?>" class="logo">
								<img src="<?php printf('%s',esc_url($logo)); ?>" alt="">
							</a>
							<h2><?php  esc_html_e('sign up now','SPICE'); ?></h2>							
							<div class="clearfix existing-login">
								<?php  
									if(class_exists('WPOA'))
									{										
										echo do_shortcode('[wpoa_login_form layout="buttons-row" align="left"]'); 
									}
																		
								?>
							</div>
							<h3><?php  esc_html_e('Already have an account? Login now','SPICE'); ?></h3>
							<?php 
								$args = array(
								        'echo'           => true,
								        'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . esc_url($_SERVER['REQUEST_URI']),
								        'form_id'        => 'loginform',
								        'label_username' => false,
								        'label_password' => false,
								        'label_remember' => esc_html__( 'Remember Me','SPICE' ),
								        'label_log_in'   => esc_html__( 'Log In','SPICE' ),
								        'id_username'    => 'user_login',
								        'id_password'    => 'user_pass',
								        'id_remember'    => 'rememberme',
								        'id_submit'      => 'wp-submit',
								        'class_submit'   => 'red-btn',
								        'remember'       => true,
								        'value_username' => '',
								        'value_remember' => false
								);
								spice_login_form( $args );
							?>				

						</div> <!-- LOGIN MODAL ends -->
					</div> <!-- OVERLAY ends -->
			<?php
				}//end of if
			?>
		<footer>
			<div class="container">
				<article class="social-btn-group">
					<!-- ========= SOCIAL BUTTONS ========== -->
					<?php spice_SocialIcon(); ?> 				
					<!-- =================================== -->
				</article>				
				<article class="copyright">					
					 <?php
								/*********************** IF MULTIPLE PAGE OPTION SELECTED  FOR MENU **************/
								if(spice_get_option('footer-text')!='')
								{									
									echo spice_get_option('footer-text');
									
								}else
								{
					?>                            	
                           			 &copy; <?php printf( esc_html__( 'Made by %1$s | Powered by %2$s, %3$s', 'SPICE'  ), '<a href="#" title="Premium WordPress Themes">0effort themes</a>', '<a href="http://www.wordpress.org">WordPress</a>', date("Y") ); ?>
                    <?php
								}							
					?>
					  
				</article>
				<?php
						if(spice_get_option('footer-logo'))
						{							
							$logo=spice_get_option(array('footer-logo-image','url')); 
							if(empty($logo))
							{
								$logo=spice_get_option(array('opt-logo-image','url')); 
							}
				?>
							<a class="logo" href="<?php echo site_url(); ?>">			            	
						    	<img src="<?php printf('%s',esc_url($logo)); ?>" alt="">
						  	</a>	
			  	<?php
			  			}
			  	?>
		  </div>
		</footer>
		<!-- ============ FOOTER END================== -->		
    <?php
    	}
    ?>
    </div> <!-- inside-body-wrapper ends Its started at header.php after body -->

  	<?php wp_footer(); ?>
	</body>	
</html>
	