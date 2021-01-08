import { Alert, AlertInfo } from '../Components/Alert';
import Main                 from '../Main';
import { AjaxInfo }         from '../Types/Types';
import Action               from './Action';

/**
 *
 */
class ApplyCouponAction extends Action {
    /**
     *
     */
    private _fields: any;

    /**
     * @param {string} id
     * @param {AjaxInfo} ajaxInfo
     * @param {string} code
     * @param {Cart} cart
     * @param {any} fields
     */
    constructor( id: string, ajaxInfo: AjaxInfo, code: string, fields: any ) {
        const data = {
            coupon_code: code,
        };

        super( id, data );

        this.fields = fields;
    }

    /**
     *
     * @param resp
     */
    public response( resp: any ): void {
        if ( typeof resp !== 'object' ) {
            resp = JSON.parse( resp );
        }

        if ( resp.coupons ) {
            jQuery( document.body ).trigger( 'cfw-apply-coupon-success' );
        } else {
            jQuery( document.body ).trigger( 'cfw-apply-coupon-failure' );
        }

        jQuery( document.body ).trigger( 'cfw-apply-coupon-complete' );

        Main.instance.updateCheckoutService.queueUpdateCheckout( {}, { update_shipping_method: false } );
    }

    /**
     * @param xhr
     * @param textStatus
     * @param errorThrown
     */
    public error( xhr: any, textStatus: string, errorThrown: string ): void {
        jQuery( document.body ).trigger( 'cfw-apply-coupon-error' );

        const alertInfo: AlertInfo = {
            type: 'error',
            message: `Failed to apply coupon. Error: ${errorThrown} (${textStatus})`,
            cssClass: 'cfw-alert-error',
        };

        const alert: Alert = new Alert( Main.instance.alertContainer, alertInfo );
        alert.addAlert();
    }

    /**
     * @returns {any}
     */
    get fields(): any {
        return this._fields;
    }

    /**
     * @param value
     */
    set fields( value: any ) {
        this._fields = value;
    }
}

export default ApplyCouponAction;
