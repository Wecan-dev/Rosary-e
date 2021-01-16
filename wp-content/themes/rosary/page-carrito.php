<?php get_header(); ?>
<div class="general-banner" > 
<img  src="<?php echo get_template_directory_uri();?>/assets/img/Banner-contact.jpg">
	<div class="general-banner__text">
	<h2 class="main-general__title">
        Carro de Compras
      </h2>
      <p class="general-banner__subtitle">
        Rosary
      </p>
	</div>
</div>
<?php echo do_shortcode('[woocommerce_cart]'); ?>
<?php get_footer(); ?>

<style>
	.woocommerce {
		margin-top: 0;
	}
</style>