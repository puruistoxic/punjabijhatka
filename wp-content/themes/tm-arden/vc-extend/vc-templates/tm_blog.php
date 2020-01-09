<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$categories         = $meta_key = $pagination = $animation = '';
$carousel_direction = $carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';
$atts               = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$insight_post_args = array(
	'post_type'      => 'post',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
	'post__not_in'   => get_option( 'sticky_posts' ),
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
$css_id   = uniqid( 'tm-blog-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-blog ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

if ( $skin !== '' ) {
	$css_class .= " skin-$skin";
}

$grid_classes = 'tm-grid';

if ( $style === '4' ) {
	$grid_classes .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper equal-height';
	if ( $carousel_nav !== '' ) {
		$slider_classes .= " nav-style-$carousel_nav";
	}
	if ( $carousel_pagination !== '' ) {
		$slider_classes .= " has-pagination pagination-style-$carousel_pagination";
	}
}

$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );
?>

<?php if ( $insight_query->have_posts() ) : ?>
	<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php
		if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>
		<?php if ( in_array( $style, array( '2', '3', '5' ), true ) ) { ?>
			data-type="masonry"
			<?php
			if ( $columns !== '' ) {
				$arr = explode( ';', $columns );
				foreach ( $arr as $value ) {
					$tmp = explode( ':', $value );
					echo ' data-' . $tmp[0] . '-columns="' . esc_attr( $tmp[1] ) . '"';
				}
			}
			?>
		<?php } elseif ( in_array( $style, array( '4' ), true ) ) { ?>
			data-type="swiper"
		<?php } ?>
		<?php if ( in_array( $style, array( '2', '3' ), true ) ) : ?>
			data-grid-fitrows="true"
			data-match-height="true"
		<?php endif; ?>
		<?php if ( $gutter !== '' && $gutter !== 0 ) : ?>
			data-gutter="<?php echo esc_attr( $gutter ); ?>"
		<?php endif; ?>
	>
		<?php
		$i     = 0;
		$count = $insight_query->post_count;

		$tm_grid_query                   = $insight_post_args;
		$tm_grid_query['max_num_pages']  = $insight_query->max_num_pages;
		$tm_grid_query['found_posts']    = $insight_query->found_posts;
		$tm_grid_query['style']          = $style;
		$tm_grid_query['thumbnail_size'] = $thumbnail_size;
		$tm_grid_query['pagination']     = $pagination;
		$tm_grid_query['count']          = $count;
		$tm_grid_query['taxonomies']     = $taxonomies;
		$tm_grid_query                   = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<input type="hidden" class="tm-grid-query" value="<?php echo '' . $tm_grid_query; ?>"/>

		<?php if ( $style === '4' ) { ?>
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
					<?php if ( in_array( $style, array( '1', '3', '5' ), true ) ) : ?>
						data-grid-has-gallery="true"
					<?php endif; ?>
				>
					<?php if ( in_array( $style, array( '2', '3', '5' ), true ) ) : ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>
					<?php if ( $style === '1' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'grid-item', 'post-item' );
							$format  = '';
							if ( get_post_format() !== false ) {
								$format = get_post_format();
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<?php get_template_part( 'loop/blog/format', $format ); ?>
								<div class="post-info">
									<?php if ( has_category() ) : ?>
										<div class="post-categories"><?php the_category( ', ' ); ?></div>
									<?php endif; ?>
									<h2 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<?php if ( is_sticky() ) : ?>
										<span class="post-sticky"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
											<?php esc_html_e( 'Sticky', 'tm-arden' ); ?></span>
									<?php endif; ?>
									<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
									<div class="post-excerpt">
										<?php Insight_Templates::excerpt( array( 'limit' => 42, 'type' => 'word' ) ); ?>
									</div>
									<div class="post-read-more">
										<a class="tm-button style-3 tm-button-default tm-button-lg"
										   href="<?php the_permalink(); ?>">
											<span><?php esc_html_e( 'Read full post', 'tm-arden' ); ?></span>
										</a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '2' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-day">
									<h4>
										<?php echo get_the_date( 'd' ); ?>
									</h4>
								</div>
								<div class="post-feature-overlay">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-feature"
										     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
										</div>
									<?php } ?>
									<div class="post-overlay">

									</div>
								</div>
								<div class="post-info">
									<?php if ( has_category() ) : ?>
										<div class="post-categories"><?php the_category( ', ' ); ?></div>
									<?php endif; ?>
									<h5 class="post-title">
										<a href="<?php the_permalink(); ?>"
										   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h5>
									<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
									<div class="post-excerpt">
										<?php Insight_Templates::excerpt( array(
											                                  'limit' => 140,
											                                  'type'  => 'character',
										                                  ) ); ?>
									</div>
									<div class="post-read-more">
										<a class="tm-button style-3 tm-button-default tm-button-lg"
										   href="<?php the_permalink(); ?>">
											<span><?php esc_html_e( 'Read full post', 'tm-arden' ); ?></span>
										</a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '3' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							$format  = '';
							if ( get_post_format() !== false ) {
								$format = get_post_format();
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
								<div class="post-feature-overlay">
									<div class="post-overlay">

									</div>
								</div>
								<div class="post-day">
									<h4>
										<?php echo get_the_date( 'd' ); ?>
									</h4>
								</div>
								<div class="post-info">
									<?php if ( has_category() ) : ?>
										<div class="post-categories"><?php the_category( ', ' ); ?></div>
									<?php endif; ?>
									<h5 class="post-title">
										<a href="<?php the_permalink(); ?>"
										   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h5>
									<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '4' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item swiper-slide' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-day">
									<h4>
										<?php echo get_the_date( 'd' ); ?>
									</h4>
								</div>
								<div class="post-feature-overlay">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="post-feature"
										     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
										</div>
									<?php } ?>
									<div class="post-overlay">

									</div>
								</div>
								<div class="post-info">
									<?php if ( has_category() ) : ?>
										<div class="post-categories"><?php the_category( ', ' ); ?></div>
									<?php endif; ?>
									<h5 class="post-title">
										<a href="<?php the_permalink(); ?>"
										   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h5>
									<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
									<div class="post-excerpt">
										<?php Insight_Templates::excerpt( array(
											                                  'limit' => 140,
											                                  'type'  => 'character',
										                                  ) ); ?>
									</div>
									<div class="post-read-more">
										<a class="tm-button style-3 tm-button-default tm-button-lg"
										   href="<?php the_permalink(); ?>">
											<span><?php esc_html_e( 'Read full post', 'tm-arden' ); ?></span>
										</a>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '5' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'post-item grid-item' );
							$format  = '';
							if ( get_post_format() !== false ) {
								$format = get_post_format();
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
								<?php if ( ! in_array( $format, array( 'quote' ) ) ) : ?>
									<div class="post-info">
										<?php if ( has_category() ) : ?>
											<div class="post-categories"><?php the_category( ', ' ); ?></div>
										<?php endif; ?>
										<h5 class="post-title">
											<a href="<?php the_permalink(); ?>"
											   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										</h5>
										<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
									</div>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					<?php } ?>
				</div>

				<?php if ( $style === '4' ) { ?>
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

		<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
			<div class="tm-grid-pagination" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">
				<?php if ( $pagination === 'loadmore' || $pagination === 'infinite' ) { ?>
					<div class="tm-loader"></div>
					<?php if ( $pagination === 'loadmore' ) { ?>
						<a href="#" class="tm-button style-1 tm-button-default tm-button-nm tm-grid-loadmore-btn">
							<span><?php echo esc_html( $pagination_button_text ); ?></span>
						</a>
					<?php } ?>
				<?php } elseif ( $pagination === 'pagination' ) { ?>
					<?php Insight_Templates::paging_nav( $insight_query ); ?>
				<?php } ?>
			</div>
			<div class="tm-grid-messages" style="display: none;">
				<?php esc_html_e( 'All items displayed.', 'tm-arden' ); ?>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>
<?php wp_reset_postdata();
