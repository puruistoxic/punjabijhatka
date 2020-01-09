/**
 *
 * @auther SM@K<smali.kazmi@hotmail.com>
 * @description website: smak.pk
 */

(function() {
	var root = this;

	var SmartPhone = function(obj) {
		if (obj instanceof SmartPhone)
			return obj;
		if (!(this instanceof SmartPhone))
			return new SmartPhone(obj);
		this._wrapped = obj;
	};

	SmartPhone.userAgent = null;
	SmartPhone.getUserAgent = function() {
		return this.userAgent;
	};

	SmartPhone.setUserAgent = function(userAgent) {
		this.userAgent = userAgent;
	};

	SmartPhone.isAndroid = function() {
		return this.getUserAgent().match(/Android/i);
	};

	SmartPhone.isBlackBerry = function() {
		return this.getUserAgent().match(/BlackBerry/i);
	};

	SmartPhone.isBlackBerryPlayBook = function() {
		return this.getUserAgent().match(/PlayBook/i);
	};

	SmartPhone.isBlackBerry10 = function() {
		return this.getUserAgent().match(/BB10/i);
	};

	SmartPhone.isIOS = function() {
		return this.isIPhone() || this.isIPad() || this.isIPod();
	};

	SmartPhone.isIPhone = function() {
		return this.getUserAgent().match(/iPhone/i);
	};

	SmartPhone.isIPad = function() {
		return this.getUserAgent().match(/iPad/i);
	};

	SmartPhone.isIPod = function() {
		return this.getUserAgent().match(/iPod/i);
	};

	SmartPhone.isOpera = function() {
		return this.getUserAgent().match(/Opera Mini/i);
	};

	SmartPhone.isWindows = function() {
		return this.isWindowsDesktop() || this.isWindowsMobile();
	};

	SmartPhone.isWindowsMobile = function() {
		return this.getUserAgent().match(/IEMobile/i);
	};

	SmartPhone.isWindowsDesktop = function() {
		return this.getUserAgent().match(/WPDesktop/i);
	};

	SmartPhone.isFireFox = function() {
		return this.getUserAgent().match(/Firefox/i);
	};

	SmartPhone.isNexus = function() {
		return this.getUserAgent().match(/Nexus/i);
	};

	SmartPhone.isKindleFire = function() {
		return this.getUserAgent().match(/Kindle Fire/i);
	};

	SmartPhone.isPalm = function() {
		return this.getUserAgent().match(/PalmSource|Palm/i);
	};

	SmartPhone.isAny = function() {
		var foundAny = false;
		var getAllMethods = Object.getOwnPropertyNames(SmartPhone).filter(function(property) {
			return typeof SmartPhone[property] == 'function';
		});

		for (var index in getAllMethods) {
			if (getAllMethods[index] === 'setUserAgent' || getAllMethods[index] === 'getUserAgent' ||
				getAllMethods[index] === 'isAny' || getAllMethods[index] === 'isWindows' ||
				getAllMethods[index] === 'isIOS') {
				continue;
			}
			if (SmartPhone[getAllMethods[index]]()) {
				foundAny = true;
				break;
			}
		}
		return foundAny;
	};

	if(typeof window === 'function' || typeof window === 'object') {
		SmartPhone.setUserAgent(navigator.userAgent);
	}

	if (typeof exports !== 'undefined') {

		var middleware = function(isMiddleware) {

			isMiddleware = isMiddleware === (void 0)  ? true : isMiddleware;

			if(isMiddleware) {
				return function(req, res, next) {

					var userAgent = req.headers['user-agent'] || '';
					SmartPhone.setUserAgent(userAgent);
					req.SmartPhone = SmartPhone;

					if ('function' === typeof res.locals) {
						res.locals({SmartPhone: SmartPhone});
					} else {
						res.locals.SmartPhone = SmartPhone;
					}

					next();
				};
			} else {
				return SmartPhone;
			}

		};

		if (typeof module !== 'undefined' && module.exports) {
			exports = module.exports = middleware;
		}
		exports = middleware;
	} else {
		root.SmartPhone = SmartPhone;
	}

}.call(this));

// http://paulirish.com/2009/throttled-smartresize-jquery-event-handler/
(
    function ( $, sr ) {
        'use strict';
        // debouncing function from John Hann
        // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
        var debounce = function ( func, threshold, execAsap ) {
            var timeout;

            return function debounced() {
                var obj  = this,
                    args = arguments;

                function delayed() {
                    if ( ! execAsap ) {
                        func.apply( obj, args );
                    }
                    timeout = null;
                }

                if ( timeout ) {
                    clearTimeout( timeout );
                } else if ( execAsap ) {
                    func.apply( obj, args );
                }

                timeout = setTimeout( delayed, threshold || 100 );
            };
        };

        // smartresize
        jQuery.fn[sr] = function ( fn, threshhold ) {
            return fn ? this.bind( 'resize', debounce( fn, threshhold ) ) : this.trigger( sr );
        };

    }
)( jQuery, 'smartresize' );

/**
 * @preserve JSizes - JQuery plugin v0.33
 *
 * Licensed under the revised BSD License.
 * Copyright 2008-2010 Bram Stein
 * All rights reserved.
 */
