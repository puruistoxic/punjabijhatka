<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$username = $overlay = $link_target = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-instagram ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$classes   = array( 'tm-instagram-pics' );

$css_id = uniqid( 'tm-instagram-' );
$this->get_inline_css( "#$css_id", $atts );
?>
<div id="<?php echo esc_attr( $css_id ); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php

	if ( $username !== '' ) {
		$media_array = Insight_Instagram::scrape_instagram( $username );
		if ( is_wp_error( $media_array ) ) {
			?>
			<div class="tm-instagram--error">
				<?php echo '<p>' . $media_array->get_error_message() . '</p>'; ?>
			</div>
			<?php
		} else {
			$media_array = array_slice( $media_array, 0, $number_items );
			?>
			<?php if ( '' !== $heading ) : ?>
				<h5 class="heading">
					<?php echo esc_html( $heading ); ?>
				</h5>
			<?php endif; ?>
			<p class="username"><?php echo esc_html__( 'Follow', 'tm-arden' ) . ' <a href="' . esc_url( 'https://www.instagram.com/' . $username ) . '" ' . ( '1' === $link_target ? 'target="_blank"' : '' ) . '>' . $username . '</a>'; ?></p>
			<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
				<?php foreach ( $media_array as $item ) { ?>
					<li class="item">
						<div class="inner">
							<img src="<?php echo esc_url( $item['large'] ); ?>"
							     alt="<?php echo esc_attr( $item['description'] ); ?>" class="item-image"/>
							<?php if ( 'video' === $item['type'] ) : ?>
								<span class="play-button"></span>
							<?php endif; ?>

							<a href="<?php echo esc_url( $item['link'] ); ?>"
								<?php if ( '1' === $link_target ) : ?>
									target="_blank"
								<?php endif; ?>
							>
								<div class="overlay">
									<?php if ( '1' === $overlay ) : ?>
										<ul class="item-info">
											<li class="likes"><span><?php echo esc_html( $item['likes'] ); ?></span>
											</li>
											<li class="comments">
												<span><?php echo esc_html( $item['comments'] ); ?></span></li>
										</ul>
									<?php endif; ?>
								</div>
							</a>
						</div>
					</li>
				<?php } ?>
			</ul>
		<?php }
	} ?>
</div>
