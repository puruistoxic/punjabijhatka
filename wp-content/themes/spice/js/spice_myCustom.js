(function($){

	var SITE_CURRENCY="$";


  $(window).resize(function() {
		headerSubClick();
		if ($(window).width() >= 768) { wayPoint(); }
		ingredientCarousel();
		menuItemCarousel();
		mobileNavHidden();
	});


  /*------------- Nav menu hidden at first [in mobile] -----------------*/
  mobileNavHidden();
  function mobileNavHidden(){
  	if ($(window).width() < 975){
  		$('.navbar-nav').css('overflow','hidden');
  	}
  }


  /*----------- Cart page alert close --------------*/
  $('.alert-info .close').on('click', function(){  	
  	$(this).closest('.alert-info').addClass('closed')
  		.delay(500)
  		.queue(function(next){
  			$(this).css('display','none');
  		});
  });


	/*----------------------------------------------------*/
	/*	Shop single product page
	/*----------------------------------------------------*/
	// Click related images to change main product image
	$('.product-img .postRelatedImages .singleThumbnail').on('click', function(){
		var fullImgSrc = $(this).data('full');
		$('.postImage img').attr('src', fullImgSrc);
		// Scroll to main product image
		if ($(window).width() < 975){
			goToByScroll('single-product');
		}
	});

	function goToByScroll(id){
    // Remove "link" from the ID
    id = id.replace("link", "");
    // Scroll
    $('html,body').animate({
      scrollTop: $("#"+id).offset().top},
      'slow');
  }





	/*----------------------------------------------------*/
	/*	SLIDESHOW [ABOUT-US PAGE]
	/*----------------------------------------------------*/
	if($("#slideshow").length > 0){
		$("#slideshow > li:gt(0)").hide();
		setInterval(function() { 
		  $('#slideshow > li:first')
		    .fadeOut(1000)
		    .next()
		    .fadeIn(1000)
		    .end()
		    .appendTo('#slideshow');
		},  3000);
	}
	

	
	'use strict';
	/*----------------------------------------------------*/
	/*	MOBILE SHARE BUTTONS APPEAR ON CLICK
	/*----------------------------------------------------*/
	$('a.mobile-social-btn').on("click",function () {
		$("ul.social-btns").toggleClass("share");
		return false; //prevent default click action from happening (page scroll to top)
	});

	/*----------------------------------------------------*/
	/*	Parallax Background  
	/*----------------------------------------------------*/	
		$(window).stellar();			


	/*----------------------------------------------------*/
	/*	DINING SPACE SELECTION
	/*----------------------------------------------------*/
	$('.type-wrapper').on('click', function(){
		$(this).closest('.dining-space').find('.type-wrapper').removeClass("is-active");
		$(this).closest('.dining-space').find('.type-wrapper input').prop('checked', false);
		$(this).find('input').prop('checked', true);
		$(this).toggleClass("is-active");
	});



	/*----------------------------------------------------*/
	/*	MOBILE MENU OVERFLOW DISPLAY FOR 2NDARY MENU
	/*----------------------------------------------------*/
	$(".navbar-nav").on('hover', function(){
    	$(this).css('overflow','visible');
	});
	$(".navbar-nav").on('mouseleave', function(){
    	$(this).css('overflow','hidden');
	});

	// $(".navbar-nav > li").on('hover', function(){
	// 	$(this).parent().css('overflow','visible');
	// });

	/* Nav menu overflow visibility */
	$(".navbar-nav > li > .sub-menu").on('mouseenter', function(){
		$(this).css('overflow','visible');
	}).on('mouseleave', function(){
		$(this).css('overflow','hidden');
		// console.log('check');
	});
	
	/* nav menu 2nd level */
	$(".navbar-nav > li > .sub-menu li").on('mouseenter', function(){
		$(this).find('> ul').css('opacity','1').css('z-index', '99');
	}).on('mouseleave', function(){
		$(this).find('> ul').css('opacity','0').css('z-index', '9');
	});



  /*----------------------------------------------------*/
	/*	HEADER SUB-MENU CLICK-TO-SHOW IN TAB + MOBILE
	/*----------------------------------------------------*/
	headerSubClick();
  function headerSubClick(){
    // if ($(window).width() < 992){
  		$("#navigation-list .navbar-nav > li").on('mouseenter', function(){
  			// $(this).closest(".navbar-nav").css('overflow','visible');
  			$(this).find(".sub-menu").css("max-height",750);
  		});
  		$("ul.navbar-nav > li").on('mouseleave', function(){
  			$("#navigation-list .navbar-nav > li > .sub-menu").css("max-height",0);
  		});
  		$(".navbar-nav").on('mouseleave', function(){
  			$(this).css('overflow','visible');
  		});
    // }
  }



	/*----------------------------------------------------*/
	/*	TAB NAV MENU CLICK
	/*----------------------------------------------------*/
	$('#nav-toggle').click(function () {
		$(".navbar-nav").toggleClass("show-menu").css("overflow","hidden");
	});




	/*----------------------------------------------------*/
	/*	MENU PAGE FOOD-ITEMS CLICK SELECT
	/*----------------------------------------------------*/
  var selectedDishes=0;
  var dish=new Array();
	$(".selected-dishes-no").html(selectedDishes);



	/*------------- PRODUCT VIEW CHANGE STARTS --------------------*/

	
	if(spicesettings.page_template=="shop")
	{
		if($.cookie('product_view')){	
			$('.shop-page ul.products').addClass($.cookie('product_view'));
		}
		else{
			$('.shop-page ul.products').addClass('grid');
		}
		$('.woocommerce-product-view span.view_list').on('click',function(){
			$.cookie('product_view', 'list', { expires: 7, path: '/' });
			$('.shop-page ul.products').removeClass('grid');
			$('.shop-page ul.products').addClass('list');
		});
		$('.woocommerce-product-view span.view_grid').on('click',function(){ 
			$.cookie('product_view', 'grid', { expires: 7, path: '/' });
			$('.shop-page ul.products').removeClass('list');
			$('.shop-page ul.products').addClass('grid');
		});
	  }

	$(document).delegate(".sel", "change", function(){
			var v=parseFloat($(this).parent('.order-item-price').find('.hid').val());			
			var val=parseFloat($(this).val())*v;	
			$(this).parent('.order-item-price').find('.tot').attr('value',val);
			$(this).parent('.order-item-price').find('.item-total').html(SITE_CURRENCY+val);
			calculateTotal();
	});

	function calculateTotal(){		
		total_amount=0.0;		
		$( ".tot" ).each(function( index ) {
			total_amount+=Number.parseFloat($(this).val());								
		});	
		$("#total_amount").html(SITE_CURRENCY+total_amount.toFixed(2));				
	}

	$(document).delegate(".delitem", "click", function(){
		total_amount=0.0;
		flag=true;
		cl=false;
		if($( ".tot" ).length==1){
			flag=confirm("Do you really want to delete the last item?");
		}			
		if(flag==true){			
			len--;				
			$(this).closest('.order-pg-items').slideUp("fast",function(){
				$(this).closest('.order-pg-items').remove();		
				$(".selected-dishes-no-pop").html(len);	
				calculateTotal();												
			});
			
			if($( ".tot" ).length==1){							
				$('.inside-body-wrapper.menu-pg .modal .fa-times').trigger('click');
			}
		}//IF FLAG==TRUE
	});



	/*----------------------------------------------------*/
	/*  ORDER PAGE CLOSE 
	/*----------------------------------------------------*/
	$('.inside-body-wrapper.menu-pg .modal .fa-times').on('click', function(){
		$('.modal').removeClass('animated bounceIn');
		$('.inside-body-wrapper.menu-pg')
			.find('.modal').addClass('animated bounceOut')
			.delay(800)
			.queue(function(next){
				$(".inside-body-wrapper.menu-pg .overlay").removeClass("disp");
				$('.inside-body-wrapper.menu-pg').css("max-height","inherit");
				$('.inside-body-wrapper.menu-pg .overlay').css("height","auto");
				$("#order-form button.grey-btn")
					.prop("disabled",false)
					.addClass('green-btn')
					.removeClass('grey-btn disabled');
					$( this ).dequeue();
			});

		// RESETTING FORM AND ITEM ARRAY ON CLOSING POPUP
			$('.form-message').hide();
			$('#order-form').children('input').val('');
			selectedDishes = 0;
			$('.price-add-select .button.red-btn')
				.removeClass('clicked')
				.closest('.price-add-select').find('.button.green-btn').removeClass("clicked")
				.closest('.price-add-select').find('.button.white-btn').addClass("clicked");
			$(".selected-dishes-no").html(selectedDishes);
			dish = [];
	});



	/*----------------------------------------------------*/
	/*	LOGIN FORM DISPLAY
	/*----------------------------------------------------*/
	$('a.login-btn').on('click', function () {
		$(".overlay").addClass("disp");
		var modalHeight = $(".modal.login-page").height() + 250;
		$('.inside-body-wrapper').css("max-height",modalHeight);

		// CHECK TO SEE IF MODAL HEIGHT IS MORE THAN WINDOW HEIGHT
		if (($(".modal.login-page").height() + 200) > $(window).height())
			{ $('.overlay').css("height",modalHeight); } // IF MODAL IS GREATER THAN WINDOW
		else
			{ $('.overlay').css("height","100%"); } // IF MODAL IS SMALLER THAN WINDOW

		$('.modal').css("display","block");
		$('.modal').removeClass('animated bounceOut');
		$('.modal').addClass('animated bounceInDown');
	});



  /*----------------------------------------------------*/
	/*  LOGIN FORM CLOSE
	/*----------------------------------------------------*/
	$('.inside-body-wrapper.index-pg .modal .fa-times').on('click', function () {
		$('.modal').removeClass('animated bounceInDown');
		$('.inside-body-wrapper.index-pg')
			.find('.modal').addClass('animated bounceOut')
			.delay(800)
			.queue(function(next){
					$(".inside-body-wrapper.index-pg .overlay").removeClass("disp");
					$('.inside-body-wrapper.index-pg').css("max-height","inherit");
					$('.inside-body-wrapper.index-pg .overlay').css("height","auto");
					$( this ).dequeue();
			});
	});



	/*----------------------------------------------------*/
	/*	IMG-LIQUID
	/*----------------------------------------------------*/
	if($(".imgLiquidFill").length) {
		$(".imgLiquidFill").imgLiquid();
	}



	/*----------------------------------------------------*/
	/*	CALENDAR
	/*----------------------------------------------------*/


	if($("#calendar").length)
	{
			$(function() {
				var dtn = new Date();				
				var mn=((dtn.getMonth()+1)>9?'':'0')+(dtn.getMonth()+1);
				var dy=(dtn.getDate()>9?'':'0')+dtn.getDate();
				var yr=dtn.getFullYear();			
				var dtstrn=yr+"-"+mn+"-"+dy;									
				var data={action:"calendarEvents",dt:dtstrn};
				$.post(spicesettings.ajaxurl,data,function(res){								
					var result=jQuery.parseJSON(res);
					$("#event_title").html(result.post_title);	
					if(result.status==1){
						$("#event_link").show();
						$("#event_link").attr('href',result.post_link);	
						$("#event_image").parent().css('background-image','url(' + result.event_image + ')');
						$("#event_image").attr('src',result.event_image);													 	
					}
					else{
						$("#event_link").hide();
					}
				});		

				var cal = $( '#calendar' ).calendario({
						onDayClick : function( $el, $contentEl, dateProperties){
							for( var key in dateProperties ){
								dy=(dateProperties["day"]>9?'':'0')+dateProperties["day"];
								mn=(dateProperties["month"]>9?'':'0')+dateProperties["month"];
								yr=dateProperties["year"];
								str=dateProperties["monthname"]+" "+dy+", "+yr;					
							}
							dt = new Date(str);				
							$('#current-date').html(dt.getDate());				
							dtstr=yr+"-"+mn+"-"+dy;							
							data={action:"calendarEvents",dt:dtstr};
							$.post(spicesettings.ajaxurl,data,function(res){								
								var result=jQuery.parseJSON(res);
								$("#event_title").html(result.post_title);	
								if(result.status==1)
								{
									$("#event_link").show();
									$("#event_link").attr('href',result.post_link);	
									$("#event_image").parent().css('background-image','url(' + result.event_image + ')');
									$("#event_image").attr('src',result.event_image);									 	
								}
								else
								{									
									$("#event_image").parent().css('background-image','url(' + result.event_image + ')');
									$("#event_link").hide();
								}
							});				
						},						
						displayWeekAbbr : true
					}),
					$month = $( '#custom-month' ).html( cal.getMonthName() ),
					$year = $( '#custom-year' ).html( cal.getYear() );
				$('#next-date' ).on( 'click', function(){
					cal.gotoNextMonth( updateMonthYear );
				});
				$('#prev-date' ).on( 'click', function(){
					cal.gotoPreviousMonth( updateMonthYear);
				});
				$('#current-date' ).on( 'click', function(){
					cal.gotoNow( updateMonthYear );
				});

				data={action:"calendarEventsForMonth"};
				var dt="";				
				$.post(spicesettings.ajaxurl,data,function(res){								
					var cdrp = jQuery.parseJSON(res);				
					cal.setData(cdrp);					
				});		

				function updateMonthYear(){				
					$month.html( cal.getMonthName() );
					$year.html( cal.getYear() );
					mn=(cal.getMonth()>9?'':'0')+cal.getMonth();
					yr=cal.getYear();			

					data={action:"calendarEventsForMonth",mn:mn,yr:yr};
					$.post(spicesettings.ajaxurl,data,function(res){												
						var cdrp = jQuery.parseJSON(res);				
						cal.setData(cdrp);					
					});	
				}
				var today = new Date();
				$('#current-date').html(today.getDate());
				cal.setData( {
								'08-01-2014' : '<a href="#">testing</a>',
								'08-10-2014' : '<a href="#">testing</a>',
								'08-12-2014' : '<a href="#">testing</a>'
							} );
			});
			
			$("#calendar").on("click", ".fc-content", function(evt){
				var imgSrc = $(this).find("img").attr("src");
				var heading = $(this).find("a").text();
				var anchor = $(this).find("a").attr("href");
				$("#updateArticle").children("img").attr("src", imgSrc).css("height","137px").end()
								   .children("a").attr("href",anchor).text(heading);
				if(imgSrc==undefined){$("#updateArticle").children("img").remove(); }
			})
		}




	/*----------------------------------------------------*/
	/*	ScrollUp
	/*----------------------------------------------------*/
	/**
	* scrollUp v1.1.0
	* Author: Mark Goodyear - http://www.markgoodyear.com
	* Git: https://github.com/markgoodyear/scrollup
	*
	* Copyright 2013 Mark Goodyear
	* Licensed under the MIT license
	* http://www.opensource.org/licenses/mit-license.php
	*/
	//'use strict';
	$.scrollUp = function (options) {
		// Defaults
		var defaults = {
			scrollName: 'scrollUp', // Element ID
			topDistance: 300, // Distance from top before showing element (px)
			topSpeed: 1200, // Speed back to top (ms)
			animation: 'slide', // Fade, slide, none
			animationInSpeed: 200, // Animation in speed (ms)
			animationOutSpeed: 200, // Animation out speed (ms)
			scrollText: '', // Text for element
			scrollImg: false, // Set true to use image
			activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
		};

		var o = $.extend({}, defaults, options),
			scrollId = '#' + o.scrollName;

		// Create element
		$('<a/>', {
			id: o.scrollName,
			href: '#top',
			title: o.scrollText
		}).appendTo('body');
		
		// If not using an image display text
		if (!o.scrollImg) {
			$(scrollId).text(o.scrollText);
		}

		// Minium CSS to make the magic happen
		$(scrollId).css({'display':'none','position': 'fixed','z-index': '2147483647'});

		// Active point overlay
		if (o.activeOverlay) {
			$("body").append("<div id='"+ o.scrollName +"-active'></div>");
			$(scrollId+"-active").css({ 'position': 'absolute', 'top': o.topDistance+'px', 'width': '100%', 'border-top': '1px dotted '+o.activeOverlay, 'z-index': '2147483647' });
		}

		// Scroll function
		$(window).scroll(function(){	
			switch (o.animation) {
				case "fade":
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).fadeIn(o.animationInSpeed) : $(scrollId).fadeOut(o.animationOutSpeed) );
					break;
				case "slide":
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).slideDown(o.animationInSpeed) : $(scrollId).slideUp(o.animationOutSpeed) );
					break;
				default:
					$( ($(window).scrollTop() > o.topDistance) ? $(scrollId).show(0) : $(scrollId).hide(0) );
			}
		});

		// To the top
		$(scrollId).click( function(event) {
			$('html, body').animate({scrollTop:0}, o.topSpeed);
			event.preventDefault();
		});
	};
	$.scrollUp();



	/*----------------------------------------------------*/
	/*	MENU PAGE MENUS APPEAR IN TAB/MOBILE
	/*----------------------------------------------------*/
	$(".search-menu-list .head").on('click', function () {
		$(this).parent(".search-menu-list").siblings(".search-menu-list.show").removeClass("show");
		$(this).parent(".search-menu-list").addClass("show");
	});



	/*----------------------------------------------------*/
	/*	SKILL PERCENTAGE READ FROM HTML [TESTIMONIALS PG]
	/*----------------------------------------------------*/
	$( ".level-bar" ).each(function( index ) {
		var w = $(this).find(".level-bar-filled").data("level");
		var z = w+"%";
		$(this).find(".level-bar-filled").css("width",z);
		$(this).parent(".star-rating-home").find(".level-percent h3").html(w);
  });



	/*----------------------------------------------------*/
	/*	FOOD GALLERY PAGE FOOD-TYPE SELECT
	/*----------------------------------------------------*/
  $(".food-type-list a").on('click', function(){
		$(this).closest(".food-type-list").find("a").removeClass("selected");
		$(this).addClass("selected");
  });



  //=========EVENT PAGE ONLY============
	if( ($(".event-page").length > 0) && ($(window).innerWidth() > 767)){
  	$('.featured-events .feature-events').each(function(){
  		var blogHeight = $(this).innerHeight();					
  		$(this).find('.figure').css('height', blogHeight);  	
  	});
	}



  /*----------------------------------------------------*/
	/*	WIDGET SECTION TAB DISPLAY [EVENT PAGE]
	/*----------------------------------------------------*/
  if ($(".popular-events-widget .tabs > li > a").hasClass("selected"))
  	{ $(".popular-events-widget a.selected").parent().find("ul").css("display","block"); }

  $(".popular-events-widget .tabs > li > a").click(function(){
		if (!$(this).hasClass("selected")){
			$(".popular-events-widget .tabs > li > a").removeClass("selected");
			$(".popular-events-widget .tabs > li ul").css("display","none");
			$(this).addClass("selected");
			$(this).parent().find("ul").css("display","block");
		}
  });




  /*----------------------------------------------------*/
	/*	MAP SECTION FORM VALIDATION
	/*----------------------------------------------------*/
	$(".dining-space-types.fixed-type").click(function(){
		if($(this).find("input:checkbox").val()!=-1){
			$(".personNo").prop("readonly",true);
			$(".personNo").val($(this).find("input:checkbox").val());
		}
		else{
			$(".personNo").prop("readonly",false);
			$(".personNo").val('');
			$(".personNo").focus();
		}
	});
		



	/*----------------------------------------------------*/
	/*	Food Recipe Detail Section [INDEX PAGE]
	/*----------------------------------------------------*/
	var liCount = $(".slidingDiv").size();
	var liActive = parseInt(liCount/2) + 1;
	var figText = $(".recipes .container > div.slidingDiv:nth-of-type("+liActive+")").css("display","block");

	activeid="#"+$(".foodRecipe li.active").data('div');
	$(".slidingDiv-wrapper").find(activeid).show();

	$(".foodRecipe li").on("mouseenter",function(){
		// $(this).siblings().removeClass("active");
		$(this).closest('.recipe-list').find('li').removeClass("active");
		$(this).addClass("active");
		container = $(".slidingDiv-wrapper");
		child = ".slidingDiv";
		$this = $(this),
		id = $this.data("div"),
		id = "#"+id;
		container.children(child).hide();
		container.children(id).show();
	});



	/*----------------------------------------------------*/
	/*	Waypoint Animations
	/*----------------------------------------------------*/
	if ($(window).width() >= 768) { wayPoint(); }

	function wayPoint() {
		$('.best-food-wrapper').waypoint(function() {
			setTimeout(function(){$('.best-food-item:nth-of-type(2)').addClass('animate')},100);
			setTimeout(function(){$('.best-food-item:nth-of-type(4)').addClass('animate')},200);
			setTimeout(function(){$('.best-food-item:nth-of-type(6)').addClass('animate')},300);
			setTimeout(function(){$('.best-food-item:nth-of-type(7)').addClass('animate')},400);
			setTimeout(function(){$('.best-food-item:nth-of-type(5)').addClass('animate')},500);
			setTimeout(function(){$('.best-food-item:nth-of-type(3)').addClass('animate')},600);
			setTimeout(function(){$('.best-food-item .item-text').addClass('animate')},900);
		}, { offset: '45%' });


		$('.map-search').waypoint(function() {
			setTimeout(function(){$('.city-search').addClass('animated flipInX')},100);
			$(".city-search").css("opacity","1");
		}, { offset: '75%' });

		$('.banner').waypoint(function() {
			setTimeout(function(){$('.banner-caption').addClass('animated fadeInDown')},100);
			setTimeout(function(){$('.banner-caption h5').addClass('animated fadeInUp')},100);
			setTimeout(function(){$('.banner-caption h2').addClass('animated fadeInUp')},100);
		}, { offset: '75%' });

		//========== INDEX PAGE WAYPOINT ================
		$('.spice-cta').waypoint(function() {
					setTimeout(function(){$('.place-order').addClass('animated flipInX')},100);
					$(".place-order").css("opacity","1");
				}, { offset: '75%' });
		if( $(".home").length > 0 ) 
		{ 
				

				$('.top-content').waypoint(function() {
					setTimeout(function(){$('.top-content .sub-heading h2').addClass('animated fadeInRight')},100);
					setTimeout(function(){$('.top-content .sub-heading h6').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.top-content > img').addClass('animated fadeInUp')},100);
				}, { offset: '20%' });
				
				$('.book-table').waypoint(function() {
					setTimeout(function(){$('.book-form').addClass('animated fadeInUp')},100);
				}, { offset: '55%' });

				$('.food-solutions').waypoint(function() {
					setTimeout(function(){$('.food-menus:nth-of-type(1)').addClass('animated fadeInRight')},100);
				}, { offset: '40%' });
				$('.food-solutions').waypoint(function() {
					setTimeout(function(){$('.food-menus:nth-of-type(2)').addClass('animated fadeInLeft')},100);
				}, { offset: '0%' });
				$('.food-solutions').waypoint(function() {
					setTimeout(function(){$('.food-menus:nth-of-type(3)').addClass('animated fadeInRight')},100);
				}, { offset: '-40%' });

				$('.everyday-events').waypoint(function() {
					setTimeout(function(){$('.feature-events-wrapper:nth-of-type(1)').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.feature-events-wrapper:nth-of-type(2)').addClass('animated fadeInRight')},100);
					setTimeout(function(){$('.feature-events-wrapper:nth-of-type(3)').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.feature-events-wrapper:nth-of-type(4)').addClass('animated fadeInRight')},100);
				}, { offset: '50%' });

				$('.user-reviews').waypoint(function() {
					setTimeout(function(){$('.review:nth-of-type(1)').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.review:nth-of-type(2)').addClass('animated fadeInUp')},100);
					setTimeout(function(){$('.review:nth-of-type(3)').addClass('animated fadeInRight')},100);
				}, { offset: '40%' });

				$('.meet-chef').waypoint(function() {
					setTimeout(function(){$('.chef-details figure').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.chef-details .figcaption').addClass('animated fadeInRight')},100);
					setTimeout(function(){$('.meet-chef .container > figure img:first-of-type').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.meet-chef .container > figure img:last-of-type').addClass('animated fadeInRight')},100);
				}, { offset: '20%' });
		}//==================INDEX PAGE WAYPOINT ends==========================

		
		//========= MENU PAGE WAYPOINT ============
		if( $(".menu-page").length > 0){
			$('.search-menu-list.lnch').waypoint(function() {
				setTimeout(function(){$('.lnchSlider li').not('bx-clone').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });

			$('.search-menu-list.dinr').waypoint(function() {
				setTimeout(function(){$('.dnnrSlider li').not('bx-clone').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });

			$('.search-menu-list.drinks').waypoint(function() {
				setTimeout(function(){$('.drnkSlider li').not('bx-clone').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });
		}//===========MENU PAGE WAYPOINT ends=========================


		//========= EVENT PAGE WAYPOINT ============
		if( $(".event-page").length > 0 )
		{
			$('.monthly-events-section').waypoint(function() {
				setTimeout(function(){$('.month-events:nth-of-type(odd)').addClass('animated fadeInDown')},100);
				setTimeout(function(){$('.month-events:nth-of-type(even)').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });
			
			if( !$(".blog .event-page").length )
			{
				$('.featured-events').waypoint(function() {
					setTimeout(function(){$('.feature-events:nth-of-type(odd)').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.feature-events:nth-of-type(even)').addClass('animated fadeInRight')},100);
				}, { offset: '60%' });

				$('.featured-events').waypoint(function() 
				{
					setTimeout(function(){$('.feature-events-wrap:nth-of-type(odd)').addClass('animated fadeInLeft')},100);
					setTimeout(function(){$('.feature-events-wrap:nth-of-type(even)').addClass('animated fadeInRight')},100);
				}, { offset: '60%' });
			}
			
		}//=========EVENT PAGE ends============


		//========= FAV DISH WAYPOINT ============
		if( $(".fav-dish").length > 0 ) {
			$('.chef-details').waypoint(function() {
				setTimeout(function(){$('.chef-details .chef-img.imgLiquid').addClass('animated flipInX')},100);
				$(".place-order").css("opacity","1");
			}, { offset: '20%' });

			$('.about-dish').waypoint(function() {
				setTimeout(function(){$('.fork-icon li').addClass('animated fadeInRight')},100);
			}, { offset: '20%' });

			$('.reviews-container').waypoint(function() {
				// setTimeout(function(){$('.review-comments-wrapper:nth-of-type(1)').addClass('animated fadeInLeft')},100);
				// setTimeout(function(){$('.review-comments-wrapper:nth-of-type(2)').addClass('animated fadeInRight')},100);
				// setTimeout(function(){$('.review-comments-wrapper:nth-of-type(3)').addClass('animated fadeInLeft')},100);
				// setTimeout(function(){$('.review-comments-wrapper:nth-of-type(4)').addClass('animated fadeInRight')},100);
				setTimeout(function(){$('.review-comments-wrapper:nth-of-type(odd)').addClass('animated fadeInLeft')},100);
				setTimeout(function(){$('.review-comments-wrapper:nth-of-type(even)').addClass('animated fadeInRight')},100);
			}, { offset: '45%' });
		}//=========FAV DISH PAGE ends============


		if( $(".testimonials-page").length > 0 ) {
			$('.testimonials-page .review').waypoint(function() {
				setTimeout(function(){$('.review-comments-wrapper:nth-of-type(odd)').addClass('animated fadeInLeft')},100);
				setTimeout(function(){$('.review-comments-wrapper:nth-of-type(even)').addClass('animated fadeInRight')},100);
			}, { offset: '50%' });
		}


		if( $(".our-events").length > 0 ) {
			$('.upcoming-events').waypoint(function() {
				setTimeout(function(){$('.event-banner').addClass('animated fadeInUp')},100);
				setTimeout(function(){$('.bullet-wrapper').addClass('animated fadeInLeft')},100);
				setTimeout(function(){$('.name-date').addClass('animated fadeInLeft')},100);
				setTimeout(function(){$('.button-holder').addClass('animated fadeInRight')},100);
			}, { offset: '50%' });
		}


		if( $(".about-chef-page").length > 0 ) {
			$('.fav-recipes').waypoint(function() {
				setTimeout(function(){$('.fav-recipes .img-holder:nth-of-type(1)').addClass('animated fadeInDown')},100);
				setTimeout(function(){$('.fav-recipes .img-holder:nth-of-type(2)').addClass('animated fadeInDown')},100);
				setTimeout(function(){$('.fav-recipes .img-holder:nth-of-type(3)').addClass('animated fadeInDown')},100);
				setTimeout(function(){$('.fav-recipes .img-holder:nth-of-type(4)').addClass('animated fadeInUp')},100);
				setTimeout(function(){$('.fav-recipes .img-holder:nth-of-type(5)').addClass('animated fadeInUp')},100);
				setTimeout(function(){$('.fav-recipes .img-holder:nth-of-type(6)').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });
		}


		if( $(".our-gallery").length > 0 ) {
			$('.in-house').waypoint(function() {
						setTimeout(function(){$('.in-house .img-wrappers').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });
			$('.own-event').waypoint(function() {
						setTimeout(function(){$('.own-event .img-wrappers').addClass('animated fadeInUp')},100);
			}, { offset: '60%' });
		}
	}/* =========== WAYPOINTS ends =================================== */
	/* ============================================================ */
	

    $('.widgets > div').addClass('clearfix');

    /**** REVIEW PAGE *****/
    if($('h3').hasClass("counter"))
    {
	    $('.counter').counterUp({
	        delay: 10,
	        time: 1000
	    });
	}
 	/**** CHEF PAGE *****/
	$(".fav-recipes .img-holder").hover(function(){
			var imgMargin = ($(this).find("h4").outerHeight())/2;			
			$(this).find("h4").css("margin-top",-imgMargin);
	});

	
	$('.leave_comment a,.comment-btn').click(function(){				

		if($('.comment-name-txt').length==1)
		{
		 	$('.comment-name-txt').focus();
		}
		else
		{
		 	$('#comment').focus();
		}
		return false; //prevent default click action from happening (page scroll to top)
  });
	var $container = jQuery('#food-items');

					if($('#food-items').length)
					{
						jQuery('#food-items').isotope({
							itemSelector : '.food-item-wrapper',
			      			animationOptions: {
							     duration: 750,
							     easing: 'linear',
							     queue: false
							   }
						});
					      
						$('.food-type-list li a').on( 'click',  function(e) {
							e.preventDefault();
						  	var filterValue = $(this).attr('data-filter');
						  	$container.isotope({ filter: filterValue });
						});
					}

			$('.load-more-event').on('click',function(){
				itemno=$(this).data('item');
				newitemno=itemno+2;		
				page_id=$(this).data('page');
				$(this).data('item',newitemno);
				$('.spinner-loader-cont').show();
				data={action:"everydayEvents",items:itemno,page_id:page_id};
				$.post(spicesettings.ajaxurl,data,function(res){
					if(res==1){
						res='<div class="no-more-data">Oops! No event found :( <span>Please try other dates.</span></div>';
						$('.load-more-event').css('display','none');
					}
					$('.feat-event').append(res);	
					$(".imgLiquidFill").imgLiquid();		
					$('.spinner-loader-cont').hide();
					$(window).trigger('resize');
				});
			});

			$('.load-more-event-style2').on('click',function(){
				itemno=$(this).data('item');
				newitemno=itemno+2;		
				page_id=$(this).data('page');
				$(this).data('item',newitemno);
				$('.spinner-loader-cont').show();
				data={action:"everydayEventsStyle2",items:itemno,page_id:page_id};
				$.post(spicesettings.ajaxurl,data,function(res)
				{					
					if(res==1)
					{
						res='<div class="no-more-data">Oops! No event found :( <span>Please try other dates.</span></div>';
						$('.load-more-event').css('display','none');
					}
					$('.feat-event').append(res);		
					$(".imgLiquidFill").imgLiquid();	
					$('.spinner-loader-cont').hide();
					$(window).trigger('resize');
				});
			});
			

		$('.add_to_cart_button').on('click',function()
		{
			var data={action:"cartMenuUpdate"};
			$.post(spicesettings.ajaxurl,data,function(res)
			{						
					if($('.item-count').hasClass("display_none"))
					{
						$('.item-count').removeClass("display_none")
					}
					var res=$('.item-count').html();					
					res=parseInt(res)+1;								
					$('.item-count').html(res);		
					var datainner={action:"cartMenuTextUpdate"};					
					$.post(spicesettings.ajaxurl,datainner,function(res_amount)
					{
							$('.cart-amount').html(res_amount);	
					});
									
			});
		});



	if($('.error404').length){
			var height404 = ($(window).height() - $("header").height());
			$(".error-page-html").css("height",height404);

			$('#nav-toggle').click(function () {
				$(".navbar-nav").toggleClass("show-menu");
			});

			$(".navbar-nav").hover(function(){
		    	$(this).css('overflow','visible');
		    },function() {
					$(this).css('overflow','hidden');
			});
			$( window ).resize(function() {
				var height404 = ($(window).height() - $("header").height());
				$(".error-page-html").css("height",height404);
			});
	}



	/*-------------------------------------------*/
	/*	Ingredient section carousel [HOMEPAGE]
	/*-------------------------------------------*/
	var i=5, j=4, k=3, l=2, m=1;
	if ($('.foodRecipe').length)
	{
		var itemCount = $('.recipe-list li').length;
		if(itemCount == 1)
			{ i=j=k=l = 1; }
		else if(itemCount == 2)
			{ i=j=k = 2; }
		else if(itemCount == 3)
			{ i=j = 3; }
		else if(itemCount == 4)
			{ i = 4; }
	}

	function ingredientCarousel(){
		if ($('.foodRecipe').length){
			if($(window).width() < 975){	
				  $("#owl-example").owlCarousel({
				  	center : true,
				    loop : false,
				  	items : itemCount,
				  	itemsDesktop : [1199,i],
				  	itemsDesktopSmall : [991,j],
				    itemsTablet: [767,k],
				    itemsTabletSmall: [650,l],
				    itemsMobile : [479,m],
				    singleItem : false,
				    dotsEach : true
				  });
			}
			else if(($(window).width() > 975) && ($('.owl-wrapper').length)){
					$("#owl-example").data('owlCarousel').destroy();				
			}
		}
	}
	ingredientCarousel();

	
	$(".gallery_post_format").owlCarousel({
				  	center : true,
				    loop : true,
				  	// items : itemCount,
				  	itemsDesktop : [1199,1],
				  	itemsDesktopSmall : [991,1],
				    itemsTablet: [767,k],
				    itemsTabletSmall: [650,1],
				    itemsMobile : [479,1],
				    singleItem : true,
				    dotsEach : true,
				    navigation:true,
				  });

	//console.log();

	$(".postRelatedImages").owlCarousel({	  
        items : spicesettings.owl_col, // With sidebar      
        itemsDesktopSmall : [979,4],
        itemsDesktop : [1199,4],       
        itemsTablet: [767,4],
        itemsTabletSmall: [650,3],
        itemsMobile : [450,2],
        center: true,
		pagination:false,
		dots: false,
	    autoPlay: true,
	    autoplayHoverPause: true,
	    autoWidth: true,
	    navigation:true,
	    navigationText	:["<i class='fa fa-angle-left'>","<i class='fa fa-angle-right'>"]
	});
	


	/*-------------------------------------------*/
	/*	Menu items carousel [MENU PAGE]
	/*-------------------------------------------*/
	// var menuCarousel;
	function menuItemCarousel(){
		var menuCarousel = $('.owl-carousel-menu');
		if(menuCarousel.length){
			if($(window).width() > 975){
				menuCarousel.owlCarousel({
					center : false,
				  loop : true,
				  nav : false,
				  items : 3,
			  	itemsDesktop : [1199,3],
			  	itemsDesktopSmall : [991,3],
			    // itemsTablet : [767,3],
			    // itemsTabletSmall : [650,3],
			    // itemsMobile : [479,1],
			    singleItem : false
				})
			}
			else if(($(window).width() < 975) && ($('.owl-wrapper').length)){
				menuCarousel.each(function(){
					$(this).data('owlCarousel').destroy();
				});
			}
		}
	}
	menuItemCarousel();
	function meetChefCarousel(){
		var chefV2Wrapper = $('.chef-v2-wrapper');
		var chefV2Item = chefV2Wrapper.find('.chef-v2-item');

		if (chefV2Wrapper.length){
			chefV2Wrapper.owlCarousel({
		  	center : true,
		    loop : false,
		  	items : 3,
		  	itemsDesktop : [1184,3],
		  	itemsDesktopSmall : [976,2],
		    itemsTabletSmall: [500,1],
		    singleItem : false,
		    dotsEach : true
		  });
		}

		chefV2Item.each(function(){
			var chefImgWidth = chefV2Item.find('.chef-img-wrapper2').outerWidth();
			$(this).find('.chef-img-wrapper2').css('height', chefImgWidth);
		})
	}
	meetChefCarousel();



	/***WOO COMMERCE **/

	$("input[name='spice-checkout-method']" ).on('change',function(){
		var val = $(this).val();
		$('.panel-next').collapse('hide');
		if(val === '0')
		{
			$('.panel-register').hide();
			$('.button_create_account_continue').data('acc','panelBilling');


		}
		else
		{
			$('.panel-register').show();
			$('.button_create_account_continue').data('acc','panelRegister');
		}
	});
	$('.button_billing_continue').on('click', function()
	{
		var next_id="#"+$(this).data('acc');
	    $('#panelBilling').collapse('show');
	    $('#panelRegister').collapse('hide');
		
	});	


	$('.button_create_account_continue').on('click', function()
	{
		var next_id="#"+$(this).data('acc');
	    $(next_id).collapse('show');
	    $('#panelMethods').collapse('hide');
		
	});	
	$('.button_shipping_address_continue').on('click', function()
	{

		var next_id="#"+$(this).data('acc');
	    $(next_id).collapse('show'); 
	    $('#panelBilling').collapse('hide');   
		
	});
	$('.button_your_order_continue').on('click', function()
	{

		var next_id="#"+$(this).data('acc');
	    $(next_id).collapse('show'); 
	    $('#panelShipping').collapse('hide');   
		
	});	

	if(spicesettings.banner_blur==1)
	{
		if($('.banner').length)
		{
	      var scrollOptions = {
	       test : $('.banner')
	      };
	      var scrolling = new Scroller();  
	      scrolling.init(scrollOptions);
	    }
	}

	jQuery('.spice-share-options a').click(function(e) 
	{			
		e.preventDefault();
	});


	
})(jQuery);/* =========== DOCUMENT READY ends ======================= */

/**
 * requestAnimationFrame Shim 
 */
window.requestAnimFrame = (function()
{
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          function( callback ){
            window.setTimeout(callback, 1000 / 60);
          };
})();


/*----------------------------------------------------*/
/*	FITTEXT
/*----------------------------------------------------*/
jQuery(".event h3").fitText(1, {minFontSize: '30px', maxFontSize: '40px'});
jQuery(".author h3").fitText(1, {minFontSize: '30px', maxFontSize: '40px'});
jQuery(".event h4").fitText(1, {minFontSize: '16px', maxFontSize: '25px'});

function spiceShare(sociallink)
{
	switch(sociallink)
	{
		case 'twitter':
						window.open( 'http://twitter.com/intent/tweet?text='+jQuery(".title-content h2").text() +' '+window.location, 
						"twitterWindow", 
						"width=650,height=350" );
						break;
		case 'fb': 		window.open( 'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
						'facebookWindow', 
						'width=650,height=350');
						break;
		case 'pinterest':
						window.open( 'http://pinterest.com/pin/create/bookmarklet/?media='+ jQuery('.begin-content img').first().attr('src') + '&description='+jQuery('.title-content h2').text()+' '+encodeURIComponent(location.href), 
						'pinterestWindow', 
						'width=750,height=430, resizable=1');
						break;
		case 'gp'		:
						window.open( 'https://plus.google.com/share?url='+encodeURIComponent(location.href), 
						'googleWindow', 
						'width=500,height=500');
						break;
		case 'linkedin'	:
						window.open( 'http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent(location.href)+'&title='+jQuery("h1").text(), 
						'linkedinWindow', 
						'width=650,height=450, resizable=1');
						break;


										
	}
	return false;
}
function meetChefCarousel(){
	var chefV2Wrapper = $('.chef-v2-wrapper');
	var chefV2Item = chefV2Wrapper.find('.chef-v2-item');

	if (chefV2Wrapper.length){
		chefV2Wrapper.owlCarousel({
	  	center : true,
	    loop : false,
	  	items : 3,
	  	itemsDesktop : [1184,3],
	  	itemsDesktopSmall : [976,2],
	    itemsTabletSmall: [500,1],
	    singleItem : false,
	    dotsEach : true
	  });
	}

	chefV2Item.each(function(){
		var chefImgWidth = chefV2Item.find('.chef-img-wrapper').outerWidth();
		$(this).find('.chef-img-wrapper').css('height', chefImgWidth);
	})
}

