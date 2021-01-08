import Main          from '../../Main';
import Compatibility from '../Compatibility';

class SquareRecurring extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'SquareRecurring' );
    }

    load( main: Main ): void {
        jQuery( window ).on( 'payment_method_selected cfw_updated_checkout', () => {
            if ( typeof ( <any>jQuery ).WooSquare_payments !== 'undefined' ) {
                ( <any>jQuery ).WooSquare_payments.loadForm();
            }
        } );

        jQuery( document.body ).on( 'cfw-payment-tab-loaded', () => {
            if ( typeof ( <any>jQuery ).WooSquare_payments !== 'undefined' ) {
                ( <any>jQuery ).WooSquare_payments.loadForm();
            }
        } );
    }
}

export default SquareRecurring;