/*global jQuery*/
(function ($) {
	'use strict';
	var num = function (value) {
		return parseInt(value, 10) || 0;
	};

	/**
	 * Sets or gets the values for min-width, min-height, max-width
	 * and max-height.
	 */
	$.each(['min', 'max'], function (i, name) {
		$.fn[name + 'Size'] = function (value) {
			var width, height;
			if (value) {
				if (value.width !== undefined) {
					this.css(name + '-width', value.width);
				}
				if (value.height !== undefined) {
					this.css(name + '-height', value.height);
				}
			} else {
				width = this.css(name + '-width');
				height = this.css(name + '-height');
				// Apparently:
				//  * Opera returns -1px instead of none
				//  * IE6 returns undefined instead of none
				return {'width': (name === 'max' && (width === undefined || width === 'none' || num(width) === -1) && Number.MAX_VALUE) || num(width),
					'height': (name === 'max' && (height === undefined || height === 'none' || num(height) === -1) && Number.MAX_VALUE) || num(height)};
			}
			return this;
		};
	});

	/**
	 * Returns whether or not an element is visible.
	 */
	$.fn.isVisible = function () {
		return this.is(':visible');
	};

	/**
	 * Sets or gets the values for border, margin and padding.
	 */
	$.each(['border', 'margin', 'padding'], function (i, name) {
		$.fn[name] = function (value) {
			if (value) {
				if (value.top !== undefined) {
					this.css(name + '-top' + (name === 'border' ? '-width' : ''), value.top);
				}
				if (value.bottom !== undefined) {
					this.css(name + '-bottom' + (name === 'border' ? '-width' : ''), value.bottom);
				}
				if (value.left !== undefined) {
					this.css(name + '-left' + (name === 'border' ? '-width' : ''), value.left);
				}
				if (value.right !== undefined) {
					this.css(name + '-right' + (name === 'border' ? '-width' : ''), value.right);
				}
			} else {
				return {top: num(this.css(name + '-top' + (name === 'border' ? '-width' : ''))),
					bottom: num(this.css(name + '-bottom' + (name === 'border' ? '-width' : ''))),
					left: num(this.css(name + '-left' + (name === 'border' ? '-width' : ''))),
					right: num(this.css(name + '-right' + (name === 'border' ? '-width' : '')))};
			}
			return this;
		};
	});
}(jQuery));

/*--------------------------------------------------------------
 Custom js
 --------------------------------------------------------------*/
