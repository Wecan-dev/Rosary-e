import Accordion                     from './Components/Accordion';
import Cart                          from './Components/Cart';
import Coupons                       from './Components/Coupons';
import FormField                     from './Components/FormField';
import Form                          from './Components/Form';
import LoginForm                     from './Components/LoginForm';
import PaymentMethodRadios           from './Components/PaymentMethodRadios';
import PaymentRequestButtons         from './Components/PaymentRequestButtons';
import TermsAndConditions            from './Components/TermsAndConditions';
import AddressAutocompleteService    from './Services/AddressAutocompleteService';
import AlertService                  from './Services/AlertService';
import BillingAddressSyncService     from './Services/BillingAddressSyncService';
import CompleteOrderService          from './Services/CompleteOrderService';
import CountryRowResizeService       from './Services/CountryRowResizeService';
import DataService                   from './Services/DataService';
import FieldPersistenceService       from './Services/FieldPersistenceService';
import ParsleyService                from './Services/ParsleyService';
import PaymentGatewaysService        from './Services/PaymentGatewaysService';
import TabService                    from './Services/TabService';
import TooltipService                from './Services/TooltipService';
import UpdateCheckoutService         from './Services/UpdateCheckoutService';
import ValidationService             from './Services/ValidationService';
import ZipAutocompleteService        from './Services/ZipAutocompleteService';
import { AjaxInfo }                  from './Types/Types';

/**
 * The main class of the front end checkout system
 */
class Main {
    /**
     * @type {any}
     * @private
     */
    private _checkoutForm: any;

    /**
     * @type {any}
     * @private
     */
    private _tabContainer: any;

    /**
     * @type {any}
     * @private
     */
    private _alertContainer: any;

    /**
     * @type {AjaxInfo}
     * @private
     */
    private _ajaxInfo: AjaxInfo;

    /**
     * @type {any}
     * @private
     */
    private _settings: any;

    /**
     * @type {TabService}
     * @private
     */
    private _tabService: TabService;

    /**
     * @type {UpdateCheckoutService}
     * @private
     */
    private _updateCheckoutService: UpdateCheckoutService;

    /**
     * @type {PaymentGatewaysService}
     * @private
     */
    private _paymentGatewaysService: PaymentGatewaysService;

    /**
     * @type {boolean}
     * @private
     */
    private _preserveAlerts: boolean;

    /**
     * @type boolean
     * @private
     */
    private _loadTabs: any;

    /**
     * @type {Main}
     * @private
     * @static
     */
    private static _instance: Main;

    /**
     * @type {ParsleyService}
     * @private
     */
    private _parsleyService: ParsleyService;

