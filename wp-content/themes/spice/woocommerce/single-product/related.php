<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array( $product->id )
) );

$products = new WP_Query( $args );

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

if ( $products->have_posts() ) : ?>

	<div class="related products clearfix">
		<div class="singleSeparators">
			<hr>
			<hr>
		</div>
		<h3>
			<div class="headerDot">
				<span class="icon-right-open-mini"></span>
			</div><?php esc_html_e( 'Related Products', 'SPICE' ); ?>
		</h3>		
		<?php woocommerce_product_loop_start(); ?>
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
			<?php endwhile; // end of the loop. ?>
		<?php woocommerce_product_loop_end(); ?>		
	</div>

<?php endif;

wp_reset_postdata();
