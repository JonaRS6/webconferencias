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
          Listado de eventos
          <small></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Controla los eventos aqui</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="registros" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Categoría</th>
                      <th>Invitado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $sql = "SELECT id_evento, nombre_evento,fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado FROM eventos INNER JOIN categoria_evento ON eventos.id_cat_evento=categoria_evento.id_categoria INNER JOIN invitados ON eventos.id_invitado=invitados.id_invitado";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    while ($evento = $resultado->fetch_assoc()) {
                    ?>
                      <tr>
                        <td><?php echo $evento['nombre_evento']; ?></td>
                        <td><?php echo $evento['fecha_evento']; ?></td>
                        <td><?php echo $evento['hora_evento']; ?></td>
                        <td><?php echo $evento['cat_evento']; ?></td>
                        <td><?php echo $evento['nombre_invitado']." ".$evento['apellido_invitado']; ?></td>
                        <td>
                          <a href="editar-evento.php?id=<?php echo $evento['id_evento']; ?>" class="btn bg-orange btn-flat margin">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a href="#" data-id="<?php echo $evento['id_evento']; ?>" data-tipo="evento" class="btn bg-maroon btn-flat margin borrar-registro">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Categoría</th>
                      <th>Invitado</th>
                      <th>Acciones</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <?php include_once 'templates/footer.php' ?>