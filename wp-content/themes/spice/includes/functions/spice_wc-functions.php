<?php
function spice_shop_hooks() {
	

	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_rating', 25 );
		
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 );	
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	add_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display', 15 );
	
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
	
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );	
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6 );
	
	
}//end of function
add_action( 'init', 'spice_shop_hooks' );

function spice_browse_wishlist_label() 
{	
	return '<i class="fa fa-heart in_wishlist"></i>';	
}
add_filter( 'yith-wcwl-browse-wishlist-label', 'spice_browse_wishlist_label' );

function spice_add_wishlist_label() 
{		
	return '<i class="fa fa-heart-o"></i>';	
}
add_filter( 'yith_wcwl_button_label', 'spice_add_wishlist_label' );

function spice_wc_out_of_stock_flash() 
{
	wc_get_template( 'loop/outofstock-flash.php' );
}
add_action( 'woocommerce_before_shop_loop_item_title', 'spice_wc_out_of_stock_flash' );

function spice_woocommerce_thumbnailGallery_size( $size ) 
{
	return array(
		'width'	 => '70',
		'height' => '70',
		'crop'	 => 1
		);
}

function spice_woocommerce_product_categories($product_page_categories)
{
	$args = array( 'taxonomy' => 'product_cat','include'=> $product_page_categories );
	$terms = get_terms('product_cat', $args);
	$str='<ul class="food-type-list clearfix" id="food-type-list">';
	if (count($terms) > 0) 
	{	 
		$str.='<li><a href="#food-type-list" class="selected" data-filter="*">All</a></li>';   
		foreach ($terms as $term) 
		{	       
			$str.='<li><a href="#food-type-list" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';	        
		}	 
	}
	$str.='</ul>';
	return $str;
}//end of function
function spice_get_woocommerce_cats($product_page_categories)
{
	$taxonomies='product_cat';		
	$args = array('include'=> $product_page_categories); 
	$terms = get_terms('product_cat', $args);
	if (count($terms) > 0) 
	{	
		foreach ($terms as $term) 
		{		    	      
			$cat_arr[$term->term_id]['name']= $term->name;
			$cat_arr[$term->term_id]['slug']= $term->slug;
		}	 
	}
	return $cat_arr;

}//end of function


if ( ! function_exists( 'spice_button_proceed_to_checkout' ) ) 
{

	function spice_button_proceed_to_checkout() {
		$checkout_url = WC()->cart->get_checkout_url();

		?>
		<div class="pad-top-small clearfix">
			<a href="<?php echo esc_url($checkout_url); ?>" class="button red-btn btn-block"><?php esc_html_e( 'Proceed to Checkout', 'SPICE' ); ?></a>
		</div>
		
		<?php
	}
}
add_filter( 'woocommerce_checkout_fields' , 'spice_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function spice_override_checkout_fields( $fields ) {
     $fields['account']['account_username']=array( 
    'label'     => esc_html__('Account Username', 'SPICE'),
    'placeholder'   => _x('Username', 'placeholder', 'SPICE'),
    'required'  => true,
    'class'     => array('form-row-wide'),
    'clear'     => true
    
    );
    $v=$fields['account']['account_password'];
    unset($fields['account']['account_password']);
     
    $fields['account']['account_password']=$v;
    $fields['account']['confirm_account_password']=array( 
    'label'     => esc_html__('Confirm Password', 'SPICE'),
    'placeholder'   => _x('Confirm Password', 'placeholder', 'SPICE'),
    'required'  => true,
    'class'     => array('form-row-wide'),
    'clear'     => true
    
    );

    return $fields;
}//end of function
add_filter( 'woocommerce_breadcrumb_defaults', 'spice_breadcrumb_home_text' );
function spice_breadcrumb_home_text( $defaults ) 
{
    // Change the breadcrumb home text from 'Home' to 'Appartment'
	$defaults['home'] = '<i class="fa fa-home"></i> ';
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'spice_breadcrumb_delimiter' );
function spice_breadcrumb_delimiter( $defaults ) 
{
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '&nbsp; &gt; &nbsp;';
	return $defaults;
}