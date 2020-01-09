<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>
<!-- <div class="container"> -->
<h5 class="cart-empty"><?php esc_html_e( 'Your cart is currently empty.', 'SPICE' ) ?></h5>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>
	<p class="return-to-shop grid2">
		<a class="button red-btn wc-backward btnStyle1 btnLarge withIcon red" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
			<span class="icon-basket btnIcon"></span>
			<span><?php esc_html_e( 'Return To Shop', 'SPICE' ) ?></span>
			<span class="btnAfter"></span>
			<span class="btnBefore"></span>
		</a>
	</p>
<!-- </div> -->