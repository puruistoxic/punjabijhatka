(function($){

/*----------------------------------------------------*/
	/*	RECIPE SECTION CAROUSEL
	/*----------------------------------------------------*/

	//Defining base variables for Home page
	var documentSize = $(document).width(),
		slider = [],
		// isSliderActive = 0,
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
	

	//Initializing Slider
	$.each(sliderClass,function(i){
		var _this = $(this);
		if(_this.length === 1){
			//console.log(slider.length);
			slider[slider.length]= _this.bxSlider(bxSliderOptions(documentSize));
		}else if(_this.length > 1){
			_this.each(function(i){
				var _anotherThis = $(this);
			//	console.log(slider.length);
				slider[slider.length]= _anotherThis.bxSlider(bxSliderOptions(documentSize));
			});
		}
	});
	

	//Timeout on resize (Responsiveness)
	$(window).bind('resize', function(e)	
	{
		 window.resizeEvt;
	    $(window).resize(function()
	    {
	        clearTimeout(window.resizeEvt);
	        window.resizeEvt = setTimeout(function()
	        {
	        	documentSize = $(document).width();
	        	$.each(slider,function(i){
	        		// Reloading slider with new options	        		
							slider[i].reloadSlider(bxSliderOptions(documentSize));
						});
	        }, 250);
	    });
	
	});
	
	
	$(".direction-btns .prev-btn").bind("click", (function () {
 		$(this).closest(".food-menus").find(".bx-controls-direction .bx-prev").trigger("click");
	 	return false; //prevent default click action from happening (page scroll to top)
	}));

	$(".direction-btns .next-btn").bind("click", (function () {
 		$(this).closest(".food-menus").find(".bx-controls-direction .bx-next").trigger("click");
	 	return false; //prevent default click action from happening (page scroll to top)
	}));


})(jQuery);