<!DOCTYPE html>
<html class="no-js" lang="es_MX">
  <head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <link rel="manifest" href="site.webmanifest" />
    <link rel="apple-touch-icon" href="icon.png" />
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap"
      rel="stylesheet"
    />
    <?php
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace(".php", "", $archivo);
        if ($pagina == 'invitados' || $pagina == 'index') {
          echo '<link rel="stylesheet" href="css/colorbox.css" />';
        } else if ($pagina == 'conferencia') {
          echo '<link rel="stylesheet" href="css/lightbox.css" />';
        }
    ?>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/main.css" />

    <meta name="theme-color" content="#fafafa" />
  </head>

  <body class="<?php echo $pagina ?>">
    <header class="site-header">
      <div class="hero">
        <div class="hero__content">
          <nav class="hero__social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-pinterest-p"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </nav>
          <div class="hero__info">
            <p class="hero__info__date">
              <i class="fas fa-calendar-alt"></i> 10-12 Dic
            </p>
            <p class="hero__info__city">
              <i class="fas fa-map-marker-alt"></i> Guadalajara, MX
            </p>
            <h1 class="hero__info__tittle">GdlWebCamp</h1>
            <p class="hero__info__slogan">
              La mejor conferencia de <span>diseño web</span>
            </p>
          </div>
        </div>
      </div>
      <!--Hero-->
      <div class="menu">
        <div class="menu__logo">
          <a href="index.php"><img src="img/logo.svg" alt="logo" /></a>
        </div>
        <div class="menu__bars"><i class="fas fa-bars"></i></div>
        <nav class="menu__links">
          <a href="conferencia.php">Conferencias</a>
          <a href="calendario.php">Calendario</a>
          <a href="invitados.php">Invitados</a>
          <a href="registro.php">Reservaciones</a>
        </nav>
      </div>
      <!--Menu-->
    </header>
    <!--Header-->