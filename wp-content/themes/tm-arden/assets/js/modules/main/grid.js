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