jQuery( document ).ready( function( $ ) {
	'use strict';

var $window = $( window );
var $html = $( 'html' );
var $body = $( 'body' );
var $pageWrapper = $( '#page' );
var $pageHeader = $( '#page-header' );
var $headerInner = $( '#page-header-inner' );
var $pageContent = $( '#page-content' );
var headerStickyEnable = $insight.header_sticky_enable;
var headerStickyHeight = parseInt( $insight.header_sticky_height );
var wWidth = window.innerWidth;
var animateQueueDelay = 200,
    queueResetDelay;
/**
 * Global ajaxBusy = false
 * Desc: Status of ajax
 */
var ajaxBusy = false;
$( document ).ajaxStart( function() {
	ajaxBusy = true;
} ).ajaxStop( function() {
	ajaxBusy = false;
} );

function processItemQueue( itemQueue, queueDelay, queueTimer, queueResetDelay ) {
	clearTimeout( queueResetDelay );

	queueTimer = window.setInterval( function() {
		if ( itemQueue !== undefined && itemQueue.length ) {
			$( itemQueue.shift() ).addClass( 'animate' );
			processItemQueue();
		} else {
			window.clearInterval( queueTimer );
		}
	}, queueDelay );
}

$( window ).resize( function() {
	wWidth = window.innerWidth;
	calMobileMenuBreakpoint();
	boxedFixVcRow();
	calculateLeftHeaderSize();
	initStickyHeader();
	makeFooterSectionBottomOfPage();
	initFooterParallax();
	mCustomScrollbar();
} );

$( window ).on( 'load', function() {
	$body.addClass( 'loaded' );
	setTimeout( function() {
		$( '#page-preloader' ).remove();
	}, 600 );
} );

calMobileMenuBreakpoint();
boxedFixVcRow();
initStickyHeader();
initPopupSearch();
insightInitSmartmenu();
initMobileMenu();
initOffCanvasMenu();

initBlogFullscreenSlider();
initFullscreenSplitFeaturePage();
singlePortfolioFullscreen();
handlerPageNotFound();
marqueBackground();

calculateLeftHeaderSize();
initAnimationForElements();

insightInitGrid();

$( '.tm-swiper' ).each( function() {
	insightInitSwiper( $( this ) );
} );

$( '.tm-light-gallery' ).each( function() {
	insightInitLightGallery( $( this ) );
} );

setTimeout( function() {
	// Fix animation not showing.
	//$window.trigger( 'resize' );
	navOnePage();
}, 100 );
makeFooterSectionBottomOfPage();
initFooterParallax();
mCustomScrollbar();

// Remove empty p tags form wpautop.
$( 'p:empty' ).remove();

$( '.tm-popup-video' ).each( function() {
	var options = {
		fullScreen: false,
		zoom: false
	};
	$( this ).lightGallery( options );
} );

$( '.counter' ).each( function() {
	$( this ).counterUp( {
		delay: 10,
		time: 1000
	} );
} );

$( '.hover-dir' ).hoverdir( {
	hoverElem: '.post-overlay',
	speed: 500,
	easing: 'cubic-bezier(0.645, 0.045, 0.355, 1)'
} );

initSmoothScrollLinks();

if ( $insight.scroll_top_enable == 1 ) {
	scrollToTop();
}

function mCustomScrollbar() {
	if ( ! $body.hasClass( 'page-template-portfolio-fullscreen-carousel-slider' ) ) {
		return;
	}
	var col_w;
	if ( wWidth > 768 ) {
		col_w = wWidth / 3;
	} else if ( wWidth > 543 ) {
		col_w = wWidth / 2;
	} else {
		col_w = wWidth;
	}
	var scrollWrapper = $( '#tm-m-scrollbar' );
	scrollWrapper.mCustomScrollbar( 'destroy' );
	var height = window.innerHeight;
	var footerWrap = $( '#page-footer-wrapper' );

	if ( $body.hasClass( 'admin-bar' ) ) {
		height -= $( '#wpadminbar' ).outerHeight();
	}

	if ( wWidth > 768 && footerWrap.length > 0 ) {
		height -= footerWrap.outerHeight();
	}

	scrollWrapper.find( '.portfolio-item' ).width( col_w ).height( height );
	scrollWrapper.height( height );

	scrollWrapper.mCustomScrollbar( {
		theme: 'arden',
		axis: 'x',
		autoExpandScrollbar: true,
		mouseWheel: { preventDefault: true },
		scrollButtons: {
			enable: true,
			scrollAmount: col_w,
			scrollType: 'stepped'
		},
		advanced: { autoExpandHorizontalScroll: true }
	} );
}

function initBlogFullscreenSlider() {
	if ( ! $body.hasClass( 'page-template-blog-fullscreen-slider' ) ) {
		return;
	}

	$( '.post-read-more' ).on( 'click', function() {
		$body.addClass( 'go-to-single' );
	} );
}

function marqueBackground() {
	$( '.background-marque' ).each( function() {
		var $el = $( this );
		var x = 0;
		var step = 1;
		var speed = 10;

		if ( $el.hasClass( 'to-left' ) ) {
			step = - 1;
		}

		$el.css( 'background-repeat', 'repeat-x' );

		var loop = setInterval( function() {
			x += step;
			$el.css( 'background-position-x', x + 'px' );
		}, speed );

		if ( $el.data( 'marque-pause-on-hover' ) == true ) {
			$( this ).hover( function() {
				clearInterval( loop );
			}, function() {
				loop = setInterval( function() {
					x += step;
					$el.css( 'background-position-x', x + 'px' );
				}, speed );
			} );
		}
	} );
}

function initSmoothScrollLinks() {
	// Allows for easy implementation of smooth scrolling for buttons.
	$( '.smooth-scroll-link' ).on( 'click', function( e ) {
		var href = $( this ).attr( 'href' );
		var _wWidth = window.innerWidth;
		if ( href.match( /^([.#])(.+)/ ) ) {
			e.preventDefault();
			var offset = 0;

			if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {
				offset += headerStickyHeight;
			}

			// Add offset of admin bar when viewport min-width 600.
			if ( _wWidth > 600 ) {
				var adminBarHeight = $( '#wpadminbar' ).height();
				offset += adminBarHeight;
			}

			$.smoothScroll( {
				offset: - offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear'
			} );
		}
	} );
}

function initFullscreenSplitFeaturePage() {
	if ( $body.hasClass( 'page-template-fullscreen-split-feature' ) ) {
		var _wWidth = window.innerWidth;
		var _wHeight = window.innerHeight;

		var _extraH = 0;
		if ( $body.hasClass( 'admin-bar' ) ) {
			_extraH += 32;
		}
		var fullscreenWrapper = $( '#fullscreen-wrap' );
		fullscreenWrapper.width( _wWidth ).height( _wHeight - _extraH );
		$( window ).resize( function() {
			_wWidth = window.innerWidth;
			_wHeight = window.innerHeight;
			fullscreenWrapper.width( _wWidth ).height( _wHeight - _extraH );
		} )
	}
}

function initAnimationForElements() {
	$( '.tm-animation' ).waypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );
		$( _self ).addClass( 'animate' );
	}, {
		offset: '100%' // triggerOnce: true
	} );
}

function insightInitSmartmenu() {
	var $primaryMenu = $headerInner.find( '#page-navigation' ).find( 'ul' ).first();
	$primaryMenu.smartmenus( {
		subMenusSubOffsetX: - 4,
		subMenusSubOffsetY: 0
	} );

	// Add animation for sub menu.
	$primaryMenu.bind( {
		'show.smapi': function( e, menu ) {
			$( menu ).removeClass( 'hide-animation' ).addClass( 'show-animation' );
		},
		'hide.smapi': function( e, menu ) {
			$( menu ).removeClass( 'show-animation' ).addClass( 'hide-animation' );
		}
	} ).on( 'animationend webkitAnimationEnd oanimationend MSAnimationEnd', 'ul', function( e ) {
		$( this ).removeClass( 'show-animation hide-animation' );
		e.stopPropagation();
	} );
}

function insightInitLightGallery( $gallery ) {
	var _download   = (
		    $insight.light_gallery_download === '1'
	    ),
	    _autoPlay   = (
		    $insight.light_gallery_auto_play === '1'
	    ),
	    _zoom       = (
		    $insight.light_gallery_zoom === '1'
	    ),
	    _fullScreen = (
		    $insight.light_gallery_full_screen === '1'
	    ),
	    _thumbnail  = (
		    $insight.light_gallery_thumbnail === '1'
	    );

	var options = {
		selector: '.zoom',
		thumbnail: _thumbnail,
		download: _download,
		autoplay: _autoPlay,
		zoom: _zoom,
		fullScreen: _fullScreen,
		animateThumb: false,
		showThumbByDefault: false,
		getCaptionFromTitleOrAlt: false
	};

	$gallery.lightGallery( options );
}

function insightInitSwiper( $slider ) {
	var $sliderContainer = $slider.children( '.swiper-container' ).first();
	var lgItems = $slider.data( 'lg-items' ) ? $slider.data( 'lg-items' ) : 1;
	var mdItems = $slider.data( 'md-items' ) ? $slider.data( 'md-items' ) : lgItems;
	var smItems = $slider.data( 'sm-items' ) ? $slider.data( 'sm-items' ) : mdItems;
	var xsItems = $slider.data( 'xs-items' ) ? $slider.data( 'xs-items' ) : smItems;

	var lgGutter = $slider.data( 'lg-gutter' ) ? $slider.data( 'lg-gutter' ) : 0;
	var mdGutter = $slider.data( 'md-gutter' ) ? $slider.data( 'md-gutter' ) : lgGutter;
	var smGutter = $slider.data( 'sm-gutter' ) ? $slider.data( 'sm-gutter' ) : mdGutter;
	var xsGutter = $slider.data( 'xs-gutter' ) ? $slider.data( 'xs-gutter' ) : smGutter;

	var vertical = $slider.data( 'vertical' );
	var loop = $slider.data( 'loop' );
	var freeMode = $slider.data( 'free-mode' );
	var autoPlay = $slider.data( 'autoplay' );
	var nav = $slider.data( 'nav' );
	var pagination = $slider.data( 'pagination' );
	var mouseWheel = $slider.data( 'mousewheel' );
	var effect = $slider.data( 'effect' );

	var options = {
		slidesPerView: lgItems,
		spaceBetween: lgGutter,
		breakpoints: {
			// when window width is <=
			767: {
				slidesPerView: xsItems,
				spaceBetween: xsGutter
			},
			990: {
				slidesPerView: smItems,
				spaceBetween: smGutter
			},
			1199: {
				slidesPerView: mdItems,
				spaceBetween: mdGutter
			}
		}
	};

	// Maybe: fade, flip
	if ( effect ) {
		options.effect = effect;
	}

	if ( loop ) {
		options.loop = true;
	}

	if ( freeMode ) {
		options.freeMode = true;
	}

	if ( autoPlay ) {
		options.autoplay = autoPlay;
		options.autoplayDisableOnInteraction = false;
	}

	if ( nav ) {
		options.prevButton = $slider.children( '.swiper-button-prev' );
		options.nextButton = $slider.children( '.swiper-button-next' );
	}

	if ( pagination ) {
		var $swiperPagination = $slider.children( '.swiper-pagination' );
		options.pagination = $swiperPagination;
		options.paginationClickable = true;
		options.onPaginationRendered = function( swiper ) {
			var total = swiper.slides.length;
			if ( total <= options.slidesPerView ) {
				$swiperPagination.hide();
			} else {
				$swiperPagination.show();
			}
		};
	}

	if ( mouseWheel ) {
		options.mousewheelControl = true;
	}

	if ( vertical ) {
		options.direction = 'vertical'
	}

	var $swiper = new Swiper( $sliderContainer, options );
}

function animateMagicLineOnScroll( $li, $magicLine, onScroll, id ) {
	if ( onScroll == false ) {
		$li.each( function() {
			var link = $( this ).children( 'a[href*="#"]:not([href="#"])' );
			if ( link.attr( 'href' ) == id ) {

				if ( $magicLine ) {
					var left = $( this ).position().left + link.padding().left;
					var width = link.width();
					$magicLine.stop().animate( {
						left: left,
						width: width
					} );
					$magicLine
						.attr( 'data-left', left )
						.attr( 'data-width', width );
				}

				$( this ).siblings( 'li' ).removeClass( 'current-menu-item' );
				$( this ).addClass( 'current-menu-item' );

				return true;
			}
		} );
	}
}

function navOnePage() {
	if ( ! $body.hasClass( 'one-page' ) ) {
		return;
	}
	var $header = $( '#page-header' );
	var $headerInner = $header.children( '#page-header-inner' );
	var isMagicLine = $headerInner.data( 'magic-line' );
	var $el,
	    newWidth,
	    $mainNav = $( '#page-navigation' ).find( '.menu__container' ).first();
	var $li = $mainNav.children( '.menu-item' );
	var $links = $li.children( 'a[href^="#"]:not([href="#"])' );
	var onScroll = false;
	var $magicLine;

	if ( isMagicLine ) {
		$mainNav.append( '<li id="magic-line"></li>' );
		$magicLine = $( '#magic-line' );
	}

	$li.each( function() {
		var link = $( this ).children( 'a[href^="#"]:not([href="#"])' );

		if ( link.length > 0 ) {
			var id = link.attr( 'href' );
			if ( $( id ).length > 0 ) {
				$( id ).waypoint( function( direction ) {
					if ( direction === 'down' ) {
						animateMagicLineOnScroll( $li, $magicLine, onScroll, id );
					}
				}, {
					offset: '25%'
				} );

				$( id ).waypoint( function( direction ) {
					if ( direction === 'up' ) {
						animateMagicLineOnScroll( $li, $magicLine, onScroll, id );
					}
				}, {
					offset: '-25%'
				} );
			}
		}
	} );

	if ( $magicLine ) {
		$li.hover( function() {
			$el = $( this );

			var link = $el.children( 'a' );
			var left = $( this ).position().left + link.padding().left;
			newWidth = $el.children( 'a' ).width();
			$magicLine.stop().animate( {
				left: left,
				width: newWidth
			} );
		}, function() {
			if ( ! $( this ).hasClass( 'current-menu-item' ) ) {
				$magicLine.stop().animate( {
					left: $magicLine.attr( 'data-left' ),
					width: $magicLine.attr( 'data-width' )
				} );
			}
		} );
	}

	// Allows for easy implementation of smooth scrolling for navigation links.
	$links.on( 'click', function() {
		var $this = $( this );
		var href = $( this ).attr( 'href' );
		var offset = 0;

		if ( $body.hasClass( 'admin-bar' ) ) {
			offset += 32;
		}

		if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
			offset += headerStickyHeight;
			offset = - offset;
		}

		var parent = $this.parent( 'li' );

		if ( $magicLine ) {
			var left = parent.position().left + $this.padding().left;
			$magicLine.attr( 'data-left', left )
			          .attr( 'data-width', $this.width() );
		}

		parent.siblings( 'li' ).removeClass( 'current-menu-item' );
		parent.addClass( 'current-menu-item' );

		$.smoothScroll( {
			offset: offset,
			scrollTarget: $( href ),
			speed: 600,
			easing: 'linear',
			beforeScroll: function() {
				onScroll = true;
			},
			afterScroll: function() {
				onScroll = false;
			}
		} );
		return false;
	} );
}

function makeFooterSectionBottomOfPage() {
	if ( $insight.footer_effect !== 'always_bottom' || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}
	var footerWrap = $( '#page-footer-wrapper' );
	if ( footerWrap.length > 0 ) {
		var fwHeight = footerWrap.height();
		if ( wWidth >= 1024 ) {
			$body.addClass( 'footer-always-bottom' );
			$pageWrapper.css( {
				paddingBottom: fwHeight
			} );
		} else {
			$body.removeClass( 'footer-always-bottom' );
			$pageWrapper.css( {
				paddingBottom: 0
			} );
		}
	}
}

function initFooterParallax() {
	if ( $insight.footer_effect !== 'parallax' || $body.hasClass( 'page-template-one-page-scroll' ) ) {
		return;
	}
	var footerWrap = $( '#page-footer-wrapper' );
	if ( footerWrap.length > 0 ) {
		var contentWrap = $pageWrapper.children( '.content-wrapper' );
		if ( wWidth >= 1024 ) {
			var fwHeight = footerWrap.height();
			$body.addClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: fwHeight
			} );
		} else {
			$body.removeClass( 'page-footer-parallax' );
			contentWrap.css( {
				marginBottom: 0
			} );
		}
	}
}

