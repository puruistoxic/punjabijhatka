<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Custom functions, filters, actions for visual composer page builder.
 */
if ( ! class_exists( 'Insight_VC' ) ) {
	class Insight_VC {

		protected static $instance = null;

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function init() {
			if ( ! class_exists( 'Vc_Manager' ) ) {
				return;
			}
			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( get_template_directory() . '/vc-extend/vc-templates' );
			}

			add_action( 'vc_before_init', array( $this, 'vc_set_as_theme' ) );
			add_action( 'vc_after_init', array( $this, 'load_vc_maps' ), 9999 );
			add_action( 'vc_after_init', array( $this, 'load_vc_params' ) );

			/*
			 * Add styles & script file only on add new or edit post type.
			 */
			add_action( 'load-post.php', array( $this, 'enqueue_scripts' ) );
			add_action( 'load-post-new.php', array( $this, 'enqueue_scripts' ) );

			add_filter( 'vc_iconpicker-type-pe7stroke', array( $this, 'add_font_pe7stroke' ) );
			add_filter( 'vc_iconpicker-type-linea', array( $this, 'add_font_linea' ) );
			add_filter( 'vc_google_fonts_get_fonts_filter', array( $this, 'update_google_fonts' ) );

			// Narrow data taxonomies.
			add_filter( 'vc_autocomplete_tm_blog_taxonomies_callback', array(
				$this,
				'autocomplete_blog_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_blog_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_callback', array(
				$this,
				'autocomplete_portfolio_taxonomies_field_search',
			), 10, 1 );
			add_filter( 'vc_autocomplete_tm_portfolio_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_callback', array(
				$this,
				'autocomplete_testimonial_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_testimonial_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_taxonomies_callback', array(
				$this,
				'autocomplete_product_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_category_taxonomies_callback', array(
				$this,
				'autocomplete_product_taxonomies_field_search',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_product_category_taxonomies_render', array(
				$this,
				'autocomplete_taxonomies_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_items_pages_callback', array(
				$this,
				'autocomplete_pages_field_callback',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_items_pages_render', array(
				$this,
				'autocomplete_pages_field_render',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_icon_items_pages_callback', array(
				$this,
				'autocomplete_pages_field_callback',
			), 10, 1 );

			add_filter( 'vc_autocomplete_tm_view_demo_icon_items_pages_render', array(
				$this,
				'autocomplete_pages_field_render',
			), 10, 1 );
		}

		function vc_set_as_theme() {
			vc_set_as_theme();
		}

		function autocomplete_pages_field_render( $term ) {
			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'name'        => $term['value'],
			);

			$query = new WP_Query( $args );
			$data  = false;
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		function autocomplete_pages_field_callback( $search_string ) {
			$data = array();
			$args = array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				's'           => $search_string,
			);

			$query = new WP_Query( $args );

			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) :
					$query->the_post();
					global $post;

					$data[] = array(
						'label' => get_the_title(),
						'value' => $post->post_name,
					);
				endwhile;
			}

			return $data;
		}

		public function load_vc_maps() {
			require_once INSIGHT_VC_MAPS_DIR . '/tm_accordion.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_blog.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_box_icon.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_rotate_box.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_button_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_button.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_content_band.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_content_band_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_countdown.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_counter.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_contact_form_7.php';

			if ( function_exists( 'mc4wp_show_form' ) ) {
				require_once INSIGHT_VC_MAPS_DIR . '/tm_mailchimp_form.php';
			}

			require_once INSIGHT_VC_MAPS_DIR . '/tm_gmaps.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_gallery.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_heading.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_drop_cap.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_blockquote.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_list.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_menu.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_instagram.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_twitter.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_pie_chart.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_portfolio.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_info_boxes.php';

			if ( class_exists( 'WooCommerce' ) ) {
				require_once INSIGHT_VC_MAPS_DIR . '/tm_product.php';
				require_once INSIGHT_VC_MAPS_DIR . '/tm_product_categories.php';
			}

			require_once INSIGHT_VC_MAPS_DIR . '/tm_pricing.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_pricing_group.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_popup_video.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_slider.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_team_member.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_testimonial.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_timeline.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_social_networks.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_view_demo.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_view_demo_icon.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_w_better_custom_menu.php';
			require_once INSIGHT_VC_MAPS_DIR . '/tm_button_separator.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_column.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_column_inner.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_progress_bar.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_row.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_row_inner.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_single_image.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_separator.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_text_separator.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_icon.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_tta_tabs.php';
			require_once INSIGHT_VC_MAPS_DIR . '/vc_widget_sidebar.php';
		}

		public function load_vc_params() {
			require_once INSIGHT_VC_PARAMS_DIR . '/number/number.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/number_responsive/number_responsive.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/spacing/spacing.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/datetime_picker/datetime_picker.php';
			require_once INSIGHT_VC_PARAMS_DIR . '/gradient/gradient.php';
		}

		public static function extra_class_field() {
			return array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Extra class name', 'tm-arden' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'tm-arden' ),
				'std'         => '',
			);
		}

		public static function css_editor_field() {
			return array(
				'group'      => esc_html__( 'Design Options', 'tm-arden' ),
				'type'       => 'css_editor',
				'heading'    => esc_html__( 'CSS box', 'tm-arden' ),
				'param_name' => 'css',
			);
		}

		public static function get_animation_field( $args = array() ) {
			$defaults = array(
				'std'        => 'scale-up',
				'heading'    => esc_html__( 'CSS Animation', 'tm-arden' ),
				'param_name' => 'animation',
			);
			$args     = wp_parse_args( $args, $defaults );

			return array(
				'type'       => 'dropdown',
				'heading'    => $args['heading'],
				'desc'       => esc_html__( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'tm-arden' ),
				'param_name' => $args['param_name'],
				'value'      => array(
					esc_html__( 'None', 'tm-arden' )             => '',
					esc_html__( 'Fade In', 'tm-arden' )          => 'fade-in',
					esc_html__( 'Move Up', 'tm-arden' )          => 'move-up',
					esc_html__( 'Move Down', 'tm-arden' )        => 'move-down',
					esc_html__( 'Move Left', 'tm-arden' )        => 'move-left',
					esc_html__( 'Move Right', 'tm-arden' )       => 'move-right',
					esc_html__( 'Scale Up', 'tm-arden' )         => 'scale-up',
					esc_html__( 'Fall Perspective', 'tm-arden' ) => 'fall-perspective',
					esc_html__( 'Fly', 'tm-arden' )              => 'fly',
					esc_html__( 'Flip', 'tm-arden' )             => 'flip',
					esc_html__( 'Helix', 'tm-arden' )            => 'helix',
					esc_html__( 'Pop Up', 'tm-arden' )           => 'pop-up',
				),
				'std'        => $args['std'],
			);
		}

		public static function get_vc_spacing_tab() {
			$spacing_tab = esc_html__( 'Design Options', 'tm-arden' );

			return array(
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Border Color', 'tm-arden' ),
					'type'             => 'dropdown',
					'param_name'       => 'border_color',
					'value'            => array(
						esc_html__( 'Primary Color', 'tm-arden' ) => 'primary',
						esc_html__( 'Custom Color', 'tm-arden' )  => 'custom_color',
					),
					'std'              => 'custom_color',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Custom Border Color', 'tm-arden' ),
					'type'             => 'colorpicker',
					'param_name'       => 'custom_border_color',
					'dependency'       => array(
						'element' => 'border_color',
						'value'   => array( 'custom_color' ),
					),
					'std'              => '#eeeeee',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'            => $spacing_tab,
					'heading'          => esc_html__( 'Border Style', 'tm-arden' ),
					'type'             => 'dropdown',
					'param_name'       => 'border_style',
					'value'            => array(
						esc_html__( 'Solid', 'tm-arden' )  => 'solid',
						esc_html__( 'Dashed', 'tm-arden' ) => 'dashed',
						esc_html__( 'Dotted', 'tm-arden' ) => 'dotted',
						esc_html__( 'Double', 'tm-arden' ) => 'double',
						esc_html__( 'Groove', 'tm-arden' ) => 'groove',
						esc_html__( 'Ridge', 'tm-arden' )  => 'ridge',
						esc_html__( 'Inset', 'tm-arden' )  => 'inset',
						esc_html__( 'Outset', 'tm-arden' ) => 'outset',
					),
					'std'              => 'solid',
					'edit_field_class' => 'vc_col-sm-4 vc_column-no-padding',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Large Device Spacing', 'tm-arden' ),
					'type'         => 'spacing',
					'param_name'   => 'lg_spacing',
					'spacing_icon' => 'fa-desktop',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Medium Device Spacing', 'tm-arden' ),
					'type'         => 'spacing',
					'param_name'   => 'md_spacing',
					'spacing_icon' => 'fa-tablet fa-rotate-270',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Small Device Spacing', 'tm-arden' ),
					'type'         => 'spacing',
					'param_name'   => 'sm_spacing',
					'spacing_icon' => 'fa-tablet',
				),
				array(
					'group'        => $spacing_tab,
					'heading'      => esc_html__( 'Extra Small Spacing', 'tm-arden' ),
					'type'         => 'spacing',
					'param_name'   => 'xs_spacing',
					'spacing_icon' => 'fa-mobile',
				),
			);
		}

		/**
		 * @param $term
		 *
		 * @return array|bool
		 */
		function autocomplete_taxonomies_field_render( $term ) {
			$t    = explode( ':', $term['value'] );
			$term = get_term_by( 'slug', $t[1], $t[0] );

			$data = false;
			if ( $term !== false ) {
				$data = $this->vc_get_term_object( $term );
			}

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_blog_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'post' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_portfolio_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'portfolio' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_product_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'product' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_testimonial_taxonomies_field_search( $search_string ) {
			$data = $this->autocomplete_get_data_from_post_type( $search_string, 'testimonial' );

			return $data;
		}

		/**
		 * @param $search_string
		 *
		 * @return array|bool
		 */
		function autocomplete_get_data_from_post_type( $search_string, $post_type ) {
			$data             = array();
			$taxonomies_types = get_object_taxonomies( $post_type );
			$taxonomies       = get_terms( $taxonomies_types, array(
				'hide_empty' => false,
				'search'     => $search_string,
			) );
			if ( is_array( $taxonomies ) && ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = $this->vc_get_term_object( $t );
					}
				}
			}

			return $data;
		}

		function vc_get_term_object( $term ) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label'    => $term->name,
				'value'    => $term->taxonomy . ':' . $term->slug,
				'group_id' => $term->taxonomy,
				'group'    => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'tm-arden' ),
			);
		}

		public static function get_tax_query_of_taxonomies( $insight_post_args, $taxonomies ) {
			if ( ! empty( $taxonomies ) ) {
				$terms = explode( ', ', $taxonomies );

				$insight_post_args['tax_query'] = array();
				$tax_queries                    = array(); // List of taxonomies.
				foreach ( $terms as $t ) {
					$tmp       = explode( ':', $t );
					$taxonomy  = $tmp[0];
					$term_slug = $tmp[1];
					if ( ! isset( $tax_queries[ $taxonomy ] ) ) {
						$tax_queries[ $taxonomy ] = array(
							'taxonomy' => $taxonomy,
							'field'    => 'slug',
							'terms'    => array( $term_slug ),
						);
					} else {
						$tax_queries[ $taxonomy ]['terms'][] = $term_slug;
					}
				}
				$insight_post_args['tax_query']             = array_values( $tax_queries );
				$insight_post_args['tax_query']['relation'] = 'OR';
			}

			return $insight_post_args;
		}

		public function enqueue_scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		}

		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'datetime-picker', INSIGHT_THEME_URI . '/assets/custom_libs/datetimepicker/jquery.datetimepicker.css' );
			wp_enqueue_script( 'datetime-picker', INSIGHT_THEME_URI . '/assets/custom_libs/datetimepicker/jquery.datetimepicker.full.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );

			// Enqueue CSS.
			wp_enqueue_style( 'is-colorpicker', INSIGHT_THEME_URI . '/assets/custom_libs/colorpicker/css/jquery-colorpicker.css' );
			wp_enqueue_style( 'is-classygradient', INSIGHT_THEME_URI . '/assets/custom_libs/classygradient/css/jquery-classygradient-min.css' );

			wp_enqueue_script( 'is-colorpicker', INSIGHT_THEME_URI . '/assets/custom_libs/colorpicker/js/jquery-colorpicker.js', array( 'jquery' ), INSIGHT_THEME_VERSION, false );
			wp_enqueue_script( 'is-classygradient', INSIGHT_THEME_URI . '/assets/custom_libs/classygradient/js/jquery-classygradient-min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, false );
			// Enqueue CSS for Linea font.
			wp_enqueue_style( 'linea-basic', INSIGHT_THEME_URI . '/assets/custom_libs/linea/basic/styles.css', null, null );
			wp_enqueue_style( 'linea-basic-elaboration', INSIGHT_THEME_URI . '/assets/custom_libs/linea/basic_elaboration/styles.css', null, null );
			wp_enqueue_style( 'linea-arrows', INSIGHT_THEME_URI . '/assets/custom_libs/linea/arrows/styles.css', null, null );
			wp_enqueue_style( 'linea-ecommerce', INSIGHT_THEME_URI . '/assets/custom_libs/linea/ecommerce/styles.css', null, null );
			wp_enqueue_style( 'linea-music', INSIGHT_THEME_URI . '/assets/custom_libs/linea/music/styles.css', null, null );
		}

		public static function get_progress_bar_inline_css( $selector = '', $atts ) {
			global $insight_shortcode_css;
			extract( $atts );

			if ( $atts['bar_height'] !== '' ) {
				$insight_shortcode_css .= "$selector.vc_progress_bar .vc_general.vc_single_bar { height: {$atts['bar_height']}px; }";
			}

			if ( $atts['track_color'] === 'custom_color' ) {
				$insight_shortcode_css .= "$selector .vc_single_bar { background-color: {$atts['custom_track_color']}; }";
			}

			if ( $atts['background_color'] === 'custom_color' ) {
				$insight_shortcode_css .= "$selector .vc_single_bar .vc_bar { background-color: {$atts['custom_background_color']}; }";
			}

			if ( $atts['text_color'] === 'custom_color' ) {
				$insight_shortcode_css .= "$selector .vc_single_bar_title { color: {$atts['custom_text_color']}; }";
			}

			$insight_shortcode_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_column_css( $selector = '', $atts ) {
			global $insight_shortcode_css;
			$tmp = $inner_tmp = '';
			$css = '';

			if ( $atts['background_color'] === 'custom_color' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						$tmp .= "background-size: {$atts['background_size']};";
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $tmp !== '' ) {
				$insight_shortcode_css .= "$selector { $tmp }";
			}

			if ( $atts['border_radius'] !== '' ) {
				$inner_tmp .= "-moz-border-radius: {$atts['border_radius']};-webkit-border-radius: {$atts['border_radius']};border-radius: {$atts['border_radius']};";
			}

			if ( $atts['box_shadow'] !== '' ) {
				$inner_tmp .= "-moz-box-shadow: {$atts['box_shadow']};-webkit-box-shadow: {$atts['box_shadow']};box-shadow: {$atts['box_shadow']};";
			}

			if ( $inner_tmp !== '' ) {
				$insight_shortcode_css .= "$selector > .vc_column-inner { $inner_tmp }";
			}

			if ( $atts['max_width'] !== '' ) {
				$insight_shortcode_css .= self::get_media_query_css( $selector, 'max-width', $atts['max_width'], 'min-width: 1200px' );
			}

			$spacing_selector = $selector . ' > .vc_column-inner';

			$insight_shortcode_css .= self::get_vc_spacing_css( $spacing_selector, $atts );
		}

		public static function get_vc_row_css( $selector = '', $atts ) {
			global $insight_shortcode_css;
			$gutter = '';
			extract( $atts );
			$tmp           = '';
			$primary_color = Insight::setting( 'primary_color' );
			$_color        = '#000';
			if ( $atts['separator_type'] === 'big_triangle' ) {

				if ( $atts['separator_color_1'] === 'primary_color' ) {
					$insight_shortcode_css .= "$selector .vc_row-separator:before{ border-right-color: $primary_color; }";
					$insight_shortcode_css .= "$selector .vc_row-separator:after{ border-left-color: $primary_color; }";
				} elseif ( $atts['separator_color_1'] === 'custom_color' ) {
					$_color                = $atts['custom_separator_color_1'];
					$insight_shortcode_css .= "$selector .vc_row-separator:before{ border-right-color: $_color; }";
					$insight_shortcode_css .= "$selector .vc_row-separator:after{ border-left-color: $_color; }";
				}

				if ( $atts['separator_color_2'] === 'primary_color' ) {
					$insight_shortcode_css .= "$selector .vc_row-separator:before{ border-bottom-color: $primary_color; }";
					$insight_shortcode_css .= "$selector .vc_row-separator:after{ border-bottom-color: $primary_color; }";
				} elseif ( $atts['separator_color_2'] === 'custom_color' ) {
					$_color                = $atts['custom_separator_color_2'];
					$insight_shortcode_css .= "$selector .vc_row-separator:before, $selector .vc_row-separator:after{ border-bottom-color: $_color; }";
				}

			} elseif ( $atts['separator_type'] === 'triangle' ) {
				if ( $atts['separator_color_1'] === 'primary_color' ) {
					$_color = $primary_color;
				} elseif ( $atts['separator_color_1'] === 'custom_color' ) {
					$_color = $atts['custom_separator_color_1'];
				}
				$insight_shortcode_css .= "$selector .vc_row-separator:before, $selector .vc_row-separator:after{ background: $_color; }";
			} elseif ( $atts['separator_type'] === 'half_circle' ) {
				if ( $atts['separator_color_1'] === 'primary_color' ) {
					$_color = $primary_color;
				} elseif ( $atts['separator_color_1'] === 'custom_color' ) {
					$_color = $atts['custom_separator_color_1'];
				}
				$insight_shortcode_css .= "$selector .vc_row-separator:before, $selector .vc_row-separator:after{ background: $_color; }";
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= "-moz-border-radius: {$atts['border_radius']};-webkit-border-radius: {$atts['border_radius']};border-radius: {$atts['border_radius']};";
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= "-moz-box-shadow: {$atts['box_shadow']};-webkit-box-shadow: {$atts['box_shadow']};box-shadow: {$atts['box_shadow']};";
			}

			if ( $atts['background_color'] === 'custom_color' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						if ( $atts['background_size'] === 'manual' ) {
							if ( $atts['background_size_manual'] !== '' ) {
								$tmp .= "background-size: {$atts['background_size_manual']};";
							}
						} else {
							$tmp .= "background-size: {$atts['background_size']};";
						}
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $tmp !== '' ) {
				$insight_shortcode_css .= "$selector{ $tmp }";
			}

			$insight_shortcode_css .= self::get_vc_row_gutter( $selector, $gutter );

			$insight_shortcode_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function get_vc_row_inner_css( $selector = '', $atts ) {
			global $insight_shortcode_css;
			global $insight_shortcode_md_css;
			global $insight_shortcode_sm_css;
			global $insight_shortcode_xs_css;
			$gutter = '';
			extract( $atts );
			$tmp = '';

			if ( $atts['max_width'] !== '' ) {
				$tmp .= "width: {$atts['max_width']}; max-width: 100%;";
				if ( $atts['content_alignment'] === 'center' ) {
					$tmp .= "margin: 0 auto;";
				} elseif ( $atts['content_alignment'] === 'right' ) {
					$tmp .= "float: right;";
				}
				if ( $atts['md_content_alignment'] !== '' ) {
					if ( $atts['md_content_alignment'] === 'left' ) {
						$insight_shortcode_md_css .= "$selector{ float: left; }";
					} elseif ( $atts['md_content_alignment'] === 'center' ) {
						$insight_shortcode_md_css .= "$selector{ margin: 0 auto; }";
					} elseif ( $atts['md_content_alignment'] === 'right' ) {
						$insight_shortcode_md_css .= "$selector{ float: right; }";
					}
				}
				if ( $atts['sm_content_alignment'] !== '' ) {
					if ( $atts['sm_content_alignment'] === 'left' ) {
						$insight_shortcode_sm_css .= "$selector{ float: left; }";
					} elseif ( $atts['sm_content_alignment'] === 'center' ) {
						$insight_shortcode_sm_css .= "$selector{ margin: 0 auto; }";
					} elseif ( $atts['sm_content_alignment'] === 'right' ) {
						$insight_shortcode_sm_css .= "$selector{ float: right; }";
					}
				}
				if ( $atts['xs_content_alignment'] !== '' ) {
					if ( $atts['xs_content_alignment'] === 'left' ) {
						$insight_shortcode_xs_css .= "$selector{ float: left; }";
					} elseif ( $atts['xs_content_alignment'] === 'center' ) {
						$insight_shortcode_xs_css .= "$selector{ margin: 0 auto; }";
					} elseif ( $atts['xs_content_alignment'] === 'right' ) {
						$insight_shortcode_xs_css .= "$selector{ float: right; }";
					}
				}
			}

			if ( $atts['border_radius'] !== '' ) {
				$tmp .= "-moz-border-radius: {$atts['border_radius']};-webkit-border-radius: {$atts['border_radius']};border-radius: {$atts['border_radius']};";
			}

			if ( $atts['box_shadow'] !== '' ) {
				$tmp .= "-moz-box-shadow: {$atts['box_shadow']};-webkit-box-shadow: {$atts['box_shadow']};box-shadow: {$atts['box_shadow']};";
			}

			if ( $atts['background_color'] === 'custom_color' ) {
				$tmp .= "background-color: {$atts['custom_background_color']};";
			} elseif ( $atts['background_color'] === 'gradient' ) {
				$tmp .= $atts['background_gradient'];
			}

			if ( $atts['background_image'] !== '' ) {
				$_url = wp_get_attachment_image_url( $atts['background_image'], 'full' );
				if ( $_url !== false ) {
					$tmp .= "background-image: url( $_url );";

					if ( $atts['background_size'] !== 'auto' ) {
						$tmp .= "background-size: {$atts['background_size']};";
					}

					$tmp .= "background-repeat: {$atts['background_repeat']};";
					if ( $atts['background_attachment'] === 'fixed' ) {
						$tmp .= "background-attachment: {$atts['background_attachment']};";
					}
					if ( $atts['background_position'] !== '' ) {
						$tmp .= "background-position: {$atts['background_position']};";
					}
				}
			}

			if ( $tmp !== '' ) {
				$insight_shortcode_css .= "$selector{ $tmp }";
			}

			$insight_shortcode_css .= self::get_vc_row_gutter( $selector, $gutter );

			$insight_shortcode_css .= self::get_vc_spacing_css( $selector, $atts );
		}

		public static function vc_spacing_has_border( $atts ) {
			$spacings = array(
				'lg_spacing',
				'md_spacing',
				'sm_spacing',
				'xs_spacing',
			);
			foreach ( $spacings as $val ) {
				if ( isset( $atts[ $val ] ) && $atts[ $val ] !== '' ) {
					if ( strpos( $atts[ $val ], 'border' ) !== false ) {
						return true;
					}
				}
			}

			return false;
		}

		/**
		 * Generate to gutter CSS
		 *
		 * @param $selector
		 * @param $gutter
		 *
		 * @return string
		 */
		public static function get_vc_row_gutter( $selector, $gutter ) {
			$css = $default_css = $css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( $gutter !== '' ) {

				if ( ! is_numeric( $gutter ) ) {
					$arr = self::parse_responsive_string( $gutter );

					if ( ! empty( $arr ) ) {
						if ( count( $arr ) > 1 ) {

							foreach ( $arr as $key => $number ) {
								$number /= 2;
								switch ( $key ) {
									case 'xs':
										$css_xs_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_xs_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'sm':
										$css_sm_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_sm_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'md':
										$css_md_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_md_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									case 'lg':
										$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
										$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
										break;
									default:
										break;
								}
							}
						} else { // default css.
							$number     = $arr['lg'] / 2;
							$css_lg_tmp .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
							$css_lg_tmp .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
						}
					}
				} else {
					$number      = $gutter / 2;
					$default_css .= "$selector { margin-left: -{$number}px; margin-right: -{$number}px; }";
					$default_css .= "$selector > .vc_column_container > .vc_column-inner { padding-left: {$number}px; padding-right: {$number}px; }";
				}

				if ( $default_css ) {
					$css .= $default_css;
				}

				if ( $css_lg_tmp ) {
					$css .= $css_lg_tmp;
				}
				if ( $css_md_tmp ) {
					$css .= "@media (max-width: 1199px){ $css_md_tmp }";
				}

				if ( $css_sm_tmp ) {
					$css .= "@media (max-width: 767px){ $css_sm_tmp }";
				}

				if ( $css_xs_tmp ) {
					$css .= "@media (max-width: 543px){ $css_xs_tmp }";
				}
			}

			return $css;
		}

		public static function get_vc_spacing_css( $selector = '', $atts ) {
			$css = '';

			if ( isset( $atts['lg_spacing'] ) && $atts['lg_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['lg_spacing'] );
			}

			if ( $atts['md_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['md_spacing'], 'max-width: 1199px' );
			}

			if ( $atts['sm_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['sm_spacing'], 'max-width: 992px' );
			}

			if ( $atts['xs_spacing'] !== '' ) {
				$css .= self::parse_spacing_value( $atts, $selector, $atts['xs_spacing'], 'max-width: 767px' );
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $selector
		 * @param $values
		 * @param $media
		 *
		 * @return string
		 */
		public static function parse_spacing_value( $atts, $selector, $values, $media = '' ) {

			$css = '';

			if ( $selector ) {
				$spacing = explode( ';', $values );

				if ( $media !== '' ) {
					$css .= "@media ( $media ) {";
				}

				$css .= "$selector {";

				foreach ( $spacing as $value ) {
					$tmp  = explode( ':', $value );
					$attr = str_replace( '_', '-', $tmp[0] );
					$val  = $tmp[1];

					if ( strpos( $attr, 'border' ) !== false ) {
						$css          .= "$attr-width : {$val}px !important;";
						$border_color = '';
						if ( $atts['border_color'] === 'custom_color' ) {
							$border_color = $atts['custom_border_color'];
						} elseif ( $atts['border_color'] === 'primary' ) {
							$border_color = Insight::setting( 'primary_color' );
						}
						$css .= "$attr-color: $border_color;";
						$css .= "$attr-style: {$atts['border_style']};";
					} else {
						$css .= "$attr : {$val}px !important;";
					}
				}

				$css .= "}";

				if ( $media !== '' ) {
					$css .= "}";
				}
			}

			return $css;
		}

		public static function get_media_query_css( $selector, $attr, $value, $media ) {
			$css = '';
			if ( $selector ) {
				$css .= "@media ( $media ) { $selector { $attr:{$value}; } }";
			}

			return $css;
		}

		/**
		 * Generate to responsive CSS
		 *
		 * @param $args
		 *
		 * @return string
		 */
		public static function get_responsive_css( $args = array() ) {
			$css = $default_css = $css_lg_tmp = $css_md_tmp = $css_sm_tmp = $css_xs_tmp = '';

			if ( ! empty( $args['element'] ) && ! empty( $args['atts'] ) ) {

				$element = $args['element'];

				foreach ( $args['atts'] as $prop => $prop_array ) {
					$unit = $prop_array['unit'];

					if ( ! is_numeric( $prop_array['media_str'] ) ) {
						$arr = self::parse_responsive_string( $prop_array['media_str'] );

						if ( ! empty( $arr ) ) {
							if ( count( $arr ) > 1 ) {

								foreach ( $arr as $key => $number ) {
									switch ( $key ) {
										case 'xs':
											$css_xs_tmp .= $prop . ':' . $number . $unit . ';';
											break;
										case 'sm':
											$css_sm_tmp .= $prop . ':' . $number . $unit . ';';
											break;
										case 'md':
											$css_md_tmp .= $prop . ':' . $number . $unit . ';';
											break;
										case 'lg':
											$css_lg_tmp .= $prop . ':' . $number . $unit . ';';
											break;
										default:
											break;
									}
								}
							} else { // default css.
								$default_css .= $prop . ':' . $arr['lg'] . $unit . ';';
							}
						}
					} else {
						$default_css .= $prop . ':' . $prop_array['media_str'] . $unit . ';';
					}
				}

				if ( $default_css ) {
					$css .= $element . '{' . $default_css . '}';
				}

				if ( $css_lg_tmp ) {
					$css .= "$element { $css_lg_tmp }";
				}
				if ( $css_md_tmp ) {
					$css .= "@media (max-width: 1199px){ $element { $css_md_tmp }}";
				}

				if ( $css_sm_tmp ) {
					$css .= "@media (max-width: 767px){ $element { $css_sm_tmp }}";
				}

				if ( $css_xs_tmp ) {
					$css .= "@media (max-width: 543px){ $element { $css_xs_tmp }}";
				}
			}

			return $css;
		}

		/**
		 * Parse responsive string to array
		 *
		 * @param $str
		 *
		 * @return array
		 */
		public static function parse_responsive_string( $str ) {
			$data     = preg_split( '/;/', $str );
			$data_arr = array();

			foreach ( $data as $d ) {
				$pieces = explode( ':', $d );
				if ( count( $pieces ) == 2 ) {
					$key              = $pieces[0];
					$number           = $pieces[1];
					$data_arr[ $key ] = $number;
				}
			}

			return $data_arr;
		}

		public static function icon_libraries( $args = array() ) {
			$defaults = array(
				'dependency'     => array(),
				'admin_label'    => true,
				'allow_none'     => false,
				'param_name'     => 'type',
				'icon_libraries' => array(
					esc_html__( 'Font Awesome', 'tm-arden' ) => 'fontawesome',
					esc_html__( 'P7 Stroke', 'tm-arden' )    => 'pe7stroke',
					esc_html__( 'Linea', 'tm-arden' )        => 'linea',
				),
				'group'          => esc_html__( 'Icon', 'tm-arden' ),
			);
			$args     = wp_parse_args( $args, $defaults );

			if ( $args['allow_none'] ) {
				$args['icon_libraries'] = array( esc_html__( 'None', 'tm-arden' ) => '' ) + $args['icon_libraries'];
			}

			$type = array(
				'type'        => 'dropdown',
				'heading'     => esc_html__( 'Icon library', 'tm-arden' ),
				'value'       => $args['icon_libraries'],
				'param_name'  => $args['param_name'],
				'description' => esc_html__( 'Select icon library.', 'tm-arden' ),
			);

			if ( $args['admin_label'] ) {
				$type['admin_label'] = true;
			}

			if ( ! empty( $args['dependency'] ) ) {
				$type['dependency'] = $args['dependency'];
			}

			$results = array(
				$type,
			);

			foreach ( $args['icon_libraries'] as $key => $value ) {
				if ( $value === 'fontawesome' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'tm-arden' ),
						'param_name'  => 'icon_fontawesome',
						'value'       => 'fa fa-adjust',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'fontawesome',
							'iconsPerPage' => 4000,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'fontawesome',
						),
						'description' => esc_html__( 'Select icon from library.', 'tm-arden' ),
					);
				} elseif ( $value === 'pe7stroke' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'tm-arden' ),
						'param_name'  => 'icon_pe7stroke',
						'value'       => 'pe-7s-album',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'pe7stroke',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'pe7stroke',
						),
						'description' => esc_html__( 'Select icon from library.', 'tm-arden' ),
					);
				} elseif ( $value === 'linea' ) {
					$results[] = array(
						'type'        => 'iconpicker',
						'heading'     => esc_html__( 'Icon', 'tm-arden' ),
						'param_name'  => 'icon_linea',
						'value'       => 'icon-basic-accelerator',
						'settings'    => array(
							'emptyIcon'    => true,
							'type'         => 'linea',
							'iconsPerPage' => 400,
						),
						'dependency'  => array(
							'element' => $args['param_name'],
							'value'   => 'linea',
						),
						'description' => esc_html__( 'Select icon from library.', 'tm-arden' ),
					);
				}
			}

			if ( $args['group'] !== '' ) {
				foreach ( $results as $key => $item ) {
					$results[ $key ]['group'] = $args['group'];
				}
			}

			return $results;
		}

		public function update_google_fonts() {
			global $wp_filesystem;

			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();

			$path = get_template_directory() . '/assets/fonts/vc_google_fonts.json';

			$fonts = array();

			if ( file_exists( $path ) ) {

				$json  = $wp_filesystem->get_contents( $path );
				$fonts = json_decode( $json );
			}

			return $fonts;
		}

		/**
		 * Add pe 7 stroke font icon for vc
		 *
		 * @param $icons
		 *
		 * @return array
		 */
		public function add_font_pe7stroke( $icons ) {
			$pe7stroke_icons = array(
				array( 'pe-7s-album' => 'album' ),
				array( 'pe-7s-arc' => 'arc' ),
				array( 'pe-7s-back-2' => 'back-2' ),
				array( 'pe-7s-bandaid' => 'bandaid' ),
				array( 'pe-7s-car' => 'car' ),
				array( 'pe-7s-diamond' => 'diamond' ),
				array( 'pe-7s-door-lock' => 'door-lock' ),
				array( 'pe-7s-eyedropper' => 'eyedropper' ),
				array( 'pe-7s-female' => 'female' ),
				array( 'pe-7s-gym' => 'gym' ),
				array( 'pe-7s-hammer' => 'hammer' ),
				array( 'pe-7s-headphones' => 'headphones' ),
				array( 'pe-7s-helm' => 'helm' ),
				array( 'pe-7s-hourglass' => 'hourglass' ),
				array( 'pe-7s-leaf' => 'leaf' ),
				array( 'pe-7s-magic-wand' => 'magic wand' ),
				array( 'pe-7s-male' => 'male' ),
				array( 'pe-7s-map-2' => 'map 2' ),
				array( 'pe-7s-next-2' => 'next 2' ),
				array( 'pe-7s-paint-bucket' => 'paint bucket' ),
				array( 'pe-7s-pendrive' => 'pendrive' ),
				array( 'pe-7s-photo' => 'photo' ),
				array( 'pe-7s-piggy' => 'piggy' ),
				array( 'pe-7s-plugin' => 'plugin' ),
				array( 'pe-7s-refresh-2' => 'refresh 2' ),
				array( 'pe-7s-rocket' => 'rocket' ),
				array( 'pe-7s-settings' => 'settings' ),
				array( 'pe-7s-shield' => 'shield' ),
				array( 'pe-7s-smile' => 'smile' ),
				array( 'pe-7s-usb' => 'usb' ),
				array( 'pe-7s-vector' => 'vector' ),
				array( 'pe-7s-wine' => 'wine' ),
				array( 'pe-7s-cloud-upload' => 'cloud upload' ),
				array( 'pe-7s-cash' => 'cash' ),
				array( 'pe-7s-close' => 'close' ),
				array( 'pe-7s-bluetooth' => 'bluetooth' ),
				array( 'pe-7s-cloud-download' => 'cloud download' ),
				array( 'pe-7s-way' => 'way' ),
				array( 'pe-7s-close-circle' => 'close circle' ),
				array( 'pe-7s-id' => 'id' ),
				array( 'pe-7s-angle-up' => 'angle up' ),
				array( 'pe-7s-wristwatch' => 'wristwatch' ),
				array( 'pe-7s-angle-up-circle' => 'angle-up-circle' ),
				array( 'pe-7s-world' => 'world' ),
				array( 'pe-7s-angle-right' => 'Angle Right' ),
				array( 'pe-7s-volume' => 'volume' ),
				array( 'pe-7s-angle-right-circle' => 'angle right circle right' ),
				array( 'pe-7s-users' => 'Users' ),
				array( 'pe-7s-angle-left' => 'angle left' ),
				array( 'pe-7s-user-female' => 'user female' ),
				array( 'pe-7s-angle-left-circle' => 'angle left circle' ),
				array( 'pe-7s-up-arrow' => 'Sound' ),
				array( 'pe-7s-angle-down' => 'up arrow' ),
				array( 'pe-7s-switch' => 'switch' ),
				array( 'pe-7s-angle-down-circle' => 'down circle' ),
				array( 'pe-7s-scissors' => 'scissors' ),
				array( 'pe-7s-wallet' => 'wallet' ),
				array( 'pe-7s-safe' => 'safe' ),
				array( 'pe-7s-volume2' => 'volume2' ),
				array( 'pe-7s-volume1' => 'volume1' ),
				array( 'pe-7s-voicemail' => 'voice mail' ),
				array( 'pe-7s-video' => 'video' ),
				array( 'pe-7s-user' => 'user' ),
				array( 'pe-7s-upload' => 'upload' ),
				array( 'pe-7s-unlock' => 'unlock' ),
				array( 'pe-7s-umbrella' => 'umbrella' ),
				array( 'pe-7s-trash' => 'trash' ),
				array( 'pe-7s-tools' => 'tools' ),
				array( 'pe-7s-timer' => 'timer' ),
				array( 'pe-7s-ticket' => 'ticket' ),
				array( 'pe-7s-target' => 'target' ),
				array( 'pe-7s-sun' => 'sun' ),
				array( 'pe-7s-study' => 'study' ),
				array( 'pe-7s-stopwatch' => 'stopwatch' ),
				array( 'pe-7s-star' => 'star' ),
				array( 'pe-7s-speaker' => 'speaker' ),
				array( 'pe-7s-signal' => 'signal' ),
				array( 'pe-7s-shuffle' => 'shuffle' ),
				array( 'pe-7s-shopbag' => 'shopbag' ),
				array( 'pe-7s-share' => 'share' ),
				array( 'pe-7s-server' => 'server' ),
				array( 'pe-7s-search' => 'search' ),
				array( 'pe-7s-film' => 'film' ),
				array( 'pe-7s-science' => 'science' ),
				array( 'pe-7s-disk' => 'disk' ),
				array( 'pe-7s-ribbon' => 'ribbon' ),
				array( 'pe-7s-repeat' => 'repeat' ),
				array( 'pe-7s-refresh' => 'refresh' ),
				array( 'pe-7s-add-user' => 'add user' ),
				array( 'pe-7s-refresh-cloud' => 'refresh cloud' ),
				array( 'pe-7s-paperclip' => 'paperclip' ),
				array( 'pe-7s-radio' => 'radio' ),
				array( 'pe-7s-note2' => 'note2' ),
				array( 'pe-7s-print' => 'print' ),
				array( 'pe-7s-network' => 'network' ),
				array( 'pe-7s-prev' => 'prev' ),
				array( 'pe-7s-mute' => 'mute' ),
				array( 'pe-7s-power' => 'power' ),
				array( 'pe-7s-medal' => 'medal' ),
				array( 'pe-7s-portfolio' => 'portfolio' ),
				array( 'pe-7s-like2' => 'like2' ),
				array( 'pe-7s-plus' => 'plus' ),
				array( 'pe-7s-left-arrow' => 'left arrow' ),
				array( 'pe-7s-play' => 'play' ),
				array( 'pe-7s-key' => 'key' ),
				array( 'pe-7s-plane' => 'plane' ),
				array( 'pe-7s-joy' => 'joy' ),
				array( 'pe-7s-photo-gallery' => 'photo gallery' ),
				array( 'pe-7s-pin' => 'pin' ),
				array( 'pe-7s-phone' => 'phone' ),
				array( 'pe-7s-plug' => 'plug' ),
				array( 'pe-7s-pen' => 'pen' ),
				array( 'pe-7s-right-arrow' => 'right arrow' ),
				array( 'pe-7s-paper-plane' => 'paper plane' ),
				array( 'pe-7s-delete-user' => 'delete user' ),
				array( 'pe-7s-paint' => 'paint' ),
				array( 'pe-7s-bottom-arrow' => 'bottom arrow' ),
				array( 'pe-7s-notebook' => 'notebook' ),
				array( 'pe-7s-note' => 'note' ),
				array( 'pe-7s-next' => 'next' ),
				array( 'pe-7s-news-paper' => 'news paper' ),
				array( 'pe-7s-musiclist' => 'musiclist' ),
				array( 'pe-7s-music' => 'music' ),
				array( 'pe-7s-mouse' => 'mouse' ),
				array( 'pe-7s-more' => 'more' ),
				array( 'pe-7s-moon' => 'moon' ),
				array( 'pe-7s-monitor' => 'monitor' ),
				array( 'pe-7s-micro' => 'micro' ),
				array( 'pe-7s-menu' => 'menu' ),
				array( 'pe-7s-map' => 'map' ),
				array( 'pe-7s-map-marker' => 'map marker' ),
				array( 'pe-7s-mail' => 'mail' ),
				array( 'pe-7s-mail-open' => 'mail open' ),
				array( 'pe-7s-mail-open-file' => 'mail open file' ),
				array( 'pe-7s-magnet' => 'magnet' ),
				array( 'pe-7s-loop' => 'loop' ),
				array( 'pe-7s-look' => 'look' ),
				array( 'pe-7s-lock' => 'lock' ),
				array( 'pe-7s-lintern' => 'lintern' ),
				array( 'pe-7s-link' => 'link' ),
				array( 'pe-7s-like' => 'like' ),
				array( 'pe-7s-light' => 'light' ),
				array( 'pe-7s-less' => 'less' ),
				array( 'pe-7s-keypad' => 'keypad' ),
				array( 'pe-7s-junk' => 'junk' ),
				array( 'pe-7s-info' => 'info' ),
				array( 'pe-7s-home' => 'home' ),
				array( 'pe-7s-help2' => 'help2' ),
				array( 'pe-7s-help1' => 'help1' ),
				array( 'pe-7s-graph3' => 'graph3' ),
				array( 'pe-7s-graph2' => 'graph2' ),
				array( 'pe-7s-graph1' => 'graph1' ),
				array( 'pe-7s-graph' => 'graph3' ),
				array( 'pe-7s-global' => 'global' ),
				array( 'pe-7s-gleam' => 'gleam' ),
				array( 'pe-7s-glasses' => 'glasses' ),
				array( 'pe-7s-gift' => 'gift' ),
				array( 'pe-7s-folder' => 'folder' ),
				array( 'pe-7s-flag' => 'flag' ),
				array( 'pe-7s-filter' => 'filter' ),
				array( 'pe-7s-file' => 'file' ),
				array( 'pe-7s-expand1' => 'expand1' ),
				array( 'pe-7s-expand2' => 'expand2' ),
				array( 'pe-7s-edit' => 'edit' ),
				array( 'pe-7s-drop' => 'drop' ),
				array( 'pe-7s-drawer' => 'drawer' ),
				array( 'pe-7s-download' => 'download' ),
				array( 'pe-7s-display2' => 'display2' ),
				array( 'pe-7s-display1' => 'display1' ),
				array( 'pe-7s-diskette' => 'diskette' ),
				array( 'pe-7s-date' => 'date' ),
				array( 'pe-7s-cup' => 'cup' ),
				array( 'pe-7s-culture' => 'culture' ),
				array( 'pe-7s-crop' => 'crop' ),
				array( 'pe-7s-credit' => 'credit' ),
				array( 'pe-7s-copy-file' => 'copy file' ),
				array( 'pe-7s-config' => 'config' ),
				array( 'pe-7s-compass' => 'compass' ),
				array( 'pe-7s-comment' => 'comment' ),
				array( 'pe-7s-coffee' => 'coffee' ),
				array( 'pe-7s-cloud' => 'cloud' ),
				array( 'pe-7s-clock' => 'clock' ),
				array( 'pe-7s-check' => 'check' ),
				array( 'pe-7s-chat' => 'chat' ),
				array( 'pe-7s-cart' => 'cart' ),
				array( 'pe-7s-camera' => 'Camera' ),
				array( 'pe-7s-call' => 'call' ),
				array( 'pe-7s-calculator' => 'calculator' ),
				array( 'pe-7s-browser' => 'browser' ),
				array( 'pe-7s-box2' => 'box2' ),
				array( 'pe-7s-box1' => 'box1' ),
				array( 'pe-7s-bookmarks' => 'bookmarks' ),
				array( 'pe-7s-bicycle' => 'bicycle' ),
				array( 'pe-7s-bell' => 'bell' ),
				array( 'pe-7s-battery' => 'battery' ),
				array( 'pe-7s-ball' => 'ball' ),
				array( 'pe-7s-back' => 'back' ),
				array( 'pe-7s-attention' => 'attention' ),
				array( 'pe-7s-anchor' => 'anchor' ),
				array( 'pe-7s-albums' => 'albums' ),
				array( 'pe-7s-alarm' => 'alarm' ),
				array( 'pe-7s-airplay' => 'airplay' ),
			);

			return array_merge( $icons, $pe7stroke_icons );
		}

		/**
		 * Add linea font icon for vc
		 *
		 * @param $icons
		 *
		 * @return array
		 */
		public function add_font_linea( $icons ) {
			$linea_icons = array(
				array( 'icon-basic-accelerator' => 'basic accelerator' ),
				array( 'icon-basic-alarm' => 'basic alarm' ),
				array( 'icon-basic-anchor' => 'basic anchor' ),
				array( 'icon-basic-anticlockwise' => 'basic anticlockwise' ),
				array( 'icon-basic-archive' => 'basic archive' ),
				array( 'icon-basic-archive-full' => 'basic archive full' ),
				array( 'icon-basic-ban' => 'basic ban' ),
				array( 'icon-basic-battery-charge' => 'basic battery charge' ),
				array( 'icon-basic-battery-empty' => 'basic battery empty' ),
				array( 'icon-basic-battery-full' => 'basic battery full' ),
				array( 'icon-basic-battery-half' => 'basic battery half' ),
				array( 'icon-basic-bolt' => 'basic bolt' ),
				array( 'icon-basic-book' => 'basic book' ),
				array( 'icon-basic-book-pen' => 'basic book pen' ),
				array( 'icon-basic-book-pencil' => 'basic book pencil' ),
				array( 'icon-basic-bookmark' => 'basic bookmark' ),
				array( 'icon-basic-calculator' => 'basic calculator' ),
				array( 'icon-basic-calendar' => 'basic calendar' ),
				array( 'icon-basic-cards-diamonds' => 'basic cards diamonds' ),
				array( 'icon-basic-cards-hearts' => 'basic cards hearts' ),
				array( 'icon-basic-case' => 'basic case' ),
				array( 'icon-basic-chronometer' => 'basic chronometer' ),
				array( 'icon-basic-clessidre' => 'basic clessidre' ),
				array( 'icon-basic-clock' => 'basic clock' ),
				array( 'icon-basic-clockwise' => 'basic clockwise' ),
				array( 'icon-basic-cloud' => 'basic cloud' ),
				array( 'icon-basic-clubs' => 'basic clubs' ),
				array( 'icon-basic-compass' => 'basic compass' ),
				array( 'icon-basic-cup' => 'basic cup' ),
				array( 'icon-basic-diamonds' => 'basic diamonds' ),
				array( 'icon-basic-display' => 'basic display' ),
				array( 'icon-basic-download' => 'basic download' ),
				array( 'icon-basic-exclamation' => 'basic exclamation' ),
				array( 'icon-basic-eye' => 'basic eye' ),
				array( 'icon-basic-eye-closed' => 'basic eye closed' ),
				array( 'icon-basic-female' => 'basic female' ),
				array( 'icon-basic-flag1' => 'basic flag1' ),
				array( 'icon-basic-flag2' => 'basic flag2' ),
				array( 'icon-basic-floppydisk' => 'basic floppydisk' ),
				array( 'icon-basic-folder' => 'basic folder' ),
				array( 'icon-basic-folder-multiple' => 'basic folder multiple' ),
				array( 'icon-basic-gear' => 'basic gear' ),
				array( 'icon-basic-geolocalize-01' => 'basic geolocalize 01' ),
				array( 'icon-basic-geolocalize-05' => 'basic geolocalize 05' ),
				array( 'icon-basic-globe' => 'basic globe' ),
				array( 'icon-basic-gunsight' => 'basic gunsight' ),
				array( 'icon-basic-hammer' => 'basic hammer' ),
				array( 'icon-basic-headset' => 'basic headset' ),
				array( 'icon-basic-heart' => 'basic heart' ),
				array( 'icon-basic-heart-broken' => 'basic heart broken' ),
				array( 'icon-basic-helm' => 'basic helm' ),
				array( 'icon-basic-home' => 'basic home' ),
				array( 'icon-basic-info' => 'basic info' ),
				array( 'icon-basic-ipod' => 'basic ipod' ),
				array( 'icon-basic-joypad' => 'basic joypad' ),
				array( 'icon-basic-key' => 'basic key' ),
				array( 'icon-basic-keyboard' => 'basic keyboard' ),
				array( 'icon-basic-laptop' => 'basic laptop' ),
				array( 'icon-basic-life-buoy' => 'basic life buoy' ),
				array( 'icon-basic-lightbulb' => 'basic lightbulb' ),
				array( 'icon-basic-link' => 'basic link' ),
				array( 'icon-basic-lock' => 'basic lock' ),
				array( 'icon-basic-lock-open' => 'basic lock open' ),
				array( 'icon-basic-magic-mouse' => 'basic magic mouse' ),
				array( 'icon-basic-magnifier' => 'basic magnifier' ),
				array( 'icon-basic-magnifier-minus' => 'basic magnifier minus' ),
				array( 'icon-basic-magnifier-plus' => 'basic magnifier plus' ),
				array( 'icon-basic-mail' => 'basic mail' ),
				array( 'icon-basic-mail-multiple' => 'basic mail multiple' ),
				array( 'icon-basic-mail-open' => 'basic mail open' ),
				array( 'icon-basic-mail-open-text' => 'basic mail open text' ),
				array( 'icon-basic-male' => 'basic male' ),
				array( 'icon-basic-map' => 'basic map' ),
				array( 'icon-basic-message' => 'basic message' ),
				array( 'icon-basic-message-multiple' => 'basic message multiple' ),
				array( 'icon-basic-message-txt' => 'basic message txt' ),
				array( 'icon-basic-mixer2' => 'basic mixer2' ),
				array( 'icon-basic-mouse' => 'basic mouse' ),
				array( 'icon-basic-notebook' => 'basic notebook' ),
				array( 'icon-basic-notebook-pen' => 'basic notebook pen' ),
				array( 'icon-basic-notebook-pencil' => 'basic notebook pencil' ),
				array( 'icon-basic-paperplane' => 'basic paperplane' ),
				array( 'icon-basic-pencil-ruler' => 'basic pencil ruler' ),
				array( 'icon-basic-pencil-ruler-pen' => 'basic pencil ruler pen' ),
				array( 'icon-basic-photo' => 'basic photo' ),
				array( 'icon-basic-picture' => 'basic picture' ),
				array( 'icon-basic-picture-multiple' => 'basic picture multiple' ),
				array( 'icon-basic-pin1' => 'basic pin1' ),
				array( 'icon-basic-pin2' => 'basic pin2' ),
				array( 'icon-basic-postcard' => 'basic postcard' ),
				array( 'icon-basic-postcard-multiple' => 'basic postcard multiple' ),
				array( 'icon-basic-printer' => 'basic printer' ),
				array( 'icon-basic-question' => 'basic question' ),
				array( 'icon-basic-rss' => 'basic rss' ),
				array( 'icon-basic-server' => 'basic server' ),
				array( 'icon-basic-server2' => 'basic server2' ),
				array( 'icon-basic-server-cloud' => 'basic server cloud' ),
				array( 'icon-basic-server-download' => 'basic server download' ),
				array( 'icon-basic-server-upload' => 'basic server upload' ),
				array( 'icon-basic-settings' => 'basic settings' ),
				array( 'icon-basic-share' => 'basic share' ),
				array( 'icon-basic-sheet' => 'basic sheet' ),
				array( 'icon-basic-sheet-multiple' => 'basic sheet multiple' ),
				array( 'icon-basic-sheet-pen' => 'basic sheet pen' ),
				array( 'icon-basic-sheet-pencil' => 'basic sheet pencil' ),
				array( 'icon-basic-sheet-txt' => 'basic sheet txt' ),
				array( 'icon-basic-signs' => 'basic signs' ),
				array( 'icon-basic-smartphone' => 'basic smartphone' ),
				array( 'icon-basic-spades' => 'basic spades' ),
				array( 'icon-basic-spread' => 'basic spread' ),
				array( 'icon-basic-spread-bookmark' => 'basic spread bookmark' ),
				array( 'icon-basic-spread-text' => 'basic spread text' ),
				array( 'icon-basic-spread-text-bookmark' => 'basic spread text bookmark' ),
				array( 'icon-basic-star' => 'basic star' ),
				array( 'icon-basic-tablet' => 'basic tablet' ),
				array( 'icon-basic-target' => 'basic target' ),
				array( 'icon-basic-todo' => 'basic todo' ),
				array( 'icon-basic-todo-pen' => 'basic todo pen' ),
				array( 'icon-basic-todo-pencil' => 'basic todo pencil' ),
				array( 'icon-basic-todo-txt' => 'basic todo txt' ),
				array( 'icon-basic-todolist-pen' => 'basic todolist pen' ),
				array( 'icon-basic-todolist-pencil' => 'basic todolist pencil' ),
				array( 'icon-basic-trashcan' => 'basic trashcan' ),
				array( 'icon-basic-trashcan-full' => 'basic trashcan full' ),
				array( 'icon-basic-trashcan-refresh' => 'basic trashcan refresh' ),
				array( 'icon-basic-trashcan-remove' => 'basic trashcan remove' ),
				array( 'icon-basic-upload' => 'basic upload' ),
				array( 'icon-basic-usb' => 'basic usb' ),
				array( 'icon-basic-video' => 'basic video' ),
				array( 'icon-basic-watch' => 'basic watch' ),
				array( 'icon-basic-webpage' => 'basic webpage' ),
				array( 'icon-basic-webpage-img-txt' => 'basic webpage img txt' ),
				array( 'icon-basic-webpage-multiple' => 'basic webpage multiple' ),
				array( 'icon-basic-webpage-txt' => 'basic webpage txt' ),
				array( 'icon-basic-world' => 'basic world' ),

				array( 'icon-basic-elaboration-bookmark-checck' => 'basic elaboration ' ),
				array( 'icon-basic-elaboration-bookmark-minus' => 'basic elaboration bookmark minus' ),
				array( 'icon-basic-elaboration-bookmark-plus' => 'basic elaboration bookmark plus' ),
				array( 'icon-basic-elaboration-bookmark-remove' => 'basic elaboration bookmark remove' ),
				array( 'icon-basic-elaboration-briefcase-check' => 'basic elaboration briefcase check' ),
				array( 'icon-basic-elaboration-briefcase-download' => 'basic elaboration briefcase download' ),
				array( 'icon-basic-elaboration-briefcase-flagged' => 'basic elaboration briefcase flagged' ),
				array( 'icon-basic-elaboration-briefcase-minus' => 'basic elaboration briefcase minus' ),
				array( 'icon-basic-elaboration-briefcase-plus' => 'basic elaboration briefcase plus' ),
				array( 'icon-basic-elaboration-briefcase-refresh' => 'basic elaboration briefcase refresh' ),
				array( 'icon-basic-elaboration-briefcase-remove' => 'basic elaboration briefcase remove' ),
				array( 'icon-basic-elaboration-briefcase-search' => 'basic elaboration briefcase search' ),
				array( 'icon-basic-elaboration-briefcase-star' => 'basic elaboration briefcase star' ),
				array( 'icon-basic-elaboration-briefcase-upload' => 'basic elaboration briefcase upload' ),
				array( 'icon-basic-elaboration-browser-check' => 'basic elaboration browser check' ),
				array( 'icon-basic-elaboration-browser-download' => 'basic elaboration browser download' ),
				array( 'icon-basic-elaboration-browser-minus' => 'basic elaboration browser minus' ),
				array( 'icon-basic-elaboration-browser-plus' => 'basic elaboration browser plus' ),
				array( 'icon-basic-elaboration-browser-refresh' => 'basic elaboration browser refresh' ),
				array( 'icon-basic-elaboration-browser-remove' => 'basic elaboration browser remove' ),
				array( 'icon-basic-elaboration-browser-search' => 'basic elaboration browser search' ),
				array( 'icon-basic-elaboration-browser-star' => 'basic elaboration browser star' ),
				array( 'icon-basic-elaboration-browser-upload' => 'basic elaboration browser upload' ),
				array( 'icon-basic-elaboration-calendar-check' => 'basic elaboration calendar check' ),
				array( 'icon-basic-elaboration-calendar-cloud' => 'basic elaboration calendar cloud' ),
				array( 'icon-basic-elaboration-calendar-download' => 'basic elaboration calendar download' ),
				array( 'icon-basic-elaboration-calendar-empty' => 'basic elaboration calendar empty' ),
				array( 'icon-basic-elaboration-calendar-flagged' => 'basic elaboration calendar flagged' ),
				array( 'icon-basic-elaboration-calendar-heart' => 'basic elaboration calendar heart' ),
				array( 'icon-basic-elaboration-calendar-minus' => 'basic elaboration calendar minus' ),
				array( 'icon-basic-elaboration-calendar-next' => 'basic elaboration calendar next' ),
				array( 'icon-basic-elaboration-calendar-noaccess' => 'basic elaboration calendar noaccess' ),
				array( 'icon-basic-elaboration-calendar-pencil' => 'basic elaboration calendar pencil' ),
				array( 'icon-basic-elaboration-calendar-plus' => 'basic elaboration calendar plus' ),
				array( 'icon-basic-elaboration-calendar-previous' => 'basic elaboration calendar previous' ),
				array( 'icon-basic-elaboration-calendar-refresh' => 'basic elaboration calendar refresh' ),
				array( 'icon-basic-elaboration-calendar-remove' => 'basic elaboration calendar remove' ),
				array( 'icon-basic-elaboration-calendar-search' => 'basic elaboration calendar search' ),
				array( 'icon-basic-elaboration-calendar-star' => 'basic elaboration calendar star' ),
				array( 'icon-basic-elaboration-calendar-upload' => 'basic elaboration calendar upload' ),
				array( 'icon-basic-elaboration-cloud-check' => 'basic elaboration cloud check' ),
				array( 'icon-basic-elaboration-cloud-download' => 'basic elaboration cloud download' ),
				array( 'icon-basic-elaboration-cloud-minus' => 'basic elaboration cloud minus' ),
				array( 'icon-basic-elaboration-cloud-noaccess' => 'basic elaboration cloud noaccess' ),
				array( 'icon-basic-elaboration-cloud-plus' => 'basic elaboration cloud plus' ),
				array( 'icon-basic-elaboration-cloud-refresh' => 'basic elaboration cloud refresh' ),
				array( 'icon-basic-elaboration-cloud-remove' => 'basic elaboration cloud remove' ),
				array( 'icon-basic-elaboration-cloud-search' => 'basic elaboration cloud search' ),
				array( 'icon-basic-elaboration-document-check' => 'basic elaboration document check' ),
				array( 'icon-basic-elaboration-document-cloud' => 'basic elaboration document cloud' ),
				array( 'icon-basic-elaboration-document-download' => 'basic elaboration document download' ),
				array( 'icon-basic-elaboration-document-flagged' => 'basic elaboration document flagged' ),
				array( 'icon-basic-elaboration-document-graph' => 'basic elaboration document graph' ),
				array( 'icon-basic-elaboration-document-heart' => 'basic elaboration document heart' ),
				array( 'icon-basic-elaboration-document-minus' => 'basic elaboration document minus' ),
				array( 'icon-basic-elaboration-document-next' => 'basic elaboration document next' ),
				array( 'icon-basic-elaboration-document-noaccess' => 'basic elaboration document noaccess' ),
				array( 'icon-basic-elaboration-document-note' => 'basic elaboration document note' ),
				array( 'icon-basic-elaboration-document-pencil' => 'basic elaboration document pencil' ),
				array( 'icon-basic-elaboration-document-picture' => 'basic elaboration document picture' ),
				array( 'icon-basic-elaboration-document-plus' => 'basic elaboration document plus' ),
				array( 'icon-basic-elaboration-document-previous' => 'basic elaboration document previous' ),
				array( 'icon-basic-elaboration-document-refresh' => 'basic elaboration document refresh' ),
				array( 'icon-basic-elaboration-document-remove' => 'basic elaboration document remove' ),
				array( 'icon-basic-elaboration-document-search' => 'basic elaboration document search' ),
				array( 'icon-basic-elaboration-document-star' => 'basic elaboration document star' ),
				array( 'icon-basic-elaboration-document-upload' => 'basic elaboration document upload' ),
				array( 'icon-basic-elaboration-folder-check' => 'basic elaboration folder check' ),
				array( 'icon-basic-elaboration-folder-cloud' => 'basic elaboration folder cloud' ),
				array( 'icon-basic-elaboration-folder-document' => 'basic elaboration folder document' ),
				array( 'icon-basic-elaboration-folder-download' => 'basic elaboration folder download' ),
				array( 'icon-basic-elaboration-folder-flagged' => 'basic elaboration folder flagged' ),
				array( 'icon-basic-elaboration-folder-graph' => 'basic elaboration folder graph' ),
				array( 'icon-basic-elaboration-folder-heart' => 'basic elaboration folder heart' ),
				array( 'icon-basic-elaboration-folder-minus' => 'basic elaboration folder minus' ),
				array( 'icon-basic-elaboration-folder-next' => 'basic elaboration folder next' ),
				array( 'icon-basic-elaboration-folder-noaccess' => 'basic elaboration folder noaccess' ),
				array( 'icon-basic-elaboration-folder-note' => 'basic elaboration folder note' ),
				array( 'icon-basic-elaboration-folder-pencil' => 'basic elaboration folder pencil' ),
				array( 'icon-basic-elaboration-folder-picture' => 'basic elaboration folder picture' ),
				array( 'icon-basic-elaboration-folder-plus' => 'basic elaboration folder plus' ),
				array( 'icon-basic-elaboration-folder-previous' => 'basic elaboration folder previous' ),
				array( 'icon-basic-elaboration-folder-refresh' => 'basic elaboration folder refresh' ),
				array( 'icon-basic-elaboration-folder-remove' => 'basic elaboration folder remove' ),
				array( 'icon-basic-elaboration-folder-search' => 'basic elaboration folder search' ),
				array( 'icon-basic-elaboration-folder-star' => 'basic elaboration folder star' ),
				array( 'icon-basic-elaboration-folder-upload' => 'basic elaboration folder upload' ),
				array( 'icon-basic-elaboration-mail-check' => 'basic elaboration mail check' ),
				array( 'icon-basic-elaboration-mail-cloud' => 'basic elaboration mail cloud' ),
				array( 'icon-basic-elaboration-mail-document' => 'basic elaboration mail document' ),
				array( 'icon-basic-elaboration-mail-download' => 'basic elaboration mail download' ),
				array( 'icon-basic-elaboration-mail-flagged' => 'basic elaboration mail flagged' ),
				array( 'icon-basic-elaboration-mail-heart' => 'basic elaboration mail heart' ),
				array( 'icon-basic-elaboration-mail-next' => 'basic elaboration mail next' ),
				array( 'icon-basic-elaboration-mail-noaccess' => 'basic elaboration mail noaccess' ),
				array( 'icon-basic-elaboration-mail-note' => 'basic elaboration mail note' ),
				array( 'icon-basic-elaboration-mail-pencil' => 'basic elaboration mail pencil' ),
				array( 'icon-basic-elaboration-mail-picture' => 'basic elaboration mail picture' ),
				array( 'icon-basic-elaboration-mail-previous' => 'basic elaboration mail previous' ),
				array( 'icon-basic-elaboration-mail-refresh' => 'basic elaboration mail refresh' ),
				array( 'icon-basic-elaboration-mail-remove' => 'basic elaboration mail remove' ),
				array( 'icon-basic-elaboration-mail-search' => 'basic elaboration mail search' ),
				array( 'icon-basic-elaboration-mail-star' => 'basic elaboration mail star' ),
				array( 'icon-basic-elaboration-mail-upload' => 'basic elaboration mail upload' ),
				array( 'icon-basic-elaboration-message-check' => 'basic elaboration message check' ),
				array( 'icon-basic-elaboration-message-dots' => 'basic elaboration message dots' ),
				array( 'icon-basic-elaboration-message-happy' => 'basic elaboration message happy' ),
				array( 'icon-basic-elaboration-message-heart' => 'basic elaboration message heart' ),
				array( 'icon-basic-elaboration-message-minus' => 'basic elaboration message minus' ),
				array( 'icon-basic-elaboration-message-note' => 'basic elaboration message note' ),
				array( 'icon-basic-elaboration-message-plus' => 'basic elaboration message plus' ),
				array( 'icon-basic-elaboration-message-refresh' => 'basic elaboration message refresh' ),
				array( 'icon-basic-elaboration-message-remove' => 'basic elaboration message remove' ),
				array( 'icon-basic-elaboration-message-sad' => 'basic elaboration message sad' ),
				array( 'icon-basic-elaboration-smartphone-cloud' => 'basic elaboration smartphone cloud' ),
				array( 'icon-basic-elaboration-smartphone-heart' => 'basic elaboration smartphone heart' ),
				array( 'icon-basic-elaboration-smartphone-noaccess' => 'basic elaboration smartphone noaccess' ),
				array( 'icon-basic-elaboration-smartphone-note' => 'basic elaboration smartphone note' ),
				array( 'icon-basic-elaboration-smartphone-pencil' => 'basic elaboration smartphone pencil' ),
				array( 'icon-basic-elaboration-smartphone-picture' => 'basic elaboration smartphone picture' ),
				array( 'icon-basic-elaboration-smartphone-refresh' => 'basic elaboration smartphone refresh' ),
				array( 'icon-basic-elaboration-smartphone-search' => 'basic elaboration smartphone search' ),
				array( 'icon-basic-elaboration-tablet-cloud' => 'basic elaboration tablet cloud' ),
				array( 'icon-basic-elaboration-tablet-heart' => 'basic elaboration tablet heart' ),
				array( 'icon-basic-elaboration-tablet-noaccess' => 'basic elaboration tablet noaccess' ),
				array( 'icon-basic-elaboration-tablet-note' => 'basic elaboration tablet note' ),
				array( 'icon-basic-elaboration-tablet-pencil' => 'basic elaboration tablet pencil' ),
				array( 'icon-basic-elaboration-tablet-picture' => 'basic elaboration tablet picture' ),
				array( 'icon-basic-elaboration-tablet-refresh' => 'basic elaboration tablet refresh' ),
				array( 'icon-basic-elaboration-tablet-search' => 'basic elaboration tablet search' ),
				array( 'icon-basic-elaboration-todolist-2' => 'basic elaboration todolist-2' ),
				array( 'icon-basic-elaboration-todolist-check' => 'basic elaboration todolist check' ),
				array( 'icon-basic-elaboration-todolist-cloud' => 'basic elaboration todolist cloud' ),
				array( 'icon-basic-elaboration-todolist-download' => 'basic elaboration todolist download' ),
				array( 'icon-basic-elaboration-todolist-flagged' => 'basic elaboration todolist flagged' ),
				array( 'icon-basic-elaboration-todolist-minus' => 'basic elaboration todolist minus' ),
				array( 'icon-basic-elaboration-todolist-noaccess' => 'basic elaboration todolist noaccess' ),
				array( 'icon-basic-elaboration-todolist-pencil' => 'basic elaboration todolist pencil' ),
				array( 'icon-basic-elaboration-todolist-plus' => 'basic elaboration todolist-plus' ),
				array( 'icon-basic-elaboration-todolist-refresh' => 'basic elaboration todolist refresh' ),
				array( 'icon-basic-elaboration-todolist-remove' => 'basic elaboration todolist remove' ),
				array( 'icon-basic-elaboration-todolist-search' => 'basic elaboration todolist search' ),
				array( 'icon-basic-elaboration-todolist-star' => 'basic elaboration todolist star' ),
				array( 'icon-basic-elaboration-todolist-upload' => 'basic elaboration todolist upload' ),

				array( 'icon-arrows-anticlockwise' => 'arrows anticlockwise' ),
				array( 'icon-arrows-anticlockwise-dashed' => 'arrows anticlockwise dashed' ),
				array( 'icon-arrows-button-down' => 'arrows button down' ),
				array( 'icon-arrows-button-off' => 'arrows button off' ),
				array( 'icon-arrows-button-on' => 'arrows button on' ),
				array( 'icon-arrows-button-up' => 'arrows button up' ),
				array( 'icon-arrows-check' => 'arrows check' ),
				array( 'icon-arrows-circle-check' => 'arrows circle check' ),
				array( 'icon-arrows-circle-down' => 'arrows circle down' ),
				array( 'icon-arrows-circle-downleft' => 'arrows circle downleft' ),
				array( 'icon-arrows-circle-downright' => 'arrows circle downright' ),
				array( 'icon-arrows-circle-left' => 'arrows circle left' ),
				array( 'icon-arrows-circle-minus' => 'arrows circle minus' ),
				array( 'icon-arrows-circle-plus' => 'arrows circle plus' ),
				array( 'icon-arrows-circle-remove' => 'arrows circle remove' ),
				array( 'icon-arrows-circle-right' => 'arrows circle right' ),
				array( 'icon-arrows-circle-up' => 'arrows circle up' ),
				array( 'icon-arrows-circle-upleft' => 'arrows circle upleft' ),
				array( 'icon-arrows-circle-upright' => 'arrows circle upright' ),
				array( 'icon-arrows-clockwise' => 'arrows clockwise' ),
				array( 'icon-arrows-clockwise' => 'arrows clockwise' ),
				array( 'icon-arrows-clockwise-dashed' => 'arrows clockwise dashed' ),
				array( 'icon-arrows-compress' => 'arrows compress' ),
				array( 'icon-arrows-deny' => 'arrows deny' ),
				array( 'icon-arrows-diagonal' => 'arrows diagonal' ),
				array( 'icon-arrows-diagonal2' => 'arrows diagonal2' ),
				array( 'icon-arrows-down-double' => 'arrows down double' ),
				array( 'icon-arrows-downright' => 'arrows downright' ),
				array( 'icon-arrows-drag-down' => 'arrows drag down' ),
				array( 'icon-arrows-drag-down-dashed' => 'arrows drag down dashed' ),
				array( 'icon-arrows-drag-horiz' => 'arrows drag horiz' ),
				array( 'icon-arrows-drag-left' => 'arrows drag left' ),
				array( 'icon-arrows-drag-left-dashed' => 'arrows drag left dashed' ),
				array( 'icon-arrows-drag-right' => 'arrows drag right' ),
				array( 'icon-arrows-drag-right-dashed' => 'arrows drag right dashed' ),
				array( 'icon-arrows-drag-up' => 'arrows drag up' ),
				array( 'icon-arrows-drag-up-dashed' => 'arrows drag up dashed' ),
				array( 'icon-arrows-exclamation' => 'arrows exclamation' ),
				array( 'icon-arrows-expand' => 'arrows expand' ),
				array( 'icon-arrows-expand-diagonal1' => 'arrows expand diagonal1' ),
				array( 'icon-arrows-expand-horizontal1' => 'arrows expand horizontal1' ),
				array( 'icon-arrows-expand-vertical1' => 'arrows expand vertical1' ),
				array( 'icon-arrows-fit-horizontal' => 'arrows fit horizontal' ),
				array( 'icon-arrows-fit-vertical' => 'arrows fit vertical' ),
				array( 'icon-arrows-glide' => 'arrows glide' ),
				array( 'icon-arrows-glide-horizontal' => 'arrows glide horizontal' ),
				array( 'icon-arrows-glide-vertical' => 'arrows glide vertical' ),
				array( 'icon-arrows-hamburger1' => 'arrows hamburger1' ),
				array( 'icon-arrows-hamburger-2' => 'arrows hamburger 2' ),
				array( 'icon-arrows-horizontal' => 'arrows horizontal' ),
				array( 'icon-arrows-info' => 'arrows info' ),
				array( 'icon-arrows-keyboard-alt' => 'arrows keyboard alt' ),
				array( 'icon-arrows-keyboard-cmd' => 'arrows keyboard cmd' ),
				array( 'icon-arrows-keyboard-delete' => 'arrows keyboard delete' ),
				array( 'icon-arrows-keyboard-down' => 'arrows keyboard down' ),
				array( 'icon-arrows-keyboard-left' => 'arrows keyboard left' ),
				array( 'icon-arrows-keyboard-return' => 'arrows keyboard return' ),
				array( 'icon-arrows-keyboard-right' => 'arrows keyboard right' ),
				array( 'icon-arrows-keyboard-shift' => 'arrows keyboard shift' ),
				array( 'icon-arrows-keyboard-tab' => 'arrows keyboard tab' ),
				array( 'icon-arrows-keyboard-up' => 'arrows keyboard up' ),
				array( 'icon-arrows-left' => 'arrows left' ),
				array( 'icon-arrows-left-double-32' => 'arrows left double 32' ),
				array( 'icon-arrows-minus' => 'arrows minus' ),
				array( 'icon-arrows-move' => 'arrows move' ),
				array( 'icon-arrows-move2' => 'arrows move2' ),
				array( 'icon-arrows-move-bottom' => 'arrows move bottom' ),
				array( 'icon-arrows-move-left' => 'arrows move left' ),
				array( 'icon-arrows-move-right' => 'arrows move right' ),
				array( 'icon-arrows-move-top' => 'arrows move top' ),
				array( 'icon-arrows-plus' => 'arrows plus' ),
				array( 'icon-arrows-question' => 'arrows question' ),
				array( 'icon-arrows-remove' => 'arrows remove' ),
				array( 'icon-arrows-right' => 'arrows right' ),
				array( 'icon-arrows-right-double' => 'arrows right double' ),
				array( 'icon-arrows-rotate' => 'arrows rotate' ),
				array( 'icon-arrows-rotate-anti' => 'arrows rotate anti' ),
				array( 'icon-arrows-rotate-anti-dashed' => 'arrows rotate anti dashed' ),
				array( 'icon-arrows-rotate-dashed' => 'arrows rotate dashed' ),
				array( 'icon-arrows-shrink' => 'arrows shrink' ),
				array( 'icon-arrows-shrink-diagonal1' => 'arrows shrink diagonal1' ),
				array( 'icon-arrows-shrink-diagonal2' => 'arrows shrink diagonal2' ),
				array( 'icon-arrows-shrink-horizonal2' => 'arrows shrink horizonal2' ),
				array( 'icon-arrows-shrink-horizontal1' => 'arrows shrink horizontal1' ),
				array( 'icon-arrows-shrink-vertical1' => 'arrows shrink vertical1' ),
				array( 'icon-arrows-shrink-vertical2' => 'arrows shrink vertical2' ),
				array( 'icon-arrows-sign-down' => 'arrows sign down' ),
				array( 'icon-arrows-sign-left' => 'arrows sign left' ),
				array( 'icon-arrows-sign-right' => 'arrows sign right' ),
				array( 'icon-arrows-sign-up' => 'arrows sign up' ),
				array( 'icon-arrows-slide-down1' => 'arrows slide down1' ),
				array( 'icon-arrows-slide-down2' => 'arrows slide down2' ),
				array( 'icon-arrows-slide-left1' => 'arrows slide left1' ),
				array( 'icon-arrows-slide-left2' => 'arrows slide left2' ),
				array( 'icon-arrows-slide-right1' => 'arrows slide right1' ),
				array( 'icon-arrows-slide-right2' => 'arrows slide right2' ),
				array( 'icon-arrows-slide-up1' => 'arrows slide up1' ),
				array( 'icon-arrows-slim-down' => 'arrows slim down' ),
				array( 'icon-arrows-slim-down-dashed' => 'arrows slim down dashed' ),
				array( 'icon-arrows-slim-left' => 'arrows slim left' ),
				array( 'icon-arrows-slim-left-dashed' => 'arrows slim left dashed' ),
				array( 'icon-arrows-slim-right' => 'arrows slim right' ),
				array( 'icon-arrows-slim-right-dashed' => 'arrows slim right dashed' ),
				array( 'icon-arrows-slim-up' => 'arrows slim up' ),
				array( 'icon-arrows-slim-up-dashed' => 'arrows slim up dashed' ),
				array( 'icon-arrows-square-check' => 'arrows square check' ),
				array( 'icon-arrows-square-down' => 'arrows square down' ),
				array( 'icon-arrows-square-downleft' => 'arrows square downleft' ),
				array( 'icon-arrows-square-downright' => 'arrows square downright' ),
				array( 'icon-arrows-square-left' => 'arrows square left' ),
				array( 'icon-arrows-square-minus' => 'arrows square minus' ),
				array( 'icon-arrows-square-plus' => 'arrows square plus' ),
				array( 'icon-arrows-square-remove' => 'arrows square remove' ),
				array( 'icon-arrows-square-right' => 'arrows square right' ),
				array( 'icon-arrows-square-up' => 'arrows square up' ),
				array( 'icon-arrows-square-upleft' => 'arrows square upleft' ),
				array( 'icon-arrows-square-upright' => 'arrows square upright' ),
				array( 'icon-arrows-squares' => 'arrows squares' ),
				array( 'icon-arrows-stretch-diagonal1' => 'arrows stretch diagonal1' ),
				array( 'icon-arrows-stretch-diagonal2' => 'arrows stretch diagonal2' ),
				array( 'icon-arrows-stretch-diagonal3' => 'arrows stretch diagonal3' ),
				array( 'icon-arrows-stretch-diagonal4' => 'arrows stretch diagonal4' ),
				array( 'icon-arrows-stretch-horizontal1' => 'arrows stretch horizontal1' ),
				array( 'icon-arrows-stretch-horizontal2' => 'arrows stretch horizontal2' ),
				array( 'icon-arrows-stretch-vertical1' => 'arrows stretch vertical1' ),
				array( 'icon-arrows-stretch-vertical2' => 'arrows stretch vertical2' ),
				array( 'icon-arrows-switch-horizontal' => 'arrows switch horizontal' ),
				array( 'icon-arrows-switch-vertical' => 'arrows switch vertical' ),
				array( 'icon-arrows-up' => 'arrows up' ),
				array( 'icon-arrows-up-double-33' => 'arrows up double 33' ),
				array( 'icon-arrows-upleft' => 'arrows upleft' ),
				array( 'icon-arrows-upright' => 'arrows upright' ),
				array( 'icon-arrows-vertical' => 'arrows vertical' ),

				array( 'icon-ecommerce-bag' => 'ecommerce bag' ),
				array( 'icon-ecommerce-bag-check' => 'ecommerce bag check' ),
				array( 'icon-ecommerce-bag-cloud' => 'ecommerce bag cloud' ),
				array( 'icon-ecommerce-bag-download' => 'ecommerce bag download' ),
				array( 'icon-ecommerce-bag-minus' => 'ecommerce bag minus' ),
				array( 'icon-ecommerce-bag-plus' => 'ecommerce bag plus' ),
				array( 'icon-ecommerce-bag-refresh' => 'ecommerce bag refresh' ),
				array( 'icon-ecommerce-bag-remove' => 'ecommerce bag remove' ),
				array( 'icon-ecommerce-bag-search' => 'ecommerce bag search' ),
				array( 'icon-ecommerce-bag-upload' => 'ecommerce bag upload' ),
				array( 'icon-ecommerce-banknote' => 'ecommerce banknote' ),
				array( 'icon-ecommerce-banknotes' => 'ecommerce banknotes' ),
				array( 'icon-ecommerce-basket' => 'ecommerce basket' ),
				array( 'icon-ecommerce-basket-check' => 'ecommerce basket check' ),
				array( 'icon-ecommerce-basket-cloud' => 'ecommerce basket cloud' ),
				array( 'icon-ecommerce-basket-download' => 'ecommerce basket download' ),
				array( 'icon-ecommerce-basket-minus' => 'ecommerce basket minus' ),
				array( 'icon-ecommerce-basket-plus' => 'ecommerce basket plus' ),
				array( 'icon-ecommerce-basket-refresh' => 'ecommerce basket refresh' ),
				array( 'icon-ecommerce-basket-remove' => 'ecommerce basket remove' ),
				array( 'icon-ecommerce-basket-search' => 'ecommerce basket search' ),
				array( 'icon-ecommerce-basket-upload' => 'ecommerce basket upload' ),
				array( 'icon-ecommerce-bath' => 'ecommerce bath' ),
				array( 'icon-ecommerce-cart' => 'ecommerce cart' ),
				array( 'icon-ecommerce-cart-check' => 'ecommerce cart check' ),
				array( 'icon-ecommerce-cart-cloud' => 'ecommerce cart cloud' ),
				array( 'icon-ecommerce-cart-content' => 'ecommerce cart content' ),
				array( 'icon-ecommerce-cart-download' => 'ecommerce cart download' ),
				array( 'icon-ecommerce-cart-minus' => 'ecommerce cart minus' ),
				array( 'icon-ecommerce-cart-plus' => 'ecommerce cart plus' ),
				array( 'icon-ecommerce-cart-refresh' => 'ecommerce cart refresh' ),
				array( 'icon-ecommerce-cart-remove' => 'ecommerce cart remove' ),
				array( 'icon-ecommerce-cart-search' => 'ecommerce cart search' ),
				array( 'icon-ecommerce-cart-upload' => 'ecommerce cart upload' ),
				array( 'icon-ecommerce-cent' => 'ecommerce cent' ),
				array( 'icon-ecommerce-colon' => 'ecommerce colon' ),
				array( 'icon-ecommerce-creditcard' => 'ecommerce creditcard' ),
				array( 'icon-ecommerce-diamond' => 'ecommerce diamond' ),
				array( 'icon-ecommerce-dollar' => 'ecommerce dollar' ),
				array( 'icon-ecommerce-euro' => 'ecommerce euro' ),
				array( 'icon-ecommerce-franc' => 'ecommerce franc' ),
				array( 'icon-ecommerce-gift' => 'ecommerce gift' ),
				array( 'icon-ecommerce-graph1' => 'ecommerce graph1' ),
				array( 'icon-ecommerce-graph2' => 'ecommerce graph2' ),
				array( 'icon-ecommerce-graph3' => 'ecommerce graph3' ),
				array( 'icon-ecommerce-graph-decrease' => 'ecommerce graph decrease' ),
				array( 'icon-ecommerce-graph-increase' => 'ecommerce graph increase' ),
				array( 'icon-ecommerce-guarani' => 'ecommerce guarani' ),
				array( 'icon-ecommerce-kips' => 'ecommerce kips' ),
				array( 'icon-ecommerce-lira' => 'ecommerce lira' ),
				array( 'icon-ecommerce-megaphone' => 'ecommerce megaphone' ),
				array( 'icon-ecommerce-money' => 'ecommerce money' ),
				array( 'icon-ecommerce-naira' => 'ecommerce naira' ),
				array( 'icon-ecommerce-pesos' => 'ecommerce pesos' ),
				array( 'icon-ecommerce-pound' => 'ecommerce pound' ),
				array( 'icon-ecommerce-receipt' => 'ecommerce receipt' ),
				array( 'icon-ecommerce-receipt-bath' => 'ecommerce receipt bath' ),
				array( 'icon-ecommerce-receipt-cent' => 'ecommerce receipt cent' ),
				array( 'icon-ecommerce-receipt-dollar' => 'ecommerce receipt dollar' ),
				array( 'icon-ecommerce-receipt-euro' => 'ecommerce receipt euro' ),
				array( 'icon-ecommerce-receipt-franc' => 'ecommerce receipt franc' ),
				array( 'icon-ecommerce-receipt-guarani' => 'ecommerce receipt guarani' ),
				array( 'icon-ecommerce-receipt-kips' => 'ecommerce receipt kips' ),
				array( 'icon-ecommerce-receipt-lira' => 'ecommerce receipt lira' ),
				array( 'icon-ecommerce-receipt-naira' => 'ecommerce receipt naira' ),
				array( 'icon-ecommerce-receipt-pesos' => 'ecommerce receipt pesos' ),
				array( 'icon-ecommerce-receipt-pound' => 'ecommerce receipt pound' ),
				array( 'icon-ecommerce-receipt-rublo' => 'ecommerce receipt rublo' ),
				array( 'icon-ecommerce-receipt-rupee' => 'ecommerce receipt rupee' ),
				array( 'icon-ecommerce-receipt-tugrik' => 'ecommerce receipt tugrik' ),
				array( 'icon-ecommerce-receipt-won' => 'ecommerce receipt won' ),
				array( 'icon-ecommerce-receipt-yen' => 'ecommerce receipt yen' ),
				array( 'icon-ecommerce-receipt-yen2' => 'ecommerce receipt yen2' ),
				array( 'icon-ecommerce-recept-colon' => 'ecommerce recept colon' ),
				array( 'icon-ecommerce-rublo' => 'ecommerce rublo' ),
				array( 'icon-ecommerce-rupee' => 'ecommerce rupee' ),
				array( 'icon-ecommerce-safe' => 'ecommerce safe' ),
				array( 'icon-ecommerce-sale' => 'ecommerce sale' ),
				array( 'icon-ecommerce-sales' => 'ecommerce sales' ),
				array( 'icon-ecommerce-ticket' => 'ecommerce ticket' ),
				array( 'icon-ecommerce-tugriks' => 'ecommerce tugriks' ),
				array( 'icon-ecommerce-wallet' => 'ecommerce wallet' ),
				array( 'icon-ecommerce-won' => 'ecommerce won' ),
				array( 'icon-ecommerce-yen' => 'ecommerce yen' ),
				array( 'icon-ecommerce-yen2' => 'ecommerce yen2' ),

				array( 'icon-music-beginning-button' => 'music music beginning button' ),
				array( 'icon-music-bell' => 'music bell' ),
				array( 'icon-music-cd' => 'music cd' ),
				array( 'icon-music-diapason' => 'music diapason' ),
				array( 'icon-music-eject-button' => 'music eject button' ),
				array( 'icon-music-end-button' => 'music end button' ),
				array( 'icon-music-fastforward-button' => 'music fastforward button' ),
				array( 'icon-music-headphones' => 'music music headphones' ),
				array( 'icon-music-ipod' => 'music ipod' ),
				array( 'icon-music-loudspeaker' => 'music loudspeaker' ),
				array( 'icon-music-microphone' => 'music microphone' ),
				array( 'icon-music-microphone-old' => 'music microphone old' ),
				array( 'icon-music-mixer' => 'music mixer' ),
				array( 'icon-music-mute' => 'music mute' ),
				array( 'icon-music-note-multiple' => 'music note multiple' ),
				array( 'icon-music-note-single' => 'music note single' ),
				array( 'icon-music-pause-button' => 'music pause button' ),
				array( 'icon-music-play-button' => 'music play button' ),
				array( 'icon-music-playlist' => 'music playlist' ),
				array( 'icon-music-radio-ghettoblaster' => 'music radio ghettoblaster' ),
				array( 'icon-music-radio-portable' => 'music radio portable' ),
				array( 'icon-music-record' => 'music record' ),
				array( 'icon-music-recordplayer' => 'music recordplayer' ),
				array( 'icon-music-repeat-button' => 'music repeat button' ),
				array( 'icon-music-rewind-button' => 'music rewind button' ),
				array( 'icon-music-shuffle-button' => 'music shuffle button' ),
				array( 'icon-music-stop-button' => 'music stop button' ),
				array( 'icon-music-tape' => 'music tape' ),
				array( 'icon-music-volume-down' => 'music volume down' ),
				array( 'icon-music-volume-up' => 'music volume up' ),
			);

			return array_merge( $icons, $linea_icons );
		}
	}

	Insight_VC::instance()->init();
}
