import Main          from '../../Main';
import Compatibility from '../Compatibility';

class CO2OK extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'CO2OK' );
    }

    load( main: Main ): void {
        jQuery( document.body ).on( 'cfw_updated_checkout', () => {
            jQuery( 'a.co2ok_nolink' ).prop( 'href', '#cfw-payment-method' );
        } );
    }
}

export default CO2OK;
