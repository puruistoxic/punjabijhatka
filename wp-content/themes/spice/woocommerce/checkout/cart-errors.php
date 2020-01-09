<?php
/**
 * Cart errors page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php wc_print_notices(); ?>

<h5><?php esc_html_e('There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'SPICE' ) ?></h5>

<?php do_action( 'woocommerce_cart_has_errors' ); ?>
<p class="return-to-shop grid2">
	<a class="button wc-backward btnStyle1 btnLarge withIcon red" href="<?php echo get_permalink(wc_get_page_id( 'cart' ) ); ?>">
		<span class="icon-basket btnIcon"></span>
		<span><?php esc_html_e('Return To Cart', 'SPICE' ) ?></span>
		<span class="btnAfter"></span>
		<span class="btnBefore"></span>
	</a>
</p>