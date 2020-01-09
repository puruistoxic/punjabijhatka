<?php 
    
    get_header(); 
    if(is_page())
	{				
        spice_home_page_blocks();               
	}		
	if(is_home())
	{             
  		get_template_part('includes/partials/content','loop');  
    }
    get_footer(); 

?>