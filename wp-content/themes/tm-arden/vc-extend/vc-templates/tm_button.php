<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$smooth_scroll = $align = $el_class = '';
$atts          = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-button-wrapper ' . $el_class, $this->settings['base'], $atts );
$css_id    = uniqid( 'tm-button-' );
$this->get_inline_css( "#$css_id", $atts );
$classes = "tm-button";
$classes .= " style-$style";
$classes .= " tm-button-$size";
$classes .= " tm-button-$color";
// Background Color.
if ( $button_bg_color === 'primary' ) {
	$classes .= ' primary-background-color-important';
} elseif ( $button_bg_color === 'secondary' ) {
	$classes .= ' secondary-background-color-important';
}

if ( $button_bg_color_hover === 'primary' ) {
	$classes .= ' primary-background-color-hover-important';
} elseif ( $button_bg_color_hover === 'secondary' ) {
	$classes .= ' secondary-background-color-hover-important';
}

// Text Color.
if ( $font_color === 'primary' ) {
	$classes .= ' primary-color-important';
} elseif ( $font_color === 'secondary' ) {
	$classes .= ' secondary-color-important';
}

if ( $font_color_hover === 'primary' ) {
	$classes .= ' primary-color-hover-important';
} elseif ( $font_color_hover === 'secondary' ) {
	$classes .= ' secondary-color-hover-important';
}

// Border Color.
if ( $button_border_color === 'primary' ) {
	$classes .= ' primary-border-color-important';
} elseif ( $button_border_color === 'secondary' ) {
	$classes .= ' secondary-border-color-important';
}

if ( $button_border_color_hover === 'primary' ) {
	$classes .= ' primary-border-color-hover-important';
} elseif ( $button_border_color_hover === 'secondary' ) {
	$classes .= ' secondary-border-color-hover-important';
}


$button = vc_build_link( $button );

if ( $smooth_scroll !== '' ) {
	$classes .= ' smooth-scroll-link';
}

$css_class .= Insight_Helper::get_animation_classes( $animation );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	$_button_title = $button['title'] !== '' ? $button['title'] : esc_html__( 'Button Text', 'tm-arden' );
	?>
	<a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $button['url'] ); ?>"
		<?php if ( $button['target'] !== '' ) {
			echo 'target="' . $button['target'] . '"';
		} ?>
	>
		<span>
			<?php if ( $icon && $icon_align === 'left' ) { ?>
				<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
			<?php } ?>
			<?php echo esc_html( $_button_title ); ?>
			<?php if ( $icon && $icon_align === 'right' ) { ?>
				<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
			<?php } ?>
		</span>
	</a>
</div>
