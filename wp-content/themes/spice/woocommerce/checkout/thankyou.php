<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>
<div class="deliveredOrder">
	<?php if ( $order ) : ?>
		<div class="container">
			<?php if ( in_array( $order->status, array( 'failed' ) ) ) : ?>
				<p><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'SPICE' ); ?></p>

				<p><?php
					if ( is_user_logged_in() )
						esc_html_e('Please attempt your purchase again or go to your account page.', 'SPICE' );
					else
						esc_html_e('Please attempt your purchase again.', 'SPICE' );
				?></p>

				<p>
					<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e('Pay', 'SPICE' ) ?></a>
					<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ); ?>" class="button pay"><?php esc_html_e('My Account', 'SPICE' ); ?></a>
					<?php endif; ?>
				</p>
			<?php else : ?>

				<p><?php esc_html_e('Thank you. Your order has been received.', 'SPICE' ); ?></p>

				<ul class="order_details">
					<li class="order">
						<?php esc_html_e('Order:', 'SPICE' ); ?>
						<strong><?php echo $order->get_order_number(); ?></strong>
					</li>
					<li class="date">
						<?php esc_html_e('Date:', 'SPICE' ); ?>
						<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
					</li>
					<li class="total">
						<?php esc_html_e('Total:', 'SPICE' ); ?>
						<strong><?php echo $order->get_formatted_order_total(); ?></strong>
					</li>
					<?php if ( $order->payment_method_title ) : ?>
					<li class="method">
						<?php esc_html_e('Payment method:', 'SPICE' ); ?>
						<strong><?php echo $order->payment_method_title; ?></strong>
					</li>
					<?php endif; ?>
				</ul>
				<div class="clear"></div>

			<?php endif; ?>
		</div>
		
			<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
		
			<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
		

	<?php else : ?>

		<p><?php esc_html_e('Thank you. Your order has been received.', 'SPICE' ); ?></p>

	<?php endif; ?>
</div>