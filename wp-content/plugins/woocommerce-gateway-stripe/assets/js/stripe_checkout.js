jQuery( function( $ ) {

	var stripe_submit = false;

	// We need to bind directly to the click (and not checkout_place_order_stripe) to avoid popup blockers
	// especially on mobile devices (like on Chrome for iOS) from blocking StripeCheckout.open from opening a tab
	$( 'form.checkout' ).on( 'click', '#place_order', function( event ) {
		return stripeFormHandler();
	} );

	// WooCommerce lets us return a false on checkout_place_order_{gateway} to keep the form from submitting
	$( 'form.checkout' ).on( 'checkout_place_order_stripe', function() {
		// Stripe submit (i.e. from StripeCheckout.open token callback)?  Go ahead and let the form submit
		// (or at the very least, not block submittal on our account - another gateway might still block it)
		if ( stripe_submit ) {
			return true;
		}

		// Stripe isn't the selected payment method?  Go ahead and let the form submit then too
		// (or at the very least, not block submittal on our account - the other gateway might still block it)
		if ( ! $( '#payment_method_stripe' ).is( ':checked' ) ) {
			return true;
		}

		// Otherwise, always return false - allow the onclick handler, stripeFormHandler, to do its work
		return false;
	} );

	$( 'form#order_review' ).submit( function() {
		return stripeFormHandler();
	});

	function stripeFormHandler() {
		// If this submit is a result of the stripe request callback firing, let submit proceed by returning true immediately
		if ( stripe_submit ) {
			stripe_submit = false;
			return true;
		}

		if ( ! $( '#payment_method_stripe' ).is( ':checked' ) ) {
			return true;
		}

		if ( $( 'input[name=stripe_card_id]' ).length > 0 && $( 'input[name=stripe_card_id]:checked' ).val() !== 'new' ) {
			return true;
		}

		if ( $( 'input#terms' ).size() === 1 && $( 'input#terms:checked' ).size() === 0 ) {
			return true;
		}

		if ( $( '#createaccount' ).is( ':checked' ) && $( '#account_password' ).length && $( '#account_password' ).val() === '' ) {
			return true;
		}
		
		// check to see if we need to validate shipping address
		if ( $( '#ship-to-different-address-checkbox' ).is( ':checked' ) ) {
			$required_inputs = $( '.woocommerce-billing-fields .validate-required, .woocommerce-shipping-fields .validate-required' );
		} else {
			$required_inputs = $( '.woocommerce-billing-fields .validate-required' );
		}

		if ( $required_inputs.size() ) {
			var required_error = false;
			
			$required_inputs.each( function() {
				if ( $( this ).find( 'input.input-text, select' ).not( $( '#account_password, #account_username' ) ).val() === '' ) {
					required_error = true;
				}
			});

			if ( required_error ) {
				return true;
			}
		}

		var $form            = $( 'form.checkout, form#order_review' ),
			$stripe_new_card = $( '.stripe_new_card' ),
			token            = $form.find( 'input.stripe_token' );

		token.val( '' );

		var token_action = function( res ) {
			$form.find( 'input.stripe_token' ).remove();
			$form.append( '<input type="hidden" class="stripe_token" name="stripe_token" value="' + res.id + '"/>' );
			stripe_submit = true;
			$form.submit();
		};

		StripeCheckout.open({
			key:         wc_stripe_params.key,
			address:     false,
			amount:      $stripe_new_card.data( 'amount' ),
			name:        $stripe_new_card.data( 'name' ),
			description: $stripe_new_card.data( 'description' ),
			panelLabel:  $stripe_new_card.data( 'label' ),
			currency:    $stripe_new_card.data( 'currency' ),
			image:       $stripe_new_card.data( 'image' ),
			bitcoin:     $stripe_new_card.data( 'bitcoin' ),
			refund_mispayments: true, // for bitcoin payments let Stripe handle refunds if too little is paid
			email: 		 $( '#billing_email' ).val(),
			token:       token_action
		});

		return false;
	}
});