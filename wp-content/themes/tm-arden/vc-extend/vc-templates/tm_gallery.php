<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style              = $el_class = $columns = '';
$gutter             = 0;
$justify_row_height = $justify_max_row_height = $justify_last_row_alignment = '';
$atts               = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-gallery-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-gallery tm-grid-wrapper ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid tm-light-gallery';
$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );

$items = (array) vc_param_group_parse_atts( $items );
$count = count( $items )
?>
<?php if ( $count > 0 ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
		<?php if ( in_array( $style, array( '1', '2', 'metro' ), true ) ) { ?>
			data-type="masonry"
		<?php } elseif ( in_array( $style, array( '3' ), true ) ) { ?>
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
		<?php if ( in_array( $style, array( 'metro' ), true ) ) : ?>
			data-grid-metro="2"
		<?php endif; ?>
		<?php if ( in_array( $style, array( '1', '2', 'metro' ), true ) ): ?>
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
		<div class="<?php echo esc_attr( $grid_classes ); ?>">
			<?php if ( in_array( $style, array( '1', '2', 'metro' ), true ) ) : ?>
				<div class="grid-sizer"></div>
			<?php endif; ?>
			<?php if ( $style === '1' ) { ?>
				<?php
				foreach ( $items as $item ) {
					$classes = array( 'gallery-item grid-item' );
					?>
					<?php if ( isset( $item['image'] ) ) : ?>
						<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
							<?php
							$_image    = Insight_Helper::get_attachment( $item['image'] );
							$_sub_html = '';
							if ( $_image['title'] !== '' ) {
								$_sub_html .= "<h4>{$_image['title']}</h4>";
							}

							if ( $_image['caption'] !== '' ) {
								$_sub_html .= "<p>{$_image['caption']}</p>";
							}
							?>

							<a href="<?php echo wp_get_attachment_url( $item['image'], 'full' ); ?>" class="zoom"
							   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
								<?php echo wp_get_attachment_image( $item['image'], $thumbnail_size ); ?>
								<div class="overlay">
									<div>+</div>
								</div>
							</a>
						</div>
					<?php endif; ?>
					<?php
				}
				?>
			<?php } elseif ( $style === '2' ) { ?>
				<?php
				foreach ( $items as $item ) {
					$classes = array( 'gallery-item grid-item' );
					?>
					<?php if ( isset( $item['image'] ) ) : ?>
						<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
							<?php
							$_image    = Insight_Helper::get_attachment( $item['image'] );
							$_sub_html = '';
							if ( $_image['title'] !== '' ) {
								$_sub_html .= "<h4>{$_image['title']}</h4>";
							}

							if ( $_image['caption'] !== '' ) {
								$_sub_html .= "<p>{$_image['caption']}</p>";
							}
							?>

							<a href="<?php echo wp_get_attachment_url( $item['image'], 'full' ); ?>" class="zoom"
							   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
								<?php echo wp_get_attachment_image( $item['image'], 'insight-grid-masonry' ); ?>
								<div class="overlay">
									<div>+</div>
								</div>
							</a>
						</div>
					<?php endif; ?>
					<?php
				}
				?>
			<?php } elseif ( $style === '3' ) { ?>
				<?php
				foreach ( $items as $item ) {
					$classes = array( 'gallery-item' );
					?>
					<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
						<?php
						$_image    = Insight_Helper::get_attachment( $item['image'] );
						$_sub_html = '';
						if ( $_image['title'] !== '' ) {
							$_sub_html .= "<h4>{$_image['title']}</h4>";
						}

						if ( $_image['caption'] !== '' ) {
							$_sub_html .= "<p>{$_image['caption']}</p>";
						}
						?>

						<a href="<?php echo wp_get_attachment_url( $item['image'], 'full' ); ?>" class="zoom"
						   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
							<?php echo wp_get_attachment_image( $item['image'], 'insight-grid-masonry' ); ?>
							<div class="overlay">
								<div>+</div>
							</div>
						</a>
					</div>
				<?php } ?>
			<?php } elseif ( $style === 'metro' ) { ?>
				<?php
				$metro_layout       = array(
					'grid-item--width2 grid-item--height2',
					'',
					'',
					'',
					'',
				);
				$metro_layout_count = count( $metro_layout );
				$metro_item_count   = 0;
				foreach ( $items as $item ) {
					$classes     = array( 'gallery-item grid-item' );
					$_image_size = 'insight-grid-metro';

					$classes[] = $metro_layout[ $metro_item_count ];
					if ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
						$_image_size = 'insight-grid-metro-height-2';
					} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2' ) {
						$_image_size = 'insight-grid-metro-width-2';
					} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
						$_image_size = 'insight-grid-metro-width-2-height-2';
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
						<?php
						$_image    = Insight_Helper::get_attachment( $item['image'] );
						$_sub_html = '';
						if ( $_image['title'] !== '' ) {
							$_sub_html .= "<h4>{$_image['title']}</h4>";
						}

						if ( $_image['caption'] !== '' ) {
							$_sub_html .= "<p>{$_image['caption']}</p>";
						}
						?>

						<a href="<?php echo wp_get_attachment_url( $item['image'], 'full' ); ?>" class="zoom"
						   data-sub-html="<?php echo esc_attr( $_sub_html ); ?>">
							<?php echo wp_get_attachment_image( $item['image'], $_image_size ); ?>
							<div class="overlay">
								<div>+</div>
							</div>
						</a>
					</div>
					<?php
					$metro_item_count ++;
					if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
						$metro_item_count = 0;
					}
					?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>
