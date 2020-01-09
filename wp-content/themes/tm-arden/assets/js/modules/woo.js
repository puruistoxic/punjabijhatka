jQuery( document ).ready( function( $ ) {

	// Mini Cart.
	var $miniCart = $( '#mini-cart' );
	$miniCart.on( 'click', function( e ) {
		if ( ! SmartPhone.isAny() ) {
			$( this ).addClass( 'open' );
		} else {
			window.location.href = $( this ).data( 'url' );
		}
	} );

	$( document ).on( 'click', function( e ) {
		if ( $( e.target ).closest( $miniCart ).length == 0 ) {
			$miniCart.removeClass( 'open' );
		}
	} );

	/**
	 * WooCommerce Quantity buttons
	 */
	function woocommerceQuantityButtons() {
		$( document ).on( 'click', '.increase, .decrease', function() {

			// Get values
			var $qty = $( this ).siblings( '.qty' ), currentVal = parseFloat( $qty.val() );
			var max  = parseFloat( $qty.attr( 'max' ) );
			var min  = parseFloat( $qty.attr( 'min' ) );
			var step = $qty.attr( 'step' );

			// Format values
			if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
				currentVal = 0;
			}
			if ( max === '' || max === 'NaN' ) {
				max = '';
			}
			if ( min === '' || min === 'NaN' ) {
				min = 0;
			}
			if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
				step = 1;
			}

			// Change the value
			if ( $( this ).is( '.increase' ) ) {

				if ( max && (
						max == currentVal || currentVal > max
					) ) {
					$qty.val( max );
				} else {
					$qty.val( currentVal + parseFloat( step ) );
				}

			} else {

				if ( min && (
						min == currentVal || currentVal < min
					) ) {
					$qty.val( min );
				} else if ( currentVal > 0 ) {
					$qty.val( currentVal - parseFloat( step ) );
				}

			}

			// Trigger change event.
			$qty.trigger( 'change' );
		} );
	}

	woocommerceQuantityButtons();
} );
