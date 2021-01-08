import ApplyCouponAction from '../Actions/ApplyCouponAction';
import Main              from '../Main';

class Coupons {
    constructor() {
        this.setShowCouponsModuleListener();
        this.setApplyCouponListener();
        this.setApplyCouponMobileListener();
    }

    setShowCouponsModuleListener() {
        jQuery( document.body ).on( 'click', '.cfw-show-coupons-module', () => {
            jQuery( '.cfw-promo-wrap' ).slideDown( 300 );
            jQuery( '.cfw-show-coupons-module' ).hide();
        } );
    }

    /**
     *
     */
    setApplyCouponListener() {
        const promo_apply_button = jQuery( '#cfw-promo-code-btn' );

        jQuery( '#cfw-promo-code' ).on( 'keydown', ( e ) => {
            if ( e.which == 13 ) {
                e.preventDefault();

                promo_apply_button.trigger( 'click' );
            }
        } );

        promo_apply_button.on( 'click', () => {
            const coupon_field: any = jQuery( '#cfw-promo-code' );

            if ( coupon_field.val() !== '' ) {
                new ApplyCouponAction( 'cfw_apply_coupon', Main.instance.ajaxInfo, coupon_field.val(), Main.getFormObject( 'apply_coupon' ) ).load();
                coupon_field.val( '' ).blur();
            }
        } );
    }

    setApplyCouponMobileListener() {
        const promo_apply_button = jQuery( '#cfw-promo-code-btn-mobile' );

        jQuery( '#cfw-promo-code-mobile' ).on( 'keydown', ( e ) => {
            if ( e.which == 13 ) {
                e.preventDefault();

                promo_apply_button.trigger( 'click' );
            }
        } );

        promo_apply_button.on( 'click', () => {
            const coupon_field: any = jQuery( '#cfw-promo-code-mobile' );

            if ( coupon_field.val() !== '' ) {
                new ApplyCouponAction( 'cfw_apply_coupon', Main.instance.ajaxInfo, coupon_field.val(), Main.getFormObject( 'apply_coupon' ) ).load();
                coupon_field.val( '' ).blur();
            }
        } );
    }
}

export default Coupons;
