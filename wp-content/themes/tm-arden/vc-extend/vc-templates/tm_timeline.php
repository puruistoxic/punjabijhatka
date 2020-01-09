<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$style = $el_class = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-timeline ' . $el_class, $this->settings['base'], $atts );
if ( $style !== '' ) {
	$css_class .= " style-$style";
}
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<ul>
		<?php foreach ( $items as $item ) { ?>
			<li class="timeline-item">
				<div class="timeline-content-wrap">
					<?php if ( isset( $item['title'] ) ) : ?>
						<h6 class="heading"><?php echo esc_html( $item['title'] ); ?></h6>
					<?php endif; ?>
					<?php if ( isset( $item['text'] ) ) : ?>
						<div class="text"><?php echo esc_html( $item['text'] ); ?></div>
					<?php endif; ?>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>
