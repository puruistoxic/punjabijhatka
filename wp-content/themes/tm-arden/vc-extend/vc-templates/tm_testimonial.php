<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$pagination = $nav = $auto_play = $loop = $text_color = $name_color = $by_line_color = $style = $el_class = '';
$atts       = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$css_id = uniqid( 'tm-testimonial-' );
$this->get_inline_css( '#' . $css_id, $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-testimonial tm-swiper ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_class .= " equal-height";

if ( $nav !== '' ) {
	$css_class .= " nav-style-$nav";
}

if ( $pagination !== '' ) {
	$css_class .= " has-pagination pagination-style-$pagination";
}

$text_classes    = array( 'testimonial-desc' );
$name_classes    = array( 'testimonial-name' );
$by_line_classes = array( 'testimonial-by-line' );

if ( $skin === 'custom' ) {
	if ( $text_color === 'primary_color' ) {
		$text_classes[] = 'primary-color';
	}

	if ( $name_color === 'primary_color' ) {
		$name_classes[] = 'primary-color';
	}

	if ( $by_line_color === 'primary_color' ) {
		$by_line_classes[] = 'primary-color';
	}
}

if ( $style === '1' || $style === '3' ) {
	$name_classes[] = 'primary-color';
}

$insight_post_args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
	'order'          => $order,
);

if ( in_array( $orderby, array( 'meta_value', 'meta_value_num' ), true ) ) {
	$insight_post_args['meta_key'] = $meta_key;
}

$insight_post_args = Insight_VC::get_tax_query_of_taxonomies( $insight_post_args, $taxonomies );

$insight_query = new WP_Query( $insight_post_args );
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( $style === '1' ) { ?>
			<?php if ( $carousel_items_display !== '' ) {
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
			data-equal-height="1"
		<?php } else { ?>
			data-lg-items="1"
		<?php } ?>
		<?php if ( $nav !== '' ) : ?>
			data-nav="1"
		<?php endif; ?>
		<?php if ( $pagination !== '' ) : ?>
			data-pagination="1"
		<?php endif; ?>
		<?php if ( $auto_play !== '' ) : ?>
			data-autoplay="<?php echo esc_attr( $auto_play ); ?>"
		<?php endif; ?>
		<?php if ( $loop === '1' ) : ?>
			data-loop="1"
		<?php endif; ?>
		 data-autoheight="1"
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>
					<div class="swiper-slide">
						<?php $_meta = unserialize( get_post_meta( get_the_ID(), 'insight_testimonial_options', true ) ); ?>
						<?php if ( '2' === $style ) { ?>
							<div>
								<?php if ( has_post_thumbnail() ) : ?>
									<?php
									$full_image_size = get_the_post_thumbnail_url( null, 'full' );
									$image_url       = Insight_Helper::aq_resize( array(
										                                              'url'    => $full_image_size,
										                                              'width'  => 150,
										                                              'height' => 150,
										                                              'crop'   => true,
									                                              ) );
									?>
									<div class="post-thumbnail">
										<img src="<?php echo esc_url( $image_url ); ?>"/>
									</div>
								<?php endif; ?>
								<h6 class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php echo strip_tags( get_the_content() ); ?></h6>
								<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>
								<?php if ( isset( $_meta['by_line'] ) ) : ?>
									<div class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
										<?php echo esc_html( $_meta['by_line'] ); ?></div>
								<?php endif; ?>
							</div>
						<?php } else { ?>
							<div>
								<h6 class="<?php echo esc_attr( join( ' ', $name_classes ) ); ?>"><?php the_title(); ?></h6>
								<?php if ( isset( $_meta['by_line'] ) ) : ?>
									<div class="<?php echo esc_attr( join( ' ', $by_line_classes ) ); ?>">
										<?php echo esc_html( $_meta['by_line'] ); ?></div>
								<?php endif; ?>
								<?php if ( has_post_thumbnail() ): ?>
									<?php
									$full_image_size = get_the_post_thumbnail_url( null, 'full' );
									$image_url       = Insight_Helper::aq_resize( array(
										                                              'url'    => $full_image_size,
										                                              'width'  => 150,
										                                              'height' => 150,
										                                              'crop'   => true,
									                                              ) );
									?>
									<div class="post-thumbnail">
										<img src="<?php echo esc_url( $image_url ); ?>"/>
									</div>
								<?php endif; ?>
								<div
									class="<?php echo esc_attr( join( ' ', $text_classes ) ); ?>"><?php echo strip_tags( get_the_content() ); ?></div>
							</div>
						<?php } ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<?php if ( $pagination !== '' ) : ?>
			<div class="swiper-pagination"></div>
		<?php endif; ?>
		<?php if ( $nav !== '' ) : ?>
			<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
			<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
