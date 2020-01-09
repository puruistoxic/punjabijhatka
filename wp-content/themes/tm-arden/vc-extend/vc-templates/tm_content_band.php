<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-content-band ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";

$css_id = uniqid( 'tm-content-band-' );
$this->get_inline_css( '#' . $css_id, $atts );

$css_class .= Insight_Helper::get_animation_classes( $animation );

$image_url = wp_get_attachment_url( $image );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>"
     style="<?php echo esc_attr( 'background-image: url(' . $image_url . ');' ) ?>">
	<div class="content">
		<div class="content-inner">
			<?php if ( $heading ) : ?>
				<div class="heading-wrap">
					<h4 class="heading">
						<?php echo esc_html( $heading ); ?>
					</h4>
				</div>
			<?php endif; ?>
			<?php if ( $text ) : ?>
				<div class="text">
					<?php echo esc_html( $text ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