    /**
     * @param {any} checkoutFormElement
     * @param {any} alertContainer
     * @param {any} tabContainerElement
     * @param {any} breadCrumbElement
     * @param {AjaxInfo} ajaxInfo
     * @param {any} settings
     */
    constructor( checkoutFormElement: any, alertContainer: any, tabContainerElement, breadCrumbElement, ajaxInfo: AjaxInfo, settings: any ) {
        Main.instance = this;

        this.checkoutForm = checkoutFormElement;
        this.tabContainer = tabContainerElement;
        this.alertContainer = alertContainer;
        this.ajaxInfo = ajaxInfo;
        this.settings = settings;
        this.loadTabs = this.settings.load_tabs;

        /**
         * Services
         */
        // Maybe Load Tab Service
        if ( this.loadTabs ) {
            this.tabService = new TabService( this.tabContainer, breadCrumbElement );
        }

        // Setup the validation service - has to happen after tabs are setup
        new ValidationService();

        // Field Persistence Service
        new FieldPersistenceService( checkoutFormElement );

        // Parsley Service
        this.parsleyService = new ParsleyService();

        // Zip Autocomplete Service
        new ZipAutocompleteService();

        // Address Autocomplete Service
        new AddressAutocompleteService();

        // Complete Order Service
        new CompleteOrderService();

        // Payment Gateway Service
        this.paymentGatewaysService = new PaymentGatewaysService();

        // Update Checkout Service
        this.updateCheckoutService = new UpdateCheckoutService();

        // Billing Address Sync Service
        new BillingAddressSyncService();

        // Alert Service
        new AlertService( this.alertContainer );

        // Country Row Resize Service
        new CountryRowResizeService();

        // Tooltips
        new TooltipService();

        /**
         * Components
         */
        // Load Form component
        new Form();

        // Load Accordion component
        new Accordion();

        // Load Login Form component
        new LoginForm();

        // Load FormField Component
        new FormField();

        // Load Coupons component
        new Coupons();

        // Load Terms and Conditions Component
        new TermsAndConditions();

        // Load Place Order Button Component
        new PaymentMethodRadios();

        // Load Payment Request Buttons Component
        new PaymentRequestButtons();

        // Cart Component
        new Cart();

        /**
         * Compatibility Classes
         */
        this.loadCompatibilityClasses();

        jQuery( document.body ).on( 'cfw-remove-overlay', () => {
            Main.removeOverlay();
        } );

        // Page load actions
        jQuery( window ).on( 'load', () => {
            const wpadmin_bar = jQuery( '#wpadminbar' );

            if ( wpadmin_bar.length ) {
                wpadmin_bar.appendTo( 'html' );
            }

            // Give plugins a chance to react to our hidden, invisible shim checkbox
            jQuery( '#ship-to-different-address-checkbox' ).trigger( 'change' );

            /**
             * On first load, we force updated_checkout to run for gateways
             * that need it / want it / gotta have it
             */
            this.updateCheckoutService.forceUpdatedCheckout = true;

            // Don't blow away pre-existing alerts on the first update checkout call
            this.preserveAlerts = true;

            // Trigger initial update checkout
            this.updateCheckoutService.triggerUpdateCheckout();

            // Init checkout ( WooCommerce native event )
            jQuery( document.body ).trigger( 'init_checkout' );
        } );
    }

    /**
     * @param context
     */
    static getFormObject( context: string = 'complete_order' ) {
        const checkout_form: any = Main.getCheckoutForm();
        const bill_to_different_address = <string>jQuery( '[name="bill_to_different_address"]:checked' ).val();
        const $required_inputs = checkout_form.find( '.address-field.validate-required:visible' );
        let has_full_address: boolean = true;
        const lookFor: Array<string> = DataService.getSetting( 'default_address_fields' );

        if ( $required_inputs.length ) {
            $required_inputs.each( function () {
                if ( jQuery( this ).find( ':input' ).val() === '' ) {
                    has_full_address = false;
                }
            } );
        }

        const formData = {
            post_data: checkout_form.serialize(),
            has_full_address,
            bill_to_different_address,
        };

        const formArr: Array<Object> = checkout_form.serializeArray();
        formArr.forEach( ( item: any ) => formData[ item.name ] = item.value );

        // Handle shipped subscriptions since they are render outside of the form
        jQuery( '#cfw-other-totals input[name^="shipping_method"][type="radio"]:checked, #cfw-other-totals input[name^="shipping_method"][type="hidden"]' ).each( ( index, el ) => {
            formData[ jQuery( el ).attr( 'name' ) ] = jQuery( el ).val();
        } );

        if ( bill_to_different_address === 'same_as_shipping' ) {
            lookFor.forEach( ( field ) => {
                if ( jQuery( `#billing_${field}` ).length > 0 ) {
                    formData[ `billing_${field}` ] = formData[ `shipping_${field}` ];

                    // Make sure the post_data has the same info
                    formData.post_data = `${formData.post_data}&billing_${field}=${formData[ `shipping_${field}` ]}`;
                }
            } );
        }

        if ( context !== 'complete_order' ) {
            // Delete data that we don't need unless we are completing the order
            // TODO: Switch to enumerated data like core uses
            delete formData[ 'woocommerce-process-checkout-nonce' ];

            for ( const key in formData ) {
                if ( key.includes( 'credit-card' ) || key.includes( 'token' ) ) {
                    delete formData[ key ];
                }
            }
        }

        return formData;
    }

