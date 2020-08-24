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
          Crear administrador
          <small>Llena el formulario para crear un administrador</small>
        </h1>
      </section>

      <div class="row">
        <div class="col-md-8">
          <!-- Main content -->
          <section class="content">
    
            <!-- Default box -->
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Crear Administrador</h3>
              </div>
              <div class="box-body">
              <form role="form" name="crear-admin" id="crear-registro" method="post" action="modelo-admin.php" data-tipo="admin">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Usuario</label>
                      <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Tu usuario">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text"  name="nombre" class="form-control" id="nombre" placeholder="Tu nombre">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Tu password">
                    </div>
                  </div>
                  <!-- /.box-body -->
                  
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="nuevo">
                    <input type="hidden" id="tipo" value="admin">
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