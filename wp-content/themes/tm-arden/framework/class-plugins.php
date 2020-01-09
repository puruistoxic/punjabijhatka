<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin installation and activati on for WordPress themes
 */
if ( ! class_exists( 'Insight_Register_Plugins' ) ) {
	class Insight_Register_Plugins {

		public function __construct() {
			add_filter( 'insight_core_tgm_plugins', array( $this, 'register_required_plugins' ) );
		}

		public function register_required_plugins() {
			/*
			 * Array of plugin arrays. Required keys are name and slug.
			 * If the source is NOT from the .org repo, then source is also required.
			 */
			$plugins = array(
				array(
					'name'     => esc_html__( 'Insight Core', 'tm-arden' ),
					'slug'     => 'insight-core',
					'source'   => 'https://www.dropbox.com/s/ikond8upcye0exe/insight-core-1.5.4.5.zip?dl=1',
					'version'  => '1.5.4.5',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'Revolution Slider', 'tm-arden' ),
					'slug'     => 'revslider',
					'source'   => 'https://www.dropbox.com/s/1cqsrhnbymc5eac/revslider-5.4.8.zip?dl=1',
					'version'  => '5.4.8',
					'required' => true,
				),
				array(
					'name'     => esc_html__( 'WPBakery Page Builder', 'tm-arden' ),
					'slug'     => 'js_composer',
					'source'   => 'https://www.dropbox.com/s/wlpim2jpocyvf4h/js_composer-5.6.zip?dl=1',
					'version'  => '5.6',
					'required' => true,
				),
				array(
					'name'    => esc_html__( 'WPBakery Page Builder (Visual Composer) Clipboard', 'tm-arden' ),
					'slug'    => 'vc_clipboard',
					'source'  => 'https://www.dropbox.com/s/kixfch51gkna4j3/vc_clipboard-4.5.0.zip?dl=1',
					'version' => '4.5.0',
				),
				array(
					'name'    => esc_html__( 'Essential Grid Gallery WordPress Plugin', 'tm-arden' ),
					'slug'    => 'essential-grid',
					'source'  => 'https://www.dropbox.com/s/5nfqaxj85vvva95/essential-grid-2.3.zip?dl=1',
					'version' => '2.3',
				),
				array(
					'name' => esc_html__( 'Contact Form 7', 'tm-arden' ),
					'slug' => 'contact-form-7',
				),
				array(
					'name' => esc_html__( 'MailChimp for WordPress', 'tm-arden' ),
					'slug' => 'mailchimp-for-wp',
				),
				array(
					'name' => esc_html__( 'WooCommerce', 'tm-arden' ),
					'slug' => 'woocommerce',
				),
				array(
					'name' => esc_html__( 'WP-PostViews', 'tm-arden' ),
					'slug' => 'wp-postviews',
				),
			);

			return $plugins;
		}

	}

	new Insight_Register_Plugins();
}
