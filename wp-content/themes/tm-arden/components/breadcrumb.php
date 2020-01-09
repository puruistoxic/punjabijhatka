<?php
// DON'T render breadcrumb if the current page is the front latest posts.
if ( is_home() && is_front_page() ) {
	return;
}
?>
	<div id="page-breadcrumb" class="page-breadcrumb">
		<?php
		$breadcrumb_enable = Insight::setting( 'breadcrumb_enable' );
		if ( $breadcrumb_enable === '1' && function_exists( 'insight_core_breadcrumb' ) ) { ?>
			<div class="page-breadcrumb-inner">
				<div class="container">
					<div class="row row-xs-center">
						<div class="col-md-12">
							<?php
							echo insight_core_breadcrumb( array( 'home_label' => Insight::setting( 'breadcrumb_home_text' ) ) );
							?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php
