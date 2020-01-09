<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$size = $track_width = $line_width = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( $size === '' ) {
	$size = 180;
}

if ( $track_width === '' ) {
	$track_width = 5;
}

if ( $line_width === '' ) {
	$line_width = 5;
}

$css_class        = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-pie-chart ', $this->settings['base'], $atts );
$_bar_color       = '';
$_primary         = Insight::setting( 'primary_color' );
$_secondary_color = Insight::setting( 'secondary_color' );

if ( $bar_color === 'primary_color' ) {
	$_bar_color = $_primary;
} elseif ( $bar_color === 'secondary_color' ) {
	$_bar_color = $_secondary_color;
} else {
	$_bar_color = $custom_bar_color;
}

$_track_color = '';
if ( $track_color === 'primary_color' ) {
	$_track_color = $_primary;
} elseif ( $track_color === 'secondary_color' ) {
	$_track_color = $_secondary_color;
} else {
	$_track_color = $custom_track_color;
}

wp_enqueue_script( 'easing' );
wp_enqueue_script( 'easy-pie-chart' );
wp_enqueue_script( 'tm-pie-chart' );
?>
<div class="<?php echo esc_attr( trim( $css_class ) ); ?>"
     data-size="<?php echo esc_attr( $size ); ?>"
     data-line-width="<?php echo esc_attr( $line_width ); ?>"
     data-track-width="<?php echo esc_attr( $track_width ); ?>"
     data-bar-color="<?php echo esc_attr( $_bar_color ); ?>"
     data-track-color="<?php echo esc_attr( $_track_color ); ?>"
>
	<div class="chart"
		<?php
		printf( 'style="width: %spx; height: %spx;"', $size, $size );
		?>
		<?php if ( isset( $chart_value ) ) : ?>
			data-percent="<?php echo esc_attr( $chart_value ); ?>"
		<?php endif; ?>
	>
		<span class="chart-text">0</span>
	</div>
	<?php if ( isset( $chart_text ) ) : ?>
		<div class="heading"><h6><?php echo esc_html( $chart_text ); ?></h6></div>
	<?php endif; ?>
	<?php if ( isset( $chart_desc ) ) : ?>
		<div class="desc"><?php echo esc_html( $chart_desc ); ?></div>
	<?php endif; ?>
</div>
