<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd62823e060219e7fe9a4ec274b22fefb
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Finder\\' => 25,
        ),
        'O' => 
        array (
            'Objectiv\\Plugins\\Checkout\\' => 26,
            'Objectiv\\BoosterSeat\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Objectiv\\Plugins\\Checkout\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Objectiv\\BoosterSeat\\' => 
        array (
            0 => __DIR__ . '/..' . '/objectivco/booster-seat/src',
        ),
    );

    public static $classMap = array (
        'Objectiv\\BoosterSeat\\Base\\Action' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Base/Action.php',
        'Objectiv\\BoosterSeat\\Base\\Singleton' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Base/Singleton.php',
        'Objectiv\\BoosterSeat\\Base\\Tracked' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Base/Tracked.php',
        'Objectiv\\BoosterSeat\\Language\\i18n' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Language/i18n.php',
        'Objectiv\\BoosterSeat\\Managers\\PathManager' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Managers/PathManager.php',
        'Objectiv\\BoosterSeat\\Utilities\\Activator' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Utilities/Activator.php',
        'Objectiv\\BoosterSeat\\Utilities\\Deactivator' => __DIR__ . '/..' . '/objectivco/booster-seat/src/Utilities/Deactivator.php',
        'Objectiv\\Plugins\\Checkout\\Action\\AccountExistsAction' => __DIR__ . '/../..' . '/includes/Action/AccountExistsAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\ApplyCouponAction' => __DIR__ . '/../..' . '/includes/Action/ApplyCouponAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\CFWAction' => __DIR__ . '/../..' . '/includes/Action/CFWAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\CompleteOrderAction' => __DIR__ . '/../..' . '/includes/Action/CompleteOrderAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\LogInAction' => __DIR__ . '/../..' . '/includes/Action/LogInAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\UpdateCartAction' => __DIR__ . '/../..' . '/includes/Action/UpdateCartAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\UpdateCheckoutAction' => __DIR__ . '/../..' . '/includes/Action/UpdateCheckoutAction.php',
        'Objectiv\\Plugins\\Checkout\\Action\\UpdatePaymentMethodAction' => __DIR__ . '/../..' . '/includes/Action/UpdatePaymentMethodAction.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Base' => __DIR__ . '/../..' . '/includes/Compatibility/Base.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\AfterPayKrokedil' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/AfterPayKrokedil.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\AmazonPay' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/AmazonPay.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\Braintree' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/Braintree.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\BraintreeForWooCommerce' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/BraintreeForWooCommerce.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\Helpers\\AmazonPayShippingInfoHelper' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/Helpers/AmazonPayShippingInfoHelper.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\In3' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/In3.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\InpsydePayPalPlus' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/InpsydePayPalPlus.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\KlarnaCheckout' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/KlarnaCheckout.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\KlarnaPayment' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/KlarnaPayment.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\PayPalCheckout' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/PayPalCheckout.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\PayPalForWooCommerce' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/PayPalForWooCommerce.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\PayPalPlusCw' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/PayPalPlusCw.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\PostFinance' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/PostFinance.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\SkyVergeGateways' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/SkyVergeGateways.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\Square' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/Square.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\SquareRecurring' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/SquareRecurring.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\Stripe' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/Stripe.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\StripeWooCommerce' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/StripeWooCommerce.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\ToCheckout' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/ToCheckout.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\Vipps' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/Vipps.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\WooCommercePensoPay' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/WooCommercePensoPay.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Gateways\\WooSquarePro' => __DIR__ . '/../..' . '/includes/Compatibility/Gateways/WooSquarePro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Manager' => __DIR__ . '/../..' . '/includes/Compatibility/Manager.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\ActiveCampaign' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/ActiveCampaign.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\ApplyOnline' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/ApplyOnline.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\BeaverThemer' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/BeaverThemer.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\BlueCheck' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/BlueCheck.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CO2OK' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CO2OK.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CSSHero' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CSSHero.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CartFlows' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CartFlows.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CheckoutAddressAutoComplete' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CheckoutAddressAutoComplete.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CheckoutFieldEditor' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CheckoutFieldEditor.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CheckoutManager' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CheckoutManager.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\Chronopost' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/Chronopost.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CountryBasedPayments' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CountryBasedPayments.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\CraftyClicks' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/CraftyClicks.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\DiviUltimateFooter' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/DiviUltimateFooter.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\DiviUltimateHeader' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/DiviUltimateHeader.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\EUVATNumber' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/EUVATNumber.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\ElementorPro' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/ElementorPro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\EnhancedEcommerceGoogleAnalytics' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/EnhancedEcommerceGoogleAnalytics.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\ExtraCheckoutFieldsBrazil' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/ExtraCheckoutFieldsBrazil.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\FacebookForWooCommerce' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/FacebookForWooCommerce.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\Fattureincloud' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/Fattureincloud.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\GermanMarketplace' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/GermanMarketplace.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\GoogleAnalyticsPro' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/GoogleAnalyticsPro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\IndeedAffiliatePro' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/IndeedAffiliatePro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\JupiterXCore' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/JupiterXCore.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\MailerLite' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/MailerLite.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\MartfuryAddons' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/MartfuryAddons.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\MixPanel' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/MixPanel.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\MondialRelay' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/MondialRelay.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\MyCredPartialPayments' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/MyCredPartialPayments.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\NIFPortugal' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/NIFPortugal.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\NLPostcodeChecker' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/NLPostcodeChecker.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\NextGenGallery' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/NextGenGallery.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\OneClickUpsells' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/OneClickUpsells.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\OnePageCheckout' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/OnePageCheckout.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\OrderDeliveryDate' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/OrderDeliveryDate.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\OrderDeliveryDateLite' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/OrderDeliveryDateLite.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\OxygenBuilder' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/OxygenBuilder.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\PWGiftCardsPro' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/PWGiftCardsPro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\PixelCaffeine' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/PixelCaffeine.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\PortugalVaspKios' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/PortugalVaspKios.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\PostNL' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/PostNL.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\SUMOPaymentPlans' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/SUMOPaymentPlans.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\SalientWPBakery' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/SalientWPBakery.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\SendCloud' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/SendCloud.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\ShipMondo' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/ShipMondo.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\SkyVergeCheckoutAddons' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/SkyVergeCheckoutAddons.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\SkyVergeSocialLogin' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/SkyVergeSocialLogin.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\StrollikCore' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/StrollikCore.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\Tickera' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/Tickera.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\UltimateRewardsPoints' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/UltimateRewardsPoints.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\UpsellOrderBumpOffer' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/UpsellOrderBumpOffer.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WCFieldFactory' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WCFieldFactory.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WCPont' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WCPont.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WPCProductBundles' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WPCProductBundles.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WPWebWooCommerceSocialLogin' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WPWebWooCommerceSocialLogin.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\Webshipper' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/Webshipper.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\Weglot' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/Weglot.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceAddressValidation' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceAddressValidation.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceAdvancedMessages' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceAdvancedMessages.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceCarrierAgents' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceCarrierAgents.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceCheckoutFieldEditor' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceCheckoutFieldEditor.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceCore' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceCore.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceGermanized' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceGermanized.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceGiftCards' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceGiftCards.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceOrderDelivery' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceOrderDelivery.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommercePriceBasedOnCountry' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommercePriceBasedOnCountry.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceProductBundles' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceProductBundles.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceServices' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceServices.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceSmartCoupons' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceSmartCoupons.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooCommerceSubscriptions' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooCommerceSubscriptions.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\WooFunnelsOrderBumps' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/WooFunnelsOrderBumps.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\YITHCompositeProducts' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/YITHCompositeProducts.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\YITHDeliveryDate' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/YITHDeliveryDate.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Plugins\\YITHProductBundles' => __DIR__ . '/../..' . '/includes/Compatibility/Plugins/YITHProductBundles.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Astra' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Astra.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Atelier' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Atelier.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Atik' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Atik.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Avada' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Avada.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Barberry' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Barberry.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\BeaverBuilder' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/BeaverBuilder.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Blaszok' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Blaszok.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Divi' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Divi.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Electro' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Electro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Flevr' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Flevr.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\FuelThemes' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/FuelThemes.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\GeneratePress' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/GeneratePress.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Genesis' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Genesis.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Jupiter' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Jupiter.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\JupiterX' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/JupiterX.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Konte' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Konte.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Listable' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Listable.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\OceanWP' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/OceanWP.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Optimizer' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Optimizer.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Porto' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Porto.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Savoy' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Savoy.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\SpaSalonPro' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/SpaSalonPro.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Stockie' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Stockie.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\TMOrganik' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/TMOrganik.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\The7' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/The7.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\TheBox' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/TheBox.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Tokoo' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Tokoo.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Verso' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Verso.php',
        'Objectiv\\Plugins\\Checkout\\Compatibility\\Themes\\Zidane' => __DIR__ . '/../..' . '/includes/Compatibility/Themes/Zidane.php',
        'Objectiv\\Plugins\\Checkout\\Core\\Admin' => __DIR__ . '/../..' . '/includes/Core/Admin.php',
        'Objectiv\\Plugins\\Checkout\\Core\\Customizer' => __DIR__ . '/../..' . '/includes/Core/Customizer.php',
        'Objectiv\\Plugins\\Checkout\\Core\\Form' => __DIR__ . '/../..' . '/includes/Core/Form.php',
        'Objectiv\\Plugins\\Checkout\\Core\\Template' => __DIR__ . '/../..' . '/includes/Core/Template.php',
        'Objectiv\\Plugins\\Checkout\\Loaders\\Content' => __DIR__ . '/../..' . '/includes/Loaders/Content.php',
        'Objectiv\\Plugins\\Checkout\\Loaders\\Loader' => __DIR__ . '/../..' . '/includes/Loaders/Loader.php',
        'Objectiv\\Plugins\\Checkout\\Loaders\\Redirect' => __DIR__ . '/../..' . '/includes/Loaders/Redirect.php',
        'Objectiv\\Plugins\\Checkout\\Main' => __DIR__ . '/../..' . '/includes/Main.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\ActivationManager' => __DIR__ . '/../..' . '/includes/Managers/ActivationManager.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\AjaxManager' => __DIR__ . '/../..' . '/includes/Managers/AjaxManager.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\ExtendedPathManager' => __DIR__ . '/../..' . '/includes/Managers/ExtendedPathManager.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\Helpers\\EDD_SL_Plugin_Updater' => __DIR__ . '/../..' . '/includes/Managers/Helpers/EDD_SL_Plugin_Updater.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\SettingsManager' => __DIR__ . '/../..' . '/includes/Managers/SettingsManager.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\TemplatesManager' => __DIR__ . '/../..' . '/includes/Managers/TemplatesManager.php',
        'Objectiv\\Plugins\\Checkout\\Managers\\UpdatesManager' => __DIR__ . '/../..' . '/includes/Managers/UpdatesManager.php',
        'Objectiv\\Plugins\\Checkout\\Stats\\StatCollection' => __DIR__ . '/../..' . '/includes/Stats/StatCollection.php',
        'Symfony\\Component\\Finder\\Comparator\\Comparator' => __DIR__ . '/..' . '/symfony/finder/Comparator/Comparator.php',
        'Symfony\\Component\\Finder\\Comparator\\DateComparator' => __DIR__ . '/..' . '/symfony/finder/Comparator/DateComparator.php',
        'Symfony\\Component\\Finder\\Comparator\\NumberComparator' => __DIR__ . '/..' . '/symfony/finder/Comparator/NumberComparator.php',
        'Symfony\\Component\\Finder\\Exception\\AccessDeniedException' => __DIR__ . '/..' . '/symfony/finder/Exception/AccessDeniedException.php',
        'Symfony\\Component\\Finder\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/symfony/finder/Exception/ExceptionInterface.php',
        'Symfony\\Component\\Finder\\Finder' => __DIR__ . '/..' . '/symfony/finder/Finder.php',
        'Symfony\\Component\\Finder\\Glob' => __DIR__ . '/..' . '/symfony/finder/Glob.php',
        'Symfony\\Component\\Finder\\Iterator\\CustomFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/CustomFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\DateRangeFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/DateRangeFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\DepthRangeFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/DepthRangeFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\ExcludeDirectoryFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/ExcludeDirectoryFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\FileTypeFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/FileTypeFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\FilecontentFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/FilecontentFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\FilenameFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/FilenameFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\FilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/FilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\MultiplePcreFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/MultiplePcreFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\PathFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/PathFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\RecursiveDirectoryIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/RecursiveDirectoryIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\SizeRangeFilterIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/SizeRangeFilterIterator.php',
        'Symfony\\Component\\Finder\\Iterator\\SortableIterator' => __DIR__ . '/..' . '/symfony/finder/Iterator/SortableIterator.php',
        'Symfony\\Component\\Finder\\SplFileInfo' => __DIR__ . '/..' . '/symfony/finder/SplFileInfo.php',
        'WP_Tabbed_Navigation' => __DIR__ . '/..' . '/objectivco/wp_tabbed_navigation/src/class-wp-tabbed-navigation.php',
        'WordPress_SimpleSettings' => __DIR__ . '/..' . '/objectivco/wordpress-simple-settings/src/wordpress-simple-settings.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd62823e060219e7fe9a4ec274b22fefb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd62823e060219e7fe9a4ec274b22fefb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd62823e060219e7fe9a4ec274b22fefb::$classMap;

        }, null, ClassLoader::class);
    }
}
