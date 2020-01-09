<?php
/**
 * Template part for displaying blog content in home.php, archive.php.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.0
 */
$style = '1';

if ( have_posts() ) :
	global $wp_query;
	$insight_query = $wp_query;
	$i             = 0;
	$count         = $insight_query->post_count;
	$classes       = array(
		'tm-blog',
		'style-' . $style,
	);
	$grid_classes  = array( 'tm-grid' );

	?>
	<div class="tm-grid-wrapper <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="<?php echo esc_attr( implode( ' ', $grid_classes ) ); ?>"
			<?php
			if ( $style === '1' ) {
				echo 'data-grid-has-gallery="true"';
			}
			?>
		>
			<?php if ( $style === '1' ) { ?>
				<?php
				while ( $insight_query->have_posts() ) :
					$insight_query->the_post();
					$classes = array( 'grid-item', 'post-item' );
					?>
					<div <?php post_class( implode( ' ', $classes ) ); ?>>
						<?php if ( has_post_thumbnail() ) { ?>
							<?php
							$full_image_size = get_the_post_thumbnail_url( null, 'full' );
							$image_url       = Insight_Helper::aq_resize( array(
								                                              'url'    => $full_image_size,
								                                              'width'  => 770,
								                                              'height' => 520,
								                                              'crop'   => true,
							                                              ) );
							?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>"
								   title="<?php the_title_attribute(); ?>">
									<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php get_the_title(); ?>"/>
								</a>
							</div>
						<?php } ?>
						<div class="post-info">
							<?php if ( has_category() ) : ?>
								<div class="post-categories"><?php the_category( ', ' ); ?></div>
							<?php endif; ?>
							<h2 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h2>
							<?php if ( is_sticky() ) : ?>
								<span class="post-sticky"><i class="fa fa-thumb-tack" aria-hidden="true"></i>
									<?php esc_html_e( 'Sticky', 'tm-arden' ); ?></span>
							<?php endif; ?>
							<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
							<div class="post-excerpt">
								<?php Insight_Templates::excerpt( array( 'limit' => 42, 'type' => 'word' ) ); ?>
							</div>
							<div class="post-read-more">
								<a class="tm-button style-3 tm-button-default tm-button-lg"
								   href="<?php the_permalink(); ?>">
									<span><?php esc_html_e( 'Read full post', 'tm-arden' ); ?></span>
								</a>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			<?php } ?>
		</div>
		<div class="tm-grid-pagination">
			<?php Insight_Templates::paging_nav(); ?>
		</div>
	</div>
<?php else : get_template_part( 'components/content', 'none' ); ?>
<?php endif; ?>
