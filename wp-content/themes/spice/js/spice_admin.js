jQuery(document).ready(function() {	
		"use strict";
		

		jQuery('.title-align input[type="radio"]').each(function()
		{
			if(jQuery(this).prop('checked'))
			{
				jQuery(this).parents('li').find('i.fa').addClass('selected');
			}
		});
		jQuery('.title-align label i.fa').on('click',function(){
				jQuery('.title-align label i.fa').removeClass('selected');
				jQuery(this).addClass('selected');
		});
		if(jQuery('#spice_contact_google_map').prop('checked')==true)
		{
			jQuery('.contact-map-class').addClass('show-map-settings');
		}
		jQuery('#spice_contact_google_map').on('click',function(){
				
				jQuery('.contact-map-class').toggleClass('show-map-settings');
		});
		// if(jQuery('#spice_cta_section_order_cta').prop("checked")==true)
		// {
		// 	jQuery('#home-featured-order-cta-holder').removeClass('home-featured-order-cta');	
		// }

		// jQuery('#spice_cta_section_order_cta').on('click',function(){			
		// 		jQuery('#home-featured-order-cta-holder').toggleClass('home-featured-order-cta');			
		// });

		jQuery('#spice_home_featured_style2_order_cta').on('click',function(){			
				jQuery('#home-featured-style2-order-cta-holder').toggleClass('home-featured-order-cta');			
		});
		jQuery('input[name="spice_page_bg_video"]').each(function()
		{
			if(jQuery(this).prop('checked'))
			{
				if(jQuery(this).val()==1)
				{
					jQuery('.upload_video').css('display','none');
					jQuery('.embed_video').css('display','block');					
				}
				else
				{
					jQuery('.upload_video').css('display','block');
					jQuery('.embed_video').css('display','none');
				}
			}
		});

		jQuery("input[name='spice_page_bg_video']" ).on('click',function()
		{

				if(jQuery(this).val()==1)
				{
					jQuery('.upload_video').css('display','none');
					jQuery('.embed_video').css('display','block');					
				}
				else
				{
					jQuery('.upload_video').css('display','block');
					jQuery('.embed_video').css('display','none');
				}
		});
		jQuery('.col-4-shop').on('click',function(){		
			
			jQuery('#opt-shop-layout_3').closest('label').removeClass('redux-image-select-selected');	
			jQuery('#opt-shop-layout_2').closest('label').removeClass('redux-image-select-selected');			
			jQuery('#opt-shop-layout_1').attr('checked','checked').closest('label').addClass('redux-image-select-selected');
			
		});
		jQuery('#opt-shop-layout_3, #opt-shop-layout_2').on('click',function(){

			jQuery('#opt-grid-number_3').closest('label').removeClass('redux-image-select-selected');			
			if(!jQuery('#opt-grid-number_2').attr('checked'))
			{			
				jQuery('#opt-grid-number_1').attr('checked','checked').closest('label').addClass('redux-image-select-selected');	
			}
		});	
		
		jQuery('input[name="spice_page_bg_style"]').each(function()
		{
			if(jQuery(this).prop('checked'))
			{
				if(jQuery(this).val()==3)
				{
					jQuery('.bg_parallax').css('display','block');				
				}
				else
				{
					jQuery('.bg_parallax').css('display','none');
				}
			}
		});	
		jQuery("input[name='spice_page_bg_style']" ).on('click',function()
		{
			
				if(jQuery(this).val()==3)
				{					
					jQuery('.bg_parallax').css('display','block');					
				}
				else
				{					
					jQuery('.bg_parallax').css('display','none');
				}
		});
	
});