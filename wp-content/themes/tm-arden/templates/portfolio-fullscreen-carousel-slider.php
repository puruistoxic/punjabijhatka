<?php
/**
 * Template Name: Portfolio Fullscreen Carousel Slider
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.2.0
 */
get_header();

$cats              = Insight::setting( 'portfolio_fullscreen_carousel_slider_categories' );
$tags              = Insight::setting( 'portfolio_fullscreen_carousel_slider_tags' );
$number            = Insight::setting( 'portfolio_fullscreen_carousel_slider_number' );
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
	<div id="tm-m-scrollbar" class="tm-m-scrollbar">
		<div class="portfolio-list">
			<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>
				<div class="portfolio-item"
					<?php
					if ( has_post_thumbnail() ) :
						$full_image_size = get_the_post_thumbnail_url( null, 'full' );
						$image_url = Insight_Helper::aq_resize( array(
							'url'    => $full_image_size,
							'width'  => 640,
							'height' => 1000,
							'crop'   => true,
						) );
						?>
						style="background-image: url( <?php echo esc_url( $image_url ); ?> );"
					<?php endif; ?>
				>
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
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer();
