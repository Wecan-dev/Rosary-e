import Main          from '../../Main';
import Compatibility from '../Compatibility';

class SkyVergeCheckoutAddons extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'SkyVergeCheckoutAddons' );
    }

    load( main: Main ): void {
        jQuery( document.body ).on( 'cfw_updated_checkout', () => {
            // Force updated_checkout when this plugin is active
            main.updateCheckoutService.forceUpdatedCheckout = true;
        } );
    }
}

export default SkyVergeCheckoutAddons;
