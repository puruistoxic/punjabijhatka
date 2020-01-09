<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();





// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) 
{
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'SPICE' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<div class="panel-group checkout-panel" id="accordion">
			<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
		<!-- Accordian Starts Here -->	
		
		
			<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

			<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

				<div class="panel panel-default panel-register" style="display: none">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#panelRegister"><?php esc_html_e( 'Create Account','SPICE'); ?></a>
						</h4>
					</div>
					<div id="panelRegister" class="panel-collapse panel-next collapse">
						<div class="panel-body">	
							


							<?php if ( $checkout->enable_guest_checkout ) : ?>

								<p class="form-row form-row-wide create-account">
									<input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" />
									<label for="createaccount" class="checkbox"><?php esc_html_e( 'Create an account?', 'SPICE' ); ?></label>
								</p>

							<?php endif; ?>

							<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

							<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

								<div class="create-account">

									<p><?php esc_html_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'SPICE' ); ?></p>

									<?php 											

										foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

										<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

									<?php endforeach; ?>

									<div class="clear"></div>

								</div>

							<?php endif; ?>

							<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
							<input type="button" value="Continue" name="button_billing_continue" class="button_billing_continue" data-acc="panelBilling">

						</div>
					</div>
				</div>

			<?php endif; ?>

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#panelBilling">
					<?php esc_html_e( 'Billing Details', 'SPICE' ); ?></a>
					</h4>
				</div>
				<div id="panelBilling" class="panel-collapse panel-next collapse">
					<div class="panel-body">						
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
						<input type="button" value="Continue" name="button_shipping_address_continue" class="button_shipping_address_continue" data-acc="panelShipping">
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#panelShipping">
						<?php esc_html_e( 'Shipping Details', 'SPICE' ); ?></a>
					</h4>
				</div>
				<div id="panelShipping" class="panel-collapse panel-next  collapse">
					<div class="panel-body">
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
							<input type="button" value="Continue" name="button_your_order_continue" class="button_your_order_continue" data-acc="panelOrder">
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#panelOrder">
						<?php esc_html_e( 'Your Order', 'SPICE' ); ?></a>
					</h4>
				</div>
				<div id="panelOrder" class="panel-collapse panel-next collapse">
					<div class="panel-body">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>
				</div>
			</div>


		
		<!-- Accordian Ends Here -->
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>		

	<?php endif; ?>	
	

</form>

</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
