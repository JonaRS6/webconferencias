<?php include_once 'funciones/sesiones.php' ?>
<?php include_once 'funciones/funciones.php' ?>
<?php include_once 'templates/header.php' ?>

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
          Crear evento
          <small>Puedes crear un evento aquí</small>
        </h1>
      </section>

      <div class="row">
        <div class="col-md-12">
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Evento nuevo</h3>
              </div>
              <div class="box-body">
                <form role="form" name="crear-evento" id="crear-registro" method="post" action="modelo-evento.php" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Título del evento</label>
                      <input type="text" name="nombre-evento" class="form-control" id="nombre-evento" placeholder="El título del evento">
                    </div>
                    <div class="form-group">
                      <label>Categoría</label>
                      <select class="form-control select2" style="width: 100%;" name="categoria" id="categoria">
                        <?php
                        try {
                          $sql = "SELECT * FROM categoria_evento";
                          $resultado = $conn->query($sql);
                          
                        } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        while ($categoria = $resultado->fetch_assoc()) {
                        ?>
                          <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['cat_evento'] ?></option>
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
                        <input type="text" class="form-control pull-right" id="datepicker" name="fecha" id="fecha">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <div class="bootstrap-timepicker col-xs-6">
                      <div class="form-group">
                        <label>Hora</label>

                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                          <input type="text" class="form-control timepicker" name="hora" id="hora">

                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                    <div class="form-group">
                      <label>Presenta</label>
                      <select class="form-control select2" style="width: 100%;"  name="invitado" id="invitado">
                        <?php
                        try {
                          $sql = "SELECT id_invitado, nombre_invitado, apellido_invitado FROM invitados";
                          $resultado = $conn->query($sql);
                        } catch (Exception $e) {
                          $error = $e->getMessage();
                          echo $error;
                        }
                        while ($invitado = $resultado->fetch_assoc()) {
                        ?>
                          <option value="<?php echo $invitado['id_invitado'] ?>"><?php echo $invitado['nombre_invitado']." ".$invitado['apellido_invitado'] ?></option>
                        <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <input type="hidden" id="tipo" value="evento">
                    <button type="submit" class="btn btn-primary">Crear</button>
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