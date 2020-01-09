<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue scripts and styles.
 */
if ( ! class_exists( 'Insight_Enqueue' ) ) {
	class Insight_Enqueue {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array(
				$this,
				'enqueue',
			) );
			add_action( 'wp_enqueue_scripts', array(
				$this,
				'custom_css',
			) );
			add_action( 'customize_controls_init', array(
				$this,
				'customize_preview_css',
			) );
			// Add custom JS.
			add_action( 'wp_footer', array( $this, 'custom_js' ), 99 );

			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );
		}

		/**
		 * Enqueue scrips & styles.
		 *
		 * @access public
		 */
		public function enqueue() {
			$post_type = get_post_type();
			$min       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ? '' : '.min';

			// Remove prettyPhoto, default light box of woocommerce.
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );

			// Remove font awesome from Yith Wishlist plugin.
			wp_dequeue_style( 'yith-wcwl-font-awesome' );

			/*
			 * Enqueue the theme's style.css.
			 * This is recommended because we can add inline styles there
			 * and some plugins use it to do exactly that.
			 */
			wp_enqueue_style( 'insight-style', get_stylesheet_uri() );

			/*
			 * Enqueue icon fonts
			 */

			// Deregister font awesome from visual composer plugin.
			wp_deregister_style( 'font-awesome' );
			wp_enqueue_style( 'font-awesome', INSIGHT_THEME_URI . '/assets/libs/font-awesome/css/font-awesome.min.css', array(), '4.7' );
			wp_enqueue_style( 'pe-stroke-7', INSIGHT_THEME_URI . '/assets/libs/pixeden-stroke-7-icon/css/pe-icon-7-stroke.min.css', null, null );

			wp_enqueue_style( 'justifiedGallery', INSIGHT_THEME_URI . '/assets/custom_libs/justifiedGallery/justifiedGallery.min.css', null, null );

			/*
			 * Begin Register styles to be enqueued later using the wp_enqueue_script() function.
			 */

			wp_register_style( 'm-custom-scrollbar', INSIGHT_THEME_URI . '/assets/libs/mCustomScrollbar/jquery.mCustomScrollbar.min.css', array(), '3.1.5' );

			/*
			 * Begin Register scripts to be enqueued later using the wp_enqueue_script() function.
			 */

			wp_register_script( 'easing', INSIGHT_THEME_URI . '/assets/custom_libs/easing/jquery.easing.min.js', array( 'jquery' ), '1.3', true );
			wp_register_script( 'matchheight', INSIGHT_THEME_URI . '/assets/libs/matchHeight/js/jquery.matchHeight-min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_register_script( 'gmap3', INSIGHT_THEME_URI . '/assets/custom_libs/gmap3/gmap3.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_register_script( 'countdown', INSIGHT_THEME_URI . '/assets/libs/jquery.countdown/js/jquery.countdown.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_register_script( 'easy-pie-chart', INSIGHT_THEME_URI . '/assets/custom_libs/ease-pie-chart/jquery.easypiechart.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'typed', INSIGHT_THEME_URI . '/assets/js/typed.min.js', array( 'jquery' ), null, true );
			wp_register_script( 'm-custom-scrollbar', INSIGHT_THEME_URI . '/assets/libs/mCustomScrollbar/jquery.mCustomScrollbar.min.js', array(
				'jquery',
				'mousewheel',
			), null, true );

			wp_register_script( 'tm-pie-chart', INSIGHT_THEME_URI . '/assets/js/tm_pie_chart.js', array(
				'jquery',
				'waypoints',
			), null, true );
			wp_register_script( 'tm-pricing', INSIGHT_THEME_URI . '/assets/js/tm_pricing.js', array(
				'jquery',
				'matchheight',
			), null, true );
			wp_register_script( 'tm-accordion', INSIGHT_THEME_URI . '/assets/js/accordion.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );

			wp_register_script( 'smooth-scroll', INSIGHT_THEME_URI . '/assets/libs/smooth-scroll-for-web/SmoothScroll.min.js', array(
				'jquery',
			), '1.4.6', true );

			/*
			 * End register scripts
			 */

			if ( Insight::setting( 'smooth_scroll_enable' ) ) {
				wp_enqueue_script( 'smooth-scroll' );
			}

			if ( Insight::setting( 'header_sticky_enable' ) ) {
				wp_enqueue_script( 'headroom', INSIGHT_THEME_URI . '/assets/js/headroom.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			}

			wp_enqueue_script( 'picturefill', INSIGHT_THEME_URI . '/assets/js/picturefill.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'lightgallery', INSIGHT_THEME_URI . '/assets/js/lg-full.min.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'matchheight' );
			wp_enqueue_script( 'jquery-smooth-scroll', INSIGHT_THEME_URI . '/assets/custom_libs/smooth-scroll/jquery.smooth-scroll.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'swiper-jquery', INSIGHT_THEME_URI . '/assets/custom_libs/swiper/js/swiper.jquery.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'hoverdir', INSIGHT_THEME_URI . '/assets/js/jquery.hoverdir.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'isotope-masonry', INSIGHT_THEME_URI . '/assets/libs/isotope/js/isotope.pkgd.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'isotope-packery', INSIGHT_THEME_URI . '/assets/js/packery-mode.pkgd.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'waypoints', INSIGHT_THEME_URI . '/assets/libs/waypoints/js/jquery.waypoints.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'mousewheel', INSIGHT_THEME_URI . '/assets/js/jquery.mousewheel.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'counter', INSIGHT_THEME_URI . '/assets/custom_libs/counterup/jquery.counterup.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'smartmenus', INSIGHT_THEME_URI . '/assets/js/jquery.smartmenus.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			wp_enqueue_script( 'justifiedGallery', INSIGHT_THEME_URI . '/assets/custom_libs/justifiedGallery/jquery.justifiedGallery.min.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );

			$single_portfolio_sticky = Insight::setting( 'single_portfolio_sticky_detail_enable' );
			if ( is_singular() && $post_type === 'portfolio' && $single_portfolio_sticky === '1' ) {
				wp_enqueue_script( 'sticky-kit', INSIGHT_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array(
					'jquery',
					'insight-main',
				), INSIGHT_THEME_VERSION, true );
			}

			/*
			 * The comment-reply script.
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				if ( $post_type === 'post' ) {
					if ( Insight::setting( 'single_post_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} elseif ( $post_type === 'portfolio' ) {
					if ( Insight::setting( 'single_portfolio_comment_enable' ) === '1' ) {
						wp_enqueue_script( 'comment-reply' );
					}
				} else {
					wp_enqueue_script( 'comment-reply' );
				}
			}

			$maintenance_templates = Insight_Maintenance::get_maintenance_templates_dir();

			if ( is_page_template( $maintenance_templates ) ) {
				wp_enqueue_script( 'countdown' );
				wp_enqueue_script( 'insight-maintenance', INSIGHT_THEME_URI . '/assets/js/maintenance.js', array( 'jquery' ), INSIGHT_THEME_VERSION, true );
			}

			if ( is_page_template( 'templates/portfolio-fullscreen-split-slider.php' ) ) {
				wp_enqueue_script( 'multiscroll', INSIGHT_THEME_URI . '/assets/js/jquery.multiscroll.js', array(
					'jquery',
					'easing',
				), null, true );
				wp_enqueue_style( 'multiscroll', INSIGHT_THEME_URI . '/assets/custom_libs/multiscroll/jquery.multiscroll.min.css' );
			}

			if ( is_page_template( 'templates/portfolio-fullscreen-carousel-slider.php' ) ) {
				wp_enqueue_style( 'm-custom-scrollbar' );
				wp_enqueue_script( 'm-custom-scrollbar' );
			}

			wp_enqueue_script( 'wpb_composer_front_js' );

			/*
			 * Enqueue main JS
			 */
			wp_enqueue_script( 'insight-main', INSIGHT_THEME_URI . "/assets/js/main{$min}.js", array(
				'jquery',
			), INSIGHT_THEME_VERSION, true );

			if ( class_exists( 'WooCommerce' ) ) {
				wp_enqueue_script( 'insight-woo', INSIGHT_THEME_URI . "/assets/js/woo{$min}.js", array(
					'insight-main',
				), INSIGHT_THEME_VERSION, true );
			}

			if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
				wp_enqueue_script( 'full-page', INSIGHT_THEME_URI . '/assets/js/jquery.fullPage.js', array( 'jquery' ), null, true );
			}

			/*
			 * Enqueue custom variable JS
			 */

			$js_variables = array(
				'templateUrl'               => INSIGHT_THEME_URI,
				'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
				'primary_color'             => Insight::setting( 'primary_color' ),
				'header_sticky_enable'      => Insight::setting( 'header_sticky_enable' ),
				'header_sticky_height'      => Insight::setting( 'header_sticky_height' ),
				'footer_effect'             => Insight::setting( 'footer_effect' ),
				'scroll_top_enable'         => Insight::setting( 'scroll_top_enable' ),
				'light_gallery_auto_play'   => Insight::setting( 'light_gallery_auto_play' ),
				'light_gallery_download'    => Insight::setting( 'light_gallery_download' ),
				'light_gallery_full_screen' => Insight::setting( 'light_gallery_full_screen' ),
				'light_gallery_zoom'        => Insight::setting( 'light_gallery_zoom' ),
				'light_gallery_thumbnail'   => Insight::setting( 'light_gallery_thumbnail' ),
				'mobile_menu_breakpoint'    => Insight::setting( 'mobile_menu_breakpoint' ),
				'like'                      => esc_html__( 'Like', 'tm-arden' ),
				'unlike'                    => esc_html__( 'Unlike', 'tm-arden' ),
			);
			wp_localize_script( 'insight-main', '$insight', $js_variables );
		}

		/**
		 * Enqueue custom style
		 */
		public function custom_css() {
			if ( Insight::setting( 'custom_css_enable' ) ) {
				wp_add_inline_style( 'insight-style', html_entity_decode( Insight::setting( 'custom_css' ), ENT_QUOTES ) );
			}
		}

		/**
		 * Load custom JS
		 */
		public function custom_js() {
			if ( Insight::setting( 'custom_js_enable' ) == 1 ) {
				echo '<script>' . html_entity_decode( Insight::setting( 'custom_js' ) ) . '</script>';
			}
		}

		/**
		 * Add customize preview css
		 */
		public function customize_preview_css() {
			wp_enqueue_style( 'kirki-custom-css', INSIGHT_THEME_URI . '/assets/admin/css/customizer.css' );
		}

	}

	new Insight_Enqueue();
}
