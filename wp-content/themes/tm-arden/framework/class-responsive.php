<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Insight_Responsive' ) ) {
	class Insight_Responsive {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$primary_color             = Insight::setting( 'primary_color' );
			$footer_background         = Insight_Helper::get_post_meta( 'footer_background', '' );
			$footer_background_overlay = Insight_Helper::get_post_meta( 'footer_background_overlay', '' );
			$copyright_background      = Insight_Helper::get_post_meta( 'copyright_background_color', '' );
			$px                        = 'px';

			// Responsive body font-size.
			$body_font_sensitive       = Insight::setting( 'body_font_sensitive' );
			$body_font_size_max        = Insight::setting( 'body_font_size' );
			$body_font_size_min        = $body_font_size_max * $body_font_sensitive;
			$body_font_size_responsive = "calc($body_font_size_min$px + ($body_font_size_max - $body_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H1 font-size.
			$heading_font_sensitive  = Insight::setting( 'heading_font_sensitive' );
			$h1_font_size_max        = Insight::setting( 'h1_font_size' );
			$h1_font_size_min        = $h1_font_size_max * $heading_font_sensitive;
			$h1_font_size_responsive = "calc($h1_font_size_min$px + ($h1_font_size_max - $h1_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H2 font-size.
			$h2_font_size_max        = Insight::setting( 'h2_font_size' );
			$h2_font_size_min        = $h2_font_size_max * $heading_font_sensitive;
			$h2_font_size_responsive = "calc($h2_font_size_min$px + ($h2_font_size_max - $h2_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H3 font-size.
			$h3_font_size_max        = Insight::setting( 'h3_font_size' );
			$h3_font_size_min        = $h3_font_size_max * $heading_font_sensitive;
			$h3_font_size_responsive = "calc($h3_font_size_min$px + ($h3_font_size_max - $h3_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H4 font-size.
			$h4_font_size_max        = Insight::setting( 'h4_font_size' );
			$h4_font_size_min        = $h4_font_size_max * $heading_font_sensitive;
			$h4_font_size_responsive = "calc($h4_font_size_min$px + ($h4_font_size_max - $h4_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H5 font-size.
			$h5_font_size_max        = Insight::setting( 'h5_font_size' );
			$h5_font_size_min        = $h5_font_size_max * $heading_font_sensitive;
			$h5_font_size_responsive = "calc($h5_font_size_min$px + ($h5_font_size_max - $h5_font_size_min) * ((100vw - 554px) / 646))";

			// Responsive H6 font-size.
			$h6_font_size_max        = Insight::setting( 'h6_font_size' );
			$h6_font_size_min        = $h6_font_size_max * $heading_font_sensitive;
			$h6_font_size_responsive = "calc($h6_font_size_min$px + ($h6_font_size_max - $h6_font_size_min) * ((100vw - 554px) / 646))";

			$body_typo     = Insight::setting( 'typography_body' );
			$_primary_font = $body_typo['font-family'];
			$_primary_font = trim( $_primary_font, ' ,' );

			$extra_style = "
				.primary-font, .tm-button, button, input, select, textarea{ font-family: $_primary_font }
				.primary-font-important { font-family: $_primary_font !important }
				::-moz-selection { color: #fff; background-color: $primary_color }
				::selection { color: #fff; background-color: $primary_color }
				body{font-size: $body_font_size_min$px}
				h1,.h1{font-size: $h1_font_size_min$px}
				h2,.h2{font-size: $h2_font_size_min$px}
				h3,.h3{font-size: $h3_font_size_min$px}
				h4,.h4{font-size: $h4_font_size_min$px}
				h5,.h5{font-size: $h5_font_size_min$px}
				h6,.h6{font-size: $h6_font_size_min$px}

				@media (min-width: 544px) and (max-width: 1199px) {
					body{font-size: $body_font_size_responsive}
					h1,.h1{font-size: $h1_font_size_responsive}
					h2,.h2{font-size: $h2_font_size_responsive}
					h3,.h3{font-size: $h3_font_size_responsive}
					h4,.h4{font-size: $h4_font_size_responsive}
					h5,.h5{font-size: $h5_font_size_responsive}
					h6,.h6{font-size: $h6_font_size_responsive}
				}
			";

			$custom_logo_width        = Insight_Helper::get_post_meta( 'custom_logo_width', '' );
			$custom_sticky_logo_width = Insight_Helper::get_post_meta( 'custom_sticky_logo_width', '' );

			if ( $custom_logo_width !== '' ) {
				$extra_style .= ".branding__logo img { 
                    width: {$custom_logo_width} !important; 
                }";
			}

			if ( $custom_sticky_logo_width !== '' ) {
				$extra_style .= ".headroom--not-top .branding__logo .sticky-logo { 
                    width: {$custom_sticky_logo_width} !important; 
                }";
			}

			$headerStickyHeight = Insight::setting( 'header_sticky_height' );
			$stickyPadding      = $headerStickyHeight + 30;
			if ( is_admin_bar_showing() ) {
				$stickyPadding += 32;
			}

			$extra_style .= ".tm-sticky-kit.is_stuck { 
				padding-top: {$stickyPadding}px; 
			}";

			if ( $footer_background !== '' ) {
				$extra_style .= "
				.page-footer-inner {
					background-image: url($footer_background) !important;
				}
			";
			}

			if ( $footer_background_overlay !== '' ) {
				$extra_style .= "
				.page-footer-overlay {
					background-color: $footer_background_overlay !important;
				}
			";
			}

			if ( $copyright_background !== '' ) {
				$extra_style .= "
				.page-copyright-inner {
					background-color: $copyright_background !important;
				}
			";
			}

			$site_width = Insight_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Insight::setting( 'site_width' );
			}
			if ( $site_width !== '' ) {
				$extra_style .= ".boxed {
                max-width: $site_width;
            }
            @media (min-width: 1200px) { .container {
				max-width: $site_width;
			}}";
			}

			$tmp = '';

			$site_background_color = Insight_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Insight_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Insight_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp                    .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Insight_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".site { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Insight_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Insight_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Insight_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp                       .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Insight_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".page-content { $tmp; }";
			}

			$title_bar_bg = Insight_Helper::get_post_meta( 'page_title_bar_background', '' );

			if ( $title_bar_bg !== '' ) {
				$url         = wp_get_attachment_image_url( $title_bar_bg, 'insight-title-bar' );
				$tmp         = "background-image: url($url) !important";
				$extra_style .= ".page-title-bar-inner { $tmp; }";

				$_overlay = Insight_Helper::get_post_meta( 'page_title_bar_background_overlay', '' );
				if ( $_overlay !== '' ) {
					$extra_style .= ".page-title-bar-overlay { background-color: $_overlay !important; }";
				}
			}

			if ( is_search() && ! is_post_type_archive( 'product' ) ) {
				$page_sidebar1 = Insight::setting( 'search_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'search_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'product' ) || ( function_exists( 'is_product_taxonomy' ) && is_product_taxonomy() ) ) {
				$page_sidebar1 = Insight::setting( 'product_archive_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'product_archive_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'portfolio' ) || Insight_Portfolio::is_taxonomy() ) {
				$page_sidebar1 = Insight::setting( 'portfolio_archive_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'portfolio_archive_page_sidebar_2' );
			} elseif ( is_post_type_archive( 'post' ) ) {
				$page_sidebar1 = Insight::setting( 'blog_archive_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'blog_archive_page_sidebar_2' );
			} elseif ( is_home() ) {
				$page_sidebar1 = Insight::setting( 'home_page_sidebar_1' );
				$page_sidebar2 = Insight::setting( 'home_page_sidebar_2' );
			} elseif ( is_singular( 'post' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'post_page_sidebar_1' );
				}
				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'post_page_sidebar_2' );
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'portfolio_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'portfolio_page_sidebar_2' );
				}
			} elseif ( is_singular( 'product' ) ) {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'product_page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'product_page_sidebar_2' );
				}
			} else {
				$page_sidebar1 = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
				$page_sidebar2 = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );
				if ( $page_sidebar1 === 'default' ) {
					$page_sidebar1 = Insight::setting( 'page_sidebar_1' );
				}

				if ( $page_sidebar2 === 'default' ) {
					$page_sidebar2 = Insight::setting( 'page_sidebar_2' );
				}
			}

			if ( 'none' !== $page_sidebar1 ) {
				if ( 'none' !== $page_sidebar2 ) {
					$sidebar_width  = Insight::setting( 'dual_sidebar_width' );
					$sidebar_offset = Insight::setting( 'dual_sidebar_offset' );
					$content_width  = 100 - $sidebar_width * 2;
				} else {
					$sidebar_width  = Insight::setting( 'single_sidebar_width' );
					$sidebar_offset = Insight::setting( 'single_sidebar_offset' );
					$content_width  = 100 - $sidebar_width;
				}

				$extra_style .= "@media (min-width: 768px) {
				.page-sidebar {
					flex: 0 0 $sidebar_width%;
					max-width: $sidebar_width%;
				}
				.page-main-content {
					flex: 0 0 $content_width%;
					max-width: $content_width%;
				}
			}
			@media (min-width: 1200px) {
				.page-sidebar-left .page-sidebar-inner {
					padding-right: $sidebar_offset;
				}
				.page-sidebar-right .page-sidebar-inner {
					padding-left: $sidebar_offset;
				}
			}";
			}

			$extra_style .= $this->get_primary_color_css();
			$extra_style .= $this->get_secondary_color_css();

			$extra_style = Insight_Minify::css( $extra_style );

			wp_add_inline_style( 'insight-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function get_primary_color_css() {
			$primary_color = Insight::setting( 'primary_color' );

			// Color.
			$tmp = ".primary-color,
				.topbar a,
				a.liked,
				blockquote,
				.comment-list .fn a,
				.widget_recent_entries a, .widget_recent_comments a, .widget_archive a, .widget_categories a, .widget_meta a, .widget_product_categories a, .widget_rss a, .widget_pages a, .widget_nav_menu a, .insight-core-bmw a,
				.tm-drop-cap.style-1 .drop-cap,
				.tm-button,
				.tm-button.style-1.tm-button-default:hover,
				.tm-button.style-1.tm-button-primary:hover,
				.tm-button.style-2.tm-button-white:hover,
				.tm-button.style-3.tm-button-default,
				.wpcf7-text.wpcf7-text, .wpcf7-textarea,
				.tm-list--icon .tm-list__marker,
				.tm-list--h-flow .tm-list__title,
				.tm-info-boxes.style-metro .grid-item.skin-secondary .box-title,
				.tm-info-boxes.style-metro .grid-item.skin-secondary .box-text,
				.tm-social-networks__link,
				.tm-counter.style-1 .number-wrap,
				.tm-countdown.skin-dark .number,
				.tm-countdown.skin-dark .separator,
				.tm-swiper.nav-style-1 .swiper-nav-button,
				.tm-grid-wrapper .btn-filter,
				.tm-mailchimp-form.skin-primary input[type=text],
				.tm-mailchimp-form.skin-primary input[type=email],
				.page-template-one-page-scroll[data-row-skin='dark'] #fp-nav ul li .fp-tooltip,
				.page-links > span, .page-links > a, .page-links > a:hover, .page-links > a:focus,
				.page-pagination li a, .page-pagination li span,
				.comment-nav-links li a, .comment-nav-links li span,
				.comment-list .fn,
				.gmap-marker-content,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-title>a,
				.wpb-js-composer .vc_tta-style-arden-01 .vc_tta-tab,
				.wpb-js-composer .vc_tta-style-arden-03 .vc_tta-tab,
				.portfolio-details-list label{ color: {$primary_color}; }";

			// Color Important.
			$tmp .= ".primary-color-important,
				.primary-color-hover-important:hover,
				.rev-button-fill-primary:hover,
				.rev-button-outline-primary,
				.page-template-one-page-scroll[data-row-skin='dark'] .popup-search-wrap i,
				.page-template-one-page-scroll[data-row-skin='dark'] .mini-cart .mini-cart-icon { 
					color: {$primary_color}!important; 
				}";

			// Background Color
			$tmp .= ".primary-background-color,
				.lg-backdrop,
				.page-loading,
				.page-popup-search,
				.page-close-mobile-menu i, .page-close-mobile-menu i:before, .page-close-mobile-menu i:after,
				.tm-grid-wrapper .filter-counter,
				.tm-blog.style-1 .post-quote,
				.tm-blog.style-2 .post-overlay,
				.tm-blog.style-3 .post-quote,
				.tm-blog.style-3 .post-overlay,
				.tm-blog.style-4 .post-overlay,
				.single-post .post-feature .post-quote,
				.tm-button.style-1.tm-button-default,
				.tm-button.style-1.tm-button-primary,
				.tm-button.style-2.tm-button-default:hover,
				.tm-button.style-2.tm-button-primary:hover,
				.scrollup,
				.tm-team-member.style-1 .overlay,
				.tm-swiper.nav-style-2 .swiper-nav-button:hover,
				.tm-swiper.nav-style-3 .swiper-nav-button:hover,
				.tm-blockquote.skin-dark,
				.tm-drop-cap.style-2 .drop-cap,
				.tm-portfolio [data-overlay-animation='hover-dir'] .post-overlay,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay,
				.single-portfolio .swiper-nav-button:hover,
				.single-portfolio .related-portfolio-wrap .post-overlay,
				.tm-gallery .overlay,
				.scrollup,
				.page-preloader .object,
				.portfolio-details-gallery .gallery-item .overlay,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-tab>a,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-tabs.vc_tta-color-primary.vc_tta-style-modern .vc_tta-tab > a,
				.vc_tta-color-primary.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-flat .vc_tta-tab>a,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:focus,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:focus,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:hover,
				.wpb-js-composer .vc_tta-style-arden-01 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta-style-arden-03 .vc_tta-tab.vc_active > a { 
					background-color: {$primary_color};
				}";

			// Background Color Important.
			$tmp .= ".primary-background-color-important,
				.primary-background-color-hover-important:hover,
				.rev-button-fill-primary,
				.rev-button-outline-primary:hover,
				.mejs-controls .mejs-time-rail .mejs-time-current,
				.page-template-one-page-scroll[data-row-skin='dark'] .page-open-mobile-menu i,
				.page-template-one-page-scroll[data-row-skin='dark'] .page-open-mobile-menu i:before,
				.page-template-one-page-scroll[data-row-skin='dark'] .page-open-mobile-menu i:after,
				.page-template-one-page-scroll[data-row-skin='dark'] .page-open-main-menu i,
				.page-template-one-page-scroll[data-row-skin='dark'] .page-open-main-menu i:before,
				.page-template-one-page-scroll[data-row-skin='dark'] .page-open-main-menu i:after { 
					background-color: {$primary_color}!important; 
				}";

			// Border Color.
			$tmp .= ".primary-border-color,
				.tm-button.style-1.tm-button-default,
				.tm-button.style-1.tm-button-primary,
				.tm-button.style-2.tm-button-default:hover,
				.tm-button.style-2.tm-button-primary,
				.tagcloud a:hover,
				.vc_tta-color-primary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-controls-icon::after,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-controls-icon::before,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::after,
				.vc_tta-color-primary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::before,
				.vc_tta-tabs.vc_tta-color-primary.vc_tta-style-outline .vc_tta-tab>a,
				.tm-mailchimp-form.skin-primary input[type=text],
				.tm-mailchimp-form.skin-primary input[type=email] { 
					border-color: {$primary_color}; 
				}";

			// Border Color Important.
			$tmp .= ".primary-border-color-important,
				.primary-border-color-hover-important:hover,
				.rev-button-fill-primary,
				.rev-button-outline-primary{ 
					border-color: {$primary_color}!important; 
				}";

			// Border Top Color.
			$tmp .= ".tm-grid-wrapper .filter-counter:before,
				.wpb-js-composer .vc_tta-style-arden-01 .vc_tta-tab.vc_active:after{ 
					border-top-color: {$primary_color}; 
				}";

			// Border Bottom Color.
			$tmp .= "input[type='text']:focus, input[type='email']:focus, input[type='url']:focus, input[type='password']:focus, input[type='search']:focus, input[type='number']:focus, input[type='tel']:focus, input[type='range']:focus, input[type='date']:focus, input[type='month']:focus, input[type='week']:focus, input[type='time']:focus, input[type='datetime']:focus, input[type='datetime-local']:focus, input[type='color']:focus, textarea:focus { 
				border-bottom-color: {$primary_color}; 
			}";

			// Border Left Color.
			$tmp .= ".wpb-js-composer .vc_tta-style-arden-03 .vc_tta-tab.vc_active:after { 
				border-left-color: {$primary_color}; 
			}";

			if ( class_exists( 'WooCommerce' ) ) {
				// Color for woo.
				$tmp .= ".woocommerce .cart.shop_table .amount,
				.woocommerce .cart-collaterals .amount,
				.woocommerce .cart.shop_table td.product-subtotal,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, .button,
				.woocommerce ul.product_list_widget li > a,
				.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce .cart_list.product_list_widget a,
				.mini-cart .widget_shopping_cart_content li > a:not(.remove),
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.widget_shopping_cart_content .woocommerce-Price-amount, .widget_shopping_cart_content .amount,
				.woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
				.woocommerce.single-product div.product form.cart label,
				.woocommerce .cart.shop_table td.product-name a,
				.woocommerce table.woocommerce-checkout-review-order-table .amount { 
					color: {$primary_color}; 
				}";

				// Background Color For Woo.
				$tmp .= ".woocommerce.single-product div.product .single_add_to_cart_button:hover,
				.woocommerce .cats .product-category:hover .cat-text,
				.tm-product [data-overlay-animation='faded'] .product-overlay,
				.woocommerce .products div.product .product-overlay,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button.alt:hover, .button:hover{ 
					background-color: {$primary_color}; 
				}";

				// Border Color For Woo
				$tmp .= ".woocommerce.single-product div.product .images .thumbnails .item img:hover,
				.woocommerce.single-product div.product .single_add_to_cart_button:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button.alt:hover, .button:hover { 
					border-color: {$primary_color}; 
				}";

				// Border Bottom Color.
				$tmp .= ".woocommerce #coupon_code:focus { 
					border-bottom-color: {$primary_color}; 
				}";
			}

			return $tmp;
		}

		function get_secondary_color_css() {
			$secondary_color = Insight::setting( 'secondary_color' );

			// Color.
			$tmp = ".secondary-color,
				.tm-button.style-1.tm-button-default,
				.tm-button.style-1.tm-button-secondary:hover,
				.tm-button.style-2.tm-button-default:hover,
				.tm-button.style-2.tm-button-secondary,
				.tm-button.style-3.tm-button-secondary,
				.tm-contact-form-7.skin-secondary .wpcf7-text.wpcf7-text,
				.tm-contact-form-7.skin-secondary .wpcf7-textarea,
				.tm-contact-form-7.skin-secondary .wpcf7-select,
				.tm-list--h-flow .tm-list__marker,
				.tm-list--vertical-numbered .tm-list__marker,
				.tm-pricing.tm-pricing-box.style-2 .price-wrap,
				.tm-pricing .tm-pricing-list > li > i,
				.tm-twitter .tweet:before,
				.tm-swiper.nav-style-1 .swiper-nav-button:hover,
				.tm-countdown.skin-light .number,
				.tm-popup-video .video-play i:hover,
				.tm-popup-video.style-button .video-play i,
				.tm-box-icon.style-1 .icon,
				.tm-accordion .accordion-section.active .accordion-title,
				.tm-accordion .accordion-section:hover .accordion-title,
				.highlight-text mark, .typed-text mark,
				.tm-info-boxes.style-metro .grid-item.skin-primary .box-title,
				.single-post .page-main-content .post-categories,
				.single-post .page-main-content .post-tags span,
				.single-post .related-posts .related-post-title a:hover,
				.tm-blog.style-1 .post-title a:hover,
				.tm-blog.style-1 .post-categories,
				.tm-blog.style-2 .post-title a:hover,
				.tm-blog.style-2 .post-categories,
				.tm-blog.style-3 .post-title a:hover,
				.tm-blog.style-3 .post-categories,
				.tm-blog.style-4 .post-title a:hover,
				.tm-blog.style-4 .post-categories,
				.tm-blog.style-5 .post-categories,
				.tm-blog.style-5 .post-title a:hover,
				.tm-portfolio [data-overlay-animation='hover-dir'] .post-overlay-title a,
				.tm-portfolio [data-overlay-animation='hover-dir'] .post-overlay-categories a:hover,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay-title a,
				.tm-portfolio [data-overlay-animation='faded'] .post-overlay-categories a:hover,
				.tm-portfolio .post-title:hover,
				.tm-portfolio .post-categories a:hover,
				.tm-mailchimp-form.skin-secondary input[type=text],
				.tm-mailchimp-form.skin-secondary input[type=email],
				.tm-menu .menu-price,
				.page-content .tm-custom-menu.style-1 .menu a:hover,
				.page-template-blog-fullscreen-slider .post-categories,
				.page-template-blog-fullscreen-slider .post-title a:hover,
				.page-template-portfolio-fullscreen-slider .portfolio-categories,
				.page-template-portfolio-fullscreen-slider .portfolio-title a:hover,
				.page-template-portfolio-fullscreen-split-slider .portfolio-categories,
				.page-template-portfolio-fullscreen-split-slider .portfolio-title a:hover,
				.page-template-portfolio-fullscreen-split-slider .tm-social-network a:hover,
				.page-template-portfolio-fullscreen-carousel-slider .portfolio-categories,
				.page-template-portfolio-fullscreen-carousel-slider .portfolio-title a:hover,
				.single-portfolio .related-portfolio-wrap .post-overlay-title a,
				.single-portfolio .related-portfolio-wrap .post-overlay-categories a:hover,
				.page-content .widget-title, .page-content .widgettitle,
				.gmap-marker-title,
				.page-popup-search .search-field,
				.page-popup-search .search-field:focus,
				.page-popup-search .form-description,
				.widget_search .search-submit i, .widget_product_search .search-submit i,
				.cs-countdown .number,
				.tm-view-demo-icon .item-icon,
				.menu--primary .menu-item-feature,
				.page-template-maintenance .maintenance-title { 
					color: {$secondary_color}; 
				}";

			// Text Fill Color
			$tmp .= ".page-popup-search .search-field:-webkit-autofill { 
				-webkit-text-fill-color: {$secondary_color}; 
			}";

			// Color Important.
			$tmp .= ".secondary-color-important,
				.secondary-color-hover-important:hover{ 
					color: {$secondary_color}!important; 
				}";

			// Background Color.
			$tmp .= ".secondary-background-color,
				.page-loading .sk-child,
				.animated-dot .middle-dot,
				.animated-dot div[class*='signal'],
				.tm-contact-form-7.skin-secondary .wpcf7-submit:hover,
				.lg-progress-bar .lg-progress,
				.tm-grid-wrapper .btn-filter:hover .filter-text:after, .tm-grid-wrapper .btn-filter.current .filter-text:after, 
				.tm-blog.style-1 .post-item .post-link,
				.tm-blog.style-3 .post-item .post-link,
				.tm-blog.style-5 .post-item .post-link,
				.single-post .post-feature .post-link,
				.tm-info-boxes.style-metro .grid-item.skin-secondary,
				.tm-button.style-1.tm-button-secondary,
				.tm-button.style-2.tm-button-secondary:hover,
				.tm-timeline ul li:after,
				.tm-pricing.tm-pricing-box.style-1 .price-wrap,
				.page-template-fullscreen-split-feature .tm-social-network a span:after,
				.tm-mailchimp-form.skin-secondary button:hover, .tm-mailchimp-form.skin-secondary button:focus, .tm-mailchimp-form.skin-secondary input[type=submit]:hover, .tm-mailchimp-form.skin-secondary input[type=submit]:focus, .tm-mailchimp-form.skin-secondary input[type=reset]:hover, .tm-mailchimp-form.skin-secondary input[type=reset]:focus,
				.maintenance-progress:before,
				.go-to-single.page-template-blog-fullscreen-slider .post-overlay,
				.tm-social-networks.tm-social-networks--title .tm-social-networks__link span:after,
				.tm-view-demo .overlay,
				.mCS-arden .mCSB_scrollTools.mCSB_scrollTools_horizontal .mCSB_dragger .mCSB_dragger_bar,
				.tm-popup-video.button-style-2 .video-play{ 
					background-color: {$secondary_color}; 
				}";

			// Background Important Color.
			$tmp .= ".secondary-background-color-important,
				.secondary-background-color-hover-important:hover,
				.rev-button-outline-secondary:hover { 
					background-color: {$secondary_color}!important; 
				}";

			// Border Color.
			$tmp .= ".secondary-border-color,
				.tm-button.style-1.tm-button-default:hover,
				.tm-button.style-1.tm-button-secondary,
				.tm-button.style-2.tm-button-default,
				.tm-button.style-2.tm-button-secondary,
				.tm-button.style-3 span,
				.tm-contact-form-7.skin-secondary .wpcf7-submit:hover,
				.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover,
				.tm-accordion .accordion-section.active .accordion-title,
				.tm-accordion .accordion-section:hover .accordion-title,
				.tm-swiper.pagination-style-1 .swiper-pagination-bullet:hover, .tm-swiper.pagination-style-1 .swiper-pagination-bullet-active,
				.page-template-portfolio-fullscreen-split-slider #multiscroll-nav .active span,
				.tm-mailchimp-form.skin-secondary button:hover, .tm-mailchimp-form.skin-secondary button:focus, .tm-mailchimp-form.skin-secondary input[type=submit]:hover, .tm-mailchimp-form.skin-secondary input[type=submit]:focus, .tm-mailchimp-form.skin-secondary input[type=reset]:hover, .tm-mailchimp-form.skin-secondary input[type=reset]:focus,
				.page-links > span, .page-links > a:hover, .page-links > a:focus,
				.comment-nav-links li a:hover, .comment-nav-links li .current, .page-pagination li a:hover, .page-pagination li .current { 
					border-color: {$secondary_color}; 
				}";

			// Border Important.
			$tmp .= ".secondary-border-color-important,
				.secondary-border-color-hover-important:hover,
				#fp-nav ul li a.active span, .fp-slidesNav ul li a.active span,
				.rev-button-outline-secondary { 
					border-color: {$secondary_color}!important; 
				}";

			// Border Bottom Color.
			$tmp .= ".popup-search-opened .page-popup-search .search-field,
				.desktop-menu .menu--primary .sub-menu, .desktop-menu .menu--primary .children,
				.mini-cart .widget_shopping_cart_content,
				input[type='text'], input[type='email'], input[type='url'], input[type='password'], input[type='search'], input[type='number'], input[type='tel'], input[type='range'], input[type='date'], input[type='month'], input[type='week'], input[type='time'], input[type='datetime'], input[type='datetime-local'], input[type='color'], textarea, select, select:focus,
				.wpb-js-composer .vc_tta-style-arden-02 .vc_tta-tab.vc_active,
				.header04 .navigation .menu__container > .current-menu-item > a > .menu-item-title,
				.header04 .navigation .menu__container > li > a:hover > .menu-item-title{ 
					border-bottom-color: {$secondary_color}; 
				}";

			// Border Right Important Color.
			$tmp .= ".tm-pricing .tm-pricing-rating { 
				border-right-color: {$secondary_color}!important; 
			}";

			// Fill Color.
			$tmp .= ".tm-blockquote.skin-light path { 
				fill: {$secondary_color}; 
			}";

			if ( class_exists( 'WooCommerce' ) ) {
				// Color For Woo.
				$tmp .= ".woocommerce-Price-amount, .amount, .woocommerce div.product p.price, .woocommerce div.product span.price,
				.woocommerce.single-product div.product .single_add_to_cart_button:hover,
				.woocommerce.single-product div.product .product_meta a:hover,
				.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover,
				.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce a.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce button.button.alt:hover, .button:hover{ 
					color: {$secondary_color}; 
				}";

				// Background Color For Woo.
				$tmp .= ".woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle { 
					background-color: {$secondary_color}; 
				}";

				// Border Color For Woo.
				$tmp .= ".woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current,
				.woocommerce.single-product div.product .single_add_to_cart_button,
				.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce a.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, .button { 
					border-color: {$secondary_color}; 
				}";

				// Border Bottom Color For Woo.
				$tmp .= ".woocommerce.single-product div.product .woocommerce-tabs ul.tabs li.active,
				body.woocommerce-cart table.cart td.actions .coupon .input-text,
				.woocommerce .select2-container .select2-choice {
					border-bottom-color: {$secondary_color}; 
				}";
			}

			return $tmp;
		}
	}

	new Insight_Responsive();
}
