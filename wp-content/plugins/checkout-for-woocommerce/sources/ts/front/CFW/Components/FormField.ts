class FormField {
    private static _float_class = 'cfw-floating-label';

    constructor() {
        // This needs to run before the select2 handler in country-select.js
        // So we're using firstOn - https://www.npmjs.com/package/jquery-first-event
        jQuery( document.body ).firstOn( 'country_to_state_changed', () => {
            jQuery( '.state_select' ).removeClass( 'state_select' );
        } );

        jQuery( document.body ).on( 'keyup change', '.cfw-input-wrap :input', ( e ) => {
            this.maybeAddFloatClass( jQuery( e.target ) );
        } );

        jQuery( '.cfw-input-wrap :input' ).each( ( index, element ) => {
            this.maybeAddFloatClass( element );
        } );
    }

    maybeAddFloatClass( element: any ) {
        const parent_element = jQuery( element ).parents( '.cfw-input-wrap' ).first();

        if ( jQuery( element ).val() !== '' ) {
            parent_element.addClass( FormField.float_class );
        } else {
            parent_element.removeClass( FormField.float_class );
        }
    }

    static get float_class(): string {
        return this._float_class;
    }
}

export default FormField;
