<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
if ( has_post_thumbnail() ) {
	array_unshift( $attachment_ids, get_post_thumbnail_id() );
}

if ( 1 < count( $attachment_ids ) ) {
?>
	<!-- <a href="javascript:void(0)" class="left-dir arrow-dir"><i class="fa fa-angle-left"></i></a>
	<a href="javascript:void(0)" class="right-dir arrow-dir"><i class="fa fa-angle-right"></i></a> -->
	<div class="postRelatedImages clearfix">
		
	<?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) 
		{

			$classes = array( 'zoom' );

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_src   = wp_get_attachment_image_src( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html',
				 sprintf( __('<div class="singleThumbnail item" data-thumb="%s" data-full="%s">%s</div>','SPICE'), $image_src[0], $image_link, $image ),
				  $attachment_id, $post->ID, $image_class );


			$loop++;
		}

	?></div>
	<?php
}