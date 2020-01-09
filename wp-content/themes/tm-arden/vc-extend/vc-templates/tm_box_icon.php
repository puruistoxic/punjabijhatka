<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style                = $el_class = $type = $icon_color = $heading_color = $text_color = $feature = $image = $icon_class = $_content_style = $_content_classes = $_heading_style = '';
$button_smooth_scroll = '';
$atts                 = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-box-icon ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$wrap_class = 'tm-box-icon-wrap';
$wrap_class .= " style-$style";
if ( isset( ${"icon_" . $type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $type} );
}

if ( $icon_class !== '' ) {
	if ( $icon_color === 'primary' ) {
		$icon_class .= ' primary-color-important primary-border-color-important';
	} elseif ( $icon_color === 'secondary' ) {
		$icon_class .= ' secondary-color-important secondary-border-color-important';
	}
}

if ( $background_color === 'primary' ) {
	$css_class .= ' primary-background-color-important';
} elseif ( $background_color === 'secondary' ) {
	$css_class .= ' secondary-background-color-important';
}

$_heading_classes = 'heading';

if ( $heading_color === 'primary' ) {
	$_heading_classes .= ' primary-color-important';
} elseif ( $heading_color === 'secondary' ) {
	$_heading_classes .= ' secondary-color-important';
}

$_text_classes = 'text';

if ( $text_color === 'primary' ) {
	$_text_classes .= ' primary-color-important';
} elseif ( $text_color === 'secondary' ) {
	$_text_classes .= ' secondary-color-important';
}

$css_id = uniqid( 'tm-heading-' );
$this->get_inline_css( '#' . $css_id, $atts );

$css_class .= Insight_Helper::get_animation_classes( $animation );

if ( $feature === 'image' ) {
	$css_class .= ' has-feature-image';
}
?>
<div class="<?php echo esc_attr( trim( $wrap_class ) ); ?>">
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php
		if ( $overlay_background !== '' ) {
			$_overlay_style   = '';
			$_overlay_classes = 'overlay';
			if ( $overlay_background === 'primary' ) {
				$_overlay_classes .= ' primary-background-color';
			} elseif ( $overlay_background === 'overlay_custom_background' ) {
				$_overlay_style .= 'background-color: ' . $overlay_custom_background . ';';
			}
			$_overlay_style .= 'opacity: ' . $overlay_opacity / 100 . ';';

			printf( '<div class="%s" style="%s"></div>', esc_attr( $_overlay_classes ), esc_attr( $_overlay_style ) );
		}
		?>
		<div class="content-wrap">
			<?php if ( $feature === 'icon' ) { ?>
				<?php if ( $icon_class !== '' ) : ?>
					<div class="icon">
						<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
					</div>
				<?php endif; ?>
			<?php } elseif ( $feature === 'image' ) { ?>
				<div class="image">
					<?php echo wp_get_attachment_image( $image, $image_size ); ?>
				</div>
			<?php } ?>
			<div class="content">
				<?php if ( $heading ) : ?>
					<h4 class="<?php echo esc_attr( $_heading_classes ); ?>">
						<?php
						// Item Link.
						$link = vc_build_link( $link );
						if ( $link['url'] !== '' ) {
						?>
						<a class="link-secret" href="<?php echo esc_url( $link['url'] ); ?>"
							<?php if ( $link['target'] !== '' ): ?>
								target="<?php echo esc_attr( $link['target'] ); ?>"
							<?php endif; ?>
						>
							<?php } ?>

							<?php echo esc_html( $heading ); ?>

							<?php if ( $link['url'] !== '' ) { ?>
						</a>
					<?php } ?>

					</h4>
				<?php endif; ?>
				<?php if ( $text ) : ?>
					<div class="<?php echo esc_attr( $_text_classes ); ?>">
						<?php echo esc_html( $text ); ?>
					</div>
				<?php endif; ?>

				<?php
				// Button.
				if ( $button && $button !== '' ) {
					$button = vc_build_link( $button );
					if ( $button['url'] !== '' ) {
						$_button_classes = 'tm-button style-3 tm-button-default tm-box-icon__btn';
						if ( $button_smooth_scroll === 'true' ) {
							$_button_classes .= ' smooth-scroll-link';
						}

						?>
						<a class="<?php echo esc_attr( $_button_classes ); ?>"
						   href="<?php echo esc_url( $button['url'] ) ?>"
							<?php if ( $button['target'] !== '' ) { ?>
								target="<?php echo esc_attr( $button['target'] ); ?>"
							<?php } ?>
						>
							<span><?php echo esc_html( $button['title'] ); ?></span>
						</a>
					<?php }
				} ?>
			</div>
		</div>
	</div>
</div>
