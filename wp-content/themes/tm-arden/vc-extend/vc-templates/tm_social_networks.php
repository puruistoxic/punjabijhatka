<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$target = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-social-networks-' );
$this->get_inline_css( '#' . $css_id );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-social-networks ' . $el_class, $this->settings['base'], $atts );
$css_class .= ' tm-social-networks--' . $style;
$css_class .= ' tm-social-networks--' . $skin;
$items      = (array) vc_param_group_parse_atts( $items );
$link_class = 'tm-social-networks__link ';

if ( $tooltip_enable === 'true' ) {
	$link_class .= 'hint--bounce hint--top';
}

?>
<?php if ( count( $items ) > 0 ) { ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
		<?php
		foreach ( $items as $item ) {
			$_icon = $link_content = '';

			$icon_class = 'tm-social-networks__icon ';
			if ( isset( $item['type'] ) && isset( $item[ "icon_" . $item['type'] ] ) ) {
				$icon_class .= esc_attr( $item[ "icon_" . $item['type'] ] );
			}
			if ( $icon_class !== '' ) {
				$_icon = '<i class="' . $icon_class . '"></i>';
			}

			if ( $style === 'icons' ) {
				$link_content = $_icon;
			} else if ( $style === 'title' ) {
				$link_content = $item['title'];
			}
			?>
			<a href="<?php echo esc_url( $item['link'] ); ?>"
				<?php if ( $target === 'true' ): ?>
					target="_blank"
				<?php endif; ?>
				<?php if ( isset( $item['title'] ) ): ?>
					aria-label="<?php echo esc_attr( $item['title'] ); ?>"
				<?php endif; ?>
				<?php if ( $link_class !== '' ): ?>
					class="<?php echo esc_attr( $link_class ); ?>"
				<?php endif; ?>
			><?php echo "<span>{$link_content}</span>"; ?></a>
			<?php
		}
		?>
	</div>
<?php }
