<?php

class WPBakeryShortCode_TM_Gmaps extends WPBakeryShortCode {

	public function convertAttributesToNewMarker( $atts ) {
		if ( isset( $atts['markers'] ) && strlen( $atts['markers'] ) > 0 ) {
			$markers = vc_param_group_parse_atts( $atts['markers'] );

			if ( ! is_array( $markers ) ) {
				$temp         = explode( ',', $atts['markers'] );
				$paramMarkers = array();

				foreach ( $temp as $marker ) {
					$data = explode( '|', $marker );

					$newMarker            = array();
					$newMarker['address'] = isset( $data[0] ) ? $data[0] : '';
					$newMarker['icon']    = isset( $data[1] ) ? $data[1] : '';
					$newMarker['title']   = isset( $data[2] ) ? $data[2] : '';
					$newMarker['info']    = isset( $data[3] ) ? $data[3] : '';

					$paramMarkers[] = $newMarker;
				}

				$atts['markers'] = urlencode( json_encode( $paramMarkers ) );

			}

			return $atts;
		}
	}
}

vc_map( array(
	        'name'        => esc_html__( 'Google Maps', 'tm-arden' ),
	        'base'        => 'tm_gmaps',
	        'icon'        => 'tm-i tm-i-map',
	        'category'    => INSIGHT_VC_SHORTCODE_CATEGORY,
	        'description' => esc_html__( 'Map block', 'tm-arden' ),
	        'params'      => array(
		        array(
			        'heading'     => esc_html__( 'Height', 'tm-arden' ),
			        'description' => esc_html__( 'Enter map height (in pixels or %)', 'tm-arden' ),
			        'type'        => 'textfield',
			        'param_name'  => 'map_height',
			        'value'       => '480',
		        ),
		        array(
			        'heading'     => esc_html__( 'Width', 'tm-arden' ),
			        'description' => esc_html__( 'Enter map width (in pixels or %)', 'tm-arden' ),
			        'type'        => 'textfield',
			        'param_name'  => 'map_width',
			        'value'       => '100%',
		        ),
		        array(
			        'heading'     => esc_html__( 'Zoom level', 'tm-arden' ),
			        'description' => esc_html__( 'Map zoom level', 'tm-arden' ),
			        'type'        => 'number',
			        'param_name'  => 'zoom',
			        'value'       => 16,
			        'max'         => 17,
			        'min'         => 0,
		        ),
		        array(
			        'type'       => 'checkbox',
			        'param_name' => 'zoom_enable',
			        'value'      => array(
				        esc_html__( 'Enable mouse scroll wheel zoom', 'tm-arden' ) => 'yes',
			        ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Map type', 'tm-arden' ),
			        'description' => esc_html__( 'Choose a map type', 'tm-arden' ),
			        'type'        => 'dropdown',
			        'admin_label' => true,
			        'param_name'  => 'map_type',
			        'value'       => array(
				        esc_html__( 'Roadmap', 'tm-arden' )   => 'roadmap',
				        esc_html__( 'Satellite', 'tm-arden' ) => 'satellite',
				        esc_html__( 'Hybrid', 'tm-arden' )    => 'hybrid',
				        esc_html__( 'Terrain', 'tm-arden' )   => 'terrain',
			        ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Map style', 'tm-arden' ),
			        'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules)', 'tm-arden' ),
			        'type'        => 'dropdown',
			        'admin_label' => true,
			        'param_name'  => 'map_style',
			        'value'       => array(
				        esc_html__( 'Default', 'tm-arden' )            => 'default',
				        esc_html__( 'Grayscale', 'tm-arden' )          => 'style1',
				        esc_html__( 'Subtle Grayscale', 'tm-arden' )   => 'style2',
				        esc_html__( 'Apple Maps-esque', 'tm-arden' )   => 'style3',
				        esc_html__( 'Pale Dawn', 'tm-arden' )          => 'style4',
				        esc_html__( 'Muted Blue', 'tm-arden' )         => 'style5',
				        esc_html__( 'Paper', 'tm-arden' )              => 'style6',
				        esc_html__( 'Light Dream', 'tm-arden' )        => 'style7',
				        esc_html__( 'Retro', 'tm-arden' )              => 'style8',
				        esc_html__( 'Avocado World', 'tm-arden' )      => 'style9',
				        esc_html__( 'Facebook', 'tm-arden' )           => 'style10',
				        esc_html__( 'Lunar Landscape', 'tm-arden' )    => 'style11',
				        esc_html__( 'Midnight Commander', 'tm-arden' ) => 'midnight-commander',
				        esc_html__( 'Blue Water', 'tm-arden' )         => 'blue-water',
				        esc_html__( 'Custom', 'tm-arden' )             => 'custom',
			        ),
		        ),
		        array(
			        'type'       => 'checkbox',
			        'param_name' => 'overlay_enable',
			        'value'      => array(
				        esc_html__( 'Use overlay instead of marker items', 'tm-arden' ) => '1',
			        ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Map style snippet', 'tm-arden' ),
			        'description' => sprintf( wp_kses( __( 'To get the style snippet, visit <a href="%s" target="_blank">Sanzzymaps</a> or <a href="%s" target="_blank">Mapstylr</a>.', 'tm-arden' ), array(
				        'a' => array(
					        'href'   => array(),
					        'target' => array(),
				        ),
			        ) ), esc_url( 'https://sanzzymaps.com/' ), esc_url( 'http://www.mapstylr.com/' ) ),
			        'type'        => 'textarea_raw_html',
			        'param_name'  => 'map_style_snippet',
			        'dependency'  => array(
				        'element' => 'map_style',
				        'value'   => 'custom',
			        ),
		        ),
		        array(
			        'group'       => esc_html__( 'Markers', 'tm-arden' ),
			        'heading'     => esc_html__( 'Markers', 'tm-arden' ),
			        'description' => esc_html__( 'You can add multiple markers to the map', 'tm-arden' ),
			        'type'        => 'param_group',
			        'param_name'  => 'markers',
			        'value'       => urlencode( json_encode( array(
				                                                 array(
					                                                 'address' => '40.7590615,-73.969231',
				                                                 ),
			                                                 ) ) ),
			        'params'      => array(
				        array(
					        'heading'     => esc_html__( 'Address or Coordinate', 'tm-arden' ),
					        'description' => sprintf( wp_kses( __( 'Enter address or coordinate. Find coordinates using the name and/or address of the place using <a href="%s" target="_blank">this simple tool here.</a>', 'tm-arden' ), array(
						        'a' => array(
							        'href'   => array(),
							        'target' => array(),
						        ),
					        ) ), esc_url( 'http://universimmedia.pagesperso-orange.fr/geo/loc.htm' ) ),
					        'type'        => 'textfield',
					        'param_name'  => 'address',
					        'admin_label' => true,
				        ),
				        array(
					        'heading'     => esc_html__( 'Marker icon', 'tm-arden' ),
					        'description' => esc_html__( 'Choose a image for marker address', 'tm-arden' ),
					        'type'        => 'attach_image',
					        'param_name'  => 'icon',
				        ),
				        array(
					        'heading'    => esc_html__( 'Marker Title', 'tm-arden' ),
					        'type'       => 'textfield',
					        'param_name' => 'title',
				        ),
				        array(
					        'heading'     => esc_html__( 'Marker Information', 'tm-arden' ),
					        'description' => esc_html__( 'Content for info window', 'tm-arden' ),
					        'type'        => 'textarea',
					        'param_name'  => 'info',
				        ),
			        ),
		        ),
		        array(
			        'heading'     => esc_html__( 'Google Maps API Key (optional)', 'tm-arden' ),
			        'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button. If you leave it empty, the API Key will be put in by default from our key.', 'tm-arden' ), array(
				        'a'      => array(
					        'href'   => array(),
					        'target' => array(),
				        ),
				        'strong' => array(),
			        ) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
			        'type'        => 'textfield',
			        'param_name'  => 'api_key',
		        ),
		        Insight_VC::css_editor_field(),
	        ),
        ) );