function scrollToTop() {
	var $window = $( window );
	// Scroll up
	var $scrollup = $( '.scrollup' );
	var $scrollupFixed = $( '.scrollup--fixed' );

	$window.scroll( function() {
		if ( $window.scrollTop() > 100 ) {
			$scrollupFixed.addClass( 'show' );
		} else {
			$scrollupFixed.removeClass( 'show' );
		}
	} );

	$scrollup.on( 'click', function( evt ) {
		$( 'html, body' ).animate( { scrollTop: 0 }, 600 );
		evt.preventDefault();
	} );
}

function openMobileMenu() {
	$body.addClass( 'page-mobile-menu-opened' );
}

function closeMobileMenu() {
	$body.removeClass( 'page-mobile-menu-opened' );
}

function calMobileMenuBreakpoint() {
	var _breakpoint = $insight.mobile_menu_breakpoint;
	if ( wWidth <= _breakpoint ) {
		$body.removeClass( 'desktop-menu' ).addClass( 'mobile-menu' );
	} else {
		$body.addClass( 'desktop-menu' ).removeClass( 'mobile-menu' );
	}
}

function initMobileMenu() {
	$( '#page-open-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		openMobileMenu();
	} );

	$( '#page-close-mobile-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		closeMobileMenu();
	} );

	var menu = $( '#mobile-menu-primary' );

	var toggleSeparate = false;

	if ( $body.hasClass( 'mobile-menu-separate-toggle' ) ) {
		toggleSeparate = true;
	}

	if ( toggleSeparate == true ) {
		menu.on( 'click', '.toggle-sub-menu', function( e ) {
			var _li = $( this ).parents( 'li' ).first();
			var href = _li.children( 'a' ).attr( 'href' );

			handlerMobileMenu( _li, href, e );
		} );
	} else {
		menu.on( 'click', 'a', function( e ) {
			var $this = $( this );
			var _li = $( this ).parent( 'li' );
			var href = $this.attr( 'href' );

			handlerMobileMenu( _li, href, e );
		} );
	}
}

