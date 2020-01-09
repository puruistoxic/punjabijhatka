<?php
/**
 * Template Name: Blog Fullscreen Slider
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.3
 */
get_header();

$cats              = Insight::setting( 'blog_fullscreen_slider_categories' );
$tags              = Insight::setting( 'blog_fullscreen_slider_tags' );
$number            = Insight::setting( 'blog_fullscreen_slider_number' );
$insight_post_args = array(
	'post_type'      => 'post',
	'orderby'        => 'date',
	'order'          => 'DESC',
	'post_status'    => 'publish',
	'posts_per_page' => $number,
);

if ( ( count( $cats ) > 0 && $cats[0] !== '' ) || ( count( $tags ) > 0 && $tags[0] !== '' ) ) {
	$insight_post_args['tax_query'] = array();
	$tax_queries                    = array(); // List of taxonomies.
	if ( count( $cats ) > 0 && $cats[0] !== '' ) {
		$tax_queries[] = array(
			'taxonomy' => 'category',
			'field'    => 'slug',
			'terms'    => $cats,
		);
	}
	if ( count( $tags ) > 0 && $tags[0] !== '' ) {
		$tax_queries[] = array(
			'taxonomy' => 'post_tag',
			'field'    => 'slug',
			'terms'    => $tags,
		);
	}
	$insight_post_args['tax_query']             = $tax_queries;
	$insight_post_args['tax_query']['relation'] = 'OR';
}

$insight_query = new WP_Query( $insight_post_args );
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<div class="tm-swiper pagination-style-1"
	     data-lg-items="1"
	     data-nav="1"
	     data-pagination="1"
	     data-mousewheel="1"
	     data-loop="1"
	     data-effect="fade"
	>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="swiper-slide"
						     style="background-image: url( <?php the_post_thumbnail_url( 'insight-full-hd' ); ?> );">
							<div class="post-overlay"></div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-excerpt">
									<?php Insight_Templates::excerpt( array( 'limit' => 22, 'type' => 'word' ) ); ?>
								</div>
								<div class="post-read-more">
									<a class="tm-button style-2 tm-button-nm tm-button-white"
									   href="<?php the_permalink(); ?>">
										<span><?php esc_html_e( 'Read post', 'tm-arden' ); ?></span>
									</a>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>
		<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
		<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
		<div class="swiper-pagination"></div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer( 'blank' );
