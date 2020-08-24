<?php
include_once 'funciones/funciones.php';

if (isset($_POST['registro'])) {
    if ($_POST['registro'] == 'nuevo') {
        $nombre = $_POST['nombre_invitado'];
        $apellido = $_POST['apellido_invitado'];
        $biografia = $_POST['biografia'];

        $directorio = "../img/invitados/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if (move_uploaded_file($_FILES['img-file']['tmp_name'], $directorio . $_FILES['img-file']['name'])) {
            $url_img = $_FILES['img-file']['name'];
            $img_resultado = "Sesubio correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }


        try {
            $stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?);");
            $stmt->bind_param("ssss", $nombre, $apellido, $biografia, $url_img);
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
        $nombre = $_POST['nombre_invitado'];
        $apellido = $_POST['apellido_invitado'];
        $biografia = $_POST['biografia'];
        $imagenActual = "../img/invitados/" . $_POST['img-actual'];
        $directorio = "../img/invitados/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if (move_uploaded_file($_FILES['img-file']['tmp_name'], $directorio . $_FILES['img-file']['name'])) {
            $url_img = $_FILES['img-file']['name'];
            $img_resultado = "Sesubio correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }
        $id_registro = $_POST['id_registro'];

        try {
            if ($_FILES['img-file']['size'] > 0) {
                $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ?, editado = NOW() WHERE id_invitado = ? ");
                $stmt->bind_param("ssssi", $nombre, $apellido, $biografia, $url_img, $id_registro);
                $stmt->execute();
                unlink($imagenActual);
            } else {
                $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, editado = NOW() WHERE id_invitado = ? ");
                $stmt->bind_param("sssi", $nombre, $apellido, $biografia, $id_registro);
                $stmt->execute();
            }

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
            $sql = "SELECT url_imagen FROM invitados WHERE id_invitado = $id_borrar;";
            $resultado = $conn->query($sql);
            $invitado = $resultado->fetch_assoc();
            $imagenActual = "../img/invitados/" . $invitado['url_imagen'];
            $stmt = $conn->prepare("DELETE FROM invitados WHERE id_invitado = ? ;");
            $stmt->bind_param("i", $id_borrar);
            $stmt->execute();
            if ($stmt->affected_rows) {
                unlink($imagenActual);
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