function handlerMobileMenu( _li, href, e ) {
	if ( $body.hasClass( 'one-page' ) && href && href.match( /^([.#])(.+)/ ) ) {
		closeMobileMenu();
		var offset = 0;

		if ( $body.hasClass( 'admin-bar' ) ) {
			offset += 32;
		}

		if ( headerStickyEnable == 1 && $headerInner.data( 'sticky' ) == '1' ) {
			offset += headerStickyHeight;
		}

		if ( offset > 0 ) {
			offset = - offset;
		}

		_li.siblings( 'li' ).removeClass( 'current-menu-item' );
		_li.addClass( 'current-menu-item' );

		setTimeout( function() {
			$.smoothScroll( {
				offset: offset,
				scrollTarget: $( href ),
				speed: 600,
				easing: 'linear'
			} );
		}, 300 );

		return false;
	}

	if ( _li.hasClass( 'menu-item-has-children' ) ) {
		e.preventDefault();
		e.stopPropagation();
		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			var _parent = _li.parent( 'ul' );

			// If level 1 clicked, slide up other items.
			if ( ! _parent.hasClass( 'sub-menu' ) ) {
				var li_opened = _li.siblings( '.opened' );
				li_opened.removeClass( 'opened' );
				li_opened.find( '.opened' ).removeClass( 'opened' );
				li_opened.find( '.sub-menu' ).stop().slideUp();
			}

			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}
	}
}

function initOffCanvasMenu() {
	$( '#page-open-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'page-off-canvas-menu-opened' );
	} );

	$( '#page-close-main-menu' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.removeClass( 'page-off-canvas-menu-opened' );
	} );

	var menu = $( '#off-canvas-menu-primary' );

	menu.on( 'click', '.menu-item-has-children > a', function( e ) {
		e.preventDefault();
		e.stopPropagation();

		var _li = $( this ).parent( 'li' );

		if ( _li.hasClass( 'opened' ) ) {
			_li.removeClass( 'opened' );
			_li.find( '.opened' ).removeClass( 'opened' );
			_li.find( '.sub-menu' ).stop().slideUp();
		} else {
			var _parent = _li.parent( 'ul' );

			// If level 1 clicked, slide up other items.
			if ( ! _parent.hasClass( 'sub-menu' ) ) {
				var li_opened = _li.siblings( '.opened' );
				li_opened.removeClass( 'opened' );
				li_opened.find( '.opened' ).removeClass( 'opened' );
				li_opened.find( '.sub-menu' ).stop().slideUp();
			}

			_li.addClass( 'opened' );
			_li.children( '.sub-menu' ).stop().slideDown();
		}

	} );
}

function initStickyHeader() {
	if ( $insight.header_sticky_enable == 1 && $pageHeader.length > 0 && $headerInner.data( 'sticky' ) == '1' ) {
		if ( $headerInner.data( 'header-position' ) != 'left' ) {
			var _hOffset = $headerInner.offset().top;
			var _hHeight = $headerInner.outerHeight();
			var offset = _hOffset + _hHeight;

			$pageHeader.headroom( {
				offset: offset,
				onTop: function() {
					if ( ! $body.hasClass( 'page-header-behind' ) ) {
						$pageWrapper.css( {
							paddingTop: 0
						} );
					}
				},
				onNotTop: function() {
					if ( ! $body.hasClass( 'page-header-behind' ) ) {
						$pageWrapper.css( {
							paddingTop: _hHeight + 'px'
						} );
					}
				}
			} );
		} else {
			if ( wWidth < $insight.mobile_menu_breakpoint ) {
				if ( ! $pageHeader.data( 'headroom' ) ) {
					var _hOffset = $headerInner.offset().top;
					var _hHeight = $headerInner.outerHeight();
					var offset = _hOffset + _hHeight;

					$pageHeader.headroom( {
						offset: offset
					} );
				}
			} else {
				if ( $pageHeader.data( 'headroom' ) ) {
					$pageHeader.data( 'headroom' ).destroy();
					$pageHeader.removeData( 'headroom' );
				}
			}
		}
	}
}

function initPopupSearch() {
	var popupSearch = $( '#page-popup-search' );
	var searchField = popupSearch.find( '.search-field' );
	$( '#btn-open-popup-search' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.addClass( 'popup-search-opened' );
		$html.css( {
			'overflow': 'hidden'
		} );
		searchField.val( '' );
		setTimeout( function() {
			searchField.focus();
		}, 500 )
	} );

	$( '#popup-search-close' ).on( 'click', function( e ) {
		e.preventDefault();
		$body.removeClass( 'popup-search-opened' );
		$html.css( {
			'overflow': ''
		} );
	} );

	$( document ).on( 'keyup', function( ev ) {
		// escape key.
		if ( ev.keyCode == 27 ) {
			$body.removeClass( 'popup-search-opened' );
			$html.css( {
				'overflow': ''
			} );
		}
	} );
}

