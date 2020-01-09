<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$type = $_global_icon = $_global_icon_class = $marker_color = $custom_marker_color = $title_color = $custom_title_color = $desc_color = $custom_desc_color = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}
$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-list ' . $el_class, $this->settings['base'], $atts );

// List type.
if ( $list_style === 'auto-numbered' || $list_style === 'manual-numbered' ) {
	$css_class .= " tm-list--h-flow";
} else {
	$css_class .= " tm-list--v-flow";
}
// List style.
$css_class .= " tm-list--$list_style";
$css_class .= " tm-list--$alignment";
// Global icon class.
if ( isset( $icon_type ) && isset( ${"icon_" . $icon_type} ) ) {
	$_global_icon_class .= esc_attr( ${"icon_" . $icon_type} );
}

$_li_classes = 'tm-list__item';
if ( ( $list_style === 'manual-numbered' || $list_style === 'auto-numbered' ) && $alignment === 'horizontal' ) {
	$_li_classes .= ' col-md-6 col-lg-4';
	$css_class .= ' row';
}

$_li_classes .= Insight_Helper::get_animation_classes( $animation );

$_marker_classes = 'tm-list__marker';
if ( $marker_color === 'primary_color' ) {
	$_marker_classes .= ' primary-color-important';
} elseif ( $marker_color === 'secondary_color' ) {
	$_marker_classes .= ' secondary-color-important';
}

$_title_classes = 'tm-list__title';
if ( $title_color === 'primary_color' ) {
	$_title_classes .= ' primary-color-important';
} elseif ( $title_color === 'secondary_color' ) {
	$_title_classes .= ' secondary-color-important';
}

$_desc_classes = 'tm-list__desc';
if ( $desc_color === 'primary_color' ) {
	$_desc_classes .= ' primary-color-important';
} elseif ( $desc_color === 'secondary_color' ) {
	$_desc_classes .= ' secondary-color-important';
}

$css_id = uniqid( 'tm-list-' );
$this->get_inline_css( '#' . $css_id, $atts );
?>

<ul class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	$auto_number = 0;
	foreach ( $items as $item ) {
		$output = '';

		$_icon      = '';
		$icon_class = '';

		if ( isset( $item['type'] ) && isset( $item[ "icon_" . $item['type'] ] ) ) {
			$icon_class .= esc_attr( $item[ "icon_" . $item['type'] ] );
		}

		?>
		<li class="<?php echo esc_attr( $_li_classes ); ?>">

			<div class="<?php echo esc_attr( $_marker_classes ); ?>">

				<?php
				// Basic.
				if ( $list_style === 'basic' ) {
					echo '-';
				}
				?>

				<?php
				// Icon.
				if ( $list_style === 'icon' ) { ?>
					<?php
					$list_icon_class = 'tm-list__icon';
					if ( $icon_class && $icon_class !== '' ) {
						$list_icon_class .= " $icon_class";
					} else {
						$list_icon_class .= " $_global_icon_class";
					}
					?>
					<i class="<?php echo esc_attr( $list_icon_class ); ?>"></i>
				<?php } ?>
				<?php
				// Numbered.
				if ( $list_style === 'vertical-numbered' || $list_style === 'auto-numbered' ) {
					$auto_number ++;
					if ( $list_style === 'auto-numbered' && $auto_number < 10 ) {
						$auto_number = '0' . $auto_number;
					}
					if ( $list_style === 'vertical-numbered' ) {
						$auto_number .= '.';
					}
					echo esc_html( $auto_number );
				}
				?>

				<?php
				// Manual Number.
				if ( $list_style === 'manual-numbered' && isset( $item['item_number'] ) ) {
					echo esc_html( $item['item_number'] );
				}
				?>

			</div>

			<div class="tm-list__body">

				<?php
				// Item Title.
				if ( isset( $item['item_title'] ) ) {
					?>
					<div class="<?php echo esc_attr( $_title_classes ); ?>">
						<?php
						// Item Link.
						if ( isset( $item['link'] ) && $item['link'] !== '' ) {
						$link = vc_build_link( $item['link'] );
						if ( $link['url'] && $link['url'] !== '' ) { ?>
						<a class="tm-list__link p-0" href="<?php echo esc_url( $link['url'] ) ?>"
							<?php if ( $link['target'] !== '' ) { ?>
								target="<?php echo esc_attr( $link['target'] ); ?>"
							<?php } ?>
						>
							<?php } ?>
							<?php } ?>
							<?php echo esc_html( $item['item_title'] ); ?>
							<?php if ( isset( $item['link'] ) ) {
							if ( $link['url'] && $link['url'] !== '' ) { ?>
						</a>
					<?php } ?>
					<?php } ?>
					</div>
				<?php } ?>

				<?php if ( ( $list_style === 'auto-numbered' || $list_style === 'manual-numbered' ) && isset( $item['item_desc'] ) ) { ?>
					<div
						class="<?php echo esc_attr( $_desc_classes ); ?>"><?php echo esc_html( $item['item_desc'] ); ?></div>
				<?php } ?>
			</div>
		</li>
	<?php } ?>
</ul>
