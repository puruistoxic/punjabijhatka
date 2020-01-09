<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(); ?>

	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<div class="mainPageTitle wooCommerceTitle">
			<div class="colorContainer">
				<div class="container">
					<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
					<div class="wooCommerceMini">
						<?php woocommerce_breadcrumb(); ?>						
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php		
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php		
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		
		do_action( 'woocommerce_sidebar' );
	?>
<?php get_footer(); ?>