    /**
     * Load contextually relevant compatibility classes
     */
    loadCompatibilityClasses(): void {
        // Compatibility Class Creation
        Object.keys( DataService.getCompatibilityClasses() ).forEach( ( key ) => {
            // eslint-disable-next-line max-len
            new ( <any>window ).cfwCompatibilityClasses[ DataService.getCompatibilityClass( key ).class ]( Main.instance, DataService.getCompatibilityClass( key ).params ).load( Main.instance, DataService.getCompatibilityClass( key ).params );
        } );
    }

    /**
     * Adds a visual indicator that the checkout is doing something
     */
    static addOverlay(): void {
        if ( jQuery( '#cfw-payment-method:visible' ).length > 0 ) {
            const form = Main.getCheckoutForm();
            const form_data = form.data();

            if ( form_data[ 'blockUI.isBlocked' ] !== 1 ) {
                form.block( {
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6,
                    },
                } );
            }
        }
    }

    /**
     * Remove the visual indicator
     */
    static removeOverlay(): void {
        const form = Main.getCheckoutForm();

        form.unblock();
    }

    static getAlertContainer() {
        return DataService.getElement( 'alertContainerId' );
    }

    /**
     *
     */
    static getCheckoutForm(): JQuery {
        if ( Main.instance ) {
            return Main.instance.checkoutForm;
        }

        return jQuery( 'form.woocommerce-checkout' );
    }

    /**
     * @returns {any}
     */
    get checkoutForm(): any {
        return this._checkoutForm;
    }

    /**
     * @param {any} value
     */
    set checkoutForm( value: any ) {
        this._checkoutForm = value;
    }

    /**
     * @returns {TabContainer}
     */
    get tabContainer() {
        return this._tabContainer;
    }

    /**
     * @return {any}
     */
    get alertContainer(): any {
        return this._alertContainer;
    }

    /**
     * @param {any} value
     */
    set alertContainer( value: any ) {
        this._alertContainer = value;
    }

    /**
     * @param value
     */
    set tabContainer( value: any ) {
        this._tabContainer = value;
    }

    /**
     * @returns {AjaxInfo}
     */
    get ajaxInfo(): AjaxInfo {
        return this._ajaxInfo;
    }

    /**
     * @param value
     */
    set ajaxInfo( value: AjaxInfo ) {
        this._ajaxInfo = value;
    }

    /**
     * @returns {any}
     */
    get settings(): any {
        return this._settings;
    }

    /**
     * @param value
     */
    set settings( value: any ) {
        this._settings = value;
    }

    /**
     * @returns {TabService}
     */
    get tabService(): TabService {
        return this._tabService;
    }

    /**
     * @param {TabService} value
     */
    set tabService( value: TabService ) {
        this._tabService = value;
    }

    /**
     * @returns {UpdateCheckoutService}
     */
    get updateCheckoutService(): UpdateCheckoutService {
        return this._updateCheckoutService;
    }

    /**
     * @param {UpdateCheckoutService} value
     */
    set updateCheckoutService( value: UpdateCheckoutService ) {
        this._updateCheckoutService = value;
    }

    /**
     * @returns {PaymentGatewaysService}
     */
    get paymentGatewaysService(): PaymentGatewaysService {
        return this._paymentGatewaysService;
    }

    /**
     * @param {PaymentGatewaysService} value
     */
    set paymentGatewaysService( value: PaymentGatewaysService ) {
        this._paymentGatewaysService = value;
    }

    /**
     * @returns {ParsleyService}
     */
    get parsleyService(): ParsleyService {
        return this._parsleyService;
    }

    /**
     * @param {ParsleyService} value
     */
    set parsleyService( value: ParsleyService ) {
        this._parsleyService = value;
    }

    /**
     * @returns {boolean}
     */
    get preserveAlerts(): boolean {
        return this._preserveAlerts;
    }

    /**
     * @param {boolean} value
     */
    set preserveAlerts( value: boolean ) {
        this._preserveAlerts = value;
    }

    get loadTabs(): any {
        return this._loadTabs;
    }

    set loadTabs( value: any ) {
        this._loadTabs = value;
    }

    /**
     * @returns {Main}
     */
    static get instance(): Main {
        return Main._instance;
    }

    /**
     * @param {Main} value
     */
    static set instance( value: Main ) {
        if ( !Main._instance ) {
            Main._instance = value;
        }
    }
}

export default Main;
