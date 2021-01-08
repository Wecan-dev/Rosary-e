import Main          from '../../Main';
import Compatibility from '../Compatibility';

class BlueCheck extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'BlueCheck' );
    }

    load( main: Main ): void {
        jQuery( document ).on( 'cfw_updated_checkout', () => {
            const checkoutForm: any = Main.getCheckoutForm();
            const lookFor: Array<string> = main.settings.default_address_fields;

            if ( checkoutForm.find( 'input[name="bill_to_different_address"]:checked' ).val() === 'same_as_shipping' ) {
                lookFor.forEach( ( field ) => {
                    const billing = jQuery( `#billing_${field}` );
                    const shipping = jQuery( `#shipping_${field}` );

                    if ( billing.length > 0 ) {
                        billing.val( shipping.val() );
                        billing.trigger( 'keyup' );
                    }
                } );
            }
        } );
    }
}

export default BlueCheck;
