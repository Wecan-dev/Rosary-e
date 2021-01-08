import Main from '../Main';

/**
 * EzTab Enum
 */
export enum EasyTab {
    CUSTOMER,
    SHIPPING,
    PAYMENT,
}

/**
 *
 */
class TabService {
    /**
     * @type {any}
     * @private
     */
    private _tabContainer: any;

    /**
     * @type {any}
     * @private
     */
    private _tabBreadcrumbContainer: any;

    /**
     * @param tabContainer
     * @param tabBreadcrumbContainer
     */
    constructor( tabContainer: any, tabBreadcrumbContainer: any ) {
        this.tabContainer = jQuery( tabContainer );
        this.tabBreadcrumbContainer = jQuery( tabBreadcrumbContainer );

        // Don't try to load tabs if tabs don't exist
        if ( !this.tabBreadcrumbContainer.length ) {
            // if tabs can't load, make all the tabs visible
            jQuery( '.cfw-panel' ).css( 'opacity', '1' ).css( 'display', 'block' );
            return;
        }

        // Initialize tabs
        this.tabContainer.easytabs( {
            animate: false,
            defaultTab: 'li.tab:nth-child(2)',
            tabs: 'ul > li.tab',
        } );

        // Show the breadcrumbs
        this.tabBreadcrumbContainer.show();

        // After tab switch, scroll to the top of the active tab and set an active class
        this.tabContainer.on( 'easytabs:after', () => {
        // Remove temporary alerts on successful tab switch
        // TODO: Move to Alert service
            Main.instance.alertContainer.find( '.cfw-alert-temporary' ).remove();
        } );

        // Add tab active class on window load
        jQuery( window ).on( 'load cfw_updated_checkout', () => {
            this.setActiveTabClass();
        } );

        this.setTabChangeListeners();
        this.setTabButtonListeners();
    }

    /**
     * Returns the current and target tab indexes
     *
     * @returns any
     */
    getCurrentTab() {
        return this.tabContainer.find( '.cfw-panel.active' ).first();
    }

    setTabButtonListeners() {
        jQuery( document.body ).on( 'click', '.cfw-tab-link, .cfw-next-tab, .cfw-prev-tab', ( event ) => {
            if ( jQuery( event.target ).data( 'tab' ) ) {
                this.tabContainer.easytabs( 'select', jQuery( event.target ).data( 'tab' ) );
            }
        } );
    }

    setTabChangeListeners() {
        /**
         * Some gateways really really want to fire their stuff when visible.
         *
         * This provides a special event for our compat classes to listen to
         */
        jQuery( document.body ).on( 'cfw-after-tab-change', ( event, clicked, target ) => {
            // Only run on the payment tab
            if ( jQuery( target ).attr( 'id' ) === 'cfw-payment-method' ) {
                // Global event for gateways that need special handling
                jQuery( document.body ).trigger( 'cfw-payment-tab-loaded' );
            }
        } );

        this.tabContainer.bind( 'easytabs:before', ( event, clicked, target ) => {
        // Fire event that we can listen to around the world
            jQuery( document.body ).trigger( 'cfw-before-tab-change', [ event, clicked, target ] );
        } );

        this.tabContainer.bind( 'easytabs:after', ( event, clicked, target ) => {
            // Fire event that we can listen to around the world
            jQuery( document.body ).trigger( 'cfw-after-tab-change', [ event, clicked, target ] );

            // Scroll to top of tab container
            this.scrollToTop();

            // Set current tab active class on form
            this.setActiveTabClass();
        } );
    }

    scrollToTop() {
        // Scroll to the top of current tab on tab switch
        jQuery( 'html, body' ).animate( {
            scrollTop: this.tabContainer.offset().top,
        }, 300 );
    }

    /**
     * Set active tab class on form
     */
    setActiveTabClass() {
        const checkoutForm = Main.getCheckoutForm();

        // Add a class to checkout form to indicate payment tab is active tab
        // Doesn't work when tab is initialized by hash in URL
        const currentTabId = this.getCurrentTab().attr( 'id' );
        const activeClass = `${currentTabId}-active`;

        checkoutForm.removeClass( 'cfw-customer-info-active' ).removeClass( 'cfw-shipping-method-active' ).removeClass( 'cfw-payment-method-active' ).addClass( activeClass );
    }

    /**
     * @param {string} tab_id
     */
    static go( tab_id ): void {
        try {
            Main.instance.tabService.tabContainer.easytabs( 'select', tab_id );
        } catch ( e ) {
            console.log( `Could not select tab: ${e.message}` );
        }
    }

    /**
     * @return {any}
     */
    get tabContainer(): any {
        return this._tabContainer;
    }

    /**
     * @param {any} value
     */
    set tabContainer( value: any ) {
        this._tabContainer = value;
    }

    get tabBreadcrumbContainer(): any {
        return this._tabBreadcrumbContainer;
    }

    set tabBreadcrumbContainer( value: any ) {
        this._tabBreadcrumbContainer = value;
    }
}

export default TabService;
