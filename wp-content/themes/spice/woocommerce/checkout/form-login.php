<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'SPICE' ) );
$info_message .= ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'SPICE' ) . '</a>';
?>
<div class="panel panel-default panel-methods">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#panelMethods"><?php esc_html_e('Checkout Options','SPICE'); ?></a>
		</h4>
	</div>
	<div id="panelMethods" class="panel-collapse collapse in">
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-6">
						<h3><?php esc_html_e( 'Login','SPICE'); ?></h3>
						<?php
							woocommerce_login_form(
								array(
									'message'  => esc_html__( 'If you have already shopped with us, please logged in. If you are a new customer please proceed to the next sections bellow.', 'SPICE' ),
									'redirect' => wc_get_page_permalink( 'checkout' ),
									'hidden'   => false,

							)
						);
						?>
				</div>
				<div class="col-xs-6">
							<h3><?php esc_html_e( 'New Customer','SPICE'); ?></h3>
							<div class="login-regis text-strong">
								<p style="margin-bottom:5px;"><input type="radio" class="spice-checkout-method" name="spice-checkout-method" checked="" value="0"><?php esc_html_e('Checkout as Guest','SPICE'); ?></p>
								<p><input type="radio" class="spice-checkout-method" name="spice-checkout-method" value="1"><?php esc_html_e( 'Create an Account with Us','SPICE'); ?></p>
							</div>
							<div class="description text-strong">
								<span><?php esc_html_e('Register with us for future convenience:','SPICE'); ?></span>
								<ul>
									<li><?php esc_html_e('+ Fast and easy checkout.','SPICE'); ?></li>
									<li><?php esc_html_e('+ Easy access to your dorder history and status.','SPICE'); ?></li>
								</ul>
							</div>
							<input type="button" value="Continue" name="button_create_account_continue" class="button_create_account_continue" data-acc="panelBilling">
				</div>	

			</div>
			
			</div>
		</div>
	</div>
