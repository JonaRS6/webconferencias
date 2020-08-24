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
          Editar evento
          <small>Puedes editar un evento aquí</small>
        </h1>
      </section>

      <div class="row">
        <div class="col-md-12">
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Evento</h3>
              </div>
              <div class="box-body">
                <?php
                $sql = "SELECT * FROM eventos WHERE id_evento = $id";
                $resultado = $conn->query($sql);
                $evento = $resultado->fetch_assoc();
                ?>

                <form role="form" name="editar-evento" id="editar-registro" method="post" action="modelo-evento.php">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Título del evento</label>
                      <input type="text" name="nombre-evento" class="form-control" id="nombre-evento" value="<?php echo $evento['nombre_evento'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Categoría</label>
                      <select class="form-control select2" style="width: 100%;" name="categoria" id="categoria" value="<?php echo $evento['id_cat_evento'] ?>">
                        <?php
                        try {
                          $sql = "SELECT * FROM categoria_evento";
                          $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        while ($categoria = $resultado->fetch_assoc()) {
                          if ($evento['id_cat_evento'] == $categoria['id_categoria']) {
                        ?>
                            <option selected value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['cat_evento'] ?></option>
                          <?php
                          } else {
                          ?>
                            <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['cat_evento'] ?></option>
                          <?php
                          }
                          ?>
                        <?php
                        }

                        ?>
                      </select>
                    </div>
                    <div class="form-group col-xs-6">
                      <label>Fecha</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="fecha" id="fecha" value="<?php echo $evento['fecha_evento'] ?>">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="bootstrap-timepicker col-xs-6">
                      <div class="form-group">
                        <label>Hora</label>
                        <?php
                        $horaFormateada = date('h:i a', strtotime($evento['hora_evento']));
                        ?>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control timepicker" name="hora" id="hora" value="<?php echo $horaFormateada ?>">

                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                    <div class="form-group">
                      <label>Presenta</label>
                      <select class="form-control select2" style="width: 100%;" name="invitado" id="invitado" value="<?php echo $evento['id_invitado'] ?>">
                        <?php
                        try {
                          $sql = "SELECT id_invitado, nombre_invitado, apellido_invitado FROM invitados";
                          $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        while ($invitado = $resultado->fetch_assoc()) {
                          if ($evento['id_invitado'] == $invitado['id_invitado']) {
                        ?>
                            <option selected value="<?php echo $invitado['id_invitado'] ?>"><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado'] ?></option>
                          <?php
                          } else {
                          ?>
                            <option value="<?php echo $invitado['id_invitado'] ?>"><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado'] ?></option>
                          <?php
                          }
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id?>">
                    <input type="hidden" id="tipo" value="evento">
                    <button type="submit" class="btn btn-primary">Guardar</button>
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


    <?php include_once 'templates/footer.php' ?>