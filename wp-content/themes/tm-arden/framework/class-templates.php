<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 */
class Insight_Templates {

	public static function slider( $position ) {
		$slider = Insight_Helper::get_post_meta( 'revolution_slider' );
		if ( function_exists( 'rev_slider_shortcode' ) && Insight_Helper::get_post_meta( 'header_position' ) === $position && $slider !== '' ) {
			?>
			<div id="page-slider" class="page-slider">
				<?php putRevSlider( $slider ); ?>
			</div>
			<?php
		}

		if ( $position === 'above' ) {
			$slider = '';
			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$slider = Insight::setting( 'search_page_rev_slider' );
			} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				$slider = Insight::setting( 'product_archive_page_rev_slider' );
			} elseif ( is_post_type_archive( 'portfolio' ) || Insight_Portfolio::is_taxonomy() ) {
				$slider = Insight::setting( 'portfolio_archive_page_rev_slider' );
			} elseif ( is_archive() ) {
				$slider = Insight::setting( 'blog_archive_page_rev_slider' );
			} elseif ( is_home() ) {
				$slider = Insight::setting( 'home_page_rev_slider' );
			}

			if ( $slider !== '' && function_exists( 'rev_slider_shortcode' ) ) {
				?>
				<div id="page-slider" class="page-slider">
					<?php putRevSlider( $slider ); ?>
				</div>
				<?php
			}
		}
	}

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	public static function entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'tm-arden' ) );
			if ( $categories_list && self::categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'tm-arden' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'tm-arden' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'tm-arden' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'tm-arden' ), esc_html__( '1 Comment', 'tm-arden' ), esc_html__( '% Comments', 'tm-arden' ) );
			echo '</span>';
		}

		edit_post_link( sprintf( /* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'tm-arden' ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ), '<span class="edit-link">', '</span>' );
	}

	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	public static function categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'insight_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$args              = array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			);
			$all_the_cool_cats = get_categories( $args );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'insight_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so categorized_blog should return false.
			return false;
		}
	}

	public static function paging_nav( $query = false ) {
		global $wp_query, $wp_rewrite;
		if ( $query === false ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if ( $query->max_num_pages < 2 ) {
			return;
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = esc_url( remove_query_arg( array_keys( $query_args ), $page_num_link ) );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format = '';
		if ( $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ) {
			$format = 'index.php/';
		}
		if ( $wp_rewrite->using_permalinks() ) {
			$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
		} else {
			$format .= '?paged=%#%';
		}

		// Set up paginated links.

		$args  = array(
			'base'      => $page_num_link,
			'format'    => $format,
			'total'     => $query->max_num_pages,
			'current'   => max( 1, $paged ),
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'type'      => 'array',
		);
		$pages = paginate_links( $args );

		if ( is_array( $pages ) ) {
			echo '<ul class="page-pagination">';
			foreach ( $pages as $page ) {
				printf( '<li>%s</li>', $page );
			}
			echo '</ul>';
		}
	}

	public static function page_links() {
		wp_link_pages( array(
			'before'           => '<div class="page-links">',
			'after'            => '</div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'nextpagelink'     => '<i class="fa fa-angle-left"></i>',
			'previouspagelink' => '<i class="fa fa-angle-right"></i>',
		) );
	}

	public static function comment_navigation( $args = array() ) {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			$defaults = array(
				'container_id'    => '',
				'container_class' => 'navigation comment-navigation',
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<nav id="<?php echo esc_attr( $args['container_id'] ); ?>"
			     class="<?php echo esc_attr( $args['container_class'] ); ?>">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'tm-arden' ); ?></h2>

				<div class="comment-nav-links">
					<?php paginate_comments_links( array(
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>',
						'type'      => 'list',
					) ); ?>
				</div>
			</nav>
			<?php
		}
		?>
		<?php
	}

	public static function comment_template( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<div class="comment-content">
				<?php
				printf( '<cite class="fn">%s</cite>', get_comment_author_link() );
				?>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-messages"><?php esc_html_e( 'Your comment is awaiting moderation.', 'tm-arden' ) ?></em>
					<br/>
				<?php endif; ?>
				<div class="comment-text"><?php comment_text(); ?></div>
				<div class="comment-meta">
					<span
						class="comment-datetime"><?php echo get_comment_date() . ' ' . esc_html__( 'at', 'tm-arden' ) . ' ' . get_comment_time(); ?>
					</span>
					<?php edit_comment_link( esc_html__( 'Edit', 'tm-arden' ), '| ', '' ) ?>
					<?php comment_reply_link( array_merge( $args, array(
						'before'    => '| ',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
					) ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	public static function comment_form() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = '';
		if ( $req ) {
			$aria_req = " aria-required='true'";
		}

		$fields        = array(
			'author' => '<div class="row"><div class="col-md-6"><p class="comment-form-author"><input id="author" placeholder="' . esc_html__( 'Your Name *', 'tm-arden' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . '/></p></div>',
			'email'  => '<div class="col-md-6"><p class="comment-form-email"><input id="email" placeholder="' . esc_html__( 'Your Email *', 'tm-arden' ) . '" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . '/></p></div></div>',
		);
		$comments_args = array(
			// Change the title of send button.
			'label_submit'         => esc_html__( 'Submit', 'tm-arden' ),
			// Change the title of the reply section.
			'title_reply'          => esc_html__( 'Write a comment', 'tm-arden' ),
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after'  => '',
			'comment_notes_before' => '',
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" placeholder="' . esc_html__( 'Your Comment', 'tm-arden' ) . '" name="comment" aria-required="true"></textarea></p>',
		);
		comment_form( $comments_args );
	}

	public static function post_author() {
		?>
		<div class="entry-author tm-box-content">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'email' ), '130' ); ?>
			</div>
			<div class="author-description">
				<h5 class="author-name"><?php the_author(); ?></h5>
				<div class="author-biographical-info">
					<?php the_author_meta( 'description' ); ?>
				</div>
				<?php
				$email_address = get_the_author_meta( 'email_address' );
				$facebook      = get_the_author_meta( 'facebook' );
				$twitter       = get_the_author_meta( 'twitter' );
				$google_plus   = get_the_author_meta( 'google_plus' );
				$instagram     = get_the_author_meta( 'instagram' );
				$linkedin      = get_the_author_meta( 'linkedin' );
				$pinterest     = get_the_author_meta( 'pinterest' );
				?>
				<?php if ( $facebook || $twitter || $google_plus || $instagram || $linkedin || $email_address ) : ?>
					<div class="author-social-networks">
						<?php if ( $email_address ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Email', 'tm-arden' ) ?>"
							   href="mailto:<?php echo esc_url( $email_address ); ?>" target="_blank">
								<i class="fa fa-envelope"></i>
							</a>
						<?php endif; ?>

						<?php if ( $facebook ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Facebook', 'tm-arden' ) ?>"
							   href="<?php echo esc_url( $facebook ); ?>" target="_blank">
								<i class="fa fa-facebook-square"></i>
							</a>
						<?php endif; ?>

						<?php if ( $twitter ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Twitter', 'tm-arden' ) ?>"
							   href="<?php echo esc_url( $twitter ); ?>" target="_blank">
								<i class="fa fa-twitter"></i>
							</a>
						<?php endif; ?>

						<?php if ( $google_plus ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Google +', 'tm-arden' ) ?>"
							   href="<?php echo esc_url( $google_plus ); ?>" target="_blank">
								<i class="fa fa-google-plus"></i>
							</a>
						<?php endif; ?>

						<?php if ( $instagram ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Instagram', 'tm-arden' ) ?>"
							   href="<?php echo esc_url( $google_plus ); ?>" target="_blank">
								<i class="fa fa-instagram"></i>
							</a>
						<?php endif; ?>

						<?php if ( $linkedin ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Linkedin', 'tm-arden' ) ?>"
							   href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
								<i class="fa fa-linkedin"></i>
							</a>
						<?php endif; ?>

						<?php if ( $pinterest ) : ?>
							<a class="hint--bounce hint--top"
							   aria-label="<?php echo esc_attr__( 'Pinterest', 'tm-arden' ) ?>"
							   href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
								<i class="fa fa-pinterest"></i>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	public static function post_sharing( $args = array() ) {
		$social_sharing = Insight::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="post-share">
				<?php self::get_sharing_list( $args ); ?>
			</div>
			<?php
		}
	}

	public static function portfolio_like() {
		if ( Insight::setting( 'single_portfolio_meta_like_enable' ) === '1' ) :
			?>
			<span class="post-likes">
				<?php
				$insight_post_like = new Insight_Post_Like();
				$insight_post_like->get_simple_likes_button( get_the_ID() );
				?>
			</span>
		<?php
		endif;
	}

	public static function portfolio_view() {
		if ( Insight::setting( 'single_portfolio_meta_view_enable' ) === '1' && function_exists( 'the_views' ) ) : ?>
			<div class="post-view">
				<i class="fa fa-eye"></i>
				<?php the_views(); ?>
			</div>
		<?php
		endif;
	}

	public static function portfolio_sharing( $args = array() ) {
		$social_sharing = Insight::setting( 'single_portfolio_share_enable' );
		if ( ! empty( $social_sharing ) && Insight::setting( 'single_portfolio_share_enable' ) === '1' ) {
			?>
			<div class="post-share">
				<?php self::get_sharing_list( $args ); ?>
			</div>
			<?php
		}
	}

	public static function portfolio_details() {
		$portfolio_client = Insight_Helper::get_post_meta( 'portfolio_client', '' );
		$portfolio_date   = Insight_Helper::get_post_meta( 'portfolio_date', '' );
		$portfolio_awards = Insight_Helper::get_post_meta( 'portfolio_awards', '' );
		$portfolio_tags   = Insight::setting( 'single_portfolio_tags_enable' );
		?>
		<ul class="portfolio-details-list">
			<?php if ( $portfolio_date !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'Date: ', 'tm-arden' ); ?></label>
					<span><?php echo esc_html( $portfolio_date ); ?></span>
				</li>
			<?php endif; ?>
			<?php if ( $portfolio_client !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'Client: ', 'tm-arden' ); ?></label>
					<span><?php echo esc_html( $portfolio_client ); ?></span>
				</li>
			<?php endif; ?>
			<li>
				<label><?php esc_html_e( 'Categories:', 'tm-arden' ); ?></label>
				<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '<ul class="portfolio-categories"><li>', '</li><li>', '</li></ul>' ); ?>
			</li>
			<?php if ( $portfolio_awards !== '' ) : ?>
				<li>
					<label><?php esc_html_e( 'Awards: ', 'tm-arden' ); ?></label>
					<span><?php echo esc_html( $portfolio_awards ); ?></span>
				</li>
			<?php endif; ?>

			<?php if ( $portfolio_tags === '1' ): ?>
				<li>
					<?php
					$portfolio_tags_label = Insight::setting( 'single_portfolio_tags_label' );

					if ( $portfolio_tags_label === '' ) {
						$portfolio_tags_label = esc_html__( 'Tags: ', 'tm-arden' );
					}
					?>

					<label><?php echo $portfolio_tags_label; ?></label>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_tags', '<ul class="portfolio-tags"><li>', '</li><li>', '</li></ul>' ); ?>
				</li>
			<?php endif; ?>
		</ul>
		<?php
	}

	public static function portfolio_link_pages() {
		$args = array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tm-arden' ),
			'after'  => '</div>',
		);
		wp_link_pages( $args );
	}

	public static function product_sharing( $args = array() ) {
		$social_sharing = Insight::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="post-share">
				<h6><?php esc_html_e( 'Share', 'tm-arden' ); ?></h6>
				<div class="product-sharing-list"><?php self::get_sharing_list( $args ); ?></div>
			</div>
			<?php
		}
	}

	public static function get_sharing_list( $args = array() ) {
		$defaults       = array(
			'target' => '_blank',
		);
		$args           = wp_parse_args( $args, $defaults );
		$social_sharing = Insight::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			$social_sharing_order = Insight::setting( 'social_sharing_order' );
			foreach ( $social_sharing_order as $social ) {
				if ( in_array( $social, $social_sharing, true ) ) {
					if ( $social === 'facebook' ) {
						if ( ! wp_is_mobile() ) {
							$facebook_url = 'http://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . rawurlencode( get_permalink() ) . '&p&#91;images&#93;&#91;0&#93;=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '&p&#91;title&#93;=' . rawurlencode( get_the_title() );
						} else {
							$facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
						}
						?>
						<a class="hint--bounce hint--top facebook" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Facebook', 'tm-arden' ) ?>"
						   href="<?php echo esc_url( $facebook_url ); ?>">
							<i class="fa fa-facebook-square"></i>
						</a>
						<?php
					} elseif ( $social === 'twitter' ) {
						?>
						<a class="hint--bounce hint--top twitter" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Twitter', 'tm-arden' ) ?>"
						   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fa fa-twitter"></i>
						</a>
						<?php
					} elseif ( $social === 'google_plus' ) {
						?>
						<a class="hint--bounce hint--top google-plus"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Google+', 'tm-arden' ) ?>"
						   href="https://plus.google.com/share?url=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fa fa-google-plus"></i>
						</a>
						<?php
					} elseif ( $social === 'tumblr' ) {
						?>
						<a class="hint--bounce hint--top tumblr" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Tumblr', 'tm-arden' ) ?>"
						   href="http://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="fa fa-tumblr"></i>
						</a>
						<?php

					} elseif ( $social === 'linkedin' ) {
						?>
						<a class="hint--bounce hint--top linkedin" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Linkedin', 'tm-arden' ) ?>"
						   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="fa fa-linkedin"></i>
						</a>
						<?php
					} elseif ( $social === 'email' ) {
						?>
						<a class="hint--bounce hint--top email" target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php echo esc_attr__( 'Email', 'tm-arden' ) ?>"
						   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fa fa-envelope"></i>
						</a>
						<?php
					}
				}
			}
		}
	}

	public static function social_icons( $args = array() ) {
		$defaults    = array(
			'display'          => 'icon',
			'tooltip_enable'   => true,
			'tooltip_position' => 'top',
		);
		$args        = wp_parse_args( $args, $defaults );
		$social_link = Insight::setting( 'social_link' );

		if ( ! empty( $social_link ) ) {
			$social_link_target = Insight::setting( 'social_link_target' );

			$link_classes = '';
			if ( $args['tooltip_enable'] ) {
				$link_classes .= ' hint--bounce';
				$link_classes .= " hint--{$args['tooltip_position']}";
			}
			foreach ( $social_link as $key => $row_values ) {
				?>
				<a class="<?php echo esc_attr( $link_classes ); ?>"
					<?php if ( $args['tooltip_enable'] ) : ?>
						aria-label="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php endif; ?>
                   href="<?php echo esc_url( $row_values['link_url'] ); ?>"
					<?php if ( $social_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php if ( in_array( $args['display'], array( 'icon', 'icon_text' ), true ) ) : ?>
						<i class="fa <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					<?php endif; ?>
					<?php if ( in_array( $args['display'], array( 'text', 'icon_text' ), true ) ) : ?>
						<span><?php echo esc_html( $row_values['tooltip'] ); ?></span>
					<?php endif; ?>
				</a>
				<?php
			}
		}
	}

	public static function string_limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string, $word_limit + 1 );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
		}

		return implode( ' ', $words );
	}

	public static function string_limit_characters( $string, $limit ) {
		$string = substr( $string, 0, $limit );
		$string = substr( $string, 0, strripos( $string, " " ) );

		return $string;
	}

	public static function excerpt( $args ) {
		$defaults = array(
			'limit' => 55,
			'after' => '&hellip;',
			'type'  => 'word',
		);
		$excerpt  = '';
		$args     = wp_parse_args( $args, $defaults );
		if ( $args['type'] === 'word' ) {
			$excerpt = self::string_limit_words( get_the_excerpt(), $args['limit'] );
		} elseif ( $args['type'] === 'character' ) {
			$excerpt = self::string_limit_characters( get_the_excerpt(), $args['limit'] );
		}
		if ( $excerpt !== '' && $excerpt !== '&nbsp;' ) {
			printf( '<p>%s %s</p>', $excerpt, $args['after'] );
		}
	}

	public static function render_sidebar( $sidebar_position, $sidebar1, $sidebar2, $template_position = 'left' ) {
		if ( $sidebar1 !== 'none' ) {
			$classes = 'page-sidebar col-md-4';
			$classes .= ' page-sidebar-' . $template_position;
			if ( $template_position === 'left' ) {
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1 );
				}
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			} elseif ( $template_position === 'right' ) {
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1 );
				}
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			}
		}
	}

	public static function get_sidebar( $classes, $name ) {
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<div class="page-sidebar-inner" itemscope="itemscope">
				<div class="page-sidebar-content">
					<?php self::generated_sidebar( $name ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * @param $name
	 * Name of dynamic sidebar
	 * Check sidebar is active then dynamic it.
	 */
	public static function generated_sidebar( $name ) {
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
	}

	public static function image_placeholder( $width, $height ) {
		echo '<img src="http://placehold.it/' . $width . 'x' . $height . '?text=' . esc_html__( 'No+Image', 'tm-arden' ) . '" alt="thumbnail"/>';
	}

	public static function grid_portfolio_filters( $filter_enable, $filter_align, $filter_counter, $filter_wrap = '0', $list ) {
		if ( $filter_enable == 1 ) :

			$filter_classes = array( 'tm-filter-button-group', $filter_align );
			if ( $filter_counter == 1 ) {
				$filter_classes[] = 'show-filter-counter';
			}
			?>

			<div class="<?php echo implode( ' ', $filter_classes ); ?>"
				<?php
				if ( $filter_counter == 1 ) {
					echo 'data-filter-counter="true"';
				}
				?>
			>
				<?php if ( $filter_wrap == '1' ) { ?>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php } ?>
							<a href="javascript:void(0);" class="btn-filter current"
							   data-filter="*">
								<span class="filter-text"><?php esc_html_e( 'All', 'tm-arden' ); ?></span>
							</a>
							<?php
							if ( $list === '' ) {
								$_categories = get_terms( array(
									'taxonomy'   => 'portfolio_category',
									'hide_empty' => true,
								) );

								foreach ( $_categories as $term ) {
									printf( '<a href="javascript:void(0);" class="btn-filter" data-filter=".portfolio_category-%s"><span class="filter-text">%s</span></a>', esc_attr( $term->slug ), $term->name );
								}
							} else {
								$list = explode( ', ', $list );
								foreach ( $list as $item ) {
									$value = explode( ':', $item );

									$term = get_term_by( 'slug', $value[1], $value[0] );

									if ( $term === false ) {
										continue;
									}

									printf( '<a href="javascript:void(0);" class="btn-filter" data-filter=".%s-%s"><span class="filter-text">%s</span></a>', $value[0], $value[1], $value[1] );
								}
							}
							?>
							<?php if ( $filter_wrap == '1' ) { ?>
						</div>
					</div>
				</div>
			<?php } ?>
			</div>

		<?php
		endif;
	}
}
