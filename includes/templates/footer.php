<footer>
  <div class="container">
    <div class="footer__widgets">
      <div class="footer__widget">
        <h3>Sobre <span>GdlWebCamp</span></h3>
        <p>Lorem ipsum dolor sit amet consectetur
          adipisicing elit. Non sequi accusamus incidunt a optio!
          Dolorum odio nemo accusamus libero repellendus?
        </p>
      </div>
      <div class="footer__widget">
        <h3>Últimos <span>Tweets</span></h3>
        <p>Lorem ipsum dolor sit amet consectetur
          adipisicing elit. Non sequi accusamus incidunt a optio!
          Dolorum odio nemo accusamus libero repellendus?
        </p>
      </div>
      <div class="footer__widget">
        <h3>Redes <span>Sociales</span></h3>
        <nav class="hero__social">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-pinterest-p"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </nav>
      </div>
    </div>
  </div>
  <p class="text-center footer__rights">
    Todos los derechos reservados Jonathan Ruiz 2016
  </p>
</footer>
<!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
  #mc_embed_signup {
    background: #fff;
    clear: left;
    font: 14px Helvetica, Arial, sans-serif;
  }

  /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div style="display: none;">
  <div id="mc_embed_signup">
    <form action="https://hotmail.us17.list-manage.com/subscribe/post?u=e04fdfba7fcbffb79f8da0ef1&amp;id=3be0a47e99" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
      <div id="mc_embed_signup_scroll">
        <h2>Suscribete</h2>
        <div class="mc-field-group">
          <label for="mce-EMAIL">Email </label>
          <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display:none"></div>
          <div class="response" id="mce-success-response" style="display:none"></div>
        </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_e04fdfba7fcbffb79f8da0ef1_3be0a47e99" tabindex="-1" value=""></div>
        <div class="clear"><input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
      </div>
    </form>
  </div>
</div>

<!--End mc_embed_signup-->
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="/__/firebase/7.20.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="/__/firebase/7.20.0/firebase-analytics.js"></script>

<!-- Initialize Firebase -->
<script src="/__/firebase/init.js"></script>
<script src="js/vendor/modernizr-3.11.2.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/jquery.animateNumber.js"></script>
<script src="js/jquery.countdown.js"></script>
<script src="js/jquery.lettering.js"></script>
<?php
$archivo = basename($_SERVER['PHP_SELF']);
$pagina = str_replace(".php", "", $archivo);
if ($pagina == 'invitados' || $pagina == 'index') {
  echo '<script src="js/jquery.colorbox-min.js"></script>';
} else if ($pagina == 'conferencia') {
  echo '<script src="js/lightbox.js"></script>';
}
?>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
<script src="js/main.js"></script>

<!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
  window.ga = function() {
    ga.q.push(arguments);
  };
  ga.q = [];
  ga.l = +new Date();
  ga("create", "UA-XXXXX-Y", "auto");
  ga("set", "anonymizeIp", true);
  ga("set", "transport", "beacon");
  ga("send", "pageview");
</script>
<script src="https://www.google-analytics.com/analytics.js" async></script>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
<script type='text/javascript'>
  (function($) {
    window.fnames = new Array();
    window.ftypes = new Array();
    fnames[0] = 'EMAIL';
    ftypes[0] = 'email';
    fnames[1] = 'FNAME';
    ftypes[1] = 'text';
    fnames[2] = 'LNAME';
    ftypes[2] = 'text';
    fnames[3] = 'ADDRESS';
    ftypes[3] = 'address';
    fnames[4] = 'PHONE';
    ftypes[4] = 'phone';
    fnames[5] = 'BIRTHDAY';
    ftypes[5] = 'birthday';
    /*
     * Translated default messages for the $ validation plugin.
     * Locale: ES
     */
    $.extend($.validator.messages, {
      required: "Este campo es obligatorio.",
      remote: "Por favor, rellena este campo.",
      email: "Por favor, escribe una dirección de correo válida",
      url: "Por favor, escribe una URL válida.",
      date: "Por favor, escribe una fecha válida.",
      dateISO: "Por favor, escribe una fecha (ISO) válida.",
      number: "Por favor, escribe un número entero válido.",
      digits: "Por favor, escribe sólo dígitos.",
      creditcard: "Por favor, escribe un número de tarjeta válido.",
      equalTo: "Por favor, escribe el mismo valor de nuevo.",
      accept: "Por favor, escribe un valor con una extensión aceptada.",
      maxlength: $.validator.format("Por favor, no escribas más de {0} caracteres."),
      minlength: $.validator.format("Por favor, no escribas menos de {0} caracteres."),
      rangelength: $.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
      range: $.validator.format("Por favor, escribe un valor entre {0} y {1}."),
      max: $.validator.format("Por favor, escribe un valor menor o igual a {0}."),
      min: $.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
    });
  }(jQuery));
  var $mcj = jQuery.noConflict(true);
</script>
</body>

</html>