   <header class="new-type3 <?php printf('%s',esc_attr($header_type));?>">
    	<div class="upper-part">
	      <div class="container clearfix">
					<?php spice_topheader_block(); ?>		        
	        <div class="social-btns-group">
	          <a class="mobile-social-btn" href="#"><i class="fa fa-share"></i></a>
	          <!-- ========= SOCIAL BUTTONS ========== -->
	          	<?php spice_SocialIcon(); ?>           
			</div> <!-- ========== SOCIAL BUTTONS ENDS ============= -->
	      </div>
    	</div>
    	<div class="lower-part">
    		<div class="container">
	        <!-- ========= DESKTOP NAV MENU ========== -->
	        <?php 
        		if ( has_nav_menu( 'primary-menu' ) ) 
        		{
        	?>
	        <nav id="navigation-menu" class="nav-menu navbar-collapse" role="navigation">

						<!-- ========== MOBILE MENU ================ -->
						<div id="nav-div" class="clearfix">
					    <div class="navbar-header">
					      <button type="button" id="nav-toggle" class="navbar-toggle">
					        <span class="sr-only">Toggle navigation</span> 
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					      </button>
					    </div>
					      
					    <nav id="navigation-list" class="row navbar-collapse"  role="navigation">
					      <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => false, 'fallback_cb' => '', 'menu_class' => 'nav navbar-nav', 'menu_id' => '', 'echo' => true, 'link_after' => ''));  ?>
					    </nav>
					  </div> <!-- ========== MOBILE MENU ends ============ -->

			</nav>
			<?php

				}
				else
				{
			?>
					<nav id="navigation-list" class="row navbar-collapse"  role="navigation">
							      <ul class="no-menu"><li></li></ul>
					</nav>
			<?php		
				}
			?>
					<!-- =============== DESKTOP NAV MENU ends ==================== -->
    		</div>
    	</div>
	</header>