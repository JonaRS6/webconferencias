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
          Crear categoría
          <small>Puedes crear una categoría aquí</small>
        </h1>
      </section>

      <div class="row">
        <div class="col-md-12">
          <!-- Main content -->
          <section class="content">

            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Categoría nueva</h3>
              </div>
              <div class="box-body">
                <form role="form" name="crear-categoria" id="crear-registro" method="post" action="modelo-categoria.php" >
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre de la categoría</label>
                      <input type="text" name="nombre" class="form-control" id="nombre" placeholder="El nombre de la categoría">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ícono</label>
                      <input type="text" name="icono" class="form-control" id="icono" placeholder="La clase del ícono de FontAwesome">
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <input type="hidden" id="tipo" value="categoria">
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