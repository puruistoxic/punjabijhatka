$(document).ready(function(){

/*----------------------------------------------------*/
	/*	RECIPE SECTION CAROUSEL
	/*----------------------------------------------------*/

	//Defining base variables for Home page
	var documentSize = $(document).width(),
		slider = [],
		isSliderActive = 0,
		breakpoints = {
			0:480,
			1:768
		},
		sliderClass = {	
			0:$(".bxslider"),
			1:$(".bxslider1"),
			2:$(".bxslider2")
		},
		sliderOption = {
				minSlides: 1,
		  	maxSlides: 3,
		  	slideWidth: 220,
		};

	// Checking if menu page, and updating variable.
	if($('.menu-page').length){
		breakpoints = {
			0:768,
			1:992
		},
		sliderClass = {	
			0:$(".brkfstSlider"),
			1:$(".lnchSlider"),
			2:$(".dnnrSlider"),
			3:$(".drnkSlider")
		},
		sliderOption.slideWidth = 390;
	}

	// Getting slider options on acc. to breakpoints
	function bxSliderOptions(documentSize){
		if(!isNaN(breakpoints[0]) && documentSize<breakpoints[0])
			sliderOption.minSlides = sliderOption.maxSlides = 1;
		else if(!isNaN(breakpoints[1]) && documentSize<breakpoints[1])
			sliderOption.minSlides = sliderOption.maxSlides = 2;
		else
			sliderOption.minSlides = sliderOption.maxSlides = 3;
		return sliderOption;
	}
	

	documentSize = $(document).width();

	//Initializing Slider only if on a desktop
	if(documentSize > 991)
		$.each(sliderClass,function(i)
		{
			slider[i]= $(this).bxSlider(bxSliderOptions(documentSize));
			isSliderActive = 1;
		});

	    
	$(window).resize(function()
	{
		documentSize = $(document).width();
	    if(documentSize > 991 ){
	    	if(isSliderActive){
		    	$.each(slider,function(i){
			      // Reloading slider with new options
						slider[i].reloadSlider(bxSliderOptions(documentSize));
					});
		    }
		   	else{
					$.each(sliderClass,function(i)
						{
							slider[i]= $(this).bxSlider(bxSliderOptions(documentSize));
							isSliderActive = 1;
						});
				}
			}
			else{
				if(isSliderActive){
					$.each(slider,function(i){
				    // destroying sliders
						slider[i].destroySlider();
					});
					isSliderActive = 0;
				}
			}
	});
	
	
	$(".direction-btns .prev-btn").bind("click", (function () {
 		$(this).closest(".food-menus").find(".bx-controls-direction .bx-prev").trigger("click");
	 	return false; //prevent default click action from happening (page scroll to top)
	}));

	$(".direction-btns .next-btn").bind("click", (function () {
 		$(this).closest(".food-menus").find(".bx-controls-direction .bx-next").trigger("click");
	 	return false; //prevent default click action from happening (page scroll to top)
	}));


});