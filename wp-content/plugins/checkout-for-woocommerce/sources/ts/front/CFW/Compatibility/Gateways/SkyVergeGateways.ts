import Main          from '../../Main';
import Compatibility from '../Compatibility';

class SkyVergeGateways extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'SkyVergeGateways' );
    }

    load(): void {
        // Is this a timing issue? Why are the payment fields not set occasionally on the first run of updated_checkout?
        jQuery( document.body ).on( 'cfw_updated_checkout', () => {
            const w = <any>window;
            Object.getOwnPropertyNames( w ).forEach( ( name ) => {
                if ( name.startsWith( 'wc_' ) ) {
                    if ( typeof ( <any>window )[ name ].set_payment_fields !== 'undefined' ) {
                        // eslint-disable-next-line no-console
                        console.log( `SkyVergeGateways: Setting payment fields for ${name}` );
                        ( <any>window )[ name ].set_payment_fields();
                    }
                }
            } );
        } );
    }
}

export default SkyVergeGateways;
