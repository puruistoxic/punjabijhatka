<?php
// Meta.
$portfolio_url    = Insight_Helper::get_post_meta( 'portfolio_url', '' );
$video            = Insight_Helper::get_post_meta( 'portfolio_video_url', '' );
?>

	<div class="row portfolio-details-style5">
		<?php if ( $video !== '' ) : ?>
			<div class="col-md-12">
				<div class="post-video embed-responsive-16by9 embed-responsive">
					<?php if ( wp_oembed_get( $video ) ) { ?>
						<?php echo Insight_Helper::w3c_iframe( wp_oembed_get( $video ) ); ?>
					<?php } else { ?>
						<?php Insight_Helper::w3c_iframe( $video ); ?>
					<?php } ?>
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
