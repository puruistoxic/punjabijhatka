 <div class="">
            <div class="feature-events clearfix">
               <div class="figure">
                 <?php
                        echo get_avatar( get_the_author_meta( 'user_email' ),200);
                  ?>                             
               </div>
               <div class="figcaption author">                                                      
                  <h3 class="about-author"><?php printf( __( 'About %s', 'SPICE' ), get_the_author() ); ?></h3>                                                         
                  <p><?php the_author_meta( 'description' ); ?></p>                           
               </div>
            </div>            
</div>