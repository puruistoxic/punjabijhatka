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
        }
        $post_id=get_the_ID();
        $event_date=date('jS M Y',strtotime(get_post_meta($post_id,'spice_event_date',true)));
        $event_start_time=get_post_meta($post_id,'spice_event_start_time',true);        
        $event_end_time=get_post_meta($post_id,'spice_event_end_time',true);
        $event_poster=get_post_meta($post_id,'spice_event_poster',true);     
?>
<div <?php post_class('wrapper'); ?>>
   <div class="event-page">   
      <section class="main-content">
         <div class="container">
         <?php if ( have_posts() ) : the_post(); ?>

             <div class="row">
               <article class="event-sectn <?php printf('%s',esc_attr($sidebar_class)); ?>">
                  <?php spice_breadcrumb(); ?>                       
                  <!-- ============= MAIN EVENT ================== -->
                <div class="main-event event clearfix">
                            <div class="corner-details">
                              <div class="corner-date"><?php printf(__('%s','SPICE'),esc_html($event_date)); ?></div>
                              <div class="corner-time"><i class="fa fa-clock-o"></i><?php printf(__('%s - %s','SPICE'),esc_html($event_start_time),esc_html($event_end_time)); ?></div>
                            </div>                          
                           <!-- <h4>names will go here</h4> -->
                          <div class="imgLiquidFill imgLiquid singleEventPoster">
                              <img src="<?php printf('%s',$event_poster); ?>" alt="">
                          </div>
                          <h3 class="blog-list-title"><?php the_title(); ?></h3>
                          <?php the_content(); ?>
                         <!--   <a class="button red-btn" href="#">JOIN THIS EVENT</a> -->
                        </div>
                        <?php
                            $dt=date('Y-m-d');
                            $end_date=date("Y-m-t", strtotime($dt));                           
                            $query_args['post_type']='event';
                            $query_args['meta_key']='spice_event_date';
                            $query_args['orderby']='meta_value';
                            $query_args['order']='ASC';
                            $query_args['meta_query']=array(
                                                                  array(
                                                                      'key'     => 'spice_event_date',
                                                                      'value'   =>  array( DATE($dt),DATE($end_date)),
                                                                      'compare' => 'BETWEEN',
                                                                      'type'  => 'DATE',
                                                                     
                                                                  ),
                                                               );
                              $monthly_events_query = new WP_Query( $query_args );
                                                         

                        ?>

                        <!-- ============= MAIN EVENT ends============== -->
                        <div class="monthly-events-section clearfix">
                           
                           <?php
                                  if($monthly_events_query->have_posts())
                                  {
                           ?>
                              <h4><?php  esc_html_e('Event of this month','SPICE'); ?> (<?php printf(__('%s','SPICE'),date('F')); ?>)</h4>
                           <?php
                                  }
                           ?>
                           <!-- ============ MONTHLY EVENTS ================== -->
                          <?php
                              while($monthly_events_query->have_posts()) : $monthly_events_query->the_post();

                              $event_date=date('jS',strtotime(get_post_meta(get_the_ID(),'spice_event_date',true)));
                              $event_start_time=get_post_meta(get_the_ID(),'spice_event_start_time',true);        
                              $event_end_time=get_post_meta(get_the_ID(),'spice_event_end_time',true);
                              $event_poster=get_post_meta(get_the_ID(),'spice_event_poster',true);   


                          ?>  
                           <div class="month-events event clearfix">
                              <div class="corner-details">
                                <div class="corner-date"><?php printf(__('%s','SPICE'),esc_html($event_date)); ?></div>
                                <div class="corner-time"><i class="fa fa-clock-o"></i><?php printf(__('%s - %s','SPICE'),esc_html($event_start_time),esc_html($event_end_time)); ?></div>
                              </div>

                              <h3 class="blog-list-title"><?php the_title(); ?></h3>
                              <?php printf('%s',spice_get_the_excerpt(30));?>
                              <a class="white-btn button" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read More','SPICE'); ?></a>
                           </div>
                          <?php
                              endwhile;
                          ?>
                           
                           <!-- ============ MONTHLY EVENTS ends============== -->


                        </div>
                        <div class="featured-events">

                          
                          <?php
                              $dt=date('Y-m-d');
                              $query_args['post_type']='event';
                              $query_args['meta_key']='event_featured';
                              $query_args['orderby']='meta_value_num';
                              $query_args['order']='ASC';
                              $query_args['meta_query']=array(
                                                                    array(
                                                                        'key'     => 'event_featured',
                                                                        'value'   =>  '1',
                                                                        'compare' => '=',                                                                       
                                                                       
                                                                    ),
                                                                 );
                              $featured_query = new WP_Query( $query_args );
                              if($featured_query->have_posts())
                              {
                          ?>
                                 <h4><?php  esc_html_e('Featured Event','SPICE'); ?></h4>
                          <?php
                              }
                              while($featured_query->have_posts()) : $featured_query->the_post();  
                              $event_date=date('jS M,Y',strtotime(get_post_meta(get_the_ID(),'spice_event_date',true)));
                              $event_start_time=get_post_meta(get_the_ID(),'spice_event_start_time',true);        
                              $event_end_time=get_post_meta(get_the_ID(),'spice_event_end_time',true);
                              $event_poster=get_post_meta(get_the_ID(),'spice_event_poster',true);   

                          ?>
                                  
                           <!-- ============ FEATURED EVENTS ================== -->
                               <div class="feature-events clearfix">
                                  <div class="figure">
                                     <div class="imgLiquidFill imgLiquid" >
                                        <img src="<?php printf('%s',$event_poster); ?>" alt="">
                                        <div class="shine"></div>
                                     </div>
                                  </div>
                                  <div class="figcaption event">
                                      <div class="corner-details">
                                        <div class="corner-date"><?php printf(__('%s','SPICE'),esc_html($event_date)); ?></div>
                                        <div class="corner-time"><i class="fa fa-clock-o"></i><?php printf(__('%s - %s','SPICE'),esc_html($event_start_time),esc_html($event_end_time)); ?></div>
                                      </div>

                                     <h3 class="blog-list-title"><?php the_title(); ?></h3>
                                     <?php printf('%s',spice_get_the_excerpt(50));?>
                                     <a class="button" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read More','SPICE'); ?></a>
                                  </div>
                               </div>
                          <?php
                              endwhile;
                          ?>

                           <!-- ============= FEATURED EVENTS ends============== -->
                        </div>                                
                  <!-- ============= MAIN EVENT ends============== -->                                           
               </article>

         <?php  endif; ?>
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

        </div>


         </div>
      </section>            
   </div>
   <!-- EVENT ends -->
</div>
<!-- WRAPPER ends -->
