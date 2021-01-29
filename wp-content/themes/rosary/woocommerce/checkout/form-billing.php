<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<!--<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>-->
    <h3>Información </h3>
    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents info">
           <tr>
               <td>
                   <h4 class="cuenta_checkout"></h4>
               </td>
              
           </tr>
           <tr>
               <td colspan="2">
                   <div class="email_checkout"></div>
               </td>              
           </tr> 
           <tr>
               <td colspan="2">
                   <div class="correo_noticias_field"></div>
               </td>              
           </tr>   
           <tr>
               <td colspan="2">
                   <h4>Dirección de envíos </h4>
               </td>               
           </tr>                     
           <tr>
               <td>
                   <div class="billing_first_name_checkout"></div>
               </td>
               <td>
                   <div class="billing_last_name_checkout"></div>
               </td>               
           </tr>  
           <tr>
               <td colspan="2">
                   <div class="billing_address_1_field_checkout"></div>
               </td>              
           </tr>   
           <tr>
               <td colspan="2">
                   <div class="billing_address_2_field_checkout"></div>
               </td>              
           </tr>                    
           <tr>
               <td>
                   <div class="billing_city_field_checkout"></div>
               </td>
               <td>
                   <div class="billing_phone_checkout"></div>
               </td>               
           </tr>                                        
    </table>

    <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents info">
           <tr>
               <td>
                   <label class="label_billing_country_field_checkout">País/Región</label>
                   <div class="billing_country_field_checkout"></div>
               </td>
               <td>
                   <label class="label_billing_state_checkout">Provincia</label>
                   <div class="billing_state_field_checkout"></div>
               </td>   
               <td>
                   <label class="label_billing_postcode_field">Código postal</label>
                   <div class="billing_postcode_field_checkout"></div>
               </td>                            
           </tr>
           <tr>
               <td colspan="3">
                   <div class="guardar_info_checkout_field_checkout"></div>
               </td>                            
           </tr>           
        </table>      



	<?php else : ?>

		<!--<h3><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>-->
		<h3>Información </h3>
		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents info">
           <tr>
               <td>
                   <h4 class="cuenta_checkout"></h4>
               </td>
              
           </tr>
           <tr>
               <td colspan="2">
                   <div class="email_checkout"></div>
               </td>              
           </tr> 
           <tr>
               <td colspan="2">
                   <div class="correo_noticias_field"></div>
               </td>              
           </tr>   
           <tr>
               <td colspan="2">
                   <h4>Dirección de envíos </h4>
               </td>               
           </tr> 
		   <tr>
               <td>
                   <div class="billing_first_name_checkout"></div>
               </td>
               <td>
                   <div class="billing_last_name_checkout"></div>
               </td>               
           </tr>	
	
           <tr>
               <td>
                   <div class="second_last_name_checkout"></div>
               </td>
               <td>
                   <div class="tipo_person_checkout"></div>
               </td>               
           </tr>

           <tr>
               <td>
                   <div class="document_client_field_checkout"></div>
               </td>
               <td>
                   <div class="documen_client_date_checkout"></div>
               </td>               
           </tr>
			
           <tr>
               <td colspan="2">
                   <div class="billing_address_1_field_checkout"></div>
               </td>              
           </tr>   
           <tr>
               <td colspan="2">
                   <div class="billing_address_2_field_checkout"></div>
               </td>              
           </tr>                    
           <tr>
               <td>
                   <div class="billing_city_field_checkout"></div>
               </td>
               <td>
                   <div class="billing_phone_checkout"></div>
               </td>               
           </tr>                                        
		</table>

		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents info">
           <tr>
               <td>
               	   <label class="label_billing_country_field_checkout">País/Región</label>
                   <div class="billing_country_field_checkout"></div>
               </td>
               <td>
               	   <label class="label_billing_state_checkout">Provincia</label>
                   <div class="billing_state_field_checkout"></div>
               </td>   
               <td>
               	   <label class="label_billing_postcode_field">Código postal</label>
                   <div class="billing_postcode_field_checkout"></div>
               </td>                            
           </tr>
           <tr>
               <td colspan="3">
                   <div class="guardar_info_checkout_field_checkout"></div>
               </td>                            
           </tr>           
        </table>   		



	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>

<script type="text/javascript">
  $('.woocommerce-form-login-toggle').appendTo('.cuenta_checkout');
  $('.form_login').appendTo('.cuenta_checkout');
  $('#billing_email_field').appendTo('.email_checkout');
  $('#correo_noticias_field').appendTo('.correo_noticias_field');
  $('#billing_first_name_field').appendTo('.billing_first_name_checkout');
  $('#billing_last_name_field').appendTo('.billing_last_name_checkout');
  $('#billing_address_1 input').prop('placeholder', 'dsff');
  $('#billing_address_1_field').appendTo('.billing_address_1_field_checkout');
  $('#billing_city_field').appendTo('.billing_city_field_checkout');
  $('#billing_address_2_field').appendTo('.billing_address_2_field_checkout');
  $('#billing_address_2_field').appendTo('.billing_address_2_field_checkout');
  $('#billing_phone').appendTo('.billing_phone_checkout');
  $('#billing_country_field').appendTo('.billing_country_field_checkout');
  $('#billing_state_field').appendTo('.billing_state_field_checkout');
  $('#billing_postcode_field').appendTo('.billing_postcode_field_checkout');
  $('#guardar_info_checkout_field').appendTo('.guardar_info_checkout_field_checkout');
 
  $('#second_last_name_field').appendTo('.second_last_name_checkout');
  $('#tipo_person_field').appendTo('.tipo_person_checkout');
  $('#document_client_field').appendTo('.document_client_field_checkout');
  $('#documen_client_date_field').appendTo('.documen_client_date_checkout');


  $('#billing_city').attr('placeholder','Ciudad');
  $('#billing_address_1').attr('placeholder','Dirección');
	
  //$('.select2-selection__placeholder > span').text("Seleccionar Color");
  document.querySelector('#select2-tipo_person-container span').innerHTML = '1 elemento';	

  var ur = "CO"; 
  $(document).ready(function(){
	$('#billing_country').prop('disabled', true);  
    $("#billing_country").val(ur);
   // $('#billing_country').prop('disabled', false);
   // $('#billing_city').prop('disabled', false);
  }); 

</script>
