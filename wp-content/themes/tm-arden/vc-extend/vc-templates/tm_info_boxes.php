<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style  = $el_class = $animation = '';
$gutter = 0;
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$items = (array) vc_param_group_parse_atts( $items );
$count = count( $items );
if ( $count <= 0 ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-info-boxes-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-info-boxes ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$grid_classes = 'tm-grid';

if ( $style === 'metro' ) {
	$css_class .= ' tm-grid-metro';
}

$grid_classes .= Insight_Helper::get_grid_animation_classes( $animation );
?>
<div class="tm-grid-wrapper <?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
	<?php if ( in_array( $style, array( 'metro' ), true ) ) { ?>
		data-type="masonry"
	<?php } ?>
	<?php
	if ( in_array( $style, array( 'metro' ), true ) ) {
		echo 'data-grid-metro="2"';
	}
	?>
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
	<div class="<?php echo esc_attr( $grid_classes ); ?>">
		<?php if ( in_array( $style, array( 'metro' ), true ) ): ?>
			<div class="grid-sizer"></div>
		<?php endif; ?>
		<?php if ( $style === 'metro' ) { ?>
			<?php
			$metro_layout       = array(
				'grid-item--width2',
				'',
				'',
				'',
				'',
				'grid-item--width2',
			);
			$metro_layout_count = count( $metro_layout );
			$metro_item_count   = 0;

			foreach ( $items as $item ) {
				$classes = array( 'grid-item' );

				$_image_size = 'insight-grid-metro';

				$classes[] = $metro_layout[ $metro_item_count ];
				if ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
					$_image_size = 'insight-grid-metro-height-2';
				} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2' ) {
					$_image_size = 'insight-grid-metro-width-2';
				} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
					$_image_size = 'insight-grid-metro-width-2-height-2';
				}
				$_item_style = '';
				if ( isset( $item['image'] ) ) :
					$image_url = wp_get_attachment_image_url( $item['image'], $_image_size );
					$_item_style .= 'background-image: url( ' . esc_url( $image_url ) . ' )';
					$classes[] = 'has-image';
				endif;
				if ( isset( $item['skin'] ) ) {
					$classes[] = "skin-{$item['skin']}";
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
					<?php if ( $_item_style !== '' ): ?>
						style="<?php echo esc_attr( $_item_style ); ?>"
					<?php endif; ?>
				>
					<div class="box-content">
						<div class="box-content-inner">
							<div class="box-info">
								<?php if ( isset( $item['title'] ) ) : ?>
									<h6 class="box-title"><?php echo esc_html( $item['title'] ); ?></h6>
								<?php endif; ?>
								<?php if ( isset( $item['text'] ) ) : ?>
									<div class="box-text"><?php echo esc_html( $item['text'] ); ?></div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				$metro_item_count ++;
				if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
					$metro_item_count = 0;
				}
				?>
				<?php
			}
		}
		?>
	</div>
</div>
