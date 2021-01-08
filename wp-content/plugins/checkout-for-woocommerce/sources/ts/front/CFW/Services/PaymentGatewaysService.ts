class PaymentGatewaysService {
    private _selectedGateway: any = false;

    constructor() {
        // This simulates what WooCommerce core does
        jQuery( document.body ).on( 'click', 'input[name="payment_method"]', () => {
            this.paymentGatewayChangeHandler();
        } );

        this.initSelectedPaymentGateway();
    }

    /**
     * Find the selected payment gateway and trigger a click
     *
     * Some gateways look for a click action to init themselves properly
     */
    initSelectedPaymentGateway() {
        const paymentMethods = jQuery( '.woocommerce-checkout' ).find( 'input[name="payment_method"]' );

        // If there is one method, we can hide the radio input
        if ( paymentMethods.length === 1 ) {
            paymentMethods.eq( 0 ).hide();
        }

        // If there was a previously selected method, check that one.
        if ( this._selectedGateway !== false ) {
            jQuery( `#${this._selectedGateway}` ).prop( 'checked', true );
        }

        // If there are none selected, select the first.
        if ( paymentMethods.filter( ':checked' ).length === 0 ) {
            paymentMethods.eq( 0 ).prop( 'checked', true );
        }

        // Get name of new selected method.
        const checkedPaymentMethod = paymentMethods.filter( ':checked' ).eq( 0 ).prop( 'id' );

        if ( paymentMethods.length > 1 ) {
            // Hide open descriptions.
            jQuery( `div.payment_box:not(".${checkedPaymentMethod}")` ).filter( ':visible' ).slideUp( 0 );
        }

        // Trigger click event for selected method
        paymentMethods.filter( ':checked' ).eq( 0 ).trigger( 'click' );
    }

    paymentGatewayChangeHandler() {
        const selectedPaymentMethod = jQuery( '.woocommerce-checkout input[name="payment_method"]:checked' ).attr( 'id' );

        if ( selectedPaymentMethod !== this._selectedGateway ) {
            jQuery( document.body ).trigger( 'payment_method_selected' );
        }

        this._selectedGateway = selectedPaymentMethod;
    }
}

export default PaymentGatewaysService;
