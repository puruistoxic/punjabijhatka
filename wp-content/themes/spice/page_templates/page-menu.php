<?php
		/*
		Template Name: Menu
		*/
    if ( class_exists( 'WooCommerce' ) ) 
    {
      global $woocommerce_loop;
      global $woocommerce;
    }
    
		if(empty($is_home_page))
		{
			get_header();
		}
		$post_id=get_the_ID();
		$menu_product_categories=get_post_meta($post_id,'spice_menu_page_product_cetegories',true);
    $menu_page_filter=get_post_meta($post_id,'spice_menu_page_filter',true);
    $menu_list=spice_get_woocommerce_cats($menu_product_categories);
    $page_sub_title=get_post_meta($post_id,'spice_page_subtitle',true)==''?sprintf(esc_html__('Our Special Menus','SPICE')):get_post_meta($post_id,'spice_page_subtitle',true);

    $attribute_taxonomies = wc_get_attribute_taxonomies();

    /*****  PARALLAX SETTINGS ******/
    $parallax_settings=get_post_meta( $post_id, 'spice_page_bg_style', true )=='3'?1:0;
    $data_steller='';
    if($parallax_settings==1)
    {
      $bg_ratio=intval(get_post_meta($post_id, 'spice_page_bg_ratio', true ))/100 ;
      $parallax_vertical_offset=get_post_meta( $post_id, 'spice_page_bg_vertical_ratio', true )  !='' ? (esc_attr( get_post_meta( $post_id, 'spice_page_bg_vertical_ratio', true ) )) : "500";        
      $bg_vertical_offset=intval($parallax_vertical_offset);    
      $data_steller='data-stellar-background-ratio='.$bg_ratio.' data-stellar-vertical-offset='.$bg_vertical_offset;  
    } 


    /*******************************/

		$pagequery =new WP_Query('page_id='.$post_id);		
	  if ( $pagequery->have_posts() ) : while ( $pagequery->have_posts() ) : $pagequery->the_post();		
 
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
			
      <div class="wrapper page-wrapper-<?php echo get_the_ID(); ?>">      
      	<div id="page-<?php echo get_the_ID(); ?>" class="static-overlay" <?php echo esc_attr($data_steller); ?>></div>		
        <div class="menu-page">
          <!-- <section class="banner" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="-50"> -->
          <section class="main-content">
            <div class="container">


              <div class="food-options-form">
                <div class="caption">
                  <!-- <h3><?php the_title(); ?></h3> -->
                  <h4 class="page-sub-title-<?php echo get_the_ID(); ?>"><?php printf('%s',esc_html($page_sub_title));?></h4>
                  <h6><?php the_content(); ?></h6> 
                </div>               
                <div class="options-button clearfix">
                  
                  <div class="form-btn-area clearfix">
                    <div class="no-of-dishes"> 
                    <?php
                    
                    if ( class_exists( 'WooCommerce' ) ) 
                    {
                      if(spice_get_option('opt-cart-off')==0)
                      {
                  ?>                     
                      <div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/chef-hat-icon-grey.png" height="40" width="41" alt="">
                        <span class="selected-dishes-no-new">
                         <?php echo sprintf(__('%d','SPICE'), $woocommerce->cart->cart_contents_count);?>
                        </span>
                      </div>
                       <?php  esc_html_e('Total Amount','SPICE'); ?>: 
                            <?php printf(__('%s','SPICE'),$woocommerce->cart->get_cart_total()); ?>
                      <?php

                      }
                    }

                ?>
                     
                    </div>                   
                  </div>
                </div>
               
                <!-- -->
              </div>
             
              <!-- ============= SEARCH-MENU-LIST ================== -->

              <?php

                if ( class_exists( 'WooCommerce' ) ) 
                {

                  foreach($menu_list as $k=>$menu)
                  {

                      $args = array(  'post_type' => 'product', 
                                'orderby' => 'date', 
                                'order'   => 'DESC', 
                                  'tax_query'=> array(
                                              array(
                                                'taxonomy'=>'product_cat',
                                                'field'=> 'id',
                                                'terms'=>$k
                                              )
                                            ) 
                              );
                        
                      $menu_posts = new WP_Query( $args ); 


              ?>
                      <article class="search-menu-list brkfast block-<?php echo esc_attr($menu['slug']); ?> ">
                        <div class="head">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/food-menu-icon.png" alt="">
                          <h2><?php printf('%s',esc_html($menu['slug'])); ?></h2>                          
                        </div>
                        <div class="menu-items-wrapper" >
                          <ul class="owl-carousel-menu slider-<?php echo esc_attr($menu['slug']); ?> clearfix">
                            <!-- ============= SEARCH-MENU-LIST =============== -->
                              <?php 
                                    while ( $menu_posts->have_posts() ) : $menu_posts->the_post(); 
                                      global $post;
                                      global $product; 
                              ?>
                                <li id="product-<?php the_ID(); ?>" data-name='Red Velvet Cupcakes' data-price='12.49' class="own veg" data-id="food-1">
                                  <div class="search-menu-items clearfix clearfix">
                                    <figure>
                                     <?php echo woocommerce_get_product_thumbnail('large'); ?>
                                    </figure>
                                    <div class="figcaption clearfix">
                                       <div>
                                         <a href="<?php echo $product->get_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
                                         <p><?php the_excerpt(); ?></p>
                                         <div>
                                            <h6><?php  esc_html_e('Ingredients','SPICE'); ?></h6>
                                            <p><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?></p>
                                            <?php 
                                                  if($product->get_rating_html()!='')
                                                  {
                                            ?>
                                            <!-- <h6><?php  esc_html_e('Customer Review','SPICE'); ?></h6> -->
                                            <div class="rating">                                          
                                              <span class="rating-stars"><?php printf('%s',$product->get_rating_html()); ?></span>
                                            </div>
                                            <?php
                                                  }                                                  
                                            ?>
                                         </div>
                                       </div>
                                      <div class="price-add-select clearfix">
                                        <?php
                                            if(spice_get_option('opt-cart-off')==0)
                                            {
                                        ?>
                                        <a class="button white-btn clicked" href="<?php echo do_shortcode('[add_to_cart_url id="'.get_the_ID().'"]'); ?>">
                                          <span class="desk"><?php  esc_html_e('Add to Cart','SPICE'); ?></span>
                                          <span class="mob"><i class="fa fa-check"></i></span>
                                        </a> 
                                        <?php
                                            }
                                        ?>                                                                              
                                        <h2><?php printf('%s',$product->get_price_html()); ?></h2>
                                      </div>
                                    </div>
                                  </div>
                                </li>  
                              <?php
                                    endwhile;
                                    wp_reset_query(); 
                              ?>                        
                            <!-- ============================================== -->
                          </ul>
                          <div class="nav-btns">
                            <a class="left-btn" href="javascript:void(0)"><i class="fa fa-angle-left"></i></a>
                            <a class="right-btn" href="javascript:void(0)"><i class="fa fa-angle-right"></i></a>
                          </div>
                        </div>
                      </article>
              <?php
                  }
                }
              ?>            
              

            </div>
            <!-- CONTAINER ends -->
          </section>
       
        </div>
        <!-- EVENT ends -->        
      </div>
<?php
		endwhile;endif;
		if(empty($is_home_page))
		{
			get_footer();
		}
?>