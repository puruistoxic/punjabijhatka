<?php   
      $classes=get_body_class();
      $content_flag=0;
      $chef_flag=0;
      if (in_array('woocommerce-wishlist',$classes)) 
      {
         $content_flag=1;
      }
      if (in_array('post-type-archive-chef',$classes)) 
      {
         $chef_flag=1;
      }          
      $sidebar_class='';      
      if(spice_get_option('opt-single-page-sidebar')==2)
      {
          $sidebar_class='sidebar-2';
      }
      if(spice_get_option('opt-single-page-sidebar')==1)       
      {
         $sidebar_class='sidebar-no';
      }
      $page_class="wrapper wrapper-".get_the_ID(); 
?>

<div class="wrapper page-wrapper-<?php echo esc_attr(get_the_ID()); ?>">
   <div id="page-<?php echo get_the_ID(); ?>" class="static-overlay"></div>
   <div <?php if ( class_exists( 'woocommerce' ) ) { if(!is_checkout() && !is_account_page()){ ?> class="event-page" <?php } }else if(is_home()) { ?> class="event-page"<?php } ?>>     
      <section class="main-content <?php if ( class_exists( 'woocommerce' ) ) { if(is_cart() || is_checkout() || is_account_page()){ ?> cart_page <?php } }?>">
         <div class="container">
            <div class="row">
               <article class="event-sectn <?php printf('%s',esc_attr($sidebar_class)); ?>">
                  <!-- ============= MAIN EVENT ================== -->                 
                  <?php spice_breadcrumb(); ?>   
                  <?php                  
                     if(is_author())
                     {
                        get_template_part('includes/partials/author-box');
                     }                  
                  ?>
                  <div class="featured-events">                         
                     <!-- ============ FEATURED EVENTS ================== -->
                     <?php
                              if ( have_posts() ) : while ( have_posts() ) : the_post();                                                      

                              if ( class_exists( 'woocommerce' ) ) 
                              {
                                 if( !is_cart() && !is_checkout() && ! is_account_page() && !is_singular() && $content_flag==0)
                                 {     
                     ?>

                                    <div class="feature-events-wrap">
                                          <div id="post-<?php the_ID(); ?>" <?php post_class('feature-events clearfix'); ?>>
                                             <div class="corner-details">
                                                <div class="corner-date"><?php echo get_the_date(); ?></div>                                                     
                                             </div>
                                             <div class="featured-image">
                                                <?php

                                                         if(has_post_thumbnail())
                                                         {
                                                            if(spice_get_option('gn-fitimage-checkbox'))
                                                            {
                                                         ?>
                                                          <div class="imgLiquidFill imgLiquid">
                                                         <?php      
                                                            }
                                                            
                                                            echo get_the_post_thumbnail(get_the_ID(),'spice-blog-image-size-new');   
                                                            if(spice_get_option('gn-fitimage-checkbox'))
                                                            {
                                                         ?>
                                                         </div>

                                                         <?php
                                                            }                                                         
                                                         } 
                                                         else
                                                         {
                                                   ?>
                                                         <div class="imgLiquidFill imgLiquid no-blog-image"></div>
                                                   <?php         
                                                         }                           
                                                   ?>                                                
                                             </div>

                                             <div class="figcaption">
                                                 
                                                <h3 class="blog-list-title"><?php the_title(); ?></h3>
                                                <div class="blogmeta inside"><?php echo spice_postinfo_meta(); ?></div>
                                                <div class="excerpt">
                                                <?php the_excerpt(); ?>
                                                </div>
                                                <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','SPICE'); ?></a>
                                                
                                             </div>
                                          </div>                                         
                                    </div>
                     <?php      
                                 }      
                                 else
                                 {
                     ?>                                 
                                     <div class="feature-events-wrap">                                 
                     <?php                  
                                          the_content();
                     ?>
                                    </div>               
                     <?php
                                 }
                              }
                              else
                              {
                                 if(!is_singular() && $content_flag==0)
                                 {
                     ?>
                                         <div class="feature-events-wrap">
                                          <div id="post-<?php the_ID(); ?>" <?php post_class('feature-events clearfix'); ?>>
                                             <div class="corner-details">
                                                <div class="corner-date"><?php echo get_the_date(); ?></div>                                                     
                                             </div>
                                             <div class="featured-image">
                                                <?php

                                                         if(has_post_thumbnail())
                                                         {
                                                            if(spice_get_option('gn-fitimage-checkbox'))
                                                            {
                                                         ?>
                                                          <div class="imgLiquidFill imgLiquid">
                                                         <?php      
                                                            }                                                           
                                                            echo get_the_post_thumbnail(get_the_ID(),'spice-blog-image-size-new');   
                                                            if(spice_get_option('gn-fitimage-checkbox'))
                                                            {
                                                         ?>
                                                         </div>

                                                         <?php
                                                            }                                                         
                                                         } 
                                                         else
                                                         {
                                                   ?>
                                                         <div class="imgLiquidFill imgLiquid no-blog-image"></div>
                                                   <?php         
                                                         }                           
                                                   ?>
                                             </div>
                                             <div class="figcaption">
                                                 
                                                <h3 class="blog-list-title"><?php the_title(); ?></h3>
                                                <div class="blogmeta inside"><?php echo spice_postinfo_meta(); ?></div>
                                                <div class="excerpt">
                                                <?php the_excerpt(); ?>
                                                </div>
                                                <a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('READ MORE','SPICE'); ?></a>
                                               
                                             </div>
                                          </div>                                         
                                    </div>                                             
                     <?php

                                 }
                                 else
                                 {
                     ?>                                 
                                    <div class="feature-events-wrap">                                 
                     <?php                  
                                         the_content();
                     ?>
                                    </div>               
                     <?php      
                                 }
                              }
                              endwhile; endif;

                     ?>                           
                     <!-- ============= FEATURED EVENTS ends============== -->
                  </div>
                  
                  <?php
                        if(is_home())
                        {
                  ?>
                  <div class="pagination-block clearfix">
                     <?php   
                         
                        global $wp_query;            
                        $big = 999999999; // need an unlikely integer
                         
                        echo paginate_links( array(
                           'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                           'format' => '?paged=%#%',
                           'type'=>'list',
                           'current' => max( 1, get_query_var('paged') ),
                           'total' => $wp_query->max_num_pages,
                           'prev_text'    => esc_html__('<','SPICE'),
                           'next_text'    => esc_html__('>','SPICE'),
                        ));                                                      
                     ?>
                  </div>
                  <?php
                        }
                  ?>
               </article>
               <?php
                  if(is_singular())
                  {
               ?>
               <div class="page-comment-container clearfix">
                      <?php if ( ! post_password_required() ) comments_template( '', true );  ?>
               </div>
               <?php                 
                  }//comment 
                  if ( class_exists( 'woocommerce' ) ) 
                  {            
                     if(!is_cart() && !is_checkout() && !is_account_page() && $content_flag==0 && !is_singular() && $chef_flag==0 && spice_get_option('opt-single-page-sidebar')!=1)
                     { 

                        get_sidebar();        
                     } 
                  }
                  else
                  {
                     if($content_flag==0 && !is_singular() && $chef_flag==0 && spice_get_option('opt-single-page-sidebar')!=1)
                     {
                        get_sidebar(); 
                     }
                  }               
               ?>
            </div>
         </div>
      </section>
    
   </div>
   <!-- EVENT ends -->
</div>
<!-- WRAPPER ends -->
