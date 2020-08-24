<?php
include_once 'funciones/funciones.php';

if (isset($_POST['registro'])) {
    
    if ($_POST['registro'] == 'nuevo') {
    $nombre = $_POST['nombre-evento'];
    $categoria = $_POST['categoria'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $invitado = $_POST['invitado'];
    
    //Formateos a fecha y hora
    $fechaFormateada = date('Y-m-d', strtotime($fecha));
    $horaFormateada = date('H:i:s', strtotime($hora));
    //Clave
    switch ($categoria) {
        case '1':
            //seminarios
            $existe = true;
            while ($existe) {
                $clave = "sem_".rand(0, 99);
                try {
                    $stmt = $conn->prepare("SELECT clave FROM eventos WHERE clave = ?");
                    $stmt->bind_param("s", $clave);
                    $stmt->execute();
                    if ($stmt->affected_rows) {
                        $resultado = $stmt->fetch();
                        if ($resultado) {
                            $existe = true;
                        } else {
                            $existe = false;
                        }
                        
                    } else {
                    }
                    $stmt->close();
                    
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            break;
        case '2':
            //conferencias
            $existe = true;
            while ($existe) {
                $clave = "conf_".rand(0, 99);
                try {
                    $stmt = $conn->prepare("SELECT clave FROM eventos WHERE clave = ?");
                    $stmt->bind_param("s", $clave);
                    $stmt->execute();
                    if ($stmt->affected_rows) {
                        $resultado = $stmt->fetch();
                        if ($resultado) {
                            $existe = true;
                        } else {
                            $existe = false;
                        }
                        
                    } else {
                    }
                    $stmt->close();
                    
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            break;
        case '3':
            //talleres
            $existe = true;
            while ($existe) {
                $clave = "taller_".rand(0, 99);
                try {
                    $stmt = $conn->prepare("SELECT clave FROM eventos WHERE clave = ?");
                    $stmt->bind_param("s", $clave);
                    $stmt->execute();
                    if ($stmt->affected_rows) {
                        $resultado = $stmt->fetch();
                        if ($resultado) {
                            $existe = true;
                        } else {
                            $existe = false;
                        }
                        
                    } else {
                    }
                    $stmt->close();
                    
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            break;
        
        default:
            # code
            break;
    }


        try {
            $stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, clave, id_invitado) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("sssisi", $nombre, $fechaFormateada, $horaFormateada, $categoria, $clave, $invitado);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if ($id_registro > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_evento' => $id_registro
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
    $id_registro = $_POST['id_registro'];
    $nombre = $_POST['nombre-evento'];
    $categoria = $_POST['categoria'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $invitado = $_POST['invitado'];
    
    //Formateos a fecha y hora
    $fechaFormateada = date('Y-m-d', strtotime($fecha));
    $horaFormateada = date('H:i:s', strtotime($hora));
    //Clave
    switch ($categoria) {
        case '1':
            //seminarios
            $existe = true;
            while ($existe) {
                $clave = "sem_".rand(0, 99);
                try {
                    $stmt = $conn->prepare("SELECT clave FROM eventos WHERE clave = ?");
                    $stmt->bind_param("s", $clave);
                    $stmt->execute();
                    if ($stmt->affected_rows) {
                        $resultado = $stmt->fetch();
                        if ($resultado) {
                            $existe = true;
                        } else {
                            $existe = false;
                        }
                        
                    } else {
                    }
                    $stmt->close();
                    
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            break;
        case '2':
            //conferencias
            $existe = true;
            while ($existe) {
                $clave = "conf_".rand(0, 99);
                try {
                    $stmt = $conn->prepare("SELECT clave FROM eventos WHERE clave = ?");
                    $stmt->bind_param("s", $clave);
                    $stmt->execute();
                    if ($stmt->affected_rows) {
                        $resultado = $stmt->fetch();
                        if ($resultado) {
                            $existe = true;
                        } else {
                            $existe = false;
                        }
                        
                    } else {
                    }
                    $stmt->close();
                    
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            break;
        case '3':
            //talleres
            $existe = true;
            while ($existe) {
                $clave = "taller_".rand(0, 99);
                try {
                    $stmt = $conn->prepare("SELECT clave FROM eventos WHERE clave = ?");
                    $stmt->bind_param("s", $clave);
                    $stmt->execute();
                    if ($stmt->affected_rows) {
                        $resultado = $stmt->fetch();
                        if ($resultado) {
                            $existe = true;
                        } else {
                            $existe = false;
                        }
                        
                    } else {
                    }
                    $stmt->close();
                    
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            break;
        
        default:
            # code
            break;
    }

        try {
            $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, clave = ?, id_invitado = ?, editado = NOW() WHERE id_evento = ? ");
            $stmt->bind_param("sssisii", $nombre, $fechaFormateada, $horaFormateada, $categoria, $clave, $invitado, $id_registro);
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
            $stmt = $conn->prepare("DELETE FROM eventos WHERE id_evento = ? ");
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
