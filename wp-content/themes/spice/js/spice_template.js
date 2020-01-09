jQuery(document).ready(function() {	
		"use strict";
								
										
	var $ptemplate_select = jQuery('select#page_template');	



	$ptemplate_select.live('change',function(){
		var this_value = jQuery(this).val();		
		switch ( this_value ) {
			case 'page_templates/page-cta.php':
				jQuery('#spice_cta_metabox').css('display','block');						
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');			
				jQuery('#spice_menu_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');	
				jQuery('#spice_fav_dish_metabox').css('display','none');		
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');		
				jQuery('#spice_home_review_style2_metabox').css('display','none');	
				jQuery('#spice_home_featured_style2_metabox').css('display','none');	
				jQuery('#spice_home_featured_metabox').css('display','none');	
		
				break;	

			case 'page_templates/page-contact.php':
				jQuery('#spice_contact_metabox').css('display','block');	
				jQuery('#spice_cta_metabox').css('display','none');					
				jQuery('#spice_product_page_metabox').css('display','none');			
				jQuery('#spice_menu_page_metabox').css('display','none');	
				jQuery('#spice_home_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');	
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');	
				jQuery('#spice_home_featured_metabox').css('display','none');		

				break;	

			case 'page_templates/page-products.php':
				jQuery('#spice_product_page_metabox').css('display','block');	
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');						
				jQuery('#spice_menu_page_metabox').css('display','none');	
				jQuery('#spice_home_menu_metabox').css('display','none');
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');

				break;	
				
			case 'page_templates/page-menu.php':
				jQuery('#spice_menu_page_metabox').css('display','block');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');			
				jQuery('#spice_home_event_metabox').css('display','none');				
				jQuery('#spice_home_review_metabox').css('display','none');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');	
				jQuery('#spice_home_featured_metabox').css('display','none');					
						
				break;		
			case 'page_templates/page-home-menu.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','block');	
				jQuery('#spice_home_event_metabox').css('display','none');			
				jQuery('#spice_home_review_metabox').css('display','none');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');


				break;

			case 'page_templates/page-home-list-menu.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','block');	
				jQuery('#spice_home_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_metabox').css('display','none');			
				jQuery('#spice_home_review_metabox').css('display','none');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');		
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');			

				break;

			case 'page_templates/page-home-events.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','block');
				jQuery('#spice_home_review_metabox').css('display','none');					
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');	
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');				
						
				break;	

			case 'page_templates/page-home-events-style2.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');	
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','block');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');				
						
				break;

			case 'page_templates/page-store-review.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','block');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');		
				jQuery('#spice_event_page_metabox').css('display','none');	
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');	
				jQuery('#spice_home_featured_metabox').css('display','none');		
						
				break;	

			case 'page_templates/page-product-review.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','block');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');		
				jQuery('#spice_event_page_metabox').css('display','none');	
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');			
						
				break;	




			case 'page_templates/page-home-featured.php':

				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');		
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','block');
						
				break;	



			case 'page_templates/page-home-featured-style2.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');		
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','block');
				jQuery('#spice_home_featured_metabox').css('display','none');
						
				break;	


			case 'page_templates/page-meet-chef.php':
			case 'page_templates/page-meet-chef-style2.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','block');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');
						
				break;	

			case 'page_templates/page-home-contact.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','block');	
				jQuery('#spice_home_booking_metabox').css('display','none');	
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');		
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');			
						
				break;

			case 'page_templates/page-book-table.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','block');	
				jQuery('#spice_fav_dish_metabox').css('display','none');	
				jQuery('#spice_about_metabox').css('display','none');	
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');					
						
				break;	

			case 'page_templates/page-favourite-dish.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');		
				jQuery('#spice_fav_dish_metabox').css('display','block');
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');
										
						
				break;

			case 'page_templates/page-about.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');		
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','block');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');
										
						
				break;		

			case 'page_templates/page-events.php':
				jQuery('#spice_menu_page_metabox').css('display','none');		
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');
				jQuery('#spice_home_menu_metabox').css('display','none');		
				jQuery('#spice_home_event_metabox').css('display','none');
				jQuery('#spice_home_review_metabox').css('display','none');	
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');	
				jQuery('#spice_home_booking_metabox').css('display','none');		
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','block');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');
										
						
				break;	


			default:	
				jQuery('#spice_cta_metabox').css('display','none');	
				jQuery('#spice_contact_metabox').css('display','none');
				jQuery('#spice_product_page_metabox').css('display','none');			
				jQuery('#spice_menu_page_metabox').css('display','none');	
				jQuery('#spice_home_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_metabox').css('display','none');		
				jQuery('#spice_home_review_metabox').css('display','none');
				jQuery('#spice_home_contact_metabox').css('display','none');		
				jQuery('#spice_home_booking_metabox').css('display','none');
				jQuery('#spice_fav_dish_metabox').css('display','none');
				jQuery('#spice_about_metabox').css('display','none');
				jQuery('#spice_event_page_metabox').css('display','none');
				jQuery('#spice_home_chefs_metabox').css('display','none');
				jQuery('#spice_home_list_menu_metabox').css('display','none');	
				jQuery('#spice_home_event_style2_metabox').css('display','none');	
				jQuery('#spice_home_review_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_style2_metabox').css('display','none');
				jQuery('#spice_home_featured_metabox').css('display','none');
				
									
		}	
	});
	
	$ptemplate_select.trigger('change');
	
	
 displayMetaboxes();
            	    // Show/hide metaboxes on change event
    jQuery("input[name='post_format']").change(function() {
       displayMetaboxes();
        
    });
});
// alert('hi');
function displayMetaboxes() 
{
                // Hide all post format metaboxes
                //jQuery(ids).hide();
                // Get current post format
                var selectedElt = jQuery("input[name='post_format']:checked").attr("id"); 				
                switch(selectedElt)
                {
                	case 'post-format-audio':
                							jQuery('#spice_video_post_format_metabox').css('display','none');
                							jQuery('#spice_gallery_post_format_metabox').css('display','none');
                							break;

                	case 'post-format-gallery':
                							jQuery('#spice_video_post_format_metabox').css('display','none');
                							jQuery('#spice_gallery_post_format_metabox').css('display','block');
                							break;                	
                						

                	case 'post-format-video':
                		
                							jQuery('#spice_video_post_format_metabox').css('display','block');
                							jQuery('#spice_gallery_post_format_metabox').css('display','none');
                							break;

                	case 'post-format-0':
                	default :

		           							jQuery('#spice_gallery_post_format_metabox').css('display','none');
		           							jQuery('#spice_video_post_format_metabox').css('display','none');
                							break;
                }
}
 
