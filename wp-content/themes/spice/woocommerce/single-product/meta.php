<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper">
			<span class="icon-newspaper"></span>
			<?php esc_html_e( 'SKU:', 'SPICE' ); ?> 
			<span class="sku Ahmed" itemprop="sku">
				<?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'n/a', 'SPICE' ); ?>
			</span>.
		</span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in"><span class="icon-tag"></span>' . _n( 'Category:', 'Categories:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'SPICE' ) . ' <span class="color">', '.</span></span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as"><span class="icon-tag"></span>' . _n( 'Tag:', 'Tags:', sizeof( get_the_terms( $post->ID, 'product_tag' ) ), 'SPICE' ) . ' <span class="color">', '.</span></span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>