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
          Listado de registrados
          <small></small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Maneja los registrados en esta sección</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="registros" class="table table-bordered table-striped col-xs-12">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Fecha registro</th>
                      <th>Pases y artículos</th>
                      <th>Talleres registrados</th>
                      <th>Regalo</th>
                      <th>Total</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    try {
                      $sql = "SELECT * FROM registrados";
                      $resultado = $conn->query($sql);
                    } catch (Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }
                    while ($registrado = $resultado->fetch_assoc()) {
                    ?>
                      <tr>
                        <td>
                          <?php
                          echo $registrado['nombre_registrado'] . " " . $registrado['apellido_registrado']."<br>";
                          if ($registrado['pagado'] > 0) {
                            echo '<span class="badge bg-green">Pagado</span>';
                          } else {
                            echo '<span class="badge bg-red">No pagado</span>';
                          }

                          ?>
                        </td>
                        <td><?php echo $registrado['email_registrado']; ?></td>
                        <td><?php echo $registrado['fecha_registro']; ?></td>
                        <td>
                          <?php
                          $articulos = json_decode($registrado['pases_articulos'], true);
                          $nombresArticulos = array(
                            'un_dia' => 'Pases 1 día',
                            'pase_2dias' => 'Pases 2 días',
                            'pase_completo' => 'Pases completos',
                            'camisas' => 'Camisas',
                            'etiquetas' => 'Etiquetas',
                          );
                          foreach ($articulos as $key => $articulo) {
                            echo $articulo . " " . $nombresArticulos[$key] . "<br>";
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          $talleres = json_decode($registrado['talleres_registrados'], true);
                          $talleres = implode("', '", $talleres['eventos']);
                          $sql_talleres = "SELECT nombre_evento, fecha_evento FROM eventos WHERE clave IN ('$talleres')";
                          $resultados = $conn->query($sql_talleres);
                          while ($eventos = $resultados->fetch_assoc()) {
                            echo "*" . $eventos['nombre_evento'] . ": " . $eventos['fecha_evento'] . "<br>";
                          }

                          ?>
                        </td>
                        <td><?php echo $registrado['regalo']; ?></td>
                        <td><?php echo $registrado['total_pagado']; ?></td>
                        <td>
                          <a href="editar-registrado.php?id=<?php echo $registrado['id_registrado']; ?>" class="btn bg-orange btn-flat margin">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a href="#" data-id="<?php echo $registrado['id_registrado']; ?>" data-tipo="registrado" class="btn bg-maroon btn-flat margin borrar-registro">
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
                      <th>Email</th>
                      <th>Fecha registro</th>
                      <th>Pases y artículos</th>
                      <th>Talleres registrados</th>
                      <th>Regalo</th>
                      <th>Total</th>
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