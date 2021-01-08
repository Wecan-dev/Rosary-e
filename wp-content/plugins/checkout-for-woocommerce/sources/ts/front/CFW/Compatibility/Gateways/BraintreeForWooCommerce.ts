import Main                  from '../../Main';
import UpdateCheckoutService from '../../Services/UpdateCheckoutService';
import Compatibility         from '../Compatibility';

class BraintreeForWooCommerce extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'BraintreeForWooCommerce' );
    }

    load(): void {
        jQuery( document.body ).on( 'click', 'input[name="payment_method"]', () => {
            if ( jQuery( 'input[name="payment_method"]:checked' ).attr( 'id' ) === 'payment_method_braintree_paypal' ) {
                UpdateCheckoutService.triggerUpdatedCheckout();
            }
        } );
    }
}

export default BraintreeForWooCommerce;
