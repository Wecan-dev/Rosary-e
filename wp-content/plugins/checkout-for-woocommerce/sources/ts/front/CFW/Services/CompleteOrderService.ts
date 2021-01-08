import CompleteOrderAction from '../Actions/CompleteOrderAction';
import Main                from '../Main';
import DataService         from './DataService';

class CompleteOrderService {
    constructor() {
        this.setCheckoutErrorHandler();
        this.setCompleteOrderListener();
    }

    setCheckoutErrorHandler(): void {
        jQuery( document.body ).on( 'checkout_error', () => {
            jQuery( document.body ).trigger( 'cfw-remove-overlay' );
        } );
    }

    /**
     *
     */
    setCompleteOrderListener(): void {
        const checkoutForm = Main.getCheckoutForm();

        checkoutForm.on( 'submit', this.completeOrderSubmitHandler.bind( this ) );
    }

    /**
     * Kick off complete order
     */
    completeOrderSubmitHandler() {
        const checkoutForm: any = Main.getCheckoutForm();

        // Prevent any update checkout calls from spawning
        Main.instance.updateCheckoutService.resetUpdateCheckoutTimer();

        if ( checkoutForm.is( '.processing' ) ) {
            return false;
        }

        checkoutForm.find( '.woocommerce-error' ).remove();

        // If all the payment stuff has finished any ajax calls, run the complete order.
        // eslint-disable-next-line max-len
        if ( checkoutForm.triggerHandler( 'checkout_place_order' ) !== false && checkoutForm.triggerHandler( `checkout_place_order_${checkoutForm.find( 'input[name="payment_method"]:checked' ).val()}` ) !== false ) {
            checkoutForm.addClass( 'processing' );

            Main.addOverlay();

            new CompleteOrderAction( 'complete_order',  DataService.getAjaxInfo(), Main.getCheckoutForm().serialize() );
        }

        /**
         * Throwing an error here seems to cause situations where the error
         * briefly appears during a successful order
         */
        return false;
    }
}

export default CompleteOrderService;
