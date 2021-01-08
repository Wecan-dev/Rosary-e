declare let cfwEventData: any;

class DataService {
    static initRunTimeParams() {
        cfwEventData.runtime_params = {};
    }

    static getAjaxInfo() {
        return cfwEventData.ajaxInfo;
    }

    static getSettings() {
        return cfwEventData.settings;
    }

    static getSetting( setting: string ) {
        if ( cfwEventData.settings[ setting ] ) {
            return cfwEventData.settings[ setting ];
        }

        return false;
    }

    static getCompatibilityClasses() {
        return cfwEventData.compatibility;
    }

    static getCompatibilityClass( key: string ) {
        return cfwEventData.compatibility[ key ];
    }

    static getElements() {
        return cfwEventData.elements;
    }

    static getElement( element: string ) {
        if ( cfwEventData.elements[ element ] ) {
            return jQuery( cfwEventData.elements[ element ] );
        }

        return false;
    }

    static getCheckoutParams() {
        return cfwEventData.checkout_params;
    }

    /**
   * @param param
   */
    static getCheckoutParam( param: string ) {
        if ( cfwEventData.checkout_params[ param ] ) {
            return cfwEventData.checkout_params[ param ];
        }

        return false;
    }

    static getRuntimeParameters() {
        return cfwEventData.runtime_params;
    }

    static getRuntimeParameter( param: string ) {
        if ( cfwEventData.runtime_params[ param ] ) {
            return cfwEventData.runtime_params[ param ];
        }

        return false;
    }

    static setRuntimeParameter( param: string, value: any ) {
        cfwEventData.runtime_params[ param ] = value;
    }
}

export default DataService;
