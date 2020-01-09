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
