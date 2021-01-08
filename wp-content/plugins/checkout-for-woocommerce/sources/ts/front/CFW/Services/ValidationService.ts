import { Alert, AlertInfo }  from '../Components/Alert';
import Main                  from '../Main';
import DataService           from './DataService';
import TabService            from './TabService';

/**
 * Validation Sections Enum
 */
export enum EValidationSections {
    SHIPPING,
    BILLING,
    ACCOUNT
}

/**
 *
 */
class ValidationService {
    /**
     * @type {EValidationSections}
     * @private
     */
    private static _currentlyValidating: EValidationSections;

    /**
     */
    constructor() {
        ( <any>window ).cfw_suppress_js_field_validation = false;

        this.validateSectionsBeforeSwitch();
        this.validateBillingFieldsBeforeSubmit();

        ValidationService.validateShippingOnLoadIfNotCustomerTab();
    }

    /**
     * Execute validation checks before each easy tab easy tab switch.
     *
     * @param {any} easyTabsWrap
     */
    validateSectionsBeforeSwitch(): void {
        Main.instance.tabService.tabContainer.bind( 'easytabs:before', ( event, clicked, target ) => {
            const currentTab = Main.instance.tabService.getCurrentTab();
            const destinationTab = jQuery( target );

            // If we are moving forward in the checkout process and we are currently on the customer tab
            if ( currentTab.nextAll( '.cfw-panel' ).filter( `#${destinationTab.attr( 'id' )}` ).length ) {
                let validated: boolean = ValidationService.validateSectionsForCustomerTab();
                let loginRequiredError: boolean = false;

                // Maybe fail validation on account errors
                // eslint-disable-next-line max-len
                if ( !DataService.getSetting( 'user_logged_in' ) && DataService.getSetting( 'is_registration_required' ) && DataService.getRuntimeParameter( 'runtime_email_matched_user' ) && DataService.getSetting( 'validate_required_registration' ) ) {
                    loginRequiredError = true;
                    validated = false;
                }

                // If a login required error happened, add it here so it happens after the hash jump above
                if ( loginRequiredError ) {
                    const alert: Alert = new Alert( Main.getAlertContainer(), <AlertInfo> {
                        type: 'error',
                        message: DataService.getSetting( 'account_already_registered_notice' ),
                        cssClass: 'cfw-alert-error cfw-login-required-error',
                    } );

                    alert.addAlert();
                }

                if ( !validated ) {
                    event.stopImmediatePropagation();
                }

                // Return the validation
                return validated;
            }

            // If we are moving forward / backwards, have a shipping easy tab,
            // and are not on the customer tab then allow
            // the tab switch
            return true;
        } );
    }

    validateBillingFieldsBeforeSubmit(): void {
        const checkoutForm = Main.getCheckoutForm();

        checkoutForm.on( 'submit', ( e ) => {
            let validated = false;

            if ( !DataService.getSetting( 'enable_one_page_checkout' ) && DataService.getSetting( 'needs_shipping_address' ) && checkoutForm.find( 'input[name="bill_to_different_address"]:checked' ).val() !== 'same_as_shipping' ) {
                validated = ValidationService.validate_section( EValidationSections.BILLING );
            } else if ( DataService.getSetting( 'enable_one_page_checkout' ) ) {
                validated = ValidationService.validateSectionsForCustomerTab();
            } else {
                validated = true; // If digital only order, billing address was handled on customer info tab so set to true
            }

            if ( !validated ) {
                e.preventDefault();
                e.stopImmediatePropagation(); // prevent bubbling up the DOM *and* prevent other submit handlers from firing, such as completeOrder
            }

            return validated;
        } );
    }

    /**
     *
     * @returns {boolean}
     */
    static validateSectionsForCustomerTab(): boolean {
        let validated;

        const account_validated = ValidationService.validate_section( EValidationSections.ACCOUNT );

        if ( !DataService.getSetting( 'needs_shipping_address' ) ) {
            const billingAddressValidated = ValidationService.validate_section( EValidationSections.BILLING );

            validated = account_validated && billingAddressValidated;
        } else {
            const shippingAddressValidated = ValidationService.validate_section( EValidationSections.SHIPPING );

            validated = account_validated && shippingAddressValidated;
        }

        return validated;
    }

    /**
     * @param {EValidationSections} section
     * @returns {any}
     */
    static validate_section( section: EValidationSections ): any {
        if ( ( <any>window ).cfw_suppress_js_field_validation ) {
            return true;
        }

        let validated: boolean;
        const checkoutForm = Main.getCheckoutForm();

        ValidationService.currentlyValidating = section;

        // eslint-disable-next-line default-case
        switch ( section ) {
        case EValidationSections.SHIPPING:
            validated = checkoutForm.parsley().validate( { group: 'shipping' } );
            break;
        case EValidationSections.BILLING:
            validated = checkoutForm.parsley().validate( { group: 'billing' } );
            break;
        case EValidationSections.ACCOUNT:
            validated = checkoutForm.parsley().validate( { group: 'account' } );
            break;
        default:
        }

        if ( validated == null ) {
            validated = true;
        }

        return validated;
    }

    /**
     * Handles non ajax cases
     */
    static validateShippingOnLoadIfNotCustomerTab(): void {
        const { hash } = window.location;
        const customerInfoId: string = '#cfw-customer-info';
        const sectionToValidate: EValidationSections = ( DataService.getSetting( 'needs_shipping_address' ) === true ) ? EValidationSections.SHIPPING : EValidationSections.BILLING;

        if ( hash !== customerInfoId && hash !== '' ) {
            if ( !ValidationService.validate_section( sectionToValidate ) ) {
                TabService.go( 'cfw-customer-info' );
            }
        }
    }

    /**
     * @return {EValidationSections}
     */
    static get currentlyValidating(): EValidationSections {
        return this._currentlyValidating;
    }

    /**
     * @param {EValidationSections} value
     */
    static set currentlyValidating( value: EValidationSections ) {
        this._currentlyValidating = value;
    }
}

export default ValidationService;
