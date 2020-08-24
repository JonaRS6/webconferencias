<?php include_once 'includes/templates/header.php' ?>
<main class="container">
  <h2 class="text-center">La mejor conferencia de diseño web en español</h2>
  <div class="tittle-decorator">
    <i class="fas fa-ellipsis-h"></i>
  </div>
  <p class="text-center">
    Proin semper nibh at ligula rhoncus, interdum tincidunt lacus tempus.
    Curabitur pretium ante ac gravida auctor. Sed sed mauris lacus. Donec
    ullamcorper metus interdum laoreet rutrum. Proin venenatis aliquet
    scelerisque. Proin vel lectus augue. Mauris eget felis id leo fringilla
    ornare. Suspendisse potenti.
  </p>
</main>
<!--Main-->
<section class="section">
  <div class="program">
    <div class="program__video">
      <video class="program__video" autoplay="true" muted loop poster="img/bg-talleres.jpg">
        <source src="video/video.mp4" type="video/mp4">
        <source src="video/video.webm" type="video/webm">
        <source src="video/video.ogv" type="video/ogv">
      </video>
    </div>
    <div class="program__content">
      <h2 class="text-center">Progama del evento</h2>
      <div class="tittle-decorator">
        <i class="fas fa-ellipsis-h"></i>
      </div>
      <?php
      try {
        require_once('includes/functions/bd_connection.php');
        $sql = "SELECT * FROM categoria_evento";
        $resultado = $conn->query($sql);
      } catch (\Exception $_e) {
        echo $e->getMessage();
      }
      ?>
      <nav class="program__tabs">
        <?php while ($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
          <a href="#<?php echo strtolower($cat['cat_evento']) ?>"><i class="fas <?php echo $cat['icono'] ?>"></i><?php echo ($cat['cat_evento']) ?></a>
        <?php } ?>
      </nav>
      <!--Tabs-->
      <?php

      try {
        require_once('includes/functions/bd_connection.php');
        $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
        $sql .= "FROM eventos ";
        $sql .= "INNER JOIN categoria_evento ";
        $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
        $sql .= "INNER JOIN invitados ";
        $sql .= "ON eventos.id_invitado = invitados.id_invitado ";
        $sql .= "AND eventos.id_cat_evento = 1 ";
        $sql .= "ORDER BY id_evento LIMIT 2 ;";
        $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
        $sql .= "FROM eventos ";
        $sql .= "INNER JOIN categoria_evento ";
        $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
        $sql .= "INNER JOIN invitados ";
        $sql .= "ON eventos.id_invitado = invitados.id_invitado ";
        $sql .= "AND eventos.id_cat_evento = 2 ";
        $sql .= "ORDER BY id_evento LIMIT 2 ;";
        $sql .= "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
        $sql .= "FROM eventos ";
        $sql .= "INNER JOIN categoria_evento ";
        $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
        $sql .= "INNER JOIN invitados ";
        $sql .= "ON eventos.id_invitado = invitados.id_invitado ";
        $sql .= "AND eventos.id_cat_evento = 3 ";
        $sql .= "ORDER BY id_evento LIMIT 2 ;";
        $conn->multi_query($sql);
      } catch (\Exception $_e) {
        echo $e->getMessage();
      }
      ?>

      <?php
      do {
        $resultado = $conn->store_result();
        $row = $resultado->fetch_all(MYSQLI_ASSOC);
      ?>
        <?php $i = 0 ?>
        <?php foreach ($row as $evento) : ?>
          <?php if ($i % 2 == 0) { ?>
            <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="program__tabs__content hide">
            <?php } ?>
            <div class="program__event">
              <a href="conferencia.html">
                <h3><?php echo ($evento['nombre_evento']) ?></h3>
              </a>
              <p><i class="far fa-clock"></i> <?php echo $evento['hora_evento'] ?></p>
              <p><i class="far fa-calendar"></i> <?php echo $evento['fecha_evento'] ?></p>
              <p><i class="fas fa-user"></i></i> <?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado'] ?></p>
            </div>
            <?php if ($i % 2 == 1) { ?>
              <a href="calendario.php" class="btn btn-primary">Ver todos</a>
            </div>
          <?php } ?>
          <!--Events-->
          <?php $i++ ?>
        <?php endforeach; ?>
        <?php $resultado->free(); ?>
      <?php
      } while ($conn->more_results() && $conn->next_result());
      ?>


    </div>
  </div>
