<?php get_header(); ?>
  <section class="general-banner">
    <img src="<?php echo get_template_directory_uri();?>/assets/img/contacto/image.png">
    <div class="general-banner__text">
      <h2 class="main-general__title">
        Contáctanos
      </h2>
      <p class="general-banner__subtitle">
        Rosary
      </p>
    </div>
  </section>
  <section class="contact">
    <div class="container-grid">
      <div class="contact-form">
        <h2 class="contact-form__title">
          dejanos un mensaje
        </h2>
        <p class="contact-form__description">
          Si tienes dudas o quieres ponerte en contacto con alguno de nuestros asesores. Hazlo aquí.
        </p>
        <form>
          <input placeholder="Nombre*">
          <input placeholder="Correo*">
          <input placeholder="Asunto">
          <textarea placeholder="Tu comentario aqui."></textarea>
          <a class="general-btn__rose" href="">
Enviar
</a>
        </form>
      </div>
      <div class="contact-sidebar">
        <h2 class="contact-form__title">
          Nuestra información
        </h2>
        <p class="contact-form__description">
         
        </p>
        <ul class="contact-list">
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/phone-call.png">
            <a href="">
              <p>Teléfono</p>
              57 (4) 444 35 69
            </a>
          </li>
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/envelope.png">
            <a href="">
              <p>Correo Electrónico</p>
              info@rosary.com
            </a>
          </li>
          <li>
            <img src="<?php echo get_template_directory_uri();?>/assets/img/place.png">
            <a href="">
              <p>Ubicación</p>
              Calle 78 #79 - 24, Medellín-Colombia
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
<?php get_footer(); ?>