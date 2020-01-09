<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue child scripts
 */
if ( ! function_exists( 'tm_arden_child_enqueue_scripts' ) ) {
	function tm_arden_child_enqueue_scripts() {
		wp_enqueue_style( 'insight-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
		wp_enqueue_style( 'insight-child-style', get_stylesheet_directory_uri() . '/style.css', array( 'insight-style' ), wp_get_theme()->get( 'Version' ) );
	}
}
add_action( 'wp_enqueue_scripts', 'tm_arden_child_enqueue_scripts' );
