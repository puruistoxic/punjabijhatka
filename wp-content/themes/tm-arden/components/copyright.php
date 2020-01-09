<?php
$copyright_enable = Insight_Helper::get_post_meta( 'copyright_enable', 2 );
if ( $copyright_enable == 2 ) {
	$copyright_enable = Insight::setting( 'copyright_enable' );
}
$copyright_columns = Insight::setting( 'copyright_columns' );

$copyright_widget_01 = Insight_Helper::get_post_meta( 'copyright_widget_01', 'default' );
if ( $copyright_widget_01 === 'default' ) {
	$copyright_widget_01 = 'copyright_widget_01';
}

$copyright_widget_02 = Insight_Helper::get_post_meta( 'copyright_widget_02', 'default' );
if ( $copyright_widget_02 === 'default' ) {
	$copyright_widget_02 = 'copyright_widget_02';
}

$copyright_widget_03 = Insight_Helper::get_post_meta( 'copyright_widget_03', 'default' );
if ( $copyright_widget_03 === 'default' ) {
	$copyright_widget_03 = 'copyright_widget_03';
}

$container_class = 'container';
if ( Insight::setting( 'copyright_layout' ) === 'fluid' ) {
	$container_class = 'container-fluid';
}
?>
<?php if ( $copyright_enable == 1 && Insight_Helper::is_active_copyright( $copyright_columns, $copyright_widget_01, $copyright_widget_02, $copyright_widget_03 ) ) { ?>
	<div id="page-copyright" <?php Insight::copyright_class() ?>>
		<div class="page-copyright-inner">
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<div class="row row-md-center">
					<?php if ( $copyright_columns === '1' ) { ?>
						<div class="col-lg-12 text-align-xs-center">
							<?php Insight_Templates::generated_sidebar( $copyright_widget_01 ); ?>
						</div>
					<?php } elseif ( $copyright_columns === '2' ) { ?>
						<div class="col-md-6 text-align-xs-center text-align-xl-left">
							<?php Insight_Templates::generated_sidebar( $copyright_widget_01 ); ?>
						</div>
						<div class="col-md-6 text-align-xs-center text-align-xl-right">
							<?php Insight_Templates::generated_sidebar( $copyright_widget_02 ); ?>
						</div>
					<?php } elseif ( $copyright_columns === '3' ) { ?>
						<div class="col-xl-4 text-align-xs-center text-align-xl-left">
							<?php Insight_Templates::generated_sidebar( $copyright_widget_01 ); ?>
						</div>
						<div class="col-xl-4 text-align-xs-center">
							<?php Insight_Templates::generated_sidebar( $copyright_widget_02 ); ?>
						</div>
						<div class="col-xl-4 text-align-xs-center text-align-xl-right">
							<?php Insight_Templates::generated_sidebar( $copyright_widget_03 ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
