import { Alert, AlertInfo } from '../../Components/Alert';
import Main                 from '../../Main';
import Compatibility        from '../Compatibility';

declare let mrwpPluginSettings: any;
declare function mrwp_prepare_shipping() : boolean;
declare function mrwpParcelPickerInit() : void;
declare function mrwpShippingCode( shippingIds: string, selectedShipping: string ) : string;
declare function mrwpNeedsParcelPicker( option: boolean ) : boolean;

class MondialRelay extends Compatibility {
    /**
     * @param {Main} main The Main object
     * @param {any} params Params for the child class to run on load
     */
    constructor( main: Main, params ) {
        super( main, params, 'MondialRelay' );
    }

    load( main: Main ): void {
        jQuery( document.body ).on( 'cfw_updated_checkout', () => {
            const same_as_shipping = jQuery( 'input[name="bill_to_different_address"]:checked' ).val();

            if ( same_as_shipping === 'same_as_shipping' ) {
                jQuery( '#billing_country' ).val( jQuery( '#shipping_country' ).val() );
                jQuery( '#billing_postcode' ).val( jQuery( '#shipping_postcode' ).val() );
            }

            if ( !main.updateCheckoutService.forceUpdatedCheckout && mrwp_prepare_shipping() ) {
                jQuery( '#mrwp_weight' ).attr( 'value', mrwpPluginSettings.mondialrelay_weight );
                const mrwpShippingRaw = mrwpPluginSettings.mondialrelay_ids_livraison;
                const mrwpShipping = JSON.parse( mrwpShippingRaw );
                const availableShippingOptions = jQuery( 'input[name^="shipping_method"]' );
                const selectedShippingOption = jQuery( 'input[name^="shipping_method"]:checked' );
                let selectedShipping;
                if ( selectedShippingOption.length > 0 ) selectedShipping = selectedShippingOption.val();
                else {
                    if ( !( availableShippingOptions.length > 0 ) ) return;
                    selectedShipping = jQuery( 'input[name^="shipping_method"]' ).val();
                }
                const currentShippingCode = mrwpShippingCode( mrwpShipping, selectedShipping );
                if ( currentShippingCode == jQuery( '#mrwp_shipping_code' ).val() ) {
                    const previousAddress = jQuery( '#mrwp_parcel_shop_address' ).val().toString();
                    jQuery( '#parcel_shop_info' ).html( previousAddress );
                    // eslint-disable-next-line max-len
                } else jQuery( '#mrwp_shipping_code' ).attr( 'value', currentShippingCode ), jQuery( '#mrwp_parcel_shop_id' ).attr( 'value', '' ), jQuery( '#mrwp_parcel_shop_address' ).attr( 'value', '' );
                currentShippingCode != 'DRI' && currentShippingCode.indexOf( '24' ) == -1 ? mrwpNeedsParcelPicker( !1 ) : ( mrwpNeedsParcelPicker( !0 ), mrwpParcelPickerInit() );
            }
        } );

        jQuery( '#cfw-shipping-action' ).hide();

        jQuery( document.body ).on( 'cfw_updated_checkout', () => {
            jQuery( '#cfw-shipping-action' ).show();
        } );

        const easyTabsWrap: any = main.tabService.tabContainer;

        easyTabsWrap.bind( 'easytabs:before', ( event, clicked, target ) => {
            if ( jQuery( target ).attr( 'id' ) == 'cfw-payment-method' ) {
                if ( jQuery( '#mrwp_parcel_shop_mandatory' ).val() == 'Yes' ) {
                    if ( jQuery( '#mrwp_parcel_shop_id' ).val() == '' ) {
                        // Prevent removing alert on next update checkout
                        Main.instance.preserveAlerts = true;

                        const alertInfo: AlertInfo = {
                            type: 'error',
                            message: 'Vous n\'avez pas encore choisi de Point Relais.',
                            cssClass: 'cfw-alert-error',
                        };

                        const alert: Alert = new Alert( Main.instance.alertContainer, alertInfo );
                        alert.addAlert( true );

                        event.stopImmediatePropagation();

                        return false;
                    }
                }
            }
        } );
    }
}

export default MondialRelay;
