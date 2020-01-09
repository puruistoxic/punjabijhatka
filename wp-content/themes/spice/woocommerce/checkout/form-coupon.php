<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( ! WC()->cart->coupons_enabled() )
	return;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'SPICE' ) );
$info_message .= ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'SPICE' ) . '</a>';
if(!is_checkout())
{
?>
<div class="checkoutCoupon">	
	<?php wc_print_notice( $info_message, 'notice' ); ?>
	<div class="span12">
		<form class="checkout_coupon clearfix" method="post" style="display:none">
			
			<p class="form-row form-row-first">
				<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_html_e( 'Coupon code', 'SPICE' ); ?>" id="coupon_code" value="" />
			</p>
			
			<p class="form-row form-row-last">
				<button type="submit" class="button btnStyle2 red" name="apply_coupon">
					<span><?php esc_html_e( 'Apply Coupon', 'SPICE' ); ?></span>
					<span class="btnAfter"></span>
					<span class="btnBefore"></span>
				</button>
			</p>
		</form>
	</div>
</div>
<?php
}
?>

