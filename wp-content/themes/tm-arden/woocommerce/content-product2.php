<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div <?php wc_product_class(); ?>>
	<div class="product-thumbnail">
		<?php woocommerce_template_loop_product_link_open(); ?>
		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
		<div class="product-overlay">
			<i class="fa fa-search"></i>
		</div>
		<?php woocommerce_template_loop_product_link_close(); ?>
	</div>
	<div class="product-info">
		<?php
		woocommerce_template_loop_product_link_open();
		do_action( 'woocommerce_shop_loop_item_title' );
		woocommerce_template_loop_price();
		woocommerce_template_loop_product_link_close();
		?>
	</div>
</div>
