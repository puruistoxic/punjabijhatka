<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
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

// Woo 3.x
if ( Insight_Woo::version_check() ) {
	if ( $related_products ) : ?>

		<div class="related products">

			<h2><?php esc_html_e( 'Related Products', 'tm-arden' ); ?></h2>

			<div class="tm-swiper nav-style-1"
			     data-lg-items="4"
			     data-md-items="3"
			     data-sm-items="2"
			     data-xs-items="1"
			     data-nav="1"
			     data-lg-gutter="30"
			>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php foreach ( $related_products as $related_product ) : ?>

							<?php
							$post_object = get_post( $related_product->get_id() );
							setup_postdata( $GLOBALS['post'] =& $post_object );
							?>
							<div class="swiper-slide">
								<?php wc_get_template_part( 'content', 'product2' ); ?>
							</div>

						<?php endforeach; ?>
					</div>
				</div>
				<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
				<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
			</div>

		</div>

	<?php endif;
} else {
	//Woo 2.x.x
	global $product, $woocommerce_loop;

	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}

	if ( ! $related = $product->get_related( $posts_per_page ) ) {
		return;
	}

	$args = apply_filters( 'woocommerce_related_products_args', array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $orderby,
		'post__in'            => $related,
		'post__not_in'        => array( $product->id ),
	) );

	$products                    = new WP_Query( $args );
	$woocommerce_loop['name']    = 'related';
	$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );

	if ( $products->have_posts() ) : ?>
		<div class="related products">

			<h2><?php esc_html_e( 'Related Products', 'tm-arden' ); ?></h2>

			<div class="tm-swiper nav-style-1"
			     data-lg-items="4"
			     data-md-items="3"
			     data-sm-items="2"
			     data-xs-items="1"
			     data-nav="1"
			     data-lg-gutter="30"
			>
				<div class="swiper-container">
					<div class="swiper-wrapper">

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<div class="swiper-slide">
								<?php wc_get_template_part( 'content', 'product2' ); ?>
							</div>

						<?php endwhile; // end of the loop. ?>

					</div>
				</div>
				<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
				<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
			</div>

		</div>
	<?php endif; ?>

	<?php
}
wp_reset_postdata();
