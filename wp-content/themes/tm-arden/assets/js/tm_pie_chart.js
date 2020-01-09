jQuery( function( $ ) {
	'use strict';

	$( '.tm-pie-chart' ).waypoint( function() {
		var size       = $( this ).data( 'size' );
		var lineWidth  = $( this ).data( 'line-width' );
		var trackWidth = $( this ).data( 'track-width' );
		var barColor   = $( this ).data( 'bar-color' );
		var trackColor = $( this ).data( 'track-color' );
		$( this ).find( '.chart' ).easyPieChart( {
													 animate: 5000,
													 easing: 'easeOutElastic',
													 scaleColor: false,
													 barColor: barColor,
													 trackColor: trackColor,
													 lineWidth: lineWidth,
													 trackWidth: trackWidth,
													 size: size,
													 lineCap: 'butt',
													 onStep: function( from, to, percent ) {
														 this.el.children[0].innerHTML = Math.round( percent );
													 }
												 } );
	}, {
									   offset: '100%', triggerOnce: true
								   } );
} );
