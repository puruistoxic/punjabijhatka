<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( Insight_Woo::version_check() ) {
	global $product;
	?>
	<div class="product_meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<div class="sku_wrapper meta-item">
				<h6><?php esc_html_e( 'SKU', 'tm-arden' ); ?></h6>
				<span
					class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'tm-arden' ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( Insight::setting( 'single_product_categories_enable' ) === '1' ) : ?>
			<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in meta-item"><h6>' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'tm-arden' ) . '</h6>', '</div>' ); ?>
		<?php endif; ?>

		<?php if ( Insight::setting( 'single_product_tags_enable' ) === '1' ) : ?>
			<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as meta-item"><h6>' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'tm-arden' ) . '</h6>', '</div>' ); ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>
<?php } else {
	global $post, $product;
	$pid = $product->id;

	$product_categories = get_the_terms( $post->ID, 'product_cat' );
	$cat_count          = count( $product_categories );

	$product_tags = get_the_terms( $post->ID, 'product_tag' );
	$tag_count    = count( $product_tags );
	?>
	<div class="product_meta">

		<?php do_action( 'woocommerce_product_meta_start' ); ?>
		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<div class="sku_wrapper meta-item">
				<h6><?php esc_html_e( 'SKU', 'tm-arden' ); ?></h6>
				<span class="sku"
				      itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'tm-arden' ); ?></span>
			</div>
		<?php endif; ?>

		<?php if ( Insight::setting( 'single_product_categories_enable' ) === '1' && is_array( $product_categories ) ) : ?>
			<div class="posted_in meta-item">
				<h6><?php echo _n( 'Category', 'Categories', $cat_count, 'tm-arden' ); ?></h6>
				<?php echo '' . $product->get_categories( ', ' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( Insight::setting( 'single_product_tags_enable' ) === '1' && is_array( $product_tags ) ) : ?>
			<div class="tagged_as meta-item">
				<h6><?php echo _n( 'Tag', 'Tags', $tag_count, 'tm-arden' ); ?></h6>
				<?php echo '' . $product->get_tags( ', ' ); ?>
			</div>
		<?php endif; ?>
		<?php do_action( 'woocommerce_product_meta_end' ); ?>

	</div>
<?php } ?>
