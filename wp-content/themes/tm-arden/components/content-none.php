<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Arden
 * @since   1.0
 */

?>

<section class="no-results not-found">
	<h3 class="page-title"><?php esc_html_e( 'Nothing Found', 'tm-arden' ); ?></h3>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'tm-arden' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php } elseif ( is_search() ) { ?>
			<p class="search-no-results-text"><?php echo esc_html( Insight::setting( 'search_page_no_results_text' ) ); ?></p>
			<?php get_search_form(); ?>
		<?php } else { ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'tm-arden' ); ?></p>
			<?php get_search_form(); ?>
		<?php } ?>
	</div>
</section>
