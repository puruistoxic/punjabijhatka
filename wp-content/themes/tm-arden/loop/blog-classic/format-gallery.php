<?php
$post_options = unserialize( get_post_meta( get_the_ID(), 'insight_post_options', true ) );
if ( $post_options !== false && isset( $post_options['post_gallery'] ) ) {
	$gallery = $post_options['post_gallery'];
	?>
	<div class="post-gallery tm-swiper has-pagination pagination-style-1" data-pagination="1" data-loop="1">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ( $gallery as $image ) { ?>
					<div class="swiper-slide">
						<?php echo wp_get_attachment_image( $image['id'], 'insight-blog-classic-preview-image' ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="swiper-pagination"></div>
	</div>
<?php } ?>
