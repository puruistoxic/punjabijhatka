<?php
$footer_enable = Insight_Helper::get_post_meta( 'footer_enable', 2 );
if ( $footer_enable == 2 ) {
	$footer_enable = Insight::setting( 'footer_enable' );
}
$footer_columns = Insight::setting( 'footer_columns' );

$footer_widget_01 = Insight_Helper::get_post_meta( 'footer_widget_01', 'default' );
if ( $footer_widget_01 === 'default' ) {
	$footer_widget_01 = 'footer_widget_01';
}

$footer_widget_02 = Insight_Helper::get_post_meta( 'footer_widget_02', 'default' );
if ( $footer_widget_02 === 'default' ) {
	$footer_widget_02 = 'footer_widget_02';
}

$footer_widget_03 = Insight_Helper::get_post_meta( 'footer_widget_03', 'default' );
if ( $footer_widget_03 === 'default' ) {
	$footer_widget_03 = 'footer_widget_03';
}

$footer_widget_04 = Insight_Helper::get_post_meta( 'footer_widget_04', 'default' );
if ( $footer_widget_04 === 'default' ) {
	$footer_widget_04 = 'footer_widget_04';
}

$footer_widget_05 = Insight_Helper::get_post_meta( 'footer_widget_05', 'default' );
if ( $footer_widget_05 === 'default' ) {
	$footer_widget_05 = 'footer_widget_05';
}

$footer_widget_06 = Insight_Helper::get_post_meta( 'footer_widget_06', 'default' );
if ( $footer_widget_06 === 'default' ) {
	$footer_widget_06 = 'footer_widget_06';
}
?>
<?php if ( $footer_enable == 1 && Insight_Helper::is_active_footer( $footer_columns, $footer_widget_01, $footer_widget_02, $footer_widget_03, $footer_widget_04, $footer_widget_05, $footer_widget_06 ) ) { ?>
	<div id="page-footer" <?php Insight::footer_class(); ?>>
		<div class="page-footer-inner">
			<div class="page-footer-overlay"></div>
			<div class="container">
				<div class="row">
					<?php if ( $footer_columns === '1' ) { ?>
						<div class="col-md-12">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
					<?php } elseif ( $footer_columns === '2' ) { ?>
						<div class="col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
						<div class="col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_02 ); ?>
						</div>
					<?php } elseif ( $footer_columns === '3' ) { ?>
						<div class="col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
						<div class="col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_02 ); ?>
						</div>
						<div class="col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_03 ); ?>
						</div>
					<?php } elseif ( $footer_columns === '2:1:1' ) { ?>
						<div class="col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
						<div class="col-md-3">
							<?php Insight_Templates::generated_sidebar( $footer_widget_02 ); ?>
						</div>
						<div class="col-md-3">
							<?php Insight_Templates::generated_sidebar( $footer_widget_03 ); ?>
						</div>
					<?php } elseif ( $footer_columns === '4' ) { ?>
						<div class="col-lg-3 col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
						<div class="col-lg-3 col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_02 ); ?>
						</div>
						<div class="col-lg-3 col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_03 ); ?>
						</div>
						<div class="col-lg-3 col-md-6">
							<?php Insight_Templates::generated_sidebar( $footer_widget_04 ); ?>
						</div>
					<?php } elseif ( $footer_columns === '5' ) { ?>
						<div class="col-md-15">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
						<div class="col-md-15">
							<?php Insight_Templates::generated_sidebar( $footer_widget_02 ); ?>
						</div>
						<div class="col-md-15">
							<?php Insight_Templates::generated_sidebar( $footer_widget_03 ); ?>
						</div>
						<div class="col-md-15">
							<?php Insight_Templates::generated_sidebar( $footer_widget_04 ); ?>
						</div>
						<div class="col-md-15">
							<?php Insight_Templates::generated_sidebar( $footer_widget_05 ); ?>
						</div>
					<?php } elseif ( $footer_columns === '6' ) { ?>
						<div class="col-lg-2 col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_01 ); ?>
						</div>
						<div class="col-lg-2 col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_02 ); ?>
						</div>
						<div class="col-lg-2 col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_03 ); ?>
						</div>
						<div class="col-lg-2 col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_04 ); ?>
						</div>
						<div class="col-lg-2 col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_05 ); ?>
						</div>
						<div class="col-lg-2 col-md-4">
							<?php Insight_Templates::generated_sidebar( $footer_widget_06 ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
