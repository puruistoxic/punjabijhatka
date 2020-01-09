<?php
// Meta.
$portfolio_url     = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Insight_Helper::get_post_meta( 'portfolio_gallery', '' );

if ( $portfolio_gallery !== '' || has_post_thumbnail() ) {
	$class = 'col-md-4';
} else {
	$class = 'col-md-12';
}
$grid_classes = 'tm-grid tm-light-gallery';
$grid_classes .= Insight_Helper::get_grid_animation_classes( 'scale-up' );
?>
	<div class="row portfolio-details-style3">
		<div class="<?php echo esc_attr( $class ); ?>">
			<div id="sticky-element" class="tm-sticky-kit">
				<div class="portfolio-details-content">
					<h3 class="portfolio-details-heading"><?php the_title(); ?></h3>
					<?php the_content(); ?>

					<?php if ( $portfolio_url !== '' ) : ?>
						<a class="tm-button tm-button-default style-3 tm-button-view-project"
						   href="<?php echo esc_url( $portfolio_url ); ?>">
							<span><?php esc_html_e( 'Visit site', 'tm-arden' ); ?></span>
						</a>
					<?php endif; ?>
				</div>

				<?php Insight_Templates::portfolio_details(); ?>

				<div class="portfolio-details-social">
					<?php Insight_Templates::portfolio_like(); ?>
					<?php Insight_Templates::portfolio_view(); ?>
					<?php Insight_Templates::portfolio_sharing(); ?>
				</div>
			</div>
		</div>

		<?php if ( $portfolio_gallery !== '' || has_post_thumbnail() ) { ?>
			<div class="col-md-8">
				<div class="feature-wrap">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="portfolio-feature">
							<?php
							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							$image_url       = Insight_Helper::aq_resize( array(
								                                              'url'    => $full_image_size,
								                                              'width'  => 740,
								                                              'height' => 9999,
								                                              'crop'   => false,
							                                              ) );
							?>
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
						</div>
					<?php endif; ?>
					<?php if ( $portfolio_gallery !== '' ) : ?>
						<div class="tm-grid-wrapper tm-grid-masonry tm-gallery"
						     data-type="masonry"
						     data-lg-columns="3"
						     data-md-columns="2"
						     data-gutter="30"
						>
							<div class="<?php echo esc_attr( $grid_classes ); ?>">
								<div class="grid-sizer"></div>
								<?php
								foreach ( $portfolio_gallery as $key => $value ) {
									?>
									<div class="grid-item gallery-item">
										<a href="<?php echo wp_get_attachment_url( $value['id'], 'full' ); ?>"
										   class="zoom">

											<?php
											$full_image_size = wp_get_attachment_url( $value['id'] );
											$image_url       = Insight_Helper::aq_resize( array(
												                                              'url'    => $full_image_size,
												                                              'width'  => 300,
												                                              'height' => 9999,
												                                              'crop'   => false,
											                                              ) );
											?>
											<img src="<?php echo esc_url( $image_url ); ?>"
											     alt="<?php get_the_title(); ?>"/>
											<div class="overlay">
												<div>+</div>
											</div>
										</a>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php
Insight_Templates::portfolio_link_pages();
