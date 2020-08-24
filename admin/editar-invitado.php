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
          Editar invitado
          <small>Llena el formulario para editar un invitado</small>
        </h1>
      </section>

      <div class="row">
        <div class="col-md-8">
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Editar Invitado</h3>
              </div>
              <div class="box-body">
                <?php
                $sql = "SELECT * FROM invitados WHERE id_invitado = $id";
                $resultado = $conn->query($sql);
                $invitado = $resultado->fetch_assoc();
                ?>
                <form role="form" name="editar-invitado" id="editar-registro-file" method="post" action="modelo-invitado.php" data-tipo="invitado" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombre_invitado">Nombre</label>
                      <input type="text" name="nombre_invitado" class="form-control" id="usuario" placeholder="Nombre del invitado" value="<?php echo $invitado['nombre_invitado'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="apellido_invitado">Apellido</label>
                      <input type="text" name="apellido_invitado" class="form-control" id="nombre" placeholder="Apellido del invitado" value="<?php echo $invitado['apellido_invitado'] ?>">
                    </div>
                    <div class="form-group">
                      <label>Biografía</label>
                      <textarea class="form-control" name="biografia" rows="4" placeholder="Enter ..."><?php echo $invitado['descripcion'] ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="imagenFile">Imagen</label>
                      <div class="row margin-bottom">
                        <div class="col-md-3">
                          <input type="hidden" id="imagenActual" name="img-actual" value="<?php echo $invitado['url_imagen'] ?>">
                          <img src="/conferencias/img/invitados/<?php echo $invitado['url_imagen'] ?>" alt="invitado" class="img-responsive">
                        </div>
                      </div>
                      <input type="file" id="imagenFile" name="img-file">

                      <p class="help-block">Elige la imagen que se mostrará de el invitado.</p>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                    <input type="hidden" id="tipo" value="invitado">
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