<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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
	if ( $upsells ) : ?>

		<div class="up-sells upsells products">
			<h2><?php esc_html_e( 'You may also like&hellip;', 'tm-arden' ) ?></h2>

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

						<?php foreach ( $upsells as $upsell ) : ?>

							<?php
							$post_object = get_post( $upsell->get_id() );
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

	if ( ! $upsells = $product->get_upsells() ) {
		return;
	}

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $orderby,
		'post__in'            => $upsells,
		'post__not_in'        => array( $product->id ),
		'meta_query'          => WC()->query->get_meta_query(),
	);

	$products                    = new WP_Query( $args );
	$woocommerce_loop['name']    = 'up-sells';
	$woocommerce_loop['columns'] = apply_filters( 'woocommerce_up_sells_columns', $columns );

	if ( $products->have_posts() ) : ?>
		<div class="up-sells upsells products">
			<h2><?php esc_html_e( 'You may also like&hellip;', 'tm-arden' ) ?></h2>

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
