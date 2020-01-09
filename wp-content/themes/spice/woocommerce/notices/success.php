<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="alert alert-info col-xs-12 clearfix">
	<a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  <strong><?php echo wp_kses_post( $message ); ?></strong>
	</div>

<?php endforeach; ?>
