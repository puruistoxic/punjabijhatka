<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $atts ) );

$css_class .= ' ' . $align;
$css_class .= ' ' . $style;

$css_id = uniqid( 'tm-heading-' );
$this->get_inline_css( $css_id );

if ( $style === 'highlight-text' ) {
	wp_enqueue_style( 'playfair-display', INSIGHT_PROTOCOL . '://fonts.googleapis.com/css?family=Playfair+Display:400i', null, null );
} elseif ( $style === 'typed-text' ) {
	wp_enqueue_style( 'playfair-display', INSIGHT_PROTOCOL . '://fonts.googleapis.com/css?family=Playfair+Display:400i', null, null );
	wp_enqueue_script( 'typed' );
}

$css_class .= Insight_Helper::get_animation_classes( $animation );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	$_style   = '';
	$_classes = 'heading';

	if ( $counter === 'true' ) {
		$_classes .= ' counter';
	}

	if ( $text_color === 'primary_color' ) {
		$_classes .= ' primary-color';
	} elseif ( $text_color === 'secondary_color' ) {
		$_classes .= ' secondary-color';
	} elseif ( $text_color === 'custom_color' ) {
		$_style .= 'color: ' . $custom_text_color . ';';
	}

	if ( $custom_google_font === '1' ) {
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		if ( isset( $google_fonts_data['values']['font_family'] ) ) {
			wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
		}

		if ( ! empty( $styles ) ) {
			$_style .= implode( ';', $styles );
		}
	}

	printf( '<%s class="%s" style="%s">%s</%s>', $tag, esc_attr( $_classes ), esc_attr( $_style ), $text, $tag );
	?>
</div>

<?php if ( $style === 'typed-text' ): ?>
	<?php
	$typed_list = (array) vc_param_group_parse_atts( $typed_list );
	$arr        = array();
	if ( count( $typed_list ) > 0 ) {
		foreach ( $typed_list as $item ) {
			if ( isset( $item['text'] ) && $item['text'] !== '' ) {
				$arr[] = $item['text'];
			}
		}
	}
	?>
	<script type="text/javascript">
		jQuery( 'document' ).ready( function( $ ) {
			var id     = '<?php echo "#{$css_id}"; ?>';
			var string = '<?php echo json_encode( $arr ); ?>';
			string     = JSON.parse( string );
			var text   = $( id + ' mark' ).text();
			if ( text !== '' ) {
				string.unshift( text );
			}
			Typed.new( id + ' mark', {
				strings  : string,
				loop     : true,
				typeSpeed: 50,
				backDelay: 1500
			} );
		} );
	</script>
<?php endif; ?>
