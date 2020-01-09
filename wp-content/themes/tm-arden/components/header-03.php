<?php if ( Insight::setting( 'header_enable' ) == 1 ) { ?>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="header-wrap">
						<?php get_template_part( 'components/branding' ); ?>
						<div class="header-right">
							<?php do_action( 'tm_arden_header_right_before' ); ?>
							<?php Insight_Woo::render_mini_cart(); ?>
							<?php if ( Insight::setting( 'navigation_search_enable' ) ) : ?>
								<div class="popup-search-wrap">
									<a href="#" id="btn-open-popup-search" class="btn-open-popup-search"><i
											class="icon-basic-magnifier"></i></a>
								</div>
							<?php endif; ?>
							<div id="page-open-mobile-menu" class="page-open-mobile-menu">
								<div><i></i></div>
							</div>
							<div id="page-open-main-menu" class="page-open-main-menu">
								<div><i></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'components/off-canvas' ); ?>
<?php } ?>
