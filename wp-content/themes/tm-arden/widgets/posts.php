<?php
if ( ! class_exists( 'TM_Posts_Widget' ) ) {
	class TM_Posts_Widget extends Insight_Widget {

		public function __construct() {

			$cat_options = array(
				'recent_posts' => esc_html__( 'Recent Posts', 'tm-arden' ),
				'sticky_posts' => esc_html__( 'Sticky Posts', 'tm-arden' ),
			);
			$categories  = get_categories( 'hide_empty=0' );
			if ( $categories ) {
				foreach ( $categories as $category ) {
					$cat_options[ $category->term_id ] = esc_html__( 'Category: ', 'tm-arden' ) . $category->name;
				}
			}

			$this->widget_cssclass    = 'tm-posts-widget';
			$this->widget_description = esc_html__( 'Get list blog post.', 'tm-arden' );
			$this->widget_id          = 'tm-posts-widget';
			$this->widget_name        = esc_html__( '[Insight] Posts', 'tm-arden' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title', 'tm-arden' ),
				),
				'cat'   => array(
					'type'    => 'select',
					'std'     => 'recent_posts',
					'label'   => esc_html__( 'Category', 'tm-arden' ),
					'options' => $cat_options,
				),
				'num'   => array(
					'type'  => 'number',
					'step'  => 1,
					'min'   => 1,
					'max'   => 40,
					'std'   => 5,
					'label' => esc_html__( 'Number Posts', 'tm-arden' ),
				),
			);

			parent::__construct();
		}

		public function widget( $args, $instance ) {
			$cat = isset( $instance['cat'] ) ? $instance['cat'] : $this->settings['cat']['std'];
			$num = isset( $instance['num'] ) ? $instance['num'] : $this->settings['num']['std'];

			$this->widget_start( $args, $instance );

			if ( $cat === 'recent_posts' ) {
				$query_args = array(
					'post_type'           => 'post',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
					'orderby'             => 'ID',
					'order'               => 'DESC',
				);
			} elseif ( $cat === 'sticky_posts' ) {
				$sticky     = get_option( 'sticky_posts' );
				$query_args = array(
					'post_type'      => 'post',
					'post__in'       => $sticky,
					'posts_per_page' => $num,
				);
			} else {
				$query_args = array(
					'post_type'           => 'post',
					'cat'                 => $cat,
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => $num,
				);
			}

			$insight_query = new WP_Query( $query_args );
			if ( $insight_query->have_posts() ) {
				$count = $insight_query->post_count;
				$i     = 0;
				?>
				<div class="tm-posts-widget-wrapper">
					<?php
					while ( $insight_query->have_posts() ) {
						$insight_query->the_post();
						$i ++;
						$classes = array( 'post-item' );
						if ( $i === 1 ) {
							$classes[] = 'first-post';
						} elseif ( $i === $count ) {
							$classes[] = 'last-post';
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?> >
							<div class="post-widget-thumbnail">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'thumbnail' );
									} else {
										Insight_Templates::image_placeholder( 150, 150 );
									}
									?>
									<div class="post-widget-overlay"></div>
								</a>
							</div>
							<div class="post-widget-info">
								<h5 class="post-widget-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<span class="post-date style-1"><?php echo get_the_date( 'F d, Y' ); ?></span>
							</div>
						</div>
						<?php
					} ?>
				</div>
				<?php
			}
			wp_reset_postdata();

			$this->widget_end( $args );
		}
	}
}
