<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$order = wc_get_order( $order_id );

?><table class="cart-table shop_table cart" cellspacing="0">
<thead>
	<tr>

		<th class="product-thumbnail" colspan="2"><h5><?php esc_html_e( 'Items', 'SPICE' ); ?></h5></th>
		<th class="product-price"><h5><?php esc_html_e( 'Price', 'SPICE' ); ?></h5></th>
		<th class="product-quantity"><h5><?php esc_html_e( 'Quantity', 'SPICE' ); ?></h5></th>
		<th class="product-total"><h5><?php esc_html_e( 'Total', 'SPICE' ); ?></h5></th>					
	</tr>
</thead>
<tbody>
	<?php
	if ( sizeof( $order->get_items() ) > 0 ) {

		foreach( $order->get_items() as $item_id => $item ) {
			$_product  = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
			$item_meta = new WC_Order_Item_Meta( $item['item_meta'], $_product );
			$price = get_post_meta( $_product->id, '_sale_price', true);	

			if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
					<td class="product-thumbnail" width="70">
						<?php								
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('spice-cart_item_image_size'));

						if ( ! $_product->is_visible() )
						{
							echo $thumbnail;

						}
						else
						{
							printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
						}
						?>
					</td>
					<td class="product-excerpt">
						<h4>
							<?php			


							if ( $_product && ! $_product->is_visible() ) {
								echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
							} else {
								echo apply_filters( 'woocommerce_order_item_name', sprintf( __('<a href="%s">%s</a>','SPICE'), get_permalink( $item['product_id'] ), $item['name'] ), $item );
							}								

								// Allow other plugins to add additional product information here
							do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

							$item_meta->display();

							if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

								$download_files = $order->get_item_downloads( $item );
								$i              = 0;
								$links          = array();

								foreach ( $download_files as $download_id => $file ) {
									$i++;

									$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'SPICE' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
								}

								echo '' . implode( '', $links );
							}

								// Allow other plugins to add additional product information here
							do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
							?>
						</h4>
					</td>

					<td class="product-price">
						<?php printf("%s",esc_html($price)); ?>
					</td>
					<td class="product-quantity">
						<?php
						echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf(__(' %s','SPICE'), $item['qty'] ) . '</strong>', $item );

						?>
					</td>
					<td class="product-total">
						<?php echo $order->get_formatted_line_subtotal( $item ); ?>
					</td>
				</tr>
				<?php
			}

			if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
				?>
				<tr class="product-purchase-note">
					<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
				</tr>
				<?php
			}
		}
	}

	do_action( 'woocommerce_order_items_table', $order );
	?>
</tbody>
</table>
<br>
<table class="table">
	<tbody>
		<?php
		$has_refund = false;

		if ( $total_refunded = $order->get_total_refunded() ) {
			$has_refund = true;
		}

		if ( $totals = $order->get_order_item_totals() ) {
			foreach ( $totals as $key => $total ) {
				$value = $total['value'];

				// Check for refund
				if ( $has_refund && $key === 'order_total' ) {
					$refunded_tax_del = '';
					$refunded_tax_ins = '';

					// Tax for inclusive prices
					if ( wc_tax_enabled() && 'incl' == $order->tax_display_cart ) {

						$tax_del_array = array();
						$tax_ins_array = array();

						if ( 'itemized' == get_option( 'woocommerce_tax_total_display' ) ) {

							foreach ( $order->get_tax_totals() as $code => $tax ) {
								$tax_del_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
								$tax_ins_array[] = sprintf( '%s %s', wc_price( $tax->amount - $order->get_total_tax_refunded_by_rate_id( $tax->rate_id ), array( 'currency' => $order->get_order_currency() ) ), $tax->label );
							}

						} else {
							$tax_del_array[] = sprintf( '%s %s', wc_price( $order->get_total_tax(), array( 'currency' => $order->get_order_currency() ) ), WC()->countries->tax_or_vat() );
							$tax_ins_array[] = sprintf( '%s %s', wc_price( $order->get_total_tax() - $order->get_total_tax_refunded(), array( 'currency' => $order->get_order_currency() ) ), WC()->countries->tax_or_vat() );
						}

						if ( ! empty( $tax_del_array ) ) {
							$refunded_tax_del .= ' ' . sprintf( __( '(Includes %s)', 'SPICE' ), implode( ', ', $tax_del_array ) );
						}

						if ( ! empty( $tax_ins_array ) ) {
							$refunded_tax_ins .= ' ' . sprintf( __( '(Includes %s)', 'SPICE' ), implode( ', ', $tax_ins_array ) );
						}
					}

					$value = '<del>' . strip_tags( $order->get_formatted_order_total() ) . $refunded_tax_del . '</del> <ins>' . wc_price( $order->get_total() - $total_refunded, array( 'currency' => $order->get_order_currency() ) ) . $refunded_tax_ins . '</ins>';
				}
				?>
				<tr>
					<th scope="row"><?php echo $total['label']; ?></th>
					<td colspan="3"><?php echo $value; ?></td>
				</tr>
				<?php
			}
		}

		// Check for refund
		if ( $has_refund ) { ?>
		<tr>
			<th scope="row"><?php esc_html_e('Refunded:', 'SPICE' ); ?></th>
			<td colspan="3">-<?php echo wc_price( $total_refunded, array( 'currency' => $order->get_order_currency() ) ); ?></td>
		</tr>
		<?php
	}

		// Check for customer note
	if ( '' != $order->customer_note ) { ?>
	<tr>
		<th scope="row"><?php esc_html_e('Note:', 'SPICE' ); ?></th>
		<td colspan="3"><?php echo wptexturize( $order->customer_note ); ?></td>
	</tr>
	<?php } ?>
</tbody>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<header>
	<h2><?php esc_html_e('Customer details', 'SPICE' ); ?></h2>
</header>
<table class="shop_table shop_table_responsive customer_details table">
	<?php
	if ( $order->billing_email ) {
		echo '<tr><th>' . esc_html__( 'Email:', 'SPICE' ) . '</th><td data-title="' . esc_html__( 'Email', 'SPICE' ) . '">' . $order->billing_email . '</td></tr>';
	}

	if ( $order->billing_phone ) {
		echo '<tr><th>' . esc_html__( 'Telephone:', 'SPICE' ) . '</th><td data-title="' . esc_html__( 'Telephone', 'SPICE' ) . '">' . $order->billing_phone . '</td></tr>';
	}

	// Additional customer details hook
	do_action( 'woocommerce_order_details_after_customer_details', $order );
	?>
</table>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

	<div class="col2-set  row address">

		<div class="col-sm-6">

		<?php endif; ?>

		<header class="title">
			<h3><?php esc_html_e('Billing Address', 'SPICE' ); ?></h3>
		</header>
		<address>
			<?php
			if ( ! $order->get_formatted_billing_address() ) {
				esc_html_e( 'N/A', 'SPICE' );
			} else {
				echo $order->get_formatted_billing_address();
			}
			?>
		</address>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

		</div><!-- /.col-1 -->

		<div class="col-sm-6">

			<header class="title">
				<h3><?php esc_html_e('Shipping Address', 'SPICE' ); ?></h3>
			</header>
			<address>
				<?php
				if ( ! $order->get_formatted_shipping_address() ) {
					esc_html_e( 'N/A', 'SPICE' );
				} else {
					echo $order->get_formatted_shipping_address();
				}
				?>
			</address>

		</div><!-- /.col-2 -->

	</div><!-- /.col2-set -->

<?php endif; ?>

<div class="clear"></div>
