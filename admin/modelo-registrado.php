<?php
include_once 'funciones/funciones.php';

if (isset($_POST['registro'])) {
    if ($_POST['registro'] == 'nuevo') {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $regalo = $_POST['regalo'];
        $total = $_POST['total_pedido'];
        $fecha = date('Y-m-d H:i:s');


        //Pedidos
        $boletos = $_POST['boletos'];
        $numeroBoletos = $boletos;
        $pedidoExtra = $_POST['pedido_extra'];
        $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
        $precioCamisas = $_POST['pedido_extra']['camisas']['precio'];
        $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
        $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];



        include_once '../includes/functions/funciones.php';
        $pedido = productosJson($boletos, $camisas, $etiquetas);
        //Eventos
        $eventos = $_POST['registros'];
        $registro = eventosJson($eventos);
        $pagado = 1;
        try {
            $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("ssssssisi", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total, $pagado);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
        die(json_encode($respuesta));
    }

    if ($_POST['registro'] == 'actualizar') {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $regalo = $_POST['regalo'];
        $total = $_POST['total_pedido'];


        //Pedidos
        $boletos = $_POST['boletos'];
        $numeroBoletos = $boletos;
        $pedidoExtra = $_POST['pedido_extra'];
        $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
        $precioCamisas = $_POST['pedido_extra']['camisas']['precio'];
        $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
        $precioEtiquetas = $_POST['pedido_extra']['etiquetas']['precio'];



        include_once '../includes/functions/funciones.php';
        $pedido = productosJson($boletos, $camisas, $etiquetas);
        //Eventos
        $eventos = $_POST['registros'];
        $registro = eventosJson($eventos);
        $id_registro = $_POST['id_registro'];

        try {
            $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ?, editado = NOW() WHERE id_registrado = ? ");
            $stmt->bind_param("sssssisi", $nombre, $apellido, $email, $pedido, $registro, $regalo, $total, $id_registro);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_actualizado' => $stmt->insert_id
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
        die(json_encode($respuesta));
    }

    if ($_POST['registro'] == 'eliminar') {
        $id_borrar = $_POST['id'];
        try {
            $stmt = $conn->prepare("DELETE FROM registrados WHERE id_registrado = ? ");
            $stmt->bind_param("i", $id_borrar);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_eliminado' => $id_borrar
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }

            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
        die(json_encode($respuesta));
    }
}
