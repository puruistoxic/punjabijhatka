<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() )
	return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>
<div class="shipping_calculator_wrapper">
	<form class="shipping_calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

		<h3 class="heading-title"><?php esc_html_e('Calculate Shipping', 'SPICE' ); ?></h3>

		<section class="shipping-calculator-form">

			<div class="form-group">
				<span class="icon-down-open"></span>
				<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state form-control" rel="calc_shipping_state">
					<option value=""><?php esc_html_e('Select a country&hellip;', 'SPICE' ); ?></option>
					<?php
						foreach( WC()->countries->get_shipping_countries() as $key => $value )
							echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					?>
				</select>
			</div>

			<div class="form-group">
				<?php
					$current_cc = WC()->customer->get_shipping_country();
					$current_r  = WC()->customer->get_shipping_state();
					$states     = WC()->countries->get_states( $current_cc );

					// Hidden Input
					if ( is_array( $states ) && empty( $states ) ) {

						?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_html_e('State / county', 'SPICE' ); ?>" /><?php

					// Dropdown Input
					} elseif ( is_array( $states ) ) {
						?><span>
							<select name="calc_shipping_state" class="form-control" id="calc_shipping_state" placeholder="<?php esc_html_e('State / county', 'SPICE' ); ?>">
								<option value=""><?php esc_html_e('Select a state&hellip;', 'SPICE' ); ?></option>
								<?php
									foreach ( $states as $ckey => $cvalue )
										echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' .  esc_html( $cvalue ) .'</option>';
								?>
							</select>
						</span><?php

					// Standard Input
					} else {

						?><input type="text" class="input-text form-control" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_html_e('State / county', 'SPICE' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php

					}
				?>
			</div>

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

				<div class="form-group">
					<input type="text" class="input-text form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_html_e('City', 'SPICE' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
				</div>

			<?php endif; ?>

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

				<div class="form-group">
					<input type="text" class="form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_html_e('Postcode / Zip', 'SPICE' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
				</div>

			<?php endif; ?>

			<div><button type="submit" name="calc_shipping" value="1" class="calc_shipping button"><span><?php esc_html_e('Update Totals', 'SPICE' ); ?></span><span class="btnAfter"></span><span class="btnBefore"></span></button></div>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</section>
	</form>
</div>
<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>