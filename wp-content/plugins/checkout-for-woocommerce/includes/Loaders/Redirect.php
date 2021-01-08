<?php
namespace Objectiv\Plugins\Checkout\Loaders;

use Exception;
use Objectiv\Plugins\Checkout\Main;
use Objectiv\Plugins\Checkout\Managers\SettingsManager;
use Objectiv\Plugins\Checkout\Managers\ExtendedPathManager;
use Objectiv\Plugins\Checkout\Managers\TemplatesManager;

/**
 * Class Redirect
 *
 * Loads pages in portal by taking control of all output
 *
 * @link checkoutwc.com
 * @since 1.0.0
 * @package Objectiv\Plugins\Checkout\Core
 * @author Brandon Tassone <brandontassone@gmail.com>
 */
class Redirect extends Loader {

	/**
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public static function checkout() {
		if ( apply_filters( 'cfw_load_checkout_template', Main::is_checkout() ) ) {
			// Setup checkout
			$global_template_parameters = self::init_checkout();

			self::suppress_errors();
			self::disable_caching();
			self::suppress_assets();
			self::hook_cfw_wp_head();
			self::hook_cfw_wp_footer();

			$css_classes = apply_filters( 'body_class', array( 'checkout-wc', 'woocommerce', 'woocommerce-checkout', cfw_get_main()->get_templates_manager()->getActiveTemplate()->get_slug() ), array() );

			if ( ! cfw_show_shipping_tab() ) {
				$css_classes[] = 'cfw-hide-shipping';
			}

			// Output the contents of the <head></head> section
			self::head( apply_filters( 'cfw_body_classes', $css_classes ) );

			// Output the contents of the <body></body> section
			self::display( $global_template_parameters, 'content.php' );

			// Output a closing </body> and closing </html> tag
			self::footer();

			// Exit out before WordPress can do anything else
			exit;
		}
	}

	/**
	 * @since 1.0.0
	 * @access public
	 */
	public static function order_pay() {
		if ( apply_filters( 'cfw_load_order_pay_template', Main::is_checkout_pay_page() ) ) {
			$global_template_parameters = self::init_order_pay();

			self::suppress_errors();
			self::disable_caching();
			self::suppress_assets();
			self::hook_cfw_wp_head();
			self::hook_cfw_wp_footer();

			$css_classes = array( 'checkout-wc', 'woocommerce', 'woocommerce-checkout', cfw_get_main()->get_templates_manager()->getActiveTemplate()->get_slug() );

			// Output the contents of the <head></head> section
			self::head( apply_filters( 'cfw_body_classes', $css_classes ) );

			// Output the contents of the <body></body> section
			self::display( $global_template_parameters, 'order-pay.php' );

			// Output a closing </body> and closing </html> tag
			self::footer();

			do_action( 'after_woocommerce_pay' );

			// Exit out before WordPress can do anything else
			exit;
		}
	}

	/**
	 * @since 2.39.0
	 * @access public
	 */
	public static function order_received() {
		if ( apply_filters( 'cfw_load_order_received_template', Main::is_order_received_page() ) ) {
			$global_template_parameters = self::init_thank_you();

			self::suppress_errors();
			self::disable_caching();
			self::suppress_assets();
			self::hook_cfw_wp_head();
			self::hook_cfw_wp_footer();

			$css_classes = array( 'checkout-wc', 'woocommerce', cfw_get_main()->get_templates_manager()->getActiveTemplate()->get_slug() );

			// Output the contents of the <head></head> section
			self::head( apply_filters( 'cfw_body_classes', $css_classes ) );

			// Output the contents of the <body></body> section
			self::display( $global_template_parameters, 'thank-you.php' );

			// Output a closing </body> and closing </html> tag
			self::footer();

			// Exit out before WordPress can do anything else
			exit;
		}
    }

