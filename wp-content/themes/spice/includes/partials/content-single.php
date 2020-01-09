<?php
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
            if(spice_get_option('opt-single-post-sidebar')==1)
            {
               $sidebar_class='sidebar-no';
            }
        }
        $post_id=get_the_ID();      
        global $authordata; 
        $page_class="wrapper wrapper-".get_the_ID();


        $order_cta=get_post_meta($post_id,'spice_cta_section_order_cta',true);
        $order_cta_title=get_post_meta($post_id,'spice_cta_section_title',true);
        $order_cta_content=get_post_meta($post_id,'spice_cta_section_content',true);
        $order_cta_button=get_post_meta($post_id,'spice_cta_section_button',true);
        $order_cta_url=get_post_meta($post_id,'spice_cta_section_url',true);
        if(!empty($order_cta))
        {
    ?>
      <!-- ============ PLACE ORDER ============= -->                    
             <div class="spice-cta">
              <div class="place-order clearfix">
                  <div class="desc">
                      <?php printf('%s',$order_cta_title); ?>
                  </div>                          
                  <?php printf('%s',$order_cta_content); ?>                 
                  <div class="order">
                      <a class="button white-btn scale-btn" href="<?php printf('%s',esc_url($order_cta_url)); ?>"><?php printf('%s',esc_html($order_cta_button)); ?></a>
                  </div>
              </div>    
          </div>
        <?php
          }
        ?>

<div <?php post_class($page_class); ?>>
<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay"></div>
   <div class="event-page">   
      <section class="main-content">
         <div class="container">
             <div class="row">
             <?php if ( have_posts() ) : the_post(); ?>
                   <article class="event-sectn <?php printf('%s',esc_attr($sidebar_class)); ?>">
                      <?php spice_breadcrumb(); ?>                       
                      <!-- ============= MAIN EVENT ================== -->
                      <div class="single-post-container">
                          <div class="main-event event clearfix">
                             <div class="corner-details">
                                <div class="corner-date"><?php echo get_the_date(); ?></div>                     
                             </div>                            
                             <div class="featured-image">
                             <?php

                                  $format=get_post_format();
                                  if($format==='')
                                  {
                                    $format='standard';
                                  }

                                  if($format!='gallery' && $format!='video')
                                  {

                                     if(has_post_thumbnail())
                                     {
                                           echo get_the_post_thumbnail(get_the_ID(),'spice-blog-single-image-size');
                                     }  
                                     else
                                     {
                              ?>
                                   <div class="imgLiquidFill imgLiquid no-image-style"></div>
                              <?php        
                                     }
                                  }

                                  if(get_post_format()== 'gallery')
                                  {
                                            $files = get_post_meta( get_the_ID(), 'spice_gallery_post_format_gallery',true);
                                            if($files != '')
                                            {
                              ?>
                                                  <div class="gallery_post_format">
                              <?php                                     
                                                       foreach ($files as $attachment_id => $attachment_url ) 
                                                       {
                                                          $thumb_url= wp_get_attachment_image_src($attachment_id,'spice-single-page-thumb');
                                                          $large_thumb_url= wp_get_attachment_image_src($attachment_id,'spice-single-page-thumb');
                              ?>
                                                      <div class="item"><a href="<?php echo $large_thumb_url[0]; ?>"><img src="<?php echo $thumb_url[0];?>"></a></div>
                              <?php 
                                                        } 
                              ?>
                                                  </div>
                              <?php 
                                            }
                                            else
                                            {
                                                 if(has_post_thumbnail())
                                                 {
                                                       echo get_the_post_thumbnail('spice-single-page-thumb');
                                                 }                                                  
                                            }                                    
                                }
                                if(get_post_format()== 'video')
                                {
                                  $files = get_post_meta( get_the_ID(), 'spice_video_post_format_video',true);                             
                              ?>
                                  <video width="100%" height="" controls>
                                    <source src="<?php echo esc_url($files); ?>" type="video/mp4">
                                    <source src="<?php echo esc_url($files); ?>" type="video/ogg">
                                  Your browser does not support the video tag.
                                  </video>
                              <?php

                                }
                             ?>   
                             </div>  
                             <div class="blog-content">
                                <h4 class="single-post-title"><?php the_title(); ?></h4>
                                <?php the_content();  ?>     
                                <?php wp_link_pages(array(
                                                            'before' => '<div class="nextpage">',
                                                            'after'       => '</div>',
                                                            'link_before' => '<span class="">',
                                                            'link_after'  => '</span>',
                                                          )
                                                    ); 
                                ?>              
                             </div>
                          </div>
                          <div class="blogmeta">
                                <?php echo spice_postinfo_meta(); ?>                       
                          </div>
                          <?php echo spice_SocialMeta(); ?>                         

                           <div class="author-box">                                
                                <div class="author-image">
                                    <?php echo get_avatar( get_the_author_meta( 'user_email' ),89);  ?>
                                </div>
                                <div class="author-description">
                                    <h3 class="about-author"><?php printf( __( 'ABOUT THE AUTHOR: <a class="author_name" href="%1$s">%2$s</a>', 'SPICE' ),esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),get_the_author() ); ?></h3>                                                         
                                    <?php the_author_meta( 'description' ); ?>
                                </div>                                            
                          </div>
                          <?php if ( ! post_password_required() ) comments_template( '', true ); ?>
                          <!-- ============= MAIN EVENT ends============== -->                                           
                      </div>
                   </article>

             <?php  endif; ?>
             <?php  
                   if(is_page() && spice_get_option('opt-single-page-sidebar')!=1)
                   {                             
                      get_sidebar();                  
                   }
                   if(is_single() && spice_get_option('opt-single-post-sidebar')!=1)
                   {
                      get_sidebar(); 
                   }   
             ?>
            </div>
         </div>
         <?php spice_render_videobackground( $post_id ); ?>
      </section>            
   </div>
   <!-- EVENT ends -->
</div>
<!-- WRAPPER ends -->
