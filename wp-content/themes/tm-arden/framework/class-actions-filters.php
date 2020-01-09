<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom filters that act independently of the theme templates
 */
if ( ! class_exists( 'Insight_Actions_Filters' ) ) {
	class Insight_Actions_Filters {

		/**
		 * Insight_Filters constructor.
		 */
		public function __construct() {
			/* Move post count inside the link */
			add_filter( 'wp_list_categories', array( $this, 'move_post_count_inside_link_category' ) );
			/* Move post count inside the link */
			add_filter( 'get_archives_link', array( $this, 'move_post_count_inside_link_archive' ) );

			add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );
			add_filter( 'widget_tag_cloud_args', array( $this, 'change_widget_tag_cloud_args' ) );
			add_filter( 'embed_oembed_html', array( $this, 'add_wrapper_for_video' ), 10, 3 );
			add_filter( 'video_embed_html', array( $this, 'add_wrapper_for_video' ) ); // Jetpack.
			add_filter( 'excerpt_length', array(
				$this,
				'custom_excerpt_length',
			), 999 ); // Change excerpt length is set to 55 words by default.

			// Adds custom classes to the array of body classes.
			add_filter( 'body_class', array( $this, 'body_classes' ) );

			// Adds custom attributes to body tag.
			add_filter( 'insight_body_attributes', array( $this, 'add_attributes_to_body' ) );

			remove_filter( 'the_excerpt', 'wpautop' );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', array( $this, 'alter_search_loop' ), 1 );
				add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
				add_filter( 'pre_get_posts', array( $this, 'empty_search_filter' ) );
			}

			add_action( 'wp_ajax_portfolio_infinite_load', array( $this, 'portfolio_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_portfolio_infinite_load', array( $this, 'portfolio_infinite_load' ) );

			add_action( 'wp_ajax_post_infinite_load', array( $this, 'post_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_post_infinite_load', array( $this, 'post_infinite_load' ) );

			add_action( 'wp_ajax_product_infinite_load', array( $this, 'product_infinite_load' ) );
			add_action( 'wp_ajax_nopriv_product_infinite_load', array( $this, 'product_infinite_load' ) );

			// Add inline style for shortcode.
			add_action( 'wp_footer', array( $this, 'shortcode_style' ), 9999 );

			add_filter( 'insightcore_bmw_nav_args', array( $this, 'add_extra_params_to_insightcore_bmw' ) );

			add_filter( 'insight_core_user_contactmethods', array(
				$this,
				'add_extra_fields_for_user_contactmethods',
			) );
		}

		function add_extra_params_to_insightcore_bmw( $args ) {
			$args['walker'] = new Insight_Walker_Nav_Menu;

			return $args;
		}

		function move_post_count_inside_link_category( $links ) {
			$links = str_replace( '</a>', '', $links );
			$links = str_replace( '</li>', '</a></li>', $links );

			return $links;
		}

		function move_post_count_inside_link_archive( $links ) {
			$links = str_replace( '</a>&nbsp;(', ' (', $links );
			$links = str_replace( ')', ')</a>', $links );

			return $links;
		}


		function change_widget_tag_cloud_args( $args ) {
			/* set the smallest & largest size in px */
			$args['separator'] = ', ';

			return $args;
		}

		function move_comment_field_to_bottom( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;

			return $fields;
		}

		function shortcode_style() {
			global $insight_shortcode_css;
			global $insight_shortcode_md_css;
			global $insight_shortcode_sm_css;
			global $insight_shortcode_xs_css;

			if ( $insight_shortcode_md_css !== '' ) {
				$insight_shortcode_md_css = "@media (max-width: 1199px) { $insight_shortcode_md_css }";
			}

			if ( $insight_shortcode_sm_css !== '' ) {
				$insight_shortcode_sm_css = "@media (max-width: 992px) { $insight_shortcode_sm_css }";
			}

			if ( $insight_shortcode_xs_css !== '' ) {
				$insight_shortcode_xs_css = "@media (max-width: 767px) { $insight_shortcode_xs_css }";
			}

			$css = $insight_shortcode_css . $insight_shortcode_md_css . $insight_shortcode_sm_css . $insight_shortcode_xs_css;
			if ( $css !== '' ) :
				$css = Insight_Minify::css( $css );
				?>
				<script type="text/javascript">
					var mainStyle = document.getElementById( 'insight-style-inline-css' );
					if ( mainStyle !== null ) {
						mainStyle.textContent += '<?php echo '' . $css; ?>';
					}
				</script>
			<?php endif;
		}

		/**
		 * Remove empty p tag created by wpautop()
		 */
		public function remove_empty_p( $content ) {
			$content = force_balance_tags( $content );
			$content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
			$content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );

			return $content;
		}

		public function alter_search_loop( $query ) {
			if ( $query->is_main_query() && $query->is_search() ) {
				$number_results = Insight::setting( 'search_page_number_results' );
				$query->set( 'posts_per_page', $number_results );
			}
		}

		/**
		 * Apply filters to the search query.
		 * Determines if we only want to display posts/pages and changes the query accordingly
		 */
		public function search_filter( $query ) {
			if ( $query->is_main_query() && $query->is_search ) {
				$filter = Insight::setting( 'search_page_filter' );
				if ( $filter !== 'all' ) {
					$query->set( 'post_type', $filter );
				}
			}

			return $query;
		}

		/**
		 * Make wordpress respect the search template on an empty search
		 */
		public function empty_search_filter( $query ) {
			if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
				$query->is_search = true;
				$query->is_home   = false;
			}

			return $query;
		}

		public function add_extra_fields_for_user_contactmethods( $fields ) {
			$fields[] = array(
				'name'  => 'email_address',
				'label' => esc_html__( 'Email Address', 'tm-arden' ),
			);

			$fields[] = array(
				'name'  => 'facebook',
				'label' => esc_html__( 'Facebook', 'tm-arden' ),
			);

			$fields[] = array(
				'name'  => 'twitter',
				'label' => esc_html__( 'Twitter', 'tm-arden' ),
			);

			$fields[] = array(
				'name'  => 'google_plus',
				'label' => esc_html__( 'Google+', 'tm-arden' ),
			);

			$fields[] = array(
				'name'  => 'instagram',
				'label' => esc_html__( 'Instagram', 'tm-arden' ),
			);

			$fields[] = array(
				'name'  => 'linkedin',
				'label' => esc_html__( 'Linkedin', 'tm-arden' ),
			);

			$fields[] = array(
				'name'  => 'pinterest',
				'label' => esc_html__( 'Pinterest', 'tm-arden' ),
			);

			return $fields;
		}

		public function custom_excerpt_length() {
			return 999;
		}

		/**
		 * Add responsive container to embeds
		 */
		public function add_wrapper_for_video( $html, $url ) {
			$array = array(
				'youtube.com',
				'wordpress.tv',
				'vimeo.com',
				'dailymotion.com',
				'hulu.com',
			);

			if ( Insight_Helper::strposa( $url, $array ) ) {
				$html = '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
			}

			return $html;
		}

		public function portfolio_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			$style = '1';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}
			$overlay_style  = $_POST['overlay_style'];
			$thumbnail_size = $_POST['thumbnail_size'];
			$count          = $_POST['count'];
			$insight_query  = new WP_Query( $args );

			if ( $insight_query->have_posts() ) : ?>
				<?php if ( $style === '1' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'portfolio-item grid-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-content">
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php
										if ( has_post_thumbnail() ) {
											the_post_thumbnail( $thumbnail_size );
										} else {
											switch ( $thumbnail_size ) {
												case 'insight-grid-classic-square' :
													Insight_Templates::image_placeholder( 600, 600 );
													break;
												case 'insight-grid-classic-2' :
													Insight_Templates::image_placeholder( 600, 463 );
													break;
												default :
													Insight_Templates::image_placeholder( 500, 675 );
													break;
											}
										}
										?>
									</a>
									<?php if ( $overlay_style !== '' ) : ?>
										<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
									<?php endif; ?>
								</div>
								<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
									<div class="post-info">
										<h5 class="post-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>
										<div class="post-categories">
											<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '2' ) { ?>
					<?php
					$metro_layout       = array(
						'',
						'grid-item--width2 grid-item--height2',
						'grid-item--height2',
						'',
						'',
						'grid-item--width2 grid-item--height2',
						'',
						'grid-item--height2',
						'',
						'',
					);
					$metro_layout_count = count( $metro_layout );
					$metro_item_count   = 0;
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes    = array( 'portfolio-item grid-item' );
						$categories = get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' );


						$_image_size              = 'insight-grid-metro';
						$_image_placeholdit_width = 400;
						$_image_placeholdit_heigh = 400;


						$classes[] = $metro_layout[ $metro_item_count ];
						if ( $metro_layout[ $metro_item_count ] === 'grid-item--height2' ) {
							$_image_size               = 'insight-grid-metro-height-2';
							$_image_placeholdit_height = 800;
						} elseif ( $metro_layout[ $metro_item_count ] === 'grid-item--width2 grid-item--height2' ) {
							$_image_placeholdit_width  = 800;
							$_image_placeholdit_height = 800;
							$_image_size               = 'insight-grid-metro-width-2-height-2';
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>
							<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
								'grid-item--width2',
								'grid-item--width2 grid-item--height2',
							), true ) ) : ?>
								data-width="2"
							<?php endif; ?>
							<?php if ( in_array( $metro_layout[ $metro_item_count ], array(
								'grid-item--height2',
								'grid-item--width2 grid-item--height2',
							), true ) ) : ?>
								data-height="2"
							<?php endif; ?>
						>
							<div class="post-content">
								<div class="post-thumbnail">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( $_image_size );
									} else {
										Insight_Templates::image_placeholder( $_image_placeholdit_width, 570 );
									}
									?>
									<?php if ( $overlay_style !== '' ) : ?>
										<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
									<?php endif; ?>
								</div>
								<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
									<div class="post-info">
										<h5 class="post-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>
										<div class="post-categories">
											<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<?php
						$metro_item_count++;
						if ( $metro_item_count == $count || $metro_layout_count == $metro_item_count ) {
							$metro_item_count = 0;
						}
						?>
					<?php endwhile; ?>
				<?php } elseif ( $style === '3' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'portfolio-item grid-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-content">
								<div class="post-thumbnail">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( 'insight-grid-masonry' );
									} else {
										Insight_Templates::image_placeholder( 570, 570 );
									}
									?>
									<?php if ( $overlay_style !== '' ) : ?>
										<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '4' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'portfolio-item grid-item swiper-slide' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-content">
								<div class="post-thumbnail">
									<?php
									if ( has_post_thumbnail() ) {
										the_post_thumbnail( $thumbnail_size );
									} else {
										switch ( $thumbnail_size ) {
											case 'insight-grid-classic-square' :
												Insight_Templates::image_placeholder( 600, 600 );
												break;
											case 'insight-grid-classic-2' :
												Insight_Templates::image_placeholder( 600, 463 );
												break;
											default :
												Insight_Templates::image_placeholder( 500, 675 );
												break;
										}
									}
									?>
									<?php if ( $overlay_style !== '' ) : ?>
										<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
									<?php endif; ?>
								</div>
								<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
									<div class="post-info">
										<h5 class="post-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h5>
										<div class="post-categories">
											<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
										</div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '5' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'portfolio-item grid-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>

							<a href="<?php the_permalink(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									the_post_thumbnail( 'insight-grid-masonry' );
								} else {
									Insight_Templates::image_placeholder( 600, 600 );
								}
								?>
							</a>
							<div class="post-thumbnail">
								<?php if ( $overlay_style !== '' ) : ?>
									<?php get_template_part( 'loop/portfolio/overlay', $overlay_style ); ?>
								<?php endif; ?>
							</div>
							<?php if ( in_array( $overlay_style, array( 'zoom' ), true ) ) : ?>
								<div class="post-info">
									<h5 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>
									<div class="post-categories">
										<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '', ', ', '' ); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '6' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'portfolio-item list-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<h5 class="post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h5>
						</div>
					<?php endwhile; ?>
				<?php } ?>
			<?php
			endif;
			wp_reset_postdata();
			wp_die();
		}

		public function post_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			$style = 1;
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}
			$count         = $_POST['count'];
			$insight_query = new WP_Query( $args );

			if ( $insight_query->have_posts() ) : ?>
				<?php if ( $style === '1' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'grid-item', 'post-item' );
						$format  = '';
						if ( get_post_format() !== false ) {
							$format = get_post_format();
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<?php get_template_part( 'loop/blog/format', $format ); ?>
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
				<?php } elseif ( $style === '2' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-day">
								<h4>
									<?php echo get_the_date( 'd' ); ?>
								</h4>
							</div>
							<div class="post-feature-overlay">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-feature"
									     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
									</div>
								<?php } ?>
								<div class="post-overlay">

								</div>
							</div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								<div class="post-excerpt">
									<?php Insight_Templates::excerpt( array(
										'limit' => 140,
										'type'  => 'character',
									) ); ?>
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
				<?php } elseif ( $style === '3' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item' );
						$format  = '';
						if ( get_post_format() !== false ) {
							$format = get_post_format();
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
							<div class="post-feature-overlay">
								<div class="post-overlay">

								</div>
							</div>
							<div class="post-day">
								<h4>
									<?php echo get_the_date( 'd' ); ?>
								</h4>
							</div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '4' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item swiper-slide' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="post-day">
								<h4>
									<?php echo get_the_date( 'd' ); ?>
								</h4>
							</div>
							<div class="post-feature-overlay">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="post-feature"
									     style="<?php echo esc_attr( 'background-image: url(' . get_the_post_thumbnail_url( null, 'full' ) . ')' ); ?>">
									</div>
								<?php } ?>
								<div class="post-overlay">

								</div>
							</div>
							<div class="post-info">
								<?php if ( has_category() ) : ?>
									<div class="post-categories"><?php the_category( ', ' ); ?></div>
								<?php endif; ?>
								<h5 class="post-title">
									<a href="<?php the_permalink(); ?>"
									   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
								</h5>
								<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								<div class="post-excerpt">
									<?php Insight_Templates::excerpt( array(
										'limit' => 140,
										'type'  => 'character',
									) ); ?>
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
				<?php } elseif ( $style === '5' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'post-item grid-item' );
						$format  = '';
						if ( get_post_format() !== false ) {
							$format = get_post_format();
						}
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<?php get_template_part( 'loop/blog-classic/format', $format ); ?>
							<?php if ( ! in_array( $format, array( 'quote' ) ) ) : ?>
								<div class="post-info">
									<?php if ( has_category() ) : ?>
										<div class="post-categories"><?php the_category( ', ' ); ?></div>
									<?php endif; ?>
									<h5 class="post-title">
										<a href="<?php the_permalink(); ?>"
										   title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h5>
									<div class="post-date"><?php echo get_the_date( 'F d, Y' ); ?></div>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				<?php } ?>
			<?php
			endif;
			wp_reset_postdata();
			wp_die();
		}

		public function product_infinite_load() {
			$args = array(
				'post_type'      => $_POST['post_type'],
				'posts_per_page' => $_POST['posts_per_page'],
				'orderby'        => $_POST['orderby'],
				'order'          => $_POST['order'],
				'paged'          => $_POST['paged'],
				'post_status'    => 'publish',
			);

			if ( ! empty( $_POST['taxonomies'] ) ) {
				$args = Insight_VC::get_tax_query_of_taxonomies( $args, $_POST['taxonomies'] );
			}

			$style = '1';
			if ( isset( $_POST['style'] ) ) {
				$style = $_POST['style'];
			}
			$overlay_style = 'faded';
			if ( isset( $_POST['overlay_style'] ) ) {
				$overlay_style = $_POST['overlay_style'];
			}
			$count         = $_POST['count'];
			$insight_query = new WP_Query( $args );

			if ( $insight_query->have_posts() ) : ?>
				<?php if ( $style === '1' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'product-item grid-item' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="product-thumbnail">
								<?php woocommerce_template_loop_product_link_open(); ?>
								<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
								<?php if ( $overlay_style !== '' ) : ?>
									<?php get_template_part( 'loop/product/overlay', $overlay_style ); ?>
								<?php endif; ?>
								<?php woocommerce_template_loop_product_link_close(); ?>
							</div>
							<div class="product-info">
								<?php
								woocommerce_template_loop_product_link_open();
								do_action( 'woocommerce_shop_loop_item_title' );
								woocommerce_template_loop_price();
								woocommerce_template_loop_product_link_close();
								?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } elseif ( $style === '2' ) { ?>
					<?php
					while ( $insight_query->have_posts() ) :
						$insight_query->the_post();
						$classes = array( 'product-item grid-item swiper-slide' );
						?>
						<div <?php post_class( implode( ' ', $classes ) ); ?>>
							<div class="product-thumbnail">
								<?php woocommerce_template_loop_product_link_open(); ?>
								<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
								<div class="product-overlay">
									<i class="fa fa-search"></i>
								</div>
								<?php woocommerce_template_loop_product_link_close(); ?>
							</div>
							<div class="product-info">
								<?php
								woocommerce_template_loop_product_link_open();
								do_action( 'woocommerce_shop_loop_item_title' );
								woocommerce_template_loop_price();
								woocommerce_template_loop_product_link_close();
								?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php } ?>
			<?php
			endif;
			wp_reset_postdata();
			wp_die();
		}

		public function add_attributes_to_body( $attrs ) {
			$site_width = Insight_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Insight::setting( 'site_width' );
			}
			$attrs['data-content-width'] = $site_width;

			return $attrs;
		}

		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @param array $classes Classes for the body element.
		 *
		 * @return array
		 */
		public function body_classes( $classes ) {
			if ( ! class_exists( 'InsightCore' ) ) {
				$classes[] = 'core-unactivated';
			}
			// Adds a class of group-blog to blogs with more than 1 published author.
			if ( is_multi_author() ) {
				$classes[] = 'group-blog';
			}

			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Adds a class for mobile device.
			if ( Insight::is_mobile() ) {
				$classes[] = 'mobile';
			}

			// Adds a class for tablet device.
			if ( Insight::is_tablet() ) {
				$classes[] = 'tablet';
			}

			// Adds a class for handheld device.
			if ( Insight::is_handheld() ) {
				$classes[] = 'handheld';

				$classes[] = 'mobile-menu';
			}

			// Adds a class for desktop device.
			if ( Insight::is_desktop() ) {
				$classes[] = 'desktop';

				$classes[] = 'desktop-menu';
			}

			$one_page_enable = Insight_Helper::get_post_meta( 'menu_one_page', '' );
			if ( $one_page_enable === '1' ) {
				$classes[] = 'one-page';
			}

			$mobile_menu_separate_toggle = Insight::setting( 'mobile_menu_separate_toggle' );
			if ( $mobile_menu_separate_toggle ) {
				$classes[] = 'mobile-menu-separate-toggle';
			}

			if ( is_singular( 'portfolio' ) ) {
				$style = Insight_Helper::get_post_meta( 'portfolio_layout_style', '' );
				if ( $style === '' ) {
					$style = Insight::setting( 'single_portfolio_style' );
				}
				$classes[] = "single-portfolio-style-$style";
			}

			$header_position = Insight_Helper::get_post_meta( 'header_position', '' );
			if ( $header_position !== '' ) {
				$classes[] = "page-header-$header_position";
			}

			$header_type = Insight::setting( 'header_type' );
			$classes[]   = 'header' . $header_type;

			$header_sticky_behaviour = Insight::setting( 'header_sticky_behaviour' );
			$classes[]               = "header-sticky-$header_sticky_behaviour";

			$site_layout = Insight_Helper::get_post_meta( 'site_layout', '' );
			if ( $site_layout === '' ) {
				$site_layout = Insight::setting( 'site_layout' );
			}
			$classes[] = $site_layout;

			if ( is_singular( 'post' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );

				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'post_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'post_page_sidebar_2' );
				}

				if ( $page_sidebar1 !== 'none' || $page_sidebar2 !== 'none' ) {
					$classes [] = 'page-has-sidebar';
				} else {
					$classes [] = 'page-has-no-sidebar';
				}

				if ( $page_sidebar1 !== 'none' && $page_sidebar2 !== 'none' ) {
					$classes [] = 'page-has-both-sidebar';
				}
			}

			return $classes;
		}
	}

	new Insight_Actions_Filters();
}
