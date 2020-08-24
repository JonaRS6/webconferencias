    <?php
    if (isset($_POST['submit'])) :
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $regalo = $_POST['regalo'];
        $total = $_POST['total_pedido'];
        $fecha = date('Y-m-d H:i:s');

        //Pedidos
        $boletos = $_POST['boletos'];
        $camisas = $_POST['pedido_camisas'];
        $etiquetas = $_POST['pedido_etiquetas'];

        include_once 'includes/functions/funciones.php';
        $pedido = productosJson($boletos, $camisas, $etiquetas);

        //Eventos
        $eventos = $_POST['registro'];
        $registro = eventosJson($eventos);

        try {
            require_once('includes/functions/bd_connection.php');
            $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            header('Location: validar_registro.php?exitoso=1');
        } catch (\Exception $_e) {
            echo $e->getMessage();
        }


    endif;
    ?>
    <?php include_once 'includes/templates/header.php'; ?>
    <section class="container">
        <h2 class="text-center">Registro de usuarios</h2>
        <div class="tittle-decorator">
            <i class="fas fa-ellipsis-h"></i>
        </div>
        <?php
            if (isset($_GET['exitoso'])) {
                if ($_GET['exitoso'] == 1 ) {
                    echo "<h3>";
                    echo "Registro exitoso";
                    echo "</h3>";
                }
            }
        ?>
    </section>


    <?php include_once 'includes/templates/footer.php'; ?>