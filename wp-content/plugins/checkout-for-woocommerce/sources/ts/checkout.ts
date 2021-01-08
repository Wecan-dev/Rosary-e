import 'core-js/features/object/assign';
import 'ts-polyfill';
import cfwDomReady                 from './_functions';
import { cfwCompatibilityClasses } from './cfw-compatibility-classes';
import Main                        from './front/CFW/Main';
import DataService                 from './front/CFW/Services/DataService';

declare let cfwEventData: any;
( <any>window ).cfwCompatibilityClasses = cfwCompatibilityClasses;

// Fired from compatibility-classes.ts
cfwDomReady( () => {
    const data = cfwEventData;
    const formEl = jQuery( data.elements.checkoutFormSelector );
    const breadcrumbEl = jQuery( data.elements.breadCrumbElId );
    const alertContainerEl = jQuery( data.elements.alertContainerId );
    const tabContainerEl = jQuery( data.elements.tabContainerElId );

    // Allow users to add their own Typescript Compatibility classes
    jQuery( document.body ).trigger( 'cfw-checkout-before-load' );

    // Init runtime params
    DataService.initRunTimeParams();

    // Kick it off!
    new Main( formEl, alertContainerEl, tabContainerEl, breadcrumbEl, data.ajaxInfo, data.settings );
} );
