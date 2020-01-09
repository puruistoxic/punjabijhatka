<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
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
// Woo 3.x.x
if ( Insight_Woo::version_check() ) {
	if ( $cross_sells ) : ?>

		<div class="cross-sells products grid">
			<h2><?php esc_html_e( 'You may be interested in&hellip;', 'tm-arden' ) ?></h2>

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

						<?php foreach ( $cross_sells as $cross_sell ) : ?>

							<?php
							$post_object = get_post( $cross_sell->get_id() );
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
	global $product, $woocommerce_loop;

	if ( ! $crosssells = WC()->cart->get_cross_sells() ) {
		return;
	}

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
		'orderby'             => $orderby,
		'post__in'            => $crosssells,
		'meta_query'          => WC()->query->get_meta_query(),
	);

	$products                    = new WP_Query( $args );
	$woocommerce_loop['name']    = 'cross-sells';
	$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

	if ( $products->have_posts() ) : ?>
		<div class="cross-sells products grid">
			<h2><?php esc_html_e( 'You may be interested in&hellip;', 'tm-arden' ) ?></h2>

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
	<?php endif;
}
wp_reset_postdata();

