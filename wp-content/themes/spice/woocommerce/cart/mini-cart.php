<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>
					<li>
						<a href="<?php echo get_permalink( $product_id ); ?>">
							<div class="miniThumbnail">
								<?php echo $thumbnail ?>
							</div>
							<div class="miniDetails">
								<h6><?php echo $product_name; ?></h6>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<p class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</p>', $cart_item, $cart_item_key ); ?>
							</div>
						</a>
					</li>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php esc_html_e( 'No products in the cart.', 'SPICE' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->
<div class="miniTotal">
<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
	
		<h6 class="total"><?php esc_html_e( 'Subtotal', 'SPICE' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></h6>
	

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
	<div class="buttons">
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button wc-forward btnStyle1 red withIcon"><span class="btnIcon icon-cog"></span><span><?php esc_html_e( 'View Cart', 'SPICE' ); ?></span><span class="btnBefore"></span><span class="btnAfter"></span></a>
		<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout wc-forward btnStyle1 red withIcon"><span class="btnIcon icon-forward-1"></span><span><?php esc_html_e( 'Checkout', 'SPICE' ); ?></span><span class="btnBefore"></span><span class="btnAfter"></span></a>
	</div>

<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>