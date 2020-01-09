<?php 	
		get_header();								
		if ( ! have_posts() ) : 
?>		
				<div <?php post_class('wrapper'); ?>>
					   <div class="event-page">					
					      <section class="main-content">
					         <div class="container">
					         
				               	<article class="event-sectn">
						              <!--   <
			               				<?php get_search_form();  ?> -->

			               				<div class="feature-events">
					                     <div  class="feature-events clearfix">					                       
					                        <div class="figcaption no-search-result">                 	
					                            <h4><?php esc_html_e( 'Nothing Found', 'SPICE' ); ?></h4>
			               						<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'SPICE' ); ?></p>                                  	                 			               						
					                        </div>
					                     </div>					                     
					                  </div>
					                  <div class="no-search-result">
					                  <?php get_search_form();  ?>
					                  </div>
				               	</article>
					        	<?php get_sidebar(); ?>

					         </div>
					      </section>            
					   </div>
					   <!-- EVENT ends -->
					</div>
			<!-- WRAPPER ends -->                              
        <?php                 	
                else : 
	       			get_template_part('includes/partials/content','loop');
    			endif;
 
		get_footer();		
?>