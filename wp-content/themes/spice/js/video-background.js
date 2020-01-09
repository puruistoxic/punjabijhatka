/* ----- Custom Video BG ------------- */
(function($){

var $spice_video_section = $('.spice_section_video_bg');

function spice_resize_section_video_bg( $video ) 
{

	$element = typeof $video !== 'undefined' ? $video.closest( '.spice_section_video_bg' ) : $( '.spice_section_video_bg' );

	
	$element.each( function() {
		var $this_el = $(this),
			ratio = ( typeof $this_el.attr( 'data-ratio' ) !== 'undefined' )
				? $this_el.attr( 'data-ratio' )
				: $this_el.find('video').attr( 'width' ) / $this_el.find('video').attr( 'height' ),
			$video_elements = $this_el.find( '.mejs-video, video, object' ).css( 'margin', 0 ),
			$container = $this_el.closest( '.spice_section_video_bg' ).length
				? $this_el.closest( '.spice_section_video_bg' )
				: $this_el.closest( '.wrapper' ),
			body_width = $container.width(),
			container_height = $container.innerHeight(),
			width, height;

			//console.log(body_width);

		if ( typeof $this_el.attr( 'data-ratio' ) == 'undefined' )
			$this_el.attr( 'data-ratio', ratio );

		if ( body_width / container_height < ratio ) {
			width = container_height * ratio;
			height = container_height;
		} else 
		{
			width = body_width;
			height = body_width / ratio;			
		}
		//console.log($container);
		$container.innerHeight(height);		
		$video_elements.width( width ).height( height );
	} );
}


function spice_center_video( $video ) 
{	
	$element = typeof $video !== 'undefined' ? $video : $( '.spice_section_video_bg .mejs-video' );

	$element.each( function() 
	{
		var $video_width = $(this).width() / 2;
		var $video_width_negative = 0 - $video_width;
		$(this).css("margin-left",$video_width_negative );

		if ( typeof $video !== 'undefined' ) 
		{
			//if ( $video.closest( '.et_pb_slider' ).length && ! $video.closest( '.et_pb_first_video' ).length )
				//return false;
		}
	} );
	//console.log('center end');
}

function spice_youtube_center($spice_video_section){


	if($spice_video_section.find( '.sharing_frame' ).length){
		
		$youtube_iframe = $spice_video_section.find( '.sharing_frame' );
		$container = $youtube_iframe.closest( '.spice_section_video_bg' ).length ? $youtube_iframe.closest( '.spice_section_video_bg' ) : $youtube_iframe.closest( '.wrapper' );
		body_width = $container.width();
		section_height = $container.height();
		
		$youtube_iframe.each( function($this_idx, $this_el) {
			
			var $this_iframe = $($this_el).find('iframe');
			
			height = $this_iframe.height();
			frame_width = $this_iframe.width();
			
			var ratio = frame_width/height;
			
			
			
			if ( height > section_height ) {
				
				$this_iframe.width(body_width);
				var top = 0-((height - section_height)/2);
				$container.css({'top' : top + 'px'});
				
			} else {
			
				
				$container.css({'top' : 0 + 'px'});
				
				$this_iframe.width(section_height * ratio);
				$this_iframe.height(section_height);
			
			}			
		});	

	}
}


if ( $spice_video_section.length ) {
	$spice_video_section.find( 'video' ).mediaelementplayer( {
		pauseOtherPlayers: false,
		success : function( mediaElement, domObject ) {
			mediaElement.addEventListener( 'loadeddata', function() {
				spice_resize_section_video_bg( $(domObject) );
				spice_center_video( $(domObject) );
			}, false );
			
			mediaElement.addEventListener( 'canplay', function() {
				//console.log($(domObject).closest( '.spice_preload' ));		
				$(domObject).closest( '.spice_preload' ).removeClass( 'spice_preload' );
			}, false );
		}
	} );
	
	if( $spice_video_section.closest( '.spice_preload' ) ) {
		setTimeout( function() {
			$spice_video_section.closest( '.spice_preload' ).removeClass( 'spice_preload' );
		}, 1200 );
	}
	
	spice_youtube_center($spice_video_section);
	
}

$( window ).resize( function(){
	//console.log($spice_video_section);
	spice_resize_section_video_bg();
	spice_center_video();
	
	spice_youtube_center($spice_video_section);
});
		
})(jQuery);