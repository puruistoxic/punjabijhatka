<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

?>
<div class="postImage images">

	<?php
		$image ='';
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			 $image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			 	'title' => $image_title
			 	) );
			//$image = get_the_post_thumbnail( $post->ID, 'spice-woocommerce-single-thumb-big', array('title' => $image_title	) );
			
			$attachment_count   = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) 
			{
				$gallery = '[product-gallery]';				

			} else 
			{
				$gallery = '';
			}
			printf(__('%s','SPICE'),  $image);
		} else 
		{
			printf(__('%s','SPICE'), $image);			

		}
	?>

</div>

<?php do_action( 'woocommerce_product_thumbnails' ); ?>
