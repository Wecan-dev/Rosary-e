import UpdatePaymentMethod from '../Actions/UpdatePaymentMethod';
import Main                from '../Main';

class PaymentMethodRadios {
    constructor() {
        PaymentMethodRadios.setPaymentMethodUpdate();
    }

    /**
   * Trigger payment_method_selected
   */
    static setPaymentMethodUpdate(): void {
        jQuery( document.body ).on( 'click', 'input[name^="payment_method"][type="radio"]', function () {
            const placeOrderButton = jQuery( '#place_order' );

            if ( jQuery( this ).data( 'order_button_text' ) ) {
                placeOrderButton.text( jQuery( this ).data( 'order_button_text' ) );
            } else {
                placeOrderButton.text( jQuery( '#place_order' ).data( 'value' ) );
            }

            new UpdatePaymentMethod( 'update_payment_method', Main.instance.ajaxInfo, jQuery( this ).val().toString() ).load();

            jQuery( document.body ).trigger( 'payment_method_selected' );
        } );
    }
}

export default PaymentMethodRadios;