</section>
<section class="container section">
  <h2 class="text-center">Nuestros invitados</h2>
  <div class="tittle-decorator">
    <i class="fas fa-ellipsis-h"></i>
  </div>
  <?php include_once 'includes/templates/invitados.php' ?>
</section>
<!--Guest-->
<section class="section">
  <div class="counters">
    <div class="container">
      <div class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Invitados</p>
      </div>
      <div class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Talleres</p>
      </div>
      <div class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Días</p>
      </div>
      <div class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Conferencias</p>
      </div>
    </div>
  </div>
</section>
<!--Counters-->
<section class="section">
  <div class="container">
    <h2 class="text-center">Precios</h2>
    <div class="tittle-decorator">
      <i class="fas fa-ellipsis-h"></i>
    </div>
    <ul class="prices">
      <li class="price__card">
        <h4>Un día</h4>
        <p><span>$30</span></p>
        <p>Bocadillos gratis</p>
        <p>Todas las conferencias</p>
        <p>Todos los talleres</p>
        <a href="comprar.html" class="btn btn-secondary">Comprar</a>
      </li>
      <li class="price__card">
        <h4>Todos los días</h4>
        <p><span>$50</span></p>
        <p>Bocadillos gratis</p>
        <p>Todas las conferencias</p>
        <p>Todos los talleres</p>
        <a href="comprar.html" class="btn btn-primary">Comprar</a>
      </li>
      <li class="price__card">
        <h4>Dos días</h4>
        <p><span>$45</span></p>
        <p>Bocadillos gratis</p>
        <p>Todas las conferencias</p>
        <p>Todos los talleres</p>
        <a href="comprar.html" class="btn btn-secondary">Comprar</a>
      </li>
    </ul>
  </div>
</section>
<!--Prices-->

<div class="map" id="map"></div>
<!--Map-->
<section class="section">
  <div class="container">
    <h2 class="text-center">Testimoniales</h2>
    <div class="tittle-decorator">
      <i class="fas fa-ellipsis-h"></i>
    </div>
    <ul class="testimonials">
      <li class="testimonial">
        <blockquote>
          <p class="testimonial__cite">Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Laboriosam quis ab ipsum veritatis enim totam.</p>
          <div class="testimonial__info">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <p><span>Oswaldo Aponte Escobedo</span></p>
            <p>Diseñador en @prisma</p>
          </div>
        </blockquote>
      </li>
      <li class="testimonial">
        <blockquote>
          <p class="testimonial__cite">Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Laboriosam quis ab ipsum veritatis enim totam.</p>
          <div class="testimonial__info">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <p><span>Oswaldo Aponte Escobedo</span></p>
            <p>Diseñador en @prisma</p>
          </div>
        </blockquote>
      </li>
      <li class="testimonial">
        <blockquote>
          <p class="testimonial__cite">Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Laboriosam quis ab ipsum veritatis enim totam.</p>
          <div class="testimonial__info">
            <img src="img/testimonial.jpg" alt="imagen testimonial">
            <p><span>Oswaldo Aponte Escobedo</span></p>
            <p>Diseñador en @prisma</p>
          </div>
        </blockquote>
      </li>
    </ul>
  </div>
</section>
<!--testimonials-->
<section class="section">
  <div class="newsletter">
    <div class="container">
      <p>Registrate al newsletter</p>
      <div class="newsletter__logo">
        <img src="img/logo.svg" alt="logo">
      </div>
      <a href="#mc_embed_signup" class="btn btn-trans" id="btn_newsletter">Registro</a>
    </div>
  </div>
</section>
<!--Newsletter-->
<section class="section">
  <div class="countdown">
    <h2 class="text-center">Faltan</h2>
    <div class="tittle-decorator">
      <i class="fas fa-ellipsis-h"></i>
    </div>
    <div id="cuenta-regresiva" class="container">
      <div id="dias" class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Días</p>
      </div>
      <div id="horas" class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Horas</p>
      </div>
      <div id="minutos" class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Minutos</p>
      </div>
      <div id="segundos" class="counter">
        <p class="counter__number"></p>
        <p class="counter__name">Segundos</p>
      </div>
    </div>
  </div>
</section>
<?php include_once 'includes/templates/footer.php' ?>