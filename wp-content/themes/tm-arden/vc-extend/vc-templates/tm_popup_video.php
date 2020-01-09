<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$style = $el_class = $video = $poster = $image_size = $overlay_style = $button_style = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class  = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-popup-video ' . $el_class, $this->settings['base'], $atts );
$css_class .= " style-$style";
$css_class .= " button-style-$button_style";
if ( $overlay_style !== '' ) {
	$css_class .= " overlay-style-$overlay_style";
}
?>
<?php if ( $video !== '' ) : ?>
	<div class="<?php echo esc_attr( trim( $css_class ) ); ?>">
		<a href="<?php echo esc_url( $video ); ?>">
			<?php if ( $style === 'poster' ) { ?>
				<?php echo wp_get_attachment_image( $poster, $image_size ); ?>
				<div class="video-overlay">
					<div class="video-play">
						<?php if ( $button_style === '1' ) { ?>
							<i class="icon-music-play-button"></i>
						<?php } elseif ( $button_style === '2' ) { ?>
							<div class="video-play-icon">
								<svg width="21px" height="34px" viewBox="0 0 21 34" version="1.1"
								     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<!-- Generator: Sketch 41.2 (35397) - http://www.bohemiancoding.com/sketch -->
									<title>Shape</title>
									<desc>Created with Sketch.</desc>
									<defs></defs>
									<g id="Construction" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<g transform="translate(-1203.000000, -1239.000000)" id="Group-2" fill="#FFFFFF">
											<g transform="translate(1164.000000, 1208.000000)">
												<polygon id="Shape" points="39 31 60 48 39 65"></polygon>
											</g>
										</g>
									</g>
								</svg>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="video-play">
					<?php if ( $button_style === '1' ) { ?>
						<i class="icon-music-play-button"></i>
					<?php } elseif ( $button_style === '2' ) { ?>
						<div class="video-play-icon">
							<svg width="21px" height="34px" viewBox="0 0 21 34" version="1.1"
							     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
								<!-- Generator: Sketch 41.2 (35397) - http://www.bohemiancoding.com/sketch -->
								<title>Shape</title>
								<desc>Created with Sketch.</desc>
								<defs></defs>
								<g id="Construction" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g transform="translate(-1203.000000, -1239.000000)" id="Group-2" fill="#FFFFFF">
										<g transform="translate(1164.000000, 1208.000000)">
											<polygon id="Shape" points="39 31 60 48 39 65"></polygon>
										</g>
									</g>
								</g>
							</svg>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</a>
	</div>
<?php endif;
