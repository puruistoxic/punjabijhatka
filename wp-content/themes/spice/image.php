<?php

		get_header(); 
		$class='wrapper';
 		$sidebar_class='';
        if(is_page())
        {
             if(spice_get_option('opt-single-page-sidebar')==2)
             {
                $sidebar_class='sidebar-2';
             }
        }
        if(is_single())
        {
            if(spice_get_option('opt-single-post-sidebar')==2)
            {
               $sidebar_class='sidebar-2';
            }
        }    
        if(has_post_format())
        {
        	$class.=' image';
        }   

?>

<div <?php post_class($class); ?>>
   <div class="event-page">   
      <section class="main-content">
         <div class="container">
			<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
			?>

				<article class="event-sectn <?php printf(__('%s','SPICE'),esc_attr($sidebar_class)); ?>">
					<ul class="breadcrumb">
							<li><?php previous_image_link( false, '<i class="fa fa-arrow-left"></i> Prev' ); ?></li>
							<li><?php next_image_link( false, 'Next <i class="fa fa-arrow-right"></i>' ); ?></li>

					</ul>
					
					
 					<div class="main-event event clearfix">
 						<div class="corner-details">
	                        <div class="corner-date"><?php echo get_the_date(); ?></div>                     
	                    </div>
	                    <?php the_post_navigation( array('prev_text' =>_x('<span class="post-title"> %title </span>','Parent post link','SPICE')) ); ?>
						<h4><?php the_title(); ?></h4>
						
						<div class="featured-image">				
							<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
						</div>
						<div class="blog-content">  
								<?php if ( has_excerpt() ) : ?>									
										<?php the_excerpt(); ?>									
								<?php endif; ?>
							<?php
								the_content();
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'SPICE' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'SPICE' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
							?>
						</div>
						
					</div>
					<div class="blogmeta">
                        <?php echo spice_postinfo_meta(); ?>                       
                  </div>
                  <?php if ( ! post_password_required() ) comments_template( '', true ); ?>		
				</article><!-- #post-## -->

				<?php				
				
				endwhile;
			?>
			<?php  
               if(is_page() && spice_get_option('opt-single-page-sidebar')!=1)
               {                             
                  get_sidebar();                  
               }
               if(is_single())
               {
                  get_sidebar(); 
               }   
         	?>
		
			</div><!-- .content-area -->
		</section>
	</div>
</div>

<?php get_footer(); ?>
