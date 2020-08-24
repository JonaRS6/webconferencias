<?php include_once 'funciones/sesiones.php' ?>
<?php include_once 'funciones/funciones.php' ?>
<?php include_once 'templates/header.php' ?>
<?php
$id = $_GET['id'];

if (!filter_var($id, FILTER_VALIDATE_INT)) {
  die("Error!!");
}
?>


<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">



    <?php include_once 'templates/barra.php' ?>
    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->

    <?php include_once 'templates/navegacion.php' ?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Crear registrado
          <small>Puedes crear un registrado aquí</small>
        </h1>
      </section>
      <div class="row">
        <div class="col-md-12">
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Registrado nuevo</h3>
              </div>
              <div class="box-body">
                <?php
                $sql = "SELECT * FROM registrados WHERE id_registrado = $id";
                $resultado = $conn->query($sql);
                $registrado = $resultado->fetch_assoc();
                $articulos = json_decode($registrado['pases_articulos'], true);


                if (isset($articulos['un_dia'])) {
                  $pase1 = $articulos['un_dia'];
                } else {
                  $pase1 = 0;
                }
                if (isset($articulos['pase_2dias'])) {
                  $pase2 = $articulos['pase_2dias'];
                } else {
                  $pase2 = 0;
                }
                if (isset($articulos['pase_completo'])) {
                  $pase3 = $articulos['pase_completo'];
                } else {
                  $pase3 = 0;
                }
                if (isset($articulos['camisas'])) {
                  $camisas = $articulos['camisas'];
                } else {
                  $camisas = 0;
                }
                if (isset($articulos['etiquetas'])) {
                  $etiquetas = $articulos['etiquetas'];
                } else {
                  $etiquetas = 0;
                }
                $talleres = json_decode($registrado['talleres_registrados'], true);
                $talleres = $talleres['eventos'];
                ?>
                <form role="form" name="editar-registrado" id="editar-registro" method="post" action="modelo-registrado.php">
                  <div class="box-body">
                    <div id="datos_usuario" class="registro caja clearfix">
                      <div class="campo form-group col-xs-6">
                        <label for="nombre">Nombre: </label>
                        <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Tu nombre" required value="<?php echo $registrado['nombre_registrado'] ?>">
                      </div>
                      <div class="campo form-group col-xs-6">
                        <label for="apellido">Apellido: </label>
                        <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Tu apellido" required value="<?php echo $registrado['apellido_registrado'] ?>">
                      </div>
                      <div class="campo form-group">
                        <label for="email">Email: </label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Tu email" required value="<?php echo $registrado['email_registrado'] ?>">
                      </div>
                      <div id="error"></div>
                    </div>
                    <div class="paquetes" id="paquetes">
                      <div class="box-header with-border">
                        <h3 class="box-title">Elige el número de boletos</h3>
                      </div>
                      <ul class="prices">
                        <li class="price__card">
                          <h4>Un día</h4>
                          <p><span>$30</span></p>
                          <p>Bocadillos gratis</p>
                          <p>Todas las conferencias</p>
                          <p>Todos los talleres</p>
                          <div class="orden">
                            <label for="pase_dia">Boletos deseados: </label>

                            <input type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0" value="<?php echo $pase1 ?>">
                            <input type="hidden" value="30" name="boletos[un_dia][precio]">
                          </div>
                        </li>
                        <li class="price__card">
                          <h4>Todos los días</h4>
                          <p><span>$50</span></p>
                          <p>Bocadillos gratis</p>
                          <p>Todas las conferencias</p>
                          <p>Todos los talleres</p>
                          <div class="orden">
                            <label for="pase_completo">Boletos deseados: </label>

                            <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0" value="<?php echo $pase3 ?>">
                            <input type="hidden" value="50" name="boletos[completo][precio]">
                          </div>
                        </li>
                        <li class="price__card">
                          <h4>Dos días</h4>
                          <p><span>$45</span></p>
                          <p>Bocadillos gratis</p>
                          <p>Todas las conferencias</p>
                          <p>Todos los talleres</p>
                          <div class="orden">
                            <label for="pase_dosdias">Boletos deseados: </label>

                            <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[dos_dias][cantidad]" placeholder="0" value="<?php echo $pase2 ?>">
                            <input type="hidden" value="45" name="boletos[dos_dias][precio]">
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div id="eventos" class="eventos clearfix box">
                      <h3>Elige tus talleres</h3>
                      <div class="caja">
                        <?php
                        include_once 'funciones/funciones.php';

                        $sql = "SELECT eventos.*, categoria_evento.cat_evento FROM eventos INNER JOIN categoria_evento ON eventos.id_cat_evento = categoria_evento.id_categoria ORDER BY hora_evento;";
                        $response = $conn->query($sql);
                        $eventos_dias = array();
                        while ($eventos = $response->fetch_assoc()) {
                          $fecha = $eventos['fecha_evento'];
                          setlocale(LC_ALL, 'es');
                          $dia_semana = strftime("%A", strtotime($fecha));

                          $categoria = $eventos['cat_evento'];

                          $dia = array(
                            'nombre_evento' => $eventos['nombre_evento'],
                            'hora' => $eventos['hora_evento'],
                            'clave' => $eventos['clave']
                          );
                          $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                        }


                        foreach ($eventos_dias as $dia => $eventos) {
                        ?>
                          <div id='<?php echo str_replace('á', 'a', utf8_encode($dia)) ?>' class="contenido-dia clearfix">
                            <h4><?php echo utf8_encode($dia) ?></h4>
                            <?php
                            foreach ($eventos['eventos'] as $tipo => $evento_dia) {
                            ?>
                              <div>
                                <p><?php echo $tipo ?>:</p>
                                <?php
                                foreach ($evento_dia as $evento) {
                                ?>
                                  <?php
                                  if (in_array($evento['clave'], $talleres)) {
                                  ?>
                                    <label><input checked type="checkbox" name="registros[]" id="<?php echo $evento['clave'] ?>" value="<?php echo $evento['clave'] ?>"><time><?php echo $evento['hora'] ?></time> <?php echo $evento['nombre_evento'] ?></label>
                                  <?php
                                  } else {
                                  ?>
                                    <label><input type="checkbox" name="registros[]" id="<?php echo $evento['clave'] ?>" value="<?php echo $evento['clave'] ?>"><time><?php echo $evento['hora'] ?></time> <?php echo $evento['nombre_evento'] ?></label>
                                  <?php
                                  }

                                  ?>
                                <?php
                                }
                                ?>
                              </div>
                            <?php
                            }
                            ?>
                          </div>
                          <!--#viernes-->
                        <?php
                        }
                        ?>
                      </div>
                      <!--.caja-->
                    </div>
                    <!--#eventos-->
                    <!-- /.input group -->
                    <div class="resumen clearfix" id="resumen">
                      <h3>Pago y extras</h3>
                      <div class="caja clearfix">
                        <div class="extras">
                          <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7% dto.)</small></label>
                            <input type="number" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0" value="<?php echo $articulos['camisas'] ?>">
                            <input type="hidden" value="10" name="pedido_extra[camisas][precio]">
                          </div>
                          <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript)</small></label>
                            <input type="number" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0" value="<?php echo $articulos['etiquetas'] ?>">
                            <input type="hidden" value="2" name="pedido_extra[etiquetas][precio]">
                          </div>
                          <div class="orden">
                            <label for="regalo">Seleccione un regalo </label>
                            <select name="regalo" id="regalo" required>
                              <?php
                              try {
                                $sql = "SELECT * FROM regalos";
                                $resultado = $conn->query($sql);
                              } catch (Exception $e) {
                                $error = $e->getMessage();
                                echo $error;
                              }
                              while ($regalo = $resultado->fetch_assoc()) {
                                if ($registrado['regalo'] == $regalo['id_regalo']) {
                              ?>
                                  <option selected value="<?php echo $regalo['id_regalo'] ?>"><?php echo $regalo['nombre_regalo'] ?></option>
                                <?php
                                } else {
                                ?>
                                  <option value="<?php echo $regalo['id_regalo'] ?>"><?php echo $regalo['nombre_regalo'] ?></option>
                                <?php
                                }
                                ?>
                              <?php
                              }

                              ?>
                              <option value="3">Plumas</option>
                            </select>
                          </div>
                          <input type="button" id="calcular" class="btn bg-purple" value="Calcular">
                        </div>
                        <div class="total">
                          <p>Resumen: </p>
                          <div id="lista-productos">

                          </div>
                          <p>Total: </p>
                          <div id="suma-total">

                          </div>
                          <input type="hidden" id="total_pedido" name="total_pedido">
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                <input type="hidden" id="tipo" value="evento">
                <button type="submit" id="btnRegistro" class="btn btn-primary">Crear</button>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <script>
    //Campos datos usuario
    var nombre = document.getElementById("nombre");
    var apellido = document.getElementById("apellido");
    var email = document.getElementById("email");
    //Campos pases
    var pase_dia = document.getElementById("pase_dia");
    var pase_completo = document.getElementById("pase_completo");
    var pase_dosdias = document.getElementById("pase_dosdias");
    //Botones y divs
    var calcular = document.getElementById("calcular");
    var errorDiv = document.getElementById("error");
    var botonRegistro = document.getElementById("btnRegistro");
    var lista_productos = document.getElementById("lista-productos");
    var suma = document.getElementById("suma-total");
    //Extras
    var camisas = document.getElementById("camisa_evento");
    var etiquetas = document.getElementById("etiquetas");
    botonRegistro.disabled = true;
    mostrarDias();
    calcular.addEventListener("click", calcularMontos);
    pase_dia.addEventListener("change", mostrarDias);
    pase_dosdias.addEventListener("change", mostrarDias);
    pase_completo.addEventListener("change", mostrarDias);

    function calcularMontos(event) {
      event.preventDefault();
      if (regalo.value === "") {
        alert("Debes elegir un regalo");
        regalo.focus();
      } else {
        var boletosDia = parseInt(pase_dia.value, 10) || 0,
          boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
          boletosCompleto = parseInt(pase_completo.value, 10) || 0,
          cantCamisas = parseInt(camisas.value, 10) || 0,
          cantEtiquetas = parseInt(etiquetas.value, 10) || 0;

        var totalPagar =
          boletosDia * 30 +
          boletos2Dias * 45 +
          boletosCompleto * 50 +
          cantCamisas * 10 * 0.93 +
          cantEtiquetas * 2;
        console.log(totalPagar);
        var listadoProductos = [];
        if (boletosDia >= 1) {
          listadoProductos.push(boletosDia + " Pases por día");
        }
        if (boletos2Dias >= 1) {
          listadoProductos.push(boletos2Dias + " Pases por 2 días");
        }
        if (boletosCompleto >= 1) {
          listadoProductos.push(boletosCompleto + " Pases completos");
        }
        if (cantCamisas >= 1) {
          listadoProductos.push(cantCamisas + " Camisas");
        }
        if (cantEtiquetas >= 1) {
          listadoProductos.push(cantEtiquetas + " Etiquetas");
        }
        console.log(listadoProductos);
        lista_productos.style.display = "block";
        lista_productos.innerHTML = "";
        for (var i = 0; i < listadoProductos.length; i++) {
          lista_productos.innerHTML += listadoProductos[i] + "</br>";
        }
        suma.style.display = "block";
        suma.innerHTML = "$ " + totalPagar.toFixed(2);

        botonRegistro.disabled = false;
        document.getElementById('total_pedido').value = totalPagar.toFixed(2);
      }
    }

    function mostrarDias() {
      var boletosDia = parseInt(pase_dia.value, 10) || 0,
        boletos2Dias = parseInt(pase_dosdias.value, 10) || 0,
        boletosCompleto = parseInt(pase_completo.value, 10) || 0;
      let viernes = document.getElementById("viernes"),
        sabado = document.getElementById("sabado"),
        domingo = document.getElementById("domingo");

      var diasElegidos = [];
      if (boletosDia > 0) {
        diasElegidos.push("viernes");
      } else {
        viernes.style.display = "none";
      }
      if (boletos2Dias > 0) {
        diasElegidos.push("viernes", "sabado");
      } else {
        sabado.style.display = "none";
      }
      if (boletosCompleto > 0) {
        diasElegidos.push("viernes", "sabado", "domingo");
      } else {
        domingo.style.display = "none";
      }

      for (var i = 0; i < diasElegidos.length; i++) {
        document.getElementById(diasElegidos[i]).style.display = "block";
      }
    }
  </script>

  <?php include_once 'templates/footer.php' ?>