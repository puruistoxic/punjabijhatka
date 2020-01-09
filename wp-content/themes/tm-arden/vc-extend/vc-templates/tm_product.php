<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style  = $el_class = $animation = $thumbnail_size = '';
$gutter = 0;
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$insight_post_args = array(
	'post_type'      => 'product',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ) ) ) {
	$insight_post_args['meta_key'] = $meta_key;
}

if ( get_query_var( 'paged' ) ) {
	$insight_post_args['paged'] = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
	$insight_post_args['paged'] = get_query_var( 'page' );
}

$insight_post_args = Insight_VC::get_tax_query_of_taxonomies( $insight_post_args, $taxonomies );

$insight_query = new WP_Query( $insight_post_args );

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-product-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-product ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " filter-style-$filter_style";

if ( $filter_wrap == '1' ) {
	$css_class .= ' filter-wrap';
}

$grid_classes = 'tm-grid';

if ( in_array( $style, array( '2' ), true ) ) {
	$grid_classes .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " has-pagination pagination-style-$carousel_pagination";
	}
}

$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );

global $woocommerce_loop;
$woocommerce_loop['thumbnail_size'] = $thumbnail_size;
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div class="woocommerce">
		<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>"
		     id="<?php echo esc_attr( $css_id ); ?>"
			<?php if ( in_array( $style, array( '1' ), true ) ) { ?>
				data-type="masonry"
				data-grid-fitrows="true"
			<?php } elseif ( in_array( $style, array( '2' ), true ) ) { ?>
				data-type="swiper"
			<?php } ?>
			<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
				data-pagination="<?php echo esc_attr( $pagination ); ?>"
			<?php endif; ?>
			<?php if ( in_array( $style, array( '1' ), true ) ): ?>
				<?php
				if ( $columns !== '' ) {
					$arr = explode( ';', $columns );
					foreach ( $arr as $value ) {
						$tmp = explode( ':', $value );
						echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
					}
				}
				?>
			<?php endif; ?>
			<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
				data-gutter="<?php echo esc_attr( $gutter ); ?>"
			<?php endif; ?>
		>
			<?php
			$count = $insight_query->post_count;

			$tm_grid_query                  = $insight_post_args;
			$tm_grid_query['max_num_pages'] = $insight_query->max_num_pages;
			$tm_grid_query['found_posts']   = $insight_query->found_posts;
			$tm_grid_query['taxonomies']    = $taxonomies;
			$tm_grid_query['style']         = $style;
			$tm_grid_query['pagination']    = $pagination;
			$tm_grid_query['count']         = $count;
			$tm_grid_query['overlay_style']         = $overlay_style;
			$tm_grid_query                  = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
			?>

			<?php //Insight_Templates::grid_portfolio_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap ) ?>

			<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $tm_grid_query . '"'; ?>/>

			<?php if ( $style === '2' ) { ?>
			<div class="<?php echo esc_attr( $slider_classes ); ?>"
				<?php
				if ( $carousel_items_display !== '' ) {
					$arr = explode( ';', $carousel_items_display );
					foreach ( $arr as $value ) {
						$tmp = explode( ':', $value );
						echo ' data-' . $tmp[0] . '-items="' . $tmp[1] . '"';
					}
				}
				?>
				<?php if ( $carousel_gutter > 1 ) : ?>
					data-lg-gutter="<?php echo esc_attr( $carousel_gutter ); ?>"
				<?php endif; ?>
				<?php if ( $carousel_nav !== '' ) : ?>
					data-nav="1"
				<?php endif; ?>
				<?php if ( $carousel_pagination !== '' ) : ?>
					data-pagination="1"
				<?php endif; ?>
				<?php if ( $carousel_auto_play !== '' ) : ?>
					data-autoplay="<?php echo esc_attr( $carousel_auto_play ); ?>"
				<?php endif; ?>
			>
				<div class="swiper-container">
					<?php } ?>

					<div class="<?php echo esc_attr( $grid_classes ); ?>"
						 data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"
					>
						<?php if ( in_array( $style, array( '1' ), true ) ): ?>
							<div class="grid-sizer"></div>
						<?php endif; ?>
						<?php if ( $style === '1' ) { ?>
							<?php
							while ( $insight_query->have_posts() ) :
								$insight_query->the_post();
								$classes = array( 'product-item grid-item' );
								?>
								<div <?php post_class( implode( ' ', $classes ) ); ?>>
									<div class="product-thumbnail">
										<?php woocommerce_template_loop_product_link_open(); ?>
										<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
										<?php if ( $overlay_style !== '' ) : ?>
											<?php get_template_part( 'loop/product/overlay', $overlay_style ); ?>
										<?php endif; ?>
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
							<?php endwhile; ?>
						<?php } elseif ( $style === '2' ) { ?>
							<?php
							while ( $insight_query->have_posts() ) :
								$insight_query->the_post();
								$classes = array( 'product-item grid-item swiper-slide' );
								?>
								<div <?php post_class( implode( ' ', $classes ) ); ?>>
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
							<?php endwhile; ?>
						<?php } ?>
					</div>

					<?php if ( $style === '2' ) { ?>
				</div>
				<?php if ( $carousel_pagination !== '' ) : ?>
					<div class="swiper-pagination"></div>
				<?php endif; ?>
				<?php if ( $carousel_nav !== '' ) : ?>
					<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
					<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
				<?php endif; ?>
			</div>
		<?php } ?>

			<?php if ( $pagination !== '' ) : ?>
				<div class="tm-grid-pagination" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">
					<?php if ( $pagination === 'loadmore' || $pagination === 'infinite' && $insight_query->found_posts > $number ) : ?>
						<div class="tm-loader"></div>
						<?php if ( $pagination === 'loadmore' ) { ?>
							<a href="#" class="tm-button style-1 tm-grid-loadmore-btn">
								<span><?php echo esc_html( $pagination_button_text ); ?></span>
							</a>
						<?php } ?>
					<?php endif; ?>
				</div>
				<div class="tm-grid-messages" style="display: none;">
					<?php esc_html_e( 'All items displayed.', 'tm-arden' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata();
