<div class="woocommerce-banner" > 
<img  src="<?php echo get_template_directory_uri();?>/assets/img/perfil.png">
	<div class="woocommerce-banner__text">
	<h2 class="main-general__title">
        Mi cuenta
      </h2>
      <p class="general-banner__subtitle">
        Perfil de Usuario
      </p>
	</div>
</div>

<div class="woocommerce-grid woocommerce-padding" >
	<?php
	/**
	 * My Account page
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see     https://docs.woocommerce.com/document/template-structure/
	 * @package WooCommerce/Templates
	 * @version 3.5.0
	 */

	defined( 'ABSPATH' ) || exit;

	/**
	 * My Account navigation.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_navigation' ); ?>

	<div class="woocommerce-MyAccount-content">
		<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
		?>
	</div>
</div>