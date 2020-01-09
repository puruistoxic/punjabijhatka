<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $items = $heading = '';
$atts  = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( count( $items ) < 1 ) {
	return;
}
$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-menu ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_id = uniqid( 'tm-menu-' );
$this->get_inline_css( '#' . $css_id, $atts );
wp_enqueue_style( 'playfair-display', INSIGHT_PROTOCOL . '://fonts.googleapis.com/css?family=Playfair+Display:400,400i', null, null );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php if ( '' !== $heading ) : ?>
		<div class="menu-heading-wrap">
			<h3 class="menu-heading"><?php echo esc_html( $heading ); ?></h3>
		</div>
	<?php endif; ?>
	<ul class="menu-list">
		<?php
		foreach ( $items as $item ) {
			?>
			<li class="menu-item">
				<?php if ( isset( $item['title'] ) ) : ?>
					<h5 class="menu-title"><?php echo esc_html( $item['title'] ); ?></h5>
				<?php endif; ?>
				<?php if ( isset( $item['text'] ) ) : ?>
					<div class="menu-text"><?php echo esc_html( $item['text'] ); ?></div>
				<?php endif; ?>
				<?php if ( isset( $item['price'] ) ) : ?>
					<div class="menu-price"><?php echo esc_html( $item['price'] ); ?></div>
				<?php endif; ?>
			</li>
		<?php } ?>
	</ul>
</div>
