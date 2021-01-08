import Main          from '../../Main';
import Compatibility from '../Compatibility';

class InpsydePayPalPlus extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'InpsydePayPalPlus' );
    }

    load(): void {
        jQuery( document.body ).on( 'cfw-apply-coupon-complete', () => {
            Main.instance.updateCheckoutService.forceUpdatedCheckout = true;
        } );
    }
}

export default InpsydePayPalPlus;
