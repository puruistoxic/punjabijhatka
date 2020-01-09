<?php
/**
 * Template Name: Fullscreen Split Feature
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.0
 */
get_header();
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$thumbnail_url = get_the_post_thumbnail_url( null, 'insight-half-part-hd' );
		?>
		<div id="fullscreen-wrap" class="fullscreen-wrap">
			<div class="left-section"
				<?php if ( $thumbnail_url ) : ?>
					style="background-image: url( <?php echo esc_url( $thumbnail_url ); ?> );"
				<?php endif; ?>
			>
			</div>
			<div class="right-section">
				<div class="row">
					<div class="col-md-12">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="tm-social-network"><?php Insight_Templates::social_icons( array(
					                                                                      'display'        => 'text',
					                                                                      'tooltip_enable' => false,
				                                                                      ) ); ?></div>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer( 'blank' );
