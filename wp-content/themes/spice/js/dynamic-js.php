<script id="dynamic-script">
jQuery(document).ready(function($) 
{		
	<?php
	   $ajax_url=admin_url( 'admin-ajax.php' );
	   $page_blocks = get_pages();
       $templates = wp_get_theme()->get_page_templates();		
       $templates['page.php'] = 'Default Template';	
	   $i=1;
	   foreach ($page_blocks as $page) 
	   {
			$index=$page->ID;	
			$template ='';						
			if (get_page_template_slug($index) !== '') 
			{
				$template = get_page_template_slug($index);					
			}
            if (('publish' == get_post_status($index))) 
			{	
				
				if (array_key_exists($template, $templates)) 
				{
					$active_template = explode(".", $template);							
					$tem_name=explode("/",$active_template[0]);							
					if(isset($tem_name[1]))
					{
				    	$templ_name=$tem_name[1];
					}					
					if($templ_name=='page-contact') //only for contact
					{
						$contact_google_map=get_post_meta($index,'spice_contact_google_map',true)!=''?get_post_meta($index,'spice_contact_google_map',true):'';
						if($contact_google_map=="on")
						{
							$contact_google_map_color=get_post_meta($index,'spice_contact_google_map_color',true);
							$contact_google_marker=get_post_meta($index,'spice_contact_google_marker',true)!=''?get_post_meta($index,'spice_contact_google_marker',true):'';
							$contact_google_latlong="-34.397, 150.644";
	?>	
								if($('#contact-map-section').length != 0)
								{
										var contact_map;
										function initializeContact() 
										{

											var mapOptions = {
												zoom: 8,
												scrollwheel: false,
											 	center: new google.maps.LatLng(<?php echo esc_js($contact_google_latlong); ?>),
											 	styles: [
											 				{"stylers": [{ "hue": "<?php echo esc_js($contact_google_map_color); ?>" },{ saturation: 10 }]},
									    					{
														      "featureType": "road",
														      "elementType": "labels",
														      "stylers": [{"visibility": "off"}]
														    },
														    {
														      "featureType": "road",
														      "elementType": "geometry",
														      "stylers": [{"lightness": 100},
														            {"visibility": "simplified"}]
														    }
											 	]
											};
											contact_map = new google.maps.Map(document.getElementById('contact-map-section'), mapOptions);
											
											<?php	
													if(!empty($contact_google_marker))
													{

											?>
													var image = "<?php echo esc_js($contact_google_marker); ?>";
											<?php 
													} 
											?>
											var myLatLng = new google.maps.LatLng(<?php echo esc_js($contact_google_latlong); ?>);
											var beachMarker = new google.maps.Marker({
												position: myLatLng,
												map: contact_map,
												<?php	if(!empty($contact_google_marker)){	?>
															icon: image
												<?php } ?>
											 });
											
										}

										google.maps.event.addDomListener(window, 'load', initializeContact);
								}
	<?php
						}
					}

					if($templ_name=='page-menu')
					{
						if (class_exists( 'woocommerce' ) ) 
						{
								$menu_product_categories=get_post_meta($index,'spice_menu_page_product_cetegories',true);
		    					$menu_list=spice_get_woocommerce_cats($menu_product_categories);				
	?>
								if( $(".menu-page").length > 0 ) 
								{
									<?php
										$block='';
										$slider='';
										foreach($menu_list as $k=>$menu)
		                 				{
		                 					$page='.page-'.$index;
		                 					$block=".block-".$menu['slug'];
		                 					$slider=".slider-".$menu['slug'];
									?>

									 	$('.search-menu-list<?php echo esc_js($block); ?>').waypoint(function() 
										{
									 	setTimeout(function(){$('<?php echo esc_js($slider); ?> li').not('bx-clone').addClass('animated fadeInUp')},100);
										 }, { offset: '60%' });	
									<?php
										}
									?>
								}
	<?php				
						}	
					}

					if($templ_name=='page-book-table' || $templ_name=='page-reservation' )
					{
	?>
						if($('.book-table').length || $('.page-reserv').length ) 
						{						
						
							$('#occasion_date_time_<?php echo esc_js($index); ?>').datetimepicker({
													// datepicker:false,
										  			 	format:'Y-m-d H:i:s',
										  			 	minDate:new Date()

							});						
							
							$("#book-table-<?php echo esc_js($index); ?>").validate({ 
								 	rules:{ 
								 				<?php echo esc_js("customer_name_$index"); ?>:{required: true},
								 				<?php echo esc_js("customer_phone_$index"); ?>:{required: true},
								 				<?php echo esc_js("customer_email_$index"); ?>:{required: true,email:true},
								 				<?php echo esc_js("personNo_$index"); ?>:{required: true,number:true},
								 				<?php echo esc_js("occasion_date_time_$index"); ?>:{required:true,date:true}		 		
								 		  },		 		
							});

							$('#book_home_table-<?php echo esc_js($index); ?>').on('click',function(){

								if($("#book-table-<?php echo esc_js($index); ?>").valid())
								{
									//console.log("<?php echo esc_js($ajax_url); ?>");
									var ajaxurl="<?php echo esc_js($ajax_url); ?>";								
									$('.book_spinner_wrapper').show();
									var data={action:"bookingTable",formdata:$("#book-table-<?php echo esc_js($index); ?>").serialize(),id:"<?php echo esc_js($index); ?>"};								
									$.post(spicesettings.ajaxurl,data,function(res)
									{				
										
										$('.book_spinner_wrapper').html(res);
										$("#book-table-<?php echo esc_js($index); ?>").get(0).reset();				
									});	
								}	

							});
						}
	<?php
					}//book table
				}
			}
		}		

		if(spice_get_option('opt-sticky-header')==1)
		{

	?>

	function stickyHeader()
	{

		if ($(window).width() > 992){

			if(($('header.new-type1').length) || ($('header.new-type3').length)){
				var upheight = $('header .upper-part').outerHeight();
				var lowheight = $('header .lower-part').outerHeight();
				$(window).on('scroll', function(){
					if($(window).scrollTop() > upheight ) {
						$('header .lower-part').addClass('is-fixed');
						$('header .upper-part').css('margin-bottom', lowheight);
					}
					else {
						$('header .lower-part').removeClass('is-fixed');
						$('header .upper-part').css('margin-bottom', 0);
					}
				});
			}

			if($('header.new-type2').length){
				var lowheight = $('header .lower-part').outerHeight();
				$(window).on('scroll', function(){
					if($(window).scrollTop() > 1 ) {
						$('header.new-type2').addClass('is-fixed');
						$('header.new-type2.is-fixed').css('height', lowheight);
					}
					else {
						$('header.new-type2').removeClass('is-fixed');
						$('header.new-type2').css('height', 'auto');
					}
				});
			}

			// ORIGINAL DEFAULT HEADER
			if($('header.default').length){
				var lowheight = $('header.default').outerHeight();
				$(window).on('scroll', function(){
					if($(window).scrollTop() > 10 ) {
						$('header.default').addClass('is-fixed')
										.css('height', lowheight);
					}
					else {
						$('header.default').removeClass('is-fixed')
										.css('height', 'auto');
					}
				});
			}
		}/* =========== FIXED HEADER ends =================================== */
	}
	/* =========== FIXED HEADER [ALL] =================================== */
	stickyHeader();
	$(window).resize(function(){
		stickyHeader();		
	});

	<?php

		}//sticky header option
	?>
});

