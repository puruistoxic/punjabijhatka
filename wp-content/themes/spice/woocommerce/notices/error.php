<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<div class="alert alert-danger col-xs-12" id="cupponalert">
	
	<?php foreach ( $messages as $message ) : ?>
		<p class="pull-left"><?php echo wp_kses_post( $message ); ?></p>
	<?php endforeach; ?>	
	<a href="javascript:void(0);" class="close" data-dismiss="alert" aria-label="close">&times;</a>

</div>

