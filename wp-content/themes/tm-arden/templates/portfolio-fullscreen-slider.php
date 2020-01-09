<?php
/**
 * Template Name: Portfolio Fullscreen Slider
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.0
 */
get_header();

$cats              = Insight::setting( 'portfolio_fullscreen_slider_categories' );
$tags              = Insight::setting( 'portfolio_fullscreen_slider_tags' );
$number            = Insight::setting( 'portfolio_fullscreen_slider_number' );
$insight_post_args = array(
	'post_type'      => 'portfolio',
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
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $cats,
		);
	}
	if ( count( $tags ) > 0 && $tags[0] !== '' ) {
		$tax_queries[] = array(
			'taxonomy' => 'portfolio_tags',
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
	<div class="tm-swiper"
	     data-lg-items="1"
	     data-nav="1"
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
							<div class="portfolio-info">
								<h5 class="portfolio-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="portfolio-categories">
									<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endwhile; ?>
			</div>
		</div>
		<div class="swiper-nav-button swiper-button-prev"><i class="icon-arrows-left"></i></div>
		<div class="swiper-nav-button swiper-button-next"><i class="icon-arrows-right"></i></div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer( 'blank' );
