<?php 
session_start();
if (isset($_GET['cerrar_sesion'])) {
  $cerrar_sesion = $_GET['cerrar_sesion'];
  if ($cerrar_sesion) {
    session_destroy();
  } 
}

?>
<?php include_once 'templates/header.php' ?>

<body class="login-page">
  <!-- Site wrapper -->

  <div class="login-box">
    <div class="login-logo">
      <a href="../index.php"><b>GDL</b>WebCamp</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Inicia sesión aquí</p>

      <form name="login-admin-form" id="login-admin" method="post" action="modelo-admin.php">
        <div class="form-group has-feedback">
          <input type="text" name="usuario" class="form-control" placeholder="Usuario">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <input type="hidden" name="login-admin" value="1">
            <button  type="submit" class="btn btn-primary btn-block btn-flat">Iniciar sesión</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <?php include_once 'templates/footer.php' ?>