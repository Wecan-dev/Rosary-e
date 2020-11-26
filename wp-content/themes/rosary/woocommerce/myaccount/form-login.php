<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>
<div class="login-content" >

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-12 d-flex justify-content-center">

<?php endif; ?>
	<?php if ($_GET["create"] != 'account') { ?>
		<form class="woocommerce-form woocommerce-form-login login" method="post">
			<div class="login-icon">
				<img  src="<?php echo get_template_directory_uri();?>/assets/img/user.png">
			</div>
			<p class="login-text">
				Crear una cuenta para agilizar las futuras compras, hacer un seguimiento del historial de pedidos y recibir correos electrónicos, descuentos y ofertas especiales.
			</p>
			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				
				<input placeholder="Nombre" type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username"  value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<input placeholder="Contraseña" class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<div class="login-flex">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>
				</div>
			</p>
		
			<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			<?php do_action( 'woocommerce_login_form_end' ); ?>
			<p class="woocommerce-in-account"><a href="?create=account">Crear una nueva cuenta <i class="fa fa-angle-right" > </i> </a></p>
		</form>
<?php } ?>
<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

	</div>
<?php if ($_GET["create"] == 'account') { ?>
	<div class="u-column2 col-12 d-flex justify-content-center">
        <div class="woocommerce-form woocommerce-form-login woocommerce-form-register register">
        	<div class="login-icon">
				<img  src="<?php echo get_template_directory_uri();?>/assets/img/user.png">
			</div>
		<h2>Registro</h2>
            <?php echo do_shortcode('[user_registration_form id="112"]'); ?>
            <p class="woocommerce-in-account"><a href="?create=">Regresar a login <i class="fa fa-angle-right" > </i> </a></p>
        </div>

        
	</div>
<?php } ?>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
</div>
