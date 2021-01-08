import Main          from '../../Main';
import Compatibility from '../Compatibility';

class PayPalCheckout extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'PayPalCheckout' );
    }

    load(): void {
        jQuery( window ).on( 'cfw_updated_checkout', () => {
            const isPPEC = jQuery( 'input[name="payment_method"]:checked' ).is( '#payment_method_ppec_paypal' );
            jQuery( '#place_order' ).toggle( !isPPEC );
            jQuery( '#woo_pp_ec_button_checkout' ).toggle( isPPEC );
        } );
    }
}

export default PayPalCheckout;
