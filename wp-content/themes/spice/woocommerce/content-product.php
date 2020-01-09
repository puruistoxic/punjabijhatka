<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
{
	$woocommerce_loop['loop'] = 0;
}
// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
{
  $grid_no=spice_get_option('opt-grid-number'); 
  switch($grid_no)
  {

    case 1: $woocommerce_loop['columns']=2;
        break;

    case 2 :
       $woocommerce_loop['columns']=3;
        break;

    case 3: $woocommerce_loop['columns']=4;
        break;

  } 

}

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) 
{
  $classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) 
{
  $classes[] = 'last';
}

$currency=get_woocommerce_currency_symbol();
$classes[]='own';
$classes[]='veg';
$classes[]='shop_list_items';

?>

<li <?php post_class($classes); ?>>
      <?php 
          do_action( 'woocommerce_before_shop_loop_item' ); 
          $price = get_post_meta( get_the_ID(), '_regular_price',true);          
          $sale_price = get_post_meta( get_the_ID(), '_sale_price', true);  
          global $product;         
          $avg_rating= intval($product->get_average_rating());
          $r_count=$product->get_rating_count();
          $cats=$product->get_categories(' / ');       
          
      ?>
	    <div class="search-menu-items  clearfix">
            <figure>
             <?php

                if ( ! $product->is_in_stock() )
                  {
                    ?>
                    <div class="onsale product_label">
                        <span class="product_label">
                    <?php
                     esc_html_e( 'out of stock', 'SPICE' );
                    ?>
                        </span>
                    </div>
                    <?php
                  }
                  else if( $product->is_on_sale() )
                  {

                    ?>
                      <div class="onsale product_label">
                        <span class="product_label">
                    <?php
                      echo apply_filters( 'woocommerce_sale_flash',  esc_html__( 'Sale!', 'SPICE' ) );
                    ?>
                        </span>
                    </div>
                    <?php
                  }

             ?>
             <?php echo woocommerce_get_product_thumbnail(); ?>
            </figure>
            <div class="figcaption clearfix">
               <div>
                  <h3>
                    <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                    <?php 
                          if ( ! function_exists( 'is_plugin_active' ) )
                          {
                              require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
                          }
                          if(is_plugin_active('yith-woocommerce-wishlist/init.php'))
                          {
                            echo do_shortcode('[yith_wcwl_add_to_wishlist link_classes="add_to_wishlist" icon="fa-heart-o" label="" already_in_wishslist_text="" browse_wishlist_text="<i class=\'fa fa-heart in_wishlist\'></i> " product_added_text=""]'); 
                          }

                    ?> 
                  </h3>              
                 <div>
                    <h6>Ingredients</h6>
                    <p><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?></p>
                    <div class="product_cat"><?php printf('%s',$product->get_categories(' / ')); ?></div>
                    <div class="rating">
                      <?php 
                      if ( $avg_rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) 
                      { 
                      ?>                      
                        <span class="rating-stars"><?php printf('%s',$product->get_rating_html()); ?></span>
                        <span class="rating-count"><?php printf('(%s)', esc_html($r_count) ); ?></span>
                      <?php 
                      }
                      //rating section ?>
                    </div>
                    
                 </div>

               </div>
              <div class="clearfix product-footer price-add-select">              
                <h2 class="salePrice">                 
                  <?php printf('%s',$product->get_price_html()); ?>
                </h2>
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>                
              </div>
            </div>
      </div>

      

</li>