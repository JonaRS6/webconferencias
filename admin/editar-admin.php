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
          Editar administrador
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
                <h3 class="box-title">Editar Administrador</h3>
              </div>
              <div class="box-body">
                <?php
                $sql = "SELECT * FROM admins WHERE id_admin = $id";
                $resultado = $conn->query($sql);
                $admin = $resultado->fetch_assoc();
                ?>

                <form role="form" name="editar-admin" id="editar-registro" method="post" action="modelo-admin.php" data-tipo="admin">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Usuario</label>
                      <input type="text" name="usuario" class="form-control" id="usuario" value="<?php echo $admin['usuario'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $admin['nombre'] ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Tu password">
                    </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_registro" value="<?php echo $id?>">
                    <input type="hidden" id="tipo" value="admin">
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