<?php
		//echo spice_get_option('google-map-checkbox');die();
		if(spice_get_option('google-map-checkbox'))
		{
			$google_map_color=spice_get_option('google-map-color');
			$google_map_latlong=spice_get_option('google-map-latlong');
			$google_map_marker=spice_get_option('google-map-marker',true);
			$main_shop_title=spice_get_option('main-shop-title',true);
			$main_shop_infowindow=spice_get_option('main-shop-infowindow',true);
?>
function initMap() 
{

	var mapOptions = {
						zoom: 8,
						scrollwheel: false,
					 	center: new google.maps.LatLng(<?php echo esc_js($google_map_latlong); ?>),
					 	styles: [
					 				{"stylers": [{ "hue": "<?php echo esc_js($google_map_color); ?>" }]},
								{
							      "featureType": "road",
							      "elementType": "labels",
							      "stylers": [{"visibility": "off"}]
							    },
							    {
							      "featureType": "road",
							      "elementType": "geometry",
							      "stylers": [{"lightness": 100},
							            {"visibility": "simplified"}]
							    }
					 	]
					};

  var map = new google.maps.Map(document.getElementById('map-canvas-new'), mapOptions);
  var image = '<?php echo esc_js($google_map_marker['url']); ?>'; 
  <?php 

  			$ltlng=explode(',',$google_map_latlong);  

  			if(!empty($ltlng[0]))
  			{
    ?>
    var mainshop=[['0','<?php echo esc_js($ltlng[0]); ?>','<?php echo esc_js($ltlng[1]); ?>','<?php echo esc_js($main_shop_title); ?>','<?php echo esc_js($main_shop_infowindow); ?>']];    
    <?php

  			}
  			else
  			{

	?>
	var mainshop=[['0','-34.397','150.644','Main Shop','Set Main Shop Latitude and Longitude from Options']];    
	<?php  				
  			}
  ?>


   		
    
    	var location=mainshop.concat([<?php echo spice_all_location(); ?>]);   	

    	//console.log(location);
     	for (i = 0; i < location.length; i++) 
     	{ 
     	   
	       marker = new google.maps.Marker({
	         position: new google.maps.LatLng(location[i][1],location[i][2]),
	         map: map,
	         icon: image,
	         title:location[i][3]
	       });

	       google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {
	          infowindow.setContent(location[i][4]);
	          infowindow.open(map, marker);
	        }
	      })(marker, i));
	    }


  var input =(document.getElementById('pac-input'));
  var input_pin =(document.getElementById('mapPin'));

  var types = document.getElementById('type-selector');  

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    infowindow.close();
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(17);  // Why 17? Because it looks good.
    }   
    var address = '';
    if (place.address_components) {
      address = [
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[1] && place.address_components[1].short_name || ''),
        (place.address_components[2] && place.address_components[2].short_name || '')
      ].join(' ');
    }   
  });
  
}

<?php

	}
	else
	{
?>
		function initMap() 
		{
			//return nothing
		}
<?php		
	}
?>


</script>