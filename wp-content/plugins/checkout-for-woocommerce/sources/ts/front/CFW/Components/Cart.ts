import UpdateCartAction from '../Actions/UpdateCartAction';
import Main             from '../Main';
import DataService      from '../Services/DataService';

class Cart {
    constructor() {
        this.setUpMobileCartDetailsReveal();
        this.setQuantityStepperTriggers();
        this.setQuantityPromptTriggers();
    }

    setQuantityStepperTriggers(): void {
        jQuery( document.body ).on( 'click', '.cfw-quantity-stepper-btn-minus', function () {
            const quantityValue = jQuery( this ).siblings( '.cfw-edit-item-quantity-value' ).first();
            const quantityLabel = jQuery( this ).parents( '.cart-item-row' ).find( '.cfw-cart-item-quantity-bubble' ).first();
            const newQuantity = Number( quantityValue.val() ) - 1;

            if ( newQuantity > 0 || ( <any>window ).confirm( DataService.getSetting( 'delete_confirm_message' ) ) ) {
                quantityValue.val( newQuantity );
                quantityLabel.text( newQuantity );

                new UpdateCartAction( 'update_cart', Main.instance.ajaxInfo, Main.getFormObject( 'update_cart' ) ).load();
            }
        } );

        jQuery( document.body ).on( 'click', '.cfw-quantity-stepper-btn-plus', function () {
            const quantityValue = jQuery( this ).siblings( '.cfw-edit-item-quantity-value' ).first();
            const quantityLabel = jQuery( this ).parents( '.cart-item-row' ).find( '.cfw-cart-item-quantity-bubble' ).first();
            const maxQuantity = Number( jQuery( quantityValue ).data( 'max-quantity' ) );
            const newQuantity = Number( quantityValue.val() ) + 1;

            if ( newQuantity <= maxQuantity ) {
                quantityValue.val( newQuantity );
                quantityLabel.text( newQuantity );

                new UpdateCartAction( 'update_cart', Main.instance.ajaxInfo, Main.getFormObject( 'update_cart' ) ).load();
            }
        } );
    }

    /**
     *
     */
    setQuantityPromptTriggers(): void {
        jQuery( document.body ).on( 'click', '.cfw-quantity-bulk-edit', ( event ) => {
            const response = ( <any>window ).prompt( DataService.getSetting( 'quantity_prompt_message' ), jQuery( event.target ).data( 'quantity' ) );

            // If we have input
            if ( response !== null ) {
                const newQuantity = Number( response );

                if ( newQuantity > 0 || ( <any>window ).confirm( DataService.getSetting( 'delete_confirm_message' ) ) ) {
                    jQuery( event.target ).siblings( '.cfw-quantity-stepper' ).find( '.cfw-edit-item-quantity-value' ).val( newQuantity );

                    new UpdateCartAction( 'update_cart', Main.instance.ajaxInfo, Main.getFormObject( 'update_cart' ) ).load();
                }
            }
        } );
    }

    /**
     *
     */
    setUpMobileCartDetailsReveal(): void {
        const showCartDetails = jQuery( '#cfw-mobile-cart-header' );

        showCartDetails.on( 'click', ( e ) => {
            e.preventDefault();
            jQuery( '#cfw-cart-summary-content' ).slideToggle( 300 );
            jQuery( '#cfw-expand-cart' ).toggleClass( 'active' );
        } );
    }
}

export default Cart;
