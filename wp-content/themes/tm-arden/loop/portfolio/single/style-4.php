<?php
// Meta.
$portfolio_url     = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$portfolio_gallery = Insight_Helper::get_post_meta( 'portfolio_gallery', '' );
?>

<div class="row portfolio-details-style4">
	<?php if ( $portfolio_gallery !== '' ) : ?>
		<div class="col-md-12">
			<div class="tm-swiper"
			     data-lg-items="1"
			     data-lg-gutter="30"
			     data-nav="1"
			>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
						foreach ( $portfolio_gallery as $key => $value ) {
							?>
							<div class="swiper-slide">
								<?php
								$full_image_size = wp_get_attachment_url( $value['id'] );
								$image_url       = Insight_Helper::aq_resize( array(
									                                              'url'    => $full_image_size,
									                                              'width'  => 1170,
									                                              'height' => 783,
									                                              'crop'   => true,
								                                              ) );
								?>
								<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
							</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
				<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
			</div>
		</div>
	<?php endif; ?>

	<div class="col-md-8">
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
	</div>

	<div class="col-md-4">

		<?php Insight_Templates::portfolio_details(); ?>

		<div class="portfolio-details-social">
			<?php Insight_Templates::portfolio_like(); ?>
			<?php Insight_Templates::portfolio_view(); ?>
			<?php Insight_Templates::portfolio_sharing(); ?>
		</div>
	</div>

</div>
<?php
Insight_Templates::portfolio_link_pages();
