<?php include_once 'includes/templates/header.php' ?>
    <main class="container">
      <h2 class="text-center">Calendario de Eventos</h2>
      <div class="tittle-decorator">
        <i class="fas fa-ellipsis-h"></i>
      </div>
      <?php
      
        try {
            require_once('includes/functions/bd_connection.php');
            $sql = "SELECT id_evento, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado ";
            $sql .= "FROM eventos ";
            $sql .= "INNER JOIN categoria_evento ";
            $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
            $sql .= "INNER JOIN invitados ";
            $sql .= "ON eventos.id_invitado = invitados.id_invitado ";
            $sql .= "ORDER BY id_evento ";
            $resultado = $conn->query($sql);
        } catch (\Exception $_e) {
            echo $e->getMessage();
        }

      ?>
      <div class="calendario__container container">
          <?php
            while ($eventos = $resultado->fetch_assoc() ){ 
              $fecha = $eventos['fecha_evento'];
              
              $evento = array(
                'titulo' => $eventos['nombre_evento'],
                'fecha' => $eventos['fecha_evento'],
                'hora' => $eventos['hora_evento'],
                'categoria' => $eventos['cat_evento'],
                'icono' => 'fa'." ".$eventos['icono'],
                'invitado' => $eventos['nombre_invitado']. " " . $eventos['apellido_invitado']
              );

              $calendario[$fecha][] = $evento;
           }

           foreach ($calendario as $dia => $lista_eventos) { ?>
              <h3 class="dia">
                  <i class="fa fa-calendar"></i>
                  <?php
                    setlocale(LC_TIME, 'es_ES.UTF-8');
                    setlocale(LC_TIME, 'spanish');              
                    echo utf8_encode(strftime("%A, %d de %B del %Y", strtotime($dia)));
                  ?>
              </h3>
              <div class="eventos">
              <?php foreach ($lista_eventos as $evento) { ?>
                <div class="evento" >
                    <p class="titulo"><?php echo $evento['titulo']; ?></p>
                    <p class="hora"><i class="fa fa-clock" aria-hidden="true"></i>
                      <?php echo $evento['fecha']." ".$evento['hora']; ?>
                    </p>
                    <p>
                      <i class="<?php echo $evento['icono']?>" aria-hidden="true"></i>
                      <?php echo $evento['categoria']; ?></p>
                    <p>
                      <i class="fa fa-user" aria-hidden="true"></i>
                      <?php echo $evento['invitado']; ?></p>
                    
                </div>
              
              <?php } //fin foreach eventos?> 
              </div>
          <?php } //fin foreach fechas?> 
      </div>
      <?php
        $conn->close();
      ?>
    </main> 
    
    
<?php include_once 'includes/templates/footer.php' ?>