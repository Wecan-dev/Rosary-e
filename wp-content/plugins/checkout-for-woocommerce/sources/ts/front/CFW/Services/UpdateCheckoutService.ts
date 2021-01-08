import UpdateCheckoutAction from '../Actions/UpdateCheckoutAction';
import Main                 from '../Main';
import DataService          from './DataService';

class UpdateCheckoutService {
    /**
     * @type any
     * @private
     */
    private _updateCheckoutTimer: any;

    /**
     * @type {boolean}
     * @private
     */
    private _forceUpdatedCheckout: boolean;

    /**
     * Setup the update checkout triggers
     */
    constructor() {
        this.setUpdateCheckoutTriggers();
    }

    /**
     *
     * @param e
     * @param args
     */
    queueUpdateCheckout( e?, args? ) {
        let code = 0;

        if ( typeof e !== 'undefined' ) {
            code = e.keyCode || e.which || 0;
        }

        if ( code === 9 ) {
            return true;
        }

        this.resetUpdateCheckoutTimer();
        jQuery( document.body ).trigger( 'cfw_queue_update_checkout' );

        this.updateCheckoutTimer = ( <any>window ).setTimeout( this.maybeUpdateCheckout.bind( this ), 1000, args );

        return true;
    }

    /**
     * All update_checkout triggers should happen here
     *
     * Exceptions would be edge cases involving TS compat classes
     */
    setUpdateCheckoutTriggers() {
        const checkoutForm = Main.getCheckoutForm();

        checkoutForm.on( 'change', 'select.shipping_method, input[name^="shipping_method"]', () => {
            jQuery( document.body ).trigger( 'cfw-shipping-method-changed' );
            this.forceUpdatedCheckout = true;
            this.queueUpdateCheckout();
        } );

        jQuery( document.body ).on( 'update_checkout', ( e, args ) => {
            this.queueUpdateCheckout( e, args );
        } );

        // eslint-disable-next-line max-len
        checkoutForm.on( 'change', '[name="bill_to_different_address"], .update_totals_on_change select, .update_totals_on_change input[type="radio"], .update_totals_on_change input[type="checkbox"]', this.queueUpdateCheckout.bind( this ) );
        checkoutForm.on( 'change', '.address-field select', this.queueUpdateCheckout.bind( this ) );
        checkoutForm.on( 'change', '#billing_email', this.queueUpdateCheckout.bind( this ) ); // for the shipping address preview
        checkoutForm.on( 'change', '.address-field input.input-text, .update_totals_on_change input.input-text', this.queueUpdateCheckout.bind( this ) );
        checkoutForm.on( 'change', '#wc_checkout_add_ons :input', this.queueUpdateCheckout.bind( this ) );
    }

    /**
     * reset the update checkout timer (stop iteration)
     */
    resetUpdateCheckoutTimer() {
        clearTimeout( this.updateCheckoutTimer );
    }

    /**
     * Queue up an update_checkout
     */
    maybeUpdateCheckout( args ) {
        // Small timeout to prevent multiple requests when several fields update at the same time
        this.resetUpdateCheckoutTimer();

        this.updateCheckoutTimer = ( <any>window ).setTimeout( this.triggerUpdateCheckout.bind( this ), 5, args );
    }

    /**
     * Call update_checkout
     *
     * This should be the ONLY place we call this ourselves
     */
    triggerUpdateCheckout( args? ) {
        if ( DataService.getSetting( 'is_checkout_pay_page' ) ) {
            return;
        }

        if ( typeof args === 'undefined' ) {
            args = {
                update_shipping_method: true,
            };
        }

        new UpdateCheckoutAction( 'update_checkout', DataService.getAjaxInfo(), Main.getFormObject( 'update_checkout' ), args ).load();
    }

    /**
     * Call updated_checkout
     *
     * This should be the ONLY place we call this ourselves
     */
    static triggerUpdatedCheckout( data? ) {
        if ( typeof data === 'undefined' ) {
            // If this is running in the dark, we need
            // to shim in fragments because some plugins
            // ( like WooCommerce Smart Coupons ) expect it
            // eslint-disable-next-line no-param-reassign
            data = { fragments: {} };
        }

        jQuery( document.body ).trigger( 'updated_checkout', [ data ] );
    }

    /**
     * @returns {boolean}
     */
    get forceUpdatedCheckout(): boolean {
        return this._forceUpdatedCheckout;
    }

    /**
     * @param {boolean} value
     */
    set forceUpdatedCheckout( value: boolean ) {
        this._forceUpdatedCheckout = value;
    }

    /**
     * @returns {any}
     */
    get updateCheckoutTimer(): any {
        return this._updateCheckoutTimer;
    }

    /**
     *
     * @param {any} value
     */
    set updateCheckoutTimer( value: any ) {
        this._updateCheckoutTimer = value;
    }
}

export default UpdateCheckoutService;
