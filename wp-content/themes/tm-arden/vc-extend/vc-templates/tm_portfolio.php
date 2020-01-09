<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style              = $el_class = $order = $thumbnail_size = $overlay_style = $animation = $filter_by = $filter_wrap = $filter_style = $filter_enable = $filter_align = $filter_counter = $pagination_align = $pagination_button_text = '';
$carousel_direction = $carousel_items_display = $carousel_gutter = $carousel_nav = $carousel_pagination = $carousel_auto_play = '';
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';
$gutter             = 0;
$atts               = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$insight_post_args = array(
	'post_type'      => 'portfolio',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
	'paged'          => 1,
	'post_status'    => 'publish',
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
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
$css_id   = uniqid( 'tm-portfolio-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-portfolio ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " filter-style-$filter_style";

if ( $style === '6' ) {
	$filter_enable = '';
}
if ( $filter_wrap === '1' ) {
	$css_class .= ' filter-wrap';
}

$grid_classes = 'tm-grid';

if ( $style === '4' ) {
	$grid_classes   .= ' swiper-wrapper';
	$slider_classes = 'tm-swiper';
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
		<?php if ( in_array( $style, array( '1', '2', '3' ), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( in_array( $style, array( '4' ), true ) ) { ?>
			data-type="swiper"
		<?php } elseif ( in_array( $style, array( '5' ), true ) ) { ?>
			data-type="justified"
			<?php if ( $justify_row_height !== '' && $justify_row_height > 0 ) { ?>
				data-justified-height="<?php echo esc_attr( $justify_row_height ); ?>"
			<?php } ?>
			<?php if ( $justify_max_row_height !== '' && $justify_max_row_height > 0 ) { ?>
				data-justified-max-height="<?php echo esc_attr( $justify_max_row_height ); ?>"
			<?php } ?>
			<?php if ( $justify_last_row_alignment !== '' ) { ?>
				data-justified-last-row="<?php echo esc_attr( $justify_last_row_alignment ); ?>"
			<?php } ?>
		<?php } ?>
		<?php if ( $pagination !== '' && $insight_query->found_posts > $number ) : ?>
			data-pagination="<?php echo esc_attr( $pagination ); ?>"
		<?php endif; ?>
		<?php
		if ( in_array( $style, array( '2' ), true ) ) {
			echo 'data-grid-metro="' . esc_attr( $style ) . '"';
		}
		?>
		<?php if ( in_array( $style, array( '1', '2', '3' ), true ) ): ?>
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

		$tm_grid_query                   = $insight_post_args;
		$tm_grid_query['max_num_pages']  = $insight_query->max_num_pages;
		$tm_grid_query['found_posts']    = $insight_query->found_posts;
		$tm_grid_query['taxonomies']     = $taxonomies;
		$tm_grid_query['style']          = $style;
		$tm_grid_query['overlay_style']  = $overlay_style;
		$tm_grid_query['thumbnail_size'] = $thumbnail_size;
		$tm_grid_query['pagination']     = $pagination;
		$tm_grid_query['count']          = $count;
		$tm_grid_query                   = htmlspecialchars( wp_json_encode( $tm_grid_query ) );
		?>

		<?php Insight_Templates::grid_portfolio_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap, $filter_by ); ?>

		<input type="hidden" class="tm-grid-query" <?php echo 'value="' . $tm_grid_query . '"'; ?>/>

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
				     data-overlay-animation="<?php echo esc_attr( $overlay_style ); ?>"
				>
					<?php if ( in_array( $style, array( '1', '2', '3' ), true ) ): ?>
						<div class="grid-sizer"></div>
					<?php endif; ?>

					<?php if ( $style === '1' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'portfolio-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-content">
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												the_post_thumbnail( $thumbnail_size );
											} else {
												switch ( $thumbnail_size ) {
													case 'insight-grid-classic-square' :
														Insight_Templates::image_placeholder( 600, 600 );
														break;
													case 'insight-grid-classic-2' :
														Insight_Templates::image_placeholder( 600, 463 );
														break;
													default :
														Insight_Templates::image_placeholder( 500, 675 );
														break;
												}
											}
											?>
										</a>
										<?php if ( $overlay_style !== '' ) : ?>
											<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
										<?php endif; ?>
									</div>
									<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
										<div class="post-info">
											<h5 class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h5>
											<div class="post-categories">
												<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '2' ) { ?>
						<?php
						$metro_layout       = array(
							'',
							'grid-item--width2 grid-item--height2',
							'grid-item--height2',
							'',
							'',
							'grid-item--width2 grid-item--height2',
							'',
							'grid-item--height2',
							'',
							'',
						);
						$metro_layout_count = count( $metro_layout );
						$metro_item_count   = 0;
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'portfolio-item grid-item' );

							$_image_size              = 'insight-grid-metro';
							$_image_placeholdit_width = 400;
							$_image_placeholdit_heigh = 400;

							$classes[] = $metro_layout[ $metro_item_count ];
							if ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
								$_image_size               = 'insight-grid-metro-height-2';
								$_image_placeholdit_height = 800;
							} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
								$_image_placeholdit_width  = 800;
								$_image_placeholdit_height = 800;
								$_image_size               = 'insight-grid-metro-width-2-height-2';
							}
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>
								<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
									'grid-item--width2',
									'grid-item--width2 grid-item--height2',
								), true ) ) : ?>
									data-width="2"
								<?php endif; ?>
								<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
									'grid-item--height2',
									'grid-item--width2 grid-item--height2',
								), true ) ) : ?>
									data-height="2"
								<?php endif; ?>
							>
								<div class="post-content">
									<div class="post-thumbnail">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $_image_size );
										} else {
											Insight_Templates::image_placeholder( $_image_placeholdit_width, 570 );
										}
										?>
										<?php if ( $overlay_style !== '' ) : ?>
											<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
										<?php endif; ?>
									</div>
									<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
										<div class="post-info">
											<h5 class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h5>
											<div class="post-categories">
												<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<?php
							$metro_item_count++;
							if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
								$metro_item_count = 0;
							}
							?>
						<?php endwhile; ?>
					<?php } elseif ( $style === '3' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'portfolio-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-content">
									<div class="post-thumbnail">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'insight-grid-masonry' );
										} else {
											Insight_Templates::image_placeholder( 570, 570 );
										}
										?>
										<?php if ( $overlay_style !== '' ) : ?>
											<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '4' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'portfolio-item grid-item swiper-slide' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<div class="post-content">
									<div class="post-thumbnail">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $thumbnail_size );
										} else {
											switch ( $thumbnail_size ) {
												case 'insight-grid-classic-square' :
													Insight_Templates::image_placeholder( 600, 600 );
													break;
												case 'insight-grid-classic-2' :
													Insight_Templates::image_placeholder( 600, 463 );
													break;
												default :
													Insight_Templates::image_placeholder( 500, 675 );
													break;
											}
										}
										?>
										<?php if ( $overlay_style !== '' ) : ?>
											<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
										<?php endif; ?>
									</div>
									<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
										<div class="post-info">
											<h5 class="post-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h5>
											<div class="post-categories">
												<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '5' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'portfolio-item grid-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>

								<a href="<?php the_permalink(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'insight-grid-masonry' );
									} else {
										Insight_Templates::image_placeholder( 600, 600 );
									}
									?>
								</a>
								<div class="post-thumbnail">
									<?php if ( $overlay_style !== '' ) : ?>
										<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
									<?php endif; ?>
								</div>
								<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
									<div class="post-info">
										<h5 class="post-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>
										<div class="post-categories">
											<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					<?php } elseif ( $style === '6' ) { ?>
						<?php
						while ( $insight_query->have_posts() ) :
							$insight_query->the_post();
							$classes = array( 'portfolio-item list-item' );
							?>
							<div <?php post_class( implode( ' ', $classes ) ); ?>>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h5>
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

		<?php if ( $pagination !== '' ) : ?>
			<div class="tm-grid-pagination" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">
				<?php if ( $pagination === 'loadmore' || $pagination === 'infinite' && $insight_query->found_posts > $number ) : ?>
					<div class="tm-loader"></div>
					<?php if ( $pagination === 'loadmore' ) { ?>
						<a href="#" class="tm-button tm-button-default style-1 tm-grid-loadmore-btn">
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
<?php endif; ?>
<?php wp_reset_postdata();
