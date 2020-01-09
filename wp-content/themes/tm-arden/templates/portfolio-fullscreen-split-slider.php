<?php
/**
 * Template Name: Portfolio Fullscreen Split Slider
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.0
 */
get_header();

$cats              = Insight::setting( 'portfolio_fullscreen_split_slider_categories' );
$tags              = Insight::setting( 'portfolio_fullscreen_split_slider_tags' );
$number            = Insight::setting( 'portfolio_fullscreen_split_slider_number' );
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

$insight_query          = new WP_Query( $insight_post_args );
$copyright_text         = Insight::setting( 'portfolio_fullscreen_split_slider_copyright_text' );
$social_networks_enable = Insight::setting( 'portfolio_fullscreen_split_slider_social_networks_enable' );
?>
<?php if ( $insight_query->have_posts() ) : ?>
	<?php
	$left_section  = '';
	$right_section = '';
	$tooltip       = array();
	?>
	<?php while ( $insight_query->have_posts() ) : $insight_query->the_post(); ?>
		<?php
		$tooltip[]     = get_the_title();
		$thumbnail_url = get_the_post_thumbnail_url( null, 'insight-half-part-hd' );
		?>
		<?php ob_start(); ?>
		<div class="ms-section"
			<?php if ( $thumbnail_url ) : ?>
				style="background-image: url( <?php echo esc_url( $thumbnail_url ); ?> );"
			<?php endif; ?>
		>
		</div>
		<?php
		$left_section .= ob_get_contents();
		ob_clean();
		?>
		<?php ob_start(); ?>
		<div class="ms-section"
			<?php if ( $thumbnail_url ) : ?>
				style="background-image: url( <?php echo esc_url( $thumbnail_url ); ?> );"
			<?php endif; ?>
		>
			<div class="portfolio-info">
				<div class="portfolio-categories">
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
				</div>
				<h5 class="portfolio-title">
					<a href="<?php the_permalink(); ?>"
					   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h5>
				<a class="tm-button style-2 tm-button-secondary" href="<?php the_permalink(); ?>">
					<span><?php esc_html_e( 'View Project', 'tm-arden' ); ?></span>
				</a>
			</div>
		</div>
		<?php
		$right_section .= ob_get_contents();
		ob_clean();
		?>
	<?php endwhile; ?>

	<?php
	$tooltip = htmlspecialchars( wp_json_encode( $tooltip ) );
	?>

	<div id="tm-multi-scroll" <?php echo ' data-tooltip="' . $tooltip . '"'; ?>>
		<?php echo '<div class="ms-left">' . $left_section . '</div>'; ?>
		<?php echo '<div class="ms-right">' . $right_section . '</div>'; ?>
	</div>
	<?php if ( $copyright_text !== '' || $social_networks_enable === '1' ) { ?>
		<div class="extra-info">
			<div class="row row-xs-center">
				<div class="col-sm-6 left-column">
					<?php if ( $copyright_text !== '' ) : ?>
						<?php echo esc_html( $copyright_text ); ?>
					<?php endif; ?>
				</div>
				<?php if ( $social_networks_enable === '1' ) : ?>
					<div class="col-sm-6 right-column">
						<div class="tm-social-network"><?php Insight_Templates::social_icons( array(
								'display'        => 'icon',
								'tooltip_enable' => false,
							) ); ?></div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	<?php } ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer( 'blank' );
