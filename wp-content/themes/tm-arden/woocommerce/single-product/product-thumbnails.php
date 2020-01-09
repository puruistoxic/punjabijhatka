<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version       3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;
// Woo 3.x.x
if ( Insight_Woo::version_check() ) {
	$attachment_ids = $product->get_gallery_image_ids();
} else { // Woo 2.x
	$attachment_ids = $product->get_gallery_attachment_ids();
}

if ( $attachment_ids ) {
	foreach ( $attachment_ids as $attachment_id ) {
		$classes     = array( 'zoom' );
		$image_class = implode( ' ', $classes );
		$props       = wc_get_product_attachment_props( $attachment_id, $post );

		if ( ! $props['url'] ) {
			continue;
		}

		$sub_html = '';

		if ( $props['title'] !== '' ) {
			$sub_html .= "<h4>{$props['title']}</h4>";
		}

		if ( $props['caption'] !== '' ) {
			$sub_html .= "<p>{$props['caption']}</p>";
		}

		echo sprintf( '
				<div class="swiper-slide">
					<a href="%s" data-src="%s" class="%s" data-sub-html="%s">%s</a>
				</div>', esc_url( $props['url'] ), esc_url( $props['url'] ), esc_attr( $image_class ), $sub_html, wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), 0 ) );
	}
}
