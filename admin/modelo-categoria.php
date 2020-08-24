<?php
include_once 'funciones/funciones.php';

if (isset($_POST['registro'])) {
    if ($_POST['registro'] == 'nuevo') {
        $nombre = $_POST['nombre'];
        $icono = $_POST['icono'];


        try {
            $stmt = $conn->prepare("INSERT INTO categoria_evento (cat_evento, icono) VALUES (?,?);");
            $stmt->bind_param("ss", $nombre, $icono);
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
        $icono = $_POST['icono'];
        $id_registro = $_POST['id_registro'];

        try {
            $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoria = ? ");
            $stmt->bind_param("ssi", $nombre, $icono, $id_registro);
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
            $stmt = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ? ");
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