	/**
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $classes
	 */
	public static function head( $classes ) {
		do_action( 'cfw_checkout_loaded_pre_head' );

		if ( Main::is_checkout() ) {
			$classes[] = 'checkout';
		}
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<?php self::cfw_wp_head(); ?>
		</head>
		<body <?php body_class( $classes ); ?>>
        <?php
		do_action( 'cfw_before_header' );

		if ( has_action( 'cfw_custom_header' ) ) {
			do_action( 'cfw_custom_header' );
		} else {
			cfw_get_main()->get_templates_manager()->getActiveTemplate()->view( 'header.php' );
		}

		do_action( 'cfw_after_header' );
	}

	/**
	 * cfw_wp_head
	 */
	public static function cfw_wp_head() {
		// Make sure gateways load before we call wp_head()
		WC()->payment_gateways->get_available_payment_gateways();
		\WC_Payment_Gateways::instance();

		wp_head();
		do_action( 'cfw_wp_head' );
	}

	/**
	 * Remove specifically excluded styles
	 */
	public static function remove_styles() {
		$blocked_style_handles = apply_filters( 'cfw_blocked_style_handles', array() );

		foreach ( $blocked_style_handles as $blocked_style_handle ) {
			wp_dequeue_style( $blocked_style_handle );
			wp_deregister_style( $blocked_style_handle );
		}
	}

	/**
	 * Remove specifically excluded scripts
	 */
	public static function remove_scripts() {
		$blocked_script_handles = apply_filters( 'cfw_blocked_script_handles', array() );

		foreach ( $blocked_script_handles as $blocked_script_handle ) {
			wp_dequeue_script( $blocked_script_handle );
			wp_deregister_script( $blocked_script_handle );
		}
	}

	/**
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public static function footer() {
		do_action( 'cfw_before_footer' );

		if ( has_action( 'cfw_custom_footer' ) ) {
			do_action( 'cfw_custom_footer' );
		} else {
			cfw_get_main()->get_templates_manager()->getActiveTemplate()->view( 'footer.php' );
		}

		// Prevent themes and plugins from injecting HTML on wp_footer
		echo '<div id="wp_footer">';
		wp_footer();
		echo '</div>';

		do_action( 'cfw_wp_footer' );
		?>
		</body>
		</html>
		<?php
	}

	public static function suppress_errors() {
		/**
		 * PHP Warning / Notice Suppression
		 */
		if ( ! defined( 'CFW_DEV_MODE' ) || ! CFW_DEV_MODE ) {
			ini_set( 'display_errors', 'Off' );
		}
	}

	/**
	 * Discourage Caching if Anyone Dares Try
	 */
	public static function disable_caching() {
		header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
		header( 'Cache-Control: post-check=0, pre-check=0', false );
		header( 'Pragma: no-cache' );
	}

	/**
	 * Remove scripts and styles
	 *
	 * Do this at wp_head as well as wp_enqueue_scripts. This gives us two chances to win.
	 */
	public static function suppress_assets() {
		add_action( 'wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'remove_styles' ), 100000 );
		add_action( 'wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'remove_scripts' ), 100000 );
		add_action( 'wp_enqueue_scripts', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'remove_styles' ), 100000 );
		add_action( 'wp_enqueue_scripts', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'remove_scripts' ), 100000 );
		add_action( 'wp_footer', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'remove_styles' ), 19 ); // 20 is when footer scripts are output
		add_action( 'wp_footer', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'remove_scripts' ), 19 ); // 20 is when footer scripts are output
	}

	/**
	 * Setup cfw_wp_head actions
	 */
	public static function hook_cfw_wp_head() {
		// Setup default cfw_wp_head actions
		add_action( 'cfw_wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'output_meta_tags' ), 10, 4 );
		add_action( 'cfw_wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'output_custom_header_scripts' ), 20, 4 );
		add_action( 'cfw_wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'output_page_title' ), 30, 4 );
		add_action( 'cfw_wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'output_wp_styles' ), 30, 4 );
		add_action( 'cfw_wp_head', array( '\Objectiv\Plugins\Checkout\Loaders\Redirect', 'output_custom_styles' ), 40, 5 );
	}

	public static function hook_cfw_wp_footer() {
		add_action( 'cfw_wp_footer', array( 'Objectiv\Plugins\Checkout\Loaders\Redirect', 'output_custom_footer_scripts' ) );
	}
}
