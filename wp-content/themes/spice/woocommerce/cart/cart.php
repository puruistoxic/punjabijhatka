<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

?> 

	<?php do_action( 'woocommerce_before_cart' ); ?>
	<div class="row">
		<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" class="col-xs-12" method="post">

		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="cart-table shop_table cart" cellspacing="0">
			<thead>
				<tr>
					
					<th class="product-thumbnail" colspan="2"><h5><?php esc_html_e( 'Items', 'SPICE' ); ?></h5></th>
					<th class="product-price"><h5><?php esc_html_e( 'Price', 'SPICE' ); ?></h5></th>
					<th class="product-quantity"><h5><?php esc_html_e( 'Quantity', 'SPICE' ); ?></h5></th>
					<th class="product-total"><h5><?php esc_html_e( 'Total', 'SPICE' ); ?></h5></th>
					<th class="product-remove"><h5><?php esc_html_e('Remove','SPICE'); ?></h5></th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							

							<td class="product-thumbnail">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('spice-cart_item_image_size'), $cart_item, $cart_item_key );

									if ( ! $_product->is_visible() )
									{
										printf('%s',$thumbnail);
										
									}
									else
									{
										printf( __('<a href="%s">%s</a>','SPICE'), $_product->get_permalink(), $thumbnail );
									}
								
								?>
							</td>
							<td class="product-excerpt">
							<h4><?php	echo $_product->get_title() .' <small>x</small> '. $cart_item['quantity'];	?></h4>
							<?php echo $_product->post->post_excerpt;?>
							
							</td>			

							<td class="product-price">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</td>

							<td class="product-quantity">
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										), $_product, false );
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
								?>
							</td>

							<td class="product-total">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</td>

							<td class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', 
										sprintf( '<a href="%s" class="remove" title="%s">
											<i class="fa fa-times-circle"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'SPICE' ) ), $cart_item_key );
								?>
							</td>
						</tr>
						<?php
					}
				}
				do_action( 'woocommerce_cart_contents' );
				?>
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>

		<div class="cart-navigation clearfix">
			<div class="pull-right">
				<?php $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );	?>
					<a href="<?php echo esc_url($shop_page_url); ?>" class="button red-btn ctn-shop">
					<?php esc_html_e( 'Continue Shopping', 'SPICE' ); ?>
					</a>
					<input type="submit" class="button red-btn" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'SPICE' ); ?>" />
			</div>
			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>	
			
		<?php do_action( 'woocommerce_after_cart_table' ); ?>

		</form>
	</div>
	
	<div class="after-cart-section row">
	<?php if ( WC()->cart->coupons_enabled() ) { ?>
	<form  method="post" class="cuppon-code-wrap col-md-4">	
		<div class="coupon_wrapper">			
			<div class="coupon">
				<div class="wd_title_cart"><h3 for="coupon_code" class="heading-title"><?php esc_html_e('Discount code','SPICE'); ?></h3></div>
				<div class="content_coupon">
					<p><?php esc_html_e('Enter your coupon code if your have one','SPICE'); ?></p>
					<div class="form-group">
							<input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="<?php esc_html_e('Coupon code', 'SPICE' ); ?>" /> 
					</div>				
					<input type="submit" class="button red-btn" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'SPICE' ); ?>" />
					<?php do_action( 'woocommerce_cart_coupon' ); ?>

				</div>
			</div>
		</div>
	</form>
	<?php } ?>
	<div class="col-md-4">
		<?php woocommerce_shipping_calculator(); ?>	
	</div>
	<div class="col-md-4">
		<?php do_action( 'woocommerce_cart_collaterals' ); ?>			
		<?php spice_button_proceed_to_checkout(); ?>
	</div>
	</div>
	
	<?php do_action( 'woocommerce_after_cart' ); ?>