function calculateLeftHeaderSize() {
	if ( $headerInner.data( 'header-position' ) != 'left' ) {
		return;
	}
	var _wWidth = window.innerWidth;
	var _containerWidth = parseInt( $body.data( 'content-width' ) );
	if ( _wWidth <= $insight.mobile_menu_breakpoint ) {
		$body.css( {
			paddingLeft: 0
		} );
	} else {
		var headerWidth = $headerInner.outerWidth();
		$body.css( {
			paddingLeft: headerWidth + 'px'
		} );

		var rows = $( '#page-main-content' ).children( 'article' ).children( '.vc_row' );
		var $contentWidth = $( '#page' ).width();
		rows.each( function() {
			if ( $( this ).attr( 'data-vc-full-width' ) ) {
				var left = 0;
				if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
					left = - (
						(
							$contentWidth - _containerWidth
						) / 2
					) + 'px';
				}
				var width = $contentWidth + 'px';
				$( this ).css( {
					left: left,
					width: width
				} );
				if ( $( this ).attr( 'data-vc-stretch-content' ) ) {

				} else {
					var _padding = 0;
					if ( $contentWidth > $insight.mobile_menu_breakpoint ) {
						_padding = (
							(
								$contentWidth - _containerWidth
							) / 2
						);
					}
					$( this ).css( {
						paddingLeft: _padding,
						paddingRight: _padding
					} );
				}
			}
		} );
	}
}

function boxedFixVcRow() {
	if ( $body.hasClass( 'boxed' ) ) {
		var contentWidth = $( '#page' ).outerWidth();
		$( '#page-content' ).find( '.vc_row' ).each( function() {
			if ( $( this ).data( 'vc-stretch-content' ) == true && $( this )
				.data( 'vc-stretch-content' ) == true ) {
				$( this ).css( {
					left: 0,
					width: contentWidth + 'px'
				} );
			}
		} );
	}
}

function singlePortfolioFullscreen() {
	if ( ! $body.hasClass( 'single-portfolio-style-6' ) ) {
		return;
	}
	var portfolioCanvas = $( '#portfolio-details-canvas' );
	if ( portfolioCanvas.length > 0 ) {
		portfolioCanvas.children( '.btn-open' ).on( 'click', function() {
			portfolioCanvas.toggleClass( 'open' );
		} );
	}

	$( '#return-prev-page' ).on( 'click', function() {
		window.history.back();
	} );
}

function handlerPageNotFound() {
	if ( ! $body.hasClass( 'error404' ) ) {
		return;
	}

	var page = $( '#page .error404' );
	var height = $( window ).height();
	page.css( {
		'min-height': height
	} );
	$( window ).resize( function() {
		height = $( window ).height();
		page.css( {
			'min-height': height
		} );
	} );

	$( '#tm-btn-go-back' ).on( 'click', function() {
		window.history.back();
	} );
}

// Add isotope-hidden class for filtered items.
var itemReveal = Isotope.Item.prototype.reveal;
Isotope.Item.prototype.reveal = function() {
	itemReveal.apply( this, arguments );
	$( this.element ).removeClass( 'isotope-hidden' );
};

var itemHide = Isotope.Item.prototype.hide;
Isotope.Item.prototype.hide = function() {
	itemHide.apply( this, arguments );
	$( this.element ).addClass( 'isotope-hidden' );
};

function insightInitGrid() {
	$( '.tm-grid-wrapper' ).each( function() {
		var $el = $( this );
		var $grid = $el.find( '.tm-grid' );
		var $gridData;
		var $items = $grid.children( '.grid-item' );
		var gutter = $el.data( 'gutter' ) ? $el.data( 'gutter' ) : 0;
		if ( $el.data( 'type' ) == 'masonry' ) {
			var $isotopeOptions = {
				itemSelector: '.grid-item',
				percentPosition: true
			};

			if ( $el.data( 'grid-fitrows' ) ) {
				$isotopeOptions.layoutMode = 'fitRows';
			} else {
				$isotopeOptions.layoutMode = 'packery';
				$isotopeOptions.packery = {
					// Use outer width of grid-sizer for columnWidth.
					columnWidth: '.grid-sizer'
				}
			}

			if ( $isotopeOptions.layoutMode === 'fitRows' ) {
				// Set gutter for fit rows layout.
				$isotopeOptions.fitRows = {};
				$isotopeOptions.fitRows.gutter = gutter;
			} else if ( $isotopeOptions.layoutMode === 'packery' ) {
				$isotopeOptions.packery.gutter = gutter;
			} else {
				// Set gutter for masonry layout.
				$isotopeOptions.masonry.gutter = gutter;
			}

			// Remove default transition if grid has custom animation.
			if ( $grid.hasClass( 'has-animation' ) ) {
				$isotopeOptions.transitionDuration = 0;
			}

			$( window ).smartresize( function() {
				insightGridMasonryCalculateSize( $el, $grid, $isotopeOptions );
			} );

			insightGridMasonryCalculateSize( $el, $grid );

			$gridData = $grid.imagesLoaded( function() {
				// init Isotope after all images have loaded
				$grid.isotope( $isotopeOptions );

				if ( $el.data( 'match-height' ) ) {
					$items.matchHeight();
				}
			} );

			$gridData.one( 'arrangeComplete', function() {
				insightInitGridAnimation( $grid, $items );
				insightGridFilterCount( $el, $grid );
			} );
		} else if ( $el.data( 'type' ) == 'justified' ) {
			var jRowHeight = $el.data( 'justified-height' ) ? $el.data( 'justified-height' ) : 300;
			var jMaxRowHeight = $el.data( 'justified-max-height' ) ? $el.data( 'justified-max-height' ) : 0;
			var jLastRow = $el.data( 'justified-last-row' ) ? $el.data( 'justified-last-row' ) : 'justify';
			var $justifiedOptions = {
				rowHeight: jRowHeight,
				margins: gutter,
				border: 0,
				lastRow: jLastRow
			};

			if ( jMaxRowHeight && jMaxRowHeight > 0 ) {
				$justifiedOptions.maxRowHeight = jMaxRowHeight;
			}

			$grid.justifiedGallery( $justifiedOptions );
			insightGridFilterCount( $el, $grid );
			insightInitGridAnimation( $grid, $items );
		} else {
			insightGridFilterCount( $el, $grid );
			insightInitGridAnimation( $grid, $items );
		}

		insightGridFilterHandler( $el, $grid );
		insightInitGridOverlay( $grid, $items );

		if ( $el.data( 'pagination' ) == 'loadmore' ) {
			$el.children( '.tm-grid-pagination' ).find( '.tm-grid-loadmore-btn' ).on( 'click', function( e ) {
				e.preventDefault();

				if ( ! ajaxBusy ) {
					$( this ).hide();
					var query = $el.find( '.tm-grid-query' ).first().val();
					query = jQuery.parseJSON( query );
					var extra = {};
					if ( $el.hasClass( 'tm-blog' ) ) {
						extra.action = 'post_infinite_load';
					} else if ( $el.hasClass( 'tm-portfolio' ) ) {
						extra.action = 'portfolio_infinite_load';
					} else if ( $el.hasClass( 'tm-product' ) ) {
						extra.action = 'product_infinite_load';
					}
					insightInfiniteQuery( $el, $grid, query, extra );
				}
			} );
		} else if ( $el.data( 'pagination' ) == 'infinite' ) {
			$( '.tm-grid-pagination', $el ).waypoint( function( direction ) {
				if ( direction === 'down' && ! ajaxBusy ) {
					var query = $el.find( '.tm-grid-query' ).first().val();
					query = jQuery.parseJSON( query );
					var extra = {};
					if ( $el.hasClass( 'tm-blog' ) ) {
						extra.action = 'post_infinite_load';
					} else if ( $el.hasClass( 'tm-portfolio' ) ) {
						extra.action = 'portfolio_infinite_load';
					} else if ( $el.hasClass( 'tm-product' ) ) {
						extra.action = 'product_infinite_load';
					}
					insightInfiniteQuery( $el, $grid, query, extra );
				}
			}, {
				offset: '100%'
			} )
		}
	} );
}

