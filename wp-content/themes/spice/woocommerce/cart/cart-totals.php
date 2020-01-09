<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="cart-totals-wrap">
	<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>
	
		<h3 class="heading-title"><?php esc_html_e( 'Order Totals', 'SPICE' ); ?></h3>

		<table cellspacing="0" class="cartTable">

			<tr class="cart-subtotal">
				<th><h5><?php esc_html_e( 'Cart Subtotal', 'SPICE' ); ?></h5></th>
				<td><p class="color"><strong><?php wc_cart_totals_subtotal_html(); ?></strong></p></td>
			</tr>

			<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><h5><?php esc_html_e( 'Coupon:', 'SPICE' ); ?> <?php echo esc_html( $code ); ?></h5></th>
					<td><p><?php wc_cart_totals_coupon_html( $coupon ); ?></p></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

				<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

				<?php wc_cart_totals_shipping_html(); ?>

				<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

			<?php endif; ?>

			<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
				<tr class="fee">
					<th><h5><?php echo esc_html( $fee->name ); ?></h5></th>
					<td><p><?php wc_cart_totals_fee_html( $fee ); ?></p></td>
				</tr>
			<?php endforeach; ?>

			<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
				<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
					<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
						<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
							<th><h5><?php echo esc_html( $tax->label ); ?></h5></th>
							<td><p><?php echo wp_kses_post( $tax->formatted_amount ); ?></p></td>
						</tr>
					<?php endforeach; ?>
				<?php else : ?>
					<tr class="tax-total">
						<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
						<td><?php echo wc_price( WC()->cart->get_taxes_total() ); ?></td>
					</tr>
				<?php endif; ?>
			<?php endif; ?>

			<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
				<tr class="order-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><h5><?php esc_html_e( 'Coupon:', 'SPICE' ); ?> <?php echo esc_html( $code ); ?></h5></th>
					<td><p><?php wc_cart_totals_coupon_html( $coupon ); ?></p></td>
				</tr>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

			<tr class="order-total">
				<th><h5><?php esc_html_e( 'Order Total', 'SPICE' ); ?></h5></th>
				<td><p class="color"><?php wc_cart_totals_order_total_html(); ?></p></td>
			</tr>

			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

		</table>

		<?php if ( WC()->cart->get_cart_tax() ) : ?>
			<p><small><?php

				$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' ' . __( ' (taxes estimated for %s)', 'SPICE' ), WC()->countries->estimated_for_prefix()) . sprintf(__('%s', 'SPICE'), WC()->countries->countries[ WC()->countries->get_base_country() ] )
					: '';

				printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'SPICE' ), $estimated_text );

			?></small></p>
		<?php endif; ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>