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
          Crear invitado
          <small>Llena el formulario para crear un invitado</small>
        </h1>
      </section>

      <div class="row">
        <div class="col-md-8">
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Crear Invitado</h3>
              </div>
              <div class="box-body">
                <form role="form" name="crear-invitado" id="crear-registro-file" method="post" action="modelo-invitado.php" data-tipo="invitado" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombre_invitado">Nombre</label>
                      <input type="text" name="nombre_invitado" class="form-control" id="usuario" placeholder="Nombre del invitado">
                    </div>
                    <div class="form-group">
                      <label for="apellido_invitado">Apellido</label>
                      <input type="text" name="apellido_invitado" class="form-control" id="nombre" placeholder="Apellido del invitado">
                    </div>
                    <div class="form-group">
                      <label>Biografía</label>
                      <textarea class="form-control" name="biografia" rows="4" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                      <label for="imagenFile">Imagen</label>
                      <input type="file" id="imagenFile" name="img-file">

                      <p class="help-block">Elige la imagen que se mostrará de el invitado.</p>
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <input type="hidden" id="tipo" value="invitado">
                    <button type="submit" class="btn btn-primary">Añadir</button>
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