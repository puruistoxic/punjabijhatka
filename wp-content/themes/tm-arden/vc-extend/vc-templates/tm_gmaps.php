<?php
/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $map_height
 * @var $map_width
 * @var $zoom
 * @var $zoom_enable
 * @var $map_type
 * @var $map_style
 * @var $map_style_snippet
 * @var $markers
 * @var $api_key
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Thememove_Gmaps
 */
$overlay_enable = '';
$atts           = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts           = $this->convertAttributesToNewMarker( $atts );

extract( $atts );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'tm-gmaps ' . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if ( ! $api_key ) {
	$api_key = Insight::setting( 'google_api_key' );
}

wp_enqueue_script( 'gmap3' );
wp_enqueue_script( 'js-maps', INSIGHT_PROTOCOL . '://maps.google.com/maps/api/js?key=' . $api_key . '&amp;language=en' );

$markers = (array) vc_param_group_parse_atts( $markers );

switch ( $map_style ) {
	case 'style1':
		$map_style_snippet = '[{"featureType":"all","elementType":"all","stylers":[{"saturation":-100},{"gamma":0.5}]}]';
		break;
	case 'style2':
		$map_style_snippet = '[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]';
		break;
	case 'style3':
		$map_style_snippet = '[{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]';
		break;
	case 'style4':
		$map_style_snippet = '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2e5d4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]}]';
		break;
	case 'style5':
		$map_style_snippet = '[{"featureType":"all","stylers":[{"saturation":0},{"hue":"#e7ecf0"}]},{"featureType":"road","stylers":[{"saturation":-70}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"visibility":"simplified"},{"saturation":-60}]}]';
		break;
	case 'style6':
		$map_style_snippet = '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"},{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]}]';
		break;
	case 'style7':
		$map_style_snippet = '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]';
		break;
	case 'style8':
		$map_style_snippet = '[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-17},{"gamma":0.36}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#3f518c"}]}]';
		break;
	case 'style9':
		$map_style_snippet = '[{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#aee2e0"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"color":"#abce83"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#769E72"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#7B8758"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#EBF4A4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#8dab68"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#5B5B3F"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ABCE83"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#A4C67D"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#9BBF72"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#EBF4A4"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#87ae79"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#7f2200"},{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"visibility":"on"},{"weight":4.1}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#495421"}]},{"featureType":"administrative.neighborhood","elementType":"labels","stylers":[{"visibility":"off"}]}]';
		break;
	case 'style10':
		$map_style_snippet = '[{"featureType":"water","elementType":"all","stylers":[{"color":"#3b5998"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"all","stylers":[{"hue":"#3b5998"},{"saturation":-22}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#f7f7f7"},{"saturation":10},{"lightness":76}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"color":"#f7f7f7"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"color":"#8b9dc3"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"},{"color":"#3b5998"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"},{"color":"#8b9dc3"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#8b9dc3"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"invert_lightness":false},{"color":"#ffffff"},{"weight":0.43}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#8b9dc3"}]},{"featureType":"administrative","elementType":"labels.icon","stylers":[{"visibility":"on"},{"color":"#3b5998"}]}]						';
		break;
	case 'style11':
		$map_style_snippet = '[{"stylers": [{"hue": "#ff1a00"},{"invert_lightness": true},{"saturation": -100},{"lightness": 33},{"gamma": 0.5}]},{"featureType": "water","elementType": "geometry","stylers": [{"color": "#2D333C"}]}]';
		break;
	case 'midnight-commander':
		$map_style_snippet = '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#146474"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#021019"}]}]';
		break;
	case 'blue-water':
		$map_style_snippet = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]';
		break;
	default:
		$map_style_snippet = '';
}

$map_style_snippet = json_encode( $map_style_snippet );

$css_id = uniqid( 'tm-map-' );
?>
<div
	class="<?php echo esc_attr( trim( $css_class ) ); ?>"
	id="<?php echo esc_attr( $css_id ); ?>"
	data-height="<?php echo esc_attr( $map_height ); ?>"
	data-width="<?php echo esc_attr( $map_width ); ?>"
	data-zoom_enable="<?php echo esc_attr( $zoom_enable ); ?>"
	data-zoom="<?php echo esc_attr( $zoom ); ?>"
	data-map_type="<?php echo esc_attr( $map_type ); ?>"
	data-map_style="<?php echo esc_attr( $map_style ); ?>"
>
</div>
<script type="text/javascript">
	jQuery( document ).ready( function( $ ) {

		var gmMapDiv = $( "<?php echo '#' . $css_id; ?>" );

		(
			function( $ ) {

				if ( gmMapDiv.length ) {

					var gmHeight     = gmMapDiv.attr( "data-height" );
					var gmWidth      = gmMapDiv.attr( "data-width" );
					var gmZoomEnable = gmMapDiv.attr( "data-zoom_enable" );
					var gmZoom       = gmMapDiv.attr( "data-zoom" );
					gmMapDiv.width( gmWidth ).height( gmHeight );
					gmMapDiv.gmap3( {
						action : "init",
						marker : {
							values: [
								<?php
								foreach ($markers as $marker) {
								$new_marker = $marker;
								$new_marker['address'] = isset( $marker['address'] ) ? $marker['address'] : '';
								$new_marker['info'] = isset( $marker['info'] ) ? '<div class="gmap-marker-content">' . $marker['info'] . '</div>' : '';
								$new_marker['title'] = isset( $marker['title'] ) ? '<h5 class="gmap-marker-title">' . $marker['title'] . '</h5>' : '';
								$new_marker['icon'] = isset( $marker['icon'] ) ? $marker['icon'] : '';

								$_data = "0";
								if ( $new_marker['title'] !== '' || $new_marker['info'] !== '' ) {
									$_data = '<div class="gmap-marker-wrap">' . $new_marker['title'] . $new_marker['info'] . '</div>';
									$_data = json_encode( nl2br( $_data ) );
								}
								?>
								{
									address: "<?php echo esc_js( $new_marker['address'] ); ?>",
									data   : <?php echo $_data;?>,
									options: {
										<?php if (! isset( $new_marker['icon'] ) || $new_marker['icon'] == '') { ?>
										icon: "<?php echo INSIGHT_THEME_URI ?>/assets/images/map_marker.png",
										<?php } else {
										$image_attr = wp_get_attachment_image_src( $new_marker['icon'] );
										if ( $image_attr ) { ?>
										icon: "<?php echo esc_js( $image_attr[0] ); ?>",
										<?php
										}
										}
										?>

										<?php if( $overlay_enable === '1' ): ?>
										visible: false,
										<?php endif; ?>
									}
								},
								<?php } ?>
							],
							events: {
								click: function( marker, event, context ) {
									if ( context.data == 0 ) {
										return;
									}
									var map    = $( this ).gmap3( "get" );
									infowindow = $( this ).gmap3( { get: { name: "infowindow" } } );
									if ( infowindow ) {
										infowindow.open( map, marker );
										infowindow.setContent( context.data );
									} else {
										$( this ).gmap3( {
											infowindow: {
												anchor : marker,
												options: { content: context.data }
											}
										} );
									}
								}
							}

						},
						<?php if( $overlay_enable === '1' ) { ?>
						overlay: {
							values: [
								<?php
								foreach ($markers as $marker) {
								$new_marker = $marker;
								$new_marker['address'] = isset( $marker['address'] ) ? $marker['address'] : '';
								$new_marker['info'] = isset( $marker['info'] ) ? '<div class="gmap-marker-content">' . $marker['info'] . '</div>' : '';
								$new_marker['title'] = isset( $marker['title'] ) ? '<h5 class="gmap-marker-title">' . $marker['title'] . '</h5>' : '';
								$new_marker['icon'] = isset( $marker['icon'] ) ? $marker['icon'] : '';

								$_data = "0";
								if ( $new_marker['title'] !== '' || $new_marker['info'] !== '' ) {
									$_data = '<div class="gmap-marker-wrap">' . $new_marker['title'] . $new_marker['info'] . '</div>';
									$_data = json_encode( nl2br( $_data ) );
								}
								?>
								{
									address: "<?php echo esc_js( $new_marker['address'] ); ?>",
									data   : <?php echo $_data;?>,
									options: {
										content: '<div><div class="animated-dot">' + '<div class="middle-dot"></div>' + '<div class="signal"></div>' + '<div class="signal2"></div>' + '</div></div>',
									}
								},
								<?php } ?>
							],
							events: {
								click: function( overlay, event, context ) {
									if ( context.data == 0 ) {
										return;
									}
									var map    = $( this ).gmap3( "get" );
									infowindow = $( this ).gmap3( { get: { name: "infowindow" } } );
									if ( infowindow ) {
										infowindow.open( map, overlay );
										infowindow.setContent( context.data );
									} else {
										$( this ).gmap3( {
											infowindow: {
												anchor : overlay,
												options: { content: context.data }
											}
										} );
									}
								}
							}
						},
						<?php } ?>
						map    : {
							options: {
								zoom             : parseInt( gmZoom ),
								zoomControl      : true,
								mapTypeId        : <?php echo 'google.maps.MapTypeId.' . strtoupper( $map_type ) ?>,
								mapTypeControl   : false,
								scaleControl     : false,
								scrollwheel      : gmZoomEnable == 'enable' ? true : false,
								streetViewControl: false,
								draggable        : true,
								<?php if ($map_style != 'default') { ?>
								<?php if ($map_style == 'custom') { ?>
								<?php if ($map_style_snippet != '') { ?>
								styles           : <?php echo urldecode( infinity_base_decode( $map_style_snippet ) ); ?>,
								<?php } ?>
								<?php } else { ?>
								styles           : <?php echo json_decode( $map_style_snippet ); ?>,
								<?php } ?>
								<?php } ?>
							}
						}
					} );
				}
			}
		)( jQuery );
	} );
</script>