/**
 * Calculate size for grid classic + masonry.
 */
function insightGridMasonryCalculateSize( $el, $grid, $isotopeOptions ) {
	var windowWidth = $( window ).width();
	var $column = 1;
	var lgColumns = $el.data( 'lg-columns' ) ? $el.data( 'lg-columns' ) : 1;
	var mdColumns = $el.data( 'md-columns' ) ? $el.data( 'md-columns' ) : lgColumns;
	var smColumns = $el.data( 'sm-columns' ) ? $el.data( 'sm-columns' ) : mdColumns;
	var xsColumns = $el.data( 'xs-columns' ) ? $el.data( 'xs-columns' ) : smColumns;
	if ( windowWidth >= 1200 ) {
		$column = lgColumns;
	} else if ( windowWidth >= 961 ) {
		$column = mdColumns;
	} else if ( windowWidth >= 641 ) {
		$column = smColumns;
	} else {
		$column = xsColumns;
	}

	var $gridWidth = $grid[ 0 ].getBoundingClientRect().width;
	var $gutter = $el.data( 'gutter' ) ? $el.data( 'gutter' ) : 0;

	var $totalGutter = (
		                   $column - 1
	                   ) * $gutter;

	var $columnWidth = (
		                   $gridWidth - $totalGutter
	                   ) / $column;

	$columnWidth = Math.floor( $columnWidth );

	if ( $column > 1 ) {
		var $columnWidth2 = $columnWidth * 2 + $gutter;
	} else {
		var $columnWidth2 = $columnWidth;
	}

	$grid.children( '.grid-sizer' ).css( {
		'width': $columnWidth + 'px'
	} );

	$grid.children( '.grid-item' ).each( function() {
		if ( $( this ).data( 'width' ) == '2' ) {
			$( this ).css( {
				'width': $columnWidth2 + 'px'
			} );
		} else {
			$( this ).css( {
				'width': $columnWidth + 'px'
			} );
		}
		if ( $el.data( 'grid-metro' ) == 2 ) {
			if ( $( this ).data( 'height' ) == '2' ) {
				$( this ).css( {
					'height': $columnWidth2 + 'px'
				} );
			} else {
				$( this ).css( {
					'height': $columnWidth + 'px'
				} );
			}
		}
	} );

	if ( $isotopeOptions ) {
		$grid.isotope( 'layout', $isotopeOptions );
	}
}

/**
 * Load post infinity from db.
 */
function insightInfiniteQuery( $wrapper, $grid, query, extra ) {
	var loader = $wrapper.children( '.tm-grid-pagination' ).find( '.tm-loader' );
	loader.css( {
		'display': 'inline-block'
	} );
	setTimeout( function() {
		query.paged ++;
		$wrapper.find( '.tm-grid-query' ).first().val( JSON.stringify( query ) );
		var data = $.param( query );
		data += '&action=' + extra.action;
		$.ajax( {
			url: $insight.ajaxurl,
			type: 'POST',
			data: data,
			success: function( html ) {
				var $items = $( html );

				if ( $wrapper.data( 'type' ) == 'masonry' ) {
					$grid.isotope()
					     .append( $items )
					     .isotope( 'appended', $items )
					     .imagesLoaded()
					     .always( function() {
						     $grid.isotope( 'layout' );
						     // Re run match height for all items.
						     if ( $wrapper.data( 'match-height' ) ) {
							     $grid.children( '.grid-item' ).matchHeight();
						     }
					     } );
					insightGridFilterCount( $wrapper, $grid );
					insightGridMasonryCalculateSize( $wrapper, $grid );
				} else if ( $wrapper.data( 'type' ) == 'swiper' ) {
					var $slider = $wrapper.find( '.swiper-container' )[ 0 ].swiper;
					$slider.appendSlide( $items );
					$slider.update();
				} else if ( $wrapper.data( 'type' ) == 'justified' ) {
					$grid.append( html );
					$grid.justifiedGallery( 'norewind' );
				} else {
					$grid.append( $items );
				}
				insightInitGridAnimation( $grid, $items );
				insightInitGalleryForNewItems( $grid, $items );
				insightInitGridOverlay( $grid, $items );
				insightHidePaginationIfEnd( $wrapper, query );

				loader.hide();
			},
			error: function( errorThrown ) {
				alert( errorThrown );
			}
		} );
	}, 500 );
}

/**
 * Init slider if grid item has post gallery format
 *
 * @param $grid
 * @param $items
 */
function insightInitGalleryForNewItems( $grid, $items ) {
	if ( $grid.data( 'grid-has-gallery' ) == true ) {
		$items.each( function() {
			if ( $( this ).hasClass( 'format-gallery' ) ) {
				var $slider = $( this ).children( '.post-gallery' );
				insightInitSwiper( $slider );
			}
		} );
	}
}

/**
 * Remove pagination if has no posts anymore
 *
 * @param $el
 * @param query
 *
 */
function insightHidePaginationIfEnd( $el, query ) {
	if ( query.found_posts <= (
		query.paged * query.posts_per_page
	) ) {
		$el.children( '.tm-grid-pagination' ).remove();
		$el.children( '.tm-grid-messages' ).show( 1 );
		setTimeout( function() {
			$el.children( '.tm-grid-messages' ).remove();
		}, 5000 );
	} else {
		$el.children( '.tm-grid-pagination' ).find( '.tm-grid-loadmore-btn' ).show();
	}
}

/**
 * Update counter for grid filters
 *
 * @param $el
 * @param $grid
 */
function insightGridFilterCount( $el, $grid ) {
	if ( $el.children( '.tm-filter-button-group' ).data( 'filter-counter' ) == true ) {
		var $gridItems = $grid.children( '.grid-item' );
		var $gridTotal = $gridItems.length;
		$el.find( '.btn-filter' ).each( function() {
			var filter = $( this ).data( 'filter' );
			var count = 0;
			if ( filter == '*' ) {
				if ( $( this ).children( '.filter-counter' ).length > 0 ) {
					$( this ).children( '.filter-counter' ).text( $gridTotal );
				} else {
					$( this ).append( '<span class="filter-counter">' + $gridTotal + '</span>' );
				}
			} else {
				filter = filter.replace( '.', '' );
				$gridItems.each( function() {
					if ( $( this ).hasClass( filter ) ) {
						count ++;
					}
				} );
				if ( $( this ).children( '.filter-counter' ).length > 0 ) {
					$( this ).children( '.filter-counter' ).text( count );
				} else {
					$( this ).append( '<span class="filter-counter">' + count + '</span>' );
				}
			}
		} );
	}
}

function insightGridFilterHandler( $el, $grid ) {
	$el.children( '.tm-filter-button-group' ).on( 'click', '.btn-filter', function() {
		if ( ! $( this ).hasClass( 'current' ) ) {
			var filterValue = $( this ).attr( 'data-filter' );
			if ( $el.data( 'type' ) == 'masonry' ) {
				$grid.children( '.grid-item' ).each( function() {
					$( this ).removeClass( 'animate' );
				} );
				$grid.isotope( {
					filter: filterValue
				} );

				if ( $grid.hasClass( 'has-animation' ) ) {
					$grid.children( '.grid-item:not(.isotope-hidden)' ).each( function() {
						$( this ).addClass( 'animate' );
					} );
				}
			} else if ( $el.data( 'type' ) == 'swiper' ) {
				filterValue = filterValue.replace( '.', '' );
				$grid.children( '.grid-item' ).each( function() {
					if ( filterValue == '*' ) {
						$( this ).show();
						$( this ).addClass( 'animate' );
					} else {
						if ( ! $( this ).hasClass( filterValue ) ) {
							$( this ).hide();
						} else {
							$( this ).show();
							$( this ).addClass( 'animate' );
						}
					}
				} );
				var $slider = $el.children( '.tm-swiper' ).children( '.swiper-container' )[ 0 ].swiper;
				$slider.update();
				$slider.slideTo( 0 );
			} else if ( $el.data( 'type' ) == 'justified' ) {
				if ( filterValue == '*' ) {
					$grid.justifiedGallery( { filter: false } );
				} else {
					$grid.justifiedGallery( { filter: filterValue } );
				}
			}

			$( this ).siblings().removeClass( 'current' );
			$( this ).addClass( 'current' );

			// Fix .tm-animation not showing after filter.
			$( window ).trigger( 'resize' );
		}
	} );
}

function insightInitGridAnimation( $grid, $items ) {
	if ( ! $grid.hasClass( 'has-animation' ) ) {
		return;
	}

	var itemQueue  = [],
	    queueDelay = animateQueueDelay,
	    queueTimer;

	$items.waypoint( function() {
		// Fix for different ver of waypoints plugin.
		var _self = this.element ? this.element : $( this );

		itemQueue.push( _self );
		processItemQueue( itemQueue, queueDelay, queueTimer );
		queueDelay += 250;

		queueResetDelay = setTimeout( function() {
			queueDelay = animateQueueDelay;
		}, animateQueueDelay );
	}, {
		offset: '90%',
		triggerOnce: true
	} );
}

function insightInitGridOverlay( $grid, $items ) {
	if ( $grid.data( 'overlay-animation' ) == 'hover-dir' ) {
		$items.hoverdir( {
			hoverElem: '.post-overlay',
			speed: 500,
			easing: 'cubic-bezier(0.645, 0.045, 0.355, 1)'
		} );
	}
}

});

(
	function( $ ) {
		'use strict';
		$( document ).on( 'click', '.sl-button', function() {
			var button    = $( this );
			var post_id   = button.attr( 'data-post-id' );
			var security  = button.attr( 'data-nonce' );
			var isComment = button.attr( 'data-iscomment' );
			var allButtons;
			if ( isComment === '1' ) { /* Comments can have same id */
				allButtons = $( '.sl-comment-button-' + post_id );
			} else {
				allButtons = $( '.sl-button-' + post_id );
			}
			var loader = allButtons.next( '.sl-loader' );
			if ( post_id !== '' ) {
				$.ajax( {
							type: 'POST', url: $insight.ajaxurl, data: {
						action: 'process_simple_like', post_id: post_id, nonce: security, is_comment: isComment
					}, beforeSend: function() {
						loader.html( '&nbsp;<div class="loader">Loading...</div>' );
					}, success: function( response ) {
						var icon  = response.icon;
						var count = response.count;
						allButtons.html( icon + count );
						if ( response.status === 'unliked' ) {
							var likeText = $insight.like;
							allButtons.prop( 'title', likeText );
							allButtons.removeClass( 'liked' );
						} else {
							var unLikeText = $insight.unlike;
							allButtons.prop( 'title', unLikeText );
							allButtons.addClass( 'liked' );
						}
						loader.empty();
					}
						} );
			}
			return false;
		} );
	}
)( jQuery );
