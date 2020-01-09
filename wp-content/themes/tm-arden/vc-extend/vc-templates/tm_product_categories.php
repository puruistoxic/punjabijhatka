<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $animation = $columns = $gutter = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = count( $items );
if ( $count < 1 ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-product-categories-' );
$this->get_inline_css( "#$css_id" );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-product-categories ' . $el_class, $this->settings['base'], $atts );

$grid_classes = 'tm-grid';

if ( $style === 'metro' ) {
	$css_class .= 'tm-grid-metro';
}

$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );
?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php if ( in_array( $style, array( 'metro' ), true ) ) { ?>
		data-type="masonry"
	<?php } ?>
	<?php if ( in_array( $style, array( 'metro' ), true ) ) { ?>
		data-grid-metro="2"
	<?php } ?>
	<?php if ( in_array( $style, array( 'metro' ), true ) ): ?>
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

	<div class="<?php echo esc_attr( $grid_classes ); ?>"
	>
		<?php if ( in_array( $style, array( 'metro' ), true ) ): ?>
			<div class="grid-sizer"></div>
		<?php endif; ?>
		<?php if ( in_array( $style, array( 'metro' ), true ) ):
			$metro_layout = array(
				'grid-item--width2',
				'',
				'',
				'grid-item--width2',
			);
			$metro_layout_count = count( $metro_layout );
			$metro_item_count = 0;

			foreach ( $items as $item ) {
				$classes = array( 'category-item grid-item' );

				$_image_size              = 'insight-grid-metro';
				$_image_placeholdit_width = 480;
				$_image_placeholdit_heigh = 480;

				$classes[] = $metro_layout[ $metro_item_count ];
				if ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
					$_image_size               = 'insight-grid-metro-height-2';
					$_image_placeholdit_height = 960;
				} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2' ) {
					$_image_size               = 'insight-grid-metro-width-2';
					$_image_placeholdit_width  = 960;
					$_image_placeholdit_height = 480;
				} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
					$_image_placeholdit_width  = 960;
					$_image_placeholdit_height = 960;
					$_image_size               = 'insight-grid-metro-width-2-height-2';
				}

				$term = get_term_by( 'slug', $item['category'], 'product_cat' );

				$term_link = get_term_link( $term );

				$cat_thumb_id     = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				$shop_catalog_img = wp_get_attachment_image_url( $cat_thumb_id, $_image_size );

				$heading_style = '';
				if ( isset( $item['heading_color'] ) && $item['heading_color'] !== '' ) {
					$heading_style .= "color: {$item['heading_color']};";
				}
				?>
				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
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
					<div class="cat-thumbnail"
					     style="background-image: url(<?php echo esc_url( $shop_catalog_img ); ?>);"></div>
					<div class="cat-content">
						<div class="info">
							<h6 class="heading"
								<?php if ( $heading_style !== '' ) : ?>
									style="<?php echo esc_attr( $heading_style ); ?>"
								<?php endif; ?>
							>
								<a href="<?php echo esc_url( $term_link ); ?>">
									<?php echo esc_html( $term->name ); ?>
								</a>
							</h6>
						</div>
					</div>
				</div>
				<?php
				$metro_item_count ++;
				if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
					$metro_item_count = 0;
				}
				?>
			<?php } ?>
		<?php endif; ?>
	</div>
</div>
