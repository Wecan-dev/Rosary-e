import Main                 from '../../Main';
import DataService          from '../../Services/DataService';
import Compatibility        from '../Compatibility';

declare let OffAmazonPayments: any;
// eslint-disable-next-line camelcase
declare let amazon_payments_advanced_params: any;

class AmazonPay extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'AmazonPay' );
    }

    /**
     * Run the compatibility
     *
     * @param main
     */
    load(): void {
        /**
         * If the OffAmazonPayments and amazon_payments_advanced_params exist
         * we can then check to see if there is a reference id set.
         *
         * If not we are not logged in. If there is we are logged in.
         */
        try {
            // eslint-disable-next-line max-len,camelcase
            if ( OffAmazonPayments !== undefined && amazon_payments_advanced_params !== undefined && ( amazon_payments_advanced_params.reference_id !== '' || amazon_payments_advanced_params.access_token !== '' ) ) {
                jQuery( window.document ).on( 'wc_amazon_pa_widget_ready', () => {
                    ( <any>window ).cfw_suppress_js_field_validation = true;
                } );

                jQuery( window.document ).on( 'wc_amazon_pa_widget_ready cfw_updated_checkout', () => {
                    jQuery( '.create-account .cfw-input-wrap' ).addClass( 'cfw-floating-label' );
                } );

                jQuery( window.document ).on( 'wc_amazon_pa_widget_ready', () => {
                    jQuery( '#billing_same_as_shipping_radio' ).remove();
                } );

                if ( DataService.getCheckoutParam( 'option_guest_checkout' ) === 'yes' ) {
                    jQuery( document.body ).on( 'change', 'input#createaccount', this.toggleCreateAccount );
                }

                jQuery( document.body ).on( 'cfw_updated_checkout', () => {
                    jQuery( 'input#createaccount' ).trigger( 'change' );
                } );

                jQuery( window ).on( 'load cfw_updated_checkout', () => {
                    this.cleanUpExtraStuff();
                } );
            }
        } catch ( error ) {
            // eslint-disable-next-line no-console
            console.log( error );
        }
    }

    toggleCreateAccount() {
        const createAccount = jQuery( 'div.create-account' );
        createAccount.hide();

        if ( jQuery( this ).is( ':checked' ) ) {
            // Ensure password is not pre-populated.
            jQuery( '#account_password' ).val( '' ).trigger( 'change' );
            createAccount.slideDown();
        }
    }

    cleanUpExtraStuff() {
        jQuery( '#payment-info-separator-wrap' ).hide();
        jQuery( '#cfw-shipping-same-billing' ).hide();
        jQuery( '#cfw-billing-methods > h3' ).hide();
        jQuery( '#cfw-shipping-info > h3' ).hide();
        jQuery( '#cfw-payment-method > h3' ).hide();
    }
}

export default AmazonPay